<?php
/**
 * Mateusz Jasiak
 * 
 * @author    Mateusz Jasiak
 * @author    mateusz.jasiak.dev@gmail.com
 *
 * @package   MJ_Guestbook
 */
class MJ_Guestbook_Helper_Data extends Mage_Core_Helper_Abstract
{
    /**
     * @return string
     */
    public function getGuestbookUrl()
    {
        return $this->_getUrl('guestbook');
    }
}
