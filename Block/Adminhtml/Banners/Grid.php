<?php
/**
* Grid.php
*
* @category Cammino
* @package  Cammino_Googlemerchant
* @author   Cammino Digital <suporte@cammino.com.br>
* @license  http://opensource.org/licenses/OSL-3.0 Open Software License (OSL 3.0)
* @link     https://github.com/cammino/magento-banners
*/

class Cammino_Banners_Block_Adminhtml_Banners_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
    /**
    * Function responsible for construct banners grid
    *
    * @return object
    */
    public function __construct()
    {
        parent::__construct();
        $this->setId('bannersGrid');
        $this->setDefaultSort('banners_id');
        $this->setDefaultDir('ASC');
        $this->setSaveParametersInSession(true);
    }

    /**
    * Function responsible for prepare collection of grid
    *
    * @return object
    */
    protected function _prepareCollection()
    {
        $collection = Mage::getModel('banners/banners')->getCollection();
        $this->setCollection($collection);
        return parent::_prepareCollection();
    }

    /**
    * Function responsible for prepare columns of grid
    *
    * @return object
    */
    protected function _prepareColumns()
    {
        $dateFormatIso = Mage::app()->getLocale()->getDateFormat(Mage_Core_Model_Locale::FORMAT_TYPE_SHORT);

        $this->addColumn(
            'banners_id',
            array(
            'header'    => Mage::helper('banners')->__('ID'),
            'align'     =>'right',
            'width'     => '50px',
            'index'     => 'banners_id',)
        );

        $this->addColumn(
            'filename',
            array(
            'header'    => Mage::helper('banners')->__('Image'),
            'align'     =>'left',
            'width'     => '150px',
            'index'     => 'filename',
            'filter'    => false,
            'sortable'  => false,
            'renderer'  => 'banners/adminhtml_banners_renderer')
        );

        $this->addColumn(
            'filename_responsive',
            array(
            'header'    => Mage::helper('banners')->__('Responsive'),
            'align'     =>'left',
            'width'     => '80px',
            'index'     => 'filename_responsive',
            'filter'    => false,
            'sortable'  => false,
            'renderer'  => 'banners/adminhtml_banners_renderer')
        );

        $this->addColumn(
            'title',
            array(
            'header'    => Mage::helper('banners')->__('Title'),
            'align'     =>'left',
            'index'     => 'title',)
        );

        $this->addColumn(
            'area',
            array(
            'header'    => Mage::helper('banners')->__('Area'),
            'align'     =>'left',
            'index'     => 'area',)
        );

        // $this->addColumn('filename', array(
        // 'header'    => Mage::helper('banners')->__('File'),
        // 'align'     =>'left',
        // 'index'     => 'filename',
        // ));

        $this->addColumn(
            'status',
            array(
            'header'    => Mage::helper('banners')->__('Status'),
            'align'     => 'left',
            'width'     => '80px',
            'index'     => 'status',
            'type'      => 'options',
            'options'   => array(
                1 => Mage::helper('banners')->__('Enabled'),
                2 => Mage::helper('banners')->__('Disabled'),
            ),)
        );

        $this->addColumn(
            'start_at',
            array(
            'header'    => Mage::helper('banners')->__('Start at'),
            'align'     =>'left',
            'type'      => 'date',
            'format'    => $dateFormatIso,
            'index'     => 'start_at')
        );

        $this->addColumn(
            'end_at',
            array(
            'header'    => Mage::helper('banners')->__('End at'),
            'align'     =>'left',
            'type'      => 'date',
            'format'    => $dateFormatIso,
            'index'     => 'end_at',)
        );

        $this->addColumn(
            'banner_order',
            array(
            'header'    => Mage::helper('banners')->__('Order'),
            'align'     =>'left',
            'width'     => '50px',
            'index'     => 'banner_order')
        );

        $this->addColumn(
            'action',
            array(
                'header'   =>  Mage::helper('banners')->__('Edit'),
                'width'    => '100',
                'type'     => 'action',
                'getter'   => 'getId',
                'actions'  => array(
            array(
                'caption' => Mage::helper('banners')->__('Edit'),
                'url'     => array('base'=> '*/*/edit'),
                'field'   => 'id'
                )
            ),
                'filter'    => false,
                'sortable'  => false,
                'index'     => 'stores',
                'is_system' => true,)
        );

        $this->addColumn(
            'action_remove',
            array(
                'header'  =>  Mage::helper('banners')->__('Remove'),
                'width'   => '100',
                'type'    => 'action',
                'getter'  => 'getId',
                'actions' => array(

                array(
                    'caption' => Mage::helper('banners')->__('Remove'),
                    'url'     => array('base'=> '*/*/delete'),
                    'field'   => 'id',
                    'confirm' => 'Você tem certeza que deseja remover o banner?'
                )
            ),
                    'filter'    => false,
                    'sortable'  => false,
                    'index'     => 'stores',
                    'is_system' => true,)
        );

        return parent::_prepareColumns();
    }

    /**
    * Function responsible to get row of grid
    *
    * @param object $row Object param
    *
    * @return object
    */
    public function getRowUrl($row)
    {
        return $this->getUrl('*/*/edit', array('id' => $row->getId()));
    }
}