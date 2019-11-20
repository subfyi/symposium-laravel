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
                                Send feedback
                            </h3>
                        </div>
                    </div>
                    <div class="kt-portlet__body">
                        <div class="kt-section">

                            <div class="kt-section__content">


                                                        <form method="post" id="demo-form2" data-parsley-validate
                                                              class="form-horizontal form-label-left">

                                                            {{csrf_field()}}

                                                            <div class="col-md-12 col-sm-12 col-xs-12">
                                                                <div class="col-md-12 col-sm-12 col-xs-12">

                                                                    <div style="display: none" class="form-group">

                                                                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Dosya
                                                                            Kayıt
                                                                            Yeri
                                                                        </label>
                                                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                                                            <select name="gondercloud"
                                                                                    class="form-control"
                                                                                    required>
                                                                                <option value='1'> Drive</option>
                                                                                <option value='0' selected> Local
                                                                                </option>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Files </label>
                                                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                                                            <input type="file" name="dosyalar[]" class="form-control"
                                                                                   multiple>
                                                                        </div>
                                                                    </div>

                                                                    <div class="form-group">
                                                                        <label class="control-label col-md-3 col-sm-3 col-xs-12"> Details: </label>
                                                                        <div class="col-md-9 col-sm-9 col-xs-12">
                                        <textarea rows="5" id="editor" name="isicerik"
                                                  class="form-control"></textarea>
                                                                        </div>
                                                                    </div>


                                                                </div>

                                                            </div>


                                                            <div class="col-md-12 col-sm-12 col-xs-12">
                                                                <div class="form-group">
                                                                    <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                                                        <button type="submit" class="col-md-12 btn btn-success">Send
                                                                        </button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </form>
                                                        <!-- end form for validations -->

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


    <!-- bootstrap-daterangepicker -->
    <link href="{{url('/')}}/backend/vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">
    <!-- bootstrap-datetimepicker -->
    <link href="{{url('/')}}/backend/vendors/bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.css" rel="stylesheet">
    <style>
        .ck-editor__editable {
            min-height: 180px;
        }
    </style>
@endsection
@section('js')

    <!-- bootstrap-daterangepicker -->
    <script src="{{url('/')}}/backend/vendors/moment/min/moment.min.js"></script>
    <script src="{{url('/')}}/backend/vendors/bootstrap-daterangepicker/daterangepicker.js"></script>
    <!-- bootstrap-datetimepicker -->
    <script src="{{url('/')}}/backend/vendors/bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js"></script>



    <script>
        $("#narusta-time").datetimepicker({
            daysOfWeekDisabled: [0, 6],
            format: 'DD-MM-YYYY HH:mm',
        });

        $("#narusta-time2").daterangepicker({
            timePicker: true,
            timePicker24Hour: true,
            timePickerIncrement: 15,
            locale: {
                format: 'DD/MM/YYYY HH:mm'
            }
        });
    </script>

    <script src="{{url('/')}}/js/jquery.form.min.js"></script>
    <script src="{{url('/')}}/js/jquery.validate.min.js"></script>
    <script src="{{url('/')}}/js/messages_tr.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    <script>
        $(document).ready(function () {
            $('form').validate();
            $('form').ajaxForm({
                beforeSubmit: function () {

                },
                uploadProgress: function (event, position, total, percentComplete) {
                    var percentVal = percentComplete + '%';
                    swal({
                        title: percentVal + ' Yükleniyor',
                        text: ' Lütfen Bekleyiniz..',
                        icon: 'info',
                    })
                },
                success: function (response) {
                    swal({
                        title: response.baslik,
                        text: response.icerik,
                        icon: response.durum,
                    }).then(function () {
                        location.replace('/');
                    });
                },
            });

        });
    </script>


    <script src="https://cdn.ckeditor.com/ckeditor5/10.0.1/classic/ckeditor.js"></script>
    <script>

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