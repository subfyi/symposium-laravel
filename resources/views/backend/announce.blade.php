@extends('backend.app')

@section('content')

    <div class="right_col" role="main">
        <div class="">
            <div class="row">
                <div class="">


                    <div class="col-md-12 col-sm-12 col-xs-12">

                        <div class="x_panel">

                            <div class="x_title">
                                <h2>Announcement </h2>
                                <h2 class="nav navbar-right panel_toolbox"><?php echo "[" . date("Y-m-d") . "]";?></h2>
                                <div class="clearfix"></div>
                            </div>
                            <div role="tabpanel" class="tab-pane fade active in" id="tab_content1"
                                        aria-labelledby="home-tab">
                                <table id="table1" class="table table-striped ">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th style="width: 80%">About</th>
                                        <th>From</th>
                                        <th>Detail</th>
                                        @if(\Illuminate\Support\Facades\Auth::user()->yetki > 7)
                                            <th>Edit</th>
                                            @endif
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($announce as $blog)
                                        <tr>
                                            <td>{{$blog->baslik}}</td>
                                            <td><?php echo html_entity_decode($blog->icerik); ?></td>
                                            <td>{{$blog->istek_birimi}}</td>
                                            <td>{{$blog->islem}}</td>

                                            @if(\Illuminate\Support\Facades\Auth::user()->yetki > 7)

                                                <td>
                                                    <a href="{{url('/')}}//announcement/announce-duzenle/{{$blog->slug}}"
                                                       class="btn btn-primary">düzenle</a>
                                                </td>
                                            @endif
                                        </tr>
                                    @endforeach

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
    <!-- /page content -->

@endsection
@section('css')
    <link href="{{url('/')}}/backend/vendors/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
    <link href="{{url('/')}}/backend/vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet">
    <link href="{{url('/')}}/backend/vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css" rel="stylesheet">
    <link href="{{url('/')}}/backend/vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" rel="stylesheet">
    <link href="{{url('/')}}/backend/vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css" rel="stylesheet">

@endsection
@section('js')
    <script src="{{url('/')}}/backend/vendors/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="{{url('/')}}/backend/vendors/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
    <script src="{{url('/')}}/backend/vendors/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
    <script src="{{url('/')}}/backend/vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js"></script>
    <script src="{{url('/')}}/backend/vendors/datatables.net-buttons/js/buttons.flash.min.js"></script>
    <script src="{{url('/')}}/backend/vendors/datatables.net-buttons/js/buttons.html5.min.js"></script>
    <script src="{{url('/')}}/backend/vendors/datatables.net-buttons/js/buttons.print.min.js"></script>
    <script src="{{url('/')}}/backend/vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js"></script>
    <script src="{{url('/')}}/backend/vendors/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>
    <script src="{{url('/')}}/backend/vendors/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
    <script src="{{url('/')}}/backend/vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js"></script>
    <script src="{{url('/')}}/backend/vendors/datatables.net-scroller/js/dataTables.scroller.min.js"></script>
    <script src="{{url('/')}}/backend/vendors/jszip/dist/jszip.min.js"></script>
    <script src="{{url('/')}}/backend/vendors/pdfmake/build/pdfmake.min.js"></script>
    <script src="{{url('/')}}/backend/vendors/pdfmake/build/vfs_fonts.js"></script>


    <script src="{{url('/')}}/js/jquery.form.min.js"></script>
    <script src="{{url('/')}}/js/jquery.validate.min.js"></script>
    <script src="{{url('/')}}/js/messages_tr.min.js"></script>
    <script src="{{url('/')}}/js/sweetalert2.js"></script>

    <script>
        $('#table1').DataTable({
            "aLengthMenu": [[100, 200, 300, -1], [100, 200, 300, "All"]],
            "iDisplayLength": 100,
        });


        function sil(r, id) {
            var sira = r.parentNode.parentNode.rowIndex;
            swal({
                title: 'Silmek İstedinize Emin Misiniz ?',
                text: 'Sildiğinizde Geri Dönüşümü Olmayacaktır!',
                type: 'warning',
                showCancelButton: true,
                cancelButtonText: 'iptal',
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Evet, Sil!'

            }).then(function () {

                var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
                $.ajax({
                    type: "Post",
                    url: '',  // blog-sil
                    data: {
                        'id': id,
                        '_token': CSRF_TOKEN
                    },
                    beforeSubmit: function () {
                        swal({
                            title: '<i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i><span class="sr-only">Loading...</span>',
                            text: 'Yükleniyor Lütfen Bekleyiniz..',
                            showConfirmButton: false,
                        })
                    },
                    success: function (response) {
                        if (response.durum == 'success') {
                            document.getElementById("datatable-buttons").deleteRow(sira);
                        }
                        swal(
                            response.baslik,
                            response.icerik,
                            response.durum
                        );
                    }
                })
            })
        }
    </script>
@endsection