<?php namespace App\Controllers;
use App\Models\UserModel;
class User extends BaseController
{
	protected $userModel;
	public function __construct()
	{
		$this->userModel = new UserModel();
		// if (!isset($_SESSION['last'])) {
		// 	$_SESSION['last'] = "";
		// };
	}
	public function login()
	{
		$title = [
			'title' => 'Login | Panganku'
		];
		$data = [
			'validation' =>  \Config\Services::validation()
		];
		echo view('header_v',$title);
		echo view('user/login_v',$data);
		echo view('footer_v');
	}
	public function auth(){
		$session = session();
		$username = $this->request->getVar('username');
		$password = $this->request->getVar('password');
		$data = $this->userModel->where('username',$username)->first();
		// dd($_SESSION['last']);
		if($data){
			$pass = $data['password'];
			$verify_pass = ($pass == $password);
			// dd($verify_pass);
			if ($verify_pass) {
				$sess_data = [
					'id_user' => $data['id_user'],
					'is_admin' => $data['is_admin'],
					'username' => $data['username'],
					'logged_in'=> TRUE
				];
				$session->set($sess_data);
				// dd($_SESSION['last']);
				if ($_SESSION['last'] == "") {
					return redirect()->to(base_url());
					// $_SESSION['last']= $uri->getPath();
				}
				else{ 
					return redirect()->to(base_url($_SESSION['last']));
				}
			}
			else {
				$session->setFlashdata('pesan', 'Password salah');
				return redirect()->to(base_url('login'));
			}
		}
		else {
			$session->setFlashdata('pesan', 'Username Tidak terdaftar');
			return redirect()->to(base_url('login'));
		}
	}

	public function register()
	{
		$title = [
			'title' => 'Register | Panganku'
		];
		$data = [
			'validation' =>  \Config\Services::validation(),
			'is_admin' => 'N'
		];
		echo view('header_v',$title);
		echo view('user/register_v',$data);
		echo view('footer_v');
	}

	public function registerAdmin()
	{
		$title = [
			'title' => 'Register | Panganku'
		];
		$data = [
			'validation' =>  \Config\Services::validation(),
			'is_admin' => 'Y'
		];
		echo view('header_v',$title);
		echo view('user/register_admin_v',$data);
		echo view('footer_v');
	}
	public function addUser()
	{
		if(!$this->validate([
			'username' => ['rules'=>'required|is_unique[user.username]',
						'errors'=>[ 'required'=>  'Harus diisi',
									'is_unique'=> 'Username telah digunakan']
					   ],
			'password' => ['rules'=>'required|min_length[8]',
							 'errors'=>[ 'required'=>  'Password wajib diisi',
							 			'min_length'=> 'Password minimal 8 karakter']

							  ],
			'email' => ['rules'=>'required|is_unique[user.email]',
						'errors'=>[ 'required'=> 'Email Harus diisi',
									'is_unique'=>'Email Pernah digunakan']
						   ],
			'jenis_kelamin' => ['rules'=> 'required|in_list[L,P]'],
			'nama_lengkap' => ['rules'=>'required',
							'errors'=>[ 'required'=>  'Isi Dengan nama lengkap anda']
							 ],
			'alamat' => ['rules'=>'required',
							 'errors'=>[ 'required'=>  'Isi Dengan alamat anda']
							  ],
			'bio' => ['rules'=>'required',
							  'errors'=>[ 'required'=>  'Isi Dengan bio anda']
							   ],
			'gambar_profile' =>['rules'=>'uploaded[gambar_profile]|is_image[gambar_profile]|mime_in[gambar_profile,image/jpg,image/jpeg,image/png]',
							   'errors'=>[ 'uploaded'	=> 'Gambar Profile harus diisi',
											'is_image'	=> 'File harus berupa gambar',
											'mime_in'	=> 'File berformat jpg/jpeg/png']
							 ],


		])) {
			// $validation = \Config\Services::validation();
			// return redirect()->to(base_url('/recipe/create'))->withInput()->with('validation',$validation);
			return redirect()->to(base_url('/register/'))->withInput();
		}
		$fileProfile = $this->request->getFile('gambar_profile');
		$namaProfile = $fileProfile->getRandomName();
		$fileProfile->move('img/user/', $namaProfile);

		$this->userModel->save([
			'username' 		=> $this->request->getVar('username'),
			'nama_lengkap' 	=> $this->request->getVar('nama_lengkap'),
			'email'     	=> $this->request->getVar('email'),
			'password' 		=> $this->request->getVar('password'),
			'jenis_kelamin' => $this->request->getVar('jenis_kelamin'),
			'alamat' 		=> $this->request->getVar('alamat'),
			'jenis_kelamin' => $this->request->getVar('jenis_kelamin'),
			'bio' 			=> $this->request->getVar('bio'),
			'is_admin'		=> $this->request->getVar('is_admin'),
			'gambar_profile' => $namaProfile				
		]);
		session()->setFlashdata('pesan', 'User Berhasil Ditambahkan.');
		return redirect()->to(base_url('/login'));
	}
	public function logout()
    {
		session()->destroy();
		session()->setFlashdata('pesan', 'Anda telah logout.');
		return redirect()->to(base_url('/login'));
        
    }


	//--------------------------------------------------------------------

}