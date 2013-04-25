<?php

class Syntra_Controller_Plugin_Navigation extends Zend_Controller_Plugin_Abstract {

    //put your code here


    public function preDispatch(\Zend_Controller_Request_Abstract $request) {



        /* cache aanmaken */

        $frontendoptions = array(
            'lifetime' => 3600, //1 uur in de cahe
            'automatic_serialization' => true
        );
        $backendoptions = array(
//            'cache_dir' => realpath('/cache')  // ophalen van volldige path tem public html ==> hiermee werkt op ieder systeem
            'cache_dir' => APPLICATION_PATH . '/../cache'  // ophalen van volldige path tem public html ==> hiermee werkt op ieder systeem
        );

        $cache = Zend_Cache::factory('Core', 'File', $frontendoptions, $backendoptions);

        /* einde cache definieren */


        //inladen van de cache met de file 'navigation'
        if (($result = $cache->load('navigation')) === false) {

            // deze bestaat niet

            $locale = Zend_Registry::get('Zend_Locale');
            $model = new Application_Model_Page();
            $pages = $model->getMenu($locale);

            $container = new Zend_Navigation();

            foreach ($pages as $page) {

                $menu = new Zend_Navigation_Page_Mvc(
                                array('label' => $page['title'],
                                    //'controller' => 'index',
                                    'route' => 'page', // de route om mooiere URL te maken
                                    'params' => array('slug' => $page['slug'],
                                        'lang' => $locale)));

                $container->addPage($menu);
            }

            $cache->save($container, 'navigation');
        } else {

            $container = $result;
            //echo 'we zitten inde cache';
        }

        Zend_Registry::set('Zend_Navigation', $container);
    }

}

?>
