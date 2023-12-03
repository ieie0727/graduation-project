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
      <form method="POST" action="{{route('users.update', compact('user'))}}">
        @csrf @method('patch')
        <div class="card-body">
          <div class="form-group">
            <label for="name">名前</label>
            <input type="disabled" class="form-control" id="name" name="name" value="{{$user->name}}">
          </div>

          <div class="form-group">
            <label for="email">メールアドレス</label>
            <input type="disabled" class="form-control" id="email" name="email" value="{{$user->email}}">
          </div>

          <div class="form-group form-check form-switch">
            @if ($user->role==1)
            <input type="checkbox" class="form-check-input" role="switch" id="role" name="role" checked>
            @else
            <input type="checkbox" class="form-check-input" role="switch" id="role" name="role">
            @endif
            <label for="role" class="form-check-label">管理者権限</label>
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