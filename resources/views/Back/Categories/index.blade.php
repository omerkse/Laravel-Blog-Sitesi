<!-- resources/views/Back/Categories/index.blade.php -->
@extends('Back.Layouts.master')
@section('title', 'Kategori Eklem Silme')
@section('content')

    <div class="row">

        <div class="col-md-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Yeni Kategori Oluştur</h6>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('admin.kategori.create') }}">
                        @csrf
                        <div class="form-group">
                            <label>Kategori Adı</label><br>
                            <input type="text" class="form-control" name="category" required>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-block btn-sm"> Ekle</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Mevcut Kategoriler</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable">
                            <thead>
                            <tr>
                                <th>Kategori Adı</th>
                                <th>Makale Sayısı</th>
                                <th>İşlemler</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($categories as $category)
                                <tr>
                                    <td>{{ $category->name }}</td>
                                    <td>{{ $category->articles()->count() }} Makale Mevcut</td>
                                    <td style="width: 85px">
                                        <a category-id="{{$category->id}}" title="Düzenle"
                                           class="btn btn-sm btn-primary edit-click"><i
                                                class="fa fa-edit text-white"></i></a>
                                        <a category-id="{{$category->id}}" title="Sil"
                                           class="btn btn-sm btn-danger silme-click"><i class="fa fa-times"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div  class="modal fade edit-modal" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">

                    <h4 class="modal-title" style="float: left;">Kategori Düzenle</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <form method="post" action="{{route('admin.kategori.update')}}">
                        @csrf
                        <div class="form-group">
                            <label>Kategori Adı</label>
                            <input class="edit-category form-control" type="text" name="category">
                            <input type="hidden" class="edit-category-id" name="id">
                        </div>
                        <div class="form-group">
                            <label>Kategori Slug</label>
                            <input class="edit-slug form-control" type="text" name="slug">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Kapat</button>
                            <button type="submit" class="btn btn-default" >Kaydet</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Kategoriyi Sil</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body alert alert-danger">
                    Silmek İstediğinize Emin misiniz? <br>
                    Bu Kategoriye Ait Makalelerde Silinecektir
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">İptal</button>
                    <form id="deleteForm" action="" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Sil</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('css')
@endsection

@push('js')

    <script>
         $(document).ready(() => {
             $(document).on('click', '.silme-click', function () {
                 var id = $(this).attr('category-id');

                 var url = '{{ route("admin.kategori.silme", ":id") }}';
                 url = url.replace(':id', id);
                 $('#deleteForm').attr('action', url);
                 $('#deleteModal').modal('show');
             });

             $(document).on('click','.edit-click',function () {
                 var id = $(this).attr('category-id');
                 $.ajax({
                     type: 'GET',
                     url: '{{ route('admin.kategori.edit') }}',
                     data: { id: id },
                     success: function (data) {
                         $('.edit-category').val(data.name);
                         $('.edit-slug').val(data.slug);
                         $('.edit-category-id').val(data.id);
                         $('.edit-modal').modal('show');

                     }
                 })
             })


             $('.switch').change(function () {
                 id = $(this).attr('article-id');
                 statu = $(this).prop('checked')

                 $.get("{{ route('admin.checkbox') }}", {id: id, statu: statu}, function (data, status) {

                 });
             });
         })
    </script>
@endpush
