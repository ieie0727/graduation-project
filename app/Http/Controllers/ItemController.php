<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Ramsey\Uuid\Type\Integer;

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
            'price' => 'required|numeric|min:0|max:1000000',
            'detail' => 'nullable|string|max:500',
            'image_name' => 'nullable|string|max:255',
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
            'price' => $request->input('price'),
            'detail' => $request->input('detail'),
            'image_name' => $image_name,
            'quantity' => $request->input('quantity') ?? 0,
            'last_updated_by' => auth()->user()->id,
        ]);

        // 画面遷移
        return to_route('items.index')->with('flash_message', '商品を登録しました。');
    }


    /**
     * CSVインポートで一括登録
     */
    public function import(Request $request)
    {
        //ファイルのバリデート
        $request->validate([
            'csv_file' => 'required|mimes:csv,txt|max:2048',
        ]);

        // CSVファイルを二次元配列に変換
        $file = $request->file('csv_file');
        $path = $file->getRealPath();
        $data = array_map('str_getcsv', file($path));

        //ヘッダーの指定・調整
        $headers = array_shift($data);
        $headers[] = 'last_updated_by';
        $user_id = Auth::id();

        foreach ($data as $row) {
            //各行の末尾にuser_idを追加(last_updateded_byに対応)
            $row[] = $user_id;

            //ヘッダーとデータを組み合わせて連想配列化し、itemを登録する
            $itemData = array_combine($headers, $row);
            Item::create($itemData);
        }

        //画面遷移
        return to_route('items.index')->with('flash_message', 'CSVファイルが正常に読み込まれました。');
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


    /*-------------------------------------------------
    // jQueryで使用
    -------------------------------------------------*/
    /**
     * 指定されたidのitemを返す
     */
    public function getItem($id)
    {
        $item = Item::find($id);
        return response()->json($item);
    }
}
