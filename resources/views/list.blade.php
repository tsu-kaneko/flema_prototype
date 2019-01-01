@extends('layout.default')

@section('head')

    <script src='bundles/itemList.bundle.js'></script>

@endsection

@section('title', 'Top')

<!--@section('sidebar')
    @@parent

    <p>ここはメインのサイドバーに追加される</p>
@endsection-->

@section('content')
    <h1 class="page-header">トップ</h1>

    <ol class="breadcrumb">
        <li class="active">トップ</li>
    </ol>

    <ItemList></ItemList>

    ・<a href="/create">新規追加</a><br>
    {{-- TODO 自分が出品した商品の一覧画面の作成 --}}
    ・<a href="/">出品した商品の一覧</a>

    <br>
    <br>
    <br>
    <br>
    <br>
    <br>

@endsection