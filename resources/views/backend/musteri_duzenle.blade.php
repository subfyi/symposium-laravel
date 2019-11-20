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
                                <h2>Ayarlarım </h2>
                                <h2 class="nav navbar-right panel_toolbox"><?php echo "[" . date("Y-m-d") . "]";?></h2>
                                <div class="clearfix"></div>
                            </div>
                            <div class="x_content">
                                <div class="" role="tabpanel" data-example-id="togglable-tabs">


                                    <form method="post" id="demo-form2" data-parsley-validate
                                          class="form-horizontal form-label-left">
                                        {{csrf_field()}}
                                        <div class="x_panel">
                                            <div class="x_content">
                                                <div class="form-group">
                                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Kurum
                                                    </label>
                                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                                        <select class="form-control" name="kurumadi">
                                                            <option value="30"> </option>
                                                            @foreach($kurumlar as $kategori)
                                                                @if ( $kategori->id == $musteriler->kurumadi)
                                                                    <option value='{{$kategori->id}}' selected> {{$kategori->ad}}</option>
                                                                @else
                                                                    <option value="{{$kategori->id}}">{{$kategori->ad}}</option>
                                                                @endif
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>

                                                {{ Form::bsText('mus_bilgisi','Müşteri Bilgisi',$musteriler->mus_bilgisi)}}
                                                {{ Form::bsText('mus_is_adi','Müşteri İş Adı*',$musteriler->mus_is_adi)}}
                                                {{ Form::bsText('mus_tel','Müşteri Tel:*',$musteriler->mus_tel)}}
                                                {{ Form::bsText('mus_eposta','Müşteri Eposta*',$musteriler->mus_eposta)}}

                                                <div class="form-group">
                                                    <label class="col-md-12 col-sm-12 col-xs-12">Müşteri Adres:</label>
                                                    <div class="col-md-12 col-sm-12 col-xs-12">

                                                    <textarea id="editor" name="mus_adres"
                                                              class="form-control ck-editor__editable ck-editor__editable_inline ckeditor"
                                                              rows="3">{{$musteriler->mus_adres}}
                                                        </textarea>
                                                    </div>
                                                </div>


                                            </div>
                                        </div>
                                        <div class="ln_solid"></div>
                                        <div class="form-group">
                                            <div class="col-md-12 col-sm-12 col-xs-12 col-md-offset-3">
                                                <button class="col-md-6 col-sm-6 col-xs-12 btn btn-success"
                                                        type="submit">Kaydet
                                                </button>
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
    <style>
        .ck-editor__editable {
            min-height: 180px;
        }
    </style>
@endsection
@section('js')
    <script src="{{url('/')}}/js/jquery.form.min.js"></script>
    <script src="{{url('/')}}/js/jquery.validate.min.js"></script>
    <script src="{{url('/')}}/js/messages_tr.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    <script src="https://cdn.ckeditor.com/ckeditor5/10.0.1/classic/ckeditor.js"></script>
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
                    }).then(function () {
                            location.replace('//musteri/musteriler/');
                        }
                    );
                },
            })

        })
    </script>
@endsection