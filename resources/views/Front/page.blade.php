@extends('Front.Layouts.master')
@section('title', $page->title)
@section('bg', asset($page->image))
@section('content')
    <div class="col-lg-8 col-md-9 mx-auto text-break">
        {!! $page->content !!}
    </div>
    @include('Front.widgets.categorieswidget')
@endsection
