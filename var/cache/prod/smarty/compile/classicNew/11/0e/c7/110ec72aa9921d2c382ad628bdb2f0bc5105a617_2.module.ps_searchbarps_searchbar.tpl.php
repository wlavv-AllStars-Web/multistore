<?php
/* Smarty version 4.3.4, created on 2024-08-26 03:05:43
  from 'module:ps_searchbarps_searchbar.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.4',
  'unifunc' => 'content_66cbe2f7b18872_26531418',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '110ec72aa9921d2c382ad628bdb2f0bc5105a617' => 
    array (
      0 => 'module:ps_searchbarps_searchbar.tpl',
      1 => 1719912747,
      2 => 'module',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_66cbe2f7b18872_26531418 (Smarty_Internal_Template $_smarty_tpl) {
?> <style>
 @media (min-width: 767px){
 .bigscreen {
      max-width: 100vw !important; 
      width: 100%;
      
 }
}

@media (max-width: 767px){
  .smallscreen{
    max-width: 100vw !important; 
    width:95vw; 
    border-radius: 25px;   
  }
  .whitebg{
    background-color: white;
  }
}
 </style>
  <div id="search_widget" class="search-widgets bigscreen smallscreen" data-search-controller-url="<?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['search_controller_url']->value, ENT_QUOTES, 'UTF-8');?>
">
    <form method="get" action="<?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['search_controller_url']->value, ENT_QUOTES, 'UTF-8');?>
">
      <input type="hidden" name="controller" value="search">
      <i class="material-icons search" aria-hidden="true">search</i>
      <input type="text" name="s" value="<?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['search_string']->value, ENT_QUOTES, 'UTF-8');?>
" style="<?php if ($_smarty_tpl->tpl_vars['search_string']->value != null) {?>background:#fff;<?php }?>" class="whitebg searchbarInput"
        placeholder="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Search our catalog','d'=>'Shop.Theme.Catalog'),$_smarty_tpl ) );?>
"
        aria-label="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Search','d'=>'Shop.Theme.Catalog'),$_smarty_tpl ) );?>
">
          </form>
  </div>

  <?php echo '<script'; ?>
>
  document.addEventListener('DOMContentLoaded', () => {
    if(window.screen.width > 580) {
      const inputSearch = document.querySelector(".header-top-right-desktop #search_widget .searchbarInput");
      const iconSearch = document.querySelector(".header-top-right-desktop #search_widget .search")
      inputSearch.style.border = "1px solid #103054"
      // const log = document.getElementById("log");

    inputSearch.addEventListener("input", updateValue);
    function updateValue(e) {
      inputSearch.setAttribute("value", e.target.value);
      if(inputSearch.value.length != 0) {
        iconSearch.style.background = "#103054";
        iconSearch.style.cursor = "pointer";
        iconSearch.style.color = "#fff";
        inputSearch.style.borderColor = "#103054";
      }else {
        iconSearch.style.background = "none"
        iconSearch.style.color = "#103054";
        inputSearch.style.borderColor = "#ee302e";
      }
    }

    iconSearch.addEventListener("click", () => {
        document.querySelector('.header-top-right-desktop #search_widget form').submit();
    })



  } else {
    const inputSearch = document.querySelector(".header-top-right #search_widget .searchbarInput");
    const iconSearch = document.querySelector(".header-top-right #search_widget .search")
    inputSearch.style.border = "1px solid #103054"
    // const inputSearch = document.querySelector("#_mobile_cart .searchbarInput");
    // const iconSearch = document.querySelector(".header-nav .mobile #_mobile_cart .search")
    //     if(iconSearch && inputSearch) {
    //       iconSearch.addEventListener('click', () => {
    //         console.log("deu")
    //           document.querySelector('.header-top .header-top-right #search_widget form').submit();
    //         })
    //     }
    inputSearch.addEventListener("input", updateValue);
    function updateValue(e) {
      inputSearch.setAttribute("value", e.target.value);
      if(inputSearch.value.length != 0) {
        iconSearch.style.background = "#103054";
        iconSearch.style.cursor = "pointer";
        iconSearch.style.color = "#fff";
        inputSearch.style.borderColor = "#ee302e";
      }else {
        iconSearch.style.background = "none"
        iconSearch.style.color = "#103054";
        inputSearch.style.borderColor = "#ee302e";
      }
    }

    iconSearch.addEventListener("click", () => {
        document.querySelector('.header-top-right #search_widget form').submit();
    })
   
  }

  })
  


  <?php echo '</script'; ?>
>

  <style>
  .header-top-right #search_widget {
  margin: auto;
  margin-right: 1rem;
}

.header-top-right #search_widget form input.ui-autocomplete-input{
  border-color: #2d405f90;
    color: #2d405f;
    border: 1px solid #768397;
}
.header-top-right #search_widget form i{
  right: 0;
    overflow: clip;
    height: 100%;
    width: fit-content;
    background: #768397;
    color: #fff;
    border-radius: 0 5px 5px 0;
}
#search_widget {
  /* margin: auto;
  margin-right: 1rem; */
}

#search_widget form input.ui-autocomplete-input{
  border-color: #2d405f90;
    color: #2d405f;
    border: 1px solid #768397;
}
#search_widget form i{
  right: 0;
    overflow: clip;
    height: 100%;
    width: fit-content;
    /* background: #768397; */
    color: #2d405f;
    border-radius: 0 5px 5px 0;
}

#search_widget form input {
  padding: 10px 20px 10px 20px;
}

  </style>
<?php }
}
