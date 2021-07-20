<?php
/**
 * Mateusz Jasiak
 * 
 * @author    Mateusz Jasiak
 * @author    mateusz.jasiak.dev@gmail.com
 *
 * @package   MJ_Guestbook
 */
class MJ_Guestbook_Model_Resource_Guestbook_Collection extends Mage_Core_Model_Resource_Db_Collection_Abstract
{
    /**
     * Standard resource collection initialization
     *
     * @return void
     */
    public function __construct()
    {
        parent::_construct();
        $this->_init('guestbook/guestbook');
    }
}
