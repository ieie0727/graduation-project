@extends('adminlte::page')

@section('title', '取引先詳細')

@section('content_header')
<h1>取引先詳細（ID:{{$company->id}}）</h1>
@stop

@section('content')
<div class="row">
  <div class="col-md-10">
    <div class="card card-info">
      <div class="card-body">
        <div class="form-group">
          <label for="name">企業名</label>
          <p id="name">{{ $company->name }}</p>
        </div>

        <div class="form-group">
          <label for="address">住所</label>
          <p id="address">{{ $company->address }}</p>
        </div>

        <div class="form-group">
          <label for="email">メールアドレス</label>
          <p id="email">{{ $company->email }}</p>
        </div>

        <div class="form-group">
          <label for="phone_number">電話番号</label>
          <p id="phone_number">{{ $company->phone_number }}</p>
        </div>
      </div>
      <div class="card-footer">
        <a href="{{ route('companies.index') }}" class="btn btn-secondary">戻る</a>
        <a href="{{ route('companies.edit', compact('company')) }}" class="btn btn-primary ml-3">更新</a>
      </div>
    </div>
  </div>
</div>
@stop