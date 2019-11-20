@extends('backend.app')
@section('content')
    <?php
    $sayi = 0;
    $auserid = \Illuminate\Support\Facades\Auth::user()->id;

    $aktif = "block";
    $pasif = "none";
    $renkli = "";
    $trclass = "";
    ?>

    <div class="right_col" role="main">
        <div class="">
            <div class="row">
                <div class="">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="x_panel">
                            <div class="x_title">
                                <h2>Sipariş Düzenle - {{$gorevler->grv_baslik}}</h2>
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
                                                @if(isset($gorevonizfile->slug))
                                                    <div class="row">
                                                        <table class="table table-striped">
                                                            <thead>
                                                            <tr>
                                                                <th>Önizleme Görüntüleri :</th>
                                                            </tr>
                                                            </thead>
                                                        </table>
                                                        @foreach($resimler=Storage::disk('uploads')->files('oniz/'.$gorevonizfile->slug) as $resim)
                                                            <div class="col-md-55">
                                                                <div class="thumbnail">
                                                                    <div class="image view view-first">
                                                                        <img
                                                                                src="{{url('/')}}/uploads/{{$resim}}" alt="image"/>
                                                                    </div>
                                                                    <div class="caption">
                                                                        <p>Önizleme</p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                @endif
                                                <div class="row">
                                                    <div class="form-group">
                                                        <table class="table table-striped">
                                                            <thead>
                                                            <tr>
                                                                <th style="width: 55%">Sipariş Dosyaları :</th>
                                                                <th style="width: 25%">Uygulama</th>
                                                                <th style="width: 20%">Küçük Resim (jpg, png, pdf, gif,
                                                                    WebP)
                                                                </th>
                                                            </tr>
                                                            </thead>
                                                            <tbody>
                                                            @foreach($resimler=Storage::disk('uploads')->files('dosya/'.$gorevler->slug) as $resim)
                                                                @php
                                                                    $resimisim = explode('/',$resim);
                                                                    $resimisim = $resimisim[count($resimisim) - 1];
                                                                $dosyaisim99 = "";
                                                                @endphp
                                                                @foreach($gorevicerik as $yorum)
                                                                    @if($yorum!=NULL )
                                                                        @php
                                                                            $dosyaisim99=$yorum->dosyaisimleri.'|'.$dosyaisim99;
                                                                        @endphp
                                                                    @endif
                                                                @endforeach
                                                                @foreach($gorevfiles as $yorum)
                                                                    @if($yorum!=NULL )
                                                                        @php
                                                                            $dosyaisim99=$yorum->f_dosyaisimi.'|'.$dosyaisim99;
                                                                        @endphp
                                                                    @endif
                                                                @endforeach
                                                                @php
                                                                    $dosyaisim = explode("|", $dosyaisim99);
                                                                @endphp
                                                                @if (!in_array($resimisim, $dosyaisim))
                                                                    <?php
                                                                    $bytes = Storage::disk('uploads')->size($resim);
                                                                    $decimals = 1;
                                                                    $size = array('B', 'kB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB');
                                                                    $factor = floor((strlen($bytes) - 1) / 3);
                                                                    $sizer = sprintf("%.{$decimals}f", $bytes / pow(1024, $factor)) . @$size[$factor];

                                                                    $resimuzanti = explode('.', $resimisim);
                                                                    $resimuzanti = $resimuzanti[count($resimuzanti) - 1];
                                                                    ?>
                                                                    <tr>
                                                                        <td>
                                                                            <i class="fa fa-folder-o"></i>
                                                                            <a
                                                                                    class="myFile"
                                                                                    target="_blank"
                                                                                    href="{{url('/')}}/uploads/{{$resim}}">{{$resimisim}}</a>
                                                                            -->
                                                                            <a class="btn btn-warning btn-xs"
                                                                               onclick="fdriveelse_send('{{$gorevler->grv_icerik_yonetici}}','{{$resimuzanti}}','{{$bytes}}','{{$gorevler->slug}}','{{$resim}}')">Drive
                                                                                Gönder</a>
                                                                        </td>
                                                                        <td></td>
                                                                        <td></td>
                                                                        <td></td>
                                                                        <td></td>
                                                                        <td>
                                                                            <label class="col-md-12">Boyut: {{$sizer}}</label>
                                                                            @if(($resimuzanti == 'png' || $resimuzanti == 'PNG' || $resimuzanti == 'jpg'|| $resimuzanti == 'jpeg'|| $resimuzanti == 'JPEG'|| $resimuzanti == 'JPG'|| $resimuzanti == 'gif'|| $resimuzanti == 'GIF' || $resimuzanti == 'WebP' )&& $bytes<200000000  )
                                                                                @php
                                                                                    $resimbase64 = 'data:image/' . 'jpg' . ';base64,' . base64_encode(Image::make(file_get_contents('uploads/'.$resim))->resize(200, 200)->encode('jpg'));
                                                                                @endphp
                                                                                <div class="col-md-12 ">
                                                                            <span class="image view view-first">
                                                                                <a target="_blank"
                                                                                   href="{{url('/')}}/uploads/{{$resim}}">
                                                                                    <img src="{{$resimbase64}}"
                                                                                         alt="image"/> </a>

                                                                            </span></div>
                                                                            @endif
                                                                        </td>
                                                                    </tr>
                                                                @endif
                                                                @php
                                                                    $sayi++
                                                                @endphp
                                                            @endforeach

                                                            <!-- gfiles -->
                                                            @foreach($gorevfiles as $yorum)
                                                                <?php
                                                                if (($yorum->f_malzeme_turu == NULL || $yorum->f_baski_olcusu == NULL || $yorum->f_uygulama == NULL || $yorum->f_adet == NULL) && $yorum->f_icerik_olusturan == $auserid) {
                                                                    $aktif = "none";
                                                                    $pasif = "block";
                                                                    $renkli = "has-warning";
                                                                    $trclass = "danger";
                                                                }

                                                                $dosyauzanti = $yorum->slug;
                                                                $resimuzanti = $yorum->f_dosya_uzanti;
                                                                $resim = 'dosya/' . $dosyauzanti . '/' . $yorum->f_dosyaisimi;

                                                                if ($yorum->f_baski_olcusu == NULL || $yorum->f_baski_olcusu == ' x ' || $yorum->f_baski_olcusu == ' ') {
                                                                    $f_baski_olcusu_w = "";
                                                                    $f_baski_olcusu_h = "";
                                                                } else {
                                                                    $f_baski_olcusu_w = explode(' x ', $yorum->f_baski_olcusu)[0];
                                                                    $f_baski_olcusu_h = explode(' x ', $yorum->f_baski_olcusu)[1];
                                                                }

                                                                if ($yorum->f_urun_olcusu == NULL || $yorum->f_urun_olcusu == ' x ' || $yorum->f_urun_olcusu == ' ') {
                                                                    $f_urun_olcusu_w = "";
                                                                    $f_urun_olcusu_h = "";
                                                                } else {
                                                                    $f_urun_olcusu_w = explode(' x ', $yorum->f_urun_olcusu)[0];
                                                                    $f_urun_olcusu_h = explode(' x ', $yorum->f_urun_olcusu)[1];
                                                                }
                                                                ?>
                                                                @if($yorum->f_dosyayeri == 1)
                                                                    <tr class="{{$trclass}}">

                                                                        <td>
                                                                            <div class="row">
                                                                                <div class="col-md-12">
                                                                                    <p>
                                                                                    <h4><i class="fa fa-folder"></i>
                                                                                        <a href="{{url('/')}}/uploads/{{$resim}}"
                                                                                           onclick="window.open(this.href); return false;"
                                                                                           onkeypress="window.open(this.href); return false;">{{$yorum->r_dosyaisimi}}</a>
                                                                                    </h4>
                                                                                    </p>
                                                                                </div>
                                                                            </div>

                                                                            <div class="ln_solid"></div>

                                                                            <div class="row ">


                                                                                <div class="col-md-6">
                                                                                    <div class="form-group {{$renkli}} ">
                                                                                        <label class="col-md-12">Malzeme
                                                                                            Türü</label>
                                                                                        <div class="col-md-12">

                                                                                            <select class="form-control"
                                                                                                    name="f_malzeme_turu"
                                                                                                    onchange="sf_attr_selec_update(event,'f_malzeme_turu',{{$yorum->id}})" <?php if ((($yorum->f_icerik_olusturan != $auserid) && ($yorum->f_malzeme_turu != "")) && (\Illuminate\Support\Facades\Auth::user()->yetki != 9)) echo "readonly disabled"; ?>>
                                                                                                <option></option>
                                                                                                @foreach($materialcon as $val)
                                                                                                    @if ( $val->item_num == $yorum->f_malzeme_turu)
                                                                                                        <option value='{{$val->item_num}}'
                                                                                                                selected> {{$val->value}}</option>
                                                                                                    @else
                                                                                                        <option value='{{$val->item_num}}'> {{$val->value}}</option>
                                                                                                    @endif
                                                                                                @endforeach
                                                                                            </select>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="form-group {{$renkli}}">
                                                                                        <label class="col-md-12">Adet</label>
                                                                                        <div class="col-md-12">
                                                                                            <input class="form-control col-md-12 col-xs-12"
                                                                                                   name="f_adet"
                                                                                                   type="number"
                                                                                                   data-itemID="f_adet_{{$yorum->id}}"
                                                                                                   value="{{$yorum->f_adet}}"
                                                                                                   onkeyup="sf_attribute_update('f_adet',{{$yorum->id}})"
                                                                                                   <?php if ((($yorum->f_icerik_olusturan != $auserid) && ($yorum->f_adet != "")) && (\Illuminate\Support\Facades\Auth::user()->yetki != 9)) echo "readonly disabled"; ?>
                                                                                                   required>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-md-6">
                                                                                    <div class="form-group {{$renkli}}">
                                                                                        <label class="col-md-12">Baskı
                                                                                            Ölçüsü</label>
                                                                                        <div class="col-md-6">

                                                                                            <input class="form-control col-md-12 col-xs-12"
                                                                                                   name="f_baski_olcusu_w"
                                                                                                   type="number"
                                                                                                   data-itemID="f_baski_olcusu_w_{{$yorum->id}}"
                                                                                                   value="{{$f_baski_olcusu_w}}"
                                                                                                   onkeyup="isf_attribute_update('f_baski_olcusu','w',{{$yorum->id}})" <?php if (($yorum->f_icerik_olusturan != $auserid && $yorum->f_baski_olcusu != "") && (\Illuminate\Support\Facades\Auth::user()->yetki != 9)) echo "readonly disabled"; ?> >
                                                                                        </div>

                                                                                        <div class="col-md-6">
                                                                                            <input class="form-control col-md-12 col-xs-12"
                                                                                                   name="f_baski_olcusu_h"
                                                                                                   type="number"
                                                                                                   data-itemID="f_baski_olcusu_h_{{$yorum->id}}"
                                                                                                   value="{{$f_baski_olcusu_h}}"
                                                                                                   onkeyup="isf_attribute_update('f_baski_olcusu','h',{{$yorum->id}})" <?php if (($yorum->f_icerik_olusturan != $auserid && $yorum->f_baski_olcusu != "") && (\Illuminate\Support\Facades\Auth::user()->yetki != 9)) echo "readonly disabled"; ?> >
                                                                                        </div>

                                                                                        <div style="display: none">
                                                                                            <select class="form-control"
                                                                                                    name="f_baski_olcusu_b"
                                                                                                    onchange="sf_attr_selec_update(event,'f_baski_olcusu_b',{{$yorum->id}})" <?php if ((($yorum->f_icerik_olusturan != $auserid) && ($yorum->f_baski_olcusu_b != "")) && (\Illuminate\Support\Facades\Auth::user()->yetki != 9)) echo "readonly disabled"; ?>>
                                                                                                <option></option>
                                                                                                @foreach($birimcon as $val)
                                                                                                    @if ( $val->item_num == $yorum->f_baski_olcusu_b)
                                                                                                        <option value='{{$val->item_num}}'
                                                                                                                selected> {{$val->value}}</option>
                                                                                                    @else
                                                                                                        <option value='{{$val->item_num}}'> {{$val->value}}</option>
                                                                                                    @endif
                                                                                                @endforeach
                                                                                            </select>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="form-group {{$renkli}}">
                                                                                        <label class="col-md-12">Ürün
                                                                                            Ölçüsü</label>
                                                                                        <div class="col-md-6">
                                                                                            <input class="form-control col-md-12 col-xs-12"
                                                                                                   name="f_urun_olcusu_w"
                                                                                                   type="number"
                                                                                                   data-itemID="f_urun_olcusu_w_{{$yorum->id}}"
                                                                                                   value="{{$f_urun_olcusu_w}}"
                                                                                                   onkeyup="isf_attribute_update('f_urun_olcusu','w',{{$yorum->id}})" <?php if (($yorum->f_icerik_olusturan != $auserid && $yorum->f_urun_olcusu != "") && (\Illuminate\Support\Facades\Auth::user()->yetki != 9)) echo "readonly disabled"; ?> >
                                                                                        </div>

                                                                                        <div class="col-md-6">
                                                                                            <input class="form-control col-md-12 col-xs-12"
                                                                                                   name="f_urun_olcusu_h"
                                                                                                   type="number"
                                                                                                   data-itemID="f_urun_olcusu_h_{{$yorum->id}}"
                                                                                                   value="{{$f_urun_olcusu_h}}"
                                                                                                   onkeyup="isf_attribute_update('f_urun_olcusu','h',{{$yorum->id}})" <?php if (($yorum->f_icerik_olusturan != $auserid && $yorum->f_urun_olcusu != "") && (\Illuminate\Support\Facades\Auth::user()->yetki != 9)) echo "readonly disabled"; ?> >
                                                                                        </div>
                                                                                        <div style="display: none">

                                                                                            <select class="form-control"
                                                                                                    name="f_urun_olcusu_b"
                                                                                                    onchange="sf_attr_selec_update(event,'f_urun_olcusu_b',{{$yorum->id}})" <?php if ((($yorum->f_icerik_olusturan != $auserid) && ($yorum->f_urun_olcusu_b != "")) && (\Illuminate\Support\Facades\Auth::user()->yetki != 9)) echo "readonly disabled"; ?>>
                                                                                                <option></option>
                                                                                                @foreach($birimcon as $val)
                                                                                                    @if ( $val->item_num == $yorum->f_urun_olcusu_b)
                                                                                                        <option value='{{$val->item_num}}'
                                                                                                                selected> {{$val->value}}</option>
                                                                                                    @else
                                                                                                        <option value='{{$val->item_num}}'> {{$val->value}}</option>
                                                                                                    @endif
                                                                                                @endforeach
                                                                                            </select>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </td>

                                                                        <td>
                                                                            <div class="checkbox form-group {{$renkli}}">
                                                                                <?php
                                                                                $uyglam = explode('|', $yorum->f_uygulama);
                                                                                ?>
                                                                                @foreach($uygulamacon as $uyval)
                                                                                    <?php
                                                                                    if (in_array($uyval->id, $uyglam)) {
                                                                                        $ychecked = 'checked="checked"';
                                                                                    } else {
                                                                                        $ychecked = '';
                                                                                    }
                                                                                    ?>
                                                                                    <label class="col-md-6"
                                                                                           style=" margin-bottom: 5px; float: left; ">
                                                                                        <input type='checkbox'
                                                                                               value='{{$uyval->id}}'
                                                                                               {{$ychecked}}
                                                                                               name='f_uygulama_{{$yorum->id}}_{{$uyval->id}}'
                                                                                               onchange="sfc_attribute_update('f_uygulama',{{$yorum->id.','.$uyval->id}})"> {{$uyval->value}}
                                                                                    </label>
                                                                                @endforeach

                                                                            </div>
                                                                        </td>

                                                                        <td>

                                                                            <div class="form-group">
                                                                                <div class="col-md-12">
                                                                                    <?php
                                                                                    if ($yorum->f_dosya_boyut == 0) {
                                                                                        $bytes = Storage::disk('uploads')->size($resim);
                                                                                    } else {
                                                                                        $bytes = $yorum->f_dosya_boyut;
                                                                                    }
                                                                                    $decimals = 1;
                                                                                    $size = array('B', 'kB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB');
                                                                                    $factor = floor((strlen($bytes) - 1) / 3);
                                                                                    $sizer = sprintf("%.{$decimals}f", $bytes / pow(1024, $factor)) . @$size[$factor];
                                                                                    ?>
                                                                                    @if(($resimuzanti == 'png' || $resimuzanti == 'PNG' || $resimuzanti == 'jpg'|| $resimuzanti == 'jpeg'|| $resimuzanti == 'JPEG'|| $resimuzanti == 'JPG'|| $resimuzanti == 'gif'|| $resimuzanti == 'GIF' || $resimuzanti == 'WebP' )&& $bytes<200000000  )
                                                                                        @php
                                                                                            if(file_exists( public_path().'/uploads/'.$resim )){
                                                                                                $resimbase64 = 'data:image/' . 'jpg' . ';base64,' . base64_encode(Image::make(file_get_contents('uploads/'.$resim))->resize(200, 200)->encode('jpg'));
                                                                                            }else{
                                                                                                $resimbase64 = "";
                                                                                            }
                                                                                        @endphp
                                                                                        <div class="col-md-12 ">
                                                                            <span class="image view view-first">
                                                                                <a target="_blank"
                                                                                   href="{{url('/')}}/uploads/{{$resim}}">
                                                                                    <img
                                                                                            src="{{$resimbase64}}"
                                                                                            alt="image"/> </a>
                                                                            </span></div>
                                                                                    @endif

                                                                                </div>
                                                                            </div>

                                                                            <div class="form-group">
                                                                                <div class="col-md-12">
                                                                                    <label class="col-md-12">Boyut: {{$sizer}}</label>
                                                                                </div>
                                                                            </div>

                                                                        </td>
                                                                    </tr>
                                                                @elseif($yorum->f_dosyayeri == 2)
                                                                    <?php
                                                                    $i = $yorum->f_dosyaisimi;
                                                                    $j = $yorum->r_dosyaisimi;
                                                                    ?>
                                                                    <tr class="{{$trclass}}">
                                                                        <td>
                                                                            <div class="row">
                                                                                <div class="col-md-12">
                                                                                    <p>
                                                                                    <h4>
                                                                                        <i class="fa fa-google-plus-square"></i>
                                                                                        <a href="{{url('/')}}/gsuitedrive/{{$dosyauzanti}}/{{$i}}"
                                                                                           onclick="window.open(this.href); return false;"
                                                                                           onkeypress="window.open(this.href); return false;">{{$j}}</a>
                                                                                    </h4>
                                                                                    </p>
                                                                                </div>
                                                                            </div>

                                                                            <div class="ln_solid"></div>

                                                                            <div class="row ">

                                                                                <div class="col-md-6">
                                                                                    <div class="form-group {{$renkli}}">
                                                                                        <label class="col-md-12">Malzeme
                                                                                            Türü</label>
                                                                                        <div class="col-md-12">

                                                                                            <select class="form-control col-md-12"
                                                                                                    name="f_malzeme_turu"
                                                                                                    onchange="sf_attr_selec_update(event,'f_malzeme_turu',{{$yorum->id}})" <?php if ((($yorum->f_icerik_olusturan != $auserid) && ($yorum->f_malzeme_turu != "")) && (\Illuminate\Support\Facades\Auth::user()->yetki != 9)) echo "readonly disabled"; ?>
                                                                                            >
                                                                                                <option></option>
                                                                                                @foreach($materialcon as $val)
                                                                                                    @if ( $val->item_num == $yorum->f_malzeme_turu)
                                                                                                        <option value='{{$val->item_num}}'
                                                                                                                selected> {{$val->value}}</option>
                                                                                                    @else
                                                                                                        <option value='{{$val->item_num}}'> {{$val->value}}</option>
                                                                                                    @endif
                                                                                                @endforeach
                                                                                            </select>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="form-group {{$renkli}}">
                                                                                        <label class="col-md-12">Adet</label>
                                                                                        <div class="col-md-12">
                                                                                            <input class="form-control col-md-12 col-xs-12"
                                                                                                   name="f_adet"
                                                                                                   type="number"
                                                                                                   data-itemID="f_adet_{{$yorum->id}}"
                                                                                                   value="{{$yorum->f_adet}}"
                                                                                                   onkeyup="sf_attribute_update('f_adet',{{$yorum->id}})"
                                                                                            <?php if ((($yorum->f_icerik_olusturan != $auserid) && ($yorum->f_adet != "")) && (\Illuminate\Support\Facades\Auth::user()->yetki != 9)) echo "readonly disabled"; ?> >
                                                                                        </div>
                                                                                    </div>
                                                                                </div>

                                                                                <div class="col-md-6">
                                                                                    <div class="form-group {{$renkli}}">
                                                                                        <label class="col-md-12">Baskı
                                                                                            Ölçüsü</label>
                                                                                        <div class="col-md-6">

                                                                                            <input class="form-control col-md-12 col-xs-12"
                                                                                                   name="f_baski_olcusu_w"
                                                                                                   type="number"
                                                                                                   data-itemID="f_baski_olcusu_w_{{$yorum->id}}"
                                                                                                   value="{{$f_baski_olcusu_w}}"
                                                                                                   onkeyup="isf_attribute_update('f_baski_olcusu','w',{{$yorum->id}})" <?php if (($yorum->f_icerik_olusturan != $auserid && $yorum->f_baski_olcusu != "") && (\Illuminate\Support\Facades\Auth::user()->yetki != 9)) echo "readonly disabled"; ?> >
                                                                                        </div>

                                                                                        <div class="col-md-6">
                                                                                            <input class="form-control col-md-12 col-xs-12"
                                                                                                   name="f_baski_olcusu_h"
                                                                                                   type="number"
                                                                                                   data-itemID="f_baski_olcusu_h_{{$yorum->id}}"
                                                                                                   value="{{$f_baski_olcusu_h}}"
                                                                                                   onkeyup="isf_attribute_update('f_baski_olcusu','h',{{$yorum->id}})" <?php if (($yorum->f_icerik_olusturan != $auserid && $yorum->f_baski_olcusu != "") && (\Illuminate\Support\Facades\Auth::user()->yetki != 9)) echo "readonly disabled"; ?> >
                                                                                        </div>

                                                                                        <div style="display: none">
                                                                                            <select class="form-control"
                                                                                                    name="f_baski_olcusu_b"
                                                                                                    onchange="sf_attr_selec_update(event,'f_baski_olcusu_b',{{$yorum->id}})" <?php if ((($yorum->f_icerik_olusturan != $auserid) && ($yorum->f_baski_olcusu_b != "")) && (\Illuminate\Support\Facades\Auth::user()->yetki != 9)) echo "readonly disabled"; ?>>
                                                                                                <option></option>
                                                                                                @foreach($birimcon as $val)
                                                                                                    @if ( $val->item_num == $yorum->f_baski_olcusu_b)
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
                                                                                        <label class="col-md-12">Ürün
                                                                                            Ölçüsü</label>
                                                                                        <div class="col-md-6">
                                                                                            <input class="form-control col-md-12 col-xs-12"
                                                                                                   name="f_urun_olcusu_w"
                                                                                                   type="number"
                                                                                                   data-itemID="f_urun_olcusu_w_{{$yorum->id}}"
                                                                                                   value="{{$f_urun_olcusu_w}}"
                                                                                                   onkeyup="isf_attribute_update('f_urun_olcusu','w',{{$yorum->id}})" <?php if (($yorum->f_icerik_olusturan != $auserid && $yorum->f_urun_olcusu != "") && (\Illuminate\Support\Facades\Auth::user()->yetki != 9)) echo "readonly disabled"; ?> >
                                                                                        </div>

                                                                                        <div class="col-md-6">
                                                                                            <input class="form-control col-md-12 col-xs-12"
                                                                                                   name="f_urun_olcusu_h"
                                                                                                   type="number"
                                                                                                   data-itemID="f_urun_olcusu_h_{{$yorum->id}}"
                                                                                                   value="{{$f_urun_olcusu_h}}"
                                                                                                   onkeyup="isf_attribute_update('f_urun_olcusu','h',{{$yorum->id}})" <?php if (($yorum->f_icerik_olusturan != $auserid && $yorum->f_urun_olcusu != "") && (\Illuminate\Support\Facades\Auth::user()->yetki != 9)) echo "readonly disabled"; ?> >
                                                                                        </div>
                                                                                        <div style="display: none">

                                                                                            <select class="form-control"
                                                                                                    name="f_urun_olcusu_b"
                                                                                                    onchange="sf_attr_selec_update(event,'f_urun_olcusu_b',{{$yorum->id}})" <?php if ((($yorum->f_icerik_olusturan != $auserid) && ($yorum->f_urun_olcusu_b != "")) && (\Illuminate\Support\Facades\Auth::user()->yetki != 9)) echo "readonly disabled"; ?>>
                                                                                                <option></option>
                                                                                                @foreach($birimcon as $val)
                                                                                                    @if ( $val->item_num == $yorum->f_urun_olcusu_b)
                                                                                                        <option value='{{$val->item_num}}'
                                                                                                                selected> {{$val->value}}</option>
                                                                                                    @else
                                                                                                        <option value='{{$val->item_num}}'> {{$val->value}}</option>
                                                                                                    @endif
                                                                                                @endforeach
                                                                                            </select>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </td>
                                                                        <td>
                                                                            <div class="checkbox form-group {{$renkli}}">
                                                                                <?php
                                                                                $uyglam = explode('|', $yorum->f_uygulama);
                                                                                ?>
                                                                                @foreach($uygulamacon as $uyval)
                                                                                    <?php
                                                                                    if (in_array($uyval->id, $uyglam)) {
                                                                                        $ychecked = 'checked="checked"';
                                                                                    } else {
                                                                                        $ychecked = '';
                                                                                    }
                                                                                    ?>
                                                                                    <label class="col-md-6"
                                                                                           style=" margin-bottom: 5px; float: left; ">
                                                                                        <input type='checkbox'
                                                                                               value='{{$uyval->id}}'
                                                                                               {{$ychecked}}
                                                                                               name='f_uygulama_{{$yorum->id}}_{{$uyval->id}}'
                                                                                               onchange="sfc_attribute_update('f_uygulama',{{$yorum->id.','.$uyval->id}})"> {{$uyval->value}}
                                                                                    </label>
                                                                                @endforeach

                                                                            </div>
                                                                        </td>

                                                                        <td>
                                                                            <div class="form-group">
                                                                                <div class="col-md-12">
                                                                                    <?php
                                                                                    $bytes = $yorum->f_dosya_boyut;
                                                                                    $decimals = 1;
                                                                                    $size = array('B', 'kB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB');
                                                                                    $factor = floor((strlen($bytes) - 1) / 3);
                                                                                    $sizer = sprintf("%.{$decimals}f", $bytes / pow(1024, $factor)) . @$size[$factor];
                                                                                    ?>
                                                                                    <label class="col-md-12">Boyut:
                                                                                        @if($yorum->f_dosya_boyut == 0)
                                                                                            <div data-drive-size-file="{{url('/')}}/gsuitedrivesize/{{$i.",".$dosyauzanti}}"></div>
                                                                                        @else
                                                                                            <?php echo $sizer;  ?>
                                                                                        @endif</label>
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <div class="col-md-12">
                                                                                    @if(($resimuzanti == 'png' || $resimuzanti == 'PNG' || $resimuzanti == 'jpg'|| $resimuzanti == 'jpeg'|| $resimuzanti == 'JPEG'|| $resimuzanti == 'JPG'|| $resimuzanti == 'gif'|| $resimuzanti == 'GIF' || $resimuzanti == 'WebP' )  )
                                                                                        <div class="col-md-12 ">
                                                                            <span class="image view view-first">
                                                                               <a href="{{url('/')}}/gsuitedrive/{{$dosyauzanti}}/{{$i}}"
                                                                                  onclick="window.open(this.href); return false;"
                                                                                  onkeypress="window.open(this.href); return false;">
                                                                                    <img
                                                                                            data-drive-thumbnail-file="{{url('/')}}/gsuitedrivethumb/{{$i.",".$dosyauzanti}}"
                                                                                            src="{{url('/')}}/load.gif"
                                                                                            alt="image"/></a>
                                                                            </span>
                                                                                        </div>
                                                                                    @endif
                                                                                </div>
                                                                            </div>


                                                                        </td>
                                                                    </tr>
                                                                @endif
                                                            @endforeach


                                                            </tbody>
                                                        </table>
                                                        </ul>
                                                    </div>
                                                    <div class="ln_solid"></div>


                                                </div>

                                                <div class="row" style="display: {{$aktif}}">
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
                                                                    <th style="width: 80%">Sipariş Detayları :</th>
                                                                    <th>İşlem</th>
                                                                </tr>
                                                                </thead>
                                                                <tbody>

                                                                @foreach($gorevicerik as $yorum)
                                                                    <tr>
                                                                        <td>{{$yorum->user->name}}</td>
                                                                        <td>{{$yorum->created_at->formatLocalized('%d-%m-%y, %I:%M')}}</td>

                                                                        @php($zaman=$yorum->created_at)
                                                                        @php($zaman->setLocale('tr'))
                                                                        <td>{{$zaman->diffForHumans()}}</td>
                                                                        <td><b style="color: blue;"><?php echo html_entity_decode($yorum->isicerik); ?></b>
                                                                            @if($yorum->dosyalar!=NULL)
                                                                                <ul class="list-group list-group-flush">
                                                                                    @foreach($yorum->dosyalar as $ydosya)
                                                                                        <?php
                                                                                        $dosyaisimi = $ydosya->f_dosyaisimi;
                                                                                        $r_dosyaisimi = $ydosya->r_dosyaisimi;
                                                                                        $dosyayeri = $ydosya->f_dosyayeri;
                                                                                        $dosyauzanti = $ydosya->slug;
                                                                                        ?>

                                                                                        <li class="list-group-item">
                                                                                            {{$r_dosyaisimi}} -->
                                                                                            @if($dosyayeri == 1)
                                                                                                @if(file_exists( public_path().'/uploads/dosya/'.$dosyauzanti.'/'.$dosyaisimi ))

                                                                                                    @if(($yorum->grv_icerik_olusturan == $auserid) || (\Illuminate\Support\Facades\Auth::user()->yetki == 9))
                                                                                                        <a class="btn btn-info btn-xs"
                                                                                                           onclick="f_delete('{{$yorum->id}}','{{$ydosya->id}}');">Local
                                                                                                            Sil</a>
                                                                                                        <a class="btn btn-warning btn-xs"
                                                                                                           onclick="fdrive_send('{{$yorum->id}}','{{$ydosya->id}}')">Drive
                                                                                                            Gönder</a>
                                                                                                    @endif
                                                                                                    <a class="btn btn-dark btn-xs"
                                                                                                       href="{{url('/')}}/uploads/dosya/{{$dosyauzanti.'/'.$dosyaisimi}}">Local
                                                                                                        İndir</a>
                                                                                                @endif
                                                                                            @elseif($dosyayeri == 2)
                                                                                                @if(($yorum->grv_icerik_olusturan == $auserid)|| (\Illuminate\Support\Facades\Auth::user()->yetki == 9))

                                                                                                    <a class="btn btn-info btn-xs"
                                                                                                       onclick="f_delete('{{$yorum->id}}','{{$ydosya->id}}');">Drive
                                                                                                        Sil</a>
                                                                                                @endif <a
                                                                                                        class="btn btn-dark btn-xs"
                                                                                                        href="{{url('/')}}/gsuitedrive/{{$dosyauzanti}}/{{$dosyaisimi}}"
                                                                                                        onclick="window.open(this.href); return false;"
                                                                                                        onkeypress="window.open(this.href); return false;">Drive
                                                                                                    İndir</a>
                                                                                            @endif
                                                                                        </li>
                                                                                    @endforeach
                                                                                </ul>
                                                                            @endif
                                                                        </td>
                                                                        <td>
                                                                        <!-- <a onclick="altyorum({{$yorum->id}})">Cevap</a> <i class="fa fa-reply"></i> -->
                                                                            @if(($yorum->grv_icerik_olusturan == $auserid) || (\Illuminate\Support\Facades\Auth::user()->yetki == 9))
                                                                                <a class="btn btn-danger"
                                                                                   onclick="isicerikduzenle(this, '{{$yorum->isicerik}}', '{{$yorum->id}}');">Düzenle</a>
                                                                            @else
                                                                                <a class="btn btn-warning"
                                                                                   id="isicerikkopyala"
                                                                                   onclick="isicerikkopyala('{{$yorum->isicerik}}');">Kopyala</a>
                                                                            @endif </td>
                                                                    </tr>
                                                                @endforeach
                                                                </tbody>
                                                            </table>

                                                        </div>

                                                    @endif
                                                    <div class="ln_solid"></div>

                                                </div>
                                                <div class="row" style="display: {{$aktif}}">
                                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                                        <div class=" x_panel">
                                                            <div class="x_title">
                                                                <h2>SİPARİŞ DETAY EKLEME</h2>
                                                                <div class="clearfix"></div>
                                                            </div>
                                                            <div class="x_content">

                                                                <div class="col-md-12 col-sm-12 col-xs-12">
                                                                    <div style="display: none" class="form-group">

                                                                        <label class="col-md-3 col-sm-3 col-xs-12">Dosya
                                                                            Kayıt
                                                                            Yeri
                                                                        </label>
                                                                        <div class="col-sm-9">
                                                                            <select name="gondercloud"
                                                                                    class="form-control"
                                                                                    required>
                                                                                <option value='1'> Local
                                                                                </option>
                                                                                <option value='2' selected> Drive
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
                                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                                        <div class="x_panel ">
                                                            <div class="x_title">
                                                                <h2>SİPARİŞ AYRINTILARI</h2>
                                                                <div class="clearfix"></div>
                                                            </div>
                                                            <div class="x_content">
                                                                <div class="col-md-12 col-sm-12 col-xs-12">


                                                                    <div class="form-group">
                                                                        <label class="control-label col-md-3 col-sm-3 col-xs-12"
                                                                               for="first-name">Siparişi Açan Kişi * :
                                                                        </label>
                                                                        <div class="col-md-9 col-sm-6 col-xs-12">
                                                                            <input class="form-control col-md-7 col-xs-12"
                                                                                   required="required" name="grv_baslik"
                                                                                   type="text"
                                                                                   value="{{$gorevler->user->name}}"
                                                                                   readonly disabled>
                                                                        </div>
                                                                    </div>

                                                                    <div class="form-group">
                                                                        <label class="control-label col-md-3 col-sm-3 col-xs-12"
                                                                               for="first-name">Sipariş Başlığı * :
                                                                        </label>
                                                                        <div class="col-md-9 col-sm-6 col-xs-12">
                                                                            <input class="form-control col-md-7 col-xs-12"
                                                                                   required="required" name="grv_baslik"
                                                                                   type="text"
                                                                                   value="{{$gorevler->grv_baslik}}">
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group">

                                                                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Baskı Merkezi
                                                                        </label>
                                                                        <div class="col-md-9 col-sm-9 col-xs-6">
                                                                            <select name="bsim_yeri"
                                                                                    class="form-control"
                                                                                    required>
                                                                                @if (  $gorevler->bsim_yeri == 1)
                                                                                    <option value='1' selected> Ankara</option>
                                                                                    <option value='2'> İzmir </option>
                                                                                @else
                                                                                    <option value='1' > Ankara</option>
                                                                                    <option value='2' selected> İzmir </option>
                                                                                @endif
                                                                                
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label class="control-label col-md-3 col-sm-3 col-xs-12">
                                                                            Sipariş Adı:
                                                                        </label>
                                                                        <div class="col-md-9 col-sm-9 col-xs-6">
                                                                            <input class="form-control col-md-5 col-xs-12"
                                                                                   name="mus_is_adi" type="text"
                                                                                   value="{{$gorevler->mus_is_adi}}" <?php if (($gorevler->grv_icerik_yonetici != $auserid && $gorevler->mus_is_adi != "") && (\Illuminate\Support\Facades\Auth::user()->yetki != 9)) echo "readonly disabled"; ?>>
                                                                        </div>
                                                                    </div>

                                                                    <div class="form-group">
                                                                        <label class="control-label col-md-3 col-sm-3 col-xs-12">
                                                                            Teslim Yeri Adresi:
                                                                        </label>
                                                                        <div class="col-md-9 col-sm-9 col-xs-6">
                                                                            <input class="form-control col-md-5 col-xs-12"
                                                                                   name="mus_tes_adres" type="text"
                                                                                   value="{{$gorevler->mus_tes_adres}}" <?php if (($gorevler->grv_icerik_yonetici != $auserid && $gorevler->mus_tes_adres != "") && (\Illuminate\Support\Facades\Auth::user()->yetki != 9)) echo "readonly disabled"; ?>>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label class="control-label col-md-3 col-sm-3 col-xs-12">
                                                                            Siparişin Beklenen Teslim Tarihi *:
                                                                        </label>
                                                                        <div class="col-md-9 col-sm-9 col-xs-6">
                                                                            <fieldset>
                                                                                <div class="control-group">
                                                                                    <div class="controls">
                                                                                        <div class="input-prepend input-group">
                                                        <span class="add-on input-group-addon"><i
                                                                    class="glyphicon glyphicon-calendar fa fa-calendar"></i></span>
                                                                                            <input type="text"
                                                                                                   name="reservation-time"
                                                                                                   id="narusta-time"
                                                                                                   class="form-control"
                                                                                                   required/>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </fieldset>
                                                                        </div>
                                                                    </div>

                                                                    <div class="form-group">
                                                                        <label class="control-label col-md-3 col-sm-3 col-xs-12">
                                                                            Keşif Yapan Kişi:
                                                                        </label>
                                                                        <div class="col-md-9 col-sm-9 col-xs-6">
                                                                            <input class="form-control col-md-5 col-xs-12"
                                                                                   name="mus_kesif" type="text"
                                                                                   value="{{$gorevler->mus_kesif}}"
                                                                            <?php if (($gorevler->grv_icerik_yonetici != $auserid && $gorevler->mus_kesif != "") && (\Illuminate\Support\Facades\Auth::user()->yetki != 9)) echo "readonly disabled"; ?>>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label class="control-label col-md-3 col-sm-3 col-xs-12">
                                                                            Önizleme resimi ekle
                                                                        </label>

                                                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                                                            <a href="{{url('/')}}//onizle/{{$gorevler->slug}}"
                                                                               target="_blank"
                                                                               class="col-md-12 btn btn-warning">önizleme
                                                                                için küçük resim ekle</a>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label class="control-label col-md-3 col-sm-3 col-xs-12">
                                                                            Sipariş
                                                                            Durumu *:
                                                                        </label>
                                                                        <div class="col-md-9 col-sm-9 col-xs-6">
                                                                            <?php
                                                                            $yetk = explode('|', $kullanicilar->yetki_alani);
                                                                            ?>

                                                                            <select name="grv_onemi"
                                                                                    class="form-control" required>
                                                                                @foreach($titlecons as $val)
                                                                                    @if (in_array($val->id, $yetk)) {
                                                                                    @if ( $val->item_num == $gorevler->grv_onemi)
                                                                                        <option value='{{$val->item_num}}'
                                                                                                selected> {{$val->value}}</option>
                                                                                    @else
                                                                                        <option value='{{$val->item_num}}'> {{$val->value}}</option>
                                                                                    @endif
                                                                                    @endif
                                                                                @endforeach
                                                                            </select>
                                                                        </div>


                                                                    </div>

                                                                    <div class="form-group">
                                                                        <div class="col-md-4 col-sm-4 col-xs-12 col-md-offset-4">
                                                                            <div class="checkbox">

                                                                                <?php
                                                                                if ($gorevler->vinckira == "on") {
                                                                                    $vinckirala = 'checked="checked"';
                                                                                } else {
                                                                                    $vinckirala = '';
                                                                                }
                                                                                ?>
                                                                                <label style=" margin-bottom: 5px; float: left; ">
                                                                                    <input type="checkbox"
                                                                                           {{$vinckirala}}
                                                                                           name="vinckira"
                                                                                           class="flat"/> Vinç
                                                                                    Kiralanacak
                                                                                </label>

                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-4 col-sm-4 col-xs-12">
                                                                            <div class="checkbox">

                                                                                <?php
                                                                                if ($gorevler->skumyap == "on") {
                                                                                    $sokumyap = 'checked="checked"';
                                                                                } else {
                                                                                    $sokumyap = '';
                                                                                }
                                                                                ?>
                                                                                <label style=" margin-bottom: 5px; float: left; ">
                                                                                    <input type="checkbox"
                                                                                           {{$sokumyap}}
                                                                                           name="skumyap"
                                                                                           class="flat"/> Söküm
                                                                                    Yapılacak
                                                                                </label>

                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                                        <div class="x_panel ">
                                                            <div class="x_title">
                                                                <h2>MÜŞTERİ AYRINTILARI</h2>
                                                                <div class="clearfix"></div>
                                                            </div>
                                                            <div class="x_content">
                                                                <div class="col-md-12 col-sm-12 col-xs-12">

                                                                    <div class="form-group">
                                                                        <label class="control-label col-md-3 col-sm-3 col-xs-12"
                                                                               for="first-name">Kurum Bilgisi :
                                                                        </label>
                                                                        <div class="col-md-9 col-sm-9 col-xs-12">
                                                                            <select name="kurum_id"
                                                                                    class="form-control"
                                                                                    <?php if ((($gorevler->grv_icerik_yonetici != $auserid && $gorevler->grv_kurum_id != "")) && (\Illuminate\Support\Facades\Auth::user()->yetki != 9)) echo "readonly disabled"; ?>
                                                                                    onchange="sf_attr_selec_grv_kurum_id(event)">
                                                                                @foreach($kurumlar as $val)
                                                                                    @if ( $val->id == $gorevler->grv_kurum_id)
                                                                                        <option value='{{$val->id}}'
                                                                                                selected> {{$val->ad}}</option>
                                                                                    @else
                                                                                        <option value='{{$val->id}}'>
                                                                                            {{$val->ad}}</option>
                                                                                    @endif
                                                                                @endforeach
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                    <?php
                                                                    if ($gorevler->grv_kurum_id == "30") {
                                                                        $disp = "block";
                                                                    } else {
                                                                        $disp = "none";
                                                                    }
                                                                    ?>
                                                                    <div class="form-group" id="musteridi"
                                                                         style="display: {{$disp}}">
                                                                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Müşteri
                                                                            Seç
                                                                        </label>
                                                                        <div class="col-sm-6">
                                                                            <select name="mus_id"
                                                                                    class="form-control">
                                                                                @foreach($musteriler as $val)
                                                                                    @if($val->kurumadi == "30")
                                                                                        @if ( $val->id == $gorevler->grv_mus_id)
                                                                                            <option value='{{$val->id}}'
                                                                                                    selected> {{$val->mus_bilgisi}}</option>
                                                                                        @else
                                                                                            <option value='{{$val->id}}'> {{$val->mus_bilgisi}}</option>
                                                                                        @endif
                                                                                    @endif
                                                                                @endforeach
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                    <table id="table" class="table">
                                                                        <thead>
                                                                        <tr>
                                                                            <th>#</th>
                                                                            <th>mus_bilgisi</th>
                                                                            <th>mus_is_adi</th>
                                                                            <th>mus_tel</th>
                                                                            <th>mus_eposta</th>
                                                                            <th>mus_adres</th>
                                                                            <th>mus_kesif</th>
                                                                            <th>mus_tes_adres</th>
                                                                        </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                        @foreach($gorevler->kurummusteri as $musteri)
                                                                            @if ( $gorevler->grv_kurum_id != "17" && $gorevler->grv_kurum_id != "30")
                                                                                <tr>
                                                                                    <th scope="row">{{$musteri->id}}</th>
                                                                                    <td>{{$musteri->mus_bilgisi}}</td>
                                                                                    <td>{{$musteri->mus_is_adi}}</td>
                                                                                    <td>{{$musteri->mus_tel}}</td>
                                                                                    <td>{{$musteri->mus_eposta}}</td>
                                                                                    <td>{{$musteri->mus_adres}}</td>
                                                                                    <td>{{$musteri->mus_kesif}}</td>
                                                                                    <td>{{$musteri->mus_tes_adres}}</td>
                                                                                </tr>
                                                                            @else
                                                                                @if ( $gorevler->grv_mus_id  == $musteri->id)
                                                                                    <tr>
                                                                                        <th scope="row">{{$musteri->id}}</th>
                                                                                        <td>{{$musteri->mus_bilgisi}}</td>
                                                                                        <td>{{$musteri->mus_is_adi}}</td>
                                                                                        <td>{{$musteri->mus_tel}}</td>
                                                                                        <td>{{$musteri->mus_eposta}}</td>
                                                                                        <td>{{$musteri->mus_adres}}</td>
                                                                                        <td>{{$musteri->mus_kesif}}</td>
                                                                                        <td>{{$musteri->mus_tes_adres}}</td>
                                                                                    </tr>
                                                                                @endif
                                                                            @endif
                                                                        @endforeach
                                                                        </tbody>
                                                                    </table>
                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="ln_solid"></div>

                                        <div class="form-group">
                                            <div class="text-center" style="display: {{$pasif}};"><h2
                                                        style="color:red; "><b>Malzeme Türü, Baskı
                                                        Ölçüsü, Adet ve Uygulama Alanlarının Doldurulması
                                                        Gerekmektedir.</b><br>
                                                </h2>
                                                <h4>Doldurduktan Sonra Kaydet Dediğinizde sayfa yenilenecektir.</h4>
                                            </div>
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


@endsection
@section('css')

    <link href="{{url('/')}}/backend/vendors/iCheck/skins/flat/green.css" rel="stylesheet">
    <!-- bootstrap-daterangepicker -->
    <link href="{{url('/')}}/backend/vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">
    <!-- bootstrap-datetimepicker -->
    <link href="{{url('/')}}/backend/vendors/bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.css" rel="stylesheet">
    <link href="{{url('/')}}/backend/vendors/select2/dist/css/select2.min.css" rel="stylesheet">

    <style>
        .ck-editor__editable {
            min-height: 180px;
        }
    </style>
@endsection
@section('js')
    <script src="{{url('/')}}/backend/vendors/iCheck/icheck.min.js"></script>
    <!-- bootstrap-daterangepicker -->
    <script src="{{url('/')}}/backend/vendors/moment/min/moment.min.js"></script>
    <script src="{{url('/')}}/backend/vendors/moment/locale/tr.js"></script>
    <script src="{{url('/')}}/backend/vendors/bootstrap-daterangepicker/daterangepicker.js"></script>
    <!-- bootstrap-datetimepicker -->
    <script src="{{url('/')}}/backend/vendors/bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js"></script>

    <script src="{{url('/')}}/backend/vendors/select2/dist/js/select2.full.min.js"></script>
    <script src="{{url('/')}}/js/jquery.form.min.js"></script>
    <script src="{{url('/')}}/js/jquery.validate.min.js"></script>
    <script src="{{url('/')}}/js/messages_tr.min.js"></script>

    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    <script src="https://cdn.ckeditor.com/ckeditor5/10.0.1/classic/ckeditor.js"></script>

    <script src="{{url('/')}}/js/drivethumb.js"></script>
    <script src="{{url('/')}}/js/driveSize.js"></script>
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

        $("#narusta-time").datetimepicker({
            format: 'DD-MM-YYYY HH:mm',
            locale: 'tr',
        });
        $('#narusta-time').data("DateTimePicker").date(new Date('{{date('Y-m-d H:i:s', strtotime($gorevler->grv_bitis_tarih))}}'));

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

        function fdrive_send(yorumid, fileid) {
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                type: 'POST',
                url: '/fdrive_send',
                data: {
                    'yorumid': yorumid,
                    'fileid': fileid,
                    '_token': CSRF_TOKEN,
                    'X-CSRF-TOKEN': CSRF_TOKEN,
                },
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


        function fdriveelse_send(ficerikolus, resimuzanti, filesize, fuzanti, fileid) {
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                type: 'POST',
                url: '/fdriveelse_send',
                data: {
                    'ficerikolus': ficerikolus,
                    'resimuzanti': resimuzanti,
                    'fuzanti': fuzanti,
                    'fileid': fileid,
                    'filesize': filesize,
                    '_token': CSRF_TOKEN,
                    'X-CSRF-TOKEN': CSRF_TOKEN,
                },
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


        function f_delete(yorumid, fileid) {
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                type: 'POST',
                url: '/f_delete',
                data: {
                    'yorumid': yorumid,
                    'fileid': fileid,
                    '_token': CSRF_TOKEN,
                    'X-CSRF-TOKEN': CSRF_TOKEN,
                },
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

        function sf_attr_selec_update(e, attr, id) {
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            var value = e.target.value;
            $.ajax({
                type: "Post",
                url: '/sf_attribute_update',
                data: {
                    'id': id,
                    'attr': attr,
                    'value': value,
                    '_token': CSRF_TOKEN
                },
                success: function (response) {
                    if (response.durum == 'success') {

                    }
                }
            })
        }


        function sf_attribute_update(attr, id) {

            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            var value = document.querySelector('[data-itemID=' + attr + '_' + id + ']').value;
            $.ajax({
                type: "Post",
                url: '/sf_attribute_update',
                data: {
                    'id': id,
                    'attr': attr,
                    'value': value,
                    '_token': CSRF_TOKEN
                },
                success: function (response) {
                    if (response.durum == 'success') {

                    }
                }
            })
        }


        function sfc_attribute_update(attr, fid, vid) {
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            var chdv = document.querySelector('[name=' + attr + '_' + fid + '_' + vid + ']').checked;
            if (chdv == true) {
                var chd = 1;
            } else {
                var chd = 2;
            }
            $.ajax({
                type: "Post",
                url: '/sfc_attribute_update',
                data: {
                    'fid': fid,
                    'vid': vid,
                    'chd': chd,
                    'attr': attr,
                    '_token': CSRF_TOKEN
                },
                success: function (response) {
                    if (response.durum == 'success') {

                    }
                }
            })
        }

        function isf_attribute_update(attr, ayrac, id) {
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            var value = document.querySelector('[data-itemID=' + attr + '_' + ayrac + '_' + id + ']').value;
            $.ajax({
                type: "Post",
                url: '/isf_attribute_update',
                data: {
                    'id': id,
                    'attr': attr,
                    'ayrac': ayrac,
                    'value': value,
                    '_token': CSRF_TOKEN
                },
                success: function (response) {
                    if (response.durum == 'success') {

                    }
                }
            })
        }


        function sf_attr_selec_grv_kurum_id(e) {
            var value = e.target.value;
            if (value == '30' || value == '17') {
                $('#musteridi').css('display', 'block');
            } else {
                $('#musteridi').css('display', 'none');
            }
        }

    </script>
@endsection