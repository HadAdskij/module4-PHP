<?php
require_once 'settings.php';
require_once 'includes.php';

if (isset($_POST['className']) && isset($_POST['id']))
{
    $commentsModel = new \Model\CommentsModel();

    if($_POST['className'] == 'addRate')
    {
        $rate = 1;
        $rate = $commentsModel->changeRate($_POST['id'], $rate);
        echo $rate[0]['rate'];
    }

    if($_POST['className'] == 'subRate')
    {
        $rate = -1;
        $rate = $commentsModel->changeRate($_POST['id'], $rate);
        echo $rate[0]['rate'];
    }
}

if (isset($_POST['tags'])){

    $ArticleModel = new \Model\ArticleModel();
    $tagsList = $ArticleModel->getTags($_POST['tags']);
    echo json_encode($tagsList);
}

if (isset($_POST['getReaders']))
{
    $ArticleModel = new \Model\ArticleModel();

    $readers = $ArticleModel->getReaders($_POST['getReaders'], $_POST['curr']);
    echo $readers;
}