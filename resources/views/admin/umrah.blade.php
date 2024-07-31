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
        }

        .action-buttons button:last-child {
            margin-bottom: 0;
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
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
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

            table tbody,
            table tr,
            table td {
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
        <div class="card-body">
            <div class="d-flex justify-content-between mb-3">
                <button type="button" class="btn btn-success" onclick="redirectToInputUmrah()">+ Produk Umrah</button>
            </div>
            @if (session('success'))
                <div class="alert alert-success" id="success-alert">
                    {{ session('success') }}
                </div>
            @endif
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Informasi Agen</th>
                        <th>Judul Produk</th>
                        <th>Deskripsi Produk</th>
                        <th>Spesifikasi Produk</th>
                        <th>Harga</th>
                        <th style="display: none">Status</th>
                        <th>Tgl. Dibuat</th>
                        <th>Tgl. Diubah</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($umrah as $umrah)
                        <tr id="umrah-{{ $umrah->id }}">
                            <td>
                                <ul>
                                    <li data-label="Agen Travel">Nama Agen: <span
                                            style="color:rgb(2, 0, 128)">{{ $umrah->spesifikasi->agen_travel }}</span></li>
                                    <li data-label="Nomor Telefon Agen">Nomor Telfon: <span
                                            style="color:rgb(2, 0, 128)">{{ $umrah->spesifikasi->nomor_telefon_agen }}</span>
                                    </li>
                                </ul>
                            </td>
                            <td data-label="Judul Produk">{{ $umrah->judul_produk }}</td>
                            <td data-label="Deskripsi Produk" style="max-width: 200px;">{{ $umrah->deskripsi_produk }}</td>
                            <td>
                                <ul>
                                    <li data-label="Maskapai">Maskapai: <span
                                            style="color:rgb(2, 0, 128)">{{ $umrah->spesifikasi->maskapai }}</span></li>
                                    <li data-label="Hotel">Hotel: <span
                                            style="color:rgb(2, 0, 128)">{{ $umrah->spesifikasi->hotel }}</span></li>
                                    <li data-label="Tanggal Keberangkatan">Tanggal Keberangkatan: <span
                                            style="color:rgb(2, 0, 128)">{{ $umrah->spesifikasi->tanggal_keberangkatan }}</span>
                                    </li>
                                    <li data-label="Durasi">Durasi: <span
                                            style="color:rgb(2, 0, 128)">{{ $umrah->spesifikasi->durasi }} hari</span></li>
                                </ul>
                            </td>
                            <td data-label="Harga">Rp. {{ number_format($umrah->harga, 0, ',', '.') }}</td>
                            <td class="status" style="display:none;">{{ $umrah->status_ads }}</td>
                            <td>{{ $umrah->created_at }}</td>
                            <td>{{ $umrah->updated_at }}</td>
                            <td class="action-buttons">
                                <button type="button"
                                    class="btn btn-{{ $umrah->status_ads === 'pending' ? 'success' : 'warning' }} btn-xs"
                                    id="status-button-{{ $umrah->id }}"
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

                loadingSpinner.style.display = 'inline-block';
                statusButton.disabled = true;

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
                            let row = document.querySelector(`#umrah-${id}`);
                            row.querySelector('.status').textContent = newStatus;

                            statusButton.textContent = newStatus === 'show' ? 'Sembunyikan' : '+ Etalase';
                            statusButton.className = newStatus === 'show' ? 'btn btn-warning btn-xs' :
                                'btn btn-success btn-xs';
                            statusButton.setAttribute('onclick', `toggleStatus(${id}, '${newStatus}')`);
                        } else {
                            alert('Terjadi kesalahan. Silakan coba lagi.');
                        }
                    })
                    .catch(error => console.error('Error:', error))
                    .finally(() => {
                        loadingSpinner.style.display = 'none';
                        statusButton.disabled = false;
                    });
            }
        }

        function confirmDelete(id) {
            if (confirm('Apakah Anda yakin ingin menghapus produk ini?')) {
                fetch(`/admin/umrah/${id}`, {
                    method: 'DELETE',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                })
                .then(response => {
                    if (response.ok) {
                        return response.json();
                    } else {
                        throw new Error('Network response was not ok');
                    }
                })
                .then(data => {
                    if (data.success) {
                        document.querySelector(`#umrah-${id}`).remove();
                    } else {
                        alert('Terjadi kesalahan. Silakan coba lagi.');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Terjadi kesalahan. Silakan coba lagi.');
                });
            }
        }

        document.addEventListener('DOMContentLoaded', function() {
            let successAlert = document.getElementById('success-alert');
            if (successAlert) {
                setTimeout(function() {
                    successAlert.style.display = 'none';
                }, 5000);
            }
        });
    </script>
@endsection
