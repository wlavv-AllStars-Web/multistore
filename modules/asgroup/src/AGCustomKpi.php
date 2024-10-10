<?php
namespace PrestaShop\Module\AsGroup;

use Context;
use Tools;
use PrestaShop\PrestaShop\Core\Kpi\KpiInterface;

/**
 * @internal
 */
final class AGCustomKpi implements KpiInterface
{
    /**
     * {@inheritdoc}
     */
    public function render()
    {
       // Get the translator from the context
       $translator = Context::getContext()->getTranslator();
        
       // Generate the URL for the image
       // Note: Using getModuleLink to generate a URL to the image
       $shopId = Context::getContext()->cookie->shopContext;
       $shopId = str_replace(['s-', ' '], '', $shopId);
       
        // echo '<pre>'.print_r(Tools::getValue('action'),1).'</pre>';
        if($shopId == ''){
            $shopId = "0";
        }

       $imageUrl = Context::getContext()->link->getMediaLink('/modules/asgroup/views/img/'.$shopId.'.png');

       error_log('Image URL: ' . $imageUrl); 

       // Build the HTML output
        $html = '<div class="kpi-container box-stats">';
        $html .= '<div class="kpi-content -color1" style="display:flex;flex-direction:column;gap:1rem;align-items:center;justify-content:center;padding-left:0;">';
        $html .= '<img src="' . htmlspecialchars($imageUrl) . '" alt="' . htmlspecialchars($translator->trans('Total Users', [], 'Admin.Global')) . '" style="width: 200px; height: auto;">'; // Adjust size as needed
        // $html .= '<span class="title" style="font-size: 2rem;color: #333; font-weight: 600;">' . $shopName . '</span>'; // Title
        $html .= '</div>'; // Close kpi-content
        $html .= '</div>';

       return $html;
    }
}