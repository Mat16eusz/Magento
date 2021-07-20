<?php
/**
 * Mateusz Jasiak
 * 
 * @author    Mateusz Jasiak
 * @author    mateusz.jasiak.dev@gmail.com
 *
 * @package   MJ_Onepage
 */
class MJ_Onepage_Helper_Data extends Mage_Core_Helper_Abstract
{
    const XML_HIDE_SHIPPING_PATH = 'checkout/options/hide_shipping';
    const XML_DEFAULT_SHIPPING_PATH = 'checkout/options/default_shipping';

    /**
     * @return bool
     */
    public function getHideShipping()
    {
        if (Mage::getStoreConfigFlag(self::XML_HIDE_SHIPPING_PATH)) {
            return true;
        }

        if (!$this->getDefaultShippingMethod()) {
            return false;
        }

        return true;
    }

    /**
     * @return mixed
     */
    public function getDefaultShippingMethod()
    {
        return Mage::getStoreConfig(self::XML_DEFAULT_SHIPPING_PATH);
    }
}
