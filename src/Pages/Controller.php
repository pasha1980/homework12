<?php


namespace App\Pages;


use App\Entity\Post;

class Controller
{
    public function postsCount(int $id) :int
    {
        require 'config/doctrine.php';
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

    public function Title(int $post_id) :string
    {
        require 'config/doctrine.php';
        $postRepository = $em -> getRepository(Post::class);
        $posts = $postRepository -> findBy(['id' => $post_id]);
        $title = $posts[0] -> getTitle();
        return $title;
    }

    public function Text(int $post_id) :string
    {
        require 'config/doctrine.php';
        $postRepository = $em -> getRepository(Post::class);
        $posts = $postRepository -> findBy(['id' => $post_id]);
        $text = $posts[0] -> getText();
        return $text;
    }
}