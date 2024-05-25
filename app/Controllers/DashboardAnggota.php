<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ModelAnggota;
use CodeIgniter\HTTP\ResponseInterface;

class DashboardAnggota extends BaseController
{
    protected $modelAnggota;

    public function __construct()
    {
        helper('form');
        $this->modelAnggota = new ModelAnggota();
    }

    public function index()
    {
        $id = session()->get('id');
        $data = [
            'menu' => 'dashboard',
            'submenu' => '',
            'judul' => 'Profile Anggota',
            'page' => 'v_dashboard_anggota',
            'anggota' => $this->modelAnggota->ProfileAnggota($id),
        ];
        return view('v_template_anggota', $data);
    }

    public function EditProfil()
    {
        $id_anggota = session()->get('id');
        $data = [
            'menu' => 'dashboard',
            'submenu' => '',
            'judul' => 'Edit Profile Anggota',
            'page' => 'v_edit_profile_anggota',
            'anggota' => $this->modelAnggota->ProfileAnggota($id_anggota),
        ];
        return view('v_template_anggota', $data);
    }

    public function UpdateProfile()
    {
        $id_anggota = session()->get('id');
        $validationRules = [
            'nama' => [
                'label' => 'Nama',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} masih kosong!',
                ]
            ],
            'jk' => [
                'label' => 'Jk',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Jenis kelamin harus dipilih!',
                ]
            ],
            'telp' => [
                'label' => 'Telp',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} masih kosong!',
                ]
            ],
            'alamat' => [
                'label' => 'Alamat',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} masih kosong!',
                ]
            ],
            'username' => [
                'label' => 'Username',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} masih kosong!',
                ]
            ],
            'foto' => [
                'label' => 'Foto Anggota',
                'rules' => 'max_size[foto,1024]|mime_in[foto,image/jpg,image/jpeg]',
                'errors' => [
                    'max_size' => '{field} Max 1024 Kb',
                    'mime_in' => 'Format {field} harus JPG atau JPEG',
                ]
            ]
        ];

        if ($this->validate($validationRules)) {
            $foto = $this->request->getFile('foto');
            $data = [
                'id' => $id_anggota,
                'nama' => $this->request->getPost('nama'),
                'jk' => $this->request->getPost('jk'),
                'telp' => $this->request->getPost('telp'),
                'alamat' => $this->request->getPost('alamat'),
                'username' => $this->request->getPost('username'),
                'password' => $this->request->getPost('password'), // Hash the password
            ];

            if ($foto && $foto->isValid() && !$foto->hasMoved()) {
                $anggota = $this->modelAnggota->DetailData($id_anggota);
                if (!empty($anggota['foto']) && file_exists('foto/' . $anggota['foto'])) {
                    unlink('foto/' . $anggota['foto']);
                }

                $nama_file = $foto->getRandomName();
                $foto->move('foto', $nama_file);
                $data['foto'] = $nama_file;
            } else {
                // If no photo is uploaded, don't change the 'foto' field
                unset($data['foto']);
            }

            $this->modelAnggota->EditProfil($data);

            session()->setFlashdata('pesan', 'Data anggota berhasil diupdate');
            return redirect()->to(base_url('DashboardAnggota/EditProfil'));
        } else {
            session()->setFlashdata('errors', $this->validator->getErrors());
            return redirect()->to(base_url('DashboardAnggota/EditProfil'))->withInput();
        }
    }
}