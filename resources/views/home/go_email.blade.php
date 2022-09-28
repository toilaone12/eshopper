<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TechNews</title>
</head>
<body>
    <span>
        Chào bạn {{$email}}, chúng tôi đến từ EShopper.</br>
        Và đây là {{$name}} và bạn có thông báo {{$body}}. Hãy
        <a href="{{route('home.changePass',['email' => $email])}}">ấn vào đây để thay đổi mật khẩu</a>
    </span>
</body>
</html>