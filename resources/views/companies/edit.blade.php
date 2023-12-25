@extends('adminlte::page')

@section('title', '取引先編集')

@section('content_header')
<h1>取引先編集（ID:{{$company->id}}）</h1>
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

    <div class="card card-warning">
      <form method="POST" action="{{ route('companies.update', $company->id) }}">
        @csrf
        @method('PUT')
        <div class="card-body">
          <div class="form-group">
            <label for="name">企業名</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $company->name) }}">
          </div>

          <div class="form-group">
            <label for="address">住所</label>
            <input type="text" class="form-control" id="address" name="address"
              value="{{ old('address', $company->address) }}">
          </div>

          <div class="form-group">
            <label for="email">メールアドレス</label>
            <input type="email" class="form-control" id="email" name="email"
              value="{{ old('email', $company->email) }}">
          </div>

          <div class="form-group">
            <label for="phone_number">電話番号</label>
            <input type="tel" class="form-control" id="phone_number" name="phone_number"
              value="{{ old('phone_number', $company->phone_number) }}">
          </div>
        </div>

        <div class="card-footer">
          <a href="{{ route('companies.show', compact('company')) }}" class="btn btn-secondary">戻る</a>
          <button type="submit" class="btn btn-primary ml-3">更新</button>
        </div>
      </form>
    </div>
  </div>
</div>
@stop