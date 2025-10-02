<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Buku;

class PostController extends Controller
{
    public function buku(Request $request)
    {
        $penulis = Buku::select('penulis')->distinct()->get();
        $query = Buku::query();
        $kata_kunci = '';

        // Filter berdasarkan penulis
        if ($request->filled('penulis') && $request->penulis != 'Semua Penulis') {
            $query->where('penulis', $request->penulis);
        }

        // Pencarian berdasarkan judul
        if ($request->filled('kata_kunci')) {
            $kata_kunci = $request->kata_kunci;
            $query->where('judul', 'LIKE', '%' . $kata_kunci . '%');
        }

        $data_buku = $query->get();

        // Menghitung statistik
        $stats = [
            'total_buku' => $data_buku->count(),
            'total_harga' => $data_buku->sum('harga'),
            'harga_tertinggi' => $data_buku->max('harga'),
            'harga_terendah' => $data_buku->min('harga'),
        ];

        return view('buku.index', compact('data_buku', 'penulis', 'kata_kunci', 'stats'));
    }

    public function limabuku()
    {
        $data_buku = Buku::latest('tanggal_terbit')->take(5)->get();
        return view('buku.index', compact('data_buku'));
    }

    public function index()
    {
        return view('halo');
    }
}