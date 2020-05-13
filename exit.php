<?php
session_start();
$_SESSION = null;
//header('Location: /');
echo "Вы вышли со своего аккаунта. <br> <a href='/'>Вернуться на домашнюю страницу</a>";