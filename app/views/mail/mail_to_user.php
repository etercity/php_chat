<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<p>Вітаємо, <?=$_POST['name'] ?>!</p>
<p>Ви успішно зареєструвались в Чаті Друзів!</p>
<p>Збережіть цього листа, на випадок, якщо забудете логін або пароль</p>
<p>Ваш логін: <?=$_POST['login'] ?></p>
<p>Ваш пароль: <?=$_POST['password'] ?></p>
<p>З повагою, Адміністрація Чату Друзів</p>
</body>
</html>