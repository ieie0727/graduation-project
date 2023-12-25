<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //まずは全員取得
        $users = User::withTrashed();

        // 権限検索
        if ($request->filled('role')) {
            foreach ($request->role as $role) {
                $users->orWhere('role', $role);
            }
        }

        // 名前検索(部分一致)
        if ($request->filled('name')) {
            $users->where('name', 'like', '%' . $request->name . '%');
        }

        // アドレス検索(部分一致)
        if ($request->filled('email')) {
            $users->where('email', 'like', '%' . $request->email . '%');
        }

        // usersを一覧表示
        $users = $users->paginate(10);
        return view('users.index', compact('users'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('users.create');
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //バリデーション
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        //登録処理
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        //画面遷移
        return to_route('users.index')->with('flash_message', '新規ユーザーを登録しました。');
    }


    /**
     * Display the specified resource.
     */
    /*
    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }
    */


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        //データを調整
        if ($request->role) {
            $user->role = 1;
        } else {
            $user->role = 0;
        }

        //dd($request->role, $user->role);
        //アップデート
        $user->update([
            'role' => $user->role, //調整後なので$userでOK
        ]);
        $user->save();

        return to_route('users.index')->with('flash_message', 'ユーザー情報を更新しました。');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //論理削除処理
        $user->delete();

        //画面遷移
        return to_route('users.index')->with('flash_message', 'ユーザーを退会させました。');
    }
}
