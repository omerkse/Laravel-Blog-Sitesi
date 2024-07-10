@extends('Front.Layouts.master')
@section('content')

    <div class="col-md-9 mx-auto text-break">
        @include('Front.widgets.articleList')

    </div>
    @include('Front.widgets.categorieswidget')
@endsection

