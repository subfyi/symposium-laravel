@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6 ">
            <div class="card">
                <div class="card-header">Social Business Network</div>
                <div class="card-body">
                    <img src="{{url('/')}}/v_6_telif.jpg" style="width: 100%">
                    <hr>
                    <b>Vision :</b>{{$hakkimizda->vizyon}}<br/>
                    <b>Mission :</b>{{$hakkimizda->misyon}}<br/>
                    <b>About Us :</b> {{$hakkimizda->kisa_yazi}}<br/>
                    <b>About Us Detail :</b>  {{$hakkimizda->icerik}}<br/>
                    <hr>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">{{ __('Login') }}</div>

                <div class="card-body">

                    <div class="text-center text-center">
                        <div class="mid_center">
                            Admin sayfası için <a href="{{url('/')}}/admin">buraya</a> tıkalayabilirsiniz.<br/><br/>

                        </div>
                    </div>
                    <hr>
                    <b>Announcements</b> (last 2 -> <a href="{{url('/')}}/blog">Click For More</a>)
                    @php($i=1)
                    <hr>
                    @foreach($bloglar as $blog)
                        <b><i>baslik <?php echo $i ?></i></b>: <a href="blog/{{$blog->slug}}">{{$blog->baslik}}</a>
                        {{$blog->created_at->formatLocalized('%d %b')}}<br/>
                        <a href="yazar/{{$blog->user->slug}}-{{$blog->user->id}}">{{$blog->user->name}}</a>
                        {{$blog->yorumlar->count()}}<br/>
                        <b><i>icerik</i></b>
                        <?php echo html_entity_decode($blog->icerik); ?>
                        <a href="{{$blog->slug}}">{{$blog->slug}}</a>
                        <hr>
                        @php($i++)
                    @endforeach
                    <hr>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
