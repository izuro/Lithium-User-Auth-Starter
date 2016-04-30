<?php $this->title('Admin login'); ?>

<?php echo $this->form->create(null, ['class'=>'form-signin']); ?>
	<h2>Admin Login</h2>
	<?php echo $this->form->field('username', array('label' => false, 'class' => 'form-control', 'placeholder' => 'Username', 'autofocus' => 1)); ?>
	<?php echo $this->form->field('password', array('label' => false, 'type'=>'password', 'class' => 'form-control', 'placeholder' => 'Password')); ?>

	<?php if (!empty($loginFailed)): ?>
	    <div class="text-error">Login failed - please check your credentials</div>
	<?php endif; ?>

	<?php echo $this->form->submit('Log in', array('class' => 'btn btn-lg btn-primary btn-block')); ?>
<?php echo $this->form->end(); ?>