<?php
/**
 * Created by PhpStorm.
 * User: anatolii
 * Date: 08.12.16
 * Time: 13:30
 */

namespace Controller;


use Model\ArticleModel;
use Model\CommentsModel;
use Model\AdvertModel;

class AdminController extends BaseController
{
    protected $name = 'Admin';

    public function addArticle($id)
    {
        if (!isset($_SESSION['admin']))
        {
            $this->render404();
            die();
        }
        $ArticleModel = new ArticleModel();

        if (isset($id) && $id)
            $this->data['modifyArticle'] = $ArticleModel->get($id);
        if (isset($_POST['Asubmit'])) {
            if(isset($id) && $id)
                $ArticleModel->modify($id);
            else
                $ArticleModel->addNew();
            $this->message = "Статтю було додано!";
            if (isset($id) && $id)
                $this->message = "Статтю було змінено!";
        }
        $this->render('addArticle');
    }

    public function addCategory()
    {

        if (!isset($_SESSION['admin']))
        {
            $this->render404();
            die();
        }

        if (isset($_POST['newCategorySubmit']) && $_POST['newCategory'])
        {
            $ArticleModel = new ArticleModel();
            $ArticleModel->addCategory($_POST['newCategory']);
            $this->message = "Категорію було додано";
        }
        $this->render('newCategory');
    }

    public function addAdvert(){
        if (!isset($_SESSION['admin']))
        {
            $this->render404();
            die();
        }

        if (isset($_POST['Adsubmit']))
        {
            $AdvertModel = new AdvertModel();
            $AdvertModel->addAdvert();
            $this->message = "Рекламу було додано!";
        }
        $this->render('addAdvert');
    }

    public function moderate(){
        if (!isset($_SESSION['admin']))
        {
            $this->render404();
            die();
        }
        $CommentsModel = new CommentsModel();
        if (isset($_POST['moderateSubmit']))
        {
            if(isset($_POST['checkboxesAllow']) && $_POST['checkboxesAllow'])
                foreach ($_POST['checkboxesAllow'] as $i)
                    $CommentsModel->allow($i);
            if(isset($_POST['checkboxesDelete']) && $_POST['checkboxesDelete'])
                foreach ($_POST['checkboxesDelete'] as $i)
                    $CommentsModel->delete($i);
        }
        $this->data['comments'] = $CommentsModel->getComments(0, 1);
        $this->render('comments');
    }

    public function changeColor($header){
        if (!isset($_SESSION['admin']))
        {
            $this->render404();
            die();
        }
        if (isset($_POST['colorSubmit']))
        {
            $filename = "View" . DS . "styles.css";
            $file = file_get_contents($filename);
            $pattern = "/white, #[a-fA-F0-9]+\);/";
            $replacement = "white, " . $_POST['colorSubmit'] . ");";
            if (isset($header) && $header) {
                $pattern = "/black, #[a-fA-F0-9]+\);/";
                $replacement = "black, " . $_POST['colorSubmit'] . ");";
            }
            $file = preg_replace($pattern, $replacement, $file);
            file_put_contents($filename, $file);
        }
        $this->data['header'] = $header;
        $this->render('changeColor');
    }
}