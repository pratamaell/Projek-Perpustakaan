<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelPenerbit extends Model
{
    public function AllData()
    {
        return $this->db->table('tb_penerbit')->orderBy('id', 'DESC')->get()->getResultArray();
    }

    public function Tambah($data)
    {
        $this->db->table('tb_penerbit')->insert($data);
    }

    public function HapusPenerbit($data)
    {
        $this->db->table('tb_penerbit')->where('id', $data['id'])->delete($data);
    } 

    public function EditPenerbit($data)
    {
        $this->db->table('tb_penerbit')->where('id', $data['id'])->update($data);
    } 
}
