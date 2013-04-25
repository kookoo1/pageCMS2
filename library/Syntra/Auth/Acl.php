<?php


class Syntra_Auth_Acl extends Zend_Controller_Plugin_Abstract {
    //put your code here
    
    public function preDispatch(\Zend_Controller_Request_Abstract $request) {
        
        // op welke 
        $acl = new Zend_Acl();
        
        
        $roles = array('GUEST','USER','ADMIN');// uitlzen normaal DB!!! case sensitive!!!
        
        $controllers = array('Users','index','page','error','noaccess','admin:index');
        
        
        foreach ($roles as $role ) {
            $acl->addRole($role);
        }
        
        foreach ($controllers as $controller) {
//            $acl->addResource($controller);// kan ook
            $acl->add(new Zend_Acl_Resource($controller));
        }
        
        
        $acl->allow('ADMIN');// acces to averything
        $acl->deny('USER');// acces to everything
        $acl->allow('USER','page');// user no acces to admin 
        $acl->allow('USER','index');// user no acces to admin 
        //$acl->allow('USER','Default-index');// user no acces to admin // dat werkt nog 
        $acl->allow('USER','Users');// user no acces to admin 
        $acl->allow('USER','noaccess');// user no acces to admin 
        
        Zend_Registry::set('Zend_Acl',$acl);
        
    }

}

?>
