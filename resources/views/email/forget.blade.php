<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>密码找回</title>
</head>
<body>
    <p>尊敬的{{ $user->user_name }},请点击 <a href="http://www.boke.com/reset?uid={{ $user->user_id }}&token={{ $user->token }}">链接</a> ，重置您的密码</p>
</body>
</html>