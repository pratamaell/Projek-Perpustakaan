<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ModelBuku;
use App\Models\ModelKategori;
use App\Models\ModelPenulis;
use App\Models\ModelPenerbit;
use CodeIgniter\Pager\Pager;

class Cbuku extends BaseController
{
    public function __construct()
    {
        helper('form');
        $this->ModelBuku = new ModelBuku;
        $this->ModelKategori = new ModelKategori;
        $this->ModelPenulis = new ModelPenulis;
        $this->ModelPenerbit = new ModelPenerbit;
    }


    public function paginateData()
{
    $model = new ModelBuku();
    $perPage = 3; // Jumlah data per halaman

    $data = [
        'menu' => 'masterdata',
        'submenu' => 'buku',
        'judul' => 'Data Informasi Buku',
        'page' => 'buku/v_buku',
        'buku' => $model->paginate($perPage), // Mengambil data berdasarkan halaman
        'pager' => $model->pager,
        'kategori' => $this->ModelKategori->AllData(),
        'penulis' => $this->ModelPenulis->AllData(),
        'penerbit' => $this->ModelPenerbit->AllData(),
    ];

    return view('v_template_admin', $data);
}


    public function index()
    {
        $pager = $this->ModelBuku->pager;
        $data = [
            'menu' => 'masterdata',
            'submenu'=> 'buku',
            'judul' => 'Data Informasi Buku',
            'page' => 'buku/v_buku',
            'pager' => $pager,
            'buku' => $this->ModelBuku->AllData(),
            'kategori' => $this->ModelKategori->AllData(),
            'penulis' => $this->ModelPenulis->AllData(),
            'penerbit' => $this->ModelPenerbit->AllData(),
        ];
        return view('v_template_admin', $data);
    }

    public function DetailBuku($id_buku) 
    {
        $data = [
            'id_buku' => $id_buku,
            'menu' => 'masterdata',
            'submenu'=> 'buku',
            'judul' => 'Data Buku',
            'page' => 'buku/v_detail_buku',
            'buku' => $this->ModelBuku->AmbilDetail($id_buku),
        ];
        return view('v_template_admin', $data);
    }


    public function TambahBuku()
    {
        if ($this->validate([
            'foto' => [
                'label' => 'Foto Buku',
                'rules' => 'uploaded[foto]|max_size[foto,10024]|mime_in[foto,image/png,image/jpg,image/gif,image/jpeg]',
                'errors' => [
                    'uploaded' => '{field} Wajib diisi !',
                    'max_size' => '{field} Max 1024 kb !',
                    'mime_in' => 'Format {field} Harus sesuai JPG, PNG, GIF, JPEG !',
                ]
            ],
        ])) {
            $foto = $this->request->getFile('foto');
            
            // Periksa apakah file gambar ada dan valid
            if ($foto && $foto->isValid()) {
                $nama_file = $foto->getRandomName();
                $data = [
                    'id' => $this->request->getPost('post_id'),
                    'judul' => $this->request->getPost('post_judul'),
                    'penulis_id' => $this->request->getPost('post_penulis'),
                    'kategori_id' => $this->request->getPost('post_kategori'),
                    'penerbit_id' => $this->request->getPost('post_penerbit'),
                    'jumlah' => $this->request->getPost('post_hlm'),
                    'tahun' => $this->request->getPost('post_qty'),
                    'lokasi' => $this->request->getPost('post_isbn'),
                    'foto_buku' => $nama_file,
                ];
                $foto->move('buku', $nama_file);
                $this->ModelBuku->TambahBuku($data);
                session()->setFlashdata('pesan', 'Data Buku Berhasil Ditambahkan');
                return redirect()->to(base_url('Cbuku/index'));
            } else {
                // Jika file tidak ada atau tidak valid
                session()->setFlashdata('errors', ['foto' => 'Gagal mengunggah file foto buku']);
                return redirect()->to(base_url('Cbuku/index'))->withInput('validation', \Config\Services::validation());
            }
        } else {
            // Jika validasi gagal
            session()->setFlashdata('errors', \Config\Services::validation()->getErrors());
            return redirect()->to(base_url('Cbuku/index'))->withInput('validation', \Config\Services::validation());
        }
    }
    
    public function HapusBuku($id_buku)
    {
        $data = [
            'id' => $id_buku
        ];

            $this->ModelBuku->HapusBuku($data);
            session()->setFlashdata('pesan', 'Buku Berhasil Dihapus');
            return redirect()->to(base_url('Cbuku'));  
    }


    public function EditBuku($id_buku)
    {
        
        $data = [
            'id' => $id_buku,
            'judul' => $this->request->getPost('post_judul'),
            'penulis_id' => $this->request->getPost('post_penulis'),
            'kategori_id' => $this->request->getPost('post_kategori'),
            'penerbit_id' => $this->request->getPost('post_penerbit'),
            'jumlah' => $this->request->getPost('post_hlm'),
            'tahun' => $this->request->getPost('post_qty'),
            'lokasi' => $this->request->getPost('post_isbn'),
            
        ];

            $this->ModelBuku->EditBuku($data);
            session()->setFlashdata('pesan', 'Data Buku Berhasil Diedit');
            return redirect()->to(base_url('Cbuku'));  
    }

    
}
