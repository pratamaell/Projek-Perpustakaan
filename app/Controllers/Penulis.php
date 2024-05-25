<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ModelPenulis;

class Penulis extends BaseController
{
    public function __construct()
    {
        helper('form');
        $this->ModelPenulis = new ModelPenulis;
    }

    public function index()
    {
          $data = [
            'menu' => 'masterdata',
            'submenu'=> 'penulis',
            'judul' => 'Data Penulis Buku',
            'page' => 'v_penulis',
            'penulis' => $this->ModelPenulis->AllData(),
        ];
        return view('v_template_admin', $data);
    }

    public function Tambah()
    {
        $data = [
            'nama' => $this->request->getPost('nama'),
            'alamat' => $this->request->getPost('alamat'),
            'website' => $this->request->getPost('website')
        ];
            $this->ModelPenulis->Tambah($data);
            session()->setFlashdata('pesan', 'Data Penulis Berhasil Disimpan');
            return redirect()->to(base_url('Penulis'));  
    }

    public function HapusPenulis($id_penulis)
    {
        $data = [
            'id' => $id_penulis
        ];

            $this->ModelPenulis->HapusPenulis($data);
            session()->setFlashdata('pesan', 'Data penulis Berhasil Dihapus');
            return redirect()->to(base_url('Penulis'));  
    }

    public function EditPenulis($id_penulis)
    {
        $data = [
            'id' => $id_penulis,
            'nama' => $this->request->getPost('nama'), 
            'alamat' => $this->request->getPost('alamat'),
            'website' => $this->request->getPost('website')
        ];

            $this->ModelPenulis->Editpenulis($data);
            session()->setFlashdata('pesan', 'Penulis Berhasil Disimpan');
            return redirect()->to(base_url('Penulis'));  
    }
}
