<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Item;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orders = Order::paginate(20);
        return view('orders.index', compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //dd(old('order_items.1'));
        $items = Item::all();
        return view('orders.create', compact('items'));
    }

    public function confirm(Request $request)
    {
        //ガード句
        if ($request['total_amount'] <= 0 || $request['description'] == "") {
            return redirect()->back()->with('flash_message', '商品を１点以上入力してください。')->withInput($request->all());
        }


        /*------------------------------
        // order_itemsの調整
        ------------------------------*/
        $order_items = $request->input('order_items');
        //sub_totalが0のものは削除
        $order_items = array_filter($order_items, function ($order_item) {
            return $order_item['sub_total'] != 0;
        });
        $order_items = array_values($order_items);
        array_unshift($order_items, ['id' => 0]);

        //order_itemに商品名とアーティスト名を追加
        foreach ($order_items as &$order_item) {
            $item = Item::find($order_item['id']);
            if ($item) {
                $order_item['name'] = $item->name;
                $order_item['artist'] = $item->artist;
            }
        }

        //画面遷移(リクエストは投げず、Laravelの既存の物を使用してviewに表示できるようにする ファサード)
        return view('orders.confirm', compact('request', 'order_items'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //確認画面→戻るボタンの時は新規発注画面に戻る
        if ($request->has('back')) {
            return Redirect::route('orders.create')->withInput($request->all());
        }


        /*----------------------
        //ordersに登録
        ----------------------*/
        //バリデーション
        $request->validate([
            'total_amount' => 'required|integer|min:0',
            'description' => 'required|string',
        ]);

        //登録
        $order = Order::create([
            'user_id' => Auth::id(),
            'company_id' => 1, //仮置きで設定
            'total_amount' => $request->input('total_amount'),
            'description' => $request->input('description'),
        ]);

        /*--------------------------------
        //order_itemsの登録 & 在庫数の更新
        --------------------------------*/
        $order_items = $request->input('order_items');
        foreach ($order_items as $order_item) {
            if ($order_item['sub_total'] > 0) {
                //order_itemsの登録
                OrderItem::create([
                    'order_id' => $order->id,
                    'item_id' => $order_item['id'],
                    'quantity' => $order_item['quantity'],
                    'sub_total' => $order_item['sub_total'],
                ]);

                //在庫数の更新
                $item = Item::find($order_item['id']);
                $item->update([
                    'quantity' => $item->quantity + $order_item['quantity'],
                ]);
            }
        }


        return to_route('orderMail', ['order_id' => $order->id]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
