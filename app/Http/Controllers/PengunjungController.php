<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class PengunjungController extends Controller
{
    public function index(?int $kategori = null)
    {
        $kategoriList = $this->kategoriList();
        $kategoriAktif = null;
        $artikelQuery = $this->artikelQuery();

        if ($kategori) {
            $kategoriAktif = DB::table('kategori_artikel')->where('id', $kategori)->first();
            $artikelQuery->where('a.id_kategori', $kategori);
        }

        $artikel = $artikelQuery->orderByDesc('a.id')->limit(5)->get();

        return view('pengunjung.beranda', compact('artikel', 'kategoriList', 'kategoriAktif'));
    }

    public function show(int $id)
    {
        $artikel = $this->artikelQuery()->where('a.id', $id)->first();

        abort_if(!$artikel, 404);

        $artikelTerkait = DB::table('artikel')
            ->select('id', 'judul', 'gambar', 'hari_tanggal')
            ->where('id_kategori', $artikel->id_kategori)
            ->where('id', '!=', $artikel->id)
            ->orderByDesc('id')
            ->limit(5)
            ->get();

        return view('pengunjung.detail', compact('artikel', 'artikelTerkait'));
    }

    private function artikelQuery()
    {
        return DB::table('artikel as a')
            ->join('penulis as p', 'a.id_penulis', '=', 'p.id')
            ->join('kategori_artikel as k', 'a.id_kategori', '=', 'k.id')
            ->select(
                'a.*',
                DB::raw("CONCAT(p.nama_depan, ' ', p.nama_belakang) AS nama_penulis"),
                'k.nama_kategori'
            );
    }

    private function kategoriList()
    {
        return DB::table('kategori_artikel as k')
            ->leftJoin('artikel as a', 'a.id_kategori', '=', 'k.id')
            ->select('k.id', 'k.nama_kategori', DB::raw('COUNT(a.id) AS jumlah_artikel'))
            ->groupBy('k.id', 'k.nama_kategori')
            ->orderBy('k.nama_kategori')
            ->get();
    }
}
