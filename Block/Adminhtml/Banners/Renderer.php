<?php 
/**
* Renderer.php
*
* @category Cammino
* @package  Cammino_Googlemerchant
* @author   Cammino Digital <suporte@cammino.com.br>
* @license  http://opensource.org/licenses/OSL-3.0 Open Software License (OSL 3.0)
* @link     https://github.com/cammino/magento-banners
*/

class Cammino_Banners_Block_Adminhtml_Banners_Renderer extends Mage_Adminhtml_Block_Widget_Grid_Column_Renderer_Abstract
{
    /**
    * Function responsible for renderer banners
    *
    * @param object $row Magento param
    *
    * @return object
    */
    public function render(Varien_Object $row)
    {
        $index = $this->getColumn()->getIndex();
        $rowData = $row->getData();

        if(empty($rowData)) {
            return "<span></span>";
        } else {
            // Verify if the image is responsive or no
            // and them set the corret width
            if ($this->getColumn()->getId() == "filename_responsive") {
                $size = "width: 100px;";
            } else {
                $size = "width: 150px;";
            }

            $html = '<img ';
            $html .= 'id="' . $this->getColumn()->getId() . '" ';
            $html .= 'src="' . "/media/banners/" . $row->getData($this->getColumn()->getIndex()) . '"';
            $html .= 'style="' . $size . '" ';
            $html .= 'class="grid-image ' . $this->getColumn()->getInlineCss() . '"/>';

            return $html;
        }
    }
}