@extends('cms.app')

@section('content')

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
                                Papers
                            </h3>
                        </div>
                    </div>
                    <div class="kt-portlet__body">
                        <div class="kt-section">

                            <div class="kt-section__content">

                                <!-- page content -->
                                <div class="right_col" role="main">
                                    <div class="">


                                        <div class="row">
                                            <div class="">
                                                <div class="col-md-12 col-sm-12 col-xs-12">
                                                    <div class="x_panel">

                                                        <div class="x_content">
                                                            <table class="table table-striped- table-bordered table-hover table-checkable"
                                                                   id="kt_table_1" style="width: 100%">
                                                                <thead>
                                                                <tr>
                                                                    <th>Title of Abstract:</th>
                                                                    <th>Topic of article</th>
                                                                    <th>Pap. Type</th>
                                                                    <th>Pre. Type</th>
                                                                    <th>Attachment</th>
                                                                    <th>Sended Date</th>
                                                                </tr>
                                                                </thead>
                                                                <tbody>

                                                                @foreach($tumgorevler as $gorev)
                                                                    <tr>
                                                                        <td style="width: 20%">{{$gorev->pap_title}}</td>
                                                                        <td style="width: 20%"><?php echo html_entity_decode($gorev->pap_topic); ?></td>
                                                                        <td>
                                                                            @if($gorev->parampap != NULL)
                                                                                {{$gorev->parampap->value}}
                                                                            @endif
                                                                        </td>
                                                                        <td>
                                                                            @if($gorev->parampre != NULL)
                                                                                {{$gorev->parampre->value}}
                                                                            @endif
                                                                        </td>
                                                                        <td>
                                                                            @if($gorev->dosyalar != NULL)
                                                                                <a href="{{url('/')}}/uploads/dosya/{{$gorev->user->slug}}/{{$gorev->dosyalar->f_dosyaisimi}}"><i class="fa fa-folder"></i> Download </a>
                                                                            @endif
                                                                        </td>
                                                                        <td>{{$gorev->created_at->formatLocalized('%Y-%m-%d, %H:%M')}}</td>

                                                                        </td>
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
                            </div>
                        </div>
                    </div>
                </div>
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
        $('#table1').DataTable({
            "aLengthMenu": [[10, 20, 30, -1], [10, 20, 30, "All"]],
            "order": [[5, "dec"]],
        });

    </script>
@endsection