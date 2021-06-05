<?php
/**
 * Mateusz Jasiak
 * 
 * @author    Mateusz Jasiak
 * @author    mateusz.jasiak.dev@gmail.com
 *
 * @package   MJ_Guestbook
 */
class MJ_Guestbook_Model_Guestbook extends Mage_Core_Model_Abstract
{
    /**
     * Standard model initialization
     *
     * @return void
     */
    public function __construct()
    {
        parent::_construct();
        $this->_init('guestbook/guestbook');
    }
}
