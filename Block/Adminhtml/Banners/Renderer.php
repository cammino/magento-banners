<?php 

class Cammino_Banners_Block_Adminhtml_Banners_Renderer extends Mage_Adminhtml_Block_Widget_Grid_Column_Renderer_Abstract
{ 
	public function render(Varien_Object $row)
	{
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