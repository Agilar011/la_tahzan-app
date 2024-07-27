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
            <h1 class="card-title">Otomotif</h1>
        </div>
        <div class="card-body">
            @php
                $user = auth()->user();
                $phoneFilled = !empty($user->phone);
                $addressFilled = !empty($user->address);
            @endphp

            @if (!$phoneFilled || !$addressFilled)
                <div class="alert alert-warning">
                    <strong>Peringatan!</strong> Kamu belum mengisi Nomor Telfon dan Alamat mu. Silahkan isi dulu untuk menambahkan produk. <a href="{{ route('profile.show') }}" class="btn btn-primary btn-sm">Go to Profile</a>
                </div>
            @endif

            <div class="d-flex justify-content-between mb-3">
                <a href="{{ route('admin.otomotif.create') }}" class="btn btn-success {{ !$phoneFilled || !$addressFilled ? 'disabled' : '' }}">+ Produk Otomotif</a>
            </div>

            @if (session('success'))
                <div class="alert alert-success" id="success-alert">
                    {{ session('success') }}
                </div>
            @endif
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Informasi Seller</th>
                        <th>Judul Produk</th>
                        <th>Spesifikasi Produk</th>
                        <th>Harga</th>
                        <th style="display: none">Tgl. Dibuat</th>
                        <th>Tgl. Diubah</th>
                        <th style="display: none">Payment</th>
                        <th style="display: none">Status</th>
                        <th>Countdown</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($otomotif as $item)
                        <tr id="otomotif-{{ $item->id }}">
                            <td data-label="Seller">
                                <ul>
                                    <li>ID : {{ $item->spesifikasi->user_id }}</li>
                                    <li>Nama: {{ $item->spesifikasi->seller }}</li>
                                    <li>Telfon: {{ $item->spesifikasi->phone }}</li>
                                    <li>Alamat: {{ $item->spesifikasi->address }}</li>
                                </ul>
                            </td>
                            <td data-label="Judul Produk">{{ $item->judul_produk }}</td>
                            <td data-label="Deskripsi Produk">
                                <ul>
                                    <li>Brand : <span style="color:rgb(2, 0, 128)">{{ $item->spesifikasi->brand }}</span></li>
                                    <li>Jenis Otomotif : <span style="color:rgb(2, 0, 128)">{{ $item->spesifikasi->type }}</span></li>
                                    <li>Tipe : <span style="color:rgb(2, 0, 128)">{{ $item->spesifikasi->subtype }}</span></li>
                                    <li>Kapasitas Mesin : <span style="color:rgb(2, 0, 128)">{{ $item->spesifikasi->kapasitas_mesin }}cc</span></li>
                                    <li>Transmisi : <span style="color:rgb(2, 0, 128)">{{ $item->spesifikasi->transmisi }}</span></li>
                                    <li>ODO Trip : <span style="color:rgb(2, 0, 128)">{{ $item->spesifikasi->kilometer }}km</span></li>
                                    <li>Tahun Pembuatan : <span style="color:rgb(2, 0, 128)">{{ $item->spesifikasi->tahun_pembuatan }}</span></li>
                                    <li>BPKB : <span style="color:rgb(2, 0, 128)">{{ $item->spesifikasi->bpkb }}</span></li>
                                    <li>STNK : <span style="color:rgb(2, 0, 128)">{{ $item->spesifikasi->stnk }}</span></li>
                                </ul>
                            </td>
                            <td data-label="Harga">Rp. {{ number_format($item->harga, 0, ',', '.') }},-</td>
                            <td data-label="Dibuat" style="display: none">{{ $item->created_at }}</td>
                            <td data-label="Diubah">{{ $item->updated_at }}</td>
                            <td data-label="Payment" style="display: none" id="payment-status-{{ $item->id }}">
                                {{ $item->status_payment }}</td>
                            <td data-label="Status" style="display: none" id="ads-status-{{ $item->id }}">
                                {{ $item->status_ads }}</td>
                            <td data-label="Countdown" id="countdown-{{ $item->id }}">Unavailable</td>
                            <td class="action-buttons">
                                <button type="button" class="btn btn-primary btn-xs"
                                    onclick="window.location.href='{{ route('admin.otomotif.edit', $item->id) }}'">Update</button>
                                <button type="button" class="btn btn-danger btn-xs"
                                    onclick="confirmDelete({{ $item->id }})">Hapus</button>
                                @if ($item->status_payment == 'unpaid' || $item->status_payment == 'expired')
                                    <button type="button" class="btn btn-success btn-xs"
                                        onclick="handleEtalaseClick({{ $item->id }})"
                                        id="action-button-{{ $item->id }}">+Etalase</button>
                                @elseif ($item->status_payment == 'paid' && $item->status_ads == 'show')
                                    <button type="button" class="btn btn-warning btn-xs"
                                        onclick="handleExpiredClick({{ $item->id }})"
                                        id="action-button-{{ $item->id }}">Expired?</button>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let successAlert = document.getElementById('success-alert');
            if (successAlert) {
                setTimeout(function() {
                    successAlert.style.display = 'none';
                }, 5000);
            }

            // Load countdown status from localStorage
            document.querySelectorAll('[id^="countdown-"]').forEach(element => {
                const id = element.id.replace('countdown-', '');
                const countdownEnd = localStorage.getItem(`countdown-${id}`);
                if (countdownEnd) {
                    const timeLeft = Math.floor((countdownEnd - new Date().getTime()) / 1000);
                    if (timeLeft > 0) {
                        startCountdown(id, timeLeft);
                    } else {
                        localStorage.removeItem(`countdown-${id}`);
                        updateStatus(id, 'expired', 'pending');
                    }
                } else {
                    element.textContent = 'Unavailable';
                }
            });
        });

        function confirmDelete(id) {
            if (confirm('Apakah Anda yakin ingin menghapus produk ini?')) {
                fetch(`/admin/otomotif/${id}`, {
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
                            document.querySelector(`#otomotif-${id}`).remove();
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

        function changeStatus(id, paymentStatus, adsStatus) {
            return fetch(`/admin/otomotif/${id}/change-status`, {
                    method: 'PUT',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        status_payment: paymentStatus,
                        status_ads: adsStatus
                    })
                })
                .then(response => {
                    if (response.ok) {
                        return response.json();
                    } else {
                        throw new Error('Network response was not ok');
                    }
                })
                .then(data => {
                    if (!data.success) {
                        alert('Terjadi kesalahan. Silakan coba lagi.');
                    }
                    return data.success;
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Terjadi kesalahan. Silakan coba lagi.');
                    return false;
                });
        }

        function startCountdown(id, initialTimeLeft = 15) { // 1 hour in seconds
            let countdownElement = document.getElementById(`countdown-${id}`);
            let timeLeft = initialTimeLeft;
            const countdownEnd = new Date().getTime() + timeLeft * 1000;
            localStorage.setItem(`countdown-${id}`, countdownEnd);

            function formatTime(seconds) {
                const hours = Math.floor(seconds / 3600);
                const minutes = Math.floor((seconds % 3600) / 60);
                const secs = seconds % 60;
                return `${hours.toString().padStart(2, '0')}:${minutes.toString().padStart(2, '0')}:${secs.toString().padStart(2, '0')}`;
            }

            countdownElement.textContent = formatTime(timeLeft);

            let countdownTimer = setInterval(() => {
                timeLeft--;
                countdownElement.textContent = formatTime(timeLeft);

                if (timeLeft <= 0) {
                    clearInterval(countdownTimer);
                    countdownElement.textContent = 'Unavailable';
                    localStorage.removeItem(`countdown-${id}`);
                    changeStatus(id, 'expired', 'pending').then(success => {
                        if (success) {
                            updateStatus(id, 'expired', 'pending');
                        }
                    });
                }
            }, 1000);

            countdownElement.dataset.timerId = countdownTimer;
        }

        function handleEtalaseClick(id) {
            changeStatus(id, 'paid', 'show').then(success => {
                if (success) {
                    updateStatus(id, 'paid', 'show');
                    startCountdown(id);
                }
            });
        }

        function handleExpiredClick(id) {
            const countdownElement = document.getElementById(`countdown-${id}`);
            const timerId = countdownElement.dataset.timerId;
            if (timerId) {
                clearInterval(timerId);
            }
            localStorage.removeItem(`countdown-${id}`);
            changeStatus(id, 'expired', 'pending').then(success => {
                if (success) {
                    updateStatus(id, 'expired', 'pending');
                    countdownElement.textContent = 'Unavailable';
                }
            });
        }

        function updateStatus(id, paymentStatus, adsStatus) {
            document.getElementById(`payment-status-${id}`).textContent = paymentStatus;
            document.getElementById(`ads-status-${id}`).textContent = adsStatus;
            const actionButton = document.getElementById(`action-button-${id}`);
            if (paymentStatus === 'paid' && adsStatus === 'show') {
                actionButton.textContent = 'Expired?';
                actionButton.className = 'btn btn-warning btn-xs';
                actionButton.onclick = function() {
                    handleExpiredClick(id);
                };
            } else if (paymentStatus === 'expired' || paymentStatus === 'unpaid') {
                actionButton.textContent = '+Etalase';
                actionButton.className = 'btn btn-success btn-xs';
                actionButton.onclick = function() {
                    handleEtalaseClick(id);
                };
            }
        }
    </script>
@endsection
