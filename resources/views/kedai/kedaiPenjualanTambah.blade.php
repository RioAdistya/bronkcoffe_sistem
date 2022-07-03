<div class="card mt-3">
    <div class="card-header text-start">
        <strong>Tambah Data</strong> 
    </div>
    <div class="card-body">
        <p>Masukkan data penjualan :</p>
        <div class="border p-3">
            <form class="row" method="post" action="/penjualan/store">
                {{ csrf_field() }}
                {{ method_field('PATCH') }}
                {{-- Nama Produk --}}
                <div class="mb-3 col-xl-6 col-md-12">
                    <label for="namaProduk" class="form-label">Nama Produk</label>
                    <select id="namaProduk" name="namaProduk" class="form-select" placeholder="Nama Produk" autocomplete="off" required oninvalid="this.setCustomValidity('Nama Produk tidak boleh Kosong')" oninput="this.setCustomValidity('')">
                        <option value="" hidden>Pilih produk</option>
                        @foreach ($nama_produk as $np)
                            <option>{{ $np->nama }}</option>
                        @endforeach
                    </select>
                    @if($errors->has('namaProduk'))
                    <div class="text-danger">
                        {{ $errors->first('namaProduk')}}
                    </div>
                    @endif
                </div>

                {{-- Kategori --}}
                <div class="mb-3 col-xl-6 col-md-12">
                    <label for="kategori" class="form-label">Kategori</label>
                    <select id="kategori" name="kategori" class="form-select" placeholder="Nama Produk" autocomplete="off" required oninvalid="this.setCustomValidity('Kategori tidak boleh Kosong')" oninput="this.setCustomValidity('')">
                        <option value="" hidden>Pilih Kategori</option>
                        @foreach ($nama_kategori as $nk)
                            <option>{{ $nk->kategori }}</option>
                        @endforeach
                    </select>
                    @if($errors->has('kategori'))
                    <div class="text-danger">
                        {{ $errors->first('kategori')}}
                    </div>
                    @endif
                </div>

                {{-- Kuantitas --}}
                <div class="mb-3 col-xl-6 col-md-12">
                    <label for="kuantitas" class="form-label">Kuantitas (gr)</label>
                    <input name="kuantitas" type="number" min="5" class="form-control" id="kuantitas" placeholder="Jumlah Kuantitas (gr)" required oninvalid="this.setCustomValidity('Kuantitas tidak boleh Kosong')" oninput="this.setCustomValidity('')"/>
                </div>

                {{-- Harga Total --}}
                <div class="mb-3 col-xl-6 col-md-12">
                    <label for="harga" class="form-label">Harga Total (Rp)</label>
                    <input name="harga" readonly type="number" class="form-control" id="harga" placeholder="Harga Total"/>
                </div>

                <div>
                    <button class="btn btn-success w-100">Tambah</button>
                </div>
            </form>
        </div>
    </div>
</div>