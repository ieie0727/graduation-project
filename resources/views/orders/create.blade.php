@php
use Illuminate\Http\Request;
@endphp

@extends('adminlte::page')

@section('title', '新規発注')

@section('content_header')
<h1>新規発注</h1>
@stop

@section('content')
<div class="row">
  <div class="col-md-10">
    @if (session('flash_message'))
    <div class="alert alert-danger">
      {{session('flash_message')}}
    </div>
    @endif
    @if ($errors->any())
    <div class="alert alert-danger">
      <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
    @endif

    <div class="card">
      <div class="card-header">
        <span class="align-middle">※商品を発注するためには、先に<a href="{{route('items.create')}}"
            target="_blank">商品登録</a>をする必要があります。</span>
      </div>
      <div class="card-primary">

        <div class="card-body">
          <form method="POST" action="{{route('orders.confirm')}}">
            @csrf
            <label class="form-label" for="company_id">発注先：</label>
            <select class="form-select" id="company_id" name="company_id" required>
              <option value="0" selected></option>
              @foreach ($companies as $company)
              <option value="{{$company->id}}" {{old('company_id')==$company->id ? 'selected' : ''}}>
                {{$company->name}}
              </option>
              @endforeach
            </select>
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
                @php
                $length =5;
                $now_length = old('order_items') ? count(old('order_items')) : 0;
                if($now_length > $length){
                $length =$now_length;
                }
                @endphp
                @for ($i = 1; $i <= $length; $i++) <tr>
                  <td class="align-middle">{{ $i }}</td>
                  <td class="align-middle">
                    <select class="id" name="order_items[{{$i}}][id]">
                      <option value="0" selected></option>
                      @foreach ($items as $item)
                      <option value="{{$item->id}}" {{ old('order_items.' . $i . '.id' )==$item->id ? 'selected' : ''
                        }}>
                        {{$item->name}}（{{$item->artist}}）
                      </option>
                      @endforeach
                    </select>
                  </td>

                  <td class="align-middle"> {{--lavelタグで表示--}}
                    <input type="number" class="price" name="order_items[{{$i}}][price]"
                      value="{{ old('order_items.'.$i.'.price', 0) }}" readonly>
                  </td>
                  <td class="align-middle">
                    <input type="number" class="quantity" name="order_items[{{$i}}][quantity]"
                      value="{{old('order_items.'.$i.'.quantity',0)}}" min="0">
                  </td>

                  <td class="align-middle">{{--lavelで表示--}}
                    <input type="number" class="sub-total" name="order_items[{{$i}}][sub_total]"
                      value="{{old('order_items.'.$i.'.sub_total',0)}}" readonly>
                  </td>
                  </tr>
                  @endfor
              </tbody>
            </table>
            <button type="button" id="addRow" class="btn btn-secondary mb-3"><b>＋</b></button>
            <div class="card-footer">
              <div>
                <label for="total-amount">合計：</label>
                <input type="number" class="total-amount" id="total-amount" name="total_amount"
                  value="{{ old('total_amount',0) }}" readonly>
              </div>
              <div class="form-group">
                <label for="description" class="form-label">発注理由・目的（必須）</label>
                <textarea name="description" id="description" cols="20" rows="3" class="form-control"
                  required>{{old('description')}}</textarea>
              </div>
              <div class="mt-1">
                <button type="submit" class="btn btn-primary">確認</button>
              </div>
            </div>
        </div>
        </form>
      </div>
    </div>
  </div>
</div>
@stop

@section('css')
@stop


@section('js')
<script>
  /**
   * selectが押されたら選択肢を更新する
   * 
  */
  $(document).ready(()=>{
    $('.id').on('click',function(){
      //alert("1");
      let thisElm =$(this);
      let thisRow =thisElm.closest('tr');
      let id =thisElm.val();

      $.ajax({
        type:'GET',
        url:'/items/all/items',
        dataType: 'json',

        success:function(response){
          let newOptions = '<option value="0" selected></option>';
                response.forEach(item => {
                  if(item.id==id){
                    newOptions += `<option value="${item.id}" selected>${item.name}（${item.artist}）</option>`;
                  }else{
                    newOptions += `<option value="${item.id}" >${item.name}（${item.artist}）</option>`;
                  }
                });

                // 現在のセレクトボックスに新しい選択肢を設定
                thisElm.children().remove();
                thisElm.append(newOptions);

        },
        error:function(error){
          console.log('Error',error);
        },
      });
    });
  });
  
  /**
  * 「＋」ボタンを押したら行が増える
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
                `<td class="align-middle">${i}</td>`+
                `<td class="align-middle"><select class="id" name="order_items[${i}][id]">`+
                    `<option value="" selected disabled></option>`+
                    `@foreach ($items as $item)`+
                    `<option value="{{$item->id}}">{{$item->name}}（{{$item->artist}}）</option>`+
                    `@endforeach`+
                  `</select></td>`+
                `<td class="align-middle"><input type="number" class="price" name="order_items[${i}][price]" value="0" readonly></td>`+
                `<td class="align-middle"><input type="number" class="quantity" name="order_items[${i}][quantity]" value="0" min="0"></td>`+
                `<td class="align-middle"><input type="number" class="sub-total" name="order_items[${i}][sub_total]" value="0"></td>`+
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
            let price = response.price ?? 0;
            thisRow.find('.price').val(price);
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