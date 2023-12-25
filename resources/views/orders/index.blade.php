@extends('adminlte::page')

@section('title', '発注履歴')

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
              <th>@sortablelink('created_at','発注日時')</th>
              <th>発注者</th>
              <th>発注先</th>
              <th>金額</th>
              <th>内容</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($orders as $order)
            <tr onclick="window.location='{{route('orders.show', $order)}}'">
              <td class="align-middle">{{ $order->id }}</td>
              <td class="align-middle">{{ $order->created_at }}</td>
              <td class="align-middle">{{ $order->user->name }}</td>
              <td class="align-middle">{{ $order->company->name }}</td>
              <td class="align-middle">{{ number_format(intval($order->total_amount)) }}</td>
              <td class="align-middle">{{ $order->description }}</td>
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