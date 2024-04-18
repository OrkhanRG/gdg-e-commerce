<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Xoş Gəldin</title>
</head>
<body>

<p>Salam {{ $user->name }}. Aramıza xoş gəldin!</p>

<p>Aşadakı linkə daxil olaraq emailinizi təsdiq edə bilərsiniz 😊</p>

<hr>

<center>
    <a href="{{ route('register.verify', ['token' => $token]) }}" style="color: red; text-decoration: none;">
        <b>Emailimi Təsdiqlə</b>
    </a>
</center>

</body>
</html>
