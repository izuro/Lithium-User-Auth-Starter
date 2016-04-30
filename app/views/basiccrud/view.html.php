<h2>Listing</h2>

<?php foreach ($listing as $key => $value) { ?>
<p><span class="key"><?=$key; ?>: </span><span class="value"><?=$value; ?></span></p>
<?php }?>


<?=$this->form->create($listing, array('url'=>'/listings/delete/'.$listing->_id, 'method'=>'delete', 'id'=>'delete_'.$listing->_id)); ?>

<p><span>(
	<span><?=$this->html->link('edit', array('Listings::edit', 'id' => $listing->_id)); ?> </span>
	 | <span><?=$this->html->link('delete', '#', array(
	 	'onclick'=> 'if(confirm("Confirm delete '.$listing->name.'?")){ getElementById("delete_'.$listing->_id.'").submit(); } return false;'
	 )); ?> </span> )
	 <!-- | <?=$this->form->submit('delete'); ?> ) -->
</span></p>

<?=$this->form->end(); ?>
