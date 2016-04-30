<h2>Users</h2>

<ul>

	<?php foreach ($users as $user) { ?>
		<li><?=$this->html->link($user->username, array('Users::view', 'id' => $user->_id)); ?> 
			
			<?=$this->form->create($user, array('url'=>'/users/delete/'.$user->_id, 'method'=>'delete', 'id'=>'delete_'.$user->_id)); ?>

			<p><span>(
				<span><?=$this->html->link('edit', array('Users::edit', 'id' => $user->_id)); ?> </span>
				 | <span><?=$this->html->link('delete', '#', array(
				 	'onclick'=> 'if(confirm("Confirm delete '.$user->name.'?")){ getElementById("delete_'.$user->_id.'").submit(); } return false;'
				 )); ?> </span> )
				 <!-- | <?=$this->form->submit('delete'); ?> ) -->
			</span></p>

			<?=$this->form->end(); ?>
		</li>
	<?php } ?>
</ul>