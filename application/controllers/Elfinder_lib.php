<?php
defined( 'BASEPATH' ) OR exit( 'No direct script access allowed' );

class Elfinder_lib extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		check_authentication();
	}

	public function manager()
	{
		$data['connector'] = site_url() . '/Elfinder_lib/connector';
		$this->theme->display( 'settings.elfinder',$data);
	}

	public function connector()
	{
		$opts      = [
			'roots' => [
				[
					'driver'        => 'LocalFileSystem',
					'path'          => FCPATH . '/resources/uploads/',
					'URL'           => base_url( 'resources/uploads' ),
					'uploadDeny'    => [ 'all' ],
					// All Mimetypes not allowed to upload
					'uploadAllow'   => [ 'image', 'text/plain', 'application/pdf' ],
					// Mimetype `image` and `text/plain` allowed to upload
					'uploadOrder'   => [ 'deny', 'allow' ],
					// allowed Mimetype `image` and `text/plain` only
					'accessControl' => [ $this, 'elfinderAccess' ],
					// disable and hide dot starting files (OPTIONAL)
					// more elFinder options here
				],
			],
		];
		$connector = new elFinderConnector( new elFinder( $opts ) );
		$connector->run();
	}

	public function elfinderAccess( $attr, $path, $data, $volume, $isDir, $relpath )
	{
		$basename = basename( $path );

		return $basename[0] === '.'                  // if file/folder begins with '.' (dot)
		       && strlen( $relpath ) !== 1           // but with out volume root
			? ! ( $attr == 'read' || $attr == 'write' ) // set read+write to false, other (locked+hidden) set to true
			: null;                                 // else elFinder decide it itself
	}
}
