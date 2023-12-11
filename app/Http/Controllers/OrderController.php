<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Item;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        $items = Item::all();
        return view('orders.create', compact('items'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //合計金額が0以下だったら新規作成にredirect
        //dd($request->all());
        if ($request->total_amount <= 0) {
            return to_route('orders.create');
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

        return to_route('orders.index')->with('flash_message', '新規発注をしました。');
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
