<?php


/**
 * Webservice for SOAP
 * 
 * @author Kris Bras <krise@example.com>
 */
class Application_Model_Producten {
    /**
     * 
     */

    /**
     * 
     * @param string $titel
     * @param string $omschrijving
     * @param float $prijs
     * @return object $product
     */
    public function addProducts($titel, $omschrijving, $prijs) {

        return func_get_args();
        //$product = stdClass();
        //return $product;
    }

    /**
     * Delet the prodcut bu ID
     * @param int $id
     * @return boolean
     */
    public function delProducts($id) {

        return true;
    }

    /**
     * 
     * @param int $id
     * @param string $titel
     * @param string $omschrijving
     * @param float $prijs
     */
    public function modProducts($id, $titel, $omschrijving, $prijs) {

        $product = stdClass();
        return $product;
    }

}

