<script src="{{ asset('adminlte') }}/bower_components/jquery/dist/jquery.min.js"></script>
<script src="{{ asset('adminlte') }}/bower_components/jquery-ui/jquery-ui.min.js"></script>
<script>
    $.widget.bridge('uibutton', $.ui.button);
</script>
<script src="{{ asset('adminlte') }}/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="{{ asset('adminlte') }}/bower_components/raphael/raphael.min.js"></script>
<script src="{{ asset('adminlte') }}/bower_components/morris.js/morris.min.js"></script>
<script src="{{ asset('adminlte') }}/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<script src="{{ asset('adminlte') }}/dist/js/adminlte.min.js"></script>
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>