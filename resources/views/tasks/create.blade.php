@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Add New Task</h3>
                </div>
                <div class="panel-body">
                    {!! Form::open(['route' => 'tasks.store']) !!}
                    <div class="form-group">
                        <input type="text" class="form-control" name="title" placeholder="Title" value="{{old('title')}}">
                        @if ($errors->has('title'))
                            <div class="alert alert-danger">{{ $errors->first('title') }}</div>
                        @endif
                    </div>
                    <div class="form-group">
                        <textarea name="content" rows="5" class="form-control" placeholder="Description...">{{old('content')}}</textarea>
                    </div>
                    <div class="form-group">
                        <input type="date" name="deadline" class="form-control" value="{{old('deadline')}}">
                        @if ($errors->has('deadline'))
                            <div class="alert alert-danger">{{ $errors->first('deadline') }}</div>
                        @endif
                    </div>
                    <div class="form-group">
                        <input type="submit" class="btn btn-success" value="Add">
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection