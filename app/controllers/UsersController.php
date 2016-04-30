<?php

namespace app\controllers;

use lithium\security\Auth;
use app\models\Users;
use lithium\storage\Session;
use lithium\action\DispatchException;
use lithium\analysis\Logger;

class UsersController extends \lithium\action\Controller {

    //All actions default as User auth-required actions
    public $publicActions = array('login','logout');
    public $adminActions = array('index', 'add', 'view', 'edit', 'delete');

    protected function _init(){
        //To deal with media/json requests
        $this->_render['negotiate'] = true;
        parent::_init();
    }

	public function index() {
		$users = Users::all();
		return compact('users');
	}

	public function view() {
		$user = Users::first($this->request->id);
		return compact('user');
	}

	public function add() {
		$user = Users::create();

		if (($this->request->data) && $user->save($this->request->data)) {
			return $this->redirect(array('Users::view', 'args' => array($user->id)));
		}
		return compact('user');
	}

	public function edit() {
		$user = Users::find($this->request->id);

		if (!$user) {
			return $this->redirect('Users::index');
		}
		if (($this->request->data) && $user->save($this->request->data)) {
			return $this->redirect(array('Users::view', 'args' => array($user->id)));
		}
		return compact('user');
	}

	public function delete() {
		if (!$this->request->is('post') && !$this->request->is('delete')) {
			$msg = "Users::delete can only be called with http:post or http:delete.";
			throw new DispatchException($msg);
		}
		Users::find($this->request->id)->delete();
		return $this->redirect('Users::index');
	}

    public function login() {
		// Logger::alert('---------------');
		// Logger::alert(print_r($_SERVER['HTTP_REFERER'],1));

        // The user choose an external auth : adapter name given as the first param
        if (!empty($this->request->params['args'][0])) {
		// Logger::alert('Logging into foursquare');
		// Logger::alert('Saving referer');
            Session::write('referer', $_SERVER['HTTP_REFERER']);
            // Can we login in ?
            if (Auth::check($this->request->params['args'][0], $this->request)) {
		// Logger::alert('FS login succes');
                $referer = Session::read('referer');
		// Logger::alert($referer);
                if(!empty($referer)){
                    Session::delete('referer');
                    return $this->redirect($referer);
                } else {
                    return $this->redirect('/');
                }
            }
        } else if (Auth::check('user', $this->request)) {
		// Logger::alert('User login success');
            $referer = Session::read('referer');
		// Logger::alert($referer);
            if(!empty($referer)){
                Session::delete('referer');
                return $this->redirect($referer);
            } else {
                return $this->redirect('/');
            }
        }
        
		// Logger::alert('Prompt for login');
        $loginFailed = false;
        if ($this->request->data){
            $loginFailed = true;
        }

		// Logger::alert('Saving referer');
        // if(isset($_SERVER['HTTP_REFERRER']))
        if(!empty($_SERVER['HTTP_REFERER']))
            Session::write('referer', $_SERVER['HTTP_REFERER']);
		// Logger::alert($_SERVER['HTTP_REFERER']);
        //if JSON
        $error = array(
            'msg' => 'Please login to continue',
            'code' => 401,
            'redirect' => '/users/login'
        );
        $response = array(
            'error' => $error
        );
        $this->_render['layout'] = 'col-1';
        return compact('response','loginFailed');
    }

    public function logout() {
        Auth::clear('user');
        Auth::clear('admin');
		Session::delete('adminActionAuthenticated');
        return $this->redirect('/');
    }
}

?>