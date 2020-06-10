<?php


namespace App\Pages;

use App\Entity\Post;
use App\Entity\User;

class Controller
{
    public function postsCount(int $id) :int
    {
        $b = new \App\Config();
        $em = $b -> getEntityManager();
        $postRepository = $em -> getRepository(Post::class);
        $posts = $postRepository -> findAll();
        $count = 0;
        foreach ($posts as $value) {
            $users = $value -> getUsers();
            $users_id = $users -> getId();
            if ($users_id == $id){
                $count = $count + 1;
            }
        }
        return $count;
    }

    public function title(int $post_id) :string
    {
        $b = new \App\Config();
        $em = $b -> getEntityManager();
        $postRepository = $em -> getRepository(Post::class);
        $posts = $postRepository -> findBy(['id' => $post_id]);
        $title = $posts[0] -> getTitle();
        return $title;
    }

    public function text(int $post_id) :string
    {
        $b = new \App\Config();
        $em = $b -> getEntityManager();
        $postRepository = $em -> getRepository(Post::class);
        $posts = $postRepository -> findBy(['id' => $post_id]);
        $text = $posts[0] -> getText();
        return $text;
    }

    public function legacy(int $post_id) :bool
    {
        session_start();
        $b = new \App\Config();
        $em = $b -> getEntityManager();
        $legal = false;
        if ($_SESSION['legal'] == 1){
            $postRep = $em -> getRepository(Post::class);
            $posts = $postRep -> find($post_id);
            $user = $posts -> getUsers();
            $user_id = $user -> getId();
            if ($_SESSION['id'] == $user_id){
                $legal = true;
            } else {
                $legal = false;
            }
        }
        return $legal;
    }

    public function isExist (int $id, string $who) :bool
    {
        $b = new \App\Config();
        $em = $b -> getEntityManager();
        $isExist = false;
        if ($who == 'post'){
            $postRep = $em -> getRepository(Post::class);
            $posts = $postRep -> find($id);
            if (isset($posts)) {
                $isExist = true;
            }
        } elseif ($who == 'user'){
            $userRep = $em -> getRepository(User::class);
            $users = $userRep -> find($id);
            if (isset($users)) {
                $isExist = true;
            }
        }
        return $isExist;
    }

    public function whosePost (int $post_id) :string
    {
        $b = new \App\Config();
        $em = $b -> getEntityManager();
        $postRep = $em -> getRepository(Post::class);
        $userRep = $em -> getRepository(User::class);
        $posts = $postRep -> find($post_id);
        $user1 = $posts -> getUsers();
        $user_id = $user1 -> getId();
        $user2 = $userRep -> findBy(['id' => $user_id]);
        $username = $user2[0] -> getName();
        return $username;
    }

    public function getUser(int $id) :?array
    {
        $b = new \App\Config();
        $em = $b -> getEntityManager();
        $isExist = $this ->isExist($id, 'user');
        if ($isExist){
            $userRep = $em -> getRepository(User::class);
            $users = $userRep -> find($id);
            $user['name'] = $users -> getName();
            $user['email'] = $users -> getEmail();
        } else {
            $user = null;
        }
        return $user;
    }

    public function getPostData() :array
    {
        $b = new \App\Config();
        $em = $b -> getEntityManager();
        $data = [];
        $postRep = $em -> getRepository(Post::class);
        $posts = $postRep -> findAll();
        for ( $i = 0; $i < count($posts); $i++) {
            $title = $posts[$i] -> getTitle();
            $text = $posts[$i] -> getText();
            $post_id = $posts[$i] -> getId();
            $username = $this -> whosePost($post_id);
            $inter = [
                'title' => $title,
                'text' => $text,
                'id' => $post_id,
                'username' => $username,
            ];
            array_push($data, $inter);
        }
        return $data;
    }

    public function ownerId($post_id) :int
    {
        $b = new \App\Config();
        $em = $b -> getEntityManager();
        $postRep = $em -> getRepository(Post::class);
        $posts = $postRep -> find($post_id);
        $user1 = $posts -> getUsers();
        $user_id = $user1 -> getId();
        return $user_id;
    }

}