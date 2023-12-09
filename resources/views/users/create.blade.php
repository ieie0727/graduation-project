@extends('adminlte::page')

@section('title', 'ユーザー登録')

@section('content_header')
<h1>ユーザー登録</h1>
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
      <form method="POST" action="{{route('users.store')}}">
        @csrf
        <div class="card-body">
          <div class="form-group">
            <label for="name">名前</label>
            <input type="text" class="form-control" id="name" name="name" value="{{old('name')}}">
          </div>

          <div class="form-group">
            <label for="email">メールアドレス</label>
            <input type="email" class="form-control" id="email" name="email" value="{{old('email')}}">
          </div>

          <div class="form-group">
            <label for="password">パスワード</label>
            <input type="password" class="form-control" id="password" name="password">
          </div>

          <div class="form-group">
            <label for="password_confirmation">パスワード(確認用)</label>
            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
          </div>
        </div>

        <div class="card-footer">
          <button type="submit" class="btn btn-primary">登録</button>
        </div>
      </form>
    </div>
  </div>
</div>
@stop

@section('css')
@stop

@section('js')
@stop