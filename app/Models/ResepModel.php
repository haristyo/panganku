<?php namespace App\Models;

use CodeIgniter\Model;

class ResepModel extends Model
{
    protected $table      = 'resep';
    protected $primaryKey = 'id_resep';
    protected $createdField  = 'created_resep';
    protected $updatedField  = 'updated_resep';
    protected $useTimestamps = true;
    protected $allowedFields = ['id_user','judul','porsi','lama_memasak','bahan','tutorial','gambar_banner','gambar_tutorial'];
    public function getResep($id_resep = false)
    {
     if ($id_resep == false){
        // $this->builder();
         //>findAll()->orderBy('id_resep',ASC)
         return $this->join('user','user.id_user=resep.id_user')->orderBy('id_resep', 'ASC')->get()->getResultArray();
        }
    return $this->join('user','user.id_user=resep.id_user')->where(['id_resep' => $id_resep])->first();
    }
    public function count()
    {
        return $this->countAll();
    }

}
// public function getKomentar($id_resep = false)
// {
//     if ($id_resep == false){
//         return $this->join('user','user.id_user=komentar.id_user')->findAll();
//    }
//    //return $this->Where(['id_komentar' => $id_komentar])->first()
//     return $this->join('user','user.id_user=komentar.id_user')->getWhere(['id_resep' => $id_resep])->getResultArray();
// }