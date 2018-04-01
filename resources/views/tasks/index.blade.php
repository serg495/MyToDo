@extends('layouts.app')

@section('content')
    <div class="container">
        @include('tasks._navbar')
        <div class="row">
            <div class="col-md-8">
                @foreach($tasks as $task)
                    @if($task->status)
                        <div class="panel panel-success">
                            @elseif($task->deadline < \Carbon\Carbon::now())
                                <div class="panel panel-danger">
                                    @else
                                        <div class="panel panel-info">
                                            @endif
                                            <div style="display: flex; justify-content: space-between"
                                                 class="panel-heading">
                                                <h3 class="panel-title">{{$task->title}}</h3>
                                                <h3 class="panel-title">{{$task->getDiffDates()}}</h3>
                                            </div>
                                            @if($task->content)
                                                <div class="panel-body">
                                                    {{$task->content}}
                                                </div>
                                            @endif
                                            @if(!$task->status)
                                                <div style="display: flex" class="panel-footer">
                                                    <a class="btn btn-info" href="{{route('tasks.edit', $task->id)}}"><i
                                                                class="fa fa-pencil"></i></a>
                                                    {{Form::open(['route' => ['tasks.destroy', $task->id], 'method' => 'delete'])}}
                                                    <button onclick="return confirm('Вы уверенны?')" type="submit"
                                                            class="btn btn-danger">
                                                        <i class="fa fa-remove"></i>
                                                    </button>
                                                    {{Form::close()}}
                                                    <a class="btn btn-success" href="{{route('toggle', $task->id)}}"><i
                                                                class="fa fa-check"></i></a>
                                                </div>
                                            @endif
                                        </div>
                                        @endforeach
                                        {{$tasks->links()}}
                                </div>
                        </div>
            </div>
@endsection

