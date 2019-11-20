@extends('backend.app')

@section('content')

    <div class="right_col" role="main">
        <div class="">
            <div class="row">
                <div class="">
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="x_panel">
                                <div class="x_title">
                                    <h2>Müşteriler </h2>
                                    <h2 class="nav navbar-right panel_toolbox"><?php echo "[" . date("Y-m-d") . "]";?></h2>
                                    <div class="clearfix"></div>
                                </div>

                                <div class="x_content">

                                    <table id="table1" class="table">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Müşteri Bilgisi</th>
                                            <th>Müşteri İş adı</th>
                                            <th>Müşteri Telefonu</th>
                                            <th>Müşteri Eposta</th>
                                            <th>Müşteri Adres</th>
                                            <th>Müşteri Keşif</th>
                                            <th>Kurum</th>
                                            <th>İşlem</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($musteriler as $musteri)
                                            <tr>
                                                <th scope="row">{{$musteri->id}}</th>
                                                <td>{{$musteri->mus_bilgisi}}</td>
                                                <td>{{$musteri->mus_is_adi}}</td>
                                                <td>{{$musteri->mus_tel}}</td>
                                                <td>{{$musteri->mus_eposta}}</td>
                                                <td>{{$musteri->mus_adres}}</td>
                                                <td>{{$musteri->mus_kesif}}</td>
                                                <td>
                                                    @if($musteri->kurum != NULL)
                                                        {{$musteri->kurum->ad}}
                                                    @else
                                                        {{"Kurum Yok"}}
                                                    @endif</td>
                                                <td>
                                                    <a href="{{url('/')}}//musteri/musteri-duzenle/{{$musteri->slug}}"
                                                       class="btn btn-success btn-xs">Düzenle</a>
                                                    <button onclick="sil(this,'{{$musteri->id}}')"  class="btn btn-danger  btn-xs">sil</button>
                                                </td>

                                            </tr>
                                        @endforeach

                                        </tbody>
                                    </table>

                                </div>
                            </div>
                        </div>

                        <div class="clearfix"></div>

                    </div>


                </div>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>

@endsection
@section('css')
    <link href="{{url('/')}}/backend/vendors/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
    <link href="{{url('/')}}/backend/vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet">
    <link href="{{url('/')}}/backend/vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css" rel="stylesheet">
    <link href="{{url('/')}}/backend/vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" rel="stylesheet">
    <link href="{{url('/')}}/backend/vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css" rel="stylesheet">


    <style>
        /* dataTables CSS modification & positioning */
        table.dataTable thead .sorting:after,
        table.dataTable thead .sorting_asc:after,
        table.dataTable thead .sorting_desc:after,
        table.dataTable thead .sorting_asc_disabled:after,
        table.dataTable thead .sorting_desc_disabled:after {
            right: 0 !important;
            content: "" !important;
        }

        table.dataTable thead .sorting:before,
        table.dataTable thead .sorting_asc:before,
        table.dataTable thead .sorting_desc:before,
        table.dataTable thead .sorting_asc_disabled:before,
        table.dataTable thead .sorting_desc_disabled:before {
            right: 0 !important;
            content: "" !important;
        }

        table.dataTable thead th {
            position: relative;
            background-image: none !important;
        }

        table.dataTable thead th.sorting:before,
        table.dataTable thead th.sorting_asc:before,
        table.dataTable thead th.sorting_desc:before {
            margin-right: 10px;
            float: left;
            font-family: FontAwesome !important;
        }

        table.dataTable thead th.sorting:before {
            content: "\f0dc" !important;
            color: #ddd !important;
            font-size: 0.8em !important;
            padding-top: 0.12em !important;
        }

        table.dataTable thead th.sorting_asc:before {
            content: "\f0de" !important;
        }

        table.dataTable thead th.sorting_desc:before {
            content: "\f0dd" !important;
        }
    </style>
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
                            document.getElementById("table").deleteRow(sira);
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



        $('#table1').DataTable({
            "aLengthMenu": [[100, 200, 300, -1], [100, 200, 300, "All"]],
            "order": [[0, "dec"]],
            "iDisplayLength": 100,
            "language": {
                "url": "/json/datatables.Turkish.json"
            },
            fixedHeader: true,
            dom: 'Bfrtip',
            buttons: [
                'csv', 'print'
            ],
        });
    </script>
@endsection