<?php namespace App\Controllers;

class Team extends BaseController
{
	public function index()
	{
		$title = [
			'title' => 'Tim | Panganku'
		];
		echo view('header_v',$title);
		echo view('team_v');
		echo view('footer_v');
	}

	//--------------------------------------------------------------------

}
