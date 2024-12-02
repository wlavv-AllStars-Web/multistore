<form id="generate_{$module_prefix|escape:'htmlall':'UTF-8'}_shipping_label_form" name="generate_{$module_prefix|escape:'htmlall':'UTF-8'}_shipping_label_form" action="{$REQUEST_URI|escape:'htmlall':'UTF-8'}" method="POST">
<div class="container-ups-asgroup">
    <div class="tab-ups-asgroup d-flex col-lg-12 py-3">
        {foreach from=${$module_prefix}_packages_for_shipment key=key item=package_for_shipment}
        {if $key < 1}
        <div class="col-lg-6">
          <h3>Caixa</h3>
          <table>
            <thead>
              <th></th>
              <th>Width: (cm)</th>
              <th>Height: (cm)</th>
              <th>Lenght: (cm)</th>
              <th>Weight: (kg)</th>
              <th></th>
            </thead>
            <tbody>
              <td style="width:30%;">
                <select id="{$module_prefix_upper|escape:'htmlall':'UTF-8'}_PACKAGE_TYPE_{$key|escape:'htmlall':'UTF-8'}" class="custom-select" name="{$module_prefix_upper|escape:'htmlall':'UTF-8'}_PACKAGE[{$key|escape:'htmlall':'UTF-8'}][type]" autocomplete="off" disabled="disabled">
                
                    {foreach from=${$module_prefix}_ups_packages key=type item=package}
                        {assign var=pack_dim value=$package[0]|cat:'_'|cat:$package[1]|cat:'_'|cat:$package[2]}
    
                        <option
                                value="{$type|escape:'htmlall':'UTF-8'}"
                                rel="{$pack_dim|escape:'htmlall':'UTF-8'}"
                                {if $package_for_shipment['type'] == $type && $pack_dim == $selected_pack_dim}selected="selected"{/if}
                        >
                            {$package[4]|escape:'htmlall':'UTF-8'}
                            ({$package[0]|escape:'htmlall':'UTF-8'}{strtolower($store_dimension_unit)|escape:'htmlall':'UTF-8'}
                            x {$package[1]|escape:'htmlall':'UTF-8'}{strtolower($store_dimension_unit)|escape:'htmlall':'UTF-8'}
                            x {$package[2]|escape:'htmlall':'UTF-8'}{strtolower($store_dimension_unit)|escape:'htmlall':'UTF-8'})
                        </option>
                    {/foreach}

                </select>
              <td>
                <div class="input-group">
                  <input id="{$module_prefix_upper|escape:'htmlall':'UTF-8'}_PACKAGE_WIDTH_{$key|escape:'htmlall':'UTF-8'}" type="text" class="form-control" placeholder="" aria-label="Shipping Cost" aria-describedby="shippigcost-euro" name="{$module_prefix_upper|escape:'htmlall':'UTF-8'}_PACKAGE[{$key|escape:'htmlall':'UTF-8'}][width]" value="{$package_for_shipment['width']|escape:'htmlall':'UTF-8'}" min="0">
                </div>
              </td>
              <td>
                <div class="input-group">
                  <input id="{$module_prefix_upper|escape:'htmlall':'UTF-8'}_PACKAGE_HEIGHT_{$key|escape:'htmlall':'UTF-8'}" type="text" class="form-control" placeholder="" aria-label="Shipping Cost" aria-describedby="shippigcost-euro" name="{$module_prefix_upper|escape:'htmlall':'UTF-8'}_PACKAGE[{$key|escape:'htmlall':'UTF-8'}][height]" value="{$package_for_shipment['height']|escape:'htmlall':'UTF-8'}" min="0">
                </div>
              </td>
              <td>
                <div class="input-group">
                  <input id="{$module_prefix_upper|escape:'htmlall':'UTF-8'}_PACKAGE_DEPTH_{$key|escape:'htmlall':'UTF-8'}" type="text" class="form-control" placeholder="" aria-label="Shipping Cost" aria-describedby="shippigcost-euro" name="{$module_prefix_upper|escape:'htmlall':'UTF-8'}_PACKAGE[{$key|escape:'htmlall':'UTF-8'}][depth]" value="{$package_for_shipment['depth']|escape:'htmlall':'UTF-8'}" min="0">
                </div>
              </td>
              <td>
                <div class="input-group">
                  <input id="{$module_prefix_upper|escape:'htmlall':'UTF-8'}_PACKAGE_WEIGHT_{$key|escape:'htmlall':'UTF-8'}" type="text" class="form-control" placeholder="" aria-label="Shipping Cost" aria-describedby="shippigcost-euro" name="{$module_prefix_upper|escape:'htmlall':'UTF-8'}_PACKAGE[{$key|escape:'htmlall':'UTF-8'}][weight]" value="{$package_for_shipment['weight']|escape:'htmlall':'UTF-8'}" min="0">
                </div>
              </td>
              
              <td>
                <button type="button" name="update_information" id="update_information" class="btn btn-warning" rel="package_information">
                    <i class="fa fa-edit"></i>
                    <span>{l s='Update' mod='upsdotcom'}</span>
                </button>
              </td>
              
            </tbody>
          </table>
          {/if}
          {/foreach}
        </div>

        <div class="col-lg-6 d-flex">
          <div class="card_estimated col-lg-4">
            <h3>Estimativa</h3>
            <div class="card_estimated_content">
              <span id="postageTotal">4.79€</span>
              <span id="estime_postage"><i class="material-icons">autorenew</i></span>
            </div>
          </div>

          <div class="card_generate col-lg-4">
            <h3>Gerar</h3>
            <div class="card_generate_content">
              <button id="generate_shipping_label" class="btn-generate-document-ups">
                <i class="material-icons">file_download</i>
                
              </button>
            </div>
          </div>

          <div class="card_documents col-lg-4">
            <h3>Documentos</h3>
            
            <div id="generated_shipping_labels" class="card_documents_list">
              <div class="card_documents_list_item">
                <i class="material-icons">insert_drive_file</i> 
                <span>hahbsad123</span>
              </div>
              <div class="card_documents_list_item">
                <i class="material-icons">insert_drive_file</i> 
                <span>hahbsad123</span>
              </div>
            </div>
          </div>
        </div>

      </div>
      <div id="shipping_label_results" class=""></div>
</div>
</form>

<!--
<div style="float: left; width: 300px;">
    {if !${$module_prefix}_is_intl}
        {include file="./panels/preview/_domestic_shipment_information.tpl"}
    {else}
        {include file="./panels/preview/_international_shipment_information.tpl"}
    {/if}
</div>

<div style="float: left; width: 370px;overflow: hidden;margin-left: 25px;">
    <div>{include file="./panels/preview/_packages_information.tpl"}</div>
    <div style="float: left; width: 400px; display: none;">{include file="./panels/preview/_shipper_information.tpl"}</div>
    <div style="float: left; width: 400px; display: none;">{include file="./panels/preview/_recipient_information.tpl"}</div>
</div>

<div style="float: left; width: 165px;margin-left: 25px;">
    <h3 style="width: 100%; float: left; margin: 0 0 5px 0; font-size: 11px; text-align: center;border-bottom: 0px solid red;">
        {l s='Estimativa' mod='upsdotcom'}
        <br>
        <span id="postageTotal" style="width: 100%;">{l s='Calculating Postage...' mod='upsdotcom'}</span>
        <br>
        <span style="cursor: pointer;" id="estime_postage">({l s='Re-calculate' mod='upsdotcom'})</span>
    </h3>    
</div>

<div style="float: left; width: 250px;margin-left: 25px;">
    <h3 style="width: 100%; float: left; margin: 0 0 5px 0; font-size: 11px; text-align: center;border-bottom: 0px solid red;">
        {l s='Gerar guias' mod='upsdotcom'}
    </h3>
    <div class="new-line text-center" style="margin-top: 10px;">
        <button type="button" name="generate_shipping_label" id="generate_shipping_label" class="new-button no-margin" disabled="disabled" style="font-size: 18px;width: 105px;">
            <i class="fa fa-sign-in" style="font-size: 40px;"></i>
            <br>
            {l s='Generate' mod='upsdotcom'}
        </button>
        <button type="button" name="void_shipping_label" id="void_shipping_label" class="new-button no-margin" {if $is_voided}disabled="disabled"{/if} style="font-size: 18px;width: 105px;">
            <i class="fa fa-sign-out" style="font-size: 40px;"></i>
            <br>
            {l s='Void' mod='upsdotcom'}
        </button>
    </div>
</div>

<div style="float: left; width: calc( 100% - 1200px); margin-left: 25px;">
    <div id="shipping_label_results" class="full-screen float-left "></div>
    <div id="generated_shipping_labels" class="panel hidden-element"></div>
</div>
-->
<style>
    /* #postageTotal{ color: green; font-size: 25px; } */
    /* #estime_postage{ color: orange; font-size: 18px; } */
    #expand_ups{ width: 100%; }
    
    .tab-ups-asgroup .card_estimated{
    display:flex;
    flex-direction:column;
    justify-content:space-between;
}

.tab-ups-asgroup .card_estimated_content{
    display:flex;
    align-items:center;
    gap:1rem;
}

.tab-ups-asgroup .card_estimated_content span:nth-child(1){
    font-size:2rem;
    font-weight: 700;
    color: forestgreen;
}
.tab-ups-asgroup .card_estimated_content span:nth-child(2) i{
    color: #fff; 
    width: 28px;
    height:28px;
    display:flex;
    justify-content:center;
    align-items:center;
    background: orange;
    border-radius: 50%;
}

.tab-ups-asgroup .card_generate {
    display:flex;
    flex-direction:column;
    justify-content:space-between;
}

.tab-ups-asgroup .card_generate .card_generate_content{
    /* background: #f6f6f6; */
}
.tab-ups-asgroup .card_generate .card_generate_content .btn-generate-document-ups{
    border: 2px solid #2121;
    border-radius: .25rem;
    max-width: 115px;
    width: 100%;
    padding: .5rem;
}
.tab-ups-asgroup .card_generate .card_generate_content .btn-generate-document-ups i {
    font-size: 2rem;
}

.tab-ups-asgroup .card_documents_list {
    
}

#estime_postage:hover{
    cursor:pointer;
    opacity: 0.8;
}
</style>