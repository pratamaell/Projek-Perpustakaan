<?php

namespace App\Controllers;

use App\Models\ModelAuth;

class Auth extends BaseController
{
    public function __construct(){
       helper('form');
       $this->ModelAuth = new ModelAuth;
    }
    public function index(): string
    {

        $data = [
            'judul' => 'Login',
            'page' => 'v_login',
        ];
        return view('v_template_login',$data);
    }

    public function LoginUser(){
        $data = [
            'judul' => 'Login User',
            'page' => 'v_login_user',
        ];
        return view('v_template_login',$data);
    }

    public function CekLoginUser(){
        if ($this->validate([
            'email' => [
                'label' => 'E-Mail',
                'rules' => 'required|valid_email',
                'errors' => [
                    'required'=>'{field} masih kosong !',
                    'valid_email' => '{field} Harus format E-Mail !',
                ]
            ],
            'password' => [
                'label' => 'Password',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} masih kosong !',
                ]
            ],
        ])) {
            //jika entry valid
            $email = $this->request->getPost('email');
            $password = $this->request->getPost('password');
            $cek_login = $this->ModelAuth->LoginUser($email,$password);
            if ($cek_login) {
                //jika login berhasil
                session()->set('nama',$cek_login['nama']);
                session()->set('email',$cek_login['email']);
                session()->set('role',$cek_login['role']);
                return redirect()->to(base_url('Admin'));
            }else {
                //jika login gagal
                session()->setFlashdata('pesan','E-mail atau Password salah !');
                return redirect()->to(base_url('Auth/LoginUser'));
            }
        }else {
            //jika entry tidak valid
            session()->setFlashdata('errors', \Config\Services::validation()->getErrors());
            return redirect()->to(base_url('Auth/LoginUser'));
        }
    }

    public function LoginAnggota(){
        $data = [
            'judul' => 'Login Anggota',
            'page' => 'v_login_anggota',
        ];
        return view('v_template_login',$data);
    }

    public function LogOut(){
        session()->remove('nama');
        session()->remove('email');
        session()->remove('role');
        session()->setFlashdata('pesan','Logout Sukses !');
         return redirect()->to(base_url('Auth/LoginUser'));
    }
}
