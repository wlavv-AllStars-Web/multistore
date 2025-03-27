{if $universals}
    <div style="width: 100%;background:#222;border-bottom: 3px solid;border-color:var(--asm-color);">
        <h1 style="margin: auto;text-align:center;color:#fff;padding:.75rem 1rem;">( {$total} ) {l s="Universal Products" d="Shop.Theme.Universals"}</h1>
    </div>
    <div class="universals-product-list d-flex p-3" style="flex-wrap: wrap;position:relative;">
    {foreach from=$universals item=product name=products}
        {block name='product_miniature'}
            {include file='catalog/_partials/miniatures/product.tpl' product=$product}
        {/block}
    {/foreach}
        <div class="loading-overlay-universals" role="status">
            <span class="loading-spinner"></span>
        </div>
    </div>

    <div class="noMoreProducts col-lg-12" list_complete="false" style="display: flex;justify-content:center;padding: 1rem;font-weight:600;color: #fff;background: var(--asm-color);font-size: 1.25rem;"></div>

    

    {if !$noMoreProducts}
        <script>
          let isFetching = false;
          let lastProductId = 0;

        function updateLastProductId() {
                let productElements = document.querySelectorAll(".universals-product-list article[data-id-product]");
                if (productElements.length > 0) {
                    lastProductId = productElements[productElements.length - 1].getAttribute("data-id-product");
                }
        }

        document.addEventListener("DOMContentLoaded", updateLastProductId);

          window.addEventListener("scroll", function() {
          if (document.querySelector(".noMoreProducts").getAttribute('list_complete') != 'true' && !isFetching && (window.innerHeight + window.scrollY) >= document.documentElement.scrollHeight - 205) {
              isFetching = true;
        
              let displayedProducts = Array.from(document.querySelectorAll(".universals-product-list article[data-id-product]"));
        
              displayedProducts = displayedProducts.map(el => el.getAttribute("data-id-product"));
        
              document.querySelector(".loading-overlay-universals").classList.toggle("showLoading")
        
            
              $.ajax({
                  url: '{$link->getAdminLink('carsProductsController')}', 
                  type: 'GET',
                  data: {
                    getMoreProducts: 1,
                    lastProductId: lastProductId,
                  },
                  success: function(response) {
                      document.querySelector(".loading-overlay-universals").classList.toggle("showLoading")
                      let data = JSON.parse(response);
        
                      if (data.success === true && data.product.length > 0) {
                          let productListUniversals = document.querySelector(".universals-product-list ");
                          productListUniversals.insertAdjacentHTML("beforeend", data.product);
                          // Append new products
                          lastProductId = data.lastProductId;
                      }else{
                        document.querySelector(".noMoreProducts").innerHTML = "{l s="No more products" d="Shop.Theme.Universals"}"
                        document.querySelector(".noMoreProducts").setAttribute('list_complete',true)
                      }
        
                      isFetching = false;
                  },
                  error: function(xhr, status, error) {
                      console.error("AJAX Error:", status, error);
                      isFetching = false;
                      document.querySelector(".loading-overlay-universals").classList.toggle("showLoading")
                  }
                })
        
          }
          });
        </script>
        {/if}
{/if}

{if $universalsGet}
    {foreach from=$universalsGet item=product name=products}
        {block name='product_miniature'}
            {include file='catalog/_partials/miniatures/product.tpl' product=$product}
        {/block}
    {/foreach}
{/if}

