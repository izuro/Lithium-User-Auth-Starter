<h2>User</h2>

<?php foreach ($user as $key => $value) { ?>
<p><span class="key"><?php echo $h($key); ?>: </span><span class="value"><?php echo $h($value); ?></span></p>
<?php }?>

<?php echo $this->form->create($user, array('url'=>'/users/delete/'.$user->_id, 'method'=>'delete', 'id'=>'delete_'.$user->_id)); ?>

<p><span>(
	<span><?php echo $this->html->link('edit', array('Users::edit', 'id' => $user->_id)); ?> </span>
	 | <span><?php echo $this->html->link('delete', '#', array(
	 	'onclick'=> 'if(confirm("Confirm delete '.$user->name.'?")){ getElementById("delete_'.$user->_id.'").submit(); } return false;'
	 )); ?> </span> )
	 <!-- | <?php echo $this->form->submit('delete'); ?> ) -->
</span></p>

<?php echo $this->form->end(); ?>