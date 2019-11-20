@extends('backend.app')

@section('content')
    <!-- page content -->
    <div class="right_col" role="main">
        <div class="">

            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">

                    <div class="x_panel">

                        <div class="x_title">
                            <h2>Önizleme Ekle - {{$gorevler->grv_baslik}}</h2>
                            <h2 class="nav navbar-right panel_toolbox"><?php echo "[" . date("Y-m-d") . "]";?></h2>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">


                            <form method="post" id="demo-form2" data-parsley-validate
                                  class="form-horizontal form-label-left">

                                {{csrf_field()}}
                                <div class="row">
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <div class="x_panel tile">

                                            <div class="x_content">
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
                                                                <option value='2'> Drive</option>
                                                                <option value='1' selected> Local
                                                                </option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Dosyalar </label>
                                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                                            <input type="file" name="dosyalar[]" class="form-control"
                                                                   multiple>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>


                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <div class="form-group">
                                            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                                <button type="submit" class="col-md-12 btn btn-success">Kaydet
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
                        location.replace('//gorev-duzenle/{{$gorevler->slug}}');
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