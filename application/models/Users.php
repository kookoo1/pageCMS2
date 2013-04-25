<?php

class Application_Model_Users extends Zend_Db_Table_Abstract
{
    
    protected $_name = "users";
    protected $_primary = "id";
    
    
    
    /**
     * 
     * @param Zend_Auth $indentity
     * @return Zend_Db_Table_Rowset
     */
    public function getUserByIdentity($indentity){
        
        $select = $this->select()->where('username = ?' , $indentity);
        $result = $this->fetchAll($select)->current();
        
        
        return $result;
        
    }


}

