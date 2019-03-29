<?php
/**
* Banners.php
*
* @category Cammino
* @package  Cammino_Googlemerchant
* @author   Cammino Digital <suporte@cammino.com.br>
* @license  http://opensource.org/licenses/OSL-3.0 Open Software License (OSL 3.0)
* @link     https://github.com/cammino/magento-banners
*/

class Cammino_Banners_Block_Banners extends Mage_Core_Block_Template
{
    /**
    * Function responsible for prepare layout
    *
    * @return object
    */
    public function _prepareLayout()
    {
        return parent::_prepareLayout();
    }

    /**
    * Function responsible for get banners
    *
    * @return object
    */
    public function getBanners()
    {
        if (!$this->hasData('banners')) {
            $this->setData('banners', Mage::registry('banners'));
        }

        return $this->getData('banners');
        
    }
}