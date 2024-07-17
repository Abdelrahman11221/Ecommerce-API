<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Importing</title>
</head>
<body>
    @if (session('success'))
    <div class="alert alert-primary">
        {{ session('success') }}
        </div>
    @endif
    
    @if  ($errors->any())
        @foreach ($errors->all() as $error)
            {{$error}}
            <br>
        @endforeach
    @endif
    <form action="{{route('post_file')}}" method="post" enctype="multipart/form-data">
        @csrf
        <input type="file" name="file">
        <button type="submit">Upload</button>
    </form>
</body>
</html>