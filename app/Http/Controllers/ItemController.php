<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Http\Requests\ItemRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ItemController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $items = Item::sortable();

        //検索
        $keyword = $request['keyword'];
        if ($keyword) {
            $items->orWhere('name', 'like', '%' . $keyword . '%');
            $items->orWhere('artist', 'like', '%' . $keyword . '%');
        }

        //画面遷移
        $items = $items->paginate(20);
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
    public function store(ItemRequest $request)
    {
        // バリデーション済みのデータを取得
        $validatedData = $request->validated();

        // 画像の処理
        $this->handleImage($validatedData);

        // 新規登録の処理
        Item::create(array_merge($validatedData, [
            'quantity' => $validatedData['quantity'] ?? 0,
            'last_updated_by' => Auth::user()->id,
        ]));

        // 画面遷移
        return redirect()->route('items.index')->with('flash_message', '商品を登録しました。');
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
        return view('items.show', compact('item'));
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Item $item)
    {
        return view('items.edit', compact('item'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(ItemRequest $request, Item $item)
    {
        // バリデーション済みのデータを取得
        $validatedData = $request->validated();

        // 画像の処理
        $this->handleImage($validatedData);

        // 商品情報の更新
        $item->update(array_merge($validatedData, [
            'image_name' => $validatedData['image_name'] ?? $item->image_name,
            'quantity' => $validatedData['quantity'] ?? 0,
            'last_updated_by' => Auth::user()->id,
        ]));

        // 画面遷移
        return redirect()->route('items.show', compact('item'))->with('flash_message', '商品情報を更新しました。');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Item $item)
    {
        //論理削除処理
        $item->delete();

        //画面遷移
        return to_route('items.index')->with('flash_message', '商品を削除しました。');
    }


    /*-------------------------------------------------
    // 共通メソッドの切り出し
    -------------------------------------------------*/
    /**
     * 画像アップロード処理
     */
    private function handleImage(&$data)
    {
        //画像をアップロード
        $image_name = null;
        if (isset($data['image'])) {
            $image = $data['image'];
            $timestamp = now()->format('YmdHis');
            $image_name = $timestamp . '_' . $image->getClientOriginalExtension();
            $image->move(public_path('images_uploaded/items'), $image_name);
        }

        //imageキーを削除して、image_nameを入れる
        unset($data['image']);
        data_set($data, 'image_name', $image_name);

        return $image_name;
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
        //dd($item);
        return response()->json($item);
    }

    /**
     * 全てのitemを返す
     */
    public function getAllItems()
    {
        $items = Item::all();
        //dd($items);
        return response()->json($items);
    }
}
