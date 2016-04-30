<?php

/*
 * Define Auth Types
 */
use lithium\security\Auth;
use app\models\Users;
use lithium\analysis\Logger;
use lithium\storage\Session;

/* -- Auth::config defined in bootstrap/session.php --*/


// Use Role Based Access Control
// Lowest roles first, to be overridden by bottom ones
// use li3_access\security\Access;

// $accountsEmpty = Users::count();
// Access::config(array(
//     'auth_rbac' => array(
//         'adapter' => 'AuthRbac',
//         'roles' => array(
//             array(
//                 'resources' => '*',
//                 'match' => '*::*'
//             ),
//             array(
//                 'message' => 'No panel for you!',
//                 'redirect' => array('library' => 'admin', 'Users::login'),
//                 'resources' => 'admin',
//                 'match' => array('library' => 'admin', '*::*')
//             ),
//             array(
//                 'resources' => '*',
//                 'match' => array(
//                     'library' => 'admin', 'Users::login',
//                     function($request, &$options) {
//                         return !empty($request->data);
//                     }
//                 ),
//                 'allow' => function($request, &$options) use ($accountsEmpty) {
//                     if ($accountsEmpty) {
//                         $options['message'] = 'No accounts exist yet!';
//                     }
//                     return $accountsEmpty;
//                 }
//             ),
//             array(
//                 'resources' => '*',
//                 'match' => array('library' => 'admin', 'Users::logout')
//             )
//         )
//     )
// ));

/**
* Apply filter to render to check all views
*/
use lithium\net\http\Media;
Media::applyFilter('render', function($self, $params, $chain){
	// Change to admin layout
	// $request = $params['options']['request'];
	// $admin = isset($request->params['admin']) ? $request->params['admin'] : false;
	// if($admin){
	// 	$params['options']['layout'] = 'admin';
	// }
	return $chain->next($self, $params, $chain);
}); 

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

	//All controller actions will be logged in User actions unless:
	// publicActions - doesn't require login
	// adminActions - only admin can access 

	// Forward request if early part in the chain
	if( $ctrl instanceof Closure){
		return $ctrl;
	}

	if (Session::read('adminActionAuthenticated') == 1){
		//Proceed if admin action authenticated
		return $ctrl;
	}
	if (Auth::check('user')) {
		//Proceed if logged in as user
		return $ctrl;
	}
	if (isset($ctrl->publicActions) && in_array($action, $ctrl->publicActions)) {
		//Proceed if this is a public action
		return $ctrl;
	}

	//Not a public action, prompt for user login
	return function() use ($request) {
		return new Response(compact('request') + array('location' => 'Users::login'));
	};
});

?>