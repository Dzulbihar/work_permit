<!-- jQuery -->
<script src="{{ asset('adminlte/plugins/jquery/jquery.min.js') }}"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{ asset('adminlte/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="{{ asset('adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- ChartJS -->
<script src="{{ asset('adminlte/plugins/chart.js/Chart.min.js') }}"></script>
<!-- Sparkline -->
<script src="{{ asset('adminlte/plugins/sparklines/sparkline.js') }}"></script>
<!-- JQVMap -->
<script src="{{ asset('adminlte/plugins/jqvmap/jquery.vmap.min.js') }}"></script>
<script src="{{ asset('adminlte/plugins/jqvmap/maps/jquery.vmap.usa.js') }}"></script>
<!-- jQuery Knob Chart -->
<script src="{{ asset('adminlte/plugins/jquery-knob/jquery.knob.min.js') }}"></script>
<!-- daterangepicker -->
<script src="{{ asset('adminlte/plugins/moment/moment.min.js') }}"></script>
<script src="{{ asset('adminlte/plugins/daterangepicker/daterangepicker.js') }}"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="{{ asset('adminlte/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
<!-- Summernote -->
<script src="{{ asset('adminlte/plugins/summernote/summernote-bs4.min.js') }}"></script>
<!-- overlayScrollbars -->
<script src="{{ asset('adminlte/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('adminlte/dist/js/adminlte.js') }}"></script>
<!-- AdminLTE for demo purposes -->
<!-- <script src="{{ asset('adminlte/dist/js/demo.js') }}"></script> -->


<!-- ______________________________________________________________ -->
<!-- DataTables  & Plugins -->
<script src="{{ asset('adminlte/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('adminlte/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('adminlte/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('adminlte/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
<script src="{{ asset('adminlte/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('adminlte/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ asset('adminlte/plugins/jszip/jszip.min.js') }}"></script>
<script src="{{ asset('adminlte/plugins/pdfmake/pdfmake.min.js') }}"></script>
<script src="{{ asset('adminlte/plugins/pdfmake/vfs_fonts.js') }}"></script>
<script src="{{ asset('adminlte/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
<script src="{{ asset('adminlte/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
<script src="{{ asset('adminlte/plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>

<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": false,
      "autoWidth": false,
      "responsive": true,
    });
    $('#example3').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": false,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>
<!-- ______________________________________________________________ -->

<!-- ______________________________________________________________ -->
<!-- CDN sweet alert -->
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>    
  @if (Session::has('success'))
  swal("Berhasil!", "{{Session::get('success')}}", "success");
  @endif
</script>    
<script>    
  @if (Session::has('warning'))
  swal("Gagal!", "{{Session::get('warning')}}", "warning");
  @endif
</script>

<script>
  //job
  $('.delete_job').click( function(){
    var id = $(this).attr('data-id');
    var name = $(this).attr('data-name');
    swal({
      title: "Hapus?",
      text: "Apakah kamu yakin menghapus "+name+" ?",
      icon: "warning",
      buttons: true,
      dangerMode: true,
    })
    .then((willDelete) => {
      if (willDelete) {
        window.location = "{{url('job/delete')}}/"+id
        // swal("Data "+name+" successfully deleted!", {
        //   icon: "success",
        // });
      } else {
        swal("Data "+name+" tidak akan dihapus!", {
          icon: "error",
        });
      }
    });
  }); 
  
  //person
  $('.delete_person').click( function(){
    var id = $(this).attr('data-id');
    var job_id = $(this).attr('data-job_id');
    var name = $(this).attr('data-name');
    swal({
      title: "Hapus?",
      text: "Apakah kamu yakin menghapus "+name+" ?",
      icon: "warning",
      buttons: true,
      dangerMode: true,
    })
    .then((willDelete) => {
      if (willDelete) {
        window.location = "{{url('person/delete')}}/"+id+"/"+job_id
        // swal("Data "+name+" successfully deleted!", {
        //   icon: "success",
        // });
      } else {
        swal("Data "+name+" tidak akan dihapus!", {
          icon: "error",
        });
      }
    });
  }); 

  //tool
  $('.delete_tool').click( function(){
    var id = $(this).attr('data-id');
    var job_id = $(this).attr('data-job_id');
    var name = $(this).attr('data-name');
    swal({
      title: "Hapus?",
      text: "Apakah kamu yakin menghapus "+name+" ?",
      icon: "warning",
      buttons: true,
      dangerMode: true,
    })
    .then((willDelete) => {
      if (willDelete) {
        window.location = "{{url('tool/delete')}}/"+id+"/"+job_id
        // swal("Data "+name+" successfully deleted!", {
        //   icon: "success",
        // });
      } else {
        swal("Data "+name+" tidak akan dihapus!", {
          icon: "error",
        });
      }
    });
  }); 
</script>

<script>
  //status_job_approve_hsse
  $('.status_job_approve_hsse').click( function(){
    var id = $(this).attr('data-id');
    var name = $(this).attr('data-name');
    swal({
      title: "Setujui?",
      text: "Apakah Anda yakin ingin menyetujui pekerjaan "+name+" ?",
      icon: "warning",
      buttons: true,
      dangerMode: true,
    })
    .then((willDelete) => {
      if (willDelete) {
        window.location = "{{url('job_desc/status/approve_hsse')}}/"+id
        // swal("Data "+name+" successfully deleted!", {
        //   icon: "success",
        // });
      } else {
        swal("Pekerjaan "+name+" belum disetujui!", {
          icon: "error",
        });
      }
    });
  }); 
</script>

<script>
  //status_job_approve_fungsional
  $('.status_job_approve_fungsional').click( function(){
    var id = $(this).attr('data-id');
    var name = $(this).attr('data-name');
    swal({
      title: "Setujui?",
      text: "Apakah Anda yakin ingin menyetujui pekerjaan "+name+" ?",
      icon: "warning",
      buttons: true,
      dangerMode: true,
    })
    .then((willDelete) => {
      if (willDelete) {
        window.location = "{{url('job_desc/status/approve_fungsional')}}/"+id
        // swal("Data "+name+" successfully deleted!", {
        //   icon: "success",
        // });
      } else {
        swal("Pekerjaan "+name+" belum disetujui!", {
          icon: "error",
        });
      }
    });
  }); 
</script>

<script>
  //job_request_email_hsse
  $('.job_request_email_hsse').click( function(){
    var id = $(this).attr('data-id');
    var name = $(this).attr('data-name');
    swal({
      title: "Setujui?",
      text: "Apakah Anda yakin ingin meminta persetujuan pekerjaan "+name+" kepada HSSE ?",
      icon: "warning",
      buttons: true,
      dangerMode: true,
    })
    .then((willDelete) => {
      if (willDelete) {
        window.location = "{{url('job/request_email_hsse')}}/"+id
        // swal("Data "+name+" successfully deleted!", {
        //   icon: "success",
        // });
      } else {
        swal("Permintaan persetujuan pekerjaan "+name+" dibatalkan!", {
          icon: "error",
        });
      }
    });
  }); 
</script>
<script>
  //job_request_email_fungsional
  $('.job_request_email_fungsional').click( function(){
    var id = $(this).attr('data-id');
    var name = $(this).attr('data-name');
    swal({
      title: "Setujui?",
      text: "Apakah Anda yakin ingin meminta persetujuan pekerjaan "+name+" kepada Fungsional ?",
      icon: "warning",
      buttons: true,
      dangerMode: true,
    })
    .then((willDelete) => {
      if (willDelete) {
        window.location = "{{url('job/request_email_fungsional')}}/"+id
        // swal("Data "+name+" successfully deleted!", {
        //   icon: "success",
        // });
      } else {
        swal("Permintaan persetujuan pekerjaan "+name+" dibatalkan!", {
          icon: "error",
        });
      }
    });
  }); 
</script>
<!-- ______________________________________________________________ -->

