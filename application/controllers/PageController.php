<?php

class PageController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        // action body
        $locale = Zend_Registry::get('Zend_Locale');
//        $lang = $this->getParam('lang'); // andere manier om var op te halen
        $slug =$this->getParam('slug');
        
        $pageModel = new Application_Model_Page();
        $page = $pageModel->getPage($locale, $slug);
        $this->view->page = $page;
        //var_dump($this->getAllParams());
    }


}

