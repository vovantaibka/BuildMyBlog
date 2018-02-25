<main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4" id="categories">
	<input id="current-object" type="hidden" name="current object" value="category_audio">
	<h2>All Categories</h2>
	<div class="button-create-new">
		<button type="button" class="btn btn-primary btn-sm create">
			<svg class="svg-icon" viewBox="0 0 20 20">
				<path d="M14.613,10c0,0.23-0.188,0.419-0.419,0.419H10.42v3.774c0,0.23-0.189,0.42-0.42,0.42s-0.419-0.189-0.419-0.42v-3.774H5.806c-0.23,0-0.419-0.189-0.419-0.419s0.189-0.419,0.419-0.419h3.775V5.806c0-0.23,0.189-0.419,0.419-0.419s0.42,0.189,0.42,0.419v3.775h3.774C14.425,9.581,14.613,9.77,14.613,10 M17.969,10c0,4.401-3.567,7.969-7.969,7.969c-4.402,0-7.969-3.567-7.969-7.969c0-4.402,3.567-7.969,7.969-7.969C14.401,2.031,17.969,5.598,17.969,10 M17.13,10c0-3.932-3.198-7.13-7.13-7.13S2.87,6.068,2.87,10c0,3.933,3.198,7.13,7.13,7.13S17.13,13.933,17.13,10"></path>
			</svg>
			Create Category
		</button>
	</div>
	<div class="table-responsive">
		<table class="table table-striped table-sm">
			<thead>
				<tr>
					<th>#</th>
					<th>Name</th>
					{{-- <th class="text-center">Total Audio</th> --}}
					<th class="text-center" width="170px;">Action</th>
				</tr>
			</thead>
			<tbody>
				@foreach($categories as $category)
				<tr>
					<th>{{ $category->id }}</th>
					<td>{{ $category->name }}</td>
					{{-- <td class="text-center">{{ $category->audios()->count() }}</td> --}}
					<td class="text-center">
						<input type="hidden" name="id" value="{{ $category->id }}">
						<button type="button" class="btn btn-light btn-sm edit">
							<svg class="svg-icon" viewBox="0 0 20 20">
								<path d="M18.303,4.742l-1.454-1.455c-0.171-0.171-0.475-0.171-0.646,0l-3.061,3.064H2.019c-0.251,0-0.457,0.205-0.457,0.456v9.578c0,0.251,0.206,0.456,0.457,0.456h13.683c0.252,0,0.457-0.205,0.457-0.456V7.533l2.144-2.146C18.481,5.208,18.483,4.917,18.303,4.742 M15.258,15.929H2.476V7.263h9.754L9.695,9.792c-0.057,0.057-0.101,0.13-0.119,0.212L9.18,11.36h-3.98c-0.251,0-0.457,0.205-0.457,0.456c0,0.253,0.205,0.456,0.457,0.456h4.336c0.023,0,0.899,0.02,1.498-0.127c0.312-0.077,0.55-0.137,0.55-0.137c0.08-0.018,0.155-0.059,0.212-0.118l3.463-3.443V15.929z M11.241,11.156l-1.078,0.267l0.267-1.076l6.097-6.091l0.808,0.808L11.241,11.156z"></path>
							</svg>
						</button>
						<button type="button" class="btn btn-light btn-sm delete">
							<svg class="svg-icon" viewBox="0 0 20 20">
								<path d="M10.185,1.417c-4.741,0-8.583,3.842-8.583,8.583c0,4.74,3.842,8.582,8.583,8.582S18.768,14.74,18.768,10C18.768,5.259,14.926,1.417,10.185,1.417 M10.185,17.68c-4.235,0-7.679-3.445-7.679-7.68c0-4.235,3.444-7.679,7.679-7.679S17.864,5.765,17.864,10C17.864,14.234,14.42,17.68,10.185,17.68 M10.824,10l2.842-2.844c0.178-0.176,0.178-0.46,0-0.637c-0.177-0.178-0.461-0.178-0.637,0l-2.844,2.841L7.341,6.52c-0.176-0.178-0.46-0.178-0.637,0c-0.178,0.176-0.178,0.461,0,0.637L9.546,10l-2.841,2.844c-0.178,0.176-0.178,0.461,0,0.637c0.178,0.178,0.459,0.178,0.637,0l2.844-2.841l2.844,2.841c0.178,0.178,0.459,0.178,0.637,0c0.178-0.176,0.178-0.461,0-0.637L10.824,10z"></path>
							</svg>	
						</button>
					</td>
				</tr>
				@endforeach
			</tbody>
		</table>
	</div>

	{{-- Modal create and edit category--}}
	<div class="modal fade" id="create-and-edit-category-audio" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content">
				{!! Form::open(['route' => 'categoriesaudio.store', 'method' => 'POST']) !!}
				<div class="modal-header">
					<h5 class="modal-title" id="title-modal-create-edit">Create New Category</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<input type="hidden" name="action" value="create">
					<input type="hidden" name="category_id" value="">

					<div class="form-group">
						{{ Form::label('name', 'Name:') }}
						{{ Form::text('name', null, ['class' => 'form-control', 'required' => '', 'maxlength' => '255']) }}
					</div>
				</div>
				<div class="modal-footer">
					<div class="form-group">
						{{Form::button('Close', ['class' => 'btn btn-secondary', 'data-dismiss' => 'modal'])}}
						{{ Form::submit('Create New Category', ['class' => 'btn btn-primary', 'id' => 'button-submit']) }}
					</div>
				</div>
				{!! Form::close() !!}
			</div>
		</div>	
	</div>

	<script src="{{asset('js/admin/ajax-crud-category-audio.js')}}"></script>

	<script type="text/javascript">
		var formInstance = $('#form-audio').parsley();
	</script>
</main>