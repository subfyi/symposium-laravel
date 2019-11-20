@extends('frontend.app')

@section('content')
    <b>Duyurular </b>(son 3 duyuru)<br/><br/>
    @php($i=1)
    <hr>
    @foreach($bloglar as $blog)
        <b><i>baslik <?php echo $i ?></i></b>: <a href="blog/{{$blog->slug}}">{{$blog->baslik}}</a><br/>
        {{$blog->created_at->formatLocalized('%d %b')}}<br/>
        <a href="yazar/{{$blog->user->slug}}-{{$blog->user->id}}">{{$blog->user->name}}</a><br/>
        {{$blog->yorumlar->count()}}<br/>
        <b><i>icerik</i></b><br/>
        <?php echo html_entity_decode($blog->icerik); ?>
        <a href="{{$blog->slug}}">{{$blog->slug}}</a>
        </br>
        <hr>
        @php($i++)
    @endforeach
    </br>
@endsection
@section('css')
@endsection
@section('js')
@endsection



