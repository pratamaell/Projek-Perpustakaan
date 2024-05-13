<?php

namespace App\Models;

use CodeIgniter\Database\SQLite3\Table;
use CodeIgniter\Model;

class ModelKategori extends Model
{
    public function AllData()
    {
        return $this->db->table('tb_kategori')
        ->orderBy('id','DESC')
        ->get()->getResultArray();
    }

    public function Add($data)
    {
        $this->db->table('tb_kategori')->insert($data);
    }

    public function DeleteData($data)
    {
        $this->db->Table('tb_kategori')
        ->where('id',$data['id'])
        ->delete($data);
    }

    public function EditData($data)
    {
        $this->db->Table('tb_kategori')
        ->where('id', $data['id'])
        ->update($data);
    }
}
