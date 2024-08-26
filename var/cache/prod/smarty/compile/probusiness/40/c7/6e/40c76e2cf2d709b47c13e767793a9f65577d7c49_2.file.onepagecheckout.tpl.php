<?php
/* Smarty version 4.3.4, created on 2024-08-22 09:20:46
  from '/home/asw200923/beta/themes/probusiness/modules/ets_onepagecheckout/views/templates/hook/onepagecheckout.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.4',
  'unifunc' => 'content_66c6f4deed6682_79824678',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '40c76e2cf2d709b47c13e767793a9f65577d7c49' => 
    array (
      0 => '/home/asw200923/beta/themes/probusiness/modules/ets_onepagecheckout/views/templates/hook/onepagecheckout.tpl',
      1 => 1723201783,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'module:ets_onepagecheckout/views/templates/hook/layout_1.tpl' => 1,
    'module:ets_onepagecheckout/views/templates/hook/layout_2.tpl' => 1,
    'module:ets_onepagecheckout/views/templates/hook/layout_3.tpl' => 1,
    'module:ets_onepagecheckout/views/templates/hook/layout_4.tpl' => 1,
  ),
),false)) {
function content_66c6f4deed6682_79824678 (Smarty_Internal_Template $_smarty_tpl) {
?><style>
<?php echo $_smarty_tpl->tpl_vars['css_extra']->value;?>

</style>
<?php echo '<script'; ?>
 type="text/javascript">
var confirm_product = '<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Do you want to delete this product?','mod'=>'ets_onepagecheckout','js'=>1),$_smarty_tpl ) );?>
';
var confirm_discount = '<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Do you want to delete this discount?','mod'=>'ets_onepagecheckout','js'=>1),$_smarty_tpl ) );?>
';
var iso_code_state='';
var ets_opc_date_format_lite ='<?php echo htmlspecialchars((string) call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['date_format_lite']->value,'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
';
var countries = {};
var ETS_OPC_USE_NAME_ACCOUNT =<?php echo htmlspecialchars((string) call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'intval' ][ 0 ], array( Configuration::get('ETS_OPC_USE_NAME_ACCOUNT') )), ENT_QUOTES, 'UTF-8');?>
;
var countriesNeedZipCode = {};
var login_before_text = '<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Please login before completing your order','mod'=>'ets_onepagecheckout','js'=>1),$_smarty_tpl ) );?>
';
<?php if ($_smarty_tpl->tpl_vars['list_countries']->value) {?>
    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['list_countries']->value, 'country');
$_smarty_tpl->tpl_vars['country']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['country']->value) {
$_smarty_tpl->tpl_vars['country']->do_else = false;
?>
        countries[<?php echo htmlspecialchars((string) call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'intval' ][ 0 ], array( $_smarty_tpl->tpl_vars['country']->value['id_country'] )), ENT_QUOTES, 'UTF-8');?>
] ={};
        countries[<?php echo htmlspecialchars((string) call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'intval' ][ 0 ], array( $_smarty_tpl->tpl_vars['country']->value['id_country'] )), ENT_QUOTES, 'UTF-8');?>
]['iso_code'] = '<?php echo htmlspecialchars((string) call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['country']->value['iso_code'],'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
';
        countriesNeedZipCode[<?php echo htmlspecialchars((string) call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'intval' ][ 0 ], array( $_smarty_tpl->tpl_vars['country']->value['id_country'] )), ENT_QUOTES, 'UTF-8');?>
] = '<?php echo htmlspecialchars((string) call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['country']->value['zip_code_format'],'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
';
    <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);
}
echo '</script'; ?>
>
<?php if ($_smarty_tpl->tpl_vars['ETS_OPC_ADDRESS_GOOGLE_AUTOFILL_ENABLED']->value) {?>
    <?php echo '<script'; ?>
>
    
    var shipping_autocomplete,invoice_autocomplete;
    
    var componentForm = {
      locality: 'long_name',
      country: 'short_name',
      postal_code_prefix: 'short_name'
    };
    
    function initAutocomplete() {

      shipping_autocomplete = new google.maps.places.Autocomplete(
          document.getElementById('shipping_address_address1'), {types: ['geocode']});
      shipping_autocomplete.setFields(['address_component']);
      shipping_autocomplete.addListener('place_changed', fillInShippingAddress);
      invoice_autocomplete = new google.maps.places.Autocomplete(
          document.getElementById('invoice_address_address1'), {types: ['geocode']});
    
      invoice_autocomplete.setFields(['address_component']);
      invoice_autocomplete.addListener('place_changed', fillInInvoiceAddress);
    }
    
    function fillInShippingAddress() {
      var place = shipping_autocomplete.getPlace();
      if(place)
      for (var i = 0; i < place.address_components.length; i++) {
        var addressType = place.address_components[i].types[0];

        if (componentForm[addressType]) {
          var val = place.address_components[i]['short_name'];

          if(addressType=='country')
          {
              
                if($('#shipping_address_id_country option').length)
                {
                    var $ok = false;
                    $('#shipping_address_id_country option').each(function(){
                        if($(this).attr('data-iso-code')==val)
                        {
                            $ok = true;
                            if($('#shipping_address_id_country').val()!=$(this).attr('value') && $(this).attr('selected')!='selected')
                            {
                                $('#shipping_address_id_country option').removeAttr('selected');
                                $(this).attr('selected','selected');
                                $('#shipping_address_id_country').val($(this).attr('value'));
                                $('#shipping_address_id_country').change(); 
                            }
                           
                        }
                   });
                   if(!$ok)
                   {
                        $('#shipping_address_id_country option').removeAttr('selected');
                        $('#shipping_address_id_country').val('');
                        $('#shipping_address_id_country').change(); 
                   }
                }
                
          }
          if(addressType=='locality')
          {
                if($('#shipping_address_city').length)
                {
                    $('#shipping_address_city').val(val);
                    $('#shipping_address_city').change();
                }
          }
          

          if(addressType=='postal_code_prefix')
          {
              
                if($('#shipping_address_postal_code').length)
                {
                    $('#shipping_address_postal_code').val(val);
                    $('#shipping_address_postal_code').change();
                    $('#shipping_address_postal_code').focus();
                }
          }
        }
        else
        {
            if(addressType=='administrative_area_level_1')
            {
                iso_code_state = place.address_components[i]['short_name'];
                if($('#shipping_address_id_state').length)
                {
                    $('#shipping_address_id_state option').each(function(){
                        if($(this).attr('data-iso-code')==iso_code_state && $('#shipping_address_id_state').val()!=$(this).attr('value') && $(this).attr('selected')!='selected')
                        {
                           $('#shipping_address_id_state option').removeAttr('selected');
                           $(this).attr('selected','selected');
                           $('#shipping_address_id_state').val($(this).attr('value'));
                           $('#shipping_address_id_state').change(); 
                        }
                   });
                }
            }
        }
      }
    }
    function fillInInvoiceAddress() {
      var place = invoice_autocomplete.getPlace();
      for (var i = 0; i < place.address_components.length; i++) {
        var addressType = place.address_components[i].types[0];
        if (componentForm[addressType]) {
          var val = place.address_components[i][componentForm[addressType]];
          if(addressType=='country')
          {
                if($('#invoice_address_id_country option').length)
                {
                    var $ok = false;
                    $('#invoice_address_id_country option').each(function(){
                        if($(this).attr('data-iso-code')==val)
                        {
                            $ok = true;
                            if($('#invoice_address_id_country').val()!=$(this).attr('value') && $(this).attr('selected')!='selected')
                            {
                                $('#invoice_address_id_country option').removeAttr('selected');
                                $(this).attr('selected','selected');
                                $('#invoice_address_id_country').val($(this).attr('value'));
                                $('#invoice_address_id_country').change(); 
                            }
                           
                        }
                   }); 
                   if(!$ok)
                   {
                        $('#invoice_address_id_country option').removeAttr('selected');
                        $('#invoice_address_id_country').val('');
                        $('#invoice_address_id_country').change(); 
                   }
                }
          }
          if(addressType=='locality')
          {
                if($('#invoice_address_city').length)
                {
                    $('#invoice_address_city').val(val);
                    $('#invoice_address_city').change();
                }
          }
          if(addressType=='postal_code')
          {
                if($('#invoice_address_postal_code').length)
                {
                    $('#invoice_address_postal_code').val(val);
                    $('#invoice_address_postal_code').change();
                }
          }
        }
        else
        {
            if(addressType=='administrative_area_level_1')
            {
                iso_code_state = place.address_components[i][componentForm[addressType]];
                if($('#invoice_address_id_state').length)
                {
                    $('#invoice_address_id_state option').each(function(){
                        if($(this).attr('data-iso-code')==iso_code_state && $('#invoice_address_id_state').val()!=$(this).attr('value') && $(this).attr('selected')!='selected')
                        {
                           $('#invoice_address_id_state option').removeAttr('selected');
                           $(this).attr('selected','selected');
                           $('#invoice_address_id_state').val($(this).attr('value'));
                           $('#invoice_address_id_state').change(); 
                        }
                   });
                }
            }
        }
      }
    }
    function geolocate() {
      if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(function(position) {
          var geolocation = {
            lat: position.coords.latitude,
            lng: position.coords.longitude
          };
          var circle = new google.maps.Circle(
              {center: geolocation, radius: position.coords.accuracy});
          autocomplete.setBounds(circle.getBounds());
        });
      }
    }
    
    <?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
 src="https://maps.googleapis.com/maps/api/js?key=<?php echo htmlspecialchars((string) call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['ETS_OPC_GOOGLE_KEY_API']->value,'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
&libraries=places&callback=initAutocomplete"
        async defer><?php echo '</script'; ?>
>
<?php }?>
<div id="onepagecheckout-information-errros" class="" style="">
    <?php if ($_smarty_tpl->tpl_vars['isAvailable']->value) {?>
        <?php echo $_smarty_tpl->tpl_vars['isAvailable']->value;?>

    <?php }?>
</div>
<?php if ($_smarty_tpl->tpl_vars['opc_layout']->value == 'layout_1') {?>
    <?php $_smarty_tpl->_subTemplateRender('module:ets_onepagecheckout/views/templates/hook/layout_1.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
} elseif ($_smarty_tpl->tpl_vars['opc_layout']->value == 'layout_2') {?>
    <?php $_smarty_tpl->_subTemplateRender('module:ets_onepagecheckout/views/templates/hook/layout_2.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
} elseif ($_smarty_tpl->tpl_vars['opc_layout']->value == 'layout_3') {?>
    <?php $_smarty_tpl->_subTemplateRender('module:ets_onepagecheckout/views/templates/hook/layout_3.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
} elseif ($_smarty_tpl->tpl_vars['opc_layout']->value == 'layout_4') {?>
    <?php $_smarty_tpl->_subTemplateRender('module:ets_onepagecheckout/views/templates/hook/layout_4.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
}?>

<div class="modal fade" id="modal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
            <div class="js-modal-content">
                <?php echo $_smarty_tpl->tpl_vars['terms_page']->value->content;?>

            </div>
        </div>
    </div>
</div><?php }
}
