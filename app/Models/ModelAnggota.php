<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelAnggota extends Model
{
    public function ProfileAnggota($id){
        return $this->db->table('tb_user')
            ->where('id',$id) ->get()->getRowArray();
    }
    public function EditData($data){
        {
            $this->db->table('tb_user')->update($data);
        }
    }
}