@extends('adminlte::page')

@section('title', '商品登録')

@section('content_header')
<h1>商品登録</h1>
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
            <form method="POST" action="{{route('items.store')}}" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label for="name">商品名</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="商品名"
                            value="{{old('name')}}">
                    </div>

                    <div class="form-group">
                        <label for="artist">アーティスト名</label>
                        <input type="text" class="form-control" id="artist" name="artist" placeholder="名前"
                            value="{{old('artist')}}">
                    </div>

                    <div class="form-group">
                        <label for="category">カテゴリー</label>
                        <input type="text" class="form-control" id="category" name="category" placeholder="カテゴリー"
                            value="{{old('category')}}">
                    </div>

                    <div class="form-group">
                        <label for="detail">詳細</label>
                        <textarea class="form-control" name="detail" id="detail"
                            style="height: 100px">{{old('detail')}}</textarea>
                    </div>

                    <div class="form-group">
                        <label for="image">画像添付</label><br>
                        <input type="file" name="image" id="image" class="item-control form-control-sm">
                    </div>
                </div>

                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">登録</button>
                </div>
            </form>
        </div>
    </div>
</div>
@stop

@section('css')
@stop

@section('js')
@stop