<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    <div>
        This is Registraion Confirmation Mail for {{ $email }}
    </div>
    <div>
        <p>
            Please confirm you registration by clicking on this
            <a href="{{ $url }}">link</a>
        </p>
    </div>


</body>

</html>
