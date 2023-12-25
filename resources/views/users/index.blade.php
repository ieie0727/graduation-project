@extends('adminlte::page')

@section('title', 'ユーザー一覧')

@section('content_header')
<h1>ユーザー一覧</h1>
@stop

@section('content')
<div class="row">
  <div class="col-12">
    <div class="card">
      @if(session('flash_message'))
      <div class="alert alert-success">
        {{ session('flash_message') }}
      </div>
      @endif
      <div class="card-header">
        <div class="card-title search">
          <form action="{{route('users.index')}}" method="GET">
            名前：<input type="text" id="name" name="name">
            アドレス：<input type="text" id="email" name="email">
            <div class="role-checkbox mt-1">
              権限：
              <input type="checkbox" class="" id="role-user" name="role[]" value="0"> ユーザー
              <input type="checkbox" class="ml-3" id="role-admin" name="role[]" value="1"> 管理者
              <button type="submit" class="btn btn-default ml-5">検索</button>
            </div>
          </form>
        </div>
        <div class="card-tools">
          <div class="input-group input-group-sm">
            <div class="input-group-append">
              <a href="{{ route('users.create') }}" class="btn btn-info">ユーザー登録</a>
            </div>
          </div>
        </div>
      </div>
      <div class="card-body table-responsive p-0">
        <table class="table table-hover text-nowrap">
          <thead>
            <tr>
              <th>ID</th>
              <th>権限</th>
              <th>名前</th>
              <th>メールアドレス</th>
              <th>ステータス</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($users as $user)
            <tr onclick="window.location='{{route('users.edit', $user)}}'">
              <td class="align-middle">{{ $user->id }}</td>
              <td class="align-middle">
                @if ($user->role==1)
                管理者
                @else
                ユーザー
                @endif
              </td>
              <td class="align-middle">{{ $user->name }}</td>
              <td class="align-middle">{{ $user->email}}</td>
              <td class="align-middle">
                @if ($user->deleted_at==null)
                在籍
                @else
                退会
                @endif
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>

    </div>
    {{ $users->links('pagination::bootstrap-4') }}
  </div>
</div>
@stop

@section('css')
<style>
  tbody tr:hover {
    background-color: #f5f5f5;
    /* 適当な背景色 */
    cursor: pointer;
    /* マウスがポインターになる */
  }
</style>
@stop

@section('js')
@stop