@extends('admin.layouts.master')

@section('content')
    <div class="card card-warning">
        <div class="card-header bg-warning text-white">
            <h3 class="card-title">Silahkan Perbarui Informasi Produk di bawah ini :</h3>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('admin.otomotif.update', $otomotif->id) }}" enctype="multipart/form-data" id="otomotifForm">
                @csrf
                @method('PUT')

                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Judul Produk</label>
                            <input type="text" name="judul_produk" class="form-control" value="{{ $otomotif->judul_produk }}" placeholder="Enter ..." required>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label>Deskripsi Produk</label>
                            <textarea name="deskripsi_produk" class="form-control" rows="3" placeholder="Enter ..." required>{{ $otomotif->deskripsi_produk }}</textarea>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Harga</label>
                            <input type="text" name="harga" id="harga" class="form-control" value="{{ $otomotif->harga }}" placeholder="Enter ..." required>
                        </div>
                    </div>
                </div>

                <div class="card-header bg-primary text-white">
                    <h3 class="card-title">Spesifikasi</h3>
                </div>
                <div class="card-body">

                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Tipe</label>
                                <select class="form-control" id="type" name="type" required>
                                    <option value="mobil" {{ $otomotif->spesifikasi->type == 'mobil' ? 'selected' : '' }}>Mobil</option>
                                    <option value="motor" {{ $otomotif->spesifikasi->type == 'motor' ? 'selected' : '' }}>Motor</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Subtype</label>
                                <select class="form-control" id="subtype" name="subtype" required>
                                    <!-- Opsi akan diisi oleh JavaScript -->
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Transmisi</label>
                                <select class="form-control" id="transmisi" name="transmisi" required>
                                    <option value="manual" {{ $otomotif->spesifikasi->transmisi == 'manual' ? 'selected' : '' }}>Manual</option>
                                    <option value="matic" {{ $otomotif->spesifikasi->transmisi == 'matic' ? 'selected' : '' }}>Matic</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Kilometer</label>
                                <input type="text" class="form-control" name="kilometer" value="{{ $otomotif->spesifikasi->kilometer }}" placeholder="Enter ..." required>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Kapasitas Mesin</label>
                                <input type="text" class="form-control" name="kapasitas_mesin" value="{{ $otomotif->spesifikasi->kapasitas_mesin }}" placeholder="Enter ..." required>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Tahun Pembuatan</label>
                                <input type="date" class="form-control" name="tahun_pembuatan" value="{{ $otomotif->spesifikasi->tahun_pembuatan }}" placeholder="Enter ..." required>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Brand</label>
                                <select class="form-control" id="brand" name="brand" required>
                                    <!-- Opsi akan diisi oleh JavaScript -->
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>STNK</label><br>
                                <input type="radio" id="stnk_ya" name="stnk" value="ya" {{ $otomotif->spesifikasi->stnk == 'ya' ? 'checked' : '' }}>
                                <label for="stnk_ya">Ada</label><br>
                                <input type="radio" id="stnk_tidak" name="stnk" value="tidak" {{ $otomotif->spesifikasi->stnk == 'tidak' ? 'checked' : '' }}>
                                <label for="stnk_tidak">Tidak</label>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>BPKB</label><br>
                                <input type="radio" id="bpkb_ya" name="bpkb" value="ya" {{ $otomotif->spesifikasi->bpkb == 'ya' ? 'checked' : '' }}>
                                <label for="bpkb_ya">Ada</label><br>
                                <input type="radio" id="bpkb_tidak" name="bpkb" value="tidak" {{ $otomotif->spesifikasi->bpkb == 'tidak' ? 'checked' : '' }}>
                                <label for="bpkb_tidak">Tidak</label>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="card-header bg-primary text-white">
                    <h3 class="card-title">Foto Produk (Min. 1 & masing - masing maks. 5 MB)</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        @foreach($otomotif->fotos as $foto)
                        <div class="col-sm-2">
                            <div class="form-group">
                                <label>Foto {{ $loop->index + 1 }}</label>
                                <div class="custom-file d-flex align-items-center">
                                  <img src="{{ Storage::url('foto_otomotif/' . $foto->path) }}" alt="Foto" class="img-thumbnail" style="width: 50px; height: 50px; object-fit: cover; margin-right: 10px;">
                                  <input type="file" name="foto[]" class="custom-file-input" id="customFile{{ $loop->index + 1 }}" accept=".jpg,.jpeg,.png,.svg">
                                  <label class="custom-file-label" for="customFile{{ $loop->index + 1 }}">{{ basename($foto->path) }}</label>
                                </div>
                                <small class="form-text text-muted">Abaikan jika tidak ingin diganti.</small>
                            </div>
                        </div>
                        @endforeach
                        @for ($i = count($otomotif->fotos); $i < 6; $i++)
                        <div class="col-sm-2">
                            <div class="form-group">
                                <label>Foto {{ $i + 1 }}</label>
                                <div class="custom-file d-flex align-items-center">
                                  <img src="{{ asset('path/to/default_image.png') }}" alt="Foto" class="img-thumbnail" style="width: 50px; height: 50px; object-fit: cover; margin-right: 10px;">
                                  <input type="file" name="foto[]" class="custom-file-input" id="customFile{{ $i + 1 }}" accept=".jpg,.jpeg,.png,.svg">
                                  <label class="custom-file-label" for="customFile{{ $i + 1 }}">Choose file</label>
                                </div>
                            </div>
                        </div>
                        @endfor
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-12">
                        <button type="submit" class="btn btn-success">Perbarui</button>
                        <a href="{{ route('admin.otomotif.index') }}" class="btn btn-warning">Kembali</a>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const types = {
                mobil: [{
                        value: 'Sedan',
                        text: 'Sedan'
                    },
                    {
                        value: 'SUV',
                        text: 'SUV (Sport Utility Vehicle)'
                    },
                    {
                        value: 'MPV',
                        text: 'MPV'
                    },
                    {
                        value: 'Sport',
                        text: 'Sport'
                    },
                    {
                        value: 'Convertible',
                        text: 'Convertible'
                    },
                    {
                        value: 'Station wagon',
                        text: 'Station Wagon'
                    },
                    {
                        value: 'Pick Up',
                        text: 'Pick Up'
                    },
                    {
                        value: 'Double Cabin',
                        text: 'Double Cabin'
                    },
                    {
                        value: 'Electric',
                        text: 'Electric'
                    },
                    {
                        value: 'Off Road',
                        text: 'Off Road'
                    },
                    {
                        value: 'Hybrid',
                        text: 'Hybrid'
                    },
                    {
                        value: 'LCGC',
                        text: 'LCGC'
                    },
                    {
                        value: 'Hatachback',
                        text: 'Hatchback'
                    },
                    {
                        value: 'Crossover',
                        text: 'Crossover'
                    },
                    {
                        value: 'Coupe',
                        text: 'Coupe'
                    },
                ],
                motor: [{
                        value: 'Skuter',
                        text: 'Skuter (Scooter)'
                    },
                    {
                        value: 'Sport Bike',
                        text: 'Sport Bike'
                    },
                    {
                        value: 'Naked Bike',
                        text: 'Naked Bike'
                    },
                    {
                        value: 'Sport Touring',
                        text: 'Sport Touring'
                    },
                    {
                        value: 'Dirt Bike',
                        text: 'Dirt Bike'
                    },
                    {
                        value: 'Dual Bike',
                        text: 'Dual Bike'
                    },
                    {
                        value: 'Cruiser',
                        text: 'Cruiser'
                    },
                    {
                        value: 'Motocross',
                        text: 'Motocross'
                    },
                    {
                        value: 'Scrambler',
                        text: 'Scrambler'
                    },
                    {
                        value: 'Atv',
                        text: 'ATV'
                    },
                    {
                        value: 'Motor Adventure',
                        text: 'Motor Adventure'
                    },
                ]
            };

            const brands = {
                mobil: [
                    'Hyundai', 'Toyota', 'Daihatsu', 'Honda', 'Mitsubishi', 'Suzuki', 'Wuling', 'Chery', 'Kia',
                    'Mazda', 'Subaru', 'Mercedes-Benz', 'Renault', 'Isuzu', 'Volvo', 'Lexus', 'Mini', 'BMW',
                    'Volkswagen', 'Jeep', 'Audi', 'Ford', 'Nissan'
                ],
                motor: [
                    'Honda', 'Yamaha', 'Kawasaki', 'Suzuki', 'Benelli', 'KTM', 'TVS', 'BMW'
                ]
            };

            const typeSelect = document.getElementById('type');
            const subtypeSelect = document.getElementById('subtype');
            const brandSelect = document.getElementById('brand');
            const selectedSubtype = "{{ old('subtype', $otomotif->spesifikasi->subtype ?? '') }}";
            const selectedBrand = "{{ old('brand', $otomotif->spesifikasi->brand ?? '') }}";

            function populateSubtypes() {
                const type = typeSelect.value;
                let subtypes = types[type];

                subtypeSelect.innerHTML = '';
                subtypes.forEach(subtype => {
                    const option = document.createElement('option');
                    option.value = subtype.value;
                    option.textContent = subtype.text;
                    if (subtype.value === selectedSubtype) {
                        option.selected = true;
                    }
                    subtypeSelect.appendChild(option);
                });
            }

            function populateBrands() {
                const type = typeSelect.value;
                let brandsArray = brands[type];

                brandSelect.innerHTML = '';
                brandsArray.forEach(brand => {
                    const option = document.createElement('option');
                    option.value = brand;
                    option.textContent = brand;
                    if (brand === selectedBrand) {
                        option.selected = true;
                    }
                    brandSelect.appendChild(option);
                });
            }

            typeSelect.addEventListener('change', function () {
                populateSubtypes();
                populateBrands();
            });

            populateSubtypes();
            populateBrands();
        });

        function updateFileName(input) {
            const fileName = input.files[0].name;
            input.nextElementSibling.textContent = fileName;
        }
    </script>

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

            document.getElementById('otomotifForm').addEventListener('submit', function(e) {
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

                if (fotoCount < 1 && {{ count($otomotif->fotos) }} == 0) {
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
