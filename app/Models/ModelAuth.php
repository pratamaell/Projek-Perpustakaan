<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelAuth extends Model
{
    public function LoginUser($email, $password){
        return $this->db->table('tb_user')
        ->where([
            'email' => $email,
            'password' => $password,
        ])->get()->getRowArray();
    }
    public function Daftar($data){
        $this->db->table('tb_user')->insert($data);
    }
}