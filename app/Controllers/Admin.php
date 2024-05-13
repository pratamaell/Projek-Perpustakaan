<?php

namespace App\Controllers;
use App\Models\ModelAdmin;

class Admin extends BaseController
{
    public function __construct(){
        
        $this->ModelAdmin = new ModelAdmin;
     }
    public function index(): string
    {
        $data = [
            'menu' => 'dasboard',
            'submenu' => '',
            'judul' => 'Dasboard',
            'page' => 'v_dashboard_admin',
            'totalanggota' => $this->ModelAdmin->TotalAnggota(),
        ];
        return view('v_template_admin',$data);
    }
}
