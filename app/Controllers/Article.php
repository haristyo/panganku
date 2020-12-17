<?php namespace App\Controllers;
use App\Models\ArtikelModel;
use App\Models\UserModel;
class Article extends BaseController
{
	protected $artikelModel;
	public function __construct()
	{
		$this->artikelModel= new ArtikelModel();
		
	}
	public function index()
	{
		$_SESSION['last']= 'article/';
		//$artikel = $this->artikelModel->findAll();
		$data = [
			'artikel' => esc($this->artikelModel->getArtikelUser())
			
		];
		
		$title = [
			'title' => 'Artikel | Panganku'
		];
		// dd($data);
		// dd(session()->get('is_admin'));
		echo view('header_v',$title);
		echo view('article/article_v',$data);
		echo view('footer_v');
	}

	public function detail($id_artikel)
	{
		$_SESSION['last']= 'article/'.$id_artikel;
		$data = [
			'artikel' => esc($this->artikelModel->getArtikel($id_artikel)),
			'artikeluser' => esc($this->artikelModel->getArtikelUser($id_artikel))
		];
		$title = ['title' => 'Detail Artikel | Panganku'];
		// dd($data);
		echo view('header_v',$title);
		echo view('article/detail_v',$data);
		echo view('footer_v');
	}
	public function create()
	{
				
		$title =  ['title' => 'Buat Article | Panganku'];
		$data = [
			'validation' =>  \Config\Services::validation(),
			//'artikel' => $this->artikelModel->getArtikel()
		];
		// $uri = new \CodeIgniter\HTTP\URI(base_url('article/create'));
		$_SESSION['last']= 'article/create';
		// dd($uri->getPath());
		if(session()->get('is_admin')=="Y"){
			echo view('header_v',$title);
			echo view('article/create_v', $data);
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
						'errors'=>[ 'required'=> 'Judul Harus diisi']
					   ],
			'isi' => ['rules'=>'required',
						'errors'=>[ 'required'=> 'Isi Artikel Harus diisi']
			   			],
			'gambar' =>['rules'=>'uploaded[gambar]|is_image[gambar]|mime_in[gambar,image/jpg,image/jpeg,image/png]',
							   'errors'=>[ 'uploaded'	=> 'Artikel harus diberi gambar',
											'is_image'	=> 'File harus berupa gambar',
											'mime_in'	=> 'File berformat jpg/jpeg/png']
							 ],


		]))
		{
			return redirect()->to(base_url('/article/create'))->withInput();
		}
		$fileArtikel = $this->request->getFile('gambar');
		$namaArtikel = $fileArtikel->getRandomName();
		$fileArtikel->move('img/article/', $namaArtikel);

		$this->artikelModel->save([
			'id_user' 		=> $this->request->getVar('id_user'),
			'judul' 		=> $this->request->getVar('judul'),
			
			
			'isi' 		=> $this->request->getVar('isi'),
			'gambar' => $namaArtikel
			
						
		]);
		
		return redirect()->to(base_url('/article'));
	}
	public function delete($id_artikel)
	{
		if(session()->get('is_admin')=="Y"){
			$this->artikelModel->delete($id_artikel);
			session()->setFlashdata('pesan', 'Resep Berhasil Dihapus.');
			return redirect()->to(base_url('/article'));
		}
		else {
			session()->setFlashdata('pesan', 'Anda harus login sebagai admin');
				return redirect()->to(base_url('/login'));
		}
	}

	public function dashboardDelete($id_artikel)
	{
		$_SESSION['last']= 'article/'.$id_artikel;
		if(session()->get('is_admin')=="Y"){
		$this->artikelModel->delete($id_artikel);
		session()->setFlashdata('pesan', 'Resep Berhasil Dihapus.');
		return redirect()->to(base_url('/dashboard/artikel'));
		}
		else {
			session()->setFlashdata('pesan', 'Anda harus login sebagai admin');
				return redirect()->to(base_url('/login'));
		}
	}

	public function edit($id_artikel)
	{
		$title =  ['title' => 'Ubah Article | Panganku'];
		$data = [
			'validation' =>  \Config\Services::validation(),
			'artikel' => $this->artikelModel->getArtikel($id_artikel)
		];
		
		if(session()->get('is_admin')=="Y"){
			echo view('header_v',$title);
			echo view('article/edit_v', $data);
			echo view('footer_v');
			}
			else {
				session()->setFlashdata('pesan', 'Anda harus login sebagai admin');
					return redirect()->to(base_url('/login'));
			}
			// return redirect()->;
	}
	public function update($id_artikel)
	{
		if(!$this->validate([
			'judul' => ['rules'=>'required',
						'errors'=>[ 'required'=> 'Judul Harus diisi']
					   ],
			'isi' => ['rules'=>'required',
						'errors'=>[ 'required'=> 'Isi Artikel Harus diisi']
			   			],
			'gambar' =>['rules'=>'is_image[gambar]|mime_in[gambar,image/jpg,image/jpeg,image/png]',
							   'errors'=>[  'is_image'	=> 'File harus berupa gambar',
											'mime_in'	=> 'File berformat jpg/jpeg/png']
							 ],
		]))
		{
			return redirect()->to(base_url('/article/edit/'.$id_artikel))->withInput();
		}

		$fileArtikel = $this->request->getFile('gambar');
		if ($fileArtikel->getError() == 4){
			$namaArtikel = $this->request->getVar('gambar_old');
		}
		else {
			$namaArtikel = $fileArtikel->getRandomName();
			$fileArtikel->move('img/article', $namaArtikel);
		}
		$this->artikelModel->save([
			'id_artikel'	=> $id_artikel,
			'judul' 		=> $this->request->getVar('judul'),
			'isi' 			=> $this->request->getVar('isi'),
			'gambar' 		=> $namaArtikel				
		]);
		return redirect()->to(base_url('article/detail/'.$id_artikel));
		// return redirect();
		// return redirect()->back()->back()->back()->back()->back();
	}
	public function dashboardEdit($id_artikel)
	{
		$title =  ['title' => 'Ubah Article | Panganku'];
		$data = [
			'validation' =>  \Config\Services::validation(),
			'artikel' => $this->artikelModel->getArtikel($id_artikel)
		];
		
		if(session()->get('is_admin')=="Y"){
			echo view('header_v',$title);
			echo view('article/dashboardedit_v', $data);
			echo view('footer_v');
			}
			else {
				session()->setFlashdata('pesan', 'Anda harus login sebagai admin');
					return redirect()->to(base_url('/login'));
			}
			// return redirect()->;
	}
	public function dashboardUpdate($id_artikel)
	{
		if(!$this->validate([
			'judul' => ['rules'=>'required',
						'errors'=>[ 'required'=> 'Judul Harus diisi']
					   ],
			'isi' => ['rules'=>'required',
						'errors'=>[ 'required'=> 'Isi Artikel Harus diisi']
			   			],
			'gambar' =>['rules'=>'is_image[gambar]|mime_in[gambar,image/jpg,image/jpeg,image/png]',
							   'errors'=>[  'is_image'	=> 'File harus berupa gambar',
											'mime_in'	=> 'File berformat jpg/jpeg/png']
							 ],
		]))
		{
			return redirect()->to(base_url('/article/dashboardEdit/'.$id_artikel))->withInput();
		}

		$fileArtikel = $this->request->getFile('gambar');
		if ($fileArtikel->getError() == 4){
			$namaArtikel = $this->request->getVar('gambar_old');
		}
		else {
			$namaArtikel = $fileArtikel->getRandomName();
			$fileArtikel->move('img/article', $namaArtikel);
		}
		$this->artikelModel->save([
			'id_artikel'	=> $id_artikel,
			'judul' 		=> $this->request->getVar('judul'),
			'isi' 			=> $this->request->getVar('isi'),
			'gambar' 		=> $namaArtikel				
		]);
		return redirect()->to(base_url('/dashboard/artikel'));
		// return redirect();
		// return redirect()->back()->back()->back()->back()->back();
	}
	
	//--------------------------------------------------------------------

}
