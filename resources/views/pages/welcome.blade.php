@extends('main')

@section('title', '| Homepage')

@section('content')
<div id="welcome">
    <link rel="stylesheet" href="{{ URL::asset('css/freestyle.css') }}"/>
    <div class="row" id="introduce">
        <div class="col-md-12">
            <div class="welcome-blog">
                <img src="{{ asset('imgs/ksenia-makagonova-227168.jpg') }}" class="img-responsive img-thumbnail"
                alt="Welcome image">
                <p style="margin-top: 10px">   ❝Thời trẻ dại, chúng mình thường hỏi nhau sẽ chọn cuộc đời bình lặng hay bão
                    giông. Hồi đấy mình bảo mình sẽ chọn bão giông. Vì phải trải qua thử thách con người mới khôn lớn,
                    trưởng thành được. Cuộc sống dễ dàng quá sẽ làm người ta yếu ớt đi. Giờ nghĩ lại, có khi mình sẽ
                chọn bình yên. Vì cuộc đời, chẳng cần chọn, cũng vẫn đầy giông bão mà thôi...❞</p>
            </div>
        </div>
    </div> <!-- end of header .row -->

    <div class="row" id="posts">
        <div class="col-md-8 col-md-offset-1">
            @foreach($posts as $post)
            <div class="post">
                <img src="{{ asset('imgs/' . $post->image) }}">
                <h3>{{ $post->title }}</h3>
                <p>{{ substr(strip_tags($post->body), 0, 300) }}{{ strlen(strip_tags($post->body)) >= 300 ? "..." :"" }}</p>
                <a href="{{ url('blog/' . $post->slug) }}" class="btn btn-primary">Đọc thêm</a>
            </div>
            <hr>
            @endforeach
        </div>
    </div>
</div>
@endsection

