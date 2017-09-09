<?php

/**
 * Created by PhpStorm.
 * User: fayazk
 * Date: 25/04/2017
 * Time: 3:37 PM
 * @property CI_Form_validation $form_validation
 * @property CI_Input           $input
 * @property UsersModel         $users
 */
class Auth extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model( UsersModel::class, 'users' );
	}

	public function login()
	{
		$this->users->login();
		$this->theme->display( 'auth.login' );
	}

	/**
	 * @return CI_Form_validation
	 */
	public function logout()
	{
		$this->session->unset_userdata( 'user' );
		set_alert_message( 'Log out Successfully' );
		redirect( 'login' );
	}

	public function register()
	{
		$this->theme->display( 'auth.register' );
	}
}
