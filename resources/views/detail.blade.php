@extends('layout.default')

@section('head')
    <script src='bundles/itemDetail.bundle.js'></script>

    <script>
        var id = @json($id);
    </script>

@section('title', 'Detail')

@section('content')

    <h1 class="page-header">詳細ページ</h1>

    <ol class="breadcrumb">
        <li><a href="/">トップ</a></li>
        <li class="active">詳細</li>
    </ol>

    <ItemDetail></ItemDetail>

@endsection