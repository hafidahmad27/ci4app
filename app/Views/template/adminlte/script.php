<!-- jQuery -->
<script src="<?= base_url(); ?>assets/AdminLTE-3.2.0/plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="<?= base_url(); ?>assets/AdminLTE-3.2.0/plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
    $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="<?= base_url(); ?>assets/AdminLTE-3.2.0/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- InputMask -->
<script src="<?= base_url(); ?>assets/AdminLTE-3.2.0/plugins/inputmask/jquery.inputmask.min.js"></script>
<!-- DataTables  & Plugins -->
<script src="<?= base_url(); ?>assets/AdminLTE-3.2.0/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url(); ?>assets/AdminLTE-3.2.0/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="<?= base_url(); ?>assets/AdminLTE-3.2.0/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?= base_url(); ?>assets/AdminLTE-3.2.0/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="<?= base_url(); ?>assets/AdminLTE-3.2.0/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="<?= base_url(); ?>assets/AdminLTE-3.2.0/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="<?= base_url(); ?>assets/AdminLTE-3.2.0/plugins/jszip/jszip.min.js"></script>
<script src="<?= base_url(); ?>assets/AdminLTE-3.2.0/plugins/pdfmake/pdfmake.min.js"></script>
<script src="<?= base_url(); ?>assets/AdminLTE-3.2.0/plugins/pdfmake/vfs_fonts.js"></script>
<script src="<?= base_url(); ?>assets/AdminLTE-3.2.0/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="<?= base_url(); ?>assets/AdminLTE-3.2.0/plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="<?= base_url(); ?>assets/AdminLTE-3.2.0/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<!-- ChartJS -->
<script src="<?= base_url(); ?>assets/AdminLTE-3.2.0/plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="<?= base_url(); ?>assets/AdminLTE-3.2.0/plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="<?= base_url(); ?>assets/AdminLTE-3.2.0/plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="<?= base_url(); ?>assets/AdminLTE-3.2.0/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<script src="<?= base_url(); ?>assets/AdminLTE-3.2.0/plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="<?= base_url(); ?>assets/AdminLTE-3.2.0/plugins/moment/moment.min.js"></script>
<script src="<?= base_url(); ?>assets/AdminLTE-3.2.0/plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="<?= base_url(); ?>assets/AdminLTE-3.2.0/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="<?= base_url(); ?>assets/AdminLTE-3.2.0/plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="<?= base_url(); ?>assets/AdminLTE-3.2.0/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="<?= base_url(); ?>assets/AdminLTE-3.2.0/dist/js/adminlte.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="<?= base_url(); ?>assets/AdminLTE-3.2.0/dist/js/pages/dashboard.js"></script>
<!-- Page specific script -->
<script>
    $(function() {
        $("#example1").DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false,
            // "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    });
</script>

<!-- External JavaScript Files Loader -->
<script src="<?= base_url(); ?>assets/external-files/js/formEditItem.js"></script>
<script src="<?= base_url(); ?>assets/external-files/js/formEditUser.js"></script>

<script>
    // current active menu after load
    $('ul.nav-sidebar a').filter(function() {
        return this.href == window.location;
    }).addClass('active');

    $('ul.nav-treeview a').filter(function() {
        return this.href == window.location;
    }).parentsUntil(".nav-sidebar > .nav-treeview").addClass('menu-open').prev('a').addClass('active');

    // the glimpse active menu effect while clicked
    // const navSidebar = document.querySelectorAll('ul.nav-sidebar a');
    // navSidebar.forEach((link) => {
    //     link.addEventListener('click', (e) => {
    //         navSidebar.forEach((link) => {
    //             link.classList.remove('active');
    //         });
    //         link.classList.add('active');
    //     });
    // });

    //Datemask
    $('[data-mask]').inputmask()

    // autofocus field login
    if ($('#username').val() != '') {
        $("#password").focus();
    } else {
        $("#username").focus();
    }

    // expired flashdata
    // setTimeout(() => {
    //     $(".alert-success").hide(2000),
    //         $(".alert-info2").hide(2000)
    // }, 3000);
</script>