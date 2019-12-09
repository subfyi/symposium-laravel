@extends('cms.app')

@section('content')
    <div class="kt-container  kt-grid__item kt-grid__item--fluid" style="width: 100%">
        <div class="row">
            <div class="col-xl-12">
                <div class="kt-portlet">
                    <div class="kt-portlet__head">
                        <div class="kt-portlet__head-label">
													<span class="kt-portlet__head-icon kt-hide">
														<i class="la la-gear"></i>
													</span>
                            <h3 class="kt-portlet__head-title">
                                All Papers
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
                                                                   id="kt_table_1">
                                                                <thead>
                                                                <tr>
                                                                    <th>#</th>
                                                                    <th>user</th>
                                                                    <th>mail</th>
                                                                    <th>tel</th>
                                                                    <th style="width: 25%">Title of Abstract:</th>
                                                                    <th style="width: 20%">Topic of article</th>
                                                                    <th>Pap. Type</th>
                                                                    <th>Pre. Type</th>
                                                                    <th>Attachment</th>
                                                                    <th>Sended Date</th>
                                                                    <th>Status</th>
                                                                    <th>Payment</th>
                                                                    <th>Act</th>
                                                                </tr>
                                                                </thead>
                                                                <tbody>

                                                                @foreach($tumgorevler as $gorev)
                                                                    <?php
                                                                    $us = \App\User::where('id','=',$gorev->dosyalar->f_icerik_olusturan)->first();
                                                                    ?>
                                                                    <tr>
                                                                        <td>{{$gorev->id}}</td>
                                                                        <td>{{$us->name . ' ' . $us->surname }}</td>
                                                                        <td>{{$us->email}}</td>
                                                                        <td>{{$us->iletisim}}</td>
                                                                        <td>{{$gorev->pap_title}}</td>
                                                                        <td><?php echo html_entity_decode($gorev->pap_topic); ?></td>
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

                                                                        <td>
                                                                            @if($gorev->pap_status == 0)
                                                                                Waiting
                                                                            @else
                                                                                Approved
                                                                            @endif
                                                                        </td>

                                                                        <td>
                                                                            @if($gorev->pap_payment == 0)
                                                                                Waiting
                                                                            @else
                                                                                Approved
                                                                            @endif
                                                                        </td>

                                                                        <td>
                                                                            <button onclick="sil(this,'{{$gorev->id}}')"
                                                                                    class="btn btn-danger"><i class="fa fa-trash"
                                                                                                              style="color:white"></i>
                                                                            </button>

                                                                        </td>
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

@endsection
@section('js')

    <script>
        function sil(r, id) {
            var sira = r.parentNode.parentNode.rowIndex;
            swal({
                title: 'Are You Sure You Want To Delete?',
                text: 'It will not be recycled!',
                type: 'warning',
                showCancelButton: false,
                cancelButtonText: 'cancel',
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, Delete!'

            }).then(function () {

                var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
                $.ajax({
                    type: "Post",
                    url: '',
                    data: {
                        'id': id,
                        '_token': CSRF_TOKEN
                    },
                    beforeSubmit: function () {
                        swal({
                            title: '<i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i><span class="sr-only">Loading...</span>',
                            text: 'Loading Please wait ..',
                            showConfirmButton: false,
                        })
                    },
                    success: function (response) {
                        swal(
                            response.baslik,
                            response.icerik,
                            response.durum
                        ).then(function () {
                            location.replace('{{url('/user/papers-all')}}');
                        });;
                    }
                })
            })
        }


    </script>
@endsection
