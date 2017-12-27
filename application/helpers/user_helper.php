<?php
if ( ! function_exists( 'is_authenticated' ) ) {
	/**
	 * Check if the user is authenticated
	 * @return bool
	 */
	function is_authenticated()
	{
		$ci = &get_instance();

		return ! empty( $ci->session->user->id );
	}
}
if ( ! function_exists( 'is_admin' ) ) {
	function is_admin()
	{
		return true;
		$ci = &get_instance();

		return $ci->session->user->role === 'admin';
	}
}
if ( ! function_exists( 'check_authentication' ) ) {
	function check_authentication()
	{
		$url = current_url();
		if ( ! is_authenticated() ) {
			redirect( 'login?ref=' . urlencode( $url ) );
		}
	}
}
if ( ! function_exists( 'user_roles' ) ) {
	function user_roles()
	{
		$ci       =& get_instance();
		$roles    = $ci->db->get( 'roles' )->result();
		$dropdown = [];
		foreach ( $roles as $role ) {
			$dropdown[ $role->id ] = $role->name;
		}

		return $dropdown;
	}
}
