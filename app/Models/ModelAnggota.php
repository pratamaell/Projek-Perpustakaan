<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelAnggota extends Model
{

    public function ProfileAnggota($id){
        return $this->db->table('tb_user')
            ->where('id',$id) ->get()->getRowArray();
    }
    public function EditProfil($data)
    {
        $this->db->table('tb_user')
        ->where('id', $data['id'])
            ->update($data);
    }
    public function DetailData($id_anggota){
        return $this->db->table('tb_user')
        ->where('id', $id_anggota)
        ->get()->getRowArray();
    }

    public function AllData()
    {
        return $this->db->table('tb_user')
        ->get()->getResultArray();
    }

    
    public function JumlahAnggota()
    {
        return $this->db->table('tb_buku')->countAll();
    }



    

}
