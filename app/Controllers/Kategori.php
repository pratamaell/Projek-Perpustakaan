<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ModelKategori;

class Kategori extends BaseController

{
    public function __construct()
    {
        helper('form');
        $this->ModelKategori = new ModelKategori;
    }

    public function index()
    {
        $data = [
            'menu' => 'masterdata',
            'submenu'=> 'kategori',
            'judul' => 'Kategori',
            'page' => 'v_kategori',
            'kategori' => $this->ModelKategori->AllData(),
        ];
        return view('v_template_admin', $data);
    }

    public function Tambah()
    {
        $data = [
            'nama' => $this->request->getPost('nama')
        ];
            $this->ModelKategori->Tambah($data);
            session()->setFlashdata('pesan', 'Kategori Berhasil Disimpan');
            return redirect()->to(base_url('Kategori'));  
    }

    public function EditKategori($id_kategori)
    {
        $data = [
            'id' => $id_kategori,
            'nama' => $this->request->getPost('nama')  
        ];

            $this->ModelKategori->EditKategori($data);
            session()->setFlashdata('pesan', 'Kategori Berhasil Disimpan');
            return redirect()->to(base_url('Kategori'));  
    }

    public function HapusKategori($id_kategori)
    {
        $data = [
            'id' => $id_kategori
        ];

            $this->ModelKategori->HapusKategori($data);
            session()->setFlashdata('pesan', 'Kategori Berhasil Dihapus');
            return redirect()->to(base_url('Kategori'));  
    }
}
