<main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4" id="audios">
	<input id="current-object" type="hidden" name="current object" value="audio">
	<h2>All Audios</h2>
	<div class="button-create-new">
		<button type="button" class="btn btn-primary btn-sm create">
			<svg class="svg-icon" viewBox="0 0 20 20">
				<path d="M14.613,10c0,0.23-0.188,0.419-0.419,0.419H10.42v3.774c0,0.23-0.189,0.42-0.42,0.42s-0.419-0.189-0.419-0.42v-3.774H5.806c-0.23,0-0.419-0.189-0.419-0.419s0.189-0.419,0.419-0.419h3.775V5.806c0-0.23,0.189-0.419,0.419-0.419s0.42,0.189,0.42,0.419v3.775h3.774C14.425,9.581,14.613,9.77,14.613,10 M17.969,10c0,4.401-3.567,7.969-7.969,7.969c-4.402,0-7.969-3.567-7.969-7.969c0-4.402,3.567-7.969,7.969-7.969C14.401,2.031,17.969,5.598,17.969,10 M17.13,10c0-3.932-3.198-7.13-7.13-7.13S2.87,6.068,2.87,10c0,3.933,3.198,7.13,7.13,7.13S17.13,13.933,17.13,10"></path>
			</svg>
			Create Audio
		</button>
	</div>
	<div class="table-responsive">
		<table class="table table-striped table-sm">
			<thead>
				<tr>
					<th>#</th>
					<th>Title</th>
					<th>Image</th>
					{{-- <th>Link</th> --}}
					<th>Introduce</th>
					<th>Created At</th>
					<th>Last Updated</th>
					<th class="text-center" width="170px;">Action</th>
				</tr>
			</thead>
			<tbody>
				@foreach($audios as $audio)
				<tr>
					<th>{{ $audio->id }}</th>
					<th>{{ $audio->title }}</th>
					<td>
						<img src="{{ asset('imgs/' . $audio->image) }}">
					</td>
					{{-- <td class="link">{{ substr($audio->link, 0, 40) . (strlen($audio->link) > 40 ? "..." : "") }}</td> --}}
					<td>{{ substr($audio->introduce, 0, 50) . (strlen($audio->introduce) > 50 ? "..." : "") }}</td>
					<td>{{ date('M j, Y H:i', strtotime($audio->created_at)) }}</td>
					<td>{{ date('M j, Y H:i', strtotime($audio->updated_at)) }}</td>
					<td class="text-center">
						<input type="hidden" name="id" value="{{ $audio->id }}">
						<button type="button" class="btn btn-light btn-sm view">
							<svg class="svg-icon" viewBox="0 0 20 20">
								<path d="M10,6.978c-1.666,0-3.022,1.356-3.022,3.022S8.334,13.022,10,13.022s3.022-1.356,3.022-3.022S11.666,6.978,10,6.978M10,12.267c-1.25,0-2.267-1.017-2.267-2.267c0-1.25,1.016-2.267,2.267-2.267c1.251,0,2.267,1.016,2.267,2.267C12.267,11.25,11.251,12.267,10,12.267 M18.391,9.733l-1.624-1.639C14.966,6.279,12.563,5.278,10,5.278S5.034,6.279,3.234,8.094L1.609,9.733c-0.146,0.147-0.146,0.386,0,0.533l1.625,1.639c1.8,1.815,4.203,2.816,6.766,2.816s4.966-1.001,6.767-2.816l1.624-1.639C18.536,10.119,18.536,9.881,18.391,9.733 M16.229,11.373c-1.656,1.672-3.868,2.594-6.229,2.594s-4.573-0.922-6.23-2.594L2.41,10l1.36-1.374C5.427,6.955,7.639,6.033,10,6.033s4.573,0.922,6.229,2.593L17.59,10L16.229,11.373z"></path>
							</svg>
						</button>
						<button type="button" class="btn btn-light btn-sm edit" data-toggle="modal" data-target="#edit-post">
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

	{{-- Modal create and edit audio--}}
	<div class="modal fade" id="create-and-edit-audio" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content">

				{{-- Info https://laravelcollective.com/docs/5.3/html --}}
				{{-- Để validate data từ form thì sử dụng parsleyjs - Đây là một library của js - Info http://parsleyjs.org/doc/index.html --}}
				{!! Form::open(['route' => 'audios.store', 'data-parsley-validate' => '', 'files' => true, 'id' => 'form-audio']) !!}
				<div class="modal-header">
					<h5 class="modal-title" id="title-modal-create-edit">Create New Audio</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<input type="hidden" name="action" value="create">
					<input type="hidden" name="audio_id" value="">

					<div class="form-group">
						{{Form::label('title', 'Title:')}}
						{{Form::text('title', null, ['class' => 'form-control', 'required' => '', 'maxlength' => '255'])}}
					</div>

					<div class="form-group upload-file">
						<img src="#">
						{{ Form::label('audio_image', 'Image Audio:') }}
						{{ Form::file('audio_image', ['class' => '']) }}
					</div>

					<div class="form-group">
						{{ Form::label('category_id', 'Category:') }}
						<select class="form-control" id="category_id" name="category_id">
							@foreach($categories as $category)
							<option value="{{ $category->id }}">{{ $category->name }}</option>
							@endforeach
						</select>
					</div>

					<div class="form-group">
						{{Form::label('introduce', 'Introduce:')}}
						{{Form::text('introduce', null, ['class' => 'form-control', 'required' => ''])}}
					</div>

					<div class="form-group">
						{{Form::label('link', 'Link:')}}
						{{Form::text('link', null, ['class' => 'form-control', 'required' => '', 'data-parsley-type' => 'url', 'maxlength' => '255'])}}
					</div>
				</div>
				<div class="modal-footer">
					<div class="form-group">
						{{Form::button('Close', ['class' => 'btn btn-secondary', 'data-dismiss' => 'modal'])}}
						{{Form::submit('Create Audio', ['class' => 'btn btn-primary', 'id' => 'button-submit'])}}
					</div>
				</div>
				{!! Form::close() !!}
			</div>
		</div>	
	</div>

	{{-- Modal view audio --}}
	<div class="modal fade" id="view-audio" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="title-modal-view"></h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body" id="content-post">

				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					{{-- <button type="submit" class="btn btn-primary">View Post</button> --}}
				</div>
			</div>
		</div>	
	</div>

	<script src="{{asset('js/admin/ajax-crud-audio.js')}}"></script>

	<script type="text/javascript">
		var formInstance = $('#form-audio').parsley();
	</script>
</main>


