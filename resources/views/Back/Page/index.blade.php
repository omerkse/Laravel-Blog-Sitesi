@extends('Back.Layouts.master')
@section('title' ,'Sayfalar')
@section('content')

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"><strong>Bulunan Makaleler</strong>
            </h6>

        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable">
                    <thead>
                    <tr>
                        <th>Fotoğraf</th>
                        <th>Sayfa Başlığı</th>
                        <th>İşlemleri</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($pages as $page)
                        <tr>
                            <td><img src="{{ asset($page->image) }}" width="175"></td>
                            <td>{{$page->title}}</td>
                            <td style="width: 200px; text-align: center;">
                                <a href="{{route('page',$page->slug)}}" target="_blank" title="Görüntüle" class="btn btn-sm btn-success"><i
                                        class="fa fa-eye"></i></a>
                                <a href="{{route('admin.sayfalar.edit',$page->id)}}" title="Düzenle" class="btn btn-sm btn-primary"><i class="fa fa-pen"></i></a>
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
                statu = $(this).prop('checked')

                $.get("{{ route('admin.checkbox') }}", {id: id, statu: statu}, function (data, status) {

                });
            });
        });
    </script>
@endpush
