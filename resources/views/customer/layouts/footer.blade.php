<footer class="main-footer">
    <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
        <b>Version</b> 3.2.0
    </div>
</footer>

<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
</aside>
<!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="{{ asset('AdminLTE/plugins/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('AdminLTE/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
<script>
    $.widget.bridge('uibutton', $.ui.button);
</script>
<script src="{{ asset('AdminLTE/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('AdminLTE/plugins/chart.js/Chart.min.js') }}"></script>
<script src="{{ asset('AdminLTE/plugins/sparklines/sparkline.js') }}"></script>
<script src="{{ asset('AdminLTE/plugins/jqvmap/jquery.vmap.min.js') }}"></script>
<script src="{{ asset('AdminLTE/plugins/jqvmap/maps/jquery.vmap.usa.js') }}"></script>
<script src="{{ asset('AdminLTE/plugins/jquery-knob/jquery.knob.min.js') }}"></script>
<script src="{{ asset('AdminLTE/plugins/moment/moment.min.js') }}"></script>
<script src="{{ asset('AdminLTE/plugins/daterangepicker/daterangepicker.js') }}"></script>
<script src="{{ asset('AdminLTE/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
<script src="{{ asset('AdminLTE/plugins/summernote/summernote-bs4.min.js') }}"></script>
<script src="{{ asset('AdminLTE/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
<script src="{{ asset('AdminLTE/dist/js/adminlte.js') }}"></script>
<script src="{{ asset('AdminLTE/dist/js/demo.js') }}"></script>
<script src="{{ asset('AdminLTE/dist/js/pages/dashboard.js') }}"></script>

<!-- DataTables Scripts -->
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.print.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.colVis.min.js"></script>

<script>
    $(document).ready(function() {
        var table = $("#example1").DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false,
            "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        });

        table.buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');

        // AJAX untuk mengubah role pengguna
        $('.change-role').click(function() {
            var userId = $(this).data('id');
            var button = $(this);

            $.ajax({
                url: '{{ route('admin.user.changeRole', '') }}/' + userId,
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    if (response.status === 'success') {
                        var roleCell = $('#user-' + userId).find('.user-role');
                        roleCell.text(response.new_role);
                    }
                }
            });
        });
    });
</script>

</body>

</html>
