<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ModelAnggota;
use App\Models\ModelBuku;
use App\Models\ModelPeminjaman;
use CodeIgniter\I18n\Time;

class Peminjaman extends BaseController
{
    public function __construct()
    {
        helper('form');
        $this->ModelAnggota = new ModelAnggota();
        $this->ModelBuku = new ModelBuku();
        $this->ModelPeminjaman = new ModelPeminjaman();
    }

    public function Pengajuan()
    {
        $id_anggota = session()->get('id');
        $data = [
            'menu' => 'peminjaman',
            'submenu' => 'pengajuan',
            'judul' => 'Peminjaman Buku',
            'page' => 'v_peminjaman/v_pengajuan',
            'anggota' => $this->ModelAnggota->ProfileAnggota($id_anggota),
            'pengajuanbuku' => $this->ModelPeminjaman->PengajuanBuku($id_anggota),
            'buku' => $this->ModelBuku->AllData(),  // Fetching all books
        ];
        return view('v_template_anggota', $data);
    }

    public function AddPengajuan()
    {
        if ($this->validate([
            'tgl_pinjam' => [
                'label' => 'Tanggal Pinjam',
                'rules' => 'required',
                'errors' => [
                    'required' => 'Tanggal Pinjam Masih Kosong!',
                ]
            ],
            'durasi' => [
                'label' => 'Durasi Pinjam',
                'rules' => 'required|numeric|min_length[1]|max_length[7]',
                'errors' => [
                    'required' => 'Durasi Pinjam Wajib diisi!',
                    'numeric' => 'Durasi Pinjam harus berupa angka!',
                    'min_length' => 'Durasi Pinjam minimal 1 hari!',
                    'max_length' => 'Durasi Pinjam maksimal 7 hari!',
                ]
            ]
        ])) {
            $hari_pinjam = Time::parse($this->request->getPost('tgl_pinjam'));
            $thn_pinjam = $hari_pinjam->getYear();
            $bln_pinjam = $hari_pinjam->getMonth();
            $tgl_pinjam = $hari_pinjam->getDay();

            $lama_pinjam = $this->request->getPost('durasi');

            $tgl_harus_kembali = date("Y-m-d", mktime(0, 0, 0, $bln_pinjam, $tgl_pinjam + $lama_pinjam, $thn_pinjam));

            $data = [
                'id' => session()->get('id'),
                'id_buku' => $this->request->getPost('judul'),
                'tgl_pinjam' => $this->request->getPost('tgl_pinjam'),
                'batas_waktu' => $this->request->getPost('durasi'),
                'tgl_kembali' => $tgl_harus_kembali,
                'status' => 'Diajukan',
            ];

            $this->ModelPeminjaman->AddPengajuan($data);

            session()->setFlashdata('pesan', 'Peminjaman Buku Berhasil diajukan');
            return redirect()->to(base_url('Peminjaman/Pengajuan'));
        } else {
            session()->setFlashdata('errors', \Config\Services::validation()->getErrors());
            return redirect()->to(base_url('Peminjaman/Pengajuan'));
        }
    }

    public function HistoryAgt($id_anggota)
    {
        $id_anggota = session()->get('id');
        $data = [
            'menu' => 'peminjaman',
            'submenu' => 'history',
            'judul' => 'History Peminjaman Buku',
            'page' => 'v_peminjaman/v_history_agt',
            'hstagt' => $this->ModelPeminjaman->HistoryBukuAgt($id_anggota),
            'anggota' => $this->ModelAnggota->ProfileAnggota($id_anggota),
        ];
        return view('v_template_anggota', $data);
    }

    public function TerimaAgt()
    {
        $id_anggota = session()->get('id');
        $data = [
            'menu' => 'peminjaman',
            'submenu' => 'diterima',
            'judul' => 'Validasi Peminjaman Buku',
            'page' => 'v_peminjaman/v_terima_agt',
            'peminjaman' => $this->ModelPeminjaman->BukuDiterima($id_anggota),
            'anggota' => $this->ModelAnggota->ProfileAnggota($id_anggota),
        ];
        return view('v_template_anggota', $data);
    }

    public function detailPeminjaman($id_anggota)
    {
        $data = [
            'page' => 'v_peminjaman/v_terima_agt',
            'peminjaman' => $this->ModelPeminjaman->BukuDiterima($id_anggota)
        ];
        if (!$data['peminjaman']) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
        return view('v_template_anggota', $data);
    }

    public function ShowBuku()
    {
        $id_anggota = session()->get('id');
        $data = [
            'menu' => 'peminjaman',
            'submenu' => 'pengajuan',
            'judul' => 'Peminjaman Buku',
            'page' => 'v_peminjaman/v_show_buku',
            'anggota' => $this->ModelAnggota->ProfileAnggota($id_anggota),
            'buku' => $this->ModelBuku->AllData()
        ];
        return view('v_template_anggota', $data);
    }

    public function ShowBukuAll()
    {
        $id_anggota = session()->get('id');
        $data = [
            'menu' => 'showbuku',
            'submenu' => 'showbuku',
            'judul' => 'Peminjaman Buku',
            'page' => 'v_peminjaman/v_show_buku',
            'anggota' => $this->ModelAnggota->ProfileAnggota($id_anggota),
            'buku' => $this->ModelBuku->AllData()
        ];
        return view('v_template_anggota', $data);
    }

    public function DetailBuku($id_buku)
    {
        $id_anggota = session()->get('id');
        $data = [
            'id_buku' => $id_buku,
            'menu' => 'showbuku',
            'submenu' => 'showbuku',
            'judul' => 'Detail Buku',
            'page' => 'buku/v_detail_buku',
            'anggota' => $this->ModelAnggota->ProfileAnggota($id_anggota),
            'buku' => $this->ModelBuku->AmbilDetail($id_buku),
        ];
        return view('v_template_anggota', $data);
    }
}
