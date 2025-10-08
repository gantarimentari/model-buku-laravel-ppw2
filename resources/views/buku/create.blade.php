
<div class="container">
    <h4>Tambah Buku</h1>
    <form action="{{ route('buku.store') }}" method="post">
        @csrf
        <div>Judul <input type ="text" name="judul"></div>
        <div>Penulis <input type ="text" name="penulis"></div>
        <div>Harga <input type ="number" name="harga"></div>
        <div>Tanggal Terbit <input type ="date" name="tanggal_terbit"></div>
        <button type="sumit">Simpan</button>
        <a href="{{'/buku'}}">Kembali</a>
    </form>
</div>
