<?php namespace App\Controllers;

class Index extends BaseController
{
	public function index()
	{ //session()->get('');
		$title = [
			'title' => 'Halaman Utama | Panganku'
			
		];
		echo view('header_v',$title);
		echo view('index_v');
		echo view('footer_v');
	}

	//--------------------------------------------------------------------

}
