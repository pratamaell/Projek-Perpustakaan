<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
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
            'judul' => 'Kategori',
            'page' => 'v_kategori',
            'Kategori' => $this->ModelKategori->AllData(),
        ];
        return view('v_template_admin', $data);
    }

    public function Add()
    {
        $data = ['nama'=>$this->request->getPost('nama')];
        $this->ModelKategori->Add($data);
        session()->setFlashdata('pesan', 'Data Berhasil Ditambahkan');
        return redirect()->to(base_url('Kategori'));
    }

    public function EditData($id)
    {
        $data = [
            'id' => $id,
            'nama' => $this->request->getPost('nama')
        ];
        $this->ModelKategori->EditData($data);
        session()->setFlashdata('pesan', 'Data Berhasil DiUpdate');
        return redirect()->to(base_url('Kategori'));
    }

    public function DeleteData($id)
    {
        $data = ['id' => $id];
        $this->ModelKategori->DeleteData($data);
        session()->setFlashdata('pesan', 'Data Berhasil DiHapus');
        return redirect()->to(base_url('Kategori'));
    }
}
