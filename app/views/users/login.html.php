<?php $this->title('Login'); ?>

<?=$this->form->create(null, ['class'=>'form-signin']); ?>
	<h2>User Login</h2>
	<?=$this->form->field('username', array('label' => false, 'class' => 'form-control', 'placeholder' => 'Username', 'autofocus' => 1));?>
	<?=$this->form->field('password', array('label' => false, 'type'=>'password', 'class' => 'form-control', 'placeholder' => 'Password'));?>

	<?php if (!empty($loginFailed)): ?>
	    <div class="alert alert-warning">Login failed - please check your credentials</div>
	<?php endif; ?>

	<?=$this->form->submit('Log in', array('class' => 'btn btn-lg btn-primary btn-block'));?>
	<p>&nbsp;</p>
	<p class="align-center"><a href="/administrators">Administrator Login</a></p>
<?=$this->form->end();?>