<?php

class UsersController extends Zend_Controller_Action {

    public function init() {
        /* Initialize action controller here */
    }

    public function indexAction() {
        // action body
    }

    public function loginAction() {
        $loginForm = new Application_Form_Login();
        $this->view->form = $loginForm;

        if ($this->getRequest()->getPost()) {
            $postParams = $this->getRequest()->getPost(); // $_POST

            if ($this->view->form->isValid($postParams)) {
                $params = $this->view->form->getValues();

                $auth = Zend_Auth::getInstance();

                // meegeven welke database driver we gebruiken
                $authAdapter = new Zend_Auth_Adapter_DbTable(Zend_Registry::get('db'));

                // login
                $authAdapter->setTableName('users')
                        ->setIdentityColumn('username')
                        ->setCredentialColumn('password')
                        ->setIdentity($params['login'])
                        ->setCredential($params['password']);

                // login uitvoeren
                $result = $auth->authenticate($authAdapter);

                if ($result->isValid()) {
                    //die('ingelogged');
                    echo 'U bent ingelogged!';
                } else {
                    //die('fout');
                    // alle foutmeldingen weergeven op het scherm
                    foreach ($result->getMessages() as $message) {
                        echo $message;
                        echo '<br>';
                    }
                }
            }
        }
    }

    public function logoutAction() {
        Zend_Auth::getInstance()->clearIdentity();
        $redirector = Zend_Controller_Action_HelperBroker::getStaticHelper('redirector');
        $locale = Zend_Registry::get('Zend_Locale');
//        var_dump($locale);
        $url = '/' . $locale . '/login';
 //       var_dump($url);
        //die;
//        $redirector->redirector('/nl_BE/login');
        $redirector->redirector($url);
    }

}

