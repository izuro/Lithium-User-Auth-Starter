<h2>Edit Listing</h2>


<?=$this->form->create($listing, array('type' => 'file')); ?>

<?php foreach ($listing as $key => $value ):?>

<?=$this->form->field($key); ?>

<?php endforeach;?>

<?=$this->form->submit('Save'); ?>
<?=$this->form->end(); ?>