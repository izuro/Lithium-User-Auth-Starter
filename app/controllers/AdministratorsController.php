<?php

namespace app\controllers;

use app\models\Administrators;
use lithium\action\DispatchException;

use lithium\security\Auth;
use lithium\storage\Session;
use lithium\analysis\Logger;

class AdministratorsController extends \lithium\action\Controller {

    //All actions default as User auth-required actions
    public $publicActions = array('login','logout');
    public $adminActions = array('index');

	public function index() {
		// $administrators = Administrators::all();
		// return compact('administrators');
	}


    public function login() {
        if (Auth::check('admin', $this->request)) {

            if(Auth::check('user', $this->request)){
                //Log in user with the same username
                // Logger::alert('Admin user logged in');
            }
            // Session value in filter stored only when view is rendered, hence
            // we store it here first to prevent redirection auth issues
            Session::write('adminActionAuthenticated', 1);
            
            return $this->redirect('/');//array('Administrators::index'));
        }
        
        $loginFailed = false;
        if ($this->request->data){
            $loginFailed = true;
        }
        $this->_render['layout'] = 'col-1';
        return compact('loginFailed');
    }

    public function logout() {
        Auth::clear('admin');
        Session::delete('adminActionAuthenticated');
        return $this->redirect('/');
    }
}

?>