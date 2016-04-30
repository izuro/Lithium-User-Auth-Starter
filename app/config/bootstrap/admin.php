<?php

/*
 * Define Auth Types
 */
use lithium\security\Auth;
use app\models\Administrators;
use lithium\analysis\Logger;
use lithium\storage\Session;

/* -- Auth::config defined in bootstrap/session.php --*/

/**
* Apply filter to authenticate all actions, with exceptions defined in the publicActions property
*/
use lithium\action\Dispatcher;
use lithium\action\Response;
// use lithium\security\Auth;

Dispatcher::applyFilter('_callable', function($self, $params, $chain) {
	$ctrl    = $chain->next($self, $params, $chain);
	$request = isset($params['request']) ? $params['request'] : null;
	$action  = $params['params']['action'];

	// All controller actions will be logged in User actions unless:
	// publicActions - doesn't require login
	// adminActions - only admin can access 

	// Forward request if early part in the chain
	if( $ctrl instanceof Closure){
		return $ctrl;
	}

	//Logger::alert(print_r($ctrl->adminActions));

	if ( isset( $ctrl->adminActions ) && in_array($action, $ctrl->adminActions) ) {
		if (Auth::check('admin')) {
			//Proceed if logged in as admin & action is defined in adminActions
			//$params['adminActionAuthenticated'] = true;
			Session::write('adminActionAuthenticated', 1);
			return $ctrl;
		} else {
			// Prompt for admin login
			return function() use ($request) {
				return new Response(compact('request') + array('location' => 'Administrators::login'));
			};
		}
	}

	//Not an admin action, proceed to User auth check
	return $ctrl;
});

?>