<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Test Create Page</title>
</head>

<body>
    <form action="{{route('test.store')}}" method="POST">
        @csrf
        <div>
            <label for="title">Title : </label>
            <input type="text" name="title" id="title" required>
            <label for="title">Description : </label>
            <input type="text" name="description" id="description" required>
            <button type="submit">Create!</button>
        </div>
    </form>
</body>

</html>