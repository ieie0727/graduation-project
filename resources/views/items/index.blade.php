@extends('adminlte::page')

@section('title', '商品一覧')

@section('content_header')
<h1>商品一覧</h1>
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
                <h3 class="card-title">商品一覧</h3>
                <div class="card-tools">
                    <div class="input-group input-group-sm">
                        <div class="input-group-append">
                            <a href="{{ route('items.create') }}" class="btn btn-info">商品登録</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>商品名</th>
                            <th>アーティスト</th>
                            <th>カテゴリー</th>
                            <th>価格</th>
                            <th>在庫数</th>
                            <th>ジャケット</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($items as $item)
                        <tr>
                            <td>{{ $item->id }}</td>
                            <td>{{ $item->name }}</td>
                            <td>{{$item->artist}}</td>
                            <td>{{ $item->category }}</td>
                            <td>{{ $item->price }}</td>
                            <td>{{ $item->quantity }}</td>
                            <td>
                                @if($item->image_name)
                                <img src="{{asset('images_uploaded/items/'.$item->image_name)}}" alt="" width="30px"
                                    height="30px">
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        {{ $items->links('pagination::bootstrap-4') }}
    </div>
</div>
@stop

@section('css')
@stop

@section('js')
@stop