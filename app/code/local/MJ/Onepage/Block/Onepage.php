<?php
/**
 * Mateusz Jasiak
 * 
 * @author    Mateusz Jasiak
 * @author    mateusz.jasiak.dev@gmail.com
 *
 * @package   MJ_Onepage
 */
class MJ_Onepage_Block_Onepage extends Mage_Checkout_Block_Onepage_Abstract
{
    /**
     * @return array
     */
    public function getSteps()
    {
        if (!Mage::helper('mj_onepage')->getHideShipping()) {
            $steps = array();
            $stepCodes = $this->_getStepCodes();

            if ($this->isCustomerLoggedIn()) {
                $stepCodes = array_diff($stepCodes, array('login'));
            }

            foreach ($stepCodes as $step) {
                $steps[$step] = $this->getCheckout()->getStepData($step);
            }

            return $steps;
        } else {
            $steps = array();
            $stepCodes = $this->_getStepCodes();

            unset($stepCodes[2]);

            if ($this->isCustomerLoggedIn()) {
                $stepCodes = array_diff($stepCodes, array('login'));
            }

            foreach ($stepCodes as $step) {
                $steps[$step] = $this->getCheckout()->getStepData($step);
            }

            return $steps;
        }
    }

    /**
     * @return string
     */
    public function getActiveStep()
    {
        return $this->isCustomerLoggedIn() ? 'billing' : 'login';
    }
}
