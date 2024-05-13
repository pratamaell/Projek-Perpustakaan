<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelAdmin extends Model
{

    public function TotalBuku(){        
    }

    public function TotalAnggota(){
        $this->db->table('tb_user')->countAll();
    }
}