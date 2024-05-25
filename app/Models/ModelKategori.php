<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelKategori extends Model
{
    public function AllData()
    {
        return $this->db->table('tb_kategori')->orderBy('id', 'DESC')->get()->getResultArray();
    }

    public function Tambah($data)
    {
        $this->db->table('tb_kategori')->insert($data);
    }

    public function HapusKategori($data)
    {
        $this->db->table('tb_kategori')->where('id', $data['id'])->delete($data);
    } 

    public function EditKategori($data)
    {
        $this->db->table('tb_kategori')->where('id', $data['id'])->update($data);
    } 
}
