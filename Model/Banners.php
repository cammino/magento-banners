<?php

class Cammino_Banners_Model_Banners extends Mage_Core_Model_Abstract
{
    public function _construct()
    {
        parent::_construct();
        $this->_init('banners/banners');
    }

	public function getFilePath() {
		$path = Mage::getBaseUrl(Mage_Core_Model_Store::URL_TYPE_MEDIA) . "banners/" . $this->filename;
		return $path;
	}
}