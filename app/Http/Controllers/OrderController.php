<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Item;
use Illuminate\Http\Request;

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
        if ($request->total_amount) {
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
        $order = Order::creat([]);
        $order_items = $request->input('order_items');
        foreach ($order_items as $order_item) {
        }
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
