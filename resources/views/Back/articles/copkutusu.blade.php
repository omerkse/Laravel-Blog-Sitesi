@extends('Back.Layouts.master')
@section('title' ,'Tüm Makaleler')
@section('content')

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"><strong>Bulunan Makaleler</strong>
                <a href="{{route('admin.makaleler.index')}}" class="btn btn-warning btn-sm float-right"><i class="fa fa-backward"></i> Makaleler </a>
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

                        <td style="width: 85px">
                            <a href="{{route('admin.geriyukle', $article->id)}}" title="Geri yükle" class="btn btn-sm btn-primary"><i class="fas fa-redo-alt"></i></a>
                            <a href="{{route('admin.kaldır',$article->id)}}" title="Kaldır" class="btn btn-sm btn-danger"><i class="fas fa-times-circle"></i></a>
                        </td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection
