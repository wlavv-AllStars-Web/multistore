<?php

namespace Asgroug\Controller;

use AdminController;

class CustomAdminController extends AdminController
{
    public function initPageHeaderToolbar()
    {
        error_log('Custom toolbar being initialized');
        parent::initPageHeaderToolbar();

        // Initialize toolbar buttons collection
        $toolbarButtonsCollection = [];

        // Call the hook to allow other modules to add buttons
        \Hook::exec('actionGetAdminToolbarButtons', [
            'controller' => $this,
            'toolbar_extra_buttons_collection' => &$toolbarButtonsCollection,  // Pass by reference
        ]);

        // Add each custom button to the page header toolbar
        foreach ($toolbarButtonsCollection as $button) {
            $this->page_header_toolbar_btn[] = $button;
        }
    }

    public function renderList()
    {
        $this->setTemplate('custom_template.tpl');
        // Render your list or grid here
        return parent::renderList();
    }
}
