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
                                                                        <td style="width: 20%">
                                                                            @if($gorev->topic)
                                                                                {{ $gorev->topic->value }}
                                                                            @endif</td>
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
                                                                                @foreach($gorev->dosyalar as $dosya)
                                                                                    <a href="{{url('/')}}/uploads/dosya/{{$gorev->user->slug}}/{{$dosya->f_dosyaisimi}}"><i class="fa fa-folder"></i> Download </a>
                                                                                @endforeach
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
                            location.replace('/user/papers/');
                        });;
                    }
                })
            })
        }



    </script>
@endsection