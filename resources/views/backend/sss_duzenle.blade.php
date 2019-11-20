@extends('backend.app')

@section('content')
    @php
        $sayi=0;
    @endphp
    <div class="right_col" role="main">
        <div class="">
            <div class="row">
                <div class="">

                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="x_panel">

                            <div class="x_title">
                                <h2>Yazı Düzenle </h2>
                                <h2 class="nav navbar-right panel_toolbox"><?php echo "[" . date("Y-m-d") . "]";?></h2>
                                <div class="clearfix"></div>
                            </div>
                            <div class="x_content">
                                <div class="" role="tabpanel" data-example-id="togglable-tabs">

                                    <form method="post" id="form" data-parsley-validate
                                          class="form-horizontal form-label-left" enctype="multipart/form-data">
                                        {{csrf_field()}}
                                        <div class="x_panel">
                                            <div class="x_content">

                                                <div class="form-group">
                                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" >baslik <span class="required">*</span>
                                                    </label>
                                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                                        <input class="form-control col-md-7 col-xs-12 error" required="required" name="baslik" type="text" value="{{$sss->baslik}}" aria-invalid="true"><label id="baslik-error" class="error" for="baslik">Bu alanın doldurulması zorunludur.</label>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" >istek_birimi
                                                    </label>
                                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                                        <input class="form-control col-md-7 col-xs-12 error" name="istek_birimi" type="text" value="{{$sss->istek_birimi}}" aria-invalid="true"><label id="baslik-error" class="error" for="baslik">Bu alanın doldurulması zorunludur.</label>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" >islem
                                                    </label>
                                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                                        <input class="form-control col-md-7 col-xs-12 error" name="islem" type="text" value="{{$sss->islem}}" aria-invalid="true"><label id="baslik-error" class="error" for="baslik">Bu alanın doldurulması zorunludur.</label>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">İçerik<span
                                                                class="required">*</span>
                                                    </label>
                                                    <div class="col-md-9 col-sm-9 col-xs-12">
                                                        <textarea id="editor" name="icerik"
                                                                  class="form-control ckeditor" rows="3">
                                                            {{$sss->icerik}}
                                                        </textarea>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                        <div class="ln_solid"></div>
                                        <div class="form-group">
                                            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                                <button type="submit" class="btn btn-success">Kaydet</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>


@endsection
@section('css')
@endsection
@section('js')
    <script src="{{url('/')}}/js/jquery.form.min.js"></script>
    <script src="{{url('/')}}/js/jquery.validate.min.js"></script>
    <script src="{{url('/')}}/js/messages_tr.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>


    <script>
        $(document).ready(function () {
            $('form').validate();
            $('form').ajaxForm({
                beforeSubmit: function () {
                    swal({
                        title: 'Yükleniyor',
                        text: ' Lütfen Bekleyiniz..',
                        icon: 'info',
                    })
                },
                beforeSerialize: function () {
                },
                success: function (response) {
                    swal({
                        title: response.baslik,
                        text: response.icerik,
                        icon: response.durum,
                    });
                }
            });

        });
    </script>


    <script src="https://cdn.ckeditor.com/ckeditor5/10.0.1/classic/ckeditor.js"></script>
    <script>
        ClassicEditor
            .create( document.querySelector( '#editor' ) )
            .catch( error => {
                console.error( error );
            } );
    </script>
@endsection