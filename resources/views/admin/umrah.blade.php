@extends('admin.layouts.master')

@section('content')
    <style>
        .action-buttons {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .action-buttons button {
            margin-bottom: 5px;
            width: 100px;
            /* Set the width to a fixed value */
        }

        .action-buttons button:last-child {
            margin-bottom: 0;
            /* Hilangkan margin untuk tombol terakhir */
        }

        .loading-spinner {
            display: none;
            width: 16px;
            height: 16px;
            border: 2px solid #f3f3f3;
            border-top: 2px solid #3498db;
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        @media (max-width: 768px) {
            .action-buttons {
                flex-direction: row;
                flex-wrap: wrap;
                justify-content: center;
            }

            .action-buttons button {
                margin: 5px;
                width: auto;
            }

            table thead {
                display: none;
            }

            table tbody, table tr, table td {
                display: block;
                width: 100%;
            }

            table tr {
                margin-bottom: 15px;
            }

            table td {
                text-align: right;
                padding-left: 50%;
                position: relative;
            }

            table td::before {
                content: attr(data-label);
                position: absolute;
                left: 0;
                width: 50%;
                padding-left: 15px;
                font-weight: bold;
                text-align: left;
            }
        }
    </style>

    <div class="card">
        <div class="card-header">
            <h1 class="card-title">Etalase Umrah</h1>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <div class="d-flex justify-content-between mb-3">
                <button type="button" class="btn btn-success" onclick="redirectToInputUmrah()"> + Tambah Produk</button>
            </div>
            @if (session('success'))
                <div class="alert alert-success" id="success-alert">
                    {{ session('success') }}
                </div>
            @endif
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Judul Produk</th>
                        <th>Deskripsi Produk</th>
                        <th>Harga</th>
                        <th>Agen Travel</th>
                        <th>Nomor Telefon Agen</th>
                        <th>Maskapai</th>
                        <th>Hotel</th>
                        <th>Tanggal Keberangkatan</th>
                        <th>Durasi</th>
                        <th style="display: none">Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($umrahs as $umrah)
                        <tr id="umrah-{{ $umrah->id }}">
                            <td data-label="Judul Produk">{{ $umrah->judul_produk }}</td>
                            <td data-label="Deskripsi Produk">{{ $umrah->deskripsi_produk }}</td>
                            <td data-label="Harga">Rp.&nbsp;{{ $umrah->harga }}</td>
                            <td data-label="Agen Travel">{{ $umrah->spesifikasi->agen_travel }}</td>
                            <td data-label="Nomor Telefon Agen">{{ $umrah->spesifikasi->nomor_telefon_agen }}</td>
                            <td data-label="Maskapai">{{ $umrah->spesifikasi->maskapai }}</td>
                            <td data-label="Hotel">{{ $umrah->spesifikasi->hotel }}</td>
                            <td data-label="Tanggal Keberangkatan">{{ $umrah->spesifikasi->tanggal_keberangkatan }}</td>
                            <td data-label="Durasi">{{ $umrah->spesifikasi->durasi }} hari</td>
                            <td class="status" style="display:none;">{{ $umrah->status_ads }}</td>
                            <td class="action-buttons">
                                <button type="button" class="btn btn-{{ $umrah->status_ads === 'pending' ? 'success' : 'warning' }} btn-xs" id="status-button-{{ $umrah->id }}"
                                    onclick="toggleStatus({{ $umrah->id }}, '{{ $umrah->status_ads }}')">
                                    {{ $umrah->status_ads === 'pending' ? '+ Etalase' : 'Sembunyikan' }}
                                </button>
                                <div class="loading-spinner" id="loading-{{ $umrah->id }}"></div>
                                <button type="button" class="btn btn-primary btn-xs"
                                    onclick="window.location.href='{{ route('admin.umrah.edit', $umrah->id) }}'">Update</button>
                                <button type="button" class="btn btn-danger btn-xs"
                                    onclick="confirmDelete({{ $umrah->id }})">Hapus</button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <!-- /.card-body -->
    </div>

    <script>
        function redirectToInputUmrah() {
            window.location.href = "{{ route('admin.input.input-umrah') }}";
        }

        function toggleStatus(id, currentStatus) {
            let message = currentStatus === 'pending' ? 'Apakah anda akan memasukkan produk ini ke dalam etalase?' :
                'Apakah anda akan menyembunyikan produk ini dari etalase?';
            if (confirm(message)) {
                let newStatus = currentStatus === 'pending' ? 'show' : 'pending';
                let statusButton = document.getElementById(`status-button-${id}`);
                let loadingSpinner = document.getElementById(`loading-${id}`);

                // Tampilkan spinner loading
                loadingSpinner.style.display = 'inline-block';
                // Nonaktifkan tombol
                statusButton.disabled = true;

                // Lakukan AJAX request untuk memperbarui status
                fetch(`/admin/umrah/${id}/toggle-status`, {
                        method: 'PATCH',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({
                            status: newStatus
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            // Perbarui status dan tombol di halaman
                            let row = document.querySelector(`#umrah-${id}`);
                            row.querySelector('.status').textContent = newStatus;

                            statusButton.textContent = newStatus === 'show' ? 'Sembunyikan' : '+ Etalase';
                            statusButton.className = newStatus === 'show' ? 'btn btn-warning btn-xs' : 'btn btn-success btn-xs';
                            statusButton.setAttribute('onclick', `toggleStatus(${id}, '${newStatus}')`);
                        } else {
                            alert('Terjadi kesalahan. Silakan coba lagi.');
                        }
                    })
                    .catch(error => console.error('Error:', error))
                    .finally(() => {
                        // Sembunyikan spinner loading dan aktifkan tombol kembali
                        loadingSpinner.style.display = 'none';
                        statusButton.disabled = false;
                    });
            }
        }

        function confirmDelete(id) {
            if (confirm('Apakah Anda yakin ingin menghapus produk ini?')) {
                // Lakukan AJAX request untuk menghapus data
                fetch(`/admin/umrah/${id}`, {
                        method: 'DELETE',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            // Hapus baris dari tabel
                            document.querySelector(`#umrah-${id}`).remove();
                        } else {
                            alert('Terjadi kesalahan. Silakan coba lagi.');
                        }
                    })
                    .catch(error => console.error('Error:', error));
            }
        }

        document.addEventListener('DOMContentLoaded', function() {
            // Menghilangkan alert setelah 5 detik
            let successAlert = document.getElementById('success-alert');
            if (successAlert) {
                setTimeout(function() {
                    successAlert.style.display = 'none';
                }, 5000); // 5000 ms = 5 detik
            }
        });
    </script>
@endsection
