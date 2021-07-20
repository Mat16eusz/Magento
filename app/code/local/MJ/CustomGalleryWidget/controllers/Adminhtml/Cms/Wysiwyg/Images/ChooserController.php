<?php
/**
 * Mateusz Jasiak
 * 
 * @author    Mateusz Jasiak
 * @author    mateusz.jasiak.dev@gmail.com
 *
 * @package   MJ_CustomGalleryWidget
 */
require_once  'Mage/Adminhtml/controllers/Cms/Wysiwyg/ImagesController.php';

class MJ_CustomGalleryWidget_Adminhtml_Cms_Wysiwyg_Images_ChooserController
extends Mage_Adminhtml_Cms_Wysiwyg_ImagesController
{
    /**
     * Fire when select image
     *
     * @return void
     */
    public function onInsertAction()
    {
        $helper = Mage::helper('cms/wysiwyg_images');
        $storeId = $this->getRequest()->getParam('store');

        $filename = $this->getRequest()->getParam('filename');
        $filename = $helper->idDecode($filename);

        Mage::helper('catalog')->setStoreId($storeId);
        $helper->setStoreId($storeId);

        $fileUrl = $helper->getCurrentUrl() . $filename;
        $mediaPath = str_replace(Mage::getBaseUrl('media'), 'media/', $fileUrl);


        $this->getResponse()->setBody($mediaPath);
    }

    /**
     * Allow requests for all admin users
     *
     * @return bool
     */
    protected function _isAllowed()
    {
        return true;
    }
}
