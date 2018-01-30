@extends('main')

@section('title', '| Create New Post')

@section('stylesheets')
{!!Html::style('css/parsley.css')!!}
{!!Html::style('css/select2.min.css')!!}

<script src='https://cloud.tinymce.com/stable/tinymce.min.js?apiKey=5g5faf78gvk6yfq9bd3bbfjo858kjx1q8o0nbiwtygo2e4er'></script>

<script>
    tinymce.init({
        selector: 'textarea',
        plugins: "link code image",
        menubar: false

    });
</script>

@endsection

@section('content')

<div class="row">
    <div class="col-md-8 col-md-offset-2">
        <h1>Create New Post</h1>

        {{-- Info https://laravelcollective.com/docs/5.3/html --}}
        {{-- Để validate data từ form thì sử dụng parsleyjs - Đây là một library của js - Info http://parsleyjs.org/doc/index.html --}}
        {!! Form::open(['route' => 'posts.store', 'data-parsley-validate' => '', 'files' => true]) !!}
        {{Form::label('title', 'Title:')}}
        {{Form::text('title', null, ['class' => 'form-control', 'required' => '', 'maxlength' => '255'])}}

        {{Form::label('slug', 'Slug:')}}
        {{Form::text('slug', null, ['class' => 'form-control', 'required' => '', 'minlength' => '5', 'maxlength' => '255'])}}

        {{ Form::label('category_id', 'Category:') }}
        <select class="form-control" name="category_id">
            @foreach($categories as $category)
            <option value="{{ $category->id }}">{{ $category->name }}</option>
            @endforeach
        </select>

        {{ Form::label('tags', 'Tags:') }}
        <select class="form-control select2-multi" name="tags[]" multiple="multiple">
            @foreach($tags as $tag)
            <option value="{{ $tag->id }}">{{ $tag->name }}</option>
            @endforeach
        </select>

        {{ Form::label('featured_image', 'Upload Featured Image:') }}
        {{ Form::file('featured_image', ['class' => 'form-control', 'style' => 'margin-bottom: 5px']) }}

        {{Form::label('body', "Post Body:")}}
        {{Form::textarea('body', null, ['class' => 'form-control'])}}

        {{Form::submit('Create Post', ['class' => 'btn btn-success btn-lg btn-block', 'style' => 'margin-top: 20px;'])}}
        {!! Form::close() !!}
        <hr>
    </div>
</div>

@endsection

@section('scripts')

{!! Html::script('js/parsley.min.js') !!}
{!! Html::script('js/select2.min.js') !!}

<script type="text/javascript">
    $('.select2-multi').select2();
</script>

@endsection