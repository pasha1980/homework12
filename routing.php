<?php
require_once 'vendor/autoload.php';

$klein = new \Klein\Klein();
$map = [
    '/posts\/[\d+]/',
    '/post\/[\d+]/',
    '/user\/[\d+]/',
    '/user\/[\d+]\/\posts\/[\d+]/',
    '/^create$/',
    '/^authorization$/',
    '/^registration$/',
];

for ($i = 0; $i < count($map); $i++){   // ?????
    if(preg_match($map[$i], key($_GET))) {
        $a = 1;
        $i = count($map);
    }
}

if ($a) {

    $klein->respond('GET', '/posts/[:page]', function ($page) {
        $a = new App\Pages\Pages();
        $a -> showAllPosts($page->page);
    });

    $klein->respond( 'GET', '/post/[:id]', function ($id) {
        $a = new \App\Pages\Pages();
        $a -> showOnePost($id->id);
    });

    $klein->respond( 'GET', '/user/[:id]', function ($id) {
        $a = new \App\Pages\Pages();
        $a -> showUser($id->id);
    });

    $klein->respond( 'GET', '/user/[i:id]/posts/[i]', function ($id) {
        $a = new \App\Pages\Pages();

        $a -> usersPosts($id->id);
    });

    $klein->respond( 'GET', '/authorization', function () {
        $a = new \App\Pages\Pages();
        $a -> authorization('');
    });

    $klein->respond( 'GET', '/registration', function () {
        $a = new \App\Pages\Pages();
        $a -> registration(null);
    });

    $klein->respond( 'GET', '/create', function () {
        $a = new \App\Pages\Pages();
        $a -> createPost(0);
    });

    $klein->dispatch();

} elseif ($_SERVER['QUERY_STRING'] == '') {

    $b = new \App\Pages\Pages();
    $b -> home();

} else {

    $b = new \App\Pages\Pages();
    $b -> notFound();

}
