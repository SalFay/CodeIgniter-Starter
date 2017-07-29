<?php
if ( ! function_exists( 'alert_box' ) ) {
	function alert_box( $message, $status = 'success' )
	{
		$class  = 'success';
		$title  = 'Done';
		$status = strtolower( $status );
		switch ( $status ) {
			case 'alert':
			case 'warning':
				$class = 'warning';
				$title = 'Warning';
				break;
			case 'danger':
			case 'error':
				$class = 'danger';
				$title = 'Error';
				break;
			case 'tip':
			case 'help':
			case 'info':
				$class = 'info';
				$title = 'Tip';
				break;
		}
		$alert = '
            <div class="alert alert-' . $class . ' alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <strong>' . $title . '!</strong> ' . $message . '
            </div>
        ';

		return $alert;
	}
}


if ( ! function_exists( 'set_alert_message' ) ) {
	function set_alert_message( $message, $status = 'ok' )
	{
		$ci  = &get_instance();
		$pre = [];
		if ( ! empty( $ci->session->tmp_messages ) ) {
			$pre = $ci->session->tmp_messages;
		}
		$pre[ $status ][] = $message;
		$ci->session->set_userdata( 'tmp_messages', $pre );
	}
}

if ( ! function_exists( 'get_alert_messages' ) ) {
	function get_alert_messages( $status = '' )
	{
		$output = [];
		$ci     = &get_instance();
		if ( ! empty( $ci->session->tmp_messages ) ) {
			$session_data = $ci->session->tmp_messages;
			if ( ! empty( $status ) ) {
				if ( count( $session_data[ $status ] ) <= 1 ) {
					$markup = $session_data[ $status ][0];
				} else {
					$messages = implode( '</li><li>', $session_data[ $status ] );
					$markup   = '<ul><li>' . $messages . '</li></ul>';
				}

				$output[] = alert_box( $markup, $status );
			} else {
				foreach ( $ci->session->tmp_messages as $type => $alerts ) {
					if ( count( $session_data[ $type ] ) <= 1 ) {
						$markup = $session_data[ $type ][0];
					} else {
						$messages = implode( '</li><li>', $session_data[ $type ] );
						$markup   = '<ul><li>' . $messages . '</li></ul>';
					}

					$output[] = alert_box( $markup, $type );
				}
			}
			$ci->session->unset_userdata( 'tmp_messages' );

			return implode( ' ', $output );
		}

		return '';
	}
}


if ( ! function_exists( 'a' ) ) {
	function a( $url, $label, $attributes = [] )
	{
		$url                = site_url( $url );
		$attributes['href'] = $url;
		$attrib             = [];
		foreach ( $attributes as $key => $value ) {
			$attrib[] = $key . '="' . $value . '"';
		}


		$output = '<a ' . implode( ' ', $attrib ) . ' >' . $label . '</a>';

		return $output;
	}
}

if ( ! function_exists( 'action_buttons' ) ) {
	function action_buttons( array $buttons )
	{
		$tpl    = '<div class="btn-group btn-group-xs btn-actions">{buttons}</div>';
		$output = '';
		foreach ( $buttons as $button ) {
			$url   = $button['url'];
			$label = $button['label'];
			unset( $button['label'], $button['url'] );
			$button['class'] = 'btn ' . $button['class'];

			$output .= a( $url, $label, $button );
		}

		return str_replace( '{buttons}', $output, $tpl );
	}
}
