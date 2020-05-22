<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Certificado Seguro Hogar</title>
</head>
<body>
    <h4>Certificado Correcto</h4>
    @foreach($info as $infos)
        <p>{{$infos->name}}</p>
        <p>{{$infos->rut}}</p>
    @endforeach
</body>
</html>