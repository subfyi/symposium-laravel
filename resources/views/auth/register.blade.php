@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('Register') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('register') }}">
                            @csrf

                            <div class="form-group row">
                                <label for="name" class="col-md-2 col-form-label text-md-right">{{ __('Name') }}</label>

                                <div class="col-md-4  ">
                                    <input id="name" type="text"
                                           class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}"
                                           name="name" value="{{ old('name') }}" required autofocus>

                                    @if ($errors->has('name'))
                                        <span class="invalid-feedback">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <label for="name" class="col-md-2  col-form-label text-md-right">Surname</label>

                                <div class="col-md-4  ">
                                    <input id="name" type="text" class="form-control " name="surname" required
                                           autofocus>

                                </div>
                            </div>


                            <div class="form-group row ">
                                <label class="col-md-2  col-form-label text-md-right">Title</label>
                                <div class="col-md-4  ">

                                    <select class="form-control"
                                            name="u_title">
                                        @foreach($titlecons as $val)
                                            <option value='{{$val->item_num}}'> {{$val->value}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <label class="col-md-2  col-form-label text-md-right">Type</label>
                                <div class="col-md-4  ">

                                    <select class="form-control"
                                            name="u_type">
                                        @foreach($materialcon as $val)

                                            <option value='{{$val->item_num}}'> {{$val->value}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-2  col-form-label text-md-right">Gender</label>
                                <div class="col-md-4  ">

                                    <select class="form-control"
                                            name="gender">
                                        @foreach($gendercon as $val)
                                            <option value='{{$val->item_num}}'> {{$val->value}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <label class="col-md-2  col-form-label text-md-right">Institution</label>
                                <div class="col-md-4  ">
                                    <input type="text"
                                           class="form-control"
                                           name="institution" value="" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-2  col-form-label text-md-right">Faculty</label>
                                <div class="col-md-4  ">
                                    <input type="text"
                                           class="form-control"
                                           name="faculty" value="" required>
                                </div>

                                <label class="col-md-2  col-form-label text-md-right">Department</label>
                                <div class="col-md-4  ">
                                    <input type="text"
                                           class="form-control"
                                           name="department" value="" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-2  col-form-label text-md-right">Mobile / GSM</label>
                                <div class="col-md-4  ">
                                    <input type="text"
                                           class="form-control"
                                           name="iletisim" value="" >
                                </div>

                                <label for="email"
                                       class="col-md-2  col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                                <div class="col-md-4  ">
                                    <input id="email" type="email"
                                           class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                                           name="email" value="{{ old('email') }}" required>

                                    @if ($errors->has('email'))
                                        <span class="invalid-feedback">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="password"
                                       class="col-md-2  col-form-label text-md-right">{{ __('Password') }}</label>

                                <div class="col-md-4  ">
                                    <input id="password" type="password"
                                           class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
                                           name="password" required>

                                    @if ($errors->has('password'))
                                        <span class="invalid-feedback">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                    @endif
                                </div>

                                <label for="password-confirm"
                                       class="col-md-2  col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                                <div class="col-md-4  ">
                                    <input id="password-confirm" type="password" class="form-control"
                                           name="password_confirmation" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-2  col-form-label text-md-right">Address :</label>
                                <div class="col-md-10  ">
                            <textarea id="editor" name="address" class="form-control ck-editor__editable ck-editor__editable_inline ckeditor"
                                      rows="2"> </textarea>
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-4   offset-md-4">
                                    <button type="submit" class="col-md-12 btn btn-primary">
                                        {{ __('Register') }}
                                    </button>
                                </div>
                            </div>


                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
