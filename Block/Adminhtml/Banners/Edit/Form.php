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

class Cammino_Banners_Block_Adminhtml_Banners_Edit_Form extends Mage_Adminhtml_Block_Widget_Form
{
    /**
    * Function responsible for prepare form
    *
    *
    * @return object
    */
    protected function _prepareForm()
    {
        $form = new Varien_Data_Form(
            array(
                  'id' => 'edit_form',
                  'action' => $this->getUrl('*/*/save', array('id' => $this->getRequest()->getParam('id'))),
                  'method' => 'post',
                  'enctype' => 'multipart/form-data'
                )
        );

        $form->setUseContainer(true);
        $this->setForm($form);

        return parent::_prepareForm();

    }
}