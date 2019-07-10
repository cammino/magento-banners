<?php
/**
* Banners.php
*
* @category Cammino
* @package  Cammino_Googlemerchant
* @author   Cammino Digital <suporte@cammino.com.br>
* @license  http://opensource.org/licenses/OSL-3.0 Open Software License (OSL 3.0)
* @link     https://github.com/cammino/magento-banners
*/

class Cammino_Banners_Model_Banners extends Mage_Core_Model_Abstract
{
    /**
    * Function responsible for construct
    *
    * @return null
    */
    public function _construct()
    {
        parent::_construct();
        $this->_init('banners/banners');
    }

    /**
    * Function responsible for get path files
    *
    * @return object
    */
    public function getFilePath()
    {
        $path = Mage::getBaseUrl(Mage_Core_Model_Store::URL_TYPE_MEDIA) . "banners/" . $this->filename;
        return $path;
    }

    /**
    * Function responsible for get slides
    *
    * @param object $area  Object param
    *
    * @param object $limit Object param
    *
    * @return string
    */
    public function getSlides($area = "", $limit = "")
    {
        $now    = date('Y-m-d');
        $model  = Mage::getModel('banners/banners');

        $slides = $model->getCollection()
            ->addFieldToSelect('*')
            ->addFieldToFilter('status', 1)
            ->setOrder('banner_order', 'asc');        
    
        if (!empty($area)) {
            $slides->addFieldToFilter('area', $area);
        }

        $slides->addFieldToFilter(
            'start_at',
            array(
            array( 'lteq' => $now ),
            array( 'null' => true )
            )
        )
            ->addFieldToFilter(
                'end_at',
                array(
                array('gteq' => $now),
                array( 'null' => true )
                )
            );

        if (!empty($limit)) {
            $slides->setPageSize($limit)
                ->setCurPage(1);
        }

        $slidesArray = $slides->load();

        // Filtra os banners se estiver com modo multi loja habilitado
        if (!Mage::app()->isSingleStoreMode()) {
            $actualStoreId = Mage::app()->getStore()->getId();
            $filteredSlides = array();

            foreach($slidesArray as $slide) {
                if($slide->getStoreId() == NULL || $slide->getStoreId() == "" || $slide->getStoreId() == "0,") {
                    $filteredSlides[] = $slide;
                } else {
                    $storesId = explode(",", $slide->getStoreId());
                    foreach($storesId as $storeId) {
                        if($actualStoreId == $storeId || $storeId == "0") {
                            $filteredSlides[] = $slide;
                        }
                    }
                }
            }
            return (count($filteredSlides) > 0) ? $filteredSlides : null;
        } else {
            return (count($slidesArray) > 0) ? $slidesArray : null;
        }

    }
}