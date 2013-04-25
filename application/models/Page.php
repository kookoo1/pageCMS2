<?php

class Application_Model_Page extends Zend_Db_Table_Abstract
{


    protected $_name = "page";
    protected $_primary = "id";
    
    const MENU_VISIBLE = 1;
    const MENU_INVISIBLE = 0;
    
    const STATUS_ONLINE = 1;
    const STATUS_OFFLINE = 0;
    
    
    
    /**
     * get the navigation by locale, visibitlity and status
     * @param Zend_Locale $locale
     * @return Zend_Db_Table_Rowset
     */
    public function getMenu($locale){
        
        $select = $this->select()
                ->where('menu = ?',self::MENU_VISIBLE)
                ->where('status =?',  self::STATUS_ONLINE)
                ->where('locale =?',$locale)
                ->order('sort');
        $result = $this->fetchAll($select);
        return $result;
    }
    
    
   /**
     * get the page by slug and locale
    * 
     * @param Zend_Locale $locale
    * @param string $slug
     * @return Zend_Db_Table_Rowset
     */
    public function getPage($locale, $slug =null){
        
        
        // extra fout opvangen
        if ($slug === null) {
            return;
        }
        $select = $this->select()
                ->where('status =?',  self::STATUS_ONLINE)
                ->where('locale =?',$locale)
                ->where('slug =?',  $slug); // altijd meegeven vorm van beveiliging
        $result = $this->fetchAll($select)->current(); // is altijd maar "één pagina ==> één slug = één pagina
        return $result;
    }
   
    
    
}

