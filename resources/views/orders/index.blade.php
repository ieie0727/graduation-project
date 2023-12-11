@extends('adminlte::page')

@section('title', '商品一覧')

@section('content_header')
<h1>発注履歴</h1>
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
        <h3 class="card-title">発注履歴</h3>
        <div class="card-tools">
          <div class="input-group input-group-sm">
            <div class="input-group-append">
              <a href="{{ route('orders.create') }}" class="btn btn-info">新規発注</a>
            </div>
          </div>
        </div>
      </div>
      <div class="card-body table-responsive p-0">
        <table class="table table-hover text-nowrap">
          <thead>
            <tr>
              <th>ID</th>
              <th>日付</th>
              <th>発注者</th>
              <th>発注先</th>
              <th>金額</th>
              <th>内容</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($orders as $order)
            <tr>
              <td>{{ $order->id }}</td>
              <td>{{ $order->created_at->format('Y-n-j') }}</td>
              <td>{{ $order->user->name }}</td>
              <td>{{ $order->company->name }}</td>
              <td>{{ $order->total_amount }}</td>
              <td>{{ $order->description }}</td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
    {{ $orders->links('pagination::bootstrap-4') }}
  </div>
</div>
@stop

@section('css')
@stop

@section('js')
@stop