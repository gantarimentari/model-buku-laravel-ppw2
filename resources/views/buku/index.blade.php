<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Buku</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <h1>Daftar Buku</h1>
    <a href="{{ route('buku.create') }}" class="btn btn-primary float-end">Tambah Buku</a>
    <div style="display: flex; gap: 20px; align-items: center;">
        <form action="{{ route('buku.index') }}" method="GET">
            <input type="text" name="kata_kunci" placeholder="Cari judul buku..." value="{{ old('kata_kunci', $kata_kunci) }}">
            <button type="submit">Cari</button>
        </form>
        
        <form action="{{ route('buku.index') }}" method="GET">
            <label for="penulis">Filter Penulis:</label>
            <select name="penulis" id="penulis" onchange="this.form.submit()">
                <option value="Semua Penulis">Semua Penulis</option>
                @foreach($penulis as $p)
                    <option value="{{ $p->penulis }}" {{ request('penulis') == $p->penulis ? 'selected' : '' }}>
                        {{ $p->penulis }}
                    </option>
                @endforeach
            </select>
        </form>
    </div>
    
    <br>
    
    @if($data_buku->isEmpty())
        <p>Tidak ada buku yang ditemukan.</p>
    @else
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>id</th>
                    <th>Judul</th>
                    <th>Penulis</th>
                    <th>Harga</th>
                    <th>Tanggal Terbit</th>
                    <th>Pengaturan</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data_buku as $buku)
                <tr>
                    <td>{{ $buku->id }}</td>
                    <td>{{ $buku->judul }}</td>
                    <td>{{ $buku->penulis }}</td>
                    <td>{{ "Rp. " . number_format($buku->harga, 2, ',', '.') }}</td>
                    <td>{{ $buku->tanggal_terbit }}</td>
                    <td>
                        <form action="{{ route('buku.destroy', $buku->id) }}" method="POST" >
                            @csrf
                            @method('DELETE')
                            <button onclick="return confirm('yakin mau dihapus?')" type="submit" 
                            class="btn btn-danger ">Hapus</button>
                        </form>
                        <a href="{{ route('buku.edit', $buku->id) }}" class="btn btn-warning">Edit</a>
                        
                </tr>
                @endforeach
            </tbody>
        </table>
    @endif
    
    <hr>
    
    @if(!$data_buku->isEmpty())
    <div class="stats-box" style="border: 1px solid #ccc; padding: 15px; margin-top: 20px;">
        <h3>Statistik Buku</h3>
        <ul>
            <li>Total Buku: {{ $stats['total_buku'] }}</li>
            <li>Total Harga: Rp. {{ number_format($stats['total_harga'], 2, ',', '.') }}</li>
            <li>Harga Tertinggi: Rp. {{ number_format($stats['harga_tertinggi'], 2, ',', '.') }}</li>
            <li>Harga Terendah: Rp. {{ number_format($stats['harga_terendah'], 2, ',', '.') }}</li>
        </ul>
    </div>
    @endif
</body>
</html>