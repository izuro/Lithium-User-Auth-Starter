<h2>Edit User</h2>


<?=$this->form->create($user); ?>

<?php foreach ($user as $key => $value ):?>

<?=$this->form->field($key); ?>

<?php endforeach;?>

<?=$this->form->submit('Save'); ?>
<?=$this->form->end(); ?>