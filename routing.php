<?php
require_once 'vendor/autoload.php';

$klein = new \Klein\Klein();
$map = [
    '/^posts$/',
    '/post\/[\d+]/',
    '/user\/[\d+]/',
    '/user\/[\d+]\/\posts/',
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

    $klein->respond('GET', '/posts', function () {
        $a = new App\Pages\Pages();
        $a -> showAllPosts();
    });

    $klein->respond( 'GET', '/post/[i:id]', function ($id) {
        $a = new \App\Pages\Pages();
        $a -> showOnePost($id->id);
    });

    $klein->respond( 'GET', '/user/[:id]', function ($id) {
        $a = new \App\Pages\Pages();
        $a -> showUser();
    });

    $klein->respond( 'GET', '/user/[:id]/posts', function () {
        $a = new \App\Pages\Pages();
        $a -> usersPosts();
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
