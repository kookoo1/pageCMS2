<?php


class Syntra_Controller_Plugin_Translate extends Zend_Controller_Plugin_Abstract {
    //put your code here
    
    public function preDispatch(Zend_Controller_Request_Abstract $request) {
        $lang = $request->getParam('lang');
        if (empty($lang)) {
            $lang = 'nl_BE';
        } else {
            $lang = $request->getParam('lang');
        }
        
        
        $locale = new Zend_Locale($lang);
        // maak beschikbaar voor alle componentn en overal beschikbaar
        Zend_Registry::set('Zend_Locale',$locale);
        
        
        $translate = new Zend_Translate('array',  array('yes' =>'ja'),$locale);// een vuile truck, gewoon aray verwacht één item!!!
        
        // hier éénx uit de DB lezen!!!
//        if ($cache === true) {
//            
//        }
        
        
        // dit wordt nog in de cash gestopt !!!
        $model = new Application_Model_Translation();
        // haal alle vertalingen op voor de huidige locale
        $translations = $model->getTranslationByLocale($locale);
        
        // alle vertalingen toevogen aan het translate object
        foreach ($translations as $translation) {
            $t = array($translation->tag => $translation->translation);
            $translate->addTranslation($t,$locale);
        }
        // maak overal beschikbaar, ook voor zend
        Zend_Registry::set('Zend_Translate', $translate); // trukje heel handig!!!
    }
}

?>
