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
    public function create(){
        return view('buku.create');
    }
    public function store(){
        $buku = new Buku();
        $buku->judul = request('judul');
        $buku->penulis = request('penulis');
        $buku->harga = request('harga');
        $buku->tanggal_terbit = request('tanggal_terbit');
        $buku->save();
        return redirect('/buku');
    }
    public function destroy($id){
        $buku =Buku::find($id);
        $buku->delete();
        return redirect('/buku');
    }
    // app/Http/Controllers/PostController.php

    public function edit(Buku $buku)
    {
        // Mengembalikan view 'edit' dan mengirimkan data buku yang dipilih
        return view('buku.edit', compact('buku'));
    }
    public function update(Request $request, $id)
    {
        // 1. Validasi data
        $validatedData = $request->validate([
            'judul' => 'required|max:255',
            'penulis' => 'required',
            'harga' => 'required|numeric',
            'tanggal_terbit' => 'required|date',
        ]);
        
        // 2. Cari data buku berdasarkan ID
        $buku = \App\Models\Buku::findOrFail($id);
        
        // 3. Update data
        $buku->update($validatedData);

        // 4. Redirect kembali dengan pesan sukses
        return redirect()->route('buku.index')->with('success', 'Data buku berhasil diperbarui!');
    }
}