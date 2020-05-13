<?php
session_start();
require_once 'vendor/autoload.php';
$b = new \App\Config();
$em = $b -> getEntityManager();
$post_id = array_search('DELETE', $_POST);
$post = $em ->getReference(\App\Entity\Post::class, $post_id);
$em -> remove($post);
$em ->flush();
header("Location: user/" . $_SESSION['id']);
