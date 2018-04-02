
<div class="col-md-3">
    <div class="list-group">
        <a href="{{route('tasks.index')}}" class="list-group-item">All </a>
        <a href="{{route('tasks.active')}}" class="list-group-item">Personal <span class="badge">{{$activePersonalCount}}</span> </a>
        <a href="{{route('tasks.external')}}" class="list-group-item">External <span class="badge">{{$activeExternalCount}}</span></a>
        <a href="{{route('tasks.complete')}}" class="list-group-item">Completed</a>
    </div>
</div>