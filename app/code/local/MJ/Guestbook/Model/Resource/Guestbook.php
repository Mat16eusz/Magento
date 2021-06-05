<?php
/**
 * Mateusz Jasiak
 * 
 * @author    Mateusz Jasiak
 * @author    mateusz.jasiak.dev@gmail.com
 *
 * @package   MJ_Guestbook
 */
class MJ_Guestbook_Model_Resource_Guestbook extends Mage_Core_Model_Resource_Db_Abstract
{
    /**
     * Standard resource model initialization
     *
     * @return void
     */
    public function _construct()
    {
        $this->_init('guestbook/guestbook', 'guestbook_id');
    }
}
