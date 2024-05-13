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
}
