<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Test Page</title>
</head>

<body>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Description</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($tests as $data)
            <tr id="test{{$data->id}}">
                <td>{{$data->id}}</td>
                <td>{{$data->title}}</td>
                <td>{{$data->description}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <a href="{{route('test.create')}}">Create</a>
</body>

</html>