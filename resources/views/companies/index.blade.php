@extends('adminlte::page')

@section('title', '取引先一覧')

@section('content_header')
<h1>取引先一覧</h1>
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
        <h3 class="card-title">取引先一覧</h3>
        <div class="card-tools">
          <div class="input-group input-group-sm">
            <div class="input-group-append">
              <a href="{{ route('companies.create') }}" class="btn btn-info">新規登録</a>
            </div>
          </div>
        </div>
      </div>
      <div class="card-body table-responsive p-0">
        <table class="table table-hover text-nowrap">
          <thead>
            <tr>
              <th>ID</th>
              <th>会社名</th>
              <th>住所</th>
              <th>メールアドレス</th>
              <th>電話番号</th>
              <th>最終取引日</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($companies as $company)
            <tr onclick="window.location='{{route('companies.show', $company)}}'">
              <td class="align-middle">{{ $company->id }}</td>
              <td class="align-middle">{{ $company->name }}</td>
              <td class="align-middle">{{ $company->address }}</td>
              <td class="align-middle">{{ $company->email }}</td>
              <td class="align-middle">{{ $company->phone_number }}</td>
              <td class="align-middle">{{ $company->last_transaction_at }}</td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
    {{ $companies->links('pagination::bootstrap-4') }}
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
<script>

</script>
@endsection