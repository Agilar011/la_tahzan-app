@extends('admin.layouts.master')

@section('content')
<div class="card">
    <div class="card-header">
        <h1 class="card-title">Data User</h1>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <table id="example1" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Alamat</th>
                    <th>Email</th>
                    <th>Nomor Telfon</th>
                    <th>Tanggal Lahir</th>
                    <th>Role</th>
                    <th>Status Seller</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                <tr id="user-{{ $user->id }}">
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->address }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->phone }}</td>
                    <td>{{ $user->birthdate }}</td>
                    <td class="user-role">{{ $user->role }}</td>
                    <td class="user-status-seller">{{ $user->status_seller }}</td>
                    <td>
                        <button type="button" class="btn btn-block btn-success btn-xs change-role" data-id="{{ $user->id }}">Ubah Role</button>
                        <button type="button" class="btn btn-block btn-info btn-xs change-seller-type" data-id="{{ $user->id }}">Ubah Tipe Seller</button>
                        <button type="button" class="btn btn-block btn-primary btn-xs">Update</button>
                        <button type="button" class="btn btn-block btn-danger btn-xs">Hapus</button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <!-- /.card-body -->
</div>
@endsection
