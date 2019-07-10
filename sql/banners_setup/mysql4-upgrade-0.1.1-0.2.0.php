<?php
/**
* mysql4-install-0.1.0.php
*
* @category Cammino
* @package  Cammino_Googlemerchant
* @author   Cammino Digital <suporte@cammino.com.br>
* @license  http://opensource.org/licenses/OSL-3.0 Open Software License (OSL 3.0)
* @link     https://github.com/cammino/magento-banners
*/

$installer = $this;

$installer->startSetup();

$installer->run(
    "ALTER TABLE {$this->getTable('banners')}
    ADD `store_id` VARCHAR(255) NULL AFTER
    banner_order"
);

$installer->endSetup(); 
