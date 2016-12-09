<?php

namespace Controller;


use Model\AdvertModel;
use Model\ArticleModel;

class BaseController
{
    protected $name = 'Index';

    protected $layout = 'default';

    /* data for views */
    protected $data;

    protected $message;


    public function __construct($mess)
    {
        $ArticleModel = new ArticleModel();
        $AdvertModel = new AdvertModel();
        $this->data['sidebar'] = $ArticleModel->getLast(NB_SDBAR);
        $this->data['sidebarLeft'] = $ArticleModel->getHot(NB_SDBAR);
        $this->data['categories'] = $ArticleModel->getCategoryList();
        $this->data['advert'] = $AdvertModel->getAdvert();
        $this->data['random'] = mt_rand(5454123512, 13245544512);
        $this->message = $mess;
    }

    protected function render($templateName) {

        $data = $this->data;
        $message = $this->message;

        ob_start();
        include SITE_DIR . DS. "View" .DS . $this->name . DS. $templateName . '.php';
        $content = ob_get_clean();

        include SITE_DIR . DS. "View" .DS . "Layout" .DS . $this->layout .'.php';
    }

    function render404() {

        $data = $this->data;
        $message = $this->message;

        ob_start();
        include SITE_DIR . DS. "View" .DS .'404.php';
        $content = ob_get_clean();

        include SITE_DIR . DS. "View" .DS . "Layout" .DS . $this->layout .'.php';
    }
}