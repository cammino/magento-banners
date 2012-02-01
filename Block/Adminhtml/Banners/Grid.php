<?php

class Cammino_Banners_Block_Adminhtml_Banners_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
	
	public function __construct()
	{
		parent::__construct();
		$this->setId('bannersGrid');
		$this->setDefaultSort('banners_id');
		$this->setDefaultDir('ASC');
		$this->setSaveParametersInSession(true);
	}

	protected function _prepareCollection()
	{
		$collection = Mage::getModel('banners/banners')->getCollection();
		$this->setCollection($collection);
		return parent::_prepareCollection();
	}

	protected function _prepareColumns()
	{
	
		$this->addColumn('banners_id', array(
			'header'    => Mage::helper('banners')->__('ID'),
			'align'     =>'right',
			'width'     => '50px',
			'index'     => 'banners_id',
		));

		$this->addColumn('title', array(
			'header'    => Mage::helper('banners')->__('Title'),
			'align'     =>'left',
			'index'     => 'title',
		));
		
		$this->addColumn('area', array(
			'header'    => Mage::helper('banners')->__('Area'),
			'align'     =>'left',
			'index'     => 'area',
		));
		
		$this->addColumn('filename', array(
			'header'    => Mage::helper('banners')->__('File'),
			'align'     =>'left',
			'index'     => 'filename',
		));

		$this->addColumn('status', array(
			'header'    => Mage::helper('banners')->__('Status'),
			'align'     => 'left',
			'width'     => '80px',
			'index'     => 'status',
			'type'      => 'options',
			'options'   => array(
				1 => 'Enabled',
				2 => 'Disabled',
			),
		));
	  
		$this->addColumn('action',
			array(
				'header'    =>  Mage::helper('banners')->__('Action'),
				'width'     => '100',
				'type'      => 'action',
				'getter'    => 'getId',
				'actions'   => array(
					array(
						'caption'   => Mage::helper('banners')->__('Edit'),
						'url'       => array('base'=> '*/*/edit'),
						'field'     => 'id'
					)
				),
			'filter'    => false,
			'sortable'  => false,
			'index'     => 'stores',
			'is_system' => true,
		));
	  
		return parent::_prepareColumns();
	}

	public function getRowUrl($row)
	{
		return $this->getUrl('*/*/edit', array('id' => $row->getId()));
	}
}