@extends('frontend.app')

@section('content')
    <b><i>baslik </i></b>: <a href="blog/{{$blog->slug}}">{{$blog->baslik}}</a><br/>
    <b><i>icerik</i></b><br/>
    <?php echo html_entity_decode($blog->icerik); ?>
    <a href="blog/{{$blog->slug}}">{{$blog->slug}}</a>
    </br>
    <hr>


    <form method="post" id="form" data-parsley-validate
          class="form-horizontal form-label-left" enctype="multipart/form-data">
        {{csrf_field()}}
        <div id="altyorum"></div>
        @if(!\Illuminate\Support\Facades\Auth::check())
        <input type="text" name="isim" id="name" class="form-control">
        <input type="text" name="mail" id="name" class="form-control">
        @endif
        <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12">İçerik<span
                        class="required">*</span>
            </label>
            <div class="col-md-9 col-sm-9 col-xs-12">
                                                        <textarea id="editor" name="icerik"
                                                                  class="form-control ckeditor" rows="3">

                                                        </textarea>
            </div>
        </div>
        <div class="ln_solid"></div>
        <div class="form-group">
            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                <input type="submit" class="btn btn-success"></input>
            </div>
        </div>
    </form>



    <ul>
        @foreach($blog->yorumlar->where('ust_yorum', '0') as $yorum)
            <li>
                @if($yorum->kullanici_id > 0)

                @else
                    {{$yorum->isim}}
                @endif
                <a href="blog/{{$yorum->blog}}">{{$yorum->isim}}</a><br/>{{$yorum->mail}}<br/>
                <a onclick="altyorum({{$yorum->id}})">Cevap</a> <i class="fa fa-reply"></i> <br/><br/>
                <b><i>icerik</i></b><br/>
                <?php echo html_entity_decode($yorum->icerik); ?>
                <br/>
                <b><i>created_at</i></b><br/>

                    @php($zaman=$yorum->created_at)
                    @php($zaman->setLocale('tr'))
                    {{$zaman->diffForHumans()}}
                {{$yorum->created_at}}
                </br>
                <hr>
            </li>
            <ul>
                @foreach($yorum->children as $altyorum)
                    <li>
                        @if($altyorum->kullanici_id > 0)

                        @else
                            {{$altyorum->isim}}
                        @endif
                        <a href="blog/{{$altyorum->blog}}">{{$altyorum->isim}}</a><br/>{{$altyorum->mail}}<br/>
                        <b><i>icerik</i></b><br/>
                        <?php echo html_entity_decode($altyorum->icerik); ?>
                        <br/>
                        <b><i>created_at</i></b><br/>

                        {{$altyorum->created_at->diffForHumans()}}
                        </br>
                        <hr>
                    </li>
                    <ul>

                    </ul>

                @endforeach

            </ul>

        @endforeach
    </ul>
    </br>
@section('css')
    <link href="{{url('/')}}/css/sweetalert2.min.css" rel="stylesheet">
@endsection
@section('js')
    <script src="{{url('/')}}/js/sweetalert2.min.js"></script>
    <script>
        function altyorum(id) {
            var hidden = '<input type="hidden" name="ust_yorum" value="' + id + '">'
            document.getElementById('altyorum').innerHTML = hidden;
        }

        $(document).ready(function () {
            $('form').validate();
            $('form').ajaxForm({
                success: function (response) {
                    swal(
                        response.baslik,
                        response.icerik,
                        response.durum,
                    );
                    if (response.durum == 'success') {
                        var isim = document.getElementById('name').value;
                        var icerik = document.getElementById('icerik').value;
                        var mesaj = '<strong>' + isim + '</strong>' +
                            '+icerik+';
                        document.getElementById('yorumlar').innerHTML = mesaj;
                    }
                }
            })

        })
    </script>
@endsection



