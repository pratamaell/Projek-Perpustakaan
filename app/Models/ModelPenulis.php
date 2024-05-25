<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelPenulis extends Model
{
    public function AllData()
    {
        return $this->db->table('tb_penulis')->orderBy('id', 'DESC')->get()->getResultArray();
    }

    public function Tambah($data)
    {
        $this->db->table('tb_penulis')->insert($data);
    }

    public function Hapuspenulis($data)
    {
        $this->db->table('tb_penulis')->where('id', $data['id'])->delete($data);
    } 

    public function Editpenulis($data)
    {
        $this->db->table('tb_penulis')->where('id', $data['id'])->update($data);
    } 
}
