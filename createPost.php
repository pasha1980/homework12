<?php
session_start();
require_once 'config/doctrine.php';
require_once 'vendor/autoload.php';
$title = $_POST['title'];
$text = $_POST['text'];

$page = new \App\Pages\Pages();
$date = new DateTime('now');

$userRepository = $em ->getRepository(\App\Entity\User::class);
$userMassive = $userRepository->findBy(['name' => $_SESSION['name']]);

$postRepository = $em -> getRepository(\App\Entity\Post::class);
$probe = $postRepository -> findBy(['title' => $title]);

$warning = 0;

if ($probe == null) {

    $post = new \App\Entity\Post();
    $user = $userMassive[0];
    $post -> setUsers($user);
    $post -> setTitle($title);
    $post -> setText($text);
    $post -> setUdatedAt($date);
    $post -> setCratedAt($date);
    $em -> persist($post);
    $em -> flush();

    $warning = 1;
    $page -> createPost($warning);

} else {
    $warning = 2;
    $page -> createPost($warning);
}

