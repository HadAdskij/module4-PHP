<?php

namespace Controller;


use Model\ArticleModel;
use Model\CommentsModel;

class IndexController extends BaseController
{


    public function index() {
        $ArticleModel = new ArticleModel();
        foreach ($this->data['categories'] as $i)
            $this->data[$i['category']] = $ArticleModel->getLast(5, $i['category']);
        $analitic = "@@@@@1";
        $i = 0;
        $this->data['analitic'] = $ArticleModel->search($analitic, $i);
        $this->render("main");
    }

    public function search($parameters)
    {
        $ArticleModel = new ArticleModel();
        $this->data['articles'] = $ArticleModel->search($parameters, $number);
        $this->data['number'] = $number;
        $this->data['parameters'] = $parameters;
        $this->render("search");
    }

    public function article($id)
    {
        $ArticleModel = new ArticleModel();
        $CommentsModel = new CommentsModel();
        $this->data['article'] = $ArticleModel->get($id);
        if (!$this->data['article']['analitics'] || ($this->data['article']['analitics'] && isset($_SESSION['user']))) {
            $this->data['currentReaders'] = rand(0, 5);

            if(isset($_POST['addComment']) && $_POST['commentText'])
            {
                $moderated = 1;
                if ($this->data['article']['category'] == 'Політика')
                    $moderated = 0;
                $CommentsModel->addComment($_POST['answerto'], $_POST['commentText'], $this->data['article']['id'], $moderated);
                if ($moderated)
                    $this->message = "Ваш коментар було додано!";
                else
                    $this->message = "Ваш коментар буде додано після перевірки модератором!";
            }

            if(isset($_POST['modifySubmit']) && $_POST['modifiedText'])
            {
                $CommentsModel->modifyComment($_POST['modifiedText'], $_POST['id']);
                $this->message = "Ваш коментар було змінено!";
            }
            $this->data['comments'] = $CommentsModel->getComments($id, 0);
            $this->render("article");
        }
        else
        {
            $this->render("analitic");
        }
    }
}