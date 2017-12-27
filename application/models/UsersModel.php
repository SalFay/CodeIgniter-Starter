<?php

/**
 * Class UsersModel
 * @property CI_Input            $input
 * @property CI_Session          $session
 * @property CI_DB_query_builder $db
 * @property CI_Form_validation  $form_validation
 */
class UsersModel extends CI_Model
{
	private $current_user = null;

	public function __construct()
	{
		parent::__construct();

		if ( empty( $this->session->user ) ) {
			return;
		}

		$user = $this->session->user;
		$this->db->where( 'id', $user->id );
		$res = (array) $this->db->get( 'users' )->result();

		$this->current_user = (object) array_merge( (array) $user, $res );
	}

	public function auth()
	{
		return $this->current_user;
	}

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
		if ( $this->form_validation->run() === false ) {
			return false;
		}
		$username = $this->input->post( 'username' );
		$password = $this->input->post( 'password' );
		$password = md5( crypt( $password, config_item( 'password_salt' ) ) );
		$this->db->where( 'login_name', $username );
		$this->db->where( 'password', $password );
		$user = $this->db->get( 'users' )->result();
		if ( ! empty( $user ) ) {
			$user  = $user[0];
			$login = [
				'id'            => $user->id,
				'logged_at'     => date( 'Y-m-d H:i:s' ),
				'name'          => $user->first_name . ' ' . $user->last_name,
				'registered_at' => $user->created_at,
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


	public function all()
	{
		$users = $this->db->where( 'deleted', 0 )->order_by( 'created_at', 'DESC' )->get( 'users' );

		return $users->result();
	}

	public function find( $id )
	{
		$this->db->where( 'id', $id );
		$this->db->where( 'deleted', 0 );

		return $this->db->get( 'users' )->result();
	}

	public function add()
	{
		$this->load->library( 'form_validation' );
		$rules = [
			[
				'field' => 'username',
				'label' => 'Login Name',
				'rules' => 'trim|required|is_unique[users.login_name]',
			],
			[
				'field' => 'password',
				'label' => 'Password',
				'rules' => 'trim|required',
			],
			[
				'field' => 'password_confirm',
				'label' => 'Confirm Password',
				'rules' => 'trim|required|matches[password]',
			],
			[
				'field' => 'first_name',
				'label' => 'First Name',
				'rules' => 'trim|required',
			],
			[
				'field' => 'last_name',
				'label' => 'Last Name',
				'rules' => 'trim|required',
			],
			[
				'field' => 'email',
				'label' => 'Email',
				'rules' => 'trim|required|valid_email|is_unique[users.email]',
			],
			[
				'field' => 'roles[]',
				'label' => 'Roles',
				'rules' => 'trim|required',
			],
		];

		$this->form_validation->set_rules( $rules );
		if ( $this->form_validation->run() !== false ) {
			$password = md5( crypt( $this->input->post( 'password' ), config_item( 'password_salt' ) ) );
			$fields   = [
				'login_name' => $this->input->post( 'username' ),
				'password'   => $password,
				'first_name' => $this->input->post( 'first_name' ),
				'last_name'  => $this->input->post( 'last_name' ),
				'email'      => $this->input->post( 'email' ),
			];
			$this->db->insert( 'users', $fields );

			// Insert Roles
			$user_id = $this->db->insert_id();
			$roles   = $this->input->post( 'roles' );
			foreach ( $roles as $role ) {
				$this->db->insert( 'user_role', [
					'user_id' => $user_id,
					'role_id' => $role,
				] );
			}

			set_alert_message( 'User Added successfully' );
			redirect( 'users' );
		}
	}

	public function update( $id )
	{
		$this->load->library( 'form_validation' );
		$rules = [
			[
				'field' => 'username',
				'label' => 'Login Name',
				'rules' => 'trim|required',
			],
			[
				'field' => 'first_name',
				'label' => 'First Name',
				'rules' => 'trim|required',
			],
			[
				'field' => 'last_name',
				'label' => 'Last Name',
				'rules' => 'trim|required',
			],
			[
				'field' => 'email',
				'label' => 'Email',
				'rules' => 'trim|required',
			],
			[
				'field' => 'role',
				'label' => 'Role',
				'rules' => 'trim|required',
			],
			[
				'field' => 'business',
				'label' => 'Business Name',
				'rules' => 'trim|required',
			],
			[
				'field' => 'api_key',
				'label' => 'API Key',
				'rules' => 'trim|required',
			],
		];

		$this->form_validation->set_rules( $rules );
		if ( $this->form_validation->run() !== false ) {
			$has_password     = false;
			$password         = trim( $this->input->post( 'password' ) );
			$password_confirm = trim( $this->input->post( 'password_confirm' ) );
			if ( ! empty( $password ) || ! empty( $password_confirm ) ) {
				if ( $password !== $password_confirm ) {
					set_alert_message( 'Password Fields did not matched', 'error' );

					return;
				}
				$has_password = true;
				$password     = md5( crypt( $this->input->post( 'password' ), config_item( 'password_salt' ) ) );
			}
			$fields = [
				'login_name' => $this->input->post( 'username' ),
				'first_name' => $this->input->post( 'first_name' ),
				'last_name'  => $this->input->post( 'last_name' ),
				'email'      => $this->input->post( 'email' ),
				'role'       => $this->input->post( 'role' ),
				'business'   => $this->input->post( 'business' ),
				'address'    => $this->input->post( 'address' ),
				'api_key'    => $this->input->post( 'api_key' ),
				'updated_at' => date( 'Y-m-d H:i:s' ),
			];
			if ( $has_password ) {
				$fields['password'] = $password;
			}
			$this->db->where( 'id', $id );
			$this->db->update( 'users', $fields );
			set_alert_message( 'User Updated successfully' );
			redirect( 'users' );
		}

	}
}
