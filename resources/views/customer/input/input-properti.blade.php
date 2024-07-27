@extends('admin.layouts.master')

@section('content')
    <div class="card card-warning">
        <div class="card-header bg-warning text-white">
            <h3 class="card-title">Tambah Properti</h3>
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route('admin.properti.store') }}" enctype="multipart/form-data" id="propertiForm">
                @csrf
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Judul Produk</label>
                            <input type="text" name="judul_produk" class="form-control"
                                value="{{ old('judul_produk', $properti->judul_produk ?? '') }}" placeholder="Enter ..."
                                required>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Harga</label>
                            <input type="text" name="harga" id="harga" class="form-control"
                                value="{{ old('harga', $properti->harga ?? '') }}" placeholder="Enter ..." required>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label>Deskripsi Produk</label>
                            <textarea name="deskripsi_produk" class="form-control" rows="3" placeholder="Enter ..." required>{{ old('deskripsi_produk', $properti->deskripsi_produk ?? '') }}</textarea>
                        </div>
                    </div>
                </div>

                <div class="card-header bg-primary text-white">
                    <h3 class="card-title">Alamat Properti</h3>
                </div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Kota</label>
                                <select name="kota" class="form-control" id="kota" required>
                                    <option value="Kota Blitar" {{ old('kota', $properti->spesifikasi->kota ?? '') == 'Kota Blitar' ? 'selected' : '' }}>Kota Blitar</option>
                                    <option value="Kabupaten Blitar" {{ old('kota', $properti->spesifikasi->kota ?? '') == 'Kabupaten Blitar' ? 'selected' : '' }}>Kabupaten Blitar</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Provinsi</label>
                                <input type="text" name="provinsi" id="provinsi" class="form-control"
                                    value="{{ old('provinsi', $properti->spesifikasi->provinsi ?? '') }}" placeholder="Enter ..."
                                    required readonly>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Alamat</label>
                                <input type="text" name="alamat" class="form-control"
                                    value="{{ old('alamat', $properti->spesifikasi->alamat ?? '') }}" placeholder="Enter ..."
                                    required>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-header bg-primary text-white">
                    <h3 class="card-title">Spesifikasi Properti</h3>
                </div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Jenis Properti</label>
                                <select name="jenis_properti" class="form-control" id="jenis_properti" required>
                                    <option value="Rumah" {{ old('jenis_properti', $properti->spesifikasi->jenis_properti ?? '') == 'Rumah' ? 'selected' : '' }}>Rumah</option>
                                    <option value="Tanah" {{ old('jenis_properti', $properti->spesifikasi->jenis_properti ?? '') == 'Tanah' ? 'selected' : '' }}>Tanah</option>
                                    <option value="Apartemen" {{ old('jenis_properti', $properti->spesifikasi->jenis_properti ?? '') == 'Apartemen' ? 'selected' : '' }}>Apartemen</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Luas Tanah</label>
                                <input type="text" name="luas_tanah" id="luas_tanah" class="form-control"
                                    value="{{ old('luas_tanah', $properti->spesifikasi->luas_tanah ?? '') }}"
                                    placeholder="Enter ..." required>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Luas Bangunan</label>
                                <input type="text" name="luas_bangunan" id="luas_bangunan" class="form-control"
                                    value="{{ old('luas_bangunan', $properti->spesifikasi->luas_bangunan ?? '') }}"
                                    placeholder="Enter ..." required>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Jumlah Kamar Tidur</label>
                                <input type="number" name="jumlah_kamar_tidur" id="jumlah_kamar_tidur" class="form-control"
                                    value="{{ old('jumlah_kamar_tidur', $properti->spesifikasi->jumlah_kamar_tidur ?? '') }}"
                                    placeholder="Enter ..." required>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Jumlah Kamar Mandi</label>
                                <input type="number" name="jumlah_kamar_mandi" id="jumlah_kamar_mandi" class="form-control"
                                    value="{{ old('jumlah_kamar_mandi', $properti->spesifikasi->jumlah_kamar_mandi ?? '') }}"
                                    placeholder="Enter ..." required>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label>Fasilitas</label>
                                <textarea name="fasilitas" class="form-control" rows="3" placeholder="Enter ..." required>{{ old('fasilitas', $properti->spesifikasi->fasilitas ?? '') }}</textarea>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Sertifikat</label>
                                <select name="sertifikat" class="form-control" required>
                                    <option value="ya"
                                        {{ old('sertifikat', $properti->spesifikasi->sertifikat ?? '') == 'ya' ? 'selected' : '' }}>
                                        Ya</option>
                                    <option value="tidak"
                                        {{ old('sertifikat', $properti->spesifikasi->sertifikat ?? '') == 'tidak' ? 'selected' : '' }}>
                                        Tidak</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-header bg-primary text-white">
                    <h3 class="card-title">Foto Properti (Min. 1, Maks. 6)</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        @isset($properti)
                            @foreach ($properti->fotos as $foto)
                                <div class="col-sm-2">
                                    <div class="form-group">
                                        <label>Foto {{ $loop->index + 1 }}</label>
                                        <div class="custom-file">
                                            <input type="file" name="foto[]" class="custom-file-input"
                                                id="customFile{{ $loop->index + 1 }}" accept=".jpg,.jpeg,.png,.svg"
                                                onchange="updateFileName(this)">
                                            <label class="custom-file-label"
                                                for="customFile{{ $loop->index + 1 }}">{{ basename($foto->path) }}</label>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            @for ($i = count($properti->fotos); $i < 6; $i++)
                                <div class="col-sm-2">
                                    <div class="form-group">
                                        <label>Foto {{ $i + 1 }}</label>
                                        <div class="custom-file">
                                            <input type="file" name="foto[]" class="custom-file-input"
                                                id="customFile{{ $i + 1 }}" accept
                                                .jpg,.jpeg,.png,.svg"
                                                onchange="updateFileName(this)">
                                            <label class="custom-file-label" for="customFile{{ $i + 1 }}">Choose
                                                file</label>
                                        </div>
                                    </div>
                                </div>
                            @endfor
                        @else
                            @for ($i = 0; $i < 6; $i++)
                                <div class="col-sm-2">
                                    <div class="form-group">
                                        <label>Foto {{ $i + 1 }}</label>
                                        <div class="custom-file">
                                            <input type="file" name="foto[]" class="custom-file-input"
                                                id="customFile{{ $i + 1 }}" accept=".jpg,.jpeg,.png,.svg"
                                                onchange="updateFileName(this)">
                                            <label class="custom-file-label" for="customFile{{ $i + 1 }}">Choose
                                                file</label>
                                        </div>
                                    </div>
                                </div>
                            @endfor
                        @endisset
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-success">Simpan</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function updateFileName(input) {
            var fileName = input.files[0].name;
            var label = input.nextElementSibling;
            label.innerText = fileName;
        }

        document.getElementById('kota').addEventListener('change', function() {
            var provinsiInput = document.getElementById('provinsi');
            provinsiInput.value = 'Jawa Timur';
        });

        document.getElementById('jenis_properti').addEventListener('change', function() {
            var jenisProperti = this.value;
            var luasBangunan = document.getElementById('luas_bangunan');
            var jumlahKamarTidur = document.getElementById('jumlah_kamar_tidur');
            var jumlahKamarMandi = document.getElementById('jumlah_kamar_mandi');

            if (jenisProperti === 'Tanah') {
                luasBangunan.disabled = true;
                jumlahKamarTidur.disabled = true;
                jumlahKamarMandi.disabled = true;
                luasBangunan.value = '';
                jumlahKamarTidur.value = '';
                jumlahKamarMandi.value = '';
            } else {
                luasBangunan.disabled = false;
                jumlahKamarTidur.disabled = false;
                jumlahKamarMandi.disabled = false;
            }
        });
    </script>
@endsection
