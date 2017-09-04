<?php

/**
 * Created by PhpStorm.
 * User: fayazk
 * Date: 26/04/2017
 * Time: 12:16 PM
 * @property CI_Form_validation  $form_validation
 * @property CI_DB_query_builder $db
 * @property CI_Input            $input
 * @property CI_Session          $session
 */
class AuthModel extends CI_Model
{
	public function login()
	{
		$rules = [
			[
				'field' => 'username',
				'label' => 'Username OR Email',
				'rules' => 'required',
			],
			[
				'field' => 'password',
				'label' => 'Password',
				'rules' => 'required',
			],
		];
		$this->form_validation->set_rules( $rules );
		if ( $this->form_validation->run() !== false ) {
			$username = $this->input->post( 'username' );
			$password = $this->input->post( 'password' );
			$password = md5( crypt( $password, config_item( 'password_salt' ) ) );
			$this->db->where( 'login_name', $username );
			$this->db->where( 'password', $password );
			$user = $this->db->get( 'users' )->result();
			if ( ! empty( $user ) ) {
				$user  = $user[0];
				$login = [
					'id'        => $user->id,
					'logged_at' => date( 'Y-m-d H:i:s' ),
					'name'      => $user->first_name . ' ' . $user->last_name,
				];
				$this->session->set_userdata( 'user', (object) $login );
				set_alert_message( 'Logged-in Successfully' );
				$redirect = '/';
				$ref      = $this->input->get( 'ref' );
				if ( ! empty( $ref ) ) {
					$redirect = urldecode( $ref );
				}
				redirect( $redirect );
			} else {
				set_alert_message( 'Invalid Login Credentials', 'error' );
			}
		}
	}
}
