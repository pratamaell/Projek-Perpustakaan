<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelBuku extends Model
{

    public function AllData()
    {
        return $this->db->table('tb_buku')
        ->join('tb_penulis', 'tb_penulis.id = tb_buku.penulis_id', 'left')
        ->join('tb_penerbit', 'tb_penerbit.id = tb_buku.penerbit_id', 'left')
        ->join('tb_kategori', 'tb_kategori.id = tb_buku.kategori_id', 'left')
        ->get()->getResultArray();
    }

    public function AmbilDetail($id_buku)
    {
        return $this->db->table('tb_buku')
        ->join('tb_penulis', 'tb_penulis.id = tb_buku.penulis_id', 'left')
        ->join('tb_penerbit', 'tb_penerbit.id = tb_buku.penerbit_id', 'left')
        ->join('tb_kategori', 'tb_kategori.id = tb_buku.kategori_id', 'left')
        ->where('id', $id_buku)->get()->getRowArray();
    }

    public function TambahBuku($data)
    {
        unset($data['id']);
        $this->db->table('tb_buku')->insert($data);
    }

    public function HapusBuku($data)
    {
        $this->db->table('tb_buku')->where('id', $data['id'])->delete($data);
    } 

    public function EditBuku($data)
    {
        $this->db->table('tb_buku')->where('id', $data['id'])->update($data);
        
    } 

    // Model Buku Donut Chart
    public function GetBookCountPerCategory()
    {
        return $this->db->table('tb_buku')
            ->select('tb_kategori.nama, COUNT(tb_buku.id) as jumlah_buku')
            ->join('tb_kategori', 'tb_kategori.id = tb_buku.kategori_id')
            ->groupBy('tb_buku.kategori_id')
            ->get()
            ->getResultArray();
    }


    public function JumlahBuku()
    {
        return $this->db->table('tb_buku')->countAll();
    }



}
