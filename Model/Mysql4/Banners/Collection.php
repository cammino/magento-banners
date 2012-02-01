<?php

class Cammino_Banners_Model_Mysql4_Banners_Collection extends Mage_Core_Model_Mysql4_Collection_Abstract
{
    public function _construct()
    {
        parent::_construct();
        $this->_init('banners/banners');
    }
}