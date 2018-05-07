<?php
use lithium\security\Auth;
?>

<?php $this->title('Home');
	$adminauth = Auth::check('admin');
	$userauth = Auth::check('user');
?>

<?php if( $adminauth ): ?>

	<h2>Hi <?php echo $adminauth['username'] ?></h2>
	<h3>Admin Sections</h3>
	<ul>
		<li><a href="/users/">Users</a>
			<ul>
				<li><a href="/users/add">Add User</a></li>
			</ul>
		</li>
	</ul>

<?php elseif ( $userauth ): ?>

	<h2>Hi <?php echo $userauth['username'] ?></h2>

	<h3>User sections</h3>
	
	<?php
		// renders app/views/elements/nav/verticals.html.php
		//echo $this->_render('element', 'verticalslist');
	?>

<?php else: ?>
	<h2>Not logged in</h2>
<?php endif; ?>