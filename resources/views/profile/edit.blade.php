@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
        {!! Form::open(['route' => ['profile.update', Auth::user()->id], 'method' => 'put', 'files' => true]) !!}
        <div class="box-body">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="name">Full Name *</label>
                    <input type="text" name="name" class="form-control" id="name" value="{{Auth::user()->name}}">
                    @if ($errors->has('name'))
                        <div class="alert alert-danger">{{ $errors->first('name') }}</div>
                    @endif
                </div>

                <div class="form-group">
                    <label for="email">E-mail *</label>
                    <input type="text" name="email" class="form-control" id="email" value="{{Auth::user()->email}}">
                    @if ($errors->has('email'))
                        <div class="alert alert-danger">{{ $errors->first('email') }}</div>
                    @endif
                </div>
                <div class="form-group">
                    <label for="address">Address</label>
                    <input type="text" name="address" class="form-control" id="address" value="{{Auth::user()->address}}">
                    @if ($errors->has('address'))
                        <div class="alert alert-danger">{{ $errors->first('address') }}</div>
                    @endif
                </div>
                <div class="form-group">
                    <label for="tel">Telephone</label>
                    <input type="text" name="phone_number" class="form-control" id="tel" value="{{Auth::user()->phone_number}}">
                    @if ($errors->has('phone_number'))
                        <div class="alert alert-danger">{{ $errors->first('phone_number') }}</div>
                    @endif
                </div>
                <div class="form-group">
                    <label for="password">Password *</label>
                    <input type="password" name="password" class="form-control" id="password">
                    @if ($errors->has('password'))
                        <div class="alert alert-danger">{{ $errors->first('password') }}</div>
                    @endif
                </div>
                <div class="form-group">
                    <label for="avatar">Avatar</label>
                    <input type="file" class="form-control" name="avatar" id="avatar">
                    @if ($errors->has('avatar'))
                        <div class="alert alert-danger">{{ $errors->first('avatar') }}</div>
                    @endif
                </div>
                <div class="form-group">
                    <input type="submit" class="btn btn-info" value="Edit">
                </div>
            </div>
        </div>
        {!! Form::close() !!}
    </div>
@endsection()