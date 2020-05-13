<?php
session_start();
require_once 'vendor/autoload.php';
require_once 'config/doctrine.php';
$post_id = array_search('DELETE', $_POST);
$post = $em ->getReference(\App\Entity\Post::class, $post_id);
$em -> remove($post);
$em ->flush();
header("Location: user/" . $_SESSION['id']);
