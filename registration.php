<?php
session_start();
$legal = 0;
require_once 'config/doctrine.php';
require_once 'vendor/autoload.php';
$probe = null;
$userRepository = $em -> getRepository(\App\Entity\User::class);
$probe = $userRepository->findBy(['email' => $_POST['email']]);

if ($_POST['password1'] != $_POST['password2']){
    $page = new \App\Pages\Pages();
    $page -> registration("Пароли не совпадают");
    $_POST['password1'] = null;
    $_POST['password2'] = null;

} elseif ($probe[0] != null) {
    $page = new \App\Pages\Pages();
    $page -> registration("Пользователь с таким email уже существует");
    $_POST['password1'] = null;
    $_POST['password2'] = null;

} else {
    $legal = 1;
    $hash = password_hash($_POST['password1'], 3);
    $_POST['password1'] = null;
    $_POST['password2'] = null;
    $date = new DateTime('now');
    $user = new \App\Entity\User();
    $user ->setCratedAt($date);
    $user ->setUdatedAt($date);
    $user ->setPassword($hash);
    $user ->setEmail($_POST['email']);
    $user ->setName($_POST['name']);
    $em->persist($user);
    $em->flush();
    $newUserRep = $em -> getRepository(\App\Entity\User::class);
    $newUser = $newUserRep->findBy(['email' => $_POST['email']]);
    $id = $newUser[0] -> getId();
    $_SESSION['id'] = $id;
    $_SESSION['name'] = $_POST['name'];
    $_SESSION['email'] = $_POST['email'];
    $_SESSION['legal'] = $legal;
    header("Location: user/" . $id);
}
$_SESSION['legal'] = $legal;
