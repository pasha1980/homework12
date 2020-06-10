<?php


namespace App\Pages;


use App\Config;
use App\Entity\Post;
use App\Entity\User;

class Pages
{
    public function home() {
        session_start();
        $c = new Config();
        $twig = $c -> getTwig();
        if (isset($_SESSION['id'])){
            $legal = 1;
            $id = $_SESSION['id'];
        } else {
            $legal = 0;
            $id = null;
        }
        echo $twig -> render('index.html.twig', [
            'title' => '- Главная',
            'legal' => $legal,
            'id' => $id,
        ]);
    }
    public function authorization(?string $warning) {
        $c = new Config();
        $twig = $c -> getTwig();
        echo $twig -> render('user_authorization.html.twig', [
            'title' => '- Авторизация',
            'warning' => $warning,
        ]);
    }

    public function showUser($id) {
        session_start();
        $c = new Config();
        $twig = $c -> getTwig();
        $a = new Controller();
        $user = $a -> getUser($id);
        $postsCount = $a ->postsCount($id);
        if (isset($user)) {
            $exist = 1;
        } else {
            $exist = 0;
        }
        if ($_SESSION['id'] == $id) {
            $postsCount = $a ->postsCount($id);
            echo $twig -> render('user.html.twig', [
                'title' => '- Пользователь',
                'name' => $_SESSION['name'],
                'email' => $_SESSION['email'],
                'postCount' => $postsCount,
                'id' => $id,
                'legal' => 1,
                'exist' => $exist,
            ]);
        } else {
            echo $twig -> render('user.html.twig', [
                'title' => '- Пользователь',
                'name' => $user['name'],
                'email' => $user['email'],
                'postCount' => $postsCount,
                'id' => $id,
                'legal' => 0,
                'exist' => $exist,
            ]);
        }
    }

    public function registration (?string $warning) {
        $c = new Config();
        $twig = $c -> getTwig();
        echo $twig -> render('user_registration.html.twig', [
           'title' => '- Регистриция',
           'warning' => $warning,
        ]);
    }

    public function usersPosts (int $id, int $page) {
        session_start();
        if (isset($_SESSION['id'])){
            $legal = 1;
        } else {
            $legal = 0;
        }
        $c = new Config();
        $twig = $c -> getTwig();
        $em = $c -> getEntityManager();

        $userRep = $em -> getRepository(User::class);
        $user = $userRep -> find($id);
        $username = $user -> getName();

        $a = new Controller();
        $data = $a -> getPostData();
        $usersPosts = [];
        for ($i = 0; $i < count($data); $i++){
            if ($data[$i]['username'] == $username){
                array_push($usersPosts, $data[$i]);
            }
        }
        $i = ($page - 1) * 3;
        $b = ((count($usersPosts))/3);
        $pageCount = (ceil($b));
        if (($pageCount-$b)<(1/2) && ($pageCount-$b) != 0){
            $leavePosts = 2;
        } elseif (($pageCount-$b)>(1/2)){
            $leavePosts = 1;
        } else {
            $leavePosts = 3;
        }
        echo $twig -> render ('user_posts.html.twig', [
            'title' => '- Все посты',
            'legal' => $legal,
            'id1' => $usersPosts[$i]['id'],
            'postTitle1' => $usersPosts[$i]['title'],
            'text1' => $usersPosts[$i]['text'],
            'id2' => $usersPosts[($i+1)]['id'],
            'postTitle2' => $usersPosts[($i+1)]['title'],
            'text2' => $usersPosts[($i+1)]['text'],
            'id3' => $usersPosts[($i+2)]['id'],
            'postTitle3' => $usersPosts[($i+2)]['title'],
            'text3' => $usersPosts[($i+2)]['text'],
            'next' => ($page+1),
            'previous' => ($page-1),
            'page' => $page,
            'pageCount' => $pageCount,
            'postsToLeave' => $leavePosts,
            'id' => $id
        ]);
    }

    public function createPost (int $warning) {
        session_start();
        $c = new Config();
        $twig = $c -> getTwig();
        if (isset($_SESSION['id']) && $_SESSION['legal'] == 1 ) {
            echo $twig -> render ('post_create.html.twig', [
                'title' => '- Создание поста',
                'warning' => $warning,
                'id' => $_SESSION['id'],
                'legal' => 1,
            ]);

        } else {
            echo 'Пожалуйста, авторизуйтесь';
        }
    }

    public function showOnePost (int $post_id) {
        session_start();
        if (isset($_SESSION['id'])){
            $legal = 1;
        } else {
            $legal = 0;
        }
        $c = new Config();
        $twig = $c -> getTwig();
        $a = new Controller();
        $isPostExist = $a ->isExist($post_id, 'post');
        if ($isPostExist){
            $title = $a -> title($post_id);
            $text = $a -> text($post_id);
            $legacy = $a -> legacy($post_id);
            $whose = $a -> whosePost ($post_id);
            $owner_id = $a ->ownerId ($post_id);
            echo $twig -> render ('post.html.twig', [
                'title' => '- Пост',
                'legal' => $legal,
                'postTitle' => $title,
                'postText' => $text,
                'id' => $_SESSION['id'],
                'postId' => $post_id,
                'legalToDelete' => $legacy,
                'isPostExist' => true,
                'username' => $whose,
                'ownerId' => $owner_id,
            ]);
        } else {
            $title = '';
            $text = '';
            $legacy = false;
            $whose = '';
            $owner_id = null;
            echo $twig -> render ('post.html.twig', [
                'title' => '- Пост',
                'legal' => $legal,
                'postTitle' => $title,
                'postText' => $text,
                'id' => $_SESSION['id'],
                'postId' => $post_id,
                'legalToDelete' => $legacy,
                'isPostExist' => false,
                'username' => $whose,
                'ownerId' => $owner_id,
             ]);
        }

    }

    public function showAllPosts ($page) {
        session_start();
        if (isset($_SESSION['id'])){
            $legal = 1;
        } else {
            $legal = 0;
        }
        $c = new Config();
        $twig = $c -> getTwig();
        $a = new Controller();
        $data = $a -> getPostData();
        $i = ($page - 1) * 3;
        $b = ((count($data))/3);
        $pageCount = ceil($b);
        if (($pageCount-$b)<(1/2) && ($pageCount-$b) != 0){
            $leavePosts = 2;
        } elseif (($pageCount-$b)>(1/2)){
            $leavePosts = 1;
        } else {
            $leavePosts = 3;
        }
        echo $twig -> render ('post_all.html.twig', [
            'title' => '- Все посты',
            'legal' => $legal,
            'id1' => $data[$i]['id'],
            'postTitle1' => $data[$i]['title'],
            'text1' => $data[$i]['text'],
            'username1' => $data[$i]['username'],
            'id2' => $data[($i+1)]['id'],
            'postTitle2' => $data[($i+1)]['title'],
            'text2' => $data[($i+1)]['text'],
            'username2' => $data[($i+1)]['username'],
            'id3' => $data[($i+2)]['id'],
            'postTitle3' => $data[($i+2)]['title'],
            'text3' => $data[($i+2)]['text'],
            'username3' => $data[($i+2)]['username'],
            'next' => ($page+1),
            'previous' => ($page-1),
            'page' => $page,
            'pageCount' => $pageCount,
            'postsToLeave' => $leavePosts,
            'id' => $_SESSION['id'],
        ]);
    }

    public function notFound () {
        $c = new Config();
        $twig = $c -> getTwig();
        echo $twig -> render ('page404.html.twig', [
            'title' => '- Страница не найдена',
        ]);
    }
}