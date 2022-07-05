<!DOCTYPE html>
<html>
<head>
    <title>Coursati</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" href="{!! setAsset('images/logo/favicon.ico') !!}">
    <link rel="stylesheet" href="{{setAsset('admin/fontawesome-free/css/all.min.css')}}">
    <link rel="stylesheet" href="{{setAsset('admin/icheck-bootstrap/icheck-bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{setAsset('admin/datatables-bs4/css/dataTables.bootstrap4.css')}}">
    <link rel="stylesheet" href="{{setAsset('admin/datatables-responsive/css/responsive.bootstrap4.css')}}">
    <link rel="stylesheet" href="{{setAsset('admin/datatables-buttons/css/buttons.bootstrap4.css')}}">
    <link rel="stylesheet" href="{{setAsset('admin/datatables-select/css/select.bootstrap4.css')}}">
    <link rel="stylesheet" href="{{setAsset('admin/select2/css/select2.css')}}">
    <link rel="stylesheet" href="{{setAsset('admin/toastr/toastr.min.css')}}">
    <link rel="stylesheet" href="{{setAsset('admin/adminlte.min.css')}}">
    <link href="{{setAsset('dist/css/bootstrap-datetimepicker.css?v2')}}" rel="stylesheet" />
    <!-- bootstrap rtl -->
   <link rel="stylesheet" href="{{setAsset('dashboard/css/bootstrap-rtl.min.css')}}">
    <link rel="stylesheet" href="{{setAsset('dashboard/css/rtl.css')}}">
    <link rel="stylesheet" href="{{setAsset('dashboard/css/custom.css')}}">
    @yield('style')
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;400&display=swap" rel="stylesheet"> </head>
<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed text-sm">
    @if(Route::currentRouteName() != 'admin.show.login')
        @include('admin.partial.navbar')
        @include('admin.partial.sidebar')
    @endif
<style>
    *{
        font-family: 'Cairo', sans-serif;
    }
    div.alphabet {
        position: relative;
        display: table;
        width: 100%;
        margin-bottom: 1em;
    }
    select { width: 400px; text-align-last:center; }

    th{
        font-weight: bolder;
        font-size: 20px;
        text-align: center;
    }

    b , .list-group-item a{
        font-weight: bolder;
        font-size: 22px;
    }
    label , .form-group label{
        font-size: 18px !important;
    }
    span{
        font-weight: bolder;
        font-size: 18px !important;
    }
    td{
        text-align: center;
    }
    div.alphabet span {
        display: table-cell;
        color: #3174c7;
        cursor: pointer;
        text-align: center;
        width: 3.5%
    }

    div.alphabet span:hover {
        text-decoration: underline;
    }

    div.alphabet span.active {
        color: black;
    }

    div.alphabet span.empty {
        color: red;
    }

    .fa-plus{
        color: green;
        font-size: 34px;

    }
    div.alphabetInfo {
        display: block;
        position: absolute;
        background-color: #111;
        border-radius: 3px;
        color: white;
        top: 2em;
        height: 1.8em;
        padding-top: 0.4em;
        text-align: center;
        z-index: 1;
    }
</style>
    @if(!request()->is('admin/login'))
    <div class="content-wrapper">
        @yield('content')
    </div>
    @else
        @yield('content')
    @endif
    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
    </aside>

    <script src="{{setAsset('admin/jquery/jquery.min.js')}}"></script>
    <script src="{{setAsset('admin/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{setAsset('admin/datatables/jquery.dataTables.js')}}"></script>
    <script src="{{setAsset('admin/datatables-bs4/js/dataTables.bootstrap4.js')}}"></script>
    <script src="{{setAsset('admin/datatables-responsive/js/dataTables.responsive.js')}}"></script>
    <script src="{{setAsset('admin/datatables-responsive/js/responsive.bootstrap4.js')}}"></script>
    <script src="{{setAsset('admin/datatables-buttons/js/dataTables.buttons.js')}}"></script>
    <script src="{{setAsset('admin/datatables-buttons/js/buttons.bootstrap4.js')}}"></script>
    <script src="{{setAsset('admin/datatables-buttons/js/buttons.colVis.js')}}"></script>
    <script src="{{setAsset('admin/datatables-buttons/js/buttons.flash.js')}}"></script>
    <script src="{{setAsset('admin/datatables-buttons/js/buttons.html5.js')}}"></script>
    <script src="{{setAsset('admin/datatables-buttons/js/buttons.print.js')}}"></script>
    <script src="{{setAsset('admin/datatables-keytable/js/dataTables.keyTable.js')}}"></script>
    <script src="{{setAsset('admin/datatables-keytable/js/keyTable.bootstrap4.js')}}"></script>
    <script src="{{setAsset('admin/datatables-select/js/dataTables.select.js')}}"></script>
    <script src="{{setAsset('admin/datatables-select/js/select.bootstrap4.js')}}"></script>
    <script src="{{setAsset('admin/pdfmake/pdfmake.js')}}"></script>
    <script src="{{setAsset('admin/pdfmake/vfs_fonts.js')}}"></script>
    <script src="{{setAsset('admin/select2/js/select2.js')}}"></script>
    <script src="{{setAsset('admin/toastr/toastr.min.js')}}"></script>
    <script src="{{setAsset('admin/adminlte.js')}}"></script>
    <script src="{{setAsset('dashboard/js/custom.js')}}"></script>
    <script type="text/javascript"
            src="https://pagead2.googlesyndication.com/pagead/show_ads.js">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment-with-locales.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/moment-hijri@2.1.2/moment-hijri.min.js"></script>
    <script src="{{setAsset('dist/js/bootstrap-hijri-datetimepicker.js?v2')}}"></script>


    @include('admin.partial.alert')
    @include('admin.partial.confirm_delete')

    <script>

        $(function () {

            var a = $("#datatable-table,.datatable-table").DataTable({
                dom: 'Alfrtip',
                //dom: 'Bfrtip',
                pageLength: 50,
                "aaSorting": [],
                buttons: [
                    {
                        extend: 'csv',
                        text: 'ملف Excel',
                        className: "btn btn-success"

                    },
                    {
                        extend: 'print',
                        text: 'ملف PDF',
                        className: "btn btn-inverse"
                    },
                ],

                "language": {
                    "sEmptyTable": "ليست هناك بيانات متاحة في الجدول",
                    "sLoadingRecords": "جارٍ التحميل...",
                    "sProcessing": "جارٍ التحميل...",
                    "sLengthMenu": "أظهر _MENU_ مدخلات",
                    "sZeroRecords": "لم يعثر على أية سجلات",
                    "sInfo": "إظهار _START_ إلى _END_ من أصل _TOTAL_ مدخل",
                    "sInfoEmpty": "يعرض 0 إلى 0 من أصل 0 سجل",
                    "sInfoFiltered": "(منتقاة من مجموع _MAX_ مُدخل)",
                    "sInfoPostFix": "",
                    "sSearch": "ابحث:",
                    "sUrl": "",
                    "oPaginate": {
                        "sFirst": "الأول",
                        "sPrevious": "السابق",
                        "sNext": "التالي",
                        "sLast": "الأخير"
                    },
                    "oAria": {
                        "sSortAscending": ": تفعيل لترتيب العمود تصاعدياً",
                        "sSortDescending": ": تفعيل لترتيب العمود تنازلياً"
                    }
                }
            });
            a.buttons().container().appendTo("#datatable-table_wrapper .col-md-6:eq() ")


        });


       function confirmDelete(url){
           $('#confirm-delete-form').attr('action',url);
       }

    </script>
    @yield('script')
</body>
</html>
