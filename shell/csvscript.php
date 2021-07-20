<?php
/**
 * Mateusz Jasiak
 * 
 * @author    Mateusz Jasiak
 * @author    mateusz.jasiak.dev@gmail.com
 *
 * @package   MJ_Shell
 */
require_once 'abstract.php';
 
class GS_Shell_CSVScript extends Mage_Shell_Abstract
{
    /**
     * Gets a colletion of product only of the configurtable typ and saving to a csv file
     *
     * @return void
     */
    public function makeBackupCSVFile()
    {
        $collection = Mage::getModel('catalog/product')->getCollection()
            ->addAttributeToSelect('*')
            ->addAttributeToFilter('type_id', array('eq' => 'configurable'))
            ->setCurPage(1)
            ->joinField(
                'qty',
                'cataloginventory/stock_item',
                'qty',
                'product_id = entity_id',
                '{{table}}.stock_id = 1',
                'left'
            );

        $date = Mage::getModel('core/date')->Date('Y-m-d H-i-s');

        $fileToWrite = "orders_{$date}.csv";

        $fopen = new Varien_Io_File();
        $path = Mage::getBaseDir('var') . DS . 'export' . DS;
        $file = $path . DS . $fileToWrite;
        $fopen->open(array('path' => $path));
        $fopen->streamOpen($file, 'w');
        $fopen->streamLock(true);

        foreach ($collection as $product) {
            $fields = array(
            $product->getName(),
            (float) $product->getPrice(),
            $product->getSKU(),
            (int) $product->getQty()
            );

            $fopen->streamWriteCsv($fields);
        }

        $fopen->streamUnlock();
        $fopen->streamClose();
    }

    /**
     * @return void
     */
    public function run()
    {
        $this->makeBackupCSVFile();
    }

    public function usageHelp()
    {
        return <<<USAGE
Usage:  php -f csvscript.php [options]

  help           This help
USAGE;
    }
}

$shell = new GS_Shell_CSVScript();
$shell->run();
