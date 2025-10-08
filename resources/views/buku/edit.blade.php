<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Buku</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1>Edit Buku: {{ $buku->judul }}</h1>
        <a href="{{ route('buku.index') }}" class="btn btn-secondary mb-3">Kembali</a>

        <form method="POST" action="{{ route('buku.update', $buku->id) }}">
            @csrf
            @method('PUT') 
            
            <div class="mb-3">
                <label for="judul" class="form-label">Judul</label>
                <input type="text" name="judul" id="judul" class="form-control" value="{{ $buku->judul }}">
            </div>

            <div class="mb-3">
                <label for="penulis" class="form-label">Penulis</label>
                <input type="text" name="penulis" id="penulis" class="form-control" value="{{ $buku->penulis }}">
            </div>
            
            <div class="mb-3">
                <label for="harga" class="form-label">Harga</label>
                <input type="number" name="harga" id="harga" class="form-control" value="{{ $buku->harga }}">
            </div>
            
            <div class="mb-3">
                <label for="tanggal_terbit" class="form-label">Tanggal Terbit</label>
                <input type="date" name="tanggal_terbit" id="tanggal_terbit" class="form-control" value="{{ $buku->tanggal_terbit }}">
            </div>

            <button type="submit" class="btn btn-success">Update Data</button>
        </form>
    </div>
</body>
</html>