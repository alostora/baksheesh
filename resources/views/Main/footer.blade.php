</div>
<div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<!-- jQuery 3 -->
<script src="{{url('AdminDesign')}}/bower_components/jquery/dist/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{url('AdminDesign')}}/bower_components/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
    $.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Bootstrap 3.3.7 -->
<script src="{{url('AdminDesign')}}/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- Morris.js charts -->

<script src="{{url('AdminDesign')}}/bower_components/raphael/raphael.min.js"></script>
<script src="{{url('AdminDesign')}}/bower_components/morris.js/morris.min.js"></script>
<!-- Sparkline -->
<script src="{{url('AdminDesign')}}/bower_components/jquery-sparkline/dist/jquery.sparkline.min.js"></script>
<!-- jvectormap -->
<script src="{{url('AdminDesign')}}/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="{{url('AdminDesign')}}/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<!-- jQuery Knob Chart -->
<script src="{{url('AdminDesign')}}/bower_components/jquery-knob/dist/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="{{url('AdminDesign')}}/bower_components/moment/min/moment.min.js"></script>
<script src="{{url('AdminDesign')}}/bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
<!-- datepicker -->
<script src="{{url('AdminDesign')}}/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="{{url('AdminDesign')}}/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<!-- Slimscroll -->
<script src="{{url('AdminDesign')}}/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="{{url('AdminDesign')}}/bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="{{url('AdminDesign')}}/dist/js/adminlte.min.js"></script>
<script src="{{url('AdminDesign')}}/dist/js/demo.js"></script>

<!-- DataTables  & Plugins -->
<script src="{{url('AdminDesign')}}/lte3/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="{{url('AdminDesign')}}/lte3/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="{{url('AdminDesign')}}/lte3/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="{{url('AdminDesign')}}/lte3/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="{{url('AdminDesign')}}/lte3/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="{{url('AdminDesign')}}/lte3/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="{{url('AdminDesign')}}/lte3/plugins/jszip/jszip.min.js"></script>
<script src="{{url('AdminDesign')}}/lte3/plugins/pdfmake/pdfmake.min.js"></script>
<script src="{{url('AdminDesign')}}/lte3/plugins/pdfmake/vfs_fonts.js"></script>
<script src="{{url('AdminDesign')}}/lte3/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="{{url('AdminDesign')}}/lte3/plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="{{url('AdminDesign')}}/lte3/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>

<script src="https://kit.fontawesome.com/6f04acab37.js" crossorigin="anonymous"></script>

<script>
    $(function() {
        // $('#example1').DataTable()
        // $('#example1').DataTable({
        //   'paging'      : true,
        //   'lengthChange': true,
        //   'searching'   : true,
        //   'ordering'    : true,
        //   'info'        : true,
        //   'autoWidth'   : true,
        // })
    })

    $(function() {
        //Initialize Select2 Elements
        $('.select2').select2()
    })

    $(function() {
        $("#example1").DataTable({
            "responsive": true,
            "lengthChange": true,
            "autoWidth": false,
            "buttons": [ /* "copy" */ , /*  "csv", */ "excel", /*  "pdf", */ /* "print", */ /*  "colvis" */ ]
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');

        $("#example2").DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false,
            "searching": false,
            "bPaginate": false,
            "bSort": true,
            "buttons": [ /* "copy" */ , /*  "csv", */ "excel", /*  "pdf", */ /*  "print", */ /*  "colvis" */ ]
        }).buttons().container().appendTo('#example2_wrapper .col-md-6:eq(0)');
        // $('#example2').DataTable({
        //   "paging": true,
        //   "lengthChange": false,
        //   "searching": false,
        //   "ordering": true,
        //   "info": true,
        //   "autoWidth": false,
        //   "responsive": true,
        // });
    });

    function PrintElem() {

        document.getElementsByClassName("dt-buttons btn-group flex-wrap")[0].style = "display:none"
        window.print();
        document.getElementsByClassName("dt-buttons btn-group flex-wrap")[0].style = "display:block"

    }

    function requestPerpage(value) {

        const url = new URL(location.href);

        url.searchParams.set('per_page', value);

        location.href = url

        return false;
    }

    function requestSorte(value) {

        const url = new URL(location.href);

        url.searchParams.set('sort', value);

        location.href = url

        return false;
    }

    $(document).ready(function() {

        if (document.getElementById("example2_wrapper") != null) {

            children = document.getElementById("example2_wrapper").childNodes

            console.log(children[0].childNodes[0])

            children[0].childNodes[0].innerHTML +=

                `
                    <div class="col-md-3">
                        <select class="form-control" onchange='requestPerpage(this.value)'>
                            <option value="10" {{Request('per_page') && Request('per_page') == 10 ? 'selected' : ''}} >10</option>
                            <option value="300000000" {{Request('per_page') && Request('per_page') > 100 ? 'selected' : ''}} >@lang('general.all')</option>
                            <option value="25" {{Request('per_page') && Request('per_page') == 25 ? 'selected' : ''}} >25</option>
                            <option value="50" {{Request('per_page') && Request('per_page') == 50 ? 'selected' : ''}} >50</option>
                            <option value="100" {{Request('per_page') && Request('per_page') == 100 ? 'selected' : ''}} >100</option>
                        </select>
                    </div>

                    <div class="col-md-3">
                        <select class="form-control" onchange='requestSorte(this.value)'>
                        <option value="DESC" {{Request('sort') && Request('sort') == 'DESC' ? 'selected' : ''}} >@lang('general.DESC')</option>
                            <option value="ASC" {{Request('sort') && Request('sort') == 'ASC' ? 'selected' : ''}} >@lang('general.ASC')</option>
                        </select>
                    </div>
                `
        }

    })
</script>
</body>

</html>
