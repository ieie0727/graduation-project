@extends('adminlte::page')

@section('title', '商品詳細')

@section('content_header')
<h1>商品詳細（ID:{{$item->id}}）</h1>
@stop

@section('content')
<div class="row">
  <div class="col-md-10">
    <div class="card card-primary">
      @if(session('flash_message'))
      <div class="alert alert-success">
        {{ session('flash_message') }}
      </div>
      @endif
      <div class="card-body">
        <div class="form-group">
          <label for="name">商品名</label>
          <p>{{ $item->name }}</p>
        </div>

        <div class="form-group">
          <label for="artist">アーティスト名</label>
          <p>{{ $item->artist }}</p>
        </div>

        <div class="form-group">
          <label for="category">カテゴリー</label>
          <p>{{ $item->category }}</p>
        </div>

        <div class="form-group">
          <label for="price">価格</label>
          <p>{{ $item->price }}</p>
        </div>

        <div class="form-group">
          <label for="detail">詳細</label>
          <p>{{ $item->detail }}</p>
        </div>

        <div class="form-group">
          <label for="image">商品画像</label><br>
          @if ($item->image_name)
          <img src="{{ asset('images_uploaded/items/' . $item->image_name) }}" alt="商品画像" class="img-thumbnail"
            width="150px" height="150px">
          @else
          <p>画像未添付</p>
          @endif
        </div>
      </div>

      <div class="card-footer">
        <a href="{{ route('items.index') }}" class="btn btn-secondary">戻る</a>
        <a href="{{ route('items.edit', compact('item')) }}" class="btn btn-primary ml-3">更新</a>
        <form action="{{ route('items.destroy', compact('item')) }}" method="POST"
          onsubmit="return confirm('本当に削除しますか？')" id="item_delete_button" class="ml-3" style="display: inline;">
          @csrf
          @method('delete')
          <button type="submit" class="btn btn-danger">削除</button>
        </form>
      </div>
    </div>
  </div>
</div>
@stop

@section('css')
@stop

@section('js')
@stop