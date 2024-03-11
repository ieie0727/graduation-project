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

      <div class="card-body">
        <div class="form-group">
          <label for="name">名前：{{ $user->name }}</label>
        </div>

        <div class="form-group">
          <label for="email">メールアドレス：{{ $user->email }}</label>
        </div>
      </div>
      <div class="card-footer">
        <a href="{{ route('users.index') }}" class="btn btn-secondary">戻る</a>
        <form method="POST" action="{{ route('users.restore', compact('user')) }}" style="display: inline;">
          @csrf
          @method('put')
          <button type="submit" class="btn btn-primary ml-3">復元する</button>
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