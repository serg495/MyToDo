<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <title>All Users View</title>
</head>
<body>
    <div class="container">
        <a class="btn btn-success btn-block" href="{{route('users.create')}}">Create new user</a>
    <table align="center" class="table table-striped">
        <thead class="thead-dark">
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Name</th>
            <th scope="col">E-Mail</th>
            <th scope="col">Address</th>
            <th scope="col">Telephone</th>
            <th scope="col">Avatar</th>
            <th scope="col">Operations</th>
        </tr>
        </thead>
        <tbody>
        @foreach($users as $user)
            <tr>
                <th scope="row">{{$user->id}}</th>
                <td>{{$user->name}}</td>
                <td>{{$user->email}}</td>
                <td>{{$user->address}}</td>
                <td>{{$user->phone_number}}</td>
                <td><img width="50" src="{{$user->getAvatar()}}" alt="" class="rounded"></td>
                <td style="display: flex">
                        <a href="{{route('users.edit', $user->id)}}" class="btn btn-info">Edit</a>
                        {{Form::open(['route' => ['users.destroy', $user->id], 'method' => 'delete'])}}
                        <button onclick="return confirm('Вы уверенны?')" type="submit" class="btn btn-danger">Delete
                        </button>
                        {{Form::close()}}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    </div>
</body>
</html>