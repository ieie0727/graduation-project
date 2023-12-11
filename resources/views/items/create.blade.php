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
        <div class="card-header">
            <div class="card-tools">
                <form action="{{ route('items.import') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <label for="csv_file">CSVファイルを選択：</label>
                    <input type="file" name="csv_file" accept=".csv">
                    <button type="submit" class="ml-3">一括登録</button>
                </form>
            </div>
        </div>
        <div class="card card-primary">
            <form method="POST" action="{{route('items.store')}}" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label for="name">商品名（必須）</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="商品名"
                            value="{{old('name')}}">
                    </div>

                    <div class="form-group">
                        <label for="artist">アーティスト名（必須）</label>
                        <input type="text" class="form-control" id="artist" name="artist" placeholder="名前"
                            value="{{old('artist')}}">
                    </div>

                    <div class="form-group">
                        <label for="category">カテゴリー（必須）</label>
                        <input type="text" class="form-control" id="category" name="category" placeholder="カテゴリー"
                            value="{{old('category')}}">
                    </div>

                    <div class="form-group">
                        <label for="price">価格（必須）</label>
                        <input type="number" class="form-control" id="price" name="price" min="0" max="1000000"
                            value="{{old('price')}}">
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