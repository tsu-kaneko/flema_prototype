@extends('layout.default')

@section('head')

<script src='bundles/itemCreate.bundle.js'></script>

    <script>
        var mainCategories = @json($mainCategories);
        {{--var subCategories = @json($subCategories);--}}
        {{--var categories = @json($categories);--}}
    </script>

@endsection

@section('title', 'Create')

<!--@section('sidebar')
    @@parent

    <p>ここはメインのサイドバーに追加される</p>
@endsection-->

@section('content')
    <h1 class="page-header">商品の出品</h1>

    <ol class="breadcrumb">
        <li><a href="/">トップ</a></li>
        <li class="active">商品の出品</li>
    </ol>

    <ItemCreate></ItemCreate>
@endsection