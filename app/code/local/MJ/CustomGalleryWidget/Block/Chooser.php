<?php
/**
 * Mateusz Jasiak
 * 
 * @author    Mateusz Jasiak
 * @author    mateusz.jasiak.dev@gmail.com
 *
 * @package   MJ_CustomGalleryWidget
 */
class MJ_CustomGalleryWidget_Block_Chooser extends Mage_Adminhtml_Block_Widget_Form_Renderer_Fieldset_Element
{
    /**
     * Generating widget.xml file to change the number of photos in a loop
     * and possibility to choose photos in adminpanel
     *
     * @param Varien_Data_Form_Element_Abstract $element
     * @return string
     */
    public function render(Varien_Data_Form_Element_Abstract $element)
    {
        $dom = new DOMDocument('1.0', 'UTF-8');
        $dom->formatOutput = true;

        $root = $dom->createElement('widgets');
        $dom->appendChild($root);

        $result = $dom->createElement('sample_carousel');
        $root->appendChild($result);

        $result->setAttribute('type', 'customgallerywidget/widget_carousel');
        $result->setAttribute('module', 'customgallerywidget');

        $result->appendChild($dom->createElement('name', $this->__('Custom gallery widget')));

        $parameters = $dom->createElement('parameters');
        $result->appendChild($parameters);

        $images = $dom->createElement("image");
        $parameters->appendChild($images);

        $images->appendChild($dom->createElement('label', $this->__('Image')));
        $images->appendChild($dom->createElement('visible', '1'));
        $images->appendChild($dom->createElement('required', '1'));
        $images->appendChild($dom->createElement('type', 'customgallerywidget/chooser'));
        
        for ($i = 0; $i < 49; $i++) {
            $images = $dom->createElement("image$i");
            $parameters->appendChild($images);

            $images->appendChild($dom->createElement('label', $this->__('Image')));
            $images->appendChild($dom->createElement('visible', '1'));
            $images->appendChild($dom->createElement('type', 'customgallerywidget/chooser'));
        }

        $dom->save('app/code/local/MJ/CustomGalleryWidget/etc/widget.xml');


        $prefix = $element->getForm()->getHtmlIdPrefix();
        $elementId = $prefix . $element->getId();

        $chooserUrl = $this->getUrl('*/cms_wysiwyg_images_chooser/index', array('target_element_id' => $elementId));

        $label = ($element->getValue()) ? $this->__('Change Image') : $this->__('Insert Image');

        $chooseButton = $this->getLayout()->createBlock('adminhtml/widget_button')
            ->setType('button')
            ->setClass('btn-chooser')
            ->setLabel($label)
            ->setOnclick('MediabrowserUtility.openDialog(\'' . $chooserUrl . '\')')
            ->setDisabled($element->getReadonly())
            ->setStyle('display:inline;margin-top:7px');

        $removeButton = $this->getLayout()->createBlock('adminhtml/widget_button')
            ->setType('button')
            ->setClass('delete')
            ->setLabel($this->__('Remove Image'))
            ->setOnclick(
                'document.getElementById(\''. $elementId .'\').value=\'\';if(document.getElementById(\''. $elementId
                .'_image\'))document.getElementById(\''. $elementId .'_image\').parentNode.remove()'
            )
            ->setDisabled($element->getReadonly())
            ->setStyle('margin-left:10px;margin-top:7px');

        $element->setData('after_element_html', $chooseButton->toHtml() . $removeButton->toHtml());

        $this->_element = $element;
        return $this->toHtml();
    }
}
