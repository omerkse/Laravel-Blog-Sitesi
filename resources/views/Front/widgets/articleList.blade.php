@if(count($articles) > 0)
    @php
        $shownArticles = 0;
    @endphp
    @foreach($articles as $artic)
        @if($artic->status == 1)
            <div class="post-preview">
                <a href="{{ route('single', [$artic->getCategory->slug, $artic->slug]) }}">
                    <h2 class="post-title">{{$artic->title}}</h2>
                    <img src="{{asset($artic->image) }}" style="max-width: 100%;">
                    <h3 class="post-subtitle">
                        {!! Str::limit(strip_tags($artic->content),50) !!}
                    </h3>
                </a>
                <p class="post-meta">Kategori:
                    <a href="{{ route('single', [$artic->getCategory->slug, $artic->slug]) }}">{{$artic->getCategory->name}}</a>
                    <span style="float: right;">{{$artic->created_at->diffForHumans()}}</span>
                </p>
            </div>
            @if(!$loop->last)
                <hr class="my-4"/>
            @endif
            @php
                $shownArticles++;
            @endphp
        @endif
    @endforeach

    @if($shownArticles == 0)
        <div class="alert alert-danger">
            <h1>Bu Kategoriye Ait Yazı Bulunamadı</h1>
        </div>
    @endif

    <div class="float-center">
        {{$articles->links('pagination::bootstrap-4')}}
    </div>
@else
    <div class="alert alert-danger">
        <h1>Bu Kategoriye Ait Yazı Bulunamadı</h1>
    </div>
@endif
