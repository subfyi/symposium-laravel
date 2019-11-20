@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6 ">
            <div class="card">
                <div class="card-header">ISESER2019
                </div>
                <div class="card-body">
                    <img src="{{url('/')}}/v_6_telif.jpg" style="width: 100%">
                    <hr>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">{{ __('Login') }}</div>

                <div class="card-body">

                    <div class="text-center text-center">
                        <h1 class="error-number">403</h1>
                        <h2>Login Denied</h2>
                        <p>No Authorization.</p>
                        <div class="mid_center">

                            To register <a href="{{url('/')}}/register"> click here</a>.<br/><br/>


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
