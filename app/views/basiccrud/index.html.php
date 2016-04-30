<h2>Listings</h2>
<ul>
	<?php foreach ($listings as $listing) { ?>
		<li><?=$this->html->link($listing->name, array('Listings::view', 'id' => $listing->_id)); ?> 
			
			<?=$this->form->create($listing, array('url'=>'/listings/delete/'.$listing->_id, 'method'=>'delete', 'id'=>'delete_'.$listing->_id)); ?>

			<p><span>(
				<span><?=$this->html->link('edit', array('Listings::edit', 'id' => $listing->_id)); ?> </span>
				 | <span><?=$this->html->link('delete', '#', array(
				 	'onclick'=> 'if(confirm("Confirm delete '.$listing->name.'?")){ getElementById("delete_'.$listing->_id.'").submit(); } return false;'
				 )); ?> </span> )
				 <!-- | <?=$this->form->submit('delete'); ?> ) -->
			</span></p>

			<?=$this->form->end(); ?>
		</li>
	<?php } ?>
</ul>