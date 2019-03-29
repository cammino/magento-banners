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

class Cammino_Banners_Block_Adminhtml_Banners extends Mage_Adminhtml_Block_Widget_Grid_Container
{
    /**
    * Function responsible for construct banner
    *
    * @return null
    */
    public function __construct()
    {
        $this->_controller = 'adminhtml_banners';
        $this->_blockGroup = 'banners';
        $this->_headerText = Mage::helper('banners')->__('Banners');
        $this->_addButtonLabel = Mage::helper('banners')->__('Add Item');

        parent::__construct();
    }
}