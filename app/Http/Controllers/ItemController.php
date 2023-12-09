<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ItemController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $items = Item::withTrashed()->paginate(20);
        return view('items.index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('items.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // バリデーション
        $request->validate([
            'name' => 'required|string|max:100',
            'artist' => 'required|string|max:100',
            'category' => 'nullable|string|max:100',
            'detail' => 'nullable|string|max:500',
            'image_name' => 'nullable|string|max:255', // 必要に応じて変更
            'quantity' => 'integer|min:0',
            // 'last_updated_by' は外部キー
        ]);

        //画像の処理
        $image_name = null;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $timestamp = now()->format('YmdHis');
            $image_name = $timestamp . '_' . $image->getClientOriginalExtension();
            $image->move(public_path('images_uploaded\items'), $image_name);
        }

        // 新規登録の処理
        Item::create([
            'name' => $request->input('name'),
            'artist' => $request->input('artist'),
            'category' => $request->input('category'),
            'detail' => $request->input('detail'),
            'image_name' => $image_name,
            'quantity' => $request->input('quantity') ?? 0,
            'last_updated_by' => auth()->user()->id,
        ]);

        // 画面遷移
        return to_route('items.index')->with('success', '商品を登録しました。');
    }

    /**
     * Display the specified resource.
     */
    public function show(Item $item)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Item $item)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Item $item)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Item $item)
    {
        //
    }
}
