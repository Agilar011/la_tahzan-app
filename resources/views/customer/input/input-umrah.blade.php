@extends('admin.layouts.master')

@section('content')
    <div class="card card-warning">
        <div class="card-header bg-warning text-white">
            <h3 class="card-title">Silahkan Isi Informasi Produk dibawah ini :</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <form method="POST" action="{{ route('admin.umrah.store') }}" enctype="multipart/form-data" id="umrahForm">
                @csrf

                <div class="row">
                    <div class="col-sm-6">
                        <!-- text input -->
                        <div class="form-group">
                            <label>Judul Produk</label>
                            <input type="text" name="judul_produk" class="form-control" placeholder="Enter ..." required>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-12">
                        <!-- textarea -->
                        <div class="form-group">
                            <label>Deskripsi Produk</label>
                            <textarea name="deskripsi_produk" class="form-control" rows="3" placeholder="Enter ..." required></textarea>
                        </div>
                    </div>
                </div>

                <!-- input states -->
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="col-form-label">Harga</label>
                            <input type="text" name="harga" id="harga" class="form-control" placeholder="Enter ..." required>
                        </div>
                    </div>
                </div>

                <div class="card-header bg-primary text-white">
                    <h3 class="card-title">Spesifikasi</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">

                    <div class="row">
                        <div class="col-sm-6">
                            <!-- text input -->
                            <div class="form-group">
                                <label>Agen Travel</label>
                                <input type="text" name="agen_travel" class="form-control" placeholder="Enter ..." required>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <!-- text input -->
                            <div class="form-group">
                                <label>Nomor Telefon Agen</label>
                                <input type="text" name="nomor_telefon_agen" id="nomor_telefon_agen" class="form-control" placeholder="Enter ..." required>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-6">
                            <!-- textarea -->
                            <div class="form-group">
                                <label>Maskapai</label>
                                <input class="form-control" name="maskapai" placeholder="Enter ..." required>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <!-- textarea -->
                            <div class="form-group">
                                <label>Hotel</label>
                                <input class="form-control" name="hotel" placeholder="Enter ..." required>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-6">
                            <!-- textarea -->
                            <div class="form-group">
                                <label>Tanggal Keberangkatan</label>
                                <input class="form-control" name="tanggal_keberangkatan" type="date" required>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <!-- textarea -->
                            <div class="form-group">
                                <label>Durasi (Hari)</label>
                                <input class="form-control" name="durasi" id="durasi" type="text" placeholder="Enter ..." required>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="card-header bg-primary text-white">
                    <h3 class="card-title">Foto Produk (Min. 1, Max. 6)</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="row">
                        @for ($i = 1; $i <= 6; $i++)
                        <div class="col-sm-2">
                            <!-- textarea -->
                            <div class="form-group">
                                <label>Foto {{ $i }}</label>
                                <div class="custom-file">
                                  <input type="file" name="foto[]" class="custom-file-input" id="customFile{{ $i }}" accept=".jpg,.jpeg,.png,.svg" onchange="updateFileName(this)">
                                  <label class="custom-file-label" for="customFile{{ $i }}">Choose file</label>
                                </div>
                            </div>
                        </div>
                        @endfor
                    </div>
                </div>

                <div class="card-footer">
                    <button type="submit" class="btn btn-success">Simpan</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            function allowOnlyNumbers(event) {
                // Allow: backspace, delete, tab, escape, enter, and .
                if ([46, 8, 9, 27, 13].indexOf(event.keyCode) !== -1 ||
                     // Allow: Ctrl+A, Command+A
                    (event.keyCode === 65 && (event.ctrlKey === true || event.metaKey === true)) ||
                     // Allow: home, end, left, right, down, up
                    (event.keyCode >= 35 && event.keyCode <= 40)) {
                         // let it happen, don't do anything
                         return;
                }
                // Ensure that it is a number and stop the keypress
                if ((event.shiftKey || (event.keyCode < 48 || event.keyCode > 57)) && (event.keyCode < 96 || event.keyCode > 105)) {
                    event.preventDefault();
                }
            }

            function formatRupiah(angka, prefix) {
                var number_string = angka.replace(/[^,\d]/g, '').toString(),
                    split = number_string.split(','),
                    sisa = split[0].length % 3,
                    rupiah = split[0].substr(0, sisa),
                    ribuan = split[0].substr(sisa).match(/\d{3}/gi);

                if (ribuan) {
                    let separator = sisa ? '.' : '';
                    rupiah += separator + ribuan.join('.');
                }

                rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
                return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
            }

            function updateFileName(input) {
                var fileName = input.files[0].name;
                var label = input.nextElementSibling;
                label.innerText = fileName;
            }

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

            document.querySelectorAll('.custom-file-input').forEach(input => {
                input.addEventListener('change', function() {
                    if (validateFileSize(this)) {
                        updateFileName(this);
                    }
                });
            });

            document.getElementById('harga').addEventListener('keydown', allowOnlyNumbers);
            document.getElementById('harga').addEventListener('keyup', function(e) {
                this.value = formatRupiah(this.value, 'Rp. ');
            });

            document.getElementById('nomor_telefon_agen').addEventListener('keydown', allowOnlyNumbers);
            document.getElementById('durasi').addEventListener('keydown', allowOnlyNumbers);

            // Validasi jumlah foto sebelum form disubmit
            document.getElementById('umrahForm').addEventListener('submit', function(e) {
                var fotoInputs = document.querySelectorAll('input[name="foto[]"]');
                var fotoCount = 0;

                fotoInputs.forEach(function(input) {
                    if (input.files.length > 0) {
                        fotoCount++;
                    }
                });

                if (fotoCount < 1 || fotoCount > 6) {
                    e.preventDefault();
                    alert('Anda harus mengunggah minimal 1 dan maksimal 6 foto.');
                }

                // Strip currency formatting before form submission
                var hargaInput = document.getElementById('harga');
                hargaInput.value = hargaInput.value.replace(/[^,\d]/g, '');
            });
        });
    </script>
@endsection
