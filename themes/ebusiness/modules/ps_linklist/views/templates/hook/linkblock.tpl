{assign var="customOrder" value=[3,4,5,7,2,1,6,0,8]}
{* {assign var="customOrder" value=[2, 3, 4, 6, 1, 0, 5, 8, 7]} *}

{foreach $linkBlocks as $key => $linkBlock}
  {* Initialize a new array to hold sorted links *}
  {assign var="sortedLinks" value=[]}

  {* Loop through the customOrder and find matching links *}
  {foreach from=$customOrder item=orderKey}
      {foreach from=$linkBlock.links item=link}
          {* Use the actual key comparison to reorder *}
          {if $link@iteration-1 == $orderKey}
              {append var="sortedLinks" value=$link}
          {/if}
      {/foreach}
  {/foreach}

  {* Replace the links in the original linkBlock *}
  {$linkBlocks[$key].links = $sortedLinks}
{/foreach}

<div class="footer-asm col-lg-12" style="position: relative;">
  {foreach $linkBlocks  as $linkBlock}
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
                <img class="desktop" alt="Facebook" src="/img/asm/socials/facebook.png" style="width: 30px; height: 30px;" onmouseover="this.src='/img/asm/socials/facebook2.png'" onmouseout="this.src='/img/asm/socials/facebook.png' "> 
                <img class="mobile" alt="Facebook" src="/img/asm/socials/facebook_r.png" style="width: 50px;height:50px;" />
              </a> 
              <a title="Instagram" aria-label="Instagram" id="footer_insta" class="social-icon" style="margin-right: 5px;" href="https://instagram.com/allstarsmotorsport" target="_NEW"> 
                <img class="desktop"  alt="Instagram" src="/img/asm/socials/instagram.png" style="width: 30px; height: 30px;" onmouseover="this.src='/img/asm/socials/instagram2.png'" onmouseout="this.src='/img/asm/socials/instagram.png' "> 
                <img class="mobile" alt="Instagram" src="/img/asm/socials/instagram_r.png"  style="width: 50px;height:50px;"/>
              </a> 
              <a title="Flickr" aria-label="Flickr" id="footer_flickr" class="social-icon" style="margin-right: 5px;" href="https://www.flickr.com/photos/allstarsmotorsport/" target="_NEW"> 
                <img class="desktop"  alt="Flickr" src="/img/asm/socials/flickr.png" style="width: 30px; height: 30px;" onmouseover="this.src='/img/asm/socials/flickr2.png'" onmouseout="this.src='/img/asm/socials/flickr.png' "> 
                <img class="mobile" alt="Flickr" src="/img/asm/socials/flickr_r.png"  style="width: 50px;height:50px;"/>
              </a> 
              <a title="Youtube" aria-label="Youtube" id="footer_youtube" class="social-icon" style="margin-right: 5px;" href="https://www.youtube.com/user/allstarsmotorsport" target="_NEW"> 
                <img class="desktop"  alt="Youtube" src="/img/asm/socials/youtube.png" style="width: 30px; height: 30px;" onmouseover="this.src='/img/asm/socials/youtube2.png'" onmouseout="this.src='/img/asm/socials/youtube.png' "> 
                <img class="mobile" alt="Youtube" src="/img/asm/socials/youtube_r.png" style="width: 50px;height:50px;" />
              </a> 
              <a title="Whatsapp" class="social-icon" style="margin-right: 8px;" href="https://wa.me/+351912201753" target="_blank"> 
                <img class="desktop"  alt="Whatsapp" src="/img/asm/socials/whatsapp.png" style="width: 30px; height: 30px;" onmouseover="this.src='/img/asm/socials/whatsapp2.png'" onmouseout="this.src='/img/asm/socials/whatsapp.png' "> 
                <img class="mobile" alt="Whatsapp" src="/img/asm/socials/whatsapp_mobile.png" style="width: 50px;height:50px;"/>
              </a>
            </div>
          </li>
        </ul>

      </div>
      </div>
      </div>

  {/foreach}

  
</div>	