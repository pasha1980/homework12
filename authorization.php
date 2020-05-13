<?php
session_start();
$legal = 0;
require_once 'vendor/autoload.php';
$b = new \App\Config();
$em = $b -> getEntityManager();
$userRepository = $em ->getRepository(\App\Entity\User::class);
$obj = $userRepository->findBy(['email' => $_POST['email']]);

if (!isset($obj[0])){
    $page = new \App\Pages\Pages();
    $page -> authorization('Такого пользователя не существует');
} else {
    $hash = $obj[0] -> getPassword();
    if (!password_verify($_POST['password'], $hash)) {
        $page = new \App\Pages\Pages();
        $page -> authorization('Пароль неверен');
    } else {
        $legal = 1;
        $email = $obj[0] -> getEmail();
        $name = $obj[0] -> getName();
        $id = $obj[0] -> getId();
        $hash = null;
        $_SESSION['id'] = $id;
        $_SESSION['name'] = $name;
        $_SESSION['email'] = $email;
        $_SESSION['legal'] = $legal;
        $date = new DateTime('now');
        $user = $em->find('\App\Entity\User', $id);
        $user -> setUdatedAt($date);
        $em->flush();
        header("Location: user/" . $id);
    }
}
$_SESSION['legal'] = $legal;
