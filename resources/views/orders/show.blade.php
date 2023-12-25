@extends('adminlte::page')

@section('title', '発注履歴')

@section('content_header')
<h1>発注履歴（ID:{{$order->id}}）</h1>
@stop

@section('content')
<div class="row">
  <div class="col-md-10">
    <div class="card">
      <div class="card-header">
        <p>発注者：{{$order->user->name}}</p>
        <p>発注先：{{$order->company->name}}</p>
      </div>

      <div class="card-body">
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
            @for ($i=0; $i<count($order_items); $i++) @php $order_item=$order_items[$i]; @endphp <tr>
              <td class="align-middle">{{$i+1}}</td>
              <td class="align-middle">
                {{$order_item->item['name']}}
              </td>
              <td class="align-middle">
                {{ number_format(intval($order_item['price'])) }}
              </td>
              <td class="align-middle">
                {{$order_item['quantity']}}
              </td>
              <td class="align-middle">
                {{ number_format(intval($order_item['sub_total'])) }}
              </td>
              </tr>
              @endfor
          </tbody>
        </table>
        <div class="card-footer">
          <div>
            <label for="sub_total">合計：</label>
            <p id="sub_total">{{ number_format(intval($order['total_amount'])) }}</p>
          </div>
          <div class="form-group">
            <label for="description" class="form-label">発注理由・目的</label>
            <p>{{$order['description']}}</p>
          </div>
          <div class="mt-1">
            <a href="{{route('orders.index')}}" class="btn btn-secondary">戻る</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@stop