@extends('backend.app')

@section('content')

    <!-- page content -->
    <div class="right_col" role="main">
        <div class="">

            <div class="row">
                <div class="">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="x_panel">

                            <div class="x_title">
                                <h2>Hakkımızda Düzenle </h2>
                                <h2 class="nav navbar-right panel_toolbox"><?php echo "[" . date("Y-m-d") . "]";?></h2>
                                <div class="clearfix"></div>
                            </div>
                            <div class="x_content">
                                <div class="" role="tabpanel" data-example-id="togglable-tabs">


                                    <form method="post" id="demo-form2" data-parsley-validate
                                          class="form-horizontal form-label-left">
                                        <div class="x_panel">
                                            <div class="x_content">

                                                {{csrf_field()}}
                                                {{ Form::bsText('vizyon','vizyon',$hakkimizda->vizyon)}}
                                                {{ Form::bsText('misyon','misyon',$hakkimizda->misyon)}}
                                                {{ Form::bsText('kisa_yazi','kisa_yazi',$hakkimizda->kisa_yazi)}}
                                                {{ Form::bsText('icerik','icerik',$hakkimizda->icerik)}}

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
    <!-- /page content -->

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

                },
                success: function (response) {
                    swal({
                        title: response.baslik,
                        text: response.icerik,
                        icon: response.durum,
                    });
                }
            })

        })
    </script>
@endsection