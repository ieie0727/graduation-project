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
              @for ($i = 1; $i <= 5; $i++) <tr>
                <td>{{ $i }}</td>
                <td>
                  <select class="id" name="order_items[{{$i}}][id]">
                    <option value="" selected disabled></option>
                    @foreach ($items as $item)
                    <option value="{{$item->id}}">{{$item->name}}（{{$item->artist}}）</option>
                    @endforeach
                  </select>
                </td>
                <td>
                  <input type="number" class="price" name="order_items[{{$i}}][price]" value="0" readonly>
                </td>
                <td>
                  <input type="number" class="quantity" name="order_items[{{$i}}][quantity]" value="0" min="0">
                </td>
                <td>
                  <input type="number" class="sub-total" name="order_items[{{$i}}][sub_total]" value="0">
                </td>
                </tr>
                @endfor
            </tbody>
          </table>
          <button type="button" id="addRow" class="btn btn-secondary mb-3"><b>＋</b></button>
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
  #addRow {
    margin: 0 0 0 auto;
    text-align: right;
  }
</style>
@stop


@section('js')
<script>
  /**
   * 
    */
  $(document).ready(()=>{
    $('#addRow').on('click',function(){
      //現在の行数を取得
      let rowCount =$('#orderTableBody tr').length -1; //-1はheader分を調整

      //最大行数を超えていなければ新しい行を挿入
      const maxLength =20;
      if(rowCount<maxLength){
        let i =Number(rowCount)+1;
        let newRow =`<tr>`+
                `<td>${i}</td>`+
                `<td><select class="id" name="order_items[${i}][id]">`+
                    `<option value="" selected disabled></option>`+
                    `@foreach ($items as $item)`+
                    `<option value="{{$item->id}}">{{$item->name}}（{{$item->artist}}）</option>`+
                    `@endforeach`+
                  `</select></td>`+
                `<td><input type="number" class="price" name="order_items[${i}][price]" value="0" readonly></td>`+
                `<td><input type="number" class="quantity" name="order_items[${i}][quantity]" value="0" min="0"></td>`+
                `<td><input type="number" class="sub-total" name="order_items[${i}][sub_total]" value="0"></td>`+
                `</tr>`;
        $('#orderTableBody').append(newRow);
      }else{
        alert("一括注文は20点までです。");
      }
    })
  })

  /**
   * 商品が選択されたら、単価を表示して、小計・合計を更新 
  */
  $(document).ready(()=>{
    $(document).on('input','.id',function(){
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
            updateTotal(thisElm);
          },
          error:function(error){
            console.log('Error',error);
          }
        });
      }
    });
  });

  //個数が入力されたら小計・合計を更新
  $(document).ready(()=>{
    $(document).on('input','.quantity',function(){
      let thisElm =$(this);
      updateTotal(thisElm);
    });
  });


  /*-------------------------------
  小計、合計のアップデート
  -------------------------------*/
  function updateTotal(elm){
    //定義
    let thisRow =elm.closest('tr');
    let price =thisRow.find('.price').val();
    let quantity =thisRow.find('.quantity').val();

    //小計の計算
    //console.log("個数："+quantity, "値段："+price);
    let subTotal =quantity * price;
    thisRow.find('.sub-total').val(subTotal);

    //合計の計算
    let totalAmount =0;
      $('.sub-total').each(function () {
                totalAmount += Number($(this).val());
      });
      $('.total-amount').val(totalAmount);
  }


</script>
@stop