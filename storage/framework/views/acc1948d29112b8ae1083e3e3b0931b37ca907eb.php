<?php $__env->startSection('title', '| Account Information'); ?>

<?php $__env->startSection('stylesheets'); ?>
<?php echo Html::style('css/account.css'); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('process'); ?>
<?php echo Html::script('js/autocompleteAddress.js'); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div id="account-info">
	<?php echo Form::model($user, ['route' => ['account.update', $user->id], 'method' => 'PUT', 'files' => true]); ?>

	<h1>Profile</h1>
	<div class="row">
		<div class="col-md-4 col-md-offset-1 avatar">
			<img src="<?php echo e(asset('imgs/' . $user->image)); ?>" id="profile_image_tag" class="form-spacing-top">
			<?php echo e(Form::label('profile_image', 'Upload Profile Picture:')); ?>

			<?php echo e(Form::file('profile_image', ['class' => 'form-control-file', 'id' => 'profile_image', 'style' => 'margin-bottom: 10px'])); ?>

		</div>
		<div class="col-md-7 profile">
			<div class="form-group">
				<?php echo e(Form::label('name', 'Fulle Name:')); ?>

				<?php echo e(Form::text('name', $user->name, ['class' => 'form-control', 'required' => '', 'maxlength' => '255'])); ?>

			</div>

			<div class="form-group">
				<?php echo e(Form::label('birth_day', 'Birth Day:')); ?>

				<?php echo e(Form::date('birth_day', $user->birth_day)); ?><br>
			</div>

			<div class="form-group">
				<?php echo e(Form::label('email', 'Email:')); ?>

				<fieldset disabled>
					<?php echo e(Form::text('email', $user->email, ['class' => 'form-control', 'required' => '', 'maxlength' => '255'])); ?>

				</fieldset>
			</div>

			<div class="form-group">
				<?php echo e(Form::label('gender', 'Gender:')); ?>

				<?php echo e(Form::select('gender', ['female' => 'Female', 'male' => 'Male', 'custom' => 'Custom'], $user->gender, ['class' => 'form-control'])); ?>

			</div>

			<div class="form-group">
				<?php echo e(Form::label('address', 'Address:')); ?>

				<?php echo e(Form::text('address', $user->address, ['class' => 'form-control', 'id' => 'address', 'required' => '', 'maxlength' => '255', 'onFocus' => 'geolocate()', 'placeholder' => 'Enter your address'])); ?>

			</div>

			<div class="form-group">
				<?php echo e(Form::label('phone', 'Phone:')); ?>

				<?php echo e(Form::text('phone', $user->phone, ['class' => 'form-control', 'required' => '', 'maxlength' => '255'])); ?>

			</div>

			<div class="form-group" style="text-align: center;">
				<?php echo e(Form::button('Change password', ['id' => "changePwBtn", 'class' => 'btn btn-info btn-lg', 'style' => 'margin-top: 5px;', 'data-toggle' => 'modal', 'data-target' => '#changePwModal'])); ?>

				<?php echo e(Form::submit('Save', ['class' => 'btn btn-success btn-lg', 'style' => 'margin-top: 5px;'])); ?>

			</div>

		</div>
	</div>
	<?php echo Form::close(); ?>

</div>

<!-- Modal change password -->
<div class="modal fade" id="changePwModal">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h2 class="modal-title" id="modalLabel">Change Password</h2>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<?php echo Form::model($user, ['route' => ['account.changepw', $user]]); ?>

				<div class="form-group">
					<?php echo e(Form::label('current_password', 'Current Password:')); ?>

					<?php echo e(Form::password('current_password', ['class' => 'form-control', 'placeholder' => 'Enter current password'])); ?>

				</div>

				<div class="form-group">
					<?php echo e(Form::label('new_password', 'New Password:')); ?>

					<?php echo e(Form::password('new_password', ['class' => 'form-control', 'placeholder' => 'Enter new password'])); ?>

				</div>

				<div class="form-group">
					<?php echo e(Form::label('confirm_password', 'Confirm Password:')); ?>

					<?php echo e(Form::password('confirm_password', ['class' => 'form-control', 'placeholder' => 'Confirm password'])); ?>

				</div>

				<?php echo Form::close(); ?>

			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-primary">Save changes</button>
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
			</div>
		</div>	
	</div>		
</div>

<script type="text/javascript">
	function changeProfileImage(input) {
		if (input.files && input.files[0]) {
			var reader = new FileReader();

			reader.onload = function (e) {
				$('#profile_image_tag').attr('src', e.target.result);
				$('#profile_image_tag').width(200);
			}
			reader.readAsDataURL(input.files[0]);
		}
	}
	$("#profile_image").change(function(){
		changeProfileImage(this);
	})
</script>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCVLQUxd0C_e6_kVneLerW8AabuYJYdDGk&libraries=places&callback=initAutocomplete"
async defer></script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>