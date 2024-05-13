<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\ModelAnggota;

class DashboardAnggota extends BaseController
{

    public function __construct(){
        helper('form');
        $this->ModelAnggota = new ModelAnggota;
    }

    public function index()
    {
        $id = session()->get('id');
        $data = [
            'menu' => 'dasboard',
            'submenu' => '',
            'judul' => 'Profile Anggota',
            'page' => 'v_dashboard_anggota',
            'anggota' => $this->ModelAnggota->ProfileAnggota($id),
        ];
        return view('v_template_anggota',$data);
    }
    public function EditProfil(){
        $id_anggota= session()->get('id');
        $data=[
         'menu'=>'dashboard',
         'submenu'=>'',
         'judul'=>'Edit Profile Anggota',
         'page'=>'v_edit_profile_anggota',
         'anggota'=>$this->ModelAnggota->ProfileAnggota($id_anggota),
        ];
        return view('v_template_anggota',$data);

    }
    public function UpdateProfile(){
        $id_anggota= session()->get('id');
        if ($this->validate([
            'nama' => [
                'label' => 'Nama',
                'rules' => 'required',
                'errors' => [
                    'required'=>'{field} masih kosong !',
                    
                ]
            ],
            'jk' => [
                'label' => 'Jk',
                'rules' => 'required',
                'errors' => [
                    'required'=>'{field} Jenis kelamin harus dipilih !',
                    
                ]
            ],
           
            'telp' => [
                'label' => 'Telp',
                'rules' => 'required',
                'errors' => [
                    'required'=>'{field} masih kosong !',
                    
                ]
            ],
            'alamat' => [
                'label' => 'Alamat',
                'rules' => 'required',
                'errors' => [
                    'required'=>'{field} masih kosong !',
                    
                ]
            ],
            
            'username' => [
                'label' => 'Username',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} masih kosong !',
                   
                ]
            ],
            'foto'=>[
                'label'=>'Foto Anggota',
                'rules'=>'max_size[foto,1024]|mime_in[foto,image/jpg,image/jpeg]',
                'errors'=>[
                    'max_size'=>'{field} Max 1024 Kb',
                    'mime_in'=>'Format{field} Harus JPG Atau JPEG'
                ]
            ]
            
        ])) {
            $foto=$this->request->getFile('foto');
            if($foto->getError()==4){
                $data=[
                'id'=>$id_anggota,
                'nama' => $this->request->getPost('nama'),
                'jk' => $this->request->getPost('jk'),
                'telp' => $this->request->getPost('telp'),
                'alamat' => $this->request->getPost('alamat'),
                'username' => $this->request->getPost('username'), 
                'password' => $this->request->getPost('password'), 
            ];
            $this->ModelAnggota->EditData($data);
                
            }else{
                //hapus foto lama
                $anggota=$this->ModelAnggota->DetailData($id_anggota);
                if($anggota['foto']<>''){
                    unlink('foto/'.$anggota['foto']);
                }
                $nama_file=$foto->getRandomName();
                $data=[
                    'id'=>$id_anggota,
                'nama' => $this->request->getPost('nama'),
                'jk' => $this->request->getPost('jk'),
                'telp' => $this->request->getPost('telp'),
                'alamat' => $this->request->getPost('alamat'),
                'role' => $this->request->getPost('role'),
                'username' => $this->request->getPost('username'), 
                'password' => $this->request->getPost('password'), 
                'verifikasi'=>'1',
                'foto'=>$nama_file
                ];
                //memindahkan/upload file foto ke dalam folder foto
                $foto->move('foto', $nama_file);
                $this->ModelAnggota->EditData($data);
                
            }
            session()->setFlashdata('pesan', 'data anggota berhasil di update');
            return redirect()->to(base_url('DashboardAnggota/EditProfil'));
        }else{
            session()->setFlashdata('errors', \Config\Services::validation()->getErrors());
            return redirect()->to(base_url('DashboardAnggota/EditProfil'));
        }    
    }

}
