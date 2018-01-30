@extends('admin.main')

@section('admin-stylesheets')
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
<input id="object" type="hidden" name="object" value="{{ $object }}">
<main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4"></main>
@endsection

@section('scripts')
{{-- Process Ajax CRUD --}}
<script src="{{asset('js/admin/ajax-load-data.js')}}"></script>
@endsection