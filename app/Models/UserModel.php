<?php namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table      = 'user';
    protected $primaryKey = 'id_user';
    protected $useTimestamps = true;
    protected $allowedFields = ['username','nama_lengkap','email','password','jenis_kelamin','alamat','gambar_profile','bio','is_admin'];
    public function getUser($id_user = false)
    {
     if ($id_user == false){
         return $this->get()->getResultArray();
    }
    return $this->getWhere($id_user)->getResultArray()->first();
    }
    public function count()
    {
        return $this->countAll();
    }
}