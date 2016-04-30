<h2>Add Listing</h2>
<?=$this->form->create($listing); ?>
	<?=$this->form->field('name'); ?>
	<?=$this->form->submit('Create me'); ?>
<?=$this->form->end(); ?>