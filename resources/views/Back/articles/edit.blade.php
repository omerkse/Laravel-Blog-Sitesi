@extends('Back.Layouts.master')
@section('title' ,$article->title.' Makalesini Güncelle')
@section('content')

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"><strong>Bulunan Makale</strong> </h6>
        </div>
        <div class="card-body">

                <form method="post" action="{{route('admin.makaleler.update',$article->id)}}" enctype="multipart/form-data">
                    @method('PUT')
                    @csrf
                    <div class="form-group">
                        <label>Makale Başlığı</label>
                        <input type="text" name="title" value="{{$article->title}}" class="form-control" >
                    </div>
                    <div class="form-group">

                        <label>Makale Kategori</label>
                        <select  name="category" class="form-control">
                            <option value="">Seçim Yapınız</option>
                            @foreach($categories as $category)
                                <option
                                   @if($article->category_id == $category->id) selected @endif value="{{$category->id}}">{{$category->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Makale Fotoğrafı</label><br>
                        <img src="{{asset($article->image)}}" class="rounded">
                        <input type="file" name="image"  class="form-control" >
                    </div>
                    <div class="form-group">
                        <label>Makale İçeriği</label>
                        <textarea id="editor" rows="10" name="content"  class="form-control" >{!! $article->content !!}</textarea>
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

@push('js')

    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#editor').summernote(
                {
                    'height': 275
                }
            );
        });
    </script>
@endpush
