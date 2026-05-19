<?php
session_start();

//vider et detruire la session
$_SESSION = [];
session_destroy();

//supprimer le cookie avec exactement les memes options qu'a la creation
setcookie('nisca_user', '', [
    'expires'  => time() - 3600,
    'path'     => '/',
    'httponly' => true,
    'samesite' => 'Lax',
]);

header('Location: ../index.php');
exit();
