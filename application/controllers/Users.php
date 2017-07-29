<?php

/**
 * Class Users
 * @property UsersModel $users
 */
class Users extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		check_authentication();
		if ( ! is_admin() ) {
			show_404();
		}

		$this->load->model( UsersModel::class, 'users' );
	}

	public function all_ajax()
	{
		$this->db->where( 'deleted', 0 );
		$this->load->library( DataTables::class );
		$this->datatables->init( 'users', 'id' );
		$this->datatables->setColumnAlias( 'actions', 'id' );
		$this->datatables->setColumnAlias( 'username', "CONCAT(first_name, ' ', last_name)" );
		$this->datatables->editColumn( 'actions', function ( $row ) {
			return action_buttons( [
				[
					'url'               => '#',
					'class'             => 'btn-success',
					'label'             => '<i class="fa fa-eye" aria-hidden="true"></i>',
					'data-featherlight' => site_url( 'users/view/2' ) . ' .ajax-box',
					'data-action'       => 'lightbox',
				],
				[
					'url'   => 'users/edit/' . $row->id,
					'class' => 'btn-primary',
					'label' => '<i class="fa fa-edit" aria-hidden="true"></i>',
				],
				[
					'url'         => 'users/delete/' . $row->id,
					'class'       => 'btn-danger',
					'label'       => '<i class="fa fa-trash" aria-hidden="true"></i>',
					'data-action' => 'delete',
				],
			] );
		} );
		$this->datatables->make();
		$this->datatables->output();

	}

	public function index()
	{
		$this->theme->display( 'users.all' );
	}

	public function add()
	{
		$this->users->add();
		$this->theme->display( 'users.add' );
	}

	public function edit( $id )
	{
		$this->users->update( $id );
		$user = $this->users->find( $id );
		if ( empty( $user ) ) {
			show_404();
		}
		$this->theme->display( 'users.edit', [ 'user' => $user[0] ] );
	}

	public function view( $id )
	{
		$user = $this->users->find( $id );
		if ( empty( $user ) ) {
			show_404();
		}
		$this->theme->display( 'users.view', [ 'user' => $user[0] ] );
	}

	public function delete( $id )
	{
		$this->db->where( 'id', $id )->update( 'users', [
			'deleted' => 1,
		] );
		set_alert_message( 'User Deleted' );
		redirect( 'users' );
	}
}
