<?php

namespace App\Controllers;

class Admin extends BaseController
{
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
