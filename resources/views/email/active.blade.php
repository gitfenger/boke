<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>激活邮件</title>
</head>
<body>
    <p>尊敬的{{ $user->user_name }},感谢您注册我们的网站，请于24小时内激活您的账号，过期失效，<a href="http://www.boke.com/active?userid={{ $user->user_id }}&token={{ $user->token }}">激活链接</a></p>
</body>
</html>