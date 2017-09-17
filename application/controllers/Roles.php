<?php
/**
 * Created by PhpStorm.
 * User: fayazk
 * Date: 16/09/2017
 * Time: 5:30 PM
 */

/**
 * Class Roles
 * @property RolesModel $roles
 */
class Roles extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		check_authentication();
		$this->load->model( RolesModel::class, 'roles' );
	}

	public function all_ajax()
	{
		$this->load->library( DataTables::class );
		$this->datatables->init( 'roles r', 'r.id' );
		$this->datatables->setColumnAlias( 'actions', 'r.id' );
		$this->datatables->editColumn( 'actions', function ( $row ) {
			return action_buttons( [
				[
					'url'         => 'roles/edit/' . $row->id,
					'label'       => '<i class="fa fa-edit" aria-hidden="true"></i>',
					'class'       => 'btn-primary',
					'data-action' => 'edit',
				],
				[
					'url'         => 'roles/delete/' . $row->id,
					'label'       => '<i class="fa fa-trash" aria-hidden="true"></i>',
					'class'       => 'btn-danger',
					'data-action' => 'delete',
				],
			] );
		} );
		$this->datatables->make()->output();
	}

	public function index()
	{
		$this->theme->display( 'roles.all' );
	}

	public function add()
	{
		$this->roles->add();
	}

	public function edit( $id )
	{
		$this->roles->update($id);
		$role   = $this->roles->find( $id );
		$output = [
			'status'  => 'error',
			'role'    => [],
			'message' => '',
		];
		if ( empty( $role ) ) {
			set_alert_message( 'The Role not Found', 'error' );
			$output['message'] = get_alert_messages();
			echo json_encode( $output );
			exit;
		}
		$output['status'] = 'ok';
		$output['role']   = $role;
		echo json_encode( $output );
	}

	public function delete( $id )
	{
		$this->db->where( 'id', $id );
		$this->db->delete( 'roles' );
		set_alert_message( 'Role Deleted Successfully' );
		$output = [
			'message' => get_alert_messages(),
			'status'  => 'ok',
		];
		echo json_encode( $output );
	}


}
