<?php
/**
* Status.php
*
* @category Cammino
* @package  Cammino_Googlemerchant
* @author   Cammino Digital <suporte@cammino.com.br>
* @license  http://opensource.org/licenses/OSL-3.0 Open Software License (OSL 3.0)
* @link     https://github.com/cammino/magento-banners
*/

class Cammino_Banners_Model_Status extends Varien_Object
{
    const STATUS_ENABLED    = 1;
    const STATUS_DISABLED   = 2;

    /**
    * Function responsible for get options array (Enabled or Disabled)
    *
    * @return object
    */
    static public function getOptionArray()
    {
        return array(
            self::STATUS_ENABLED    => Mage::helper('banners')->__('Enabled'),
            self::STATUS_DISABLED   => Mage::helper('banners')->__('Disabled')
        );
    }
}