<?php


namespace App\Pages;


use App\Entity\Post;
use App\Entity\User;

class Pages
{
    public function home() {
        session_start();
        require_once 'config/twig.php';
        echo $twig -> render('index.html.twig', [
            'title' => '- Главная',
            'legal' => $_SESSION['legal'],
            'id' => $_SESSION['id'],
        ]);
    }

    public function showUser() {
        session_start();
        require_once 'config/twig.php';
        $a = new Controller();
        $postsCount = 0;
        $postsCount = $a ->postsCount($_SESSION['id']);
        if ($_SESSION['legal'] == 1) {
            echo $twig -> render('user.html.twig', [
                'title' => '- Пользователь',
                'name' => $_SESSION['name'],
                'email' => $_SESSION['email'],
                'postCount' => $postsCount,
                'id' => $_SESSION['id'],
                'legal' => $_SESSION['legal'],
            ]);
        } else {
            echo 'Пожалуйста, авторизуйтесь';
        }
    }

    public function authorization (?string $warning) {
        require_once 'config/twig.php';
        echo $twig -> render ('user_authorization.html.twig', [
            'title' => '- Авторизация',
            'warning' => $warning,
        ]);
    }

    public function registration (?string $warning) {
        require_once 'config/twig.php';
        echo $twig -> render('user_registration.html.twig', [
           'title' => '- Регистриция',
           'warning' => $warning,
        ]);
    }

    public function usersPosts () {
        session_start();
        require_once 'config/twig.php';
        echo $twig -> render('user_posts.html.twig', [
            'title' => '- Посты юзера',
            'legal' => $_SESSION['legal'],
        ]);
    }

    public function createPost (int $warning) {
        session_start();
        require_once 'config/twig.php';
        if ($_SESSION['legal'] == 1) {
            echo $twig -> render ('post_create.html.twig', [
                'title' => '- Создание поста',
                'warning' => $warning,
                'id' => $_SESSION['id'],
            ]);

        } else {
            echo 'Пожалуйста, авторизуйтесь';
        }
    }

    public function showOnePost (int $post_id) {
        session_start();
        require_once 'config/twig.php';
        $a = new Controller();
        $title = $a -> Title($post_id);
        $text = $a -> Text($post_id);
        echo $twig -> render ('post.html.twig', [
            'title' => '- Пост',
            'legal' => $_SESSION['legal'],
            'postTitle' => $title,
            'postText' => $text,
            'id' => $_SESSION['id'],
        ]);
    }

    public function showAllPosts () {
        session_start();
        require_once 'config/twig.php';
        echo $twig -> render ('post_all.html.twig', [
            'title' => '- Все посты',
            'legal' => $_SESSION['legal'],
        ]);
    }

    public function notFound () {
        require_once 'config/twig.php';
        echo $twig -> render ('page404.html.twig', [
            'title' => '- Страница не найдена',
        ]);
    }
}