@extends('Front.Layouts.master')
@section('title', 'Bizimle İletişime Gecin')
@section('bg', 'https://www.bafra.bel.tr/Uploads/Resimler/Sayfalar/2015/3/Iletisim/Bld-3-Iletisim-1032015101254950.jpg')


@section('content')
    <div class="row">
        <div class="col-lg-7">
            @if(session('success'))
            <div class="alert alert-success">
                {{session('success')}}
            </div>
            @endif
            @if($errors -> any())
                <div class="danger alert-danger">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{$error}}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <p>Bizimle İletişime Geçebilirsiniz</p>
            <div class="my-5" >
                <form method="post" action="{{route('contactPost')}}">
                    @csrf
                    <div class="form-group controls mb-3">
                        <label for="name">Ad Soyad</label>
                        <input class="form-control" name="name" type="text" placeholder="Adınızı Girinzi..." required/>
                        <div class="invalid-feedback" data-sb-feedback="name:required">A name is required.</div>
                    </div>
                    <div class="form-group controls mb-3">
                        <label for="email">Email address</label>
                        <input class="form-control mb-3" name="email" type="email" placeholder="Email Adresini Giriniz..."
                               required,email/>
                        <div class="invalid-feedback" data-sb-feedback="email:required">An email is required.</div>
                        <div class="invalid-feedback" data-sb-feedback="email:email">Email is not valid.</div>
                    </div>
                    <div class="control-group mb-3">
                        <div class="form-group controls mb-3">
                            <label for="phone">Konu</label>
                            <select class="form-control mb-3" name="topic" required>
                                <option value="" disabled selected>Konu Seçiniz...</option>
                                <option @if(old('topic')=='Bilgi') selected @endif>Bilgi</option>
                                <option @if(old('topic')=='Destek') selected @endif>Destek</option>
                                <option @if(old('topic')=='Genel') selected @endif>Genel</option>
                            </select>
                        </div>
                    </div>
                    <div class="control-group">
                        <label for="message">Mesajınız</label>
                        <textarea class="form-control mb-3" name="message" placeholder="Mesajınızı Giriniz..."
                                   required>{{old('message')}}</textarea>
                        <div class="invalid-feedback" data-sb-feedback="message:required">A message is required.</div>
                    </div>
                    <br/>
                    <div id="success"></div>
                    <div class="from-group">
                        <button type="submit" class="btn btn-primary" id="sendMessageButton">Gönder</button>
                    </div>
                </form>
            </div>
        </div>

        <div class="col-lg-5">
            <div class="card shadow-sm" style="margin-top: 150px">
                <h5 class="card-header bg-primary text-white">İletişim Bilgilerimiz</h5>
                <div class="card-body">
                    <ul class="list-unstyled mb-0">
                        <li class="mb-3"><i class="fas fa-map-marker-alt mr-2 text-primary"></i> Yeşilevler Mahallesi 77088 Nolu Sokak No 9 Kat 2 Şahinbey/Gaziantep TÜRKİYE</li>
                        <li class="mb-3"><i class="fas fa-phone mr-2 text-primary"></i> +90 531 700 5064</li>
                        <li><i class="fas fa-envelope mr-2 text-primary"></i> omerkose772@gmail.com<br> 222802080@ogr.cbu.edu.tr</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script>
        $(document).ready(function () {
            $('#sendMessageButton').click(function (e) {
                e.preventDefault();

                var formData = $('#contactForm').serialize();

                $.ajax({
                    url: '{{ route("contactPost") }}',
                    type: 'POST',
                    data: formData,
                    success: function (response) {
                        $('#success').html('<div class="alert alert-success">'+response.success+'</div>');
                        $('#contactForm')[0].reset();

                        // Ajax başarılı olduğunda bildirim sayısını artır
                        var currentCount = parseInt($('#messageCount').text());
                        $('#messageCount').text(currentCount + 1);
                    },
                    error: function (xhr, status, error) {
                        $('#success').html('<div class="alert alert-danger">Mesaj gönderilirken hata oluştu.</div>');
                    }
                });
            });
        });
    </script>

@endpush
