<?php
/**
 * Mateusz Jasiak
 * 
 * @author    Mateusz Jasiak
 * @author    mateusz.jasiak.dev@gmail.com
 *
 * @package   MJ_Checkout
 */
class MJ_Checkout_Block_Cart_Totals extends Mage_Checkout_Block_Cart_Totals
{
    /**
     * Gets quantity of items in cart and depending of amount 
     * returns string with message to user
     * 
     * @return string
     */
    const MAX_ITEM_QTY = 10;
    const INITIAL_VALUE = 1;
    public function printTotals()
    {
        $cart = Mage::getModel('checkout/cart')->getQuote();
        $itemCart = $cart['items_qty'];
        $constMaxItemQty = self::MAX_ITEM_QTY;
        $qty = $constMaxItemQty - $itemCart;

        if ($qty == self::INITIAL_VALUE) {
            $text = "Awesome, buy {$qty} product more to have {$constMaxItemQty} in cart!";
            $this->__($text);
        }
        
        if ($qty > self::INITIAL_VALUE && $qty < $constMaxItemQty) {
            $text = "Awesome, buy {$qty} products more to have {$constMaxItemQty} in cart!";
            $this->__($text);
        }

        return $text;
    }
}
