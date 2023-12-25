@extends('adminlte::page')

@section('title', '取引先登録')

@section('content_header')
<h1>取引先登録</h1>
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
      <form method="POST" action="{{ route('companies.store') }}">
        @csrf
        <div class="card-body">
          <div class="form-group">
            <label for="name">企業名</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}">
          </div>

          <div class="form-group">
            <label for="address">住所</label>
            <input type="text" class="form-control" id="address" name="address" value="{{ old('address') }}">
          </div>

          <div class="form-group">
            <label for="email">メールアドレス</label>
            <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}">
          </div>

          <div class="form-group">
            <label for="phone_number">電話番号</label>
            <input type="tel" class="form-control" id="phone_number" name="phone_number"
              value="{{ old('phone_number') }}">
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