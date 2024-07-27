@extends('admin.layouts.master')

@section('content')
    <div class="card card-warning">
        <div class="card-header bg-warning text-white">
            <h3 class="card-title">Edit Properti</h3>
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route('admin.properti.update', $properti->id) }}" enctype="multipart/form-data"
                id="propertiForm">
                @csrf
                @method('PUT')
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
                                    <option value="Kota Blitar"
                                        {{ old('kota', $properti->spesifikasi->kota ?? '') == 'Kota Blitar' ? 'selected' : '' }}>
                                        Kota Blitar</option>
                                    <option value="Kabupaten Blitar"
                                        {{ old('kota', $properti->spesifikasi->kota ?? '') == 'Kabupaten Blitar' ? 'selected' : '' }}>
                                        Kabupaten Blitar</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Provinsi</label>
                                <input type="text" name="provinsi" id="provinsi" class="form-control"
                                    value="{{ old('provinsi', $properti->spesifikasi->provinsi ?? '') }}"
                                    placeholder="Enter ..." required readonly>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Alamat</label>
                                <input type="text" name="alamat" class="form-control"
                                    value="{{ old('alamat', $properti->spesifikasi->alamat ?? '') }}"
                                    placeholder="Enter ..." required>
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
                                    <option value="Rumah"
                                        {{ old('jenis_properti', $properti->spesifikasi->jenis_properti ?? '') == 'Rumah' ? 'selected' : '' }}>
                                        Rumah</option>
                                    <option value="Tanah"
                                        {{ old('jenis_properti', $properti->spesifikasi->jenis_properti ?? '') == 'Tanah' ? 'selected' : '' }}>
                                        Tanah</option>
                                    <option value="Apartemen"
                                        {{ old('jenis_properti', $properti->spesifikasi->jenis_properti ?? '') == 'Apartemen' ? 'selected' : '' }}>
                                        Apartemen</option>
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
                                <input type="number" name="jumlah_kamar_mandi" id="jumlah_kamar_mandi"
                                    class="form-control"
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
                    <h3 class="card-title">Foto Produk (Min. 1 & masing - masing maks. 5 MB)</h3>
                </div>
                <div class="card-body">
                    <div class="card-body">
                        <div class="row">
                            @foreach ($properti->fotos as $foto)
                                <div class="col-sm-2">
                                    <!-- textarea -->
                                    <div class="form-group">
                                        <label>Foto {{ $loop->index + 1 }}</label>
                                        <div class="custom-file">
                                            <input type="file" name="foto[]" class="custom-file-input"
                                                id="customFile{{ $loop->index + 1 }}" accept=".jpg,.jpeg,.png,.svg">
                                            <label class="custom-file-label"
                                                for="customFile{{ $loop->index + 1 }}">{{ basename($foto->path) }}</label>
                                        </div>
                                        <small class="form-text text-muted">Abaikan jika tidak ingin diganti.</small>
                                    </div>
                                </div>
                            @endforeach
                            @for ($i = count($properti->fotos); $i < 6; $i++)
                                <div class="col-sm-2">
                                    <!-- textarea -->
                                    <div class="form-group">
                                        <label>Foto {{ $i + 1 }}</label>
                                        <div class="custom-file">
                                            <input type="file" name="foto[]" class="custom-file-input"
                                                id="customFile{{ $i + 1 }}" accept=".jpg,.jpeg,.png,.svg">
                                            <label class="custom-file-label" for="customFile{{ $i + 1 }}">Choose
                                                file</label>
                                        </div>
                                    </div>
                                </div>
                            @endfor
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Submit</button>
                    <a href="{{ route('admin.properti.index') }}" class="btn btn-secondary">Back</a>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Function to update file name label
            function updateFileName(input) {
                var fileName = input.files[0].name;
                var label = input.nextElementSibling;
                label.innerText = fileName;
            }

            // Function to handle jenis properti change
            function handleJenisPropertiChange() {
                var jenisProperti = document.getElementById('jenis_properti').value;
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
            }

            // Event listener for kota change
            document.getElementById('kota').addEventListener('change', function() {
                var provinsiInput = document.getElementById('provinsi');
                provinsiInput.value = 'Jawa Timur';
            });

            // Event listener for jenis properti change
            document.getElementById('jenis_properti').addEventListener('change', handleJenisPropertiChange);

            // Initial check on page load
            handleJenisPropertiChange();

            // Function to allow only numbers for input
            function allowOnlyNumbers(event) {
                if ([46, 8, 9, 27, 13].indexOf(event.keyCode) !== -1 ||
                    (event.keyCode === 65 && (event.ctrlKey === true || event.metaKey === true)) ||
                    (event.keyCode >= 35 && event.keyCode <= 40)) {
                    return;
                }
                if ((event.shiftKey || (event.keyCode < 48 || event.keyCode > 57)) && (event.keyCode < 96 || event
                        .keyCode > 105)) {
                    event.preventDefault();
                }
            }

            // Function to format number to Rupiah currency
            function formatRupiah(angka, prefix) {
                var number_string = angka.replace(/[^,\d]/g, '').toString(),
                    split = number_string.split(','),
                    sisa = split[0].length % 3,
                    rupiah = split[0].substr(0, sisa),
                    ribuan = split[0].substr(sisa).match(/\d{3}/g);

                if (ribuan) {
                    let separator = sisa ? '.' : '';
                    rupiah += separator + ribuan.join('.');
                }

                rupiah = split[1] !== undefined ? rupiah + ',' + split[1] : rupiah;
                return prefix === undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
            }

            // Function to validate file size (max 5 MB)
            function validateFileSize(fileInput) {
                const maxSize = 5 * 1024 * 1024; // 5 MB
                const files = fileInput.files;

                for (let i = 0; i < files.length; i++) {
                    if (files[i].size > maxSize) {
                        alert('Ukuran file tidak boleh lebih dari 5 MB.');
                        fileInput.value = '';
                        return false;
                    }
                }
                return true;
            }

            // Event listener for file input changes
            // document.querySelectorAll('.custom-file-input').forEach(input => {
            //     input.addEventListener('change', function(e) {
            //         if (validateFileSize(e.target)) {
            //             const fileName = e.target.files[0].name;
            //             const label = e.target.nextElementSibling;
            //             label.textContent = fileName;
            //         }
            //     });
            // });

            // Event listener for form submission
            // const propertiForm = document.getElementById('propertiForm');
            // propertiForm.addEventListener('submit', function(e) {
            //     const fotoInputs = document.querySelectorAll('input[type="file"]');
            //     let fotoCount = 0;

            //     fotoInputs.forEach(function(input) {
            //         if (input.files.length > 0) {
            //             fotoCount++;
            //             if (!validateFileSize(input)) {
            //                 e.preventDefault();
            //             }
            //         }
            //     });

            //     if (fotoCount < 1 && {{ count($properti->fotos) }} == 0) {
            //         e.preventDefault();
            //         alert('Anda harus mengunggah minimal 1 foto.');
            //     }

            //     // Remove formatting before form submission
            //     const hargaInput = document.getElementById('harga');
            //     hargaInput.value = hargaInput.value.replace(/[^,\d]/g, '');
            // });

            document.getElementById('propertiForm').addEventListener('submit', function(e) {
                var fotoInputs = document.querySelectorAll('input[name="foto[]"]');
                var fotoCount = 0;

                fotoInputs.forEach(function(input) {
                    if (input.files.length > 0) {
                        fotoCount++;
                        if (!validateFileSize(input)) {
                            e.preventDefault();
                        }
                    }
                });

                if (fotoCount < 1 && {{ count($properti->fotos) }} == 0) {
                    e.preventDefault();
                    alert('Anda harus mengunggah minimal 1 foto.');
                }

                var hargaInput = document.getElementById('harga');
                hargaInput.value = hargaInput.value.replace(/[^,\d]/g, '');
            });

            document.querySelectorAll('.custom-file-input').forEach(input => {
                input.addEventListener('change', function(e) {
                    if (validateFileSize(e.target)) {
                        var fileName = e.target.files[0].name;
                        var label = e.target.nextElementSibling;
                        label.textContent = fileName;
                    }
                });
            });

            // Event listener for harga input field
            const hargaInput = document.getElementById('harga');
            hargaInput.addEventListener('keydown', allowOnlyNumbers);
            hargaInput.addEventListener('keyup', function(e) {
                this.value = formatRupiah(this.value, 'Rp. ');
            });
        });
    </script>
@endsection
