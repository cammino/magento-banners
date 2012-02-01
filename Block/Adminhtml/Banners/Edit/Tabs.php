<?php

class Cammino_Banners_Block_Adminhtml_Banners_Edit_Tabs extends Mage_Adminhtml_Block_Widget_Tabs
{

  public function __construct()
  {
      parent::__construct();
      $this->setId('banners_tabs');
      $this->setDestElementId('edit_form');
      $this->setTitle(Mage::helper('banners')->__('Item Information'));
  }

  protected function _beforeToHtml()
  {
      $this->addTab('form_section', array(
          'label'     => Mage::helper('banners')->__('Item Information'),
          'title'     => Mage::helper('banners')->__('Item Information'),
          'content'   => $this->getLayout()->createBlock('banners/adminhtml_banners_edit_tab_form')->toHtml(),
      ));
     
      return parent::_beforeToHtml();
  }
}