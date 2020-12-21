<?php namespace App\Models;

use CodeIgniter\Model;

class ArtikelModel extends Model
{
    protected $table      = 'artikel';
    protected $primaryKey = 'id_artikel';
    protected $useTimestamps = false;
    protected $allowedFields = ['id_user','judul','isi','gambar'];
    public function getArtikelUser($id_artikel = false)
    {
     if ($id_artikel == false){
         return $this->join('user','user.id_user=artikel.id_user')->findAll();
     } 
     return $this->join('user','user.id_user=artikel.id_user')->where('id_artikel',$id_artikel)->first();
    }
    
    public function getArtikel($id_artikel = false)
    {
        if ($id_artikel == false){
            return $this->findAll();
       }
       return $this->Where(['id_artikel' => $id_artikel])->first();
    }
    public function count()
    {
        return $this->countAll();
    }

}