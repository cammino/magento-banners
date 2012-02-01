<?php
class Cammino_Banners_Block_Banners extends Mage_Core_Block_Template
{
	public function _prepareLayout()
    {
		return parent::_prepareLayout();
    }
    
     public function getBanners()     
     { 
        if (!$this->hasData('banners')) {
            $this->setData('banners', Mage::registry('banners'));
        }
        return $this->getData('banners');
        
    }
}