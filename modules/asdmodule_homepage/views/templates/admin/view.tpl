
{if $shop->id == 3}
<div>
    <form name="form_homepage"  action="/admineuromus1/index.php?controller=AdminASDModuleHomepage&token={Tools::getAdminTokenLite('AdminASDModuleHomepage')}" enctype="multipart/form-data" method="POST">
        <input type="hidden" name="action" value="update">
        <div class="panel panel-default">
            <div class="panel-heading" style="margin: 0;">Banner - Homepage</div>
            <div class="panel-body" style="padding: 15px 0;">
                <div>
                    <div style="width: 60%; float: left;">
                        <img onclick="$('#homepage_banner').click();" src="/img/asd/homepage/main.webp?updated={rand()}" style="width: 100%;cursor:pointer;">
                        <input type="file" id="homepage_banner" name="homepage_banner" accept="image/webp" style="display: none;">                      
                    </div>
                    <div style="width: 40%; float: left; padding: 0 0 0 15px;">
                        <label>Title</label>
                        <input type="text" name="alt_banner" value="{$data['alt_banner']}">  
                        <label style="margin-top: 20px;">Link</label>
                        <input type="text" name="link_banner" value="{$data['link_banner']}">                           
                    </div>
                </div>
            </div>
        </div>
        
        {* <div class="panel panel-default" style="margin-top: 30px;">
            <div class="panel-heading" style="margin: 0;">Footer</div>
            <div class="panel-body" style="padding: 15px 0;">
                <div>
                    <div style="width: 20%; float: left; text-align: center;">    
                        <img onclick="$('#footer_banner').click();" src="/img/asd/Events/main_250x100.webp?updated={rand()}" style="margin: 15px auto;cursor:pointer;">
                        <input type="file" id="footer_banner" name="footer_banner" accept="image/webp" style="display: none;">
                    </div>
                    
                    <div style="width: 80%; float: left;text-align: left;">
                        <label>Title</label>
                        <input type="text" name="alt_footer" value="{$data['alt_footer']}">   
                        <label style="margin-top: 20px;">Link</label>
                        <input type="text" name="link_footer" value="{$data['link_footer']}">                          
                    </div>
                </div>
            </div>
        </div> *}
        
        <div style="text-align: center;">
            <button class="btn btn-primary;" style="margin: 0 auto;width: 150px;background: dodgerblue;color: #fff;">SAVE</button>
        </div>
    </form>
</div>
{else}
<div>
    <h1>Only in All Stars Distribution</h1>
</div>
{/if}
