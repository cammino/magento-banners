<?php
/**
* Tabs.php
*
* @category Cammino
* @package  Cammino_Googlemerchant
* @author   Cammino Digital <suporte@cammino.com.br>
* @license  http://opensource.org/licenses/OSL-3.0 Open Software License (OSL 3.0)
* @link     https://github.com/cammino/magento-banners
*/

class Cammino_Banners_Block_Adminhtml_Banners_Edit_Tabs extends Mage_Adminhtml_Block_Widget_Tabs
{

    /**
    * Function responsible to prepare form
    *
    * @return object
    */
    public function __construct()
    {
        parent::__construct();
        $this->setId('banners_tabs');
        $this->setDestElementId('edit_form');
        $this->setTitle(Mage::helper('banners')->__('Item Information'));
    }

    /**
    * Function responsible to add tab
    *
    * @return object
    */
    protected function  _beforeToHtml()
    {
        $this->addTab(
            'form_section',
            array(
            'label'     => Mage::helper('banners')->__('Item Information'),
            'title'     => Mage::helper('banners')->__('Item Information'),
            'content'   => $this->getLayout()->createBlock('banners/adminhtml_banners_edit_tab_form')->toHtml(),)
        );
     
        return parent:: _beforeToHtml();
    }
}