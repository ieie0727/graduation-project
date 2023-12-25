@extends('adminlte::page')

@section('title', '新規発注')

@section('content_header')
<h1>新規発注(確認)</h1>
@stop

@section('content')
<div class="row">
  <div class="col-md-10">
    <div class="card card-header">
      <p>以下の内容で発注をしますか？</p>
    </div>

    <div class="card card-primary">
      <form method="POST" action="{{route('orders.store')}}">
        @csrf
        <div class="card-body">
          <input type="hidden" name="company_id" value="{{$company['id']}}">
          <p>発注先：<b>{{$company['name']}}</b></p>
          <table id="orderTableBody" class="table">
            <thead>
              <tr>
                <th>No.</th>
                <th>商品名</th>
                <th>単価</th>
                <th>発注数</th>
                <th>小計</th>
              </tr>
            </thead>
            <tbody>
              @for ($i=1; $i<count($order_items); $i++) @php $order_item=$order_items[$i]; @endphp <tr>
                <td class="align-middle">{{$i}}</td>
                <td class="align-middle">
                  <input type="hidden" name="order_items[{{$i}}][id]" value="{{$order_item['id']}}">
                  {{$order_item['name']}}
                </td>
                <td class="align-middle">
                  <input type="hidden" name="order_items[{{$i}}][price]" value="{{$order_item['price']}}">
                  {{$order_item['price']}}
                </td>
                <td class="align-middle">
                  <input type="hidden" name="order_items[{{$i}}][quantity]" value="{{$order_item['quantity']}}">
                  {{$order_item['quantity']}}
                </td>
                <td class="align-middle">
                  <input type="hidden" name="order_items[{{$i}}][sub_total]" value="{{$order_item['sub_total']}}">
                  {{$order_item['sub_total']}}
                </td>
                </tr>
                @endfor
            </tbody>
          </table>
          <div class="card-footer">
            <div>
              <input type="hidden" name="total_amount" value="{{$request['total_amount']}}">
              <p><b>合計：{{number_format(intval($request['total_amount'])) }}</b></p>
            </div>
            <div class="form-group">
              <label for="description" class="form-label">発注理由・目的</label>
              <input type="hidden" name="description" value="{{$request['description']}}">
              <p>{{$request['description']}}</p>
            </div>
            <div class="mt-1">
              <button type="submit" class="btn btn-secondary" name="back">戻る</button>
              <button type="submit" class="btn btn-primary ml-3">発注</button>
            </div>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
@stop