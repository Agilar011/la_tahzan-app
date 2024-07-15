@extends('admin.layouts.master')

@section('content')
    <div class="card card-warning">
        <div class="card-header bg-warning text-white">
            <h3 class="card-title">Tambah Otomotif</h3>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('admin.otomotif.store') }}" enctype="multipart/form-data" id="otomotifForm">
                @csrf
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Judul Produk</label>
                            <input type="text" name="judul_produk" class="form-control"
                                value="{{ old('judul_produk', $otomotif->judul_produk ?? '') }}" placeholder="Enter ..."
                                required>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Harga</label>
                            <input type="text" name="harga" id="harga" class="form-control"
                                value="{{ old('harga', $otomotif->harga ?? '') }}" placeholder="Enter ..." required>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label>Deskripsi Produk</label>
                            <textarea name="deskripsi_produk" class="form-control" rows="3" placeholder="Enter ..." required>{{ old('deskripsi_produk', $otomotif->deskripsi_produk ?? '') }}</textarea>
                        </div>
                    </div>
                </div>

                <div class="card-header bg-primary text-white">
                    <h3 class="card-title">Spesifikasi</h3>
                </div>

                <div class="row">
                    <div class="col-sm-6">
                        <label>Jenis Otomotif</label>
                        <select name="type" id="type" class="form-control" required>
                            <option value="Mobil"
                                {{ old('type', $otomotif->spesifikasi->type ?? '') == 'Mobil' ? 'selected' : '' }}>Mobil
                            </option>
                            <option value="Motor"
                                {{ old('type', $otomotif->spesifikasi->type ?? '') == 'Motor' ? 'selected' : '' }}>Motor
                            </option>
                        </select>
                    </div>
                    <div class="col-sm-6">
                        <label>Tipe</label>
                        <select name="subtype" id="subtype" class="form-control" required>
                            <!-- Options will be populated by JavaScript based on the selected type -->
                        </select>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label>Transmisi</label>
                            <select name="transmisi" class="form-control" required>
                                <option value="manual"
                                    {{ old('transmisi', $otomotif->spesifikasi->transmisi ?? '') == 'Manual' ? 'selected' : '' }}>
                                    Manual</option>
                                <option value="matic"
                                    {{ old('transmisi', $otomotif->spesifikasi->transmisi ?? '') == 'Matic' ? 'selected' : '' }}>
                                    Matic</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Kilometer</label>
                            <input type="text" name="kilometer" id="kilometer" class="form-control"
                                value="{{ old('kilometer', $otomotif->spesifikasi->kilometer ?? '') }}"
                                placeholder="Enter ..." required>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Kapasitas Mesin</label>
                            <input type="text" name="kapasitas_mesin" id="kapasitas_mesin" class="form-control"
                                value="{{ old('kapasitas_mesin', $otomotif->spesifikasi->kapasitas_mesin ?? '') }}"
                                placeholder="Enter ..." required>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Tahun Pembuatan</label>
                            <input type="date" name="tahun_pembuatan" class="form-control"
                                value="{{ old('tahun_pembuatan', $otomotif->spesifikasi->tahun_pembuatan ?? '') }}"
                                placeholder="Enter ..." required>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Brand</label>
                            <select name="brand" id="brand" class="form-control" required>
                                <!-- Options will be populated by JavaScript based on the selected type -->
                            </select>
                        </div>
                    </div>
                </div>

                <!-- STNK -->
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>STNK</label><br>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="stnk" id="stnk_ya" value="ya"
                                    {{ old('stnk', $otomotif->spesifikasi->stnk ?? '') == 'ya' ? 'checked' : '' }}
                                    required>
                                <label class="form-check-label" for="stnk_ya">Ya</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="stnk" id="stnk_tidak" value="tidak"
                                    {{ old('stnk', $otomotif->spesifikasi->stnk ?? '') == 'tidak' ? 'checked' : '' }}
                                    required>
                                <label class="form-check-label" for="stnk_tidak">Tidak</label>
                            </div>
                        </div>
                    </div>

                    <!-- BPKB -->
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>BPKB</label><br>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="bpkb" id="bpkb_ya"
                                    value="ya"
                                    {{ old('bpkb', $otomotif->spesifikasi->bpkb ?? '') == 'ya' ? 'checked' : '' }}
                                    required>
                                <label class="form-check-label" for="bpkb_ya">Ya</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="bpkb" id="bpkb_tidak"
                                    value="tidak"
                                    {{ old('bpkb', $otomotif->spesifikasi->bpkb ?? '') == 'tidak' ? 'checked' : '' }}
                                    required>
                                <label class="form-check-label" for="bpkb_tidak">Tidak</label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-header bg-primary text-white">
                    <h3 class="card-title">Foto Produk (Min. 1, Maks. 6)</h3>
                </div>
                <div class="row">
                    @isset($otomotif)
                        @foreach ($otomotif->fotos as $foto)
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
                        @for ($i = count($otomotif->fotos); $i < 6; $i++)
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
                <div class="card-footer">
                    <button type="submit" class="btn btn-success">Simpan</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Data untuk dropdown tipe berdasarkan jenis otomotif
            const types = {
                Mobil: [{
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
                        value: 'Station Wagon',
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
                        value: 'Hatchback',
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
                Motor: [{
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
                        value: 'ATV',
                        text: 'ATV'
                    },
                    {
                        value: 'Motor Adventure',
                        text: 'Motor Adventure'
                    },
                ]
            };

            // Data untuk dropdown brand berdasarkan jenis otomotif
            const brands = {
                Mobil: [
                    'Hyundai', 'Toyota', 'Daihatsu', 'Honda', 'Mitsubishi', 'Suzuki', 'Wuling', 'Chery',
                    'Kia',
                    'Mazda', 'Subaru', 'Mercedes-Benz', 'Renault', 'Isuzu', 'Volvo', 'Lexus', 'Mini', 'BMW',
                    'Volkswagen', 'Jeep', 'Audi', 'Ford', 'Nissan'
                ],
                Motor: [
                    'Honda', 'Yamaha', 'Kawasaki', 'Suzuki', 'Benelli', 'KTM', 'TVS', 'BMW'
                ]
            };

            // Fungsi untuk mengisi dropdown tipe berdasarkan jenis otomotif yang dipilih
            function populateSubtypes() {
                const typeSelect = document.getElementById('type');
                const subtypeSelect = document.getElementById('subtype');
                const selectedType = typeSelect.value;

                // Kosongkan dropdown tipe terlebih dahulu
                subtypeSelect.innerHTML = '';

                // Buat opsi berdasarkan jenis otomotif yang dipilih
                types[selectedType].forEach(option => {
                    let optionElement = document.createElement('option');
                    optionElement.value = option.value;
                    optionElement.textContent = option.text;
                    subtypeSelect.appendChild(optionElement);
                });

                // Panggil fungsi untuk mengisi dropdown brand
                populateBrands();
            }

            // Fungsi untuk mengisi dropdown brand berdasarkan jenis otomotif yang dipilih
            function populateBrands() {
                const typeSelect = document.getElementById('type');
                const brandSelect = document.getElementById('brand');
                const selectedType = typeSelect.value;

                // Kosongkan dropdown brand terlebih dahulu
                brandSelect.innerHTML = '';

                // Buat opsi berdasarkan jenis otomotif yang dipilih
                brands[selectedType].forEach(brand => {
                    let brandElement = document.createElement('option');
                    brandElement.value = brand;
                    brandElement.textContent = brand;
                    brandSelect.appendChild(brandElement);
                });
            }

            // Panggil fungsi untuk mengisi dropdown tipe dan brand saat halaman dimuat
            populateSubtypes();

            // Tambahkan event listener untuk perubahan pada dropdown jenis otomotif
            document.getElementById('type').addEventListener('change', function() {
                populateSubtypes();
            });

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
                const maxSize = 5 * 1024 * 1024;
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

            document.getElementById('kilometer').addEventListener('keydown', allowOnlyNumbers);
            document.getElementById('kapasitas_mesin').addEventListener('keydown', allowOnlyNumbers);

            document.getElementById('otomotifForm').addEventListener('submit', function(e) {
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

                var hargaInput = document.getElementById('harga');
                hargaInput.value = hargaInput.value.replace(/[^,\d]/g, '');
            });
        });
    </script>
@endsection
