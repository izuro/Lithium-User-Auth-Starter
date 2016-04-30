<h2>Edit User</h2>


<?php echo $this->form->create($user); ?>

<?php foreach ($user as $key => $value ):?>

<?php echo $this->form->field($key); ?>

<?php endforeach;?>

<?php echo $this->form->submit('Save'); ?>
<?php echo $this->form->end(); ?>