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
                                <h2>Add User</h2>
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
                                                    <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                                        <input type="file" name="logo" class="btn btn-success">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Name <span class="required">*</span>
                                                    </label>
                                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                                        <input class="form-control col-md-7 col-xs-12 valid" name="name" type="text" value="" aria-invalid="false">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Surname <span class="required">*</span>
                                                    </label>
                                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                                        <input class="form-control col-md-7 col-xs-12" name="surname" type="text" >
                                                    </div>
                                                </div>

                                                <div class="form-group  ">
                                                    <label  class="col-sm-3 control-label">Gender</label>
                                                    <div class="col-md-6">

                                                        <select class="form-control"
                                                                name="gender">
                                                            @foreach($gendercon as $val)
                                                                <option value='{{$val->item_num}}'> {{$val->value}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group  ">
                                                    <label  class="col-sm-3 control-label">Title</label>
                                                    <div class="col-md-6">

                                                        <select class="form-control"
                                                                name="u_title">
                                                            @foreach($titlecons as $val)
                                                                    <option value='{{$val->item_num}}'> {{$val->value}}</option>
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

                                                                    <option value='{{$val->item_num}}'> {{$val->value}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                {{ Form::bsText('institution','Institution')}}
                                                {{ Form::bsText('faculty','Faculty')}}
                                                {{ Form::bsText('department','Department')}}
                                                {{ Form::bsText('email','E-mail')}}
                                                {{ Form::bsText('iletisim','Mobile / GSM')}}

                                                <div class="form-group">
                                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Password <span class="required">*</span>
                                                    </label>
                                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                                        <input class="form-control col-md-7 col-xs-12 valid" name="password" type="text" aria-invalid="false" required>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Yetki *:
                                                    </label>
                                                    <div class="col-sm-6">
                                                        <select name="yetki" class="form-control" required>
                                                            <option value='0'></option>
                                                            @foreach($yetkicons as $val)
                                                                <option value='{{$val->item_num}}'> {{$val->value}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-md-12 col-sm-12 col-xs-12">Address
                                                        :</label>
                                                    <div class="col-md-12 col-sm-12 col-xs-12">

                                                    <textarea id="editor" name="address"
                                                              class="form-control ck-editor__editable ck-editor__editable_inline ckeditor"
                                                              rows="2">{{Auth::user()->address}}
                                                        </textarea>
                                                    </div>
                                                </div>


                                            </div>
                                        </div>
                                        <div class="ln_solid"></div>
                                        <div class="form-group">
                                            <div class="col-md-12 col-sm-12 col-xs-12 col-md-offset-3">
                                                <button class="col-md-6 col-sm-6 col-xs-12 btn btn-success"
                                                        type="submit">Save
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
            min-height: 100px;
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
                            location.reload();
                        }
                    );
                },
            })

        })
    </script>
@endsection