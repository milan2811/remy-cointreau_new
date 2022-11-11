<!DOCTYPE html>
<html>
<head>
    <title>{{$title}}</title>
</head>
<body style="text-align:center">
    <h1>{{ $title }}</h1>
    <figure>
        <img src="data:image/png;base64, {!! $qrcode !!}" style="text-align:center">
    </figure>
    <div>
        <a href="{{$url}}">{{$url}}</a>
    </div>
</body> 
</html>