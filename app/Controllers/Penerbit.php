<?php

namespace App\Controllers;

use App\Controllers\BaseController;

use App\Models\ModelPenerbit;

class Penerbit extends BaseController
{
    public function __construct()
    {
        helper('form');
        $this->ModelPenerbit = new ModelPenerbit;
    }
    public function index()
    {
        $data = [
            'menu' => 'masterdata',
            'submenu' => 'penerbit',
            'judul' => 'Penerbit',
            'page' => 'v_penerbit',
            'Penerbit' => $this->ModelPenerbit->AllData(),
        ];
        return view('v_template_admin', $data);
    }
    public function AddData()
    {
        $data = [
            'nama' => $this->request->getPost('nama'),
        ];
        $this->ModelPenerbit->AddData($data);
        session()->setFlashdata('pesan', 'Data Berhasil Ditambahkan');
        return redirect()->to(base_url('Penerbit'));
    }
    public function EditData($id)
    {
        $data = [
            'id' => $id,
            'nama' => $this->request->getPost('nama')
        ];
        $this->ModelPenerbit->EditData($data);
        session()->setFlashdata('pesan', 'Data Berhasil DiUpdate');
        return redirect()->to(base_url('Penerbit'));
    }
    public function DeleteData($id)
    {
        $data = [
            'id' => $id,
        ];
        $this->ModelPenerbit->DeleteData($data);
        session()->setFlashdata('pesan', 'Data Berhasil DiHapus');
        return redirect()->to(base_url('Penerbit'));
    }
}
