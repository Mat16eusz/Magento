<?php
/**
 * Mateusz Jasiak
 * 
 * @author    Mateusz Jasiak
 * @author    mateusz.jasiak.dev@gmail.com
 *
 * @package   MJ_VatEu
 */

/** @var $installer Mage_Core_Model_Resource_Setup */
$installer = $this;
 
$installer->startSetup();

$this->addAttribute(
    'customer_address', 'vateu', array(
    'type' => 'varchar',
    'input' => 'text',
    'label' => 'VAT Eu No#',
    'global' => 1,
    'visible' => 1,
    'required' => 0,
    'user_defined' => 1,
    'visible_on_front' => 1
    )
);
Mage::getSingleton('eav/config')
    ->getAttribute('customer_address', 'vateu')
    ->setData('used_in_forms', array('customer_register_address','customer_address_edit','adminhtml_customer_address'))
    ->save();
$installer->endSetup();

$tablequote = $this->getTable('sales/quote_address');
$installer->run(
    "
ALTER TABLE  $tablequote ADD  `vateu` varchar(255) NOT NULL
"
);
 
$tablequote = $this->getTable('sales/order_address');
$installer->run(
    "
ALTER TABLE  $tablequote ADD  `vateu` varchar(255) NOT NULL
"
);
