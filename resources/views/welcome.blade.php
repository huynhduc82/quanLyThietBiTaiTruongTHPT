<!DOCTYPE html>
<html lang="">
<head>
    <title>Laravel</title>
</head>
@section('sidebar')
    <h1>Sidebar</h1>
    <img src="{{ $type->imagesInfo->url }}" alt="" style="height: 300px"/>
@show

@yield('content')

</html>
