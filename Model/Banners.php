<?php

class Cammino_Banners_Model_Banners extends Mage_Core_Model_Abstract
{
    public function _construct()
    {
        parent::_construct();
        $this->_init('banners/banners');
    }

	public function getFilePath() {
		$path = Mage::getBaseUrl(Mage_Core_Model_Store::URL_TYPE_MEDIA) . "banners/" . $this->filename;
		return $path;
	}

	/**
	* Retorna Objeto com os banners ou Nulo caso nao encontre nenhum banner.
	* @var $type String
	* @var $storeId Integer
	* @return Object|Null
	**/
	public function getSlides($area = "", $limit = "")
	{
		
    $now 	 = date('Y-m-d');
		$model = Mage::getModel('banners/banners');
		
		$slides = $model->getCollection()
      ->addFieldToSelect('*')
      ->addFieldToFilter('status', 1)
      ->setOrder('created_time', 'desc');

    
    if (!empty($area)) {
      $slides->addFieldToFilter('area', $area);
    }


    $slides->addFieldToFilter( 'start_at', 
      array(
        array( 'lteq' => $now ),
        array( 'null' => true )
      )
    )
    ->addFieldToFilter( 'end_at',
      array(
        array('gteq' => $now),
        array( 'null' => true )
      )
    );
    

    if (!empty($limit)) {
      $slides->setPageSize($limit)
             ->setCurPage(1);
    }


		return (count($slides) > 0) ? $slides : NULL;
	}
}