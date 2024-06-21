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
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Other browsers</td>
                    <td>All others</td>
                    <td>-</td>
                    <td>-</td>
                    <td>U</td>
                    <td></td>
                    <td>
                        <button type="button" class="btn btn-block btn-success btn-xs">Ubah Role</button>
                        <button type="button" class="btn btn-block btn-primary btn-xs">Update</button>
                        <button type="button" class="btn btn-block btn-danger btn-xs">Hapus</button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <!-- /.card-body -->
</div>

@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        var table = $("#example1").DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false,
            "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        });

        table.buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    });
</script>
@endsection
