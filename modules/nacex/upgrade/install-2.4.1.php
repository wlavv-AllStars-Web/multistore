<?php
/**
 * File: /upgrade/install-2.4.1.php
 */


function upgrade_module_2_4_1($object)
{
    $object->uninstallTab();
    $object->install();

    return true;
}