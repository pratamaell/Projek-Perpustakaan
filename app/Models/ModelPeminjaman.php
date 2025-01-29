<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelPeminjaman extends Model
{
    protected $table = 'tb_peminjam'; 
    protected $primaryKey = 'id'; 
    protected $allowedFields = ['user_id', 'jumlah_buku','id_buku', 'tgl_pinjam','tgl_kembali', 'batas_waktu', 'status', 'denda','tgl_terlambat','keterlambatan'];

    public function AddPengajuan($data)
    {
        $this->insert($data);
    }
    
    

    public function PengajuanBuku($id_anggota)
    {
        return $this->db->table('tb_peminjam')
            ->join('tb_buku', 'tb_buku.id = tb_peminjam.id_buku', 'left')
            ->join('tb_penulis', 'tb_penulis.id = tb_buku.penulis_id', 'left')
            ->join('tb_penerbit', 'tb_penerbit.id = tb_buku.penerbit_id', 'left')
            ->join('tb_kategori', 'tb_kategori.id = tb_buku.kategori_id', 'left')
            ->where('tb_peminjam.id', $id_anggota)
            ->where('tb_peminjam.status', 'Diajukan')
            ->get()->getResultArray();
    }
    

    public function PengajuanMasuk()
{
    return $this->db->table('tb_peminjam')
        ->join('tb_buku', 'tb_buku.id = tb_peminjam.id_buku', 'left')
        ->join('tb_penulis', 'tb_penulis.id = tb_buku.penulis_id', 'left')
        ->join('tb_penerbit', 'tb_penerbit.id = tb_buku.penerbit_id', 'left')
        ->join('tb_kategori', 'tb_kategori.id = tb_buku.kategori_id', 'left')
        ->join('tb_user', 'tb_user.id = tb_peminjam.user_id', 'left')
        ->where('tb_peminjam.status', 'Diajukan')
        ->selectCount('tb_peminjam.user_id')
        ->select('tb_buku.id AS buku_id, tb_buku.judul, tb_user.id AS user_id, tb_user.nama AS user_nama, tb_user.foto, tb_peminjam.tgl_pinjam, tb_peminjam.tgl_kembali, tb_peminjam.batas_waktu, tb_peminjam.id AS peminjam_id, tb_kategori.nama AS kategori_nama, tb_penulis.nama AS penulis_nama, tb_penerbit.nama AS penerbit_nama, tb_buku.jumlah, tb_buku.lokasi')
        ->groupBy('tb_peminjam.user_id')
        ->get()
        ->getResultArray();
}


    public function Detail($id_pinjam)
    {
        
    }


    public function getDetailData($id_pinjam)
    {
        
        $buku = $this->db->table('tb_peminjam')
            ->join('tb_buku', 'tb_buku.id = tb_peminjam.id_buku', 'left')
            ->join('tb_user', 'tb_user.id = tb_peminjam.user_id', 'left')
            ->where('id', $id_pinjam)
            ->get()
            ->getResultArray();

      
        $kategori = $this->db->table('tb_buku')
            ->join('tb_kategori', 'tb_kategori.id = tb_buku.kategori_id', 'left')
            ->join('tb_penulis', 'tb_penulis.id = tb_buku.penulis_id', 'left')
            ->join('tb_penerbit', 'tb_penerbit.id = tb_buku.penerbit_id', 'left')
            ->where('id', $buku[0]['id']) 
            ->get()
            ->getRowArray();

        $result = [
            'buku' => $buku,
            'kategori' => $kategori,
        ];

        return $result;
    }

    public function EditData($data)
    {
        $this->db->table('tb_peminjam')->where('id', $data['id'])->update($data);
    } 


    public function SetNullDenda($id_pinjam)
    {
        $this->db->table('tb_peminjam')->where('id', $id_pinjam)->update();
    }


    public function Denda()
    {
        return $this->db->table('tb_peminjam')
            ->join('tb_buku', 'tb_buku.id = tb_peminjam.id_buku', 'left')
            ->join('tb_user', 'tb_user.id = tb_peminjam.user_id', 'left')
            ->join('tb_penulis', 'tb_penulis.id = tb_buku.penulis_id', 'left')
            ->join('tb_penerbit', 'tb_penerbit.id = tb_buku.penerbit_id', 'left')
            ->join('tb_kategori', 'tb_kategori.id = tb_buku.kategori_id', 'left')
            ->where('keterlambatan IS NOT NULL ')
            ->select('tb_buku.id,tb_buku.judul,tb_user.id,tb_user.nama,tb_user.foto,tb_peminjam.tgl_pinjam,tb_peminjam.tgl_kembali,tb_peminjam.batas_waktu,tb_peminjam.id,tb_kategori.nama,tb_penulis.nama,tb_penerbit.nama,tb_buku.jumlah,tb_buku.lokasi')
            ->get()
            ->getResultArray();
    }

    public function Terima()
    {
        return $this->db->table('tb_peminjam')
        ->join('tb_buku', 'tb_buku.id = tb_peminjam.id_buku', 'left')
        ->join('tb_user', 'tb_user.id = tb_peminjam.user_id', 'left')
        ->join('tb_penulis', 'tb_penulis.id = tb_buku.penulis_id', 'left')
        ->join('tb_penerbit', 'tb_penerbit.id = tb_buku.penerbit_id', 'left')
        ->join('tb_kategori', 'tb_kategori.id = tb_buku.kategori_id', 'left')
            ->where('status', 'Diterima')
            ->orWhere('status', 'Ditolak')
            ->select('tb_buku.id,tb_buku.judul,tb_user.id,tb_user.nama,tb_user.foto,tb_peminjam.tgl_pinjam,tb_peminjam.tgl_kembali,tb_peminjam.batas_waktu,tb_peminjam.id,tb_kategori.nama,tb_penulis.nama,tb_penerbit.nama,tb_buku.jumlah,tb_buku.lokasi')
            ->get()
            ->getResultArray();
    }

    public function BukuDiterima($id_anggota)
    {
        return $this->db->table('tb_peminjam')
        ->join('tb_buku', 'tb_buku.id = tb_peminjam.id_buku', 'left')
        ->join('tb_user', 'tb_user.id = tb_peminjam.user_id', 'left')
        ->join('tb_penulis', 'tb_penulis.id = tb_buku.penulis_id', 'left')
        ->join('tb_penerbit', 'tb_penerbit.id = tb_buku.penerbit_id', 'left')
        ->join('tb_kategori', 'tb_kategori.id = tb_buku.kategori_id', 'left')
            ->where('status', 'Diterima')
            ->where('tb_user.id', $id_anggota)
            ->select('tb_buku.id,tb_buku.judul,tb_user.id,tb_user.nama,tb_user.foto,tb_peminjam.tgl_pinjam,tb_peminjam.tgl_kembali,tb_peminjam.batas_waktu,tb_peminjam.id,tb_kategori.nama,tb_penulis.nama,tb_penerbit.nama,tb_buku.jumlah,tb_buku.lokasi')
            ->get()
            ->getResultArray();
    }






    public function InfoPinjam()
    {
        return $this->db->table('tb_peminjam')
        ->join('tb_buku', 'tb_buku.id = tb_peminjam.id_buku', 'left')
        ->join('tb_user', 'tb_user.id = tb_peminjam.user_id', 'left')
        ->join('tb_penulis', 'tb_penulis.id = tb_buku.penulis_id', 'left')
        ->join('tb_penerbit', 'tb_penerbit.id = tb_buku.penerbit_id', 'left')
        ->join('tb_kategori', 'tb_kategori.id = tb_buku.kategori_id', 'left')
            ->where('status', 'Dipinjam' )
            ->orWhere('status', 'Waiting' )
            ->select('tb_buku.id,tb_buku.judul,tb_user.id,tb_user.nama,tb_user.foto,tb_peminjam.tgl_pinjam,tb_peminjam.tgl_kembali,tb_peminjam.batas_waktu,tb_peminjam.id,tb_kategori.nama,tb_penulis.nama,tb_penerbit.nama,tb_buku.jumlah,tb_buku.lokasi,tb_buku.foto_buku,tb_peminjam.status')
            ->get()
            ->getResultArray();
    }

    public function HistoryBukuAgtPinjaman($id_anggota)
    {
        return $this->db->table('tb_peminjam')
        ->join('tb_buku', 'tb_buku.id = tb_peminjam.id_buku', 'left')
        ->join('tb_user', 'tb_user.id = tb_peminjam.user_id', 'left')
        ->join('tb_penulis', 'tb_penulis.id = tb_buku.penulis_id', 'left')
        ->join('tb_penerbit', 'tb_penerbit.id = tb_buku.penerbit_id', 'left')
        ->join('tb_kategori', 'tb_kategori.id = tb_buku.kategori_id', 'left')
            ->where('tb_peminjam.user_id', $id_anggota)
            ->where('status', 'Dipinjam' )
            ->select('tb_buku.id,tb_buku.judul,tb_user.id,tb_user.nama,tb_user.foto,tb_peminjam.tgl_pinjam,tb_peminjam.tgl_kembali,tb_peminjam.batas_waktu,tb_peminjam.id,tb_kategori.nama,tb_penulis.nama,tb_penerbit.nama,tb_buku.jumlah,tb_buku.lokasi')
            ->getResultArray();
    }


    public function HistoryBuku()
    {
        return $this->db->table('tb_peminjam')
        ->join('tb_buku', 'tb_buku.id = tb_peminjam.id_buku', 'left')
        ->join('tb_user', 'tb_user.id = tb_peminjam.user_id', 'left')
        ->join('tb_penulis', 'tb_penulis.id = tb_buku.penulis_id', 'left')
        ->join('tb_penerbit', 'tb_penerbit.id = tb_buku.penerbit_id', 'left')
        ->join('tb_kategori', 'tb_kategori.id = tb_buku.kategori_id', 'left')
            ->where('status', 'Dikembalikan' )
            ->orWhere('status', 'Belum Kembali' )
            ->select('tb_buku.id,tb_buku.judul,tb_user.id,tb_user.nama,tb_user.foto,tb_peminjam.tgl_pinjam,tb_peminjam.tgl_kembali,tb_peminjam.batas_waktu,tb_peminjam.id,tb_kategori.nama,tb_penulis.nama,tb_penerbit.nama,tb_buku.jumlah,tb_buku.lokasi')
            ->get()
            ->getResultArray();
    }

    
    public function kembaliTerlambat($id_pinjam, $data)
    {
        $this->db->table('tb_peminjam')->where('id', $id_pinjam)->update($data);
    }

    public function EditTerlambat($id_pinjam, $data)
    {
        $this->db->table('tb_peminjam')->where('id', $id_pinjam)->update($data);
    }




    public function TolakAgt($id_anggota)
    {
        return $this->db->table('tb_peminjam')
        ->join('tb_buku', 'tb_buku.id = tb_peminjam.id_buku', 'left')
        ->join('tb_penulis', 'tb_penulis.id = tb_buku.penulis_id', 'left')
        ->join('tb_penerbit', 'tb_penerbit.id = tb_buku.penerbit_id', 'left')
        ->join('tb_kategori', 'tb_kategori.id = tb_buku.kategori_id', 'left')
        ->where('id', $id_anggota)
        ->where('status', 'Ditolak')
        ->get()->getResultArray();
    }


    public function HistoryBukuAgt($id_anggota)
    {
        return $this->db->table('tb_peminjam')
        ->join('tb_buku', 'tb_buku.id = tb_peminjam.id_buku', 'left')
        ->join('tb_penulis', 'tb_penulis.id = tb_buku.penulis_id', 'left')
        ->join('tb_penerbit', 'tb_penerbit.id = tb_buku.penerbit_id', 'left')
        ->join('tb_kategori', 'tb_kategori.id = tb_buku.kategori_id', 'left')
            ->where('tb_peminjam.user_id', $id_anggota)
            ->groupStart()
                ->where('status', 'Dikembalikan')
                ->orWhere('status', 'Belum Kembali')
            ->groupEnd()
            ->get()
            ->getResultArray();
    }




  
    
    public function JumlahBukuPinjam()
    {
        $query = $this->db->table('tb_peminjam')->where('status', 'Dipinjam')->countAllResults();
        return $query;

    }


    public function JumlahBukuPinjamTerlambat()
    {
        $query = $this->db->table('tb_peminjam')->where('status', 'Belum Kembali')->countAllResults();
        return $query;

    }




}
