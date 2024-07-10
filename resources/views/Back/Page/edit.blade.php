@extends('Back.Layouts.master')
@section('title', 'Sayfa Düzenleme')
@section('content')

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"><strong>Bulunan Başlıklar</strong></h6>
        </div>
        <div class="card-body">
            <form method="post" action="{{ route('admin.sayfalar.update', $page->id) }}" enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <div class="form-group">
                    <label>Makale Başlığı</label>
                    <input type="text" name="title" value="{{ $page->title }}" class="form-control">
                </div>
                <div class="form-group">
                    <label>Makale Fotoğrafı</label><br>
                    <img src="{{ asset($page->image) }}" class="rounded">
                    <input type="file" name="image" class="form-control">
                </div>
                <div class="form-group">
                    <label>Makale İçeriği</label>
                    <textarea id="editor" rows="10" name="content" class="form-control">{!! $page->content !!}</textarea>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-block">Güncelle</button>
                </div>
            </form>
        </div>
    </div>

@endsection

@section('css')
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
@endsection

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#editor').summernote({
                height: 275
            });
        });
    </script>
@endsection
