{if $universals}
    <div style="width: 100%;background:#222;">
        <h1 style="margin: auto;text-align:center;color:#fff;padding:1rem;">( {$total} ) Universal Products</h1>
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

    <div class="noMoreProducts col-lg-12" list_complete="false" style="display: flex;justify-content:center;padding: 1rem;font-weight:600;color: #333;"></div>

    

    {if !$noMoreProducts}
        <script>
          let isFetching = false;
          window.addEventListener("scroll", function() {
          if (document.querySelector(".noMoreProducts").getAttribute('list_complete') != 'true' && !isFetching && (window.innerHeight + window.scrollY) >= document.body.offsetHeight) {
              isFetching = true;
        
              let displayedProducts = Array.from(document.querySelectorAll(".universals-product-list article[data-id-product]"));
        
              displayedProducts = displayedProducts.map(el => el.getAttribute("data-id-product"));
        
              document.querySelector(".loading-overlay-universals").classList.toggle("showLoading")
        
            
              $.ajax({
                  url: '{$link->getAdminLink('carsProductsController')}', 
                  type: 'GET',
                  data: {
                    getMoreProducts: 1,
                    displayedProducts: displayedProducts.join(','),
                  },
                  success: function(response) {
                      document.querySelector(".loading-overlay-universals").classList.toggle("showLoading")
                      let data = JSON.parse(response);
        
                      if (data.success === true && data.product.length > 0) {
                          let productListUniversals = document.querySelector(".universals-product-list ");
        
                          // Append new products
                          if(Array.isArray(data.product)){
                          data.product.forEach(productHtml  => {
                              productListUniversals.insertAdjacentHTML("beforeend", productHtml);
                          });
                          }else{
                            productListUniversals.insertAdjacentHTML("beforeend", data.product);
                          }
                      }else{
                        document.querySelector(".noMoreProducts").innerHTML = data.message
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

