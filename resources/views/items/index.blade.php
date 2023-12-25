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
                <div class="card-title item-search">
                    <form action="{{ route('items.index') }}" method="GET" class="form-inline">
                        <div class="input-group">
                            <input type="text" class="form-control" name="keyword" id="keyword"
                                placeholder="商品名orアーティスト名（部分一致）" value="{{old('keyword')}}">
                            <div class="input-group-append">
                                <button type="submit" class="btn btn-secondary">検索</button>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="card-tools" style="display:inline;">
                    <a href="{{ route('items.create') }}" class="btn btn-info">商品登録</a>
                </div>
            </div>

            <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap">
                    <thead>
                        <tr>
                            <th>@sortablelink('id','ID')</th>
                            <th>@sortablelink('name','商品名')</th>
                            <th>@sortablelink('artist','アーティスト')</th>
                            <th>@sortablelink('category', 'カテゴリー')</th>
                            <th>@sortablelink('price', '価格')</th>
                            <th>@sortablelink('quantity', '在庫数')</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($items as $item)
                        <tr onclick="window.location='{{route('items.show', $item)}}'">
                            <td class="align-middle">{{ $item->id }}</td>
                            <td class="align-middle">{{ $item->name }}</td>
                            <td class="align-middle">{{$item->artist}}</td>
                            <td class="align-middle">{{ $item->category }}</td>
                            <td class="align-middle">{{ $item->price }}</td>
                            <td class="align-middle">{{ $item->quantity }}</td>
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
<style>
    tbody tr:hover {
        background-color: #f5f5f5;
        /* 適当な背景色 */
        cursor: pointer;
        /* マウスがポインターになる */
    }
</style>
@stop

@section('js')
@stop