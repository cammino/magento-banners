<?php

class Cammino_Banners_Block_Adminhtml_Banners_Edit_Tab_Form extends Mage_Adminhtml_Block_Widget_Form
{
	protected function _prepareForm()
	{
		$form = new Varien_Data_Form();
		$this->setForm($form);
		$fieldset = $form->addFieldset('banners_form', array('legend'=>Mage::helper('banners')->__('Item Information')));
		$preview = '';
		$preview2 = '';

		if(Mage::registry('banners_data')) {
			$data = Mage::registry('banners_data')->getData();

			if ($data) {
				$path = Mage::getBaseUrl(Mage_Core_Model_Store::URL_TYPE_MEDIA) . "banners/" . $data["filename"];
				$path2 = Mage::getBaseUrl(Mage_Core_Model_Store::URL_TYPE_MEDIA) . "banners/" . $data["filename_responsive"];
				$preview = $data["filename"] ? '<div class="banner-preview"><img src="'. $path .'" /></div>' : '';
				$preview2 = $data["filename_responsive"] ? '<div class="banner-preview"><img src="'. $path2 .'" /></div>' : '';
			}

		}

        $dateFormatIso = Mage::app()->getLocale()->getDateFormat(
        	Mage_Core_Model_Locale::FORMAT_TYPE_SHORT
        );

		
		$fieldset->addField('area', 'select', array(
			'label'     => Mage::helper('banners')->__('Area'),
			'name'      => 'area',
			'values'    => $this->getAreas()
		));

		$fieldset->addField('title', 'text', array(
			'label'     => Mage::helper('banners')->__('Title'),
			'class'     => 'required-entry',
			'required'  => true,
			'name'      => 'title'
		));

		// $fieldset->addField('subtitle', 'text', array(
		// 	'label'     => Mage::helper('banners')->__('Sub-Title'),
		// 	'name'      => 'subtitle'
		// ));
		
		$fieldset->addField('url', 'text', array(
			'label'     => Mage::helper('banners')->__('Url'),
			'class'     => 'required-entry',
			'required'  => true,
			'name'      => 'url'
		));
		
		$fieldset->addField('status', 'select', array(
			'label'     => Mage::helper('banners')->__('Status'),
			'name'      => 'status',
			'values'    => array(
				array(
					'value'     => 1,
					'label'     => Mage::helper('banners')->__('Enabled'),
				),

				array(
					'value'     => 2,
					'label'     => Mage::helper('banners')->__('Disabled'),
				),
			),
		));
		
		$fieldset->addField('filename', 'file', array(
			'label'		=> Mage::helper('banners')->__('File'),
			'required'	=> false,
			'name'		=> 'filename',
			'after_element_html' => $preview,
		));

		$fieldset->addField('filename_responsive', 'file', array(
			'label'		=> Mage::helper('banners')->__('Responsive File'),
			'required'	=> false,
			'name'		=> 'filename_responsive',
			'after_element_html' => $preview2,
		));

		$fieldset->addField('start_at', 'date', array(
			'label'		=> Mage::helper('banners')->__('Start at'),
			'required'	=> false,
			'name'		=> 'start_at',
			'format'    => $dateFormatIso,
            'image'     => $this->getSkinUrl('images/grid-cal.gif'),
            'class'     => 'date-range-custom_theme-from'
		));

		$fieldset->addField('end_at', 'date', array(
			'label'		=> Mage::helper('banners')->__('End at'),
			'required'	=> false,
			'name'		=> 'end_at',
			'format'    => $dateFormatIso,
            'image'     => $this->getSkinUrl('images/grid-cal.gif'),
            'class'     => 'date-range-custom_theme-from'
		));
     
		if (Mage::getSingleton('adminhtml/session')->getBannersData()) {
			$form->setValues(Mage::getSingleton('adminhtml/session')->getBannersData());
			Mage::getSingleton('adminhtml/session')->setBannersData(null);
		} elseif ( Mage::registry('banners_data') ) {
			$form->setValues(Mage::registry('banners_data')->getData());
		}
		
		return parent::_prepareForm();
	}
	
	private function getAreas() {
		$values = explode(",", Mage::getStoreConfig('cms/banners/areas'));
		$areas = array();
		
		foreach($values as $value) {
			$areas[] = array('value' => $value, 'label' => $value);
		}
		
		return $areas;
	}
	
}