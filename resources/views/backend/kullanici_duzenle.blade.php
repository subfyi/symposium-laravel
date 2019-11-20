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
                                                @if($kullanicilar->logo!=NULL)
                                                    <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                                        <img style="width: 100px;height: 100px;"
                                                             src="{{url('/')}}/uploads/img/{{$kullanicilar->logo}}" class="avatar"
                                                             alt="Avatar">
                                                    </div>
                                                @endif
                                                <div class="form-group">
                                                    <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                                        <input type="file" name="logo" class="btn btn-success"></input>
                                                        <input type="hidden" name="eski_logo"
                                                               value="{{$kullanicilar->logo}}">
                                                    </div>
                                                </div>
                                                {{ Form::bsText('name','Name', $kullanicilar->name)}}
                                                {{ Form::bsText('surname','Surname', $kullanicilar->surname)}}


                                                <div class="form-group  ">
                                                    <label  class="col-sm-3 control-label">Title</label>
                                                    <div class="col-md-6">

                                                        <select class="form-control"
                                                                name="u_title">
                                                            @foreach($titlecons as $val)
                                                                @if ( $val->item_num == $kullanicilar->u_title)
                                                                    <option value='{{$val->item_num}}'
                                                                            selected> {{$val->value}}</option>
                                                                @else
                                                                    <option value='{{$val->item_num}}'> {{$val->value}}</option>
                                                                @endif
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group ">
                                                    <label  class="col-sm-3 control-label">Type</label>
                                                    <div class="col-md-6">

                                                        <select class="form-control"
                                                                name="u_type">
                                                            @foreach($materialcon as $val)
                                                                @if ( $val->item_num == $kullanicilar->f_malzeme_turu)
                                                                    <option value='{{$val->item_num}}'
                                                                            selected> {{$val->value}}</option>
                                                                @else
                                                                    <option value='{{$val->item_num}}'> {{$val->value}}</option>
                                                                @endif
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                {{ Form::bsText('institution','Institution',$kullanicilar->institution)}}
                                                {{ Form::bsText('faculty','Faculty',$kullanicilar->faculty)}}
                                                {{ Form::bsText('department','Department',$kullanicilar->department)}}
                                                {{ Form::bsText('email','E-mail',$kullanicilar->email)}}
                                                {{ Form::bsText('iletisim','Mobile / GSM',$kullanicilar->iletisim)}}
                                                    <div class="form-group">
                                                        <div class="col-md-9">
                                                            <label for="password_confirmation"
                                                                   class="col-sm-4 control-label">Yeni Şifre</label>
                                                            <div class="col-sm-8">
                                                                <div class="form-group">
                                                                    <input type="password" class="form-control"
                                                                           id="password_confirmation" name="password">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>


                                                <div class="form-group">
                                                    <label class="col-md-12 col-sm-12 col-xs-12">Address
                                                        :</label>
                                                    <div class="col-md-12 col-sm-12 col-xs-12">

                                                    <textarea id="editor" name="address"
                                                              class="form-control ck-editor__editable ck-editor__editable_inline ckeditor"
                                                              rows="2">{{$kullanicilar->address}}
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
    <link href="{{url('/')}}/backend/vendors/iCheck/skins/flat/green.css" rel="stylesheet">
    <style>
        .ck-editor__editable {
            min-height: 180px;
        }
    </style>
@endsection
@section('js')
    <script src="{{url('/')}}/backend/vendors/iCheck/icheck.min.js"></script>
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
                            location.replace('{{url('/user/user/users')}}');
                        }
                    );
                },
            })

        })
    </script>
@endsection