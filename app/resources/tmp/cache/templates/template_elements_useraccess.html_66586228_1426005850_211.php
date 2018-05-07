<?php
use lithium\security\Auth;
?>

<?php if( Auth::check('admin') || Auth::check('user') ): ?>
	<li><a href="/logout">Logout</a></li>
<?php else: ?>
	<li><a href="/login">Login</a></li>
<?php endif; ?>