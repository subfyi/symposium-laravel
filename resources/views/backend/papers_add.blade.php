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
                                Send New Article to Person
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
                                            <div class="col-md-12 col-sm-12 col-xs-12">

                                                <div class="x_panel">
                                                    <div class="x_content">


                                                        <form method="post" id="demo-form2" data-parsley-validate
                                                              class="form-horizontal form-label-left">

                                                            {{csrf_field()}}
                                                            <div class="row">


                                                                <div class="col-md-12 col-sm-12 col-xs-12">
                                                                    <div class="x_panel tile">
                                                                        <div class="x_content">
                                                                            <div class="col-md-12 col-sm-12 col-xs-12">
                                                                                {{ Form::bsText('pap_title','Title of Paper:','',['required'=>'required']) }}

                                                                                <div class="form-group row">
                                                                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">
                                                                                        Topic of Paper*
                                                                                    </label>
                                                                                    <div class="col-md-9 col-sm-9 col-xs-6">
                                                                                        <input class="form-control col-md-5 col-xs-12"
                                                                                               name="pap_topic" type="text" value="" required>
                                                                                    </div>
                                                                                </div>

                                                                                <div class="form-group row">
                                                                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">
                                                                                        Paper Type*:
                                                                                    </label>
                                                                                    <div class="col-md-9 col-sm-9 col-xs-6">

                                                                                        <select class="form-control"
                                                                                                name="pap_type">
                                                                                            @foreach($birimcon as $val)
                                                                                                <option value='{{$val->item_num}}'> {{$val->value}}</option>
                                                                                            @endforeach
                                                                                        </select>
                                                                                    </div>
                                                                                </div>

                                                                                <div class="form-group row">
                                                                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">
                                                                                        Presentation Type*:
                                                                                    </label>
                                                                                    <div class="col-md-9 col-sm-9 col-xs-6">

                                                                                        <select class="form-control"
                                                                                                name="pre_type">
                                                                                            @foreach($uygulamacon as $val)
                                                                                                <option value='{{$val->item_num}}'> {{$val->value}}</option>
                                                                                            @endforeach
                                                                                        </select>
                                                                                    </div>
                                                                                </div>


                                                                                <div class="form-group row">
                                                                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">
                                                                                        Who's Paper*:
                                                                                    </label>
                                                                                    <div class="col-md-9 col-sm-9 col-xs-6">

                                                                                        <select class="form-control"
                                                                                                name="pap_whos">
                                                                                            @foreach($kullanicilar as $val)
                                                                                                <option value='{{$val->id}}'> {{$val->name}}, {{$val->surname}}, {{$val->email}}</option>
                                                                                            @endforeach
                                                                                        </select>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="form-group row">
                                                                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Attachment </label>
                                                                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                                                                        <input type="file" name="dosyalar[]" class="form-control" required>
                                                                                    </div>
                                                                                </div>




                                                                            </div>

                                                                        </div>
                                                                    </div>
                                                                </div>


                                                                <div class="col-md-12 col-sm-12 col-xs-12">
                                                                    <div class="form-group row">
                                                                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                                                            <button type="submit" class="col-md-12 btn btn-success">Save
                                                                            </button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </form>
                                                        <!-- end form for validations -->

                                                    </div>
                                                </div>
                                            </div>
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


    <!-- bootstrap-datetimepicker -->
    <link href="{{url('/')}}/backend/vendors/bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.css" rel="stylesheet">

    <link href="{{url('/')}}/backend/vendors/iCheck/skins/flat/green.css" rel="stylesheet">
    <style>
        .ck-editor__editable {
            min-height: 180px;
        }
    </style>
@endsection
@section('js')

    <script src="{{url('/')}}/backend/vendors/iCheck/icheck.min.js"></script>
    <!-- bootstrap-daterangepicker -->
    <script src="{{url('/')}}/backend/vendors/moment/min/moment.min.js"></script>
    <script src="{{url('/')}}/backend/vendors/moment/locale/tr.js"></script>
    <!-- bootstrap-datetimepicker -->
    <script src="{{url('/')}}/backend/vendors/bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js"></script>

    <script src="{{url('/')}}/js/jquery.form.min.js"></script>
    <script src="{{url('/')}}/js/jquery.validate.min.js"></script>
    <script src="{{url('/')}}/js/messages_tr.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/10.0.1/classic/ckeditor.js"></script>

    <script>
        var dateNow = new Date();
        $("#narusta-time").datetimepicker({
            defaultDate: dateNow,
            format: 'DD-MM-YYYY HH:mm',
            locale: 'tr',
        });

        $(document).ready(function () {
            $('form').validate();
            $('form').ajaxForm({
                beforeSubmit: function () {

                },
                uploadProgress: function (event, position, total, percentComplete) {
                    var percentVal = percentComplete + '%';
                    swal({
                        title: percentVal + ' Loading',
                        text: ' Please wait..',
                        icon: 'info',
                        button: false,
                    })
                },
                success: function (response) {
                    swal({
                        title: response.baslik,
                        text: response.icerik,
                        icon: response.durum,
                    }).then(function () {
                        location.replace('{{url('/user/papers-all')}}');
                    });
                },
            });

        });


        var myEditor;

        ClassicEditor
            .create(document.querySelector('#editor'))
            .then(editor => {
                console.log('Editor was initialized', editor);
                myEditor = editor;
            })
            .catch(err => {
                console.error(err.stack);
            });

    </script>
@endsection