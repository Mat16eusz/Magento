<?php
/**
 * Mateusz Jasiak
 * 
 * @author    Mateusz Jasiak
 * @author    mateusz.jasiak.dev@gmail.com
 *
 * @package   MJ_CustomGalleryWidget
 */
class MJ_CustomGalleryWidget_Block_Carousel extends Mage_Core_Block_Template
{
    /**
     * Set default template
     *
     * @return void
     */
    protected function _construct()
    {
        $this->setData('template', 'mj_customgallerywidget/carousel.phtml');
        parent::_construct();
    }

    /**
     * @return string
     */
    public function getImageUrl()
    {
        $array = array();
        $i = 0;
        $counter = 0;
        while ($this->getData("image{$i}") == true) {
            $array[$i] = $this->getData("image{$i}");
            $i++;
            $counter = $i;
        }

        $arrayRow = array();
        for ($i = 0; $i < $counter; $i++) {
            $array[$i] = $this->getData("image{$i}");
            $arrayRow[$i] =
            "<div class='carousel-item'><img class='d-block w-100' alt='Next slides' src={$array[$i]} /></div>";
        }

        $paramOne = $this->getData("image");
        $firstParamLine = "<div class='carousel-item active'><img class='d-block w-100'
        alt='First slide' src={$paramOne} /></div>";
        array_unshift($arrayRow, $firstParamLine);

        for ($i = 0; $i < $counter; $i++) {
            $params = implode('', $arrayRow);
        }

        return $params;
    }
}
