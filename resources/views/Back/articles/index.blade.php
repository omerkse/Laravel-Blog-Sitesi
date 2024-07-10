@extends('Back.Layouts.master')
@section('title' ,'Tüm Makaleler')
@section('content')

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"><strong>Bulunan Makaleler</strong>
                <a href="{{route('admin.copkutusu')}}" class="btn btn-warning btn-sm float-right"><i class="fa fa-trash"></i> Çöp Kutusu </a>
            </h6>

        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable">
                    <thead>
                    <tr>
                        <th>Fotoğraf</th>
                        <th>Makale Başlığı</th>
                        <th>Kategori</th>
                        <th>Oluşturma Tarihi</th>
                        <th>Tıklanma </th>
                        <th>Durum </th>
                        <th style="width: 85px">İşlemleri</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($articles as $article)
                    <tr>
                        <td><img src="{{asset($article->image)}}" width="175"></td>
                        <td>{{$article->title}}</td>
                        <td>{{$article->getCategory->name}}</td>
                        <td>{{$article->created_at->diffForHumans()}}</td>
                        <td>{{$article->hit}}</td>
                        <td><input class="switch" type="checkbox" article-id="{{$article->id}}" @if($article->status ==1) checked @endif  data-toggle="toggle" data-onstyle="success" data-offstyle="danger"></td>
                        <td style="width: 85px">
                            <a href="{{route('single',[$article->getCategory->slug,$article->slug])}}" target="_blank" title="Görüntüle" class="btn btn-sm btn-success"><i class="fa fa-eye"></i></a>
                            <a href="{{route('admin.makaleler.edit', $article->id)}}" title="Düzenle" class="btn btn-sm btn-primary"><i class="fa fa-pen"></i></a>
                            <a href="{{route('admin.delete',$article->id)}}" title="Sil" class="btn btn-sm btn-danger"><i class="fa fa-times"></i></a>
                        </td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection
@section('css')
    <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
@endsection

@push('js')
    <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
    <script>
        $(function () {
            $('.switch').change(function () {
                id = $(this).attr('article-id');
                statu= $(this).prop('checked')

                $.get("{{ route('admin.checkbox') }}", {id: id, statu:statu}, function(data,status) {

                });
            });
        });
    </script>
@endpush
