<?php
/**
 * Mateusz Jasiak
 * 
 * @author    Mateusz Jasiak
 * @author    mateusz.jasiak.dev@gmail.com
 *
 * @package   MJ_Guestbook
 */
class MJ_Guestbook_IndexController extends Mage_Core_Controller_Front_Action
{
    /**
     * @return void
     */
    public function indexAction()
    {
        $this->loadLayout();
        $this->renderLayout();
    }
    
    /**
     * Gets data from the form and saving to the database,
     * returns the user the status of sending
     *
     * @return void
     */
    public function saveAction()
    {
        $guestbook = Mage::getModel('guestbook/guestbook');

        $name     = $this->getRequest()->getPost('name');
        $surname  = $this->getRequest()->getPost('surname');
        $email    = $this->getRequest()->getPost('mail');
        $ipGuest = Mage::helper('core/http')->getRemoteAddr();

        $guestbook->setData('name', $name);
        $guestbook->setData('surname', $surname);
        $guestbook->setData('email', $email);
        $guestbook->setData('ip', $ipGuest);

        $guestbook->save();

        if ($guestbook == true) {
            Mage::getSingleton('core/session')->addSuccess($this->__('Sent'));
        } else {
            Mage::getSingleton('core/session')->addError($this->__('Not sent'));
        }

        $this->_redirect('guestbook/index/index');
    }
}
