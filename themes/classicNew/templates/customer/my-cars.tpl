{extends 'customer/page.tpl'}

{* {block name='page_title'}
  {l s='My Cars' d='Shop.Theme.CustomerAccount'}
{/block} *}

{* StarterTheme: Add confirmation/error messages *}

{block name='page_content'}
    <div style="min-height: 38dvh;">
    {if isset($unsubscribeMessage)}
        <div style="text-align:center;margin: 10px auto;">
            <div class="alert alert-success">{l s="You have successfully removed the email from the newsletter list!" d='Shop.Theme.MyCars'}</div>
        </div>
    {/if}
    
    {if isset($emails)}
    
        {if strlen($car) < 10 }
    
            {capture name=path}{l s='No emails for selected car' d='Shop.Theme.MyCars'}{/capture}
            
            <div class="spacer-20"></div>
            <p class="alert alert-warning"> {l s="We don't have clientes interested in this car setup yet." d='Shop.Theme.MyCars'} </p>
    
        {else}
            {capture name=path}{l s='Emails for: ' d='Shop.Theme.MyCars'} {$car}{/capture}
            
            {assign var=check_path value="{$_SERVER['DOCUMENT_ROOT']}/img/homepage/models/{$id_brand}_{$id_type}.png"}
            
            <div style="float: left; width: 300px;">
                {if file_exists({$check_path}) }
                    <img class="img-responsive" src="/img/homepage/models/{$id_brand}_{$id_type}.png" style="margin: 10px auto 0 auto;width: 300px; cursor: pointer;">
                {else}
                    <img class="img-responsive" src="/img/homepage/models/unknown.png" style="margin: 0 auto;width: 300px; cursor: pointer;">
                {/if}
            </div>
            
            <div style="float: left; width: calc( 100% - 400px );">
                <div><h4><b>{l s='Emails of clientes for:' d='Shop.Theme.MyCars'} </b>{$car}</h4></div>
                <div class="spacer-20"></div>
                <div>{$emails}</div>
                
            </div>
        {/if}
    {else}
    
        {capture name=path}{l s='My Cars' d='Shop.Theme.MyCars'}{/capture}
     
        <h1 class="page-heading">{l s='My Cars' d='Shop.Theme.MyCars'}</h1>
        
        {if !isset($myCars.data)}
            <div style="display: flex;justify-content:center;align-items:center;">
            <div style="text-align: center;max-width:1400px;width:100%;margin:auto;">
                <p class="alert alert-warning" style="font-size: .85rem;"> 
                    {l s='You dont have any car set at the moment.' d='Shop.Theme.MyCars'} 
                    <br><br> 
                    {l s='To add your car, please use the vehicle selector in "Your car" and click in "Click to add to My cars"' d='Shop.Theme.MyCars'} 
                    <br><br><br>
                    {l s='By doing so, you are allowing us to use your email to send newsletters of our produts' d='Shop.Theme.MyCars'}
                </p>
            </div>
            </div>
        {else}
            <div class="cars-content">
                {foreach $myCars.data AS $car}
                <div class="car_container col-lg-2">
                    <div onclick="setCarSearch({$car['id_compat']})">
                        {* {assign var=check_path value="{$_SERVER['DOCUMENT_ROOT']}/img/homepage/models/{$car['id_brand']}_{$car['id_type']}.png"}

                        {if !file_exists($check_path)}
                            <img class="img-responsive" src="/img/homepage/models/{$car['id_brand']}_{$car['id_type']}.png" style="margin: 10px auto 0 auto;width: 300px; cursor: pointer;">
                        {else} *}
                            <img class="img-responsive" src="{$car['cartoon']}" style="margin: 0 auto; cursor: pointer;width:100%;max-width:300px;display:flex;">
                            {* <img class="img-responsive" src="/img/homepage/models/unknown.png" style="margin: 0 auto; cursor: pointer;"> *}
                        {* {/if} *}
                    </div>
                    <div>
                        <div class="spacer-10"></div>
                        <div onclick="setCarSearch({$car['id_compat']})" style="cursor: pointer;">
                            <div class="car-container-details"><b>{l s='Brand:' d='Shop.Theme.MyCars'}</b>   <span>{$car['brand']}</span>   </div>
                            <div class="car-container-details"><b>{l s='Model:' d='Shop.Theme.MyCars'}</b>   <span>{$car['model']}</span>   </div>
                            <div class="car-container-details"><b>{l s='Type:' d='Shop.Theme.MyCars'}</b>    <span>{$car['type']}</span>    </div>
                            <div class="car-container-details"><b>{l s='Version:' d='Shop.Theme.MyCars'}</b> <span>{$car['version']}</span> </div>	                
                        </div>
                        <div class="spacer-20"></div>
                        <div class="car-button-delete">
                            <div onclick="deleteCar({$car['id_compat']},this)" class="btn" rel="nofollow" title="Delete car">
                                <i class="fa fa-trash" aria-hidden="true"></i>
                            </div>
                        </div>   
                        <div class="spacer-20"></div>
                    </div>
                </div>
                {/foreach}
            </div>
        
            <div style="display: none;">
                <form id="ukoocompat_my_cars_custom_form" action="/{$lang_iso}/module/ukoocompat/listing" method="POST"> 
                    <input type="hidden" name="id_search" value="1"> 
                    <input type="hidden" name="id_search3" value="1"> 
                    <input type="hidden" name="id_lang" value="{Context::getContext()->language->id|escape:'html':'UTF-8'}">
                    <input type="hidden" id="multiFilter_news" name="news_compats" value="0"> 
                    <input type="hidden" id="multiFilter_order_by" name="order_by_compats" value="position"> 
                    <input type="hidden" id="multiFilter_order_by_orientation" name="order_by_orientation_compats" value="DESC"> 
                    <input type="hidden" id="multiFilter_id_manufacturer" name="id_manufacturer_compats" value=""> 
                    <input type="hidden" id="multiFilter_nr_items" name="nr_items_compats" value="20"> 
                    <input type="hidden" id="multiFilter_n_items" name="n" value="20"> 
                    <input type="hidden" id="multiFilter_page_number" name="p" value="1"> 
                    <input type="hidden" id="multiFilter_id_category" name="id_category" value="0"> 
                    <input type="hidden" id="multiFilter_root_page" name="root_page" value="">
                    <input type="hidden" id="check_form" name="check_form" value="99585">
                    <input type="hidden" id="custom_filter_1" name="filters1" value="87">
                    <input type="hidden" id="custom_filter_2" name="filters2" value="864">
                    <input type="hidden" id="custom_filter_3" name="filters3" value="865">
                    <input type="hidden" id="custom_filter_4" name="filters4" value="866">
                </form>
            </div>
        {/if}
    {/if}
    
    <div class="spacer-20"></div>
    
    {* <ul class="footer_links clearfix">
        <li>
            <a class="btn btn-default btn-sm icon-left" href="{$base_dir}" title="{l s='Home'}">
                <span>
                    {l s='Home'}
                </span>
            </a>
        </li>
    </ul> *}
    </div>
    
    
    <style>
        #table_my_cars > thead > td { width: 500px; }
        /* .car_container{ width: 300px; float: left;margin: 20px;font-size: 18px; line-height: 2; border: 1px solid #dedede;text-align: center;background-color: #ededed; } */

        .cars-content {
            display: flex;
            flex-wrap: wrap;
        }
        .car_container {
            padding: 1rem;
            max-width: 359.2px;
            flex: 1;
            margin: .5rem;
            min-width: 347px;
        }
        .car-container-details {
            text-align: center;
        }

        .car_container-details b{
            font-size: .85rem;
            color: #333;
        }
        .car_container-details span{
            font-size: .85rem;
            color: #333;
        }

        .car-button-delete{
            display: flex;
            justify-content: center;
            padding: .5rem 1rem;
        }

        .car-button-delete .btn{
            border-radius: .25rem;
            background: var(--asm-color);
            cursor: pointer;
        }
        .car-button-delete .btn i{
            color: #fff;
        }
        .car-button-delete .btn:hover{
            background: #333;
        }
    
        @media only screen and (max-width: 768px) {
            
            h1.page-heading{ text-align: center; }
            .car_container{ width: calc( 100% - 40px ); margin: 20px;font-size: 18px; line-height: 2; border: 1px solid #e0e0e0;text-align: center; background-color: #FFF; }
            ul.footer_links{ margin:0 20px 20px 20px; padding: 0; }
            ul.footer_links li{ list-style-type: none; }
            ul.footer_links li a{ border: 1px solid red; color: red; background-color: #FFF; border-radius: 5px; width: 100%; }
        }
    
    </style>
    
    <script>
        
        // function setCarSearch(brand, model, type, version){
            
        //     $("#custom_filter_1").prop('value', brand);
        //     $("#custom_filter_2").prop('value', model);
        //     $("#custom_filter_3").prop('value', type);
        //     $("#custom_filter_4").prop('value', version);
        //     $('#ukoocompat_my_cars_custom_form').submit();
            
        // }

        function deleteCar(id_compat, e){
            
            var del=confirm("{l s='Are you sure you want to delete this car?' d='Shop.Theme.MyCars'}");

            if (del==true) {
                $.ajax({
                    url: '{$link->getPageLink('my-cars', true)}', // Replace with your endpoint
                    type: 'GET',
                    data: {
                        deleteCarGarage: 1,
                        id_compat: id_compat,
                        storeId: {Context::getContext()->shop->id},
                        id_customer: {Context::getContext()->customer->id}
                    },
                    success: function(brands) {
                    e.parentElement.parentElement.parentElement.remove();
                    document.querySelector(".loading-overlay-cars").classList.add("dont_show")
                    let brandsContainer = document.querySelector(".dropdown-menu .versions_cars")
                    brandsContainer.innerHTML = brands.html_model

    
    
                    },
                    error: function(xhr, status, error) {
                        console.error("AJAX Error:", status, error);
                    }
                })
            }
        }



        
        $(document).bind('contextmenu', function(e) {
            return false;
        });  
        
    </script>
{/block}
