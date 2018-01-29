@extends('main')

@section('title', '| Blog')

@section('content')

<div id="blog">
    <div class="row">
        <div class="col-md-8">
            <h1 style="text-indent: 20px;">Blog</h1>
        </div>
    </div>
    <hr>
    @foreach($posts as $post)
    <div class="row">
        <div class="col-md-8">
            <div class="post">
                <img src="{{ asset('imgs/' . $post->image) }}">

                <div class="title">
                    <h2>{{ $post->title }}</h2>
                    <h5>Published: {{ date('M j, Y', strtotime($post->created_at)) }}</h5>
                </div>

                <p>{{ substr(strip_tags($post->body), 0, 250) }}{{ strlen(strip_tags($post->body)) > 250 ? "..." : "" }}</p>

                <a href="{{ route('blog.single', $post->slug) }}" class="btn btn-primary">Read More</a>
            </div>
        </div>
    </div>
    <hr>
    @endforeach

    <div class="row">
        <div class="col-md-12">
            <div class="text-center">
                {!! $posts->links() !!}
            </div>
        </div>
    </div>
</div>

@endsection