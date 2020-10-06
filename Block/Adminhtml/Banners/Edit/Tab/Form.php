<?php
/**
* Form.php
*
* @category Cammino
* @package  Cammino_Googlemerchant
* @author   Cammino Digital <suporte@cammino.com.br>
* @license  http://opensource.org/licenses/OSL-3.0 Open Software License (OSL 3.0)
* @link     https://github.com/cammino/magento-banners
*/

class Cammino_Banners_Block_Adminhtml_Banners_Edit_Tab_Form extends Mage_Adminhtml_Block_Widget_Form
{
    /**
    * Function responsible to prepare form
    *
    * @return object
    */
    protected function _prepareForm()
    {
        $form = new Varien_Data_Form();
        $this->setForm($form);
        $fieldset = $form->addFieldset('banners_form', array('legend'=>Mage::helper('banners')->__('Item Information')));
        $preview = '';
        $preview2 = '';

        if (Mage::registry('banners_data')) {
            $data = Mage::registry('banners_data')->getData();

            if ($data) {
                $path = Mage::getBaseUrl(Mage_Core_Model_Store::URL_TYPE_MEDIA) . "banners/" . $data["filename"];
                $path2 = Mage::getBaseUrl(Mage_Core_Model_Store::URL_TYPE_MEDIA) . "banners/" . $data["filename_responsive"];

                // Desktop file (Check extension to see if is video or image)
                $preview_file = $data['filename'];
                $preview_file_ext = pathinfo($preview_file, PATHINFO_EXTENSION);

                if ($preview_file_ext == "mp4" || $preview_file_ext == "webm" || $preview_file_ext == "ogg") {
                    $preview = $data["filename"] ? '<div class="banner-preview"><video width="320" height="240" controls><source src="'. $path .'" type="video/' . $preview_file_ext . '"></video></div>' : '';
                }
                else {
                    $preview = $data["filename"] ? '<div class="banner-preview"><img src="'. $path .'" /></div>' : '';
                }
                
                // Mobile file (Check extension to see if is video or image)
                $preview2_file = $data['filename_responsive'];
                $preview2_file_ext = pathinfo($preview2_file, PATHINFO_EXTENSION);

                if ($preview2_file_ext == "mp4" || $preview2_file_ext == "webm" || $preview2_file_ext == "ogg") {
                    $preview2 = $data["filename_responsive"] ? '<div class="banner-preview"><video width="320" height="240" controls><source src="'. $path2 .'" type="video/' . $preview2_file_ext . '"></video></div>' : '';
                }
                else {
                    $preview2 = $data["filename_responsive"] ? '<div class="banner-preview"><img src="'. $path2 .'" /></div>' : '';
                }
            }
        }

        $dateFormatIso = Mage::app()->getLocale()->getDateFormat(
            Mage_Core_Model_Locale::FORMAT_TYPE_SHORT
        );


        // Check is single store mode
        if (!Mage::app()->isSingleStoreMode()) {
            $fieldset->addField('store_id', 'multiselect', array(
                'name'      => 'stores[]',
                'label'     => Mage::helper('cms')->__('Store View'),
                'title'     => Mage::helper('cms')->__('Store View'),
                'required'  => false,
                'values'    => Mage::getSingleton('adminhtml/system_store')->getStoreValuesForForm(false, true),
            ));
        }
        else {
            $fieldset->addField('store_id', 'hidden', array(
                'name'      => 'stores[]',
                'value'     => '0',
                'required'  => false,
            ));
            // $data->setStoreId(Mage::app()->getStore(true)->getId());
        }

        $fieldset->addField(
            'area',
            'select',
            array(
            'label' => Mage::helper('banners')->__('Area'),
            'name'  => 'area',
            'values'    => $this->_getAreas())
        );

        $fieldset->addField(
            'franchisors',
            'multiselect',
            array(
                'label'     => 'Franquias',
                'name'      => 'franchisors',
                'values'    => $this->_getFranchisors(true),
                'display'   => 'none',
                'required'  => false
            ),
            'area'
        );

        $fieldset->addField(
            'categories',
            'multiselect', 
            array(
            'label'     => 'Categoria',
            'name'      => 'category',
            'values'    => $this->_getCategories(true),
            'display'   => 'none',
            'required'  => false
            ),
            'area'
        );

        $this->setChild(
            'form_after', 
            $this->getLayout()->createBlock('adminhtml/widget_form_element_dependence')
                ->addFieldMap("area", 'area')
                ->addFieldMap("category", 'category')
                ->addFieldDependence('category', 'area', 'category')
        );

        $fieldset->addField(
            'title',
            'text',
            array(
            'label' => Mage::helper('banners')->__('Title'),
            'class' => 'required-entry',
            'required'  => true,
            'name'  => 'title')
        );

        //$fieldset->addField('subtitle', 'text', array(
        // 'label'     => Mage::helper('banners')->__('Sub-Title'),
        // 'name'      => 'subtitle'
        //));

        $fieldset->addField(
            'url',
            'text',
            array(
            'label' => Mage::helper('banners')->__('Url'),
            'class' => 'required-entry',
            'required'  => true,
            'name'  => 'url')
        );

        $fieldset->addField(
            'status',
            'select',
            array(
            'label' => Mage::helper('banners')->__('Status'),
            'name'  => 'status',
            'values'    => array(
                array(
                    'value' => 1,
                    'label' => Mage::helper('banners')->__('Enabled'),
                ),

                array(
                    'value' => 2,
                    'label' => Mage::helper('banners')->__('Disabled'),
                ),
            ),)
        );

        $fieldset->addField(
            'filename', 
            'file', 
            array(
            'label' => Mage::helper('banners')->__('File'),
            'required'  => false,
            'name'  => 'filename',
            'after_element_html' => $preview,)
        );

        $fieldset->addField(
            'filename_responsive', 
            'file', 
            array(
            'label' => Mage::helper('banners')->__('Responsive File'),
            'required'  => false,
            'name'  => 'filename_responsive',
            'after_element_html' => $preview2,)
        );

        $fieldset->addField(
            'start_at', 
            'date', 
            array(
            'label' => Mage::helper('banners')->__('Start at'),
            'required'  => false,
            'name'=> 'start_at',
            'format'    => $dateFormatIso,
            'image' => $this->getSkinUrl('images/grid-cal.gif'),
            'class' => 'date-range-custom_theme-from')
        );

        $fieldset->addField(
            'end_at', 
            'date', 
            array(
            'label' => Mage::helper('banners')->__('End at'),
            'required'  => false,
            'name'  => 'end_at',
            'format'    => $dateFormatIso,
            'image'     => $this->getSkinUrl('images/grid-cal.gif'),
            'class'     => 'date-range-custom_theme-from')
        );

        $fieldset->addField(
            'banner_order', 
            'text', 
            array(
            'label' => Mage::helper('banners')->__('Order'),
            'class' => 'validate-number',
            'required'  => false,
            'name'  => 'banner_order')
        );
     
        if (Mage::getSingleton('adminhtml/session')->getBannersData()) {
            $form->setValues(Mage::getSingleton('adminhtml/session')->getBannersData());
            Mage::getSingleton('adminhtml/session')->setBannersData(null);
        } elseif ( Mage::registry('banners_data') ) {
            $form->setValues(Mage::registry('banners_data')->getData());
        }

            return parent::_prepareForm();
    }

    /**
    * Function responsible to get form areas
    *
    * @return object
    */
    private function _getAreas() 
    {
        $values = explode(",", Mage::getStoreConfig('cms/banners/areas'));
        $areas = array();

        foreach ($values as $value) {
                $areas[] = array('value' => $value, 'label' => $value);
        }
            $areas[] = array('value' => 'category', 'label' => 'categoria');

        return $areas;
    }

    /**
    * Function responsible to get franchisors list
    *
    * @return object
    */
    private function _getFranchisors()
    {
        $collection = Mage::getModel('franchiser/franchiser')->getCollection();
        $collection->addFieldToSelect('*')->setOrder('name', 'asc')->load()->toArray();
        $franchisors = array();

        $franchisors[] = array(
            'value' => 'semfranquia',
            'label' => 'SEM FRANQUIA (cliente não logado)'
        );

        foreach ($collection as $franchiseId => $franchise) {
            $franchisors[] = array(
                'value' => $franchiseId,
                'label' => $franchise["name"]
            );
        }

        return $franchisors;
    }

    /**
    * Function responsible to get categories form
    *
    * @param boolean $optionList Boolean param
    *
    * @return object
    */
    private function _getCategories($optionList = false)
    {
        $categoriesArray = Mage::getModel('catalog/category')
            ->getCollection()
            ->addAttributeToSelect('name')
            ->addAttributeToSort('path', 'asc')
            ->addFieldToFilter('is_active', array('eq'=>'1'))
            ->load()
            ->toArray();

        if (!$optionList) {
            return $categoriesArray;
        }

        foreach ($categoriesArray as $categoryId => $category) {
            if (isset($category['name'])) {

                $space = '';
                for ($i=1; $i < $category['level']; $i++) {
                    $space = $space."--";
                }

                $categoryName = $space. " " .$category['name'];

                $categories[] = array(
                    'value' => $categoryId,
                    'label' => $categoryName
                );
            }
        }

        return $categories;
    }
}