@isset($categories)
    <div class="col-md-3  float-end">
        <div class="card">
            <div class="card-header">
                Kategoriler
            </div>
            <div class="list-group">
                @foreach($categories as $category)
                    <li class="list-group-item {{ Request::segment(2) == $category->slug ? 'active' : '' }}">
                        <a @if(Request::segment(2)!=$category->slug) href="{{route('category',$category->slug)}}" @endif>{{$category->name}}</a>
                    </li>
                @endforeach
            </div>
        </div>
    </div>
@endif
