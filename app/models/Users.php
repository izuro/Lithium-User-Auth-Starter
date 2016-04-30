<?php

/**
 *  Users
 *  Controllers use publicActions & adminActions properties to define method access controls, all methods default to require user session
 *  Auth filter performed in bootstrap\user.php
 * 
 */

namespace app\models;
use lithium\security\Auth;
use lithium\storage\Session;
use lithium\analysis\Logger;

use lithium\security\Password;

class Users extends \lithium\data\Model {

	public $validates = array();
}

// Encrypt Passwords Filter
//moved to extensions/data/Model.php
Users::applyFilter('save', function($self, $params, $chain) {
// Logger::alert(print_r($params['data'],1));
	if ($params['data']) {
		//Update session data
		if(Auth::check('user')){
			$userSession = Session::read('user');
			$data = $params['data'] + $userSession;
			Session::write('user', $data);
		}
		
		$params['entity']->set($params['data']);
		$params['data'] = array();
	}

	
	if (!$params['entity']->exists()) {
		$params['entity']->password = Password::hash($params['entity']->password);
	}
	return $chain->next($self, $params, $chain);
});


?>