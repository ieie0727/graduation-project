@extends('adminlte::page')

@section('title', '新規発注')

@section('content_header')
<h1>新規発注</h1>
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
      <form method="POST" action="{{route('orders.store')}}">
        @csrf
        <div class="card-body">
          <table class="table">
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
              @for ($i = 1; $i <= 5; $i++) <tr>
                <td>{{ $i }}</td>
                <td>
                  <select class="id" id="id-{{$i}}" name="order_items[{{$i}}][id]">
                    <option value="" selected disabled></option>
                    @foreach ($items as $item)
                    <option value="{{$item->id}}">{{$item->name}}（{{$item->artist}}）</option>
                    @endforeach
                  </select>
                </td>
                <td>
                  <input type="number" class="price" id="price-{{$i}}" name="order_items[{{$i}}][price]" value="0"
                    readonly>
                </td>
                <td>
                  <input type="number" class="quantity" id="quantity-{{$i}}" name="order_items[{{$i}}][quantity]"
                    value="0" min="0">
                </td>
                <td>
                  <input type="number" class="sub-total" id="sub-total-{{$i}}" name="order_items[{{$i}}][sub_total]"
                    value="0">
                </td>
                </tr>
                @endfor
            </tbody>
          </table>
          <div class="card-footer">
            <div>
              <label for="total-amount">合計：</label>
              <input type="number" class="total-amount" id="total-amount" name="total_amount" value="0" readonly>
            </div>
            <div class="form-group">
              <label for="description" class="form-label">発注理由・目的（必須）</label>
              <textarea name="description" id="description" cols="20" rows="3" class="form-control" required></textarea>
            </div>
            <div class="mt-1">
              <button type="submit" class="btn btn-primary">発注</button>
            </div>
          </div>

        </div>
      </form>
    </div>
  </div>
</div>
@stop

@section('css')
<style>
  .total-amount {
    text-align: right;
  }
</style>
@stop


@section('js')
<script>
  /*--------------------------------
  //商品が選択されたら、単価を表示する
  --------------------------------*/
  $(document).ready(()=>{
    $('.id').on('input',function(){
      let thisElm =$(this);
      let thisRow =thisElm.closest('tr');
      let itemId =thisElm.val();
      //console.log(itemId);
      
      if(itemId){
        $.ajax({
          type:'GET',
          url: "/items/get/"+itemId,

          success:function(response){
            thisRow.find('.price').val(response.price);
          },
          error:function(error){
            console.log('Error',error);
          }
        });
      }
      
    });
  });

  
  /*------------------------------------
  //個数を入力したら小計と合計が更新される
  ------------------------------------*/
  
  $(document).ready(()=>{
    $('.quantity').on('input',function(){
      let thisElm =$(this);
      let thisRow =thisElm.closest('tr');

      //小計の計算
      let quantity =thisElm.val();
      let price =thisRow.find('.price').val();
      //console.log("個数："+quantity, "値段："+price);
      let subTotal =quantity * price;
      thisRow.find('.sub-total').val(subTotal);

      
      //合計の計算
      let totalAmount =0;
      $('.sub-total').each(function () {
                totalAmount += Number($(this).val());
      });
      $('.total-amount').val(totalAmount);
      
    });
  });
  

</script>
@stop