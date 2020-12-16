<?php namespace App\Controllers;
use App\Models\ResepModel;
use App\Models\KomentarModel;
use CodeIgniter\Exceptions\PageNotFoundException;
class Recipe extends BaseController
{
	protected $artikelModel;
	public function __construct()
	{
		
		$this->resepModel = new ResepModel();
		$this->komentarModel = new KomentarModel();
	}
	public function index()
	{
		
		$title = [
			'title' => 'Resep | Panganku'
		];
		//$resep = $this->resepModel->findAll();
		$data = [
			'resep' => $this->resepModel->getResep()
		];
		//dd($data);
		echo view('header_v',$title);
		echo view('recipe/recipe_v',$data);
		echo view('footer_v');
	}
	public function detail($id_resep)
	{
		// d($this->komentarModel->getKomentar($id_resep));
		// dd($this->resepModel->getResep($id_resep));
		$title =  ['title' => 'Detail Resep | Panganku'];
		$data = [
			'resep' => $this->resepModel->getResep($id_resep)
		];
		$komentar = [
			'komentar' => $this->komentarModel->getKomentar($id_resep),
			'resep' => $this->resepModel->getResep($id_resep),
			'validation' =>  \Config\Services::validation(),
		];
		// dd($data);
		// dd($komentar);
		if (empty($data['resep'])){
			throw new PageNotFoundException('Resep tidak ditemukan');
		}
		echo view('header_v',$title);
		echo view('recipe/detail_v',$data);
		echo view('recipe/komentar_v',$komentar);
		echo view('footer_v');
	}
	public function create()
	{

		$title =  ['title' => 'Buat Resep | Panganku'];
		$data = [
			'validation' =>  \Config\Services::validation()
		];
		// dd($_SESSION['last']);
		// $uri = new \CodeIgniter\HTTP\URI(base_url('recipe/create'));
		$_SESSION['last']= 'recipe/create';
		if(session()->get('logged_in')=="Y"){
		echo view('header_v',$title);
		echo view('recipe/create_v', $data);
		echo view('footer_v');
		}
		else {
			session()->setFlashdata('pesan', 'Anda harus login sebagai admin');
				return redirect()->to(base_url('/login'));
		}
	}
	public function save()
	{
		//  dd($this->request->getVar());
		if(!$this->validate([
			'judul' => ['rules'=>'required',
						'errors'=>[ 'required'=> ' Harus diisi']
					   ],
			'porsi' => ['rules'=>'required',
						'errors'=>[ 'required'=> 'Porsi Harus diisi']
		   				],
			'lama_memasak' => ['rules'=>'required|integer',
							   'errors'=>[ 'required'=> 'Lama Memasak Harus diisi',
										   'integer'=> 'Lama Memasak dalam bilangan angka dalam satuan menit'
					  					 ]
			   				  ],
			'bahan' => ['rules'=>'required',
						'errors'=>[ 'required'=> 'Bahan Harus diisi']
			   			],
			'tutorial' => ['rules'=>'required',
							'errors'=>[ 'required'=> 'Cara Memasak Harus diisi']
							 ],
			'gambar_banner' =>['rules'=>'uploaded[gambar_banner]|is_image[gambar_banner]|mime_in[gambar_banner,image/jpg,image/jpeg,image/png]',
							   'errors'=>[ 'uploaded'	=> 'Gambar Banner harus diisi',
											'is_image'	=> 'File harus berupa gambar',
											'mime_in'	=> 'File berformat jpg/jpeg/png']
							 ],
			'gambar_tutorial' =>['rules'=>'is_image[gambar_banner]|mime_in[gambar_banner,image/jpg,image/jpeg,image/png',
								'errors'=>['is_image'	=> 'File harus berupa gambar',
											'mime_in'	=> 'File berformat jpg/jpeg/png']
						   		],

		])) {
			// $validation = \Config\Services::validation();
			// return redirect()->to(base_url('/recipe/create'))->withInput()->with('validation',$validation);
			return redirect()->to(base_url('/recipe/create'))->withInput();
		}
		// ambil gambar
		$fileBanner = $this->request->getFile('gambar_banner');
		$namaBanner = $fileBanner->getRandomName();
		$fileBanner->move('img/recipe/', $namaBanner);
		// d($fileBanner = $this->request->getFile('gambar_banner'));
		// d($fileBanner->move('img/recipe/', $namaBanner));
		// dd($namaBanner = $fileBanner->getRandomName());
		
		
		
		// dd($fileTutorial[0]);
		//dd($this->request->getFileMultiple('gambar_tutorial'));
		$tutorial = $this->request->getFileMultiple('gambar_tutorial');
		$namaTutorial = "";
		$fileTutorial = "";
		if (!$tutorial[0]->getName() == "" ) {
			foreach ($tutorial as $t) {
				$namaTutorial = $t->getRandomName();
				$t->move('img/recipe/', $namaTutorial);
				$fileTutorial.=$namaTutorial.',';
			}
			$namaTutorial = substr($fileTutorial,0,-1);
		}
		 
		

		$this->resepModel->save([
			'id_user' 		=> $this->request->getVar('id_user'),
			'judul' 		=> $this->request->getVar('judul'),
			'porsi' 		=> $this->request->getVar('porsi'),
			'lama_memasak'	=> $this->request->getVar('lama_memasak'),
			'bahan' 		=> $this->request->getVar('bahan'),
			'tutorial' 		=> $this->request->getVar('tutorial'),
			'gambar_banner' => $namaBanner,
			'gambar_tutorial' => $namaTutorial
			
						
		]);
		session()->setFlashdata('pesan', 'Resep Berhasil Disimpan.');
		return redirect()->to(base_url('/recipe'));
	}
	public function delete($id_resep)
	{

		$this->resepModel->delete($id_resep);
		session()->setFlashdata('pesan', 'Resep Berhasil Dihapus.');
		return redirect()->to(base_url('/recipe'));
	}

	public function dashboardDelete($id_resep)
	{
		
		if(session()->get('is_admin')=="Y"){
		$this->resepModel->delete($id_resep);
		session()->setFlashdata('pesan', 'Resep Berhasil Dihapus.');
		return redirect()->to(base_url('/dashboard/resep'));
		}
		else {
			session()->setFlashdata('pesan', 'Anda harus login sebagai admin');
				return redirect()->to(base_url('/login'));
		}
	}

	public function edit($id_resep)
	{		
		$title =  ['title' => 'Buat Resep | Panganku'];
		$data = [
			'validation' =>  \Config\Services::validation(),
			'resep' => $this->resepModel->getResep($id_resep),
		];
		
		echo view('header_v',$title);
		echo view('recipe/edit_v', $data);
		echo view('footer_v');
	}
	public function update($id_resep)
	{
		if(!$this->validate([
		'judul' => ['rules'=>'required',
					'errors'=>[ 'required'=> ' Harus diisi']
				   ],
		'porsi' => ['rules'=>'required',
					'errors'=>[ 'required'=> 'Porsi Harus diisi']
					   ],
		'lama_memasak' => ['rules'=>'required|integer',
						   'errors'=>[ 'required'=> 'Lama Memasak Harus diisi',
									   'integer'=> 'Lama Memasak dalam bilangan angka dalam satuan menit'
									   ]
							 ],
		'bahan' => ['rules'=>'required',
					'errors'=>[ 'required'=> 'Bahan Harus diisi']
					   ],
		'tutorial' => ['rules'=>'required',
						'errors'=>[ 'required'=> 'Cara Memasak Harus diisi']
						 ],
						   	

		])) {
		// $validation = \Config\Services::validation();
		// return redirect()->to(base_url('/recipe/edit/'.$id_resep))->withInput()->with('validation',$validation);
		return redirect()->to(base_url('/recipe/edit/'.$id_resep))->withInput();
		}

	$fileBanner = $this->request->getFile('gambar_banner');
	if ($fileBanner->getError() == 4) {
		$namaBanner = $this->request->getVar('gambar_banner_old');

	} else {
		$namaBanner = $fileBanner->getRandomName();
		$fileBanner->move(base_url().'img/recipe/', $namaBanner);
	}
///////////////////////////////////////////////////////////////////////

	$tutorial = $this->request->getFileMultiple('gambar_tutorial');
	$namaTutorial = "";
	//d($tutorial);
	if ($tutorial[0]->getName() == "" ) {
		$namaTutorial = $this->request->getVar('gambar_tutorial_old');
	} else {
		$fileTutorial = "";
		foreach ($tutorial as $tutorial) {
			$namaTutorial = $tutorial->getRandomName();
			$tutorial->move('img/recipe/', $namaTutorial);
			$fileTutorial.=$namaTutorial.',';
		}
		 
		$namaTutorial = substr($fileTutorial,0,-1);
	}
	
		
		
		// d( $this->request->getMultipleFile('gambar_tutorial'));
		// dd($namaTutorial);

		$this->resepModel->save([
			'id_resep' => $id_resep,
			'judul' => $this->request->getVar('judul'),
			'porsi' => $this->request->getVar('porsi'),
			'lama_memasak' => $this->request->getVar('lama_memasak'),
			'bahan' => $this->request->getVar('bahan'),
			'tutorial' => $this->request->getVar('tutorial'),
			'gambar_banner' => $namaBanner,
			'gambar_tutorial' => $namaTutorial
		]);
		session()->setFlashdata('pesan', 'Resep Berhasil Diubah.');
		return redirect()->to(base_url('/recipe/'.$id_resep));
		
		
	}
	public function dashboardEdit($id_resep)
	{		
		
		$title =  ['title' => 'Buat Resep | Panganku'];
		$data = [
			'validation' =>  \Config\Services::validation(),
			'resep' => $this->resepModel->getResep($id_resep),
		];
		
		if(session()->get('is_admin')=="Y"){
		echo view('header_v',$title);
		echo view('recipe/dashboardedit_v', $data);
		echo view('footer_v');
		}
		else {
			session()->setFlashdata('pesan', 'Anda harus login sebagai admin');
				return redirect()->to(base_url('/login'));
		}

	}
	public function dashboardUpdate($id_resep)
	{
		if(!$this->validate([
		'judul' => ['rules'=>'required',
					'errors'=>[ 'required'=> ' Harus diisi']
				   ],
		'porsi' => ['rules'=>'required',
					'errors'=>[ 'required'=> 'Porsi Harus diisi']
					   ],
		'lama_memasak' => ['rules'=>'required|integer',
						   'errors'=>[ 'required'=> 'Lama Memasak Harus diisi',
									   'integer'=> 'Lama Memasak dalam bilangan angka dalam satuan menit'
									   ]
							 ],
		'bahan' => ['rules'=>'required',
					'errors'=>[ 'required'=> 'Bahan Harus diisi']
					   ],
		'tutorial' => ['rules'=>'required',
						'errors'=>[ 'required'=> 'Cara Memasak Harus diisi']
						 ],
						   	

		])) {
		// $validation = \Config\Services::validation();
		// return redirect()->to(base_url('/recipe/edit/'.$id_resep))->withInput()->with('validation',$validation);
		return redirect()->to(base_url('/recipe/dashboardEdit/'.$id_resep))->withInput();
		}

	$fileBanner = $this->request->getFile('gambar_banner');
	if ($fileBanner->getError() == 4) {
		$namaBanner = $this->request->getVar('gambar_banner_old');

	} else {
		$namaBanner = $fileBanner->getRandomName();
		$fileBanner->move(base_url().'img/recipe/', $namaBanner);
	}
///////////////////////////////////////////////////////////////////////

	$tutorial = $this->request->getFileMultiple('gambar_tutorial');
	$namaTutorial = "";
	//d($tutorial);
	if ($tutorial[0]->getName() == "" ) {
		$namaTutorial = $this->request->getVar('gambar_tutorial_old');
	} else {
		$fileTutorial = "";
		foreach ($tutorial as $tutorial) {
			$namaTutorial = $tutorial->getRandomName();
			$tutorial->move('img/recipe/', $namaTutorial);
			$fileTutorial.=$namaTutorial.',';
		}
		 
		$namaTutorial = substr($fileTutorial,0,-1);
	}
	
		
		
		// d( $this->request->getMultipleFile('gambar_tutorial'));
		// dd($namaTutorial);

		$this->resepModel->save([
			'id_resep' => $id_resep,
			'judul' => $this->request->getVar('judul'),
			'porsi' => $this->request->getVar('porsi'),
			'lama_memasak' => $this->request->getVar('lama_memasak'),
			'bahan' => $this->request->getVar('bahan'),
			'tutorial' => $this->request->getVar('tutorial'),
			'gambar_banner' => $namaBanner,
			'gambar_tutorial' => $namaTutorial
		]);
		session()->setFlashdata('pesan', 'Resep Berhasil Diubah.');
		return redirect()->to(base_url('/dashboard/resep'));
		
		
	}
	public function komentarSave($id_resep)
	{
		//  dd($this->request->getVar());
		if(!$this->validate([
			'komentar' => ['rules'=>'required',
						'errors'=>[ 'required'=> 'Komentar Harus diisi']
					   ],
			'gambar' =>['rules'=>'is_image[gambar]|mime_in[gambar,image/jpg,image/jpeg,image/png]',
							   'errors'=>[ 'is_image'	=> 'File harus berupa gambar',
											'mime_in'	=> 'File berformat jpg/jpeg/png']
							 ],


		])) {
			// $validation = \Config\Services::validation();
			// return redirect()->to(base_url('/recipe/create'))->withInput()->with('validation',$validation);
			return redirect()->to(base_url('/recipe/detail/'.$id_resep))->withInput();
		}
		// ambil gambar
		$fileGambar = $this->request->getFile('gambar');
		//dd($fileGambar);
		$namaGambar = "";
		if (! $fileGambar->getName() == "") {
		$namaGambar = $fileGambar->getRandomName();
		$fileGambar->move('img/recipe/komen', $namaGambar);
		}
		
		$this->komentarModel->save([
			'id_user' 		=> $this->request->getVar('id_user'),
			'id_resep' 		=> $this->request->getVar('id_resep'),
			'komentar' 		=> $this->request->getVar('komentar'),
			'gambar' => $namaGambar,
				
		]);
		
		session()->setFlashdata('pesan', 'Komentar Berhasil Ditambahkan.');
		return redirect()->to(base_url('/recipe/detail/'.$id_resep));
	
	}
	public function komentarDelete($id_komentar)
	{
		$id_resep = $this->request->getVar('id_resep');
		// dd($id_resep);
		$this->komentarModel->delete($id_komentar);
		session()->setFlashdata('pesan', 'Komentar Berhasil Dihapus.');
		return redirect()->to(base_url('/recipe/'.$id_resep));
	}	
	public function dashboardKomentarDelete($id_komentar)
	{
		if(session()->get('is_admin')=="Y"){
		$this->komentarModel->delete($id_komentar);
		session()->setFlashdata('pesan', 'Komentar Berhasil Dihapus.');
		return redirect()->to(base_url('/dashboard/komentar'));
		}
		else {
			session()->setFlashdata('pesan', 'Anda harus login sebagai admin');
				return redirect()->to(base_url('/login'));
		}
	}

	public function komentarEdit($id_komentar)
	{
		$id_resep = $this->request->getVar('id_resep');
		$title =  ['title' => 'Edit Komentar | Panganku'];
		$data = [
			'validation' =>  \Config\Services::validation(),
			'komentarresep' => $this->komentarModel->getKomentar($id_resep),
			'komentar' => $this->komentarModel->getKomentarbyid($id_komentar),

		];
		echo view('header_v',$title);
		echo view('/recipe/edit_komentar_v', $data);
		echo view('footer_v');
	}

	public function komentarUpdate($id_komentar){
		if(!$this->validate([
			'komentar' => ['rules'=>'required',
						'errors'=>[ 'required'=> 'Komentar Harus diisi']
					   ],
			'gambar' =>['rules'=>'is_image[gambar]|mime_in[gambar,image/jpg,image/jpeg,image/png]',
							   'errors'=>[ 'is_image'	=> 'File harus berupa gambar',
											'mime_in'	=> 'File berformat jpg/jpeg/png']
							 ],


		])) {
			// $validation = \Config\Services::validation();
			// return redirect()->to(base_url('/recipe/create'))->withInput()->with('validation',$validation);
			return redirect()->to(base_url('/recipe/detail/'.$id_resep))->withInput();
		}
		$fileGambar = $this->request->getFile('gambar');
		if ($fileGambar->getError() == 4) {
			$namaGambar = $this->request->getVar('gambarOld');
	
		} else {
			$namaGambar = $fileGambar->getRandomName();
			$fileGambar->move('img/recipe/komen', $namaGambar);
		}
		
		$this->komentarModel->save([
			'id_komentar' => $id_komentar,
			'komentar' 	  => $this->request->getVar('komentar'),
			'gambar'     => $namaGambar,
		]);
		session()->setFlashdata('pesan', 'Komentar Berhasil Diubah.');
		return redirect()->to(base_url('/recipe/detail/'.$this->request->getVar('id_resep')));
	}


	//--------------------------------------------------------------------

}
