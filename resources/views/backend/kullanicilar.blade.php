@extends('backend.app')

@section('content')
    <!-- page content -->
    <div class="right_col" role="main">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>USERS</h2>
                        <h2 class="nav navbar-right panel_toolbox"><?php echo "[" . date("Y-m-d") . "]";?></h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <table id="table" class="table">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>name</th>
                                <th>surname</th>
                                <th>gender</th>
                                <th>status</th>
                                <th>email</th>
                                <th>yetki</th>
                                <th>işlem</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($kullanicilar as $kullanici)
                                <tr>
                                    <th scope="row">{{$kullanici->id}}</th>
                                    <td>{{$kullanici->name}}</td>
                                    <td>{{$kullanici->surname}}</td>
                                    <td>{{$kullanici->gender}}</td>
                                    <td>{{$kullanici->status}}</td>
                                    <td>{{$kullanici->email}}</td>
                                    <td>{{$kullanici->yetki}}</td>
                                    <td>
                                        <a href="{{url('/user/')}}/user/user-edit/{{$kullanici->slug}}"
                                           class="btn btn-primary btn-xs">Düzenle</a>
                                        <form method="post" id="demo-form2" data-parsley-validate
                                              class="form-horizontal form-label-left">
                                            {{csrf_field()}}
                                            <input type="text" hidden name="id" value="{{$kullanici->id}}">
                                            <button type="submit"
                                                    class="btn btn-danger btn-xs">sil
                                            </button>
                                        </form>
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
                    }).then(function () {
                            location.replace('//kullanici/kullanicilar/');
                        }
                    );
                },
            });
        })
    </script>
@endsection