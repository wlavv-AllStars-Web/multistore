<div class="footer-asm col-lg-12" style="position: relative;">
  {foreach $linkBlocks as $linkBlock}

      {if $linkBlock['title'] === 'Support'}
        <div class="links">
      {else}
        <div class="col-md-6 col-lg-12 links">
        {/if}
        <div class="row">
      <div class="col-md-6 col-lg-12 wrapper">
        <div class="title clearfix hidden-md-up" data-target="#footer_sub_menu_{$linkBlock.id}" data-toggle="collapse" onclick="toggleFooter(this)">
          <span class="h3">{$linkBlock.title}</span>
          <span class="float-xs-right">
            <span class="navbar-toggler collapse-icons">
              <i class="material-icons add">&#xE313;</i>
              <i class="material-icons remove">&#xE316;</i>
            </span>
          </span>
        </div>
        <ul id="footer_sub_menu_{$linkBlock.id}" class="collapse">
          {foreach $linkBlock.links as $link}
            <li>
            
              <a
                  id="{$link.id}-{$linkBlock.id}"
                  class="{$link.class}"
                  href="{$link.url}"
                  title="{$link.description}"
                  {if !empty($link.target)} target="{$link.target}" {/if}
              >
              <i class="fa-solid fa-circle-arrow-right hidden-md-down"></i>
                {$link.title}
              </a>
            </li>
          {/foreach}
          <li class="mobile">
            <a onclick="showSocials(this)">Social Media</a>
          </li>

            <li class="socials-footer col-lg-2">
              <div style="display: flex;">
              <a title="Facebook" aria-label="Facebook" id="footer_facebook" class="social-icon" style="margin-right: 5px;" href="https://www.facebook.com/all-stars-motorsport" target="_NEW"> 
                <img class="desktop" alt="Facebook" src="https://www.all-stars-motorsport.com/img/facebook.png" style="width: 30px; height: 30px;" onmouseover="this.src='https://www.all-stars-motorsport.com/img/facebook2.png'" onmouseout="this.src='https://www.all-stars-motorsport.com/img/facebook.png' "> 
                <img class="mobile" alt="Facebook" src="https://www.all-stars-motorsport.com/img/cms/Mobile_pages/social/facebook_r.png" style="width: 50px;height:50px;" />
              </a> 
              <a title="Instagram" aria-label="Instagram" id="footer_insta" class="social-icon" style="margin-right: 5px;" href="https://instagram.com/allstarsmotorsport" target="_NEW"> 
                <img class="desktop"  alt="Instagram" src="https://www.all-stars-motorsport.com/img/instagram.png" style="width: 30px; height: 30px;" onmouseover="this.src='https://www.all-stars-motorsport.com/img/instagram2.png'" onmouseout="this.src='https://www.all-stars-motorsport.com/img/instagram.png' "> 
                <img class="mobile" alt="Instagram" src="https://www.all-stars-motorsport.com/img/cms/Mobile_pages/social/instagram_r.png"  style="width: 50px;height:50px;"/>
              </a> 
              <a title="Flickr" aria-label="Flickr" id="footer_flickr" class="social-icon" style="margin-right: 5px;" href="https://www.flickr.com/photos/allstarsmotorsport/" target="_NEW"> 
                <img class="desktop"  alt="Flickr" src="https://www.all-stars-motorsport.com/img/flickr.png" style="width: 30px; height: 30px;" onmouseover="this.src='https://www.all-stars-motorsport.com/img/flickr2.png'" onmouseout="this.src='https://www.all-stars-motorsport.com/img/flickr.png' "> 
                <img class="mobile" alt="Flickr" src="https://www.all-stars-motorsport.com/img/cms/Mobile_pages/social/flickr_r.png"  style="width: 50px;height:50px;"/>
              </a> 
              <a title="Youtube" aria-label="Youtube" id="footer_youtube" class="social-icon" style="margin-right: 5px;" href="https://www.youtube.com/user/all-stars-motorsport" target="_NEW"> 
                <img class="desktop"  alt="Youtube" src="https://www.all-stars-motorsport.com/img/youtube.png" style="width: 30px; height: 30px;" onmouseover="this.src='https://www.all-stars-motorsport.com/img/youtube2.png'" onmouseout="this.src='https://www.all-stars-motorsport.com/img/youtube.png' "> 
                <img class="mobile" alt="Youtube" src="https://www.all-stars-motorsport.com/img/cms/Mobile_pages/social/youtube_r.png" style="width: 50px;height:50px;" />
              </a> 
              <a title="Whatsapp" class="social-icon" style="margin-right: 8px;" href="https://wa.me/+351912201753" target="_blank"> 
                <img class="desktop"  alt="Whatsapp" src="https://www.all-stars-motorsport.com/img/whatsapp.png" style="width: 30px; height: 30px;" onmouseover="this.src='https://www.all-stars-motorsport.com/img/whatsapp2.png'" onmouseout="this.src='https://www.all-stars-motorsport.com/img/whatsapp.png' "> 
                <img class="mobile" alt="Whatsapp" src="https://www.all-stars-motorsport.com/img/whatsapp_mobile.png" style="width: 50px;height:50px;"/>
              </a>
            </div>
          </li>
        </ul>

      </div>
      </div>
      </div>

  {/foreach}

  
</div>	