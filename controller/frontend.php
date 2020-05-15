<?php

require('model/frontend.php');
/*
Exemple de function controller
function listPosts()
{
    $posts = getPosts();

    require('view/frontend/listPostsView.php');
}

function post()
{
    $post = getPost($_GET['id']);
    $comments = getComments($_GET['id']);

    require('view/frontend/postView.php');
}

function addComment($postId, $author, $comment)
{
    $affectedLines = postComment($postId, $author, $comment);

    if ($affectedLines === false) {
        die('Impossible d\'ajouter le commentaire !');
    }
    else {
        header('Location: index.php?action=post&id=' . $postId);
    }
}
*/
function error()
{
    require('view/frontend/error.php');
}

function faq()
{
    require('view/frontend/faq.php');
}

function contactus()
{
    require('view/frontend/nousContacter.php');
}

function professionnel()
{
    require('view/frontend/professionnel.php');
}

function main()
{
    require('view/frontend/main.php');
}

function sav()
{
    require('view/frontend/SAV.php');
}
function cgu()
{
    require('view/frontend/CGU.php');
}
function envoiMail()
{

    require('view/frontend/envoiMail.php');
}
function patienter()
{
    require('view/frontend/patienter.php');
}

function menu()
{
    $menu = MenuConnected();
    require("view/frontend/menu.php");
}
function logout()
{
    logoutUser();
    header("location:index.php");
}
function login()
{
    if (isConnected()) {

        redirect();
    } else {
        $resultat = loginM();
        require("view/frontend/login.php");
    }
}

function redirect()
{
    profilRedirect();
}
