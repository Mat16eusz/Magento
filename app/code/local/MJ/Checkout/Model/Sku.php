<?php
/**
 * Mateusz Jasiak
 * 
 * @author    Mateusz Jasiak
 * @author    mateusz.jasiak.dev@gmail.com
 *
 * @package   MJ_Checkout
 */
class MJ_Checkout_Model_Sku
{
    /**
     * Adding product by SKU
     *
     * @param string $sku
     * @return string
     */
    public function addSku($sku)
    {
        try {
            $product = Mage::getModel('catalog/product')->loadByAttribute('sku', $sku);
            $id = $product->getId();

            $cart = Mage::getSingleton('checkout/cart');
            $cart->init();
            $product = Mage::getModel('catalog/product')->load($id);
            
            $parameter = array('product' => $id,
            'qty' => '1',
            'form_key' => Mage::getSingleton('core/session')->getFormKey(),
            );
            
            $request = new Varien_Object();
            $request->setData($parameter);
            $cart->addProduct($product, $request);
            $cart->save();

            $this->_redirect('checkout/cart/index');
        } finally {
            return 0;
        }
    }
}
