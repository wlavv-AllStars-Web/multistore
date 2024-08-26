<?php
/* Smarty version 4.3.4, created on 2024-08-26 09:05:39
  from '/home/asw200923/beta/themes/probusiness/templates/index.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.4',
  'unifunc' => 'content_66cc3753665c71_35776010',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '3e538e0c3299f8bc44d7c4053380e865cecdf2f0' => 
    array (
      0 => '/home/asw200923/beta/themes/probusiness/templates/index.tpl',
      1 => 1723217230,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_66cc3753665c71_35776010 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>


    <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_212035261766cc3753659911_83262536', 'page_content_container');
?>

<?php $_smarty_tpl->inheritance->endChild($_smarty_tpl, 'page.tpl');
}
/* {block 'page_content_top'} */
class Block_183681499166cc3753659e54_84292667 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
}
}
/* {/block 'page_content_top'} */
/* {block 'hook_home'} */
class Block_28163960066cc375365a997_52457466 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

                          <div class="not_logged_homepage">
                <div class="banner_home hidden-sm-down" >
                <a href="<?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['homepage_footer']->value['link_banner'], ENT_QUOTES, 'UTF-8');?>
">
                  <img src="/img/asd/homepage/main.webp?<?php echo htmlspecialchars((string) rand(), ENT_QUOTES, 'UTF-8');?>
" alt="<?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['homepage_footer']->value['alt_banner'], ENT_QUOTES, 'UTF-8');?>
" style="width: 100%;height:auto;" width="1690" height="443" loading="eager" />
                </a>
                </div>

                <div class="profile_container_homepage">
                  <div class="profile_style"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Profile','d'=>'Shop.Theme.HomepageLogout'),$_smarty_tpl ) );?>
</div>
                  <div class="profile_container_text" id="profile_data">
                  <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Supplying over 30 top of the line brands to automotive performance professionals worldwide, All Stars Distribution is one of the largest European wholesalers of performance and design parts. Dedicated to serving shops, tuners, e-dealers and other resellers, All Stars Distribution is committed to employing the best of inventory management and distribution practices to get our customers the performance parts they need to satisfy their customers.','d'=>'Shop.Theme.HomepageLogout'),$_smarty_tpl ) );?>

                  
                  </div>
                  <div id="profile_container_text1 " class="card_view_more mobile" onclick="expandText(this)"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'View More','d'=>'Shop.Theme.HomepageLogout'),$_smarty_tpl ) );?>
</div>
                </div>

                <div id="why_us_anchor">
                  <div class="why_card">
                    <img src="/img/asd/homepage/stock_<?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['language']->value['iso_code'], ENT_QUOTES, 'UTF-8');?>
.webp"  alt="stock" width="536" height="268" loading="lazy"/>
                    <div id="thumb_data_1" class="card_text" >
                    <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'As a wholesaler, the importance of inventory, having it and managing it, cannot be overstated. All Stars Distribution places the highest priority on maintaining the depth and breadth of our inventory all year round. To quickly supply a wide range of specialized products, often manufactured in small quantities to serve the just-in-time market, WE STOCK 98% of our partner manufacturers’ product lines. By choosing All Stars Distribution as a supplier for your performance parts, you will have a direct access to the largest stock of niche market products in Europe, without any financial, human or logistical constraints! Our Warehouse Management and Enterprise Resource Planning Systems, developed in-house by our Information Technology Team, allow us to limit stockouts as much as possible using extremely reliable purchasing algorithms for quick order fulfillment!','d'=>'Shop.Theme.HomepageLogout'),$_smarty_tpl ) );?>

                    
                    </div>
                    <div id="card_expand1" class="card_view_more" ><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'View More','d'=>'Shop.Theme.HomepageLogout'),$_smarty_tpl ) );?>
</div>
                  </div>

                  <div class="why_card">
                    <img src="/img/asd/homepage/logistics_<?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['language']->value['iso_code'], ENT_QUOTES, 'UTF-8');?>
.webp" alt="logistics" loading="lazy" width="536" height="268" />
                    <div id="thumb_data_2" class="card_text">
                    <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Order management is at the foundation of our business. Our efficiency in picking, packing and dispatching will determine the level of satisfaction of your customers. To ensure a fast and reliable operation we use a specific Order Fulfillment Software developed in-house by our Information Technology Team. Our proprietary software, called "All Stars Log", applied to the picking, packing and reception, ensures a "double check control" providing us an error rate close to 0! Our system’s responsiveness and processing capacity assist us in getting 94% of orders processed and shipped, using premium packaging accessories, in less than 6 hours. Retail quality service for the wholesale market.','d'=>'Shop.Theme.HomepageLogout'),$_smarty_tpl ) );?>

                    
                    </div>
                    <div id="card_expand2" class="card_view_more" ><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'View More','d'=>'Shop.Theme.HomepageLogout'),$_smarty_tpl ) );?>
</div>
                  </div>

                  <div class="why_card">
                    <img src="/img/asd/homepage/shipping_<?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['language']->value['iso_code'], ENT_QUOTES, 'UTF-8');?>
.webp" alt="shipping" loading="lazy" width="536" height="268" />
                    <div id="thumb_data_3" class="card_text">
                    <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'As an international distributor we understand the importance of reliable third-party shipping partnerships and managing shipping expenses. To help limit and simplify these costs, we offer various options to our customers such as Flat Rate shipping charges, applying a scale of only two values per country of destination. Resellers can take advantage of our Drop Shipping option through which your customer receives the product directly from our warehouse, but showing the name of your company as the sender! Our Pick Up option allows our customers to organize the collection and the shipping of their goods via their own carrier.','d'=>'Shop.Theme.HomepageLogout'),$_smarty_tpl ) );?>

                    
                    </div>
                    <div id="card_expand3" class="card_view_more" ><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'View More','d'=>'Shop.Theme.HomepageLogout'),$_smarty_tpl ) );?>
</div>
                  </div>

                  <div class="why_card">
                    <img src="/img/asd/homepage/online_<?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['language']->value['iso_code'], ENT_QUOTES, 'UTF-8');?>
.webp" alt="online" loading="lazy" width="536" height="268" />
                    <div id="thumb_data_4" class="card_text">
                    <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Our online platform, developed in-house by our IT department, is constantly evolving to offer our customers more and more digital tools! Among other things, through our trade portal you can consult our products and stock levels, see the Retail Prices and your discounts, place your orders and follow their progress until the final delivery. In a few clicks, you can track your parcels, check your proforma and final invoices, see your statistics, manage your account or contact our support teams--currently available in 5 languages (French, English, Spanish, Portuguese and Romanian). Offering a unique platform in Europe, exclusively dedicated to wholesale, All Stars Distribution has all the products and services required to support and develop your business!','d'=>'Shop.Theme.HomepageLogout'),$_smarty_tpl ) );?>

                    
                    </div>
                    <div id="card_expand4" class="card_view_more" ><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'View More','d'=>'Shop.Theme.HomepageLogout'),$_smarty_tpl ) );?>
</div>
                  </div>

                  <div class="why_card">
                    <img src="/img/asd/homepage/catalog_<?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['language']->value['iso_code'], ENT_QUOTES, 'UTF-8');?>
.webp" alt="catalogue" loading="lazy" width="536" height="268"/>
                    <div id="thumb_data_5" class="card_text">
                    <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Our purchasing department, made up of enthusiasts with solid knowledge of the market and products, works in close collaboration with each brand we carry, to offer the best, latest products ahead of the trend. In addition to the daily listing of new products added to our catalogues, we are always working on adding to our line card—only brands that meet our very strict quality requirements. Already with an exclusive offering of more than 30 specialized, performance enhancing brands, All Stars Distribution is your single source for the material you need to bring your customers’ projects to completion.','d'=>'Shop.Theme.HomepageLogout'),$_smarty_tpl ) );?>

                    
                    </div>
                    <div id="card_expand5" class="card_view_more" ><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'View More','d'=>'Shop.Theme.HomepageLogout'),$_smarty_tpl ) );?>
</div>
                  </div>

                  <div class="why_card">
                    <img src="/img/asd/homepage/resources_<?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['language']->value['iso_code'], ENT_QUOTES, 'UTF-8');?>
.webp" alt="resources" loading="lazy" width="536" height="268"/>
                    <div id="thumb_data_6" class="card_text">
                    <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'If you don’t make the sale, we don’t make the sale! Our design and communication teams, with the support of our IT department, are always working to provide our customers with the latest and best marketing resources. Available to all our partners/customers, these precious resources feature updated catalogues, CSV integration files, API feeds, product photos and digital content specific to each brand. Our newsletters and social media presence keep you informed, without any delay, of upcoming events, new products, new brands and the global news from our industry.','d'=>'Shop.Theme.HomepageLogout'),$_smarty_tpl ) );?>

                    
                    </div>
                    <div id="card_expand6" class="card_view_more" ><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'View More','d'=>'Shop.Theme.HomepageLogout'),$_smarty_tpl ) );?>
</div>
                  </div>

                </div>

                <div class="btns_homepage">
                  <div class="button_half" onclick="window.location.href='<?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['link']->value->getCMSLink(14), ENT_QUOTES, 'UTF-8');?>
'"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Become a Dealer','d'=>'Shop.Theme.HomepageLogout'),$_smarty_tpl ) );?>
</div>
                  <div class="button_half" onclick="window.location.href='<?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['link']->value->getCMSLink(15), ENT_QUOTES, 'UTF-8');?>
'"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Become a Supplier','d'=>'Shop.Theme.HomepageLogout'),$_smarty_tpl ) );?>
</div>
                </div>

              </div>
                      <?php
}
}
/* {/block 'hook_home'} */
/* {block 'page_content'} */
class Block_42269124566cc375365a5c3_25093045 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

          <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_28163960066cc375365a997_52457466', 'hook_home', $this->tplIndex);
?>

        <?php
}
}
/* {/block 'page_content'} */
/* {block 'page_content_container'} */
class Block_212035261766cc3753659911_83262536 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'page_content_container' => 
  array (
    0 => 'Block_212035261766cc3753659911_83262536',
  ),
  'page_content_top' => 
  array (
    0 => 'Block_183681499166cc3753659e54_84292667',
  ),
  'page_content' => 
  array (
    0 => 'Block_42269124566cc375365a5c3_25093045',
  ),
  'hook_home' => 
  array (
    0 => 'Block_28163960066cc375365a997_52457466',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

      <div id="content" class="page-home">
        <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_183681499166cc3753659e54_84292667', 'page_content_top', $this->tplIndex);
?>


        <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_42269124566cc375365a5c3_25093045', 'page_content', $this->tplIndex);
?>

      </div>
    <?php
}
}
/* {/block 'page_content_container'} */
}
