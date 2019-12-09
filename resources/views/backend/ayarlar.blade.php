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
                                View Profile
                            </h3>
                        </div>
                    </div>
                    <div class="kt-portlet__body">
                        <div class="kt-section">

                            <div class="kt-section__content">


                                <form method="post" id="demo-form2" data-parsley-validate
                                      class="form-horizontal form-label-left">
                                    {{csrf_field()}}
                                    <div class="x_panel">
                                        <div class="x_content">
                                            @if(Auth::user()->logo!=NULL)
                                                <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                                    <img style="width: 100px;height: 100px;"
                                                         src="{{url('/')}}/uploads/img/{{Auth::user()->logo}}" class="avatar"
                                                         alt="Avatar">
                                                </div>
                                            @endif
                                            <div class="form-group row">
                                                <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                                    <input type="hidden" name="logo" class="btn btn-success"></input>
                                                    <input type="hidden" name="eski_logo"
                                                           value="{{Auth::user()->logo}}">
                                                </div>
                                            </div>
                                            {{ Form::bsText('name','Name', Auth::user()->name)}}
                                            {{ Form::bsText('surname','Surname', Auth::user()->surname)}}


                                            <div class="form-group row  ">
                                                <label class="col-sm-3 control-label">Title</label>
                                                <div class="col-md-6">

                                                    <select class="form-control"
                                                            name="u_title">
                                                        @foreach($titlecons as $val)
                                                            @if ( $val->item_num == Auth::user()->u_title)
                                                                <option value='{{$val->item_num}}'
                                                                        selected> {{$val->value}}</option>
                                                            @else
                                                                <option value='{{$val->item_num}}'> {{$val->value}}</option>
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group row ">
                                                <label class="col-sm-3 control-label">Type</label>
                                                <div class="col-md-6">

                                                    <select class="form-control"
                                                            name="u_type">
                                                        @foreach($materialcon as $val)
                                                            @if ( $val->item_num == Auth::user()->f_malzeme_turu)
                                                                <option value='{{$val->item_num}}'
                                                                        selected> {{$val->value}}</option>
                                                            @else
                                                                <option value='{{$val->item_num}}'> {{$val->value}}</option>
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            {{ Form::bsText('institution','Institution',Auth::user()->institution)}}
                                            {{ Form::bsText('faculty','Faculty',Auth::user()->faculty)}}
                                            {{ Form::bsText('department','Department',Auth::user()->department)}}
                                            {{ Form::bsText('email','E-mail',Auth::user()->email)}}
                                            {{ Form::bsText('iletisim','Mobile / GSM',Auth::user()->iletisim)}}


                                            <div class="form-group row">

                                                    <label for="current-password" class="col-sm-3 control-label">Current password</label>
                                                    <div class="col-sm-9">
                                                        <div class="form-group ">
                                                            <input type="password" class="form-control"
                                                                   id="current-password" name="current-password">
                                                        </div>
                                                    </div>

                                            </div><div class="form-group row">
                                                    <label for="password" class="col-sm-3 control-label">New password</label>
                                                    <div class="col-sm-9">
                                                        <div class="form-group ">
                                                            <input type="password" class="form-control"
                                                                   id="password" name="password">
                                                        </div>
                                                    </div>

                                                </div><div class="form-group row">
                                                    <label for="password_confirmation"
                                                           class="col-sm-3 control-label">New Password (Repeat)</label>
                                                    <div class="col-sm-9">
                                                        <div class="form-group ">
                                                            <input type="password" class="form-control"
                                                                   id="password_confirmation"
                                                                   name="password_confirmation">
                                                        </div>
                                                    </div>

                                            </div>
                                            <div class="form-group row">
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
                                    <div class="form-group row">
                                        <div class="col-md-12 col-sm-12 col-xs-12 col-md-offset-3">
                                            <button class="col-12 btn btn-success"
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
        </div>
    </div>
    <!-- page content -->
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
