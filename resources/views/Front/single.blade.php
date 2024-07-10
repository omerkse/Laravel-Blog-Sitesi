@extends('Front.Layouts.master')
@section('title', $articles->title)
@section('bg', asset($articles->image))
@section('content')
    <div class="col-md-9 mx-auto text-break">
        {!! $articles->content !!}
    </div>
    @include('front.widgets.categorieswidget')
@endsection
