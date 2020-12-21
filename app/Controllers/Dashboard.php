<?php namespace App\Controllers;
use App\Models\ResepModel;
use App\Models\KomentarModel;
use App\Models\ArtikelModel;
use App\Models\UserModel;
use CodeIgniter\I18n\Time;
use CodeIgniter\Exceptions\PageNotFoundException;
class Dashboard extends BaseController
{
    public function __construct()
	{
		
		$this->resepModel = new ResepModel();
        $this->komentarModel = new KomentarModel();
        $this->userModel = new UserModel();
        $this->artikelModel = new ArtikelModel();
	}
	public function index()
	{
        
        $title = [
			'title' => 'Dashboard Admin | Panganku'
			
        ];
        $data =[
            'user' => $this->userModel->count(),
            'resep' => $this->resepModel->count(),
            'komentar' => $this->komentarModel->count(),
            'artikel' => $this->artikelModel->count()
        ];
        // sdd($data);
        $_SESSION['last'] = 'dashboard';
        echo view('header_v',$title);
        echo view('sidebar_v');
        echo view('/dashboard/index_v',$data);
        echo ("</div>");
		echo view('footer_v');
	}

    public function artikel()
	{
        $_SESSION['last'] = 'dashboard/artikel';
        // dd();
        $title = [
			'title' => 'Dashboard Artikel | Panganku'
			
        ];
        $data = [
            'artikel' => esc($this->artikelModel->getArtikelUser())
        ];
        //  dd($data);
        if(session()->get('is_admin')=="Y"){
        echo view('header_v',$title);
        echo view('sidebar_v');
        echo view('dashboard/article_v',$data);
        // d($data);
        echo ("</div>");
        echo view('footer_v');
            }
            else {
                session()->setFlashdata('pesan', 'Anda harus login sebagai admin');
                return redirect()->to(base_url('/login'));
            }
    }

    public function resep()
	{
        $_SESSION['last'] = 'dashboard/resep';
        $title = [
			'title' => 'Dashboard Resep | Panganku'
			
        ];
        $data = [
            'resep' => esc($this->resepModel->getResep()),
            'tgl' => new Time('now', 'America/Chicago', 'en_US')
            
        ];
        // d($data);
        if(session()->get('is_admin')=="Y"){
        echo view('header_v',$title);
        echo view('sidebar_v');
        echo view('/dashboard/recipe_v',$data);
        // d($data);
        echo ("</div>");
        echo view('footer_v');

            }
            else {
                session()->setFlashdata('pesan', 'Anda harus login sebagai admin');
                return redirect()->to(base_url('/login'));
            }
    }
    public function user()
	{
        $_SESSION['last'] = 'dashboard/user';
        $title = [
			'title' => 'Dashboard User | Panganku'
			
        ];
        $data = [
            'user' => esc($this->userModel->getUser())
            
        ];
        //  dd($data);
        if(session()->get('is_admin')=="Y"){
        
        echo view('header_v',$title);
        echo view('sidebar_v');
        echo view('/dashboard/user_v',$data);
        // d($data);
        echo ("</div>");
        echo view('footer_v');
        }
        else {
            session()->setFlashdata('pesan', 'Anda harus login sebagai admin');
            return redirect()->to(base_url('/login'));
        }
    }

    public function komentar($id_komentar = false)
	{
        $_SESSION['last'] = 'dashboard/komentar';
        $title = [
            'title' => 'Dashboard Komentar | Panganku'
            
			
        ];
        $data = [
            'komentaruserresep' => $this->komentarModel->getKomentarUserResep($id_komentar)
        ];
        //  dd($this->komentarModel->getKomentar());
    //    dd($this->komentarModel->getKomentarUserResep());
    // dd($data);
        if(session()->get('is_admin')=="Y"){
        echo view('header_v',$title);
        echo view('sidebar_v');
        echo view('/dashboard/komentar_v',$data);
        echo ("</div>");
        echo view('footer_v');
            }
            else {
                session()->setFlashdata('pesan', 'Anda harus login sebagai admin');
                return redirect()->to(base_url('/login'));
            }
	}

}