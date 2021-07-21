<?php
/**
 * Mateusz Jasiak
 * 
 * @author    Mateusz Jasiak
 * @author    mateusz.jasiak.dev@gmail.com
 *
 * @package   MJ_Customer
 */

/** @var $installer Mage_Core_Model_Resource_Setup */
$installer = $this;
 
$installer->startSetup();

$this->addAttribute(
    'customer', 'telephone_number', array(
    'type'      => 'varchar',
    'label'     => 'Telephone Number',
    'input'     => 'text',
    'global' => 1,
    'visible' => 1,
    'required' => 0,
    'user_defined' => 1,
    'visible_on_front' => 1
    )
);
$attribute = Mage::getSingleton('eav/config')->getAttribute('customer', 'telephone_number');
$attribute->setData(
    'used_in_forms', array(
    'adminhtml_customer',
    'checkout_register',
    'customer_account_create',
    'customer_account_edit',
    )
);
$attribute->setData('is_user_defined', 0);
$attribute->save();

$installer->endSetup();
