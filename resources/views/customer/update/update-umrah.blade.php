@extends('admin.layouts.master')

@section('content')
    <div class="card card-warning">
        <div class="card-header bg-warning text-white">
            <h3 class="card-title">Silahkan Perbarui Informasi Produk di bawah ini :</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <form method="POST" action="{{ route('admin.umrah.update', $umrah->id) }}" enctype="multipart/form-data" id="umrahForm">
                @csrf

                <div class="row">
                    <div class="col-sm-6">
                        <!-- text input -->
                        <div class="form-group">
                            <label>Judul Produk</label>
                            <input type="text" name="judul_produk" class="form-control" value="{{ $umrah->judul_produk }}" placeholder="Enter ..." required>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-12">
                        <!-- textarea -->
                        <div class="form-group">
                            <label>Deskripsi Produk</label>
                            <textarea name="deskripsi_produk" class="form-control" rows="3" placeholder="Enter ..." required>{{ $umrah->deskripsi_produk }}</textarea>
                        </div>
                    </div>
                </div>

                <!-- input states -->
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="col-form-label">Harga</label>
                            <input type="text" name="harga" id="harga" class="form-control" value="{{ $umrah->harga }}" placeholder="Enter ..." required>
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
                                <input type="text" name="agen_travel" class="form-control" value="{{ $umrah->spesifikasi->agen_travel }}" placeholder="Enter ..." required>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <!-- text input -->
                            <div class="form-group">
                                <label>Nomor Telefon Agen</label>
                                <input type="text" name="nomor_telefon_agen" id="nomor_telefon_agen" class="form-control" value="{{ $umrah->spesifikasi->nomor_telefon_agen }}" placeholder="Enter ..." required>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-6">
                            <!-- textarea -->
                            <div class="form-group">
                                <label>Maskapai</label>
                                <input class="form-control" name="maskapai" value="{{ $umrah->spesifikasi->maskapai }}" placeholder="Enter ..." required>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <!-- textarea -->
                            <div class="form-group">
                                <label>Hotel</label>
                                <input class="form-control" name="hotel" value="{{ $umrah->spesifikasi->hotel }}" placeholder="Enter ..." required>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-6">
                            <!-- textarea -->
                            <div class="form-group">
                                <label>Tanggal Keberangkatan</label>
                                <input class="form-control" name="tanggal_keberangkatan" type="date" value="{{ $umrah->spesifikasi->tanggal_keberangkatan }}" required>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <!-- textarea -->
                            <div class="form-group">
                                <label>Durasi (Hari)</label>
                                <input class="form-control" name="durasi" id="durasi" type="text" value="{{ $umrah->spesifikasi->durasi }}" placeholder="Enter ..." required>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="card-header bg-primary text-white">
                    <h3 class="card-title">Foto Produk (Min. 1 & masing - masing maks. 5 MB)</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="row">
                        @foreach($umrah->fotos as $foto)
                        <div class="col-sm-2">
                            <!-- textarea -->
                            <div class="form-group">
                                <label>Foto {{ $loop->index + 1 }}</label>
                                <div class="custom-file">
                                  <input type="file" name="foto[]" class="custom-file-input" id="customFile{{ $loop->index + 1 }}" accept=".jpg,.jpeg,.png,.svg">
                                  <label class="custom-file-label" for="customFile{{ $loop->index + 1 }}">{{ basename($foto->path) }}</label>
                                </div>
                                <small class="form-text text-muted">Abaikan jika tidak ingin diganti.</small>
                            </div>
                        </div>
                        @endforeach
                        @for ($i = count($umrah->fotos); $i < 6; $i++)
                        <div class="col-sm-2">
                            <!-- textarea -->
                            <div class="form-group">
                                <label>Foto {{ $i + 1 }}</label>
                                <div class="custom-file">
                                  <input type="file" name="foto[]" class="custom-file-input" id="customFile{{ $i + 1 }}" accept=".jpg,.jpeg,.png,.svg">
                                  <label class="custom-file-label" for="customFile{{ $i + 1 }}">Choose file</label>
                                </div>
                            </div>
                        </div>
                        @endfor
                    </div>
                </div>

                <div class="card-footer">
                    <button type="submit" class="btn btn-success">Perbarui</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            function allowOnlyNumbers(event) {
                if ([46, 8, 9, 27, 13].indexOf(event.keyCode) !== -1 ||
                    (event.keyCode === 65 && (event.ctrlKey === true || event.metaKey === true)) ||
                    (event.keyCode >= 35 && event.keyCode <= 40)) {
                    return;
                }
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

            document.getElementById('harga').addEventListener('keydown', allowOnlyNumbers);
            document.getElementById('harga').addEventListener('keyup', function(e) {
                this.value = formatRupiah(this.value, 'Rp. ');
            });

            document.getElementById('nomor_telefon_agen').addEventListener('keydown', allowOnlyNumbers);
            document.getElementById('durasi').addEventListener('keydown', allowOnlyNumbers);

            document.getElementById('umrahForm').addEventListener('submit', function(e) {
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

                if (fotoCount < 1 && {{ count($umrah->fotos) }} == 0) {
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
        });
    </script>
@endsection
