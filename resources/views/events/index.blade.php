@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="panel panel-info">
            <div class="panel-heading">Add Event </div>
            <div class="panel-body">
                {!! Form::open(['route' => 'events.add']) !!}
                    <div class="row">
                        <div class="col-md-12">
                            @if(session('status'))
                                <div class="alert alert-success">
                                    {{session('status')}}
                                </div>
                            @endif
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="title">Title</label>
                                <input type="text" name="title" class="form-control" id="title" value="{{old('title')}}">
                                @if ($errors->has('title'))
                                    <div class="alert alert-danger">{{ $errors->first('title') }}</div>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="start">Start</label>
                                <input type="date" name="start_date" class="form-control" id="start" value="{{old('start_date')}}">
                                @if ($errors->has('start_date'))
                                    <div class="alert alert-danger">{{ $errors->first('start_date') }}</div>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="finish">Finish</label>
                                <input type="date" name="finish_date" class="form-control" id="finish" value="{{old('finish_date')}}">
                                @if ($errors->has('finish_date'))
                                    <div class="alert alert-danger">{{ $errors->first('finish_date') }}</div>
                                @endif
                            </div>
                        </div>
                        </div>
                <div class="row">
                    <div class="col-md-2">
                        <input type="submit" class="btn btn-success" value="Add Event">
                    </div>
                </div>
            </div>
                {!! Form::close() !!}
            </div>
        <div class="panel panel-info">
            <div class="panel-heading">Events Calendar</div>
            <div class="panel-body">

                {!! $calendar_detalis->script() !!}
                {!! $calendar_detalis->calendar() !!}
            </div>
        </div>
    </div>
@endsection