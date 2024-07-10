@extends('Front.Layouts.master')
@section('title', $category->name )
@section('content')
    <div class="col-md-9 mx-auto text-break">
        @include('Front.widgets.articleList')
    </div>
    @include('front.widgets.categorieswidget')
@endsection
