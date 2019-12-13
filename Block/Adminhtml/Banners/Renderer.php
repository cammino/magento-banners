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

        // Desktop file (Check extension to see if is video or image)
        if ($index = "filename") {
            $preview_file = $row['filename'];
            $preview_file_ext = pathinfo($preview_file, PATHINFO_EXTENSION);
        }
        else if ($index = "filename_responsive") {
            $preview_file = $row['filename_responsive'];
            $preview_file_ext = pathinfo($preview_file, PATHINFO_EXTENSION);
        }

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

            if ($preview_file_ext == "mp4" || $preview_file_ext == "webm" || $preview_file_ext == "ogg") {
                $html = '<div class="banner-preview"><video width="320" height="240" controls><source src="' . "/media/banners/" . $row->getData($this->getColumn()->getIndex()) .'" type="video/' . $preview_file_ext . '"></video></div>';
            }
            else {
                $html = '<img ';
                $html .= 'id="' . $this->getColumn()->getId() . '" ';
                $html .= 'src="' . "/media/banners/" . $row->getData($this->getColumn()->getIndex()) . '"';
                $html .= 'style="' . $size . '" ';
                $html .= 'class="grid-image ' . $this->getColumn()->getInlineCss() . '"/>';
            }

            return $html;
        }
    }
}