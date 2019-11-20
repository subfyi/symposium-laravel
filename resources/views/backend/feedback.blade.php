@extends('cms.app')

@section('content')
    <?php use Carbon\Carbon;?>
    <div class="kt-container  kt-grid__item kt-grid__item--fluid">
        <div class="row">
            <div class="col-xl-12">
                <div class="kt-portlet">
                    <div class="kt-portlet__head">
                        <div class="kt-portlet__head-label">
													<span class="kt-portlet__head-icon kt-hide">
														<i class="la la-gear"></i>
													</span>
                            <h3 class="kt-portlet__head-title">
                                Görevler
                            </h3>
                        </div>
                    </div>
                    <div class="kt-portlet__body">
                        <div class="kt-section">

                            <div class="kt-section__content">

                                <div class="right_col" role="main">
                                    <div class="">


                                        <div class="row">
                                            <div class="">
                                                <div class="col-md-12 col-sm-12 col-xs-12">
                                                    <div class="x_panel">


                                                        <div class="x_content">
                                                            <table id="table1" class="table table-striped">
                                                                <thead>
                                                                <tr>
                                                                    <th>#</th>
                                                                    <th>Kullanıcı</th>
                                                                    <th>Güncelleme</th>
                                                                    <th>Son Verilen Cevap</th>
                                                                    <th>Son Cevap Veren</th>
                                                                    <th>İşlem</th>
                                                                </tr>
                                                                </thead>
                                                                <tbody>

                                                                @foreach($feedback as $gorev)
                                                                    <?php
                                                                    $ts1 = strtotime(str_replace('/', '-', Carbon::now()->formatLocalized('%y-%m-%d')));
                                                                    $ts2 = strtotime(str_replace('/', '-', $gorev->updated_at->formatLocalized('%y-%m-%d')));
                                                                    $diff = abs($ts1 - $ts2) / 60 / 60 / 24;
                                                                    ?>
                                                                    @if ($diff<1)
                                                                        <tr style="background-color: lightyellow;">
                                                                    @else
                                                                        <tr>
                                                                            @endif
                                                                            <td scope="row">{{$gorev->id}}</td>
                                                                            <td scope="row">{{$gorev->user->name}}</td>
                                                                            <td>{{$gorev->updated_at->formatLocalized('%Y-%m-%d, %H:%M')}}</td>
                                                                            <td>
                                                                                @if($gorev->feeddatalast!= NULL)
                                                                                    <?php echo html_entity_decode($gorev->feeddatalast->isicerik); ?>
                                                                                @else
                                                                                    {{"Veri Yok"}}
                                                                                @endif</td>

                                                                            <td scope="row"> <?php
                                                                                $uisd = $gorev->feeddatalast->grv_icerik_olusturan;
                                                                                echo \App\User::where('id','=', $uisd)->first()->name; ?>
                                                                            </td>
                                                                            <td>
                                                                                <a href="{{url('/')}}//feedback/feedback-duzenle/{{$gorev->slug}}"
                                                                                   class="btn btn-primary">düzenle</a>
                                                                            </td>
                                                                            </td>
                                                                            @endforeach
                                                                        </tr>
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
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- page content -->
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

        $('#table1').DataTable({
            "aLengthMenu": [[100, 200, 300, -1], [100, 200, 300, "All"]],
            "order": [[0, "asc"]],
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