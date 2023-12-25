@extends('adminlte::page')

@section('title', 'ユーザー登録')

@section('content_header')
<h1>ユーザー詳細・権限更新（ID:{{$user->id}}）</h1>
@stop

@section('content')
<div class="row">
  <div class="col-md-10">
    @if ($errors->any())
    <div class="alert alert-danger">
      <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
    @endif

    <div class="card card-primary">
      <form method="POST" action="{{ route('users.update', compact('user')) }}">
        @csrf
        @method('patch')
        <div class="card-body">
          <div class="form-group">
            <label for="name">名前：{{ $user->name }}</label>
          </div>

          <div class="form-group">
            <label for="email">メールアドレス：{{ $user->email }}</label>
          </div>

          <div class="form-group form-check form-switch">
            @if ($user->role == 1)
            <input type="checkbox" class="form-check-input" role="switch" id="role" name="role" checked>
            @else
            <input type="checkbox" class="form-check-input" role="switch" id="role" name="role">
            @endif
            <label for="role" class="form-check-label">管理者権限</label>
          </div>
        </div>
        <div class="card-footer">
          <a href="{{ route('users.index') }}" class="btn btn-secondary">戻る</a>
          <button type="submit" class="btn btn-primary ml-3">権限更新</button>
      </form>
      <form action="{{ route('users.destroy', compact('user')) }}" method="POST" onsubmit="return confirm('本当に削除しますか？')"
        id="user_delete_button" class="ml-3" style="display: inline;">
        @csrf
        @method('delete')
        <button type="submit" class="btn btn-danger">削除</button>
      </form>
    </div>
  </div>
</div>


</div>
</div>
@stop

@section('css')
@stop

@section('js')
@stop