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

    public function DetailPinjam($id_pinjam)
    {
        $detailData = $this->ModelPeminjaman->getDetailData($id_pinjam);
        $data = [
            'menu' => 'pengajuan',
            'submenu'=> 'pengajuanmasuk',
            'judul' => 'Pengajuan Masuk',
            'page' => 'v_peminjaman/v_detail',
            'detailData' => $detailData,
        ];
        return view('v_template_admin', $data);
    }

    public function PengajuanMasuk()
    {
        $data = [
            'menu' => 'pengajuan',
            'submenu'=> 'pengajuanmasuk',
            'judul' => 'Pengajuan Masuk',
            'page' => 'v_peminjaman/v_pengajuanMasuk',
            'pengajuanbuku' => $this->ModelPeminjaman->PengajuanMasuk(),
        ];
        return view('v_template_admin', $data);
    }

    public function AmbilBuku($id_pinjam)
    {
        $data = [
            'id' => $id_pinjam,
            'status'=> 'Dipinjam',
        ];

        $this->ModelPeminjaman->EditData($data);
        session()->setFlashdata('Diambil', ' Buku sudah diambil oleh peminjam');
        return redirect()->to(base_url('Admin/InfoPinjam'));  
    }

    public function BelumKembali($id_pinjam)
    {
        $data = [
            'id' => $id_pinjam,
            'status'=> 'Belum Kembali',
        ];

        $this->ModelPeminjaman->EditData($data);
        session()->setFlashdata('diterima', 'Pengajuan Peminjaman Berhasi Diterima');
        return redirect()->to(base_url('Admin/PengajuanMasuk'));  
    }

    public function PengajuanDitolak()
    {
        $data = [
            'menu' => 'pengajuan',
            'submenu'=> 'pengajuantolak',
            'judul' => 'Denda Peminjaman Terlambat',
            'page' => 'v_peminjaman/v_tolak',
            'tolak' => $this->ModelPeminjaman->Denda(),
        ];
        return view('v_template_admin', $data);
    }

    public function PengajuanDiterima()
    {
        $data = [
            'menu' => 'pengajuan',
            'submenu'=> 'pengajuanterima',
            'judul' => 'Informasi Peminjaman Pengajuan Buku',
            'page' => 'v_peminjaman/v_terima',
            'terima' => $this->ModelPeminjaman->Terima(),
           
        ];
        return view('v_template_admin', $data);
    }


    public function InfoPinjam()
    {
        $data = [
            'menu' => 'pengajuan',
            'submenu'=> 'pinjambuku',
            'judul' => 'Informasi Buku yang dipinjam',
            'page' => 'v_peminjaman/v_info',
            'info' => $this->ModelPeminjaman->InfoPinjam(),
        ];
        return view('v_template_admin', $data);
    }

    public function History()
    {
        $data = [
            'menu' => 'pengajuan',
            'submenu'=> 'history',
            'judul' => 'Riwayat Peminjaman Buku',
            'page' => 'v_peminjaman/v_history',
            'hst' => $this->ModelPeminjaman->HistoryBuku(),
            'info' => $this->ModelPeminjaman->InfoPinjam(),
        ];

        return view('v_template_admin', $data);
    }

   
  
    public function dashboard()
    {
        $data = [
            'page' => 'v_admin',
            'donut' => $this->ModelBuku->GetBookCountPerCategory(),
        ];

        return view('v_template_admin', $data);
    }

    // public function PengembalianBuku($id_pinjam)
    // {
    //     $data = [
    //         'status_pinjam' => $this->request->getPost('post_kembali'),
    //     ];

    //     $this->ModelPeminjaman->EditData($data);
    // }

    public function SimpanPengembalian($id_pinjam)
    {
        $ModelPeminjaman = new \App\Models\ModelPeminjaman();

        $peminjaman = $ModelPeminjaman->find($id_pinjam);

        if ($peminjaman) {
            // Cek jika tgl_terlambat sudah tersimpan di database
            if ($peminjaman['tgl_terlambat'] === null) {
                // Simpan tgl_terlambat (tanggal hari ini) ke dalam database
                $tglTerlambat = date('Y-m-d');
                $data = [
    
                    'tgl_terlambat' => $tglTerlambat,

                ];
                $ModelPeminjaman->EditTerlambat($id_pinjam, $data);
        
                // Hitung durasi keterlambatan (tgl_kembali - tgl_terlambat) dalam hari
                $tglKembali = new \DateTime($peminjaman['tgl_kembali']);
                $tglTerlambatObj = new \DateTime($tglTerlambat);
                $durasi = $tglKembali->diff($tglTerlambatObj)->days;
        
              
                $data = [
                    'keterlambatan' => $durasi,
                ];
                $ModelPeminjaman->EditTerlambat($id_pinjam, $data);
            } else {
                
                $data = [
                    'status' => 'Belum Kembali',
                ];
                $ModelPeminjaman->EditTerlambat($id_pinjam, $data);
            }
        }
        
        return redirect()->to(base_url('Admin/PengajuanDitolak'));
    }

    

    public function BukuDenda($id_pinjam)
    {
        $data = [
            'id' => $id_pinjam,
            'status'=> 'Dikembalikan',
        ];

        $this->ModelPeminjaman->SetNullDenda($id_pinjam);
        $this->ModelPeminjaman->EditData($data);
        session()->setFlashdata('pesan', 'Data Pengemablian Buku Berhasi Disimpan');
        return redirect()->to(base_url('Admin/History'));  
    }

    public function PengembalianOntime($id_pinjam)
    {
        $data = [
            'id' => $id_pinjam,
            'status' =>'Dikembalikan',
        ];

        $this->ModelPeminjaman->EditTerlambat($id_pinjam, $data);
        return redirect()->to(base_url('Admin/History'));
    }


}
