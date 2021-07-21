<?php
/**
 * Mateusz Jasiak
 * 
 * @author    Mateusz Jasiak
 * @author    mateusz.jasiak.dev@gmail.com
 *
 * @package   MJ_Customer
 */
require_once Mage::getModuleDir('controllers', 'Mage_Customer') . DS . 'AccountController.php';

class MJ_Customer_AccountController extends Mage_Customer_AccountController
{
    /**
     * @return void
     */
    public function setup()
    {
        if (!$this->_validateFormKey()) {
            $this->_redirect('*/*/');
            return;
        }

        if ($this->_getSession()->isLoggedIn()) {
            $this->_redirect('*/*/');
            return;
        }
    }
    
    /**
     * Login post action
     * + login by phone number
     *
     * @return void
     */
    public function loginPostAction()
    {
        $this->setup();

        $session = $this->_getSession();

        if ($this->getRequest()->isPost()) {
            $login = $this->getRequest()->getPost('login');

            if (strpos($login['username'], '@') === false) {
                $telUser = $login['username'];
                $customer = Mage::getModel('customer/customer')->getCollection()
                            ->addAttributeToFilter('telephone_number', $telUser)
                            ->setPageSize(1, 1)->getLastItem();
                if ($telUser == $customer->getTelephoneNumber()) {
                    $login['username'] = $customer->getEmail();
                }
            }

            if (!empty($login['username']) && !empty($login['password'])) {
                try {
                    $session->login($login['username'], $login['password']);
                    if ($session->getCustomer()->getIsJustConfirmed()) {
                        $this->_welcomeCustomer($session->getCustomer(), true);
                    }
                } catch (Mage_Core_Exception $e) {
                    switch ($e->getCode()) {
                        case Mage_Customer_Model_Customer::EXCEPTION_EMAIL_NOT_CONFIRMED:
                            $value = $this->_getHelper('customer')->getEmailConfirmationUrl($login['username']);
                            $message = $this->_getHelper('customer')->
                            __('This account is not confirmed. <a href="%s">Click here</a> to resend confirmation email.', $value);
                            break;
                        case Mage_Customer_Model_Customer::EXCEPTION_INVALID_EMAIL_OR_PASSWORD:
                            $message = $e->getMessage();
                            break;
                        default:
                            $message = $e->getMessage();
                    }

                    $session->addError($message);
                    $session->setUsername($login['username']);
                }
            } else {
                $session->addError($this->__('Login and password are required.'));
            }
        }

        $this->_loginPostRedirect();
    }
}
