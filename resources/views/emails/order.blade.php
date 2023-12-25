@php
use App\Models\Item;
@endphp

<h2>{{ $company['name'] }}様</h2>
<p>
  いつもお世話になっております。 以下の商品の発注をお願い致します。
</p>

<table border="1">
  <thead>
    <tr>
      <th>No.</th>
      <th>商品名（アーティスト名）</th>
      <th>単価</th>
      <th>発注数</th>
      <th>小計</th>
    </tr>
  </thead>
  <tbody>
    @for ($i = 0; $i < count($order_items); $i++) @php $order_item=$order_items[$i];
      $item=Item::find($order_item['item_id']); @endphp <tr>
      <td class="align-middle">{{ $i + 1 }}</td>
      <td class="align-middle">{{ $item['name'].'（'.$item['artist'].'）' }}</td>
      <td class="align-middle">{{ number_format($item['price'], 0, '.', ',') }}</td>
      <td class="align-middle">{{ $order_item['quantity'] }}</td>
      <td class="align-middle">{{ number_format($order_item['sub_total'], 0, '.', ',') }}</td>
      </tr>
      @endfor
  </tbody>
</table>

<p><b>合計：￥{{ number_format($order['total_amount'], 0, '.', ',') }}</b></p>