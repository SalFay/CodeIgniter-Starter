<?php

/**
 * Created by PhpStorm.
 * User: fayazk
 * Date: 21/04/2017
 * Time: 3:50 PM
 */
class Home extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		check_authentication();
	}

	public function index()
	{
		$this->theme->display( 'dashboard.index' );
	}
}
