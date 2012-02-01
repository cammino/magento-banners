<?php

class Cammino_Banners_Model_Mysql4_Banners extends Mage_Core_Model_Mysql4_Abstract
{
    public function _construct()
    {    
        // Note that the banners_id refers to the key field in your database table.
        $this->_init('banners/banners', 'banners_id');
    }
}