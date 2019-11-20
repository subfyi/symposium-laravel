@extends('cms.app')

@section('content')
    @php
        $sayi=0;
    @endphp
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
                                Geri Bildirim Cevapla
                            </h3>
                        </div>
                    </div>
                    <div class="kt-portlet__body">
                        <div class="kt-section">

                            <div class="kt-section__content">


                                <div class="right_col" role="main">
                                    <div class="">
                                        <div class="row">
                                            <div class="">

                                                <div class="col-md-12 col-sm-12 col-xs-12">
                                                    <div class="x_panel">


                                                        <div class="x_content">
                                                            <div class="" role="tabpanel" data-example-id="togglable-tabs">
                                                                <form method="post" id="form" data-parsley-validate
                                                                      class="form-horizontal form-label-left" enctype="multipart/form-data">
                                                                    {{csrf_field()}}
                                                                    <div class="x_panel">
                                                                        <div class="x_content">
                                                                            <div class="row">

                                                                                @if($gorevicerik!=NULL)
                                                                                    <div class="form-group">


                                                                                        <div style="display: block" class="form-group">
                                                                                            <label class="control-label col-md-12 col-sm-12 col-xs-12"
                                                                                                   for="first-name">*Drive'a gönderilen dosyalar
                                                                                                localden
                                                                                                silinecektir ama Drive taradından
                                                                                                indirilebilecektir.
                                                                                            </label>
                                                                                        </div>
                                                                                        <table class="table table-striped">
                                                                                            <thead>
                                                                                            <tr>
                                                                                                <th>Sahibi</th>
                                                                                                <th>Olştrulma</th>
                                                                                                <th>Geçen</th>
                                                                                                <th style="width: 80%">İş Detayları :</th>
                                                                                                <th>İşlem</th>
                                                                                            </tr>
                                                                                            </thead>
                                                                                            <tbody>
                                                                                            @foreach($gorevicerik->where('ust_icerik', '0') as $yorum)
                                                                                                <tr>
                                                                                                    <td>{{$yorum->user->name}}</td>
                                                                                                    <td>{{$yorum->created_at->formatLocalized('%d-%m-%y, %I:%M')}}</td>

                                                                                                    @php($zaman=$yorum->created_at)
                                                                                                    @php($zaman->setLocale('tr'))
                                                                                                    <td>{{$zaman->diffForHumans()}}</td>
                                                                                                    <td><?php echo html_entity_decode($yorum->isicerik); ?>
                                                                                                        @if($yorum->dosyaisimleri!=NULL)
                                                                                                            <ul class="list-group list-group-flush">
                                                                                                                <?php
                                                                                                                $dosyaisim = explode("|", $yorum->dosyaisimleri);
                                                                                                                $dosyaisim_r = explode("|", $yorum->r_dosyaisimleri);
                                                                                                                ?>
                                                                                                                @foreach (array_combine($dosyaisim, $dosyaisim_r) as $i => $j)
                                                                                                                    <?php
                                                                                                                    $dosyauzanti = explode('/', Request::url());
                                                                                                                    $dosyauzanti = $dosyauzanti[count($dosyauzanti) - 1];
                                                                                                                    ?>
                                                                                                                    <li class="list-group-item">
                                                                                                                        {{$j}} -->
                                                                                                                        @if(file_exists( public_path().'/uploads/dosya/'.$dosyauzanti.'/'.$i ))
                                                                                                                            @if($yorum->grv_icerik_olusturan == \Illuminate\Support\Facades\Auth::user()->id)
                                                                                                                                <a class="btn btn-info btn-xs"
                                                                                                                                   onclick="dosyasil('{{$yorum->id."|".$i."|".$j."|".$dosyauzanti}}');">Sil</a>
                                                                                                                                <a class="btn btn-warning btn-xs"
                                                                                                                                   onclick="driveDosyaGgonder('{{$yorum->id."|".$i."|".$j."|".$dosyauzanti}}')">DriveGönder</a>

                                                                                                                            @endif
                                                                                                                            <a
                                                                                                                                    class="btn btn-dark btn-xs"
                                                                                                                                    href="{{url('/')}}/uploads/dosya/{{$dosyauzanti.'/'.$i}}"
                                                                                                                            >Local
                                                                                                                                İndir</a>
                                                                                                                        @endif
                                                                                                                    </li>
                                                                                                                @endforeach
                                                                                                            </ul>
                                                                                                        @endif

                                                                                                        @if($yorum->gdosyaisimleri!=NULL)
                                                                                                            <ul class="list-group list-group-flush">
                                                                                                                <?php
                                                                                                                $dosyaisim = explode("|", $yorum->gdosyaisimleri);
                                                                                                                $dosyaisim_r = explode("|", $yorum->r_gdosyaisimleri);
                                                                                                                ?>
                                                                                                                @foreach (array_combine($dosyaisim, $dosyaisim_r) as $i => $j)
                                                                                                                    <?php
                                                                                                                    $dosyauzanti = explode('/', Request::url());
                                                                                                                    $dosyauzanti = $dosyauzanti[count($dosyauzanti) - 1];
                                                                                                                    ?>
                                                                                                                    <li class="list-group-item">
                                                                                                                        {{$j}} -->
                                                                                                                        @if($yorum->grv_icerik_olusturan == \Illuminate\Support\Facades\Auth::user()->id)

                                                                                                                            <a class="btn btn-info btn-xs"
                                                                                                                               onclick="drivedosyasil('{{$yorum->id."|".$i."|".$j."|".$dosyauzanti}}');">Drive
                                                                                                                                Sil</a>
                                                                                                                        @endif <a
                                                                                                                                class="btn btn-dark btn-xs"
                                                                                                                                href="{{url('/')}}/gsuitedrive/{{$dosyauzanti}}/{{$j}}"
                                                                                                                                onclick="window.open(this.href); return false;"
                                                                                                                                onkeypress="window.open(this.href); return false;">Drive
                                                                                                                            İndir</a>
                                                                                                                    </li>
                                                                                                                @endforeach
                                                                                                            </ul>
                                                                                                        @endif
                                                                                                    </td>
                                                                                                    <td>
                                                                                                    <!-- <a onclick="altyorum({{$yorum->id}})">Cevap</a> <i class="fa fa-reply"></i> -->
                                                                                                        @if($yorum->grv_icerik_olusturan == \Illuminate\Support\Facades\Auth::user()->id)
                                                                                                            <a class="btn btn-danger"
                                                                                                               onclick="isicerikduzenle(this, '{{$yorum->isicerik}}', '{{$yorum->id}}');">Düzenle</a>
                                                                                                        @else
                                                                                                            <a class="btn btn-warning"
                                                                                                               id="isicerikkopyala"
                                                                                                               onclick="isicerikkopyala('{{$yorum->isicerik}}');">Kopyala</a>
                                                                                                        @endif </td>
                                                                                                </tr>
                                                                                                @foreach($yorum->children as $altyorum)

                                                                                                    <tr>
                                                                                                        <td>{{$altyorum->user->name}}</td>
                                                                                                        <td>{{$altyorum->created_at->formatLocalized('%d-%m-%y, %I:%M')}}</td>

                                                                                                        @php($zaman=$altyorum->created_at)
                                                                                                        @php($zaman->setLocale('tr'))
                                                                                                        <td>{{$zaman->diffForHumans()}}</td>
                                                                                                        <td><?php echo html_entity_decode($altyorum->isicerik); ?>
                                                                                                            @if($altyorum->dosyaisimleri!=NULL)
                                                                                                                <ul class="list-group list-group-flush">
                                                                                                                    <?php
                                                                                                                    $dosyaisim = explode("|", $altyorum->dosyaisimleri);
                                                                                                                    $dosyaisim_r = explode("|", $altyorum->r_dosyaisimleri);
                                                                                                                    ?>
                                                                                                                    @foreach (array_combine($dosyaisim, $dosyaisim_r) as $i => $j)
                                                                                                                        <?php
                                                                                                                        $dosyauzanti = explode('/', Request::url());
                                                                                                                        $dosyauzanti = $dosyauzanti[count($dosyauzanti) - 1];
                                                                                                                        ?>
                                                                                                                        <li class="list-group-item">
                                                                                                                            {{$j}} -->
                                                                                                                            @if(file_exists( public_path().'/uploads/dosya/'.$dosyauzanti.'/'.$i ))
                                                                                                                                @if($altyorum->grv_icerik_olusturan == \Illuminate\Support\Facades\Auth::user()->id)
                                                                                                                                    <a class="btn btn-info btn-xs"
                                                                                                                                       onclick="dosyasil('{{$altyorum->id."|".$i."|".$j."|".$dosyauzanti}}');">Sil</a>
                                                                                                                                    <a class="btn btn-warning btn-xs"
                                                                                                                                       onclick="driveDosyaGgonder('{{$altyorum->id."|".$i."|".$j."|".$dosyauzanti}}')">DriveGönder</a>

                                                                                                                                @endif
                                                                                                                                <a
                                                                                                                                        class="btn btn-dark btn-xs"
                                                                                                                                        href="{{url('/')}}/uploads/dosya/{{$dosyauzanti.'/'.$i}}"
                                                                                                                                >Local
                                                                                                                                    İndir</a>
                                                                                                                            @endif
                                                                                                                        </li>
                                                                                                                    @endforeach
                                                                                                                </ul>
                                                                                                            @endif

                                                                                                            @if($yorum->gdosyaisimleri!=NULL)
                                                                                                                <ul class="list-group list-group-flush">
                                                                                                                    <?php
                                                                                                                    $dosyaisim = explode("|", $yorum->gdosyaisimleri);
                                                                                                                    $dosyaisim_r = explode("|", $yorum->r_gdosyaisimleri);
                                                                                                                    ?>
                                                                                                                    @foreach (array_combine($dosyaisim, $dosyaisim_r) as $i => $j)
                                                                                                                        <?php
                                                                                                                        $dosyauzanti = explode('/', Request::url());
                                                                                                                        $dosyauzanti = $dosyauzanti[count($dosyauzanti) - 1];
                                                                                                                        ?>
                                                                                                                        <li class="list-group-item">
                                                                                                                            {{$j}} -->
                                                                                                                            @if($altyorum->grv_icerik_olusturan == \Illuminate\Support\Facades\Auth::user()->id)

                                                                                                                                <a class="btn btn-info btn-xs"
                                                                                                                                   onclick="drivedosyasil('{{$altyorum->id."|".$i."|".$j."|".$dosyauzanti}}');">Drive
                                                                                                                                    Sil</a>
                                                                                                                            @endif
                                                                                                                            <a
                                                                                                                                    class="btn btn-dark btn-xs"
                                                                                                                                    href="{{url('/')}}/gsuitedrive/{{$i.",".$dosyauzanti}}"
                                                                                                                                    onclick="window.open(this.href); return false;"
                                                                                                                                    onkeypress="window.open(this.href); return false;">Drive
                                                                                                                                İndir</a>
                                                                                                                        </li>
                                                                                                                    @endforeach
                                                                                                                </ul>
                                                                                                            @endif
                                                                                                        </td>
                                                                                                        <td>
                                                                                                        <!-- <a onclick="altyorum({{$yorum->id}})">Cevap</a> <i class="fa fa-reply"></i> -->
                                                                                                            @if($altyorum->grv_icerik_olusturan == \Illuminate\Support\Facades\Auth::user()->id)
                                                                                                                <a class="btn btn-danger"
                                                                                                                   onclick="isicerikduzenle(this, '{{$altyorum->isicerik}}', '{{$altyorum->id}}');">Düzenle</a>
                                                                                                            @else
                                                                                                                <a class="btn btn-warning"
                                                                                                                   id="isicerikkopyala"
                                                                                                                   onclick="isicerikkopyala('{{$altyorum->isicerik}}');">Kopyala</a>
                                                                                                            @endif </td>
                                                                                                    </tr>
                                                                                                @endforeach
                                                                                            @endforeach
                                                                                            </tbody>
                                                                                        </table>

                                                                                    </div>

                                                                                @endif
                                                                                <div class="ln_solid"></div>

                                                                            </div>

                                                                            <div class="row">
                                                                                <div class="col-md-12 col-sm-12 col-xs-12">
                                                                                    <div class=" x_panel">
                                                                                        <div class="x_title">
                                                                                            <h2>Geri Bildirim Ekleme</h2>
                                                                                            <div class="clearfix"></div>
                                                                                        </div>
                                                                                        <div class="x_content">

                                                                                            <div class="col-md-12 col-sm-12 col-xs-12">


                                                                                                <div class="form-group">
                                                                                                    <label class="control-label col-md-3 col-sm-3 col-xs-12"
                                                                                                           for="first-name">Geri Bildirim Yapan Kişi * :
                                                                                                    </label>
                                                                                                    <div class="col-md-9 col-sm-6 col-xs-12">
                                                                                                        <input class="form-control col-md-7 col-xs-12"
                                                                                                               required="required" name="grv_baslik"
                                                                                                               type="text"
                                                                                                               value="{{$gorevler->user->name}}"
                                                                                                               readonly disabled>
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div style="display: none" class="form-group">

                                                                                                    <label class="col-md-3 col-sm-3 col-xs-12">Dosya
                                                                                                        Kayıt
                                                                                                        Yeri
                                                                                                    </label>
                                                                                                    <div class="col-sm-9">
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
                                                                                                    <label class="col-md-12 col-sm-12 col-xs-12">Dosya
                                                                                                        Ekle :</label>
                                                                                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                                                                                        <input type="file" name="dosyalar[]"
                                                                                                               class="form-control"
                                                                                                               multiple>
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div id="altyorum"></div>
                                                                                                <div id="yorumid"></div>
                                                                                                <div class="form-group">
                                                                                                    <label class="col-md-12 col-sm-12 col-xs-12">Detay
                                                                                                        Ekle :</label>
                                                                                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                                        <textarea id="editor" name="isicerik"
                                                                  class="form-control ck-editor__editable ck-editor__editable_inline ckeditor"
                                                                  rows="3">
                                                        </textarea>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>

                                                                                        </div>
                                                                                    </div>
                                                                                </div>

                                                                            </div>
                                                                        </div>
                                                                    </div>


                                                                    <div class="ln_solid"></div>
                                                                    <div class="form-group">
                                                                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                                                            <input type="hidden" name="sayi" value="{{$sayi}}">
                                                                            <button type="submit" class="col-md-12 btn btn-success">Kaydet</button>
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


    <script src="{{url('/')}}/js/driveSize.js"></script>

    <script src="{{url('/')}}/js/jquery.form.min.js"></script>
    <script src="{{url('/')}}/js/jquery.validate.min.js"></script>
    <script src="{{url('/')}}/js/messages_tr.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    <script src="https://cdn.ckeditor.com/ckeditor5/10.0.1/classic/ckeditor.js"></script>

    <script src="https://unpkg.com/pdfjs-dist@2.0.943/build/pdf.js"></script>
    <script src="{{url('/')}}/js/pdfThumbnails.js"></script>
    <script src="{{url('/')}}/js/tiff.min.js"></script>
    <script src="{{url('/')}}/js/tiffthumb.js"></script>
    <script src="{{url('/')}}/js/drivethumb.js"></script>
    <script type="text/javascript">

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


        function isicerikduzenle(r, text, id) {
            var sira = r.parentNode.parentNode.rowIndex;

            document.getElementById('yorumid').innerHTML = '<input type="hidden" name="yorumid" value="' + id + '">';

            ClassicEditor
            myEditor.setData(text);
        }

        function isicerikkopyala(text) {
            ClassicEditor
            myEditor.setData(text);

            document.getElementById('yorumid').innerHTML = '<input type="hidden" name="yorumid" value="">';

        }

        function altyorum(id) {
            document.getElementById('altyorum').innerHTML = '<input type="hidden" name="ust_icerik" value="' + id + '">';
        }

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
                            location.reload();
                        }
                    );
                },
            });

        });


        function driveDosyaGgonder(file) {
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            $.ajaxSetup({
                headers: {
                    '_token': CSRF_TOKEN,
                    'X-CSRF-TOKEN': CSRF_TOKEN
                }
            });

            $.ajax({
                type: 'POST',
                url: '/dosya-drive-gonder',
                data: {file: file},
                xhr: function () {
                    var xhr = new window.XMLHttpRequest();
                    xhr.upload.addEventListener("progress", function (evt) {
                        if (evt.lengthComputable) {
                            swal({
                                title: ' Yükleniyor',
                                text: ' Lütfen Bekleyiniz..',
                                icon: 'info',
                            })
                        }
                    }, false);
                    return xhr;
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
            });
        }

        function drivedosyasil(file) {
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            $.ajaxSetup({
                headers: {
                    '_token': CSRF_TOKEN,
                    'X-CSRF-TOKEN': CSRF_TOKEN
                }
            });

            $.ajax({
                type: 'POST',
                url: '/dosya-drive-sil',
                data: {file: file},
                xhr: function () {
                    var xhr = new window.XMLHttpRequest();
                    xhr.upload.addEventListener("progress", function (evt) {
                        if (evt.lengthComputable) {
                            swal({
                                title: ' Yükleniyor',
                                text: ' Lütfen Bekleyiniz..',
                                icon: 'info',
                            })
                        }
                    }, false);
                    return xhr;
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
            });
        }

        function dosyasil(file) {
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            $.ajaxSetup({
                headers: {
                    '_token': CSRF_TOKEN,
                    'X-CSRF-TOKEN': CSRF_TOKEN
                }
            });

            $.ajax({
                type: 'POST',
                url: '/dosya-sil',
                data: {file: file},


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
            });
        }
    </script>


@endsection