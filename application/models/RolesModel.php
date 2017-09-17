<?php
/**
 * Created by PhpStorm.
 * User: fayazk
 * Date: 16/09/2017
 * Time: 5:18 PM
 */

class RolesModel extends CI_Model
{
	public function all()
	{
		return $this->db->get( 'roles' )->result();
	}

	public function find( $id )
	{
		$this->db->where( 'id', $id );

		$role = $this->db->get( 'roles' )->result();
		if ( empty( $role ) ) {
			return false;
		}

		return $role[0];
	}

	public function add()
	{
		if ( empty( $this->input->post( 'ajax_submit' ) ) ) {
			return;
		}

		$output = [
			'message' => '',
			'status'  => 'error',
		];

		$this->load->library( 'form_validation' );
		$rules = [
			[
				'field' => 'name',
				'label' => 'Role Name',
				'rules' => 'required|trim',
			],
		];
		$this->form_validation->set_rules( $rules );
		if ( $this->form_validation->run() !== false ) {
			$fields = [
				'name' => $this->input->post( 'name' ),
			];
			$this->db->insert( 'roles', $fields );
			$output['status'] = 'ok';
			set_alert_message( 'Role Added Successfully' );
		}

		$output['message'] = validation_errors( '<div class="alert alert-danger">', '</div>' );
		$output['message'] .= get_alert_messages();

		echo json_encode( $output );
		exit;
	}

	public function update( $id )
	{
		if ( empty( $this->input->post( 'ajax_submit' ) ) ) {
			return;
		}

		$output = [
			'message' => '',
			'status'  => 'error',
		];

		$this->load->library( 'form_validation' );
		$rules = [
			[
				'field' => 'name',
				'label' => 'Role Name',
				'rules' => 'required|trim',
			],
		];
		$this->form_validation->set_rules( $rules );
		if ( $this->form_validation->run() !== false ) {
			$fields = [
				'name' => $this->input->post( 'name' ),
			];
			$this->db->where( 'id', $id );
			$this->db->update( 'roles', $fields );
			$output['status'] = 'ok';
			set_alert_message( 'Role Updated Successfully' );
		}

		$output['message'] = validation_errors( '<div class="alert alert-danger">', '</div>' );
		$output['message'] .= get_alert_messages();

		echo json_encode( $output );
		exit;
	}

}
