<main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4" id="posts">
	<input id="current-object" type="hidden" name="current object" value="post">
	<h2>All Posts</h2>
	<div class="button-create-new">
		<button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#create-new-post">
			<svg class="svg-icon" viewBox="0 0 20 20">
				<path d="M14.613,10c0,0.23-0.188,0.419-0.419,0.419H10.42v3.774c0,0.23-0.189,0.42-0.42,0.42s-0.419-0.189-0.419-0.42v-3.774H5.806c-0.23,0-0.419-0.189-0.419-0.419s0.189-0.419,0.419-0.419h3.775V5.806c0-0.23,0.189-0.419,0.419-0.419s0.42,0.189,0.42,0.419v3.775h3.774C14.425,9.581,14.613,9.77,14.613,10 M17.969,10c0,4.401-3.567,7.969-7.969,7.969c-4.402,0-7.969-3.567-7.969-7.969c0-4.402,3.567-7.969,7.969-7.969C14.401,2.031,17.969,5.598,17.969,10 M17.13,10c0-3.932-3.198-7.13-7.13-7.13S2.87,6.068,2.87,10c0,3.933,3.198,7.13,7.13,7.13S17.13,13.933,17.13,10"></path>
			</svg>
			Create Post
		</button>
	</div>
	<div class="table-responsive">
		<table class="table table-striped table-sm">
			<thead>
				<tr>
					<th>#</th>
					<th>Title</th>
					<th>Body</th>
					<th>Created At</th>
					<th class="text-center" width="170px;">Action</th>
				</tr>
			</thead>
			<tbody>
				<?php $__currentLoopData = $posts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				<tr>
					<th><?php echo e($post->id); ?></th>
					<td><?php echo e($post->title); ?></td>
					<td><?php echo e(substr(strip_tags($post->body), 0, 50)); ?><?php echo e(strlen(strip_tags($post->body)) > 50 ? "..." : ""); ?></td>
					<td><?php echo e(date('M j, Y H:i', strtotime($post->created_at))); ?></td>
					<td class="text-center">
						<input type="hidden" name="id" value="<?php echo e($post->id); ?>">
						<button type="button" class="btn btn-light btn-sm view" id="<?php echo e($post->id); ?>"  data-toggle="modal" data-target="#view-post">
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
				<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			</tbody>
		</table>
	</div>

	
	<div class="modal fade" id="create-new-post" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content">

				
				
				<?php echo Form::open(['route' => 'posts.store', 'data-parsley-validate' => '', 'files' => true]); ?>

				<div class="modal-header">
					<h5 class="modal-title" id="label">Create New Post</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<div class="form-group">
						<?php echo e(Form::label('title', 'Title:')); ?>

						<?php echo e(Form::text('title', null, ['class' => 'form-control', 'required' => '', 'maxlength' => '255'])); ?>

					</div>

					<div class="form-group">
						<?php echo e(Form::label('slug', 'Slug:')); ?>

						<?php echo e(Form::text('slug', null, ['class' => 'form-control', 'required' => '', 'minlength' => '5', 'maxlength' => '255'])); ?>						
					</div>

					<div class="form-group">
						<?php echo e(Form::label('category_id', 'Category:')); ?>

						<select class="form-control" name="category_id">
							<?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
							<option value="<?php echo e($category->id); ?>"><?php echo e($category->name); ?></option>
							<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
						</select>
					</div>

					<div class="form-group">
						<?php echo e(Form::label('tags', 'Tags:')); ?>

						<select class="form-control select2-multi" name="tags[]" multiple="multiple">
							<?php $__currentLoopData = $tags; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tag): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
							<option value="<?php echo e($tag->id); ?>"><?php echo e($tag->name); ?></option>
							<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
						</select>
					</div>

					<div class="form-group">
						<?php echo e(Form::label('featured_image', 'Upload Featured Image:')); ?>

						<?php echo e(Form::file('featured_image', ['class' => 'form-control', 'style' => 'margin-bottom: 5px'])); ?>

					</div>

					<div class="form-group">
						<?php echo e(Form::label('body', "Post Body:")); ?>

						<?php echo e(Form::textarea('body', null, ['class' => 'form-control'])); ?>

					</div>
				</div>
				<div class="modal-footer">
					<?php echo e(Form::button('Close', ['class' => 'btn btn-secondary', 'style' => 'margin-top: 20px;', 'data-dismiss' => 'modal'])); ?>

					<?php echo e(Form::submit('Create Post', ['class' => 'btn btn-primary', 'style' => 'margin-top: 20px;'])); ?>

				</div>
				<?php echo Form::close(); ?>

			</div>
		</div>	
	</div>

	
	<div class="modal fade" id="view-post" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="label"></h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body" id="content-post">
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					<button type="submit" class="btn btn-primary">View Post</button>
				</div>
			</div>
		</div>	
	</div>
</main>

<script src="<?php echo e(asset('js/admin/ajax-crud.js')); ?>"></script>

<script type="text/javascript">	
	$(function() {
		$(".select2-multi").select2();
		$("span.select2").css('width', '100%');
	})
	
	// Tinymce Editor
	tinymce.init({
		selector: 'textarea',
		plugins: "link code image",
		menubar: false
	});

	// Prevent bootstrap dialog from blocking focusin
	$(document).on('focusin', function(e) {
		if ($(e.target).closest(".mce-window").length) {
			e.stopImmediatePropagation();
		}
	});

	$('#open').click(function() {
		$("#dialog").dialog({
			width: 800,
			modal: true
		});
	});
	// End Config Tinymce Editor
</script>

