<?php

class IndexController extends IndexControllerCore
{
    public $php_self = 'index';
    public $id_shop;


    public function initContent()
    {
        $this->getCategories();

        if($this->context->shop->id == 3){
            if($this->context->customer->isLogged()){
                Tools::redirect('my-account');
            }
        }

        

        $this->id_shop = (int)Context::getContext()->shop->id;

        // if($this->id_shop === 1){

        //     $homepage_mobile = Db::getInstance()->executes("Select * FROM "._DB_PREFIX_."asm_homepage_online WHERE destination = 'mobile' AND active=1 AND id_shop=".$this->id_shop." ORDER BY id");
    
            
        //     $icon_videos = Db::getInstance()->executeS(
        //         "SELECT * FROM "._DB_PREFIX_."asm_homepage_online 
        //         WHERE destination = 'desktop' AND icon_type = 4 AND active = 1 AND id_shop = ".$this->id_shop
        //     );
            
    
        //     $homepage_desktop = [
        //         'banners'       => Db::getInstance()->executes("Select * FROM "._DB_PREFIX_."asm_homepage_online WHERE destination = 'desktop' AND icon_type=1 AND active=1 AND id_shop=".$this->id_shop),
        //         'icones_50'     => Db::getInstance()->executes("Select * FROM "._DB_PREFIX_."asm_homepage_online WHERE destination = 'desktop' AND icon_type=2 AND active=1 AND id_shop=".$this->id_shop),
        //         'icones_33'     => Db::getInstance()->executes("Select * FROM "._DB_PREFIX_."asm_homepage_online WHERE destination = 'desktop' AND icon_type=3 AND active=1 AND id_shop=".$this->id_shop),
        //         'icones_videos' => $icon_videos
        //     ];
    
        //     $this->context->smarty->assign('desktop', $homepage_desktop);
        //     $this->context->smarty->assign('mobile', $homepage_mobile);
        // }


        if($this->id_shop === 1 || $this->id_shop === 2 || $this->id_shop === 6){
            $action = Tools::getValue('action', '');

            if($action == 'getMenuHtml'){
                echo self::getMenu();
                exit;
            }else{
                // if(isset($this->context->customer->id)){
                //     $my_cars = Db::getInstance()->executes("Select * FROM "._DB_PREFIX_."asm_ukoo_customer WHERE id_customer = " . $this->context->customer->id);
                // }else{
                //     $my_cars = [];
                // }


                $homepage_mobile = Db::getInstance()->executes("Select * FROM "._DB_PREFIX_."asm_homepage_online WHERE destination = 'mobile' AND active=1 AND id_shop=".$this->id_shop." ORDER BY id");

                $icon_videos = Db::getInstance()->executeS(
                    "SELECT * FROM "._DB_PREFIX_."asm_homepage_temp 
                    WHERE destination = 'desktop' AND icon_type = 4 AND active = 1 AND id_shop = ".$this->id_shop
                );
                
                // pre($homepage_mobile);
        
                $homepage_desktop = [
                    'banners'       => Db::getInstance()->executes("Select * FROM "._DB_PREFIX_."asm_homepage_online WHERE destination = 'desktop' AND icon_type=1 AND active=1 AND id_shop=".$this->id_shop),
                    'icones_50'     => Db::getInstance()->executes("Select * FROM "._DB_PREFIX_."asm_homepage_online WHERE destination = 'desktop' AND icon_type=2 AND active=1 AND id_shop=".$this->id_shop),
                    'icones_33'     => Db::getInstance()->executes("Select * FROM "._DB_PREFIX_."asm_homepage_online WHERE destination = 'desktop' AND icon_type=3 AND active=1 AND id_shop=".$this->id_shop),
                    'icones_videos' => $icon_videos
                ];

                // pre($homepage_desktop);


                // $this->context->smarty->assign('myCars', $my_cars);
        
                $this->context->smarty->assign('desktop', $homepage_desktop);
                $this->context->smarty->assign('mobile', $homepage_mobile);
            }

            if($this->context->shop->id == 1) {
                $this->context->smarty->assign('brandsEuromus', self::getBrandsWebTools($this->context->shop->id));
            }
        }


        parent::initContent();


        $this->context->smarty->assign([
            'HOOK_HOME' => Hook::exec('displayHome'),
            'HOOK_HOME_TAB' => Hook::exec('displayHomeTab'),
            'HOOK_HOME_TAB_CONTENT' => Hook::exec('displayHomeTabContent')
        ]);
        
        

        $this->setTemplate('index');
    }

    public static function getBrandsWebTools($id_shop){

        if(Tools::getValue('getdataModelsEuromus') == 1){

            $key = 'UMb85YcQcDKQK021JKLAMM5yJ9pCgt';
            $brand = Tools::getValue('id_brand');
            // $store = Tools::getValue('storeId');
            $store = 2;

            $urlModels = 'https://webtools.'.$_SERVER['SERVER_NAME'].'/api/get/model/'.$brand.'/'.$store.'/'.$key;


            $ch = curl_init();
            curl_setopt($ch,CURLOPT_URL,$urlModels);
            curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
            curl_setopt($ch,CURLOPT_CONNECTTIMEOUT, 4);
            $json = curl_exec($ch);
            curl_close($ch);

            // Decode JSON string into an associative array
            $modelsEuromus = json_decode($json, true);

            // pre($modelsEuromus['data']);
            ob_clean();
            header('Content-Type: application/json');
            echo json_encode($modelsEuromus['data']);
            exit;
        }

        if(Tools::getValue('getdataTypesEuromus') == 1){

            $key = 'UMb85YcQcDKQK021JKLAMM5yJ9pCgt';
            $model = Tools::getValue('id_model');
            // $store = Tools::getValue('storeId');
            $store = 2;

            $urlTypes = 'https://webtools.'.$_SERVER['SERVER_NAME'].'/api/get/type/'.$model.'/'.$store.'/'.$key;


            $ch = curl_init();
            curl_setopt($ch,CURLOPT_URL,$urlTypes);
            curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
            curl_setopt($ch,CURLOPT_CONNECTTIMEOUT, 4);
            $json = curl_exec($ch);
            curl_close($ch);

            // Decode JSON string into an associative array
            $typesEuromus = json_decode($json, true);

            // pre($modelsEuromus['data']);
            ob_clean();
            header('Content-Type: application/json');
            echo json_encode($typesEuromus['data']);
            exit;
        }

        if(Tools::getValue('getdataVersionsEuromus') == 1){

            $key = 'UMb85YcQcDKQK021JKLAMM5yJ9pCgt';
            $type = Tools::getValue('id_type');
            // $store = Tools::getValue('storeId');
            $store = 2;

            $urlTypes = 'https://webtools.'.$_SERVER['SERVER_NAME'].'/api/get/version/'.$type.'/'.$store.'/'.$key;


            $ch = curl_init();
            curl_setopt($ch,CURLOPT_URL,$urlTypes);
            curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
            curl_setopt($ch,CURLOPT_CONNECTTIMEOUT, 4);
            $json = curl_exec($ch);
            curl_close($ch);

            // Decode JSON string into an associative array
            $versionsEuromus = json_decode($json, true);

            // pre($modelsEuromus['data']);
            ob_clean();
            header('Content-Type: application/json');
            echo json_encode($versionsEuromus['data']);
            exit;
        }

        if(Tools::getValue('getProductsIdCompat') == 1){

            $key = 'UMb85YcQcDKQK021JKLAMM5yJ9pCgt';
            $brand = Tools::getValue('brand_id');
            $model = Tools::getValue('model_id');
            $type = Tools::getValue('type_id');
            $version = Tools::getValue('version_id');
            // $store = Tools::getValue('storeId');
            $store = 2;

            $urlProductIdCompat = 'https://webtools.'.$_SERVER['SERVER_NAME'].'/api/get/compats/'.$brand.'/'.$model.'/'.$type.'/'.$version.'/'.$store.'/'.$key;


            $ch = curl_init();
            curl_setopt($ch,CURLOPT_URL,$urlProductIdCompat);
            curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
            curl_setopt($ch,CURLOPT_CONNECTTIMEOUT, 4);
            $json = curl_exec($ch);
            curl_close($ch);

            // Decode JSON string into an associative array
            $compat = json_decode($json, true);

            // pre($modelsEuromus['data']);
            ob_clean();
            header('Content-Type: application/json');
            echo json_encode($compat['data']);
            exit;
        }





        $key = 'UMb85YcQcDKQK021JKLAMM5yJ9pCgt';
        // $brand = Tools::getValue('id_brand');

        // alterar para $id_shop
        $store = 2;

        $urlBrands = 'https://webtools.'.$_SERVER['SERVER_NAME'].'/api/get/brands/'.$store.'/'. $key;

        // $urlModels = 'https://webtools.'.$_SERVER['SERVER_NAME'].'/api/get/brand/'.$brand.'/2/'.$key;


        $ch = curl_init();
        curl_setopt($ch,CURLOPT_URL,$urlBrands);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
        curl_setopt($ch,CURLOPT_CONNECTTIMEOUT, 4);
        $json = curl_exec($ch);
        curl_close($ch);

        // Decode JSON string into an associative array
        $brandsWebTools = json_decode($json, true);

        return $brandsWebTools['data'];

        // pre($brandsWebTools['data']);
        // header('Content-Type: application/json');
        // echo json_encode($modelsEuromus['data']);
        // exit;

    }

    public function postProcessAjax(){

    }

    public static function getBrandAndModel($filter1,$filter2,$filter3,$filter4,$id_lang){
        $array_NameModel = [];
        $brandnamesql = "Select value
                        FROM "._DB_PREFIX_."ukoocompat_criterion_lang
                        WHERE id_ukoocompat_criterion = '" . $filter1 . "'
                        AND id_lang = '". $id_lang ."'
                        LIMIT 1";
        $brandnameResult  = Db::getInstance()->executeS($brandnamesql);

        $Modelnamesql = "Select value
                        FROM "._DB_PREFIX_."ukoocompat_criterion_lang
                        WHERE id_ukoocompat_criterion = '" . $filter2 . "'
                        AND id_lang = '". $id_lang ."'
                        LIMIT 1";
        $ModelnameResult  = Db::getInstance()->executeS($Modelnamesql);

        $Typenamesql = "Select value
                        FROM "._DB_PREFIX_."ukoocompat_criterion_lang
                        WHERE id_ukoocompat_criterion = '" . $filter3 . "'
                        AND id_lang = '". $id_lang ."'
                        LIMIT 1";
        $TypenameResult  = Db::getInstance()->executeS($Typenamesql);

        $Versionnamesql = "Select value
                        FROM "._DB_PREFIX_."ukoocompat_criterion_lang
                        WHERE id_ukoocompat_criterion = '" . $filter4 . "'
                        AND id_lang = '". $id_lang ."'
                        LIMIT 1";
        $VersionnameResult  = Db::getInstance()->executeS($Versionnamesql);

        $array_NameModel[] = [
            'name_brand'   => $brandnameResult,
            'name_model'   => $ModelnameResult,
            'name_type'   => $TypenameResult,
            'name_version'   => $VersionnameResult,
        ];

        return $array_NameModel;
    }

    public static function getCarsOfBrand($idBrand,$idModel=NULL,$idLang=NULL){
        
        // echo $idBrand;
        // echo _DB_PREFIX_;
        // exit;
        if(Context::getContext()->shop->id === 2){

            $array_cars = [];
            $sql = "Select *
                    FROM "._DB_PREFIX_."ukoocompat_compat_asm 
                    WHERE id_filter_value_1 = " . $idBrand . '
                    GROUP BY id_filter_value_3
                    ORDER BY position';
            
            $cars = Db::getInstance()->executeS($sql);

            foreach($cars AS $car){
            
                $brand   = Db::getInstance()->getValue('SELECT value FROM '._DB_PREFIX_.'ukoocompat_criterion_lang WHERE id_lang=1 AND id_ukoocompat_criterion=' . $car['id_filter_value_1']);
                $model   = Db::getInstance()->getValue('SELECT value FROM '._DB_PREFIX_.'ukoocompat_criterion_lang WHERE id_lang=1 AND id_ukoocompat_criterion=' . $car['id_filter_value_2']);
                $version = Db::getInstance()->getValue('SELECT value FROM '._DB_PREFIX_.'ukoocompat_criterion_lang WHERE id_lang=1 AND id_ukoocompat_criterion=' . $car['id_filter_value_3']);
                $type    = Db::getInstance()->getValue('SELECT value FROM '._DB_PREFIX_.'ukoocompat_criterion_lang WHERE id_lang=1 AND id_ukoocompat_criterion=' . $car['id_filter_value_4']);
                
                $array_cars[] = [
                    'id_brand'   => $car['id_filter_value_1'],
                    'id_model'   => $car['id_filter_value_2'],
                    'id_type'    => $car['id_filter_value_3'],
                    'id_version' => $car['id_filter_value_4'],
                    'brand'      => $brand,
                    'model'      => $model,
                    'type'       => $version,
                    'version'    => $type
                ];
                
            }
            
            return $array_cars;
        }

        
            $array_cars = [];
            $brandnameIdsql = "Select id_ukoocompat_criterion
                            FROM "._DB_PREFIX_."ukoocompat_criterion_lang
                            WHERE value = '" . $idBrand . "'
                            LIMIT 1";

            $brandnameIdResult  = Db::getInstance()->executeS($brandnameIdsql);
            $brandnameId = !empty($brandnameIdResult) ? $brandnameIdResult[0]['id_ukoocompat_criterion'] : null;

            $modelnameIdsql = "Select id_ukoocompat_criterion
                            FROM "._DB_PREFIX_."ukoocompat_criterion_lang
                            WHERE value = '".$idModel."'
                            LIMIT 1";
            $modelnameIdResult = Db::getInstance()->executeS($modelnameIdsql);
            $modelnameId =  !empty($modelnameIdResult) ? $modelnameIdResult[0]['id_ukoocompat_criterion'] : null;

            if($modelnameId != null && $brandnameId != null) {
                $sql = "Select *
                FROM "._DB_PREFIX_."ukoocompat_compat_asm 
                WHERE id_filter_value_1 = " . $brandnameId . ' AND id_filter_value_2 = '. $modelnameId .'
                ORDER BY position';
        
                $cars = Db::getInstance()->executeS($sql);

                foreach($cars AS $car){

                    $brand   = Db::getInstance()->getValue('SELECT value FROM '._DB_PREFIX_.'ukoocompat_criterion_lang WHERE id_lang='.$idLang.' AND id_ukoocompat_criterion=' . $car['id_filter_value_1']);
                    $model   = Db::getInstance()->getValue('SELECT value FROM '._DB_PREFIX_.'ukoocompat_criterion_lang WHERE id_lang='.$idLang.' AND id_ukoocompat_criterion=' . $car['id_filter_value_2']);
                    $version = Db::getInstance()->getValue('SELECT value FROM '._DB_PREFIX_.'ukoocompat_criterion_lang WHERE id_lang='.$idLang.' AND id_ukoocompat_criterion=' . $car['id_filter_value_3']);
                    $type    = Db::getInstance()->getValue('SELECT value FROM '._DB_PREFIX_.'ukoocompat_criterion_lang WHERE id_lang='.$idLang.' AND id_ukoocompat_criterion=' . $car['id_filter_value_4']);
                    
                    $array_cars[] = [
                        'id_brand'   => $car['id_filter_value_1'],
                        'id_model'   => $car['id_filter_value_2'],
                        'id_type'    => $car['id_filter_value_3'],
                        'id_version' => $car['id_filter_value_4'],
                        'brand'      => $brand,
                        'model'      => $model,
                        'type'       => $version,
                        'version'    => $type,

                    ];
                    
                }
            }
        
        

        
        
        return $array_cars;
        
    }

    public function getCategories()
    {

        $shopId = (int)Context::getContext()->shop->id;
        $lang = (int)Context::getContext()->language->id;
				
        $sql = 'SELECT cl.*
        FROM ' . _DB_PREFIX_ . 'category c
        LEFT JOIN ' . _DB_PREFIX_ . 'category_lang cl ON (c.id_category = cl.id_category)
        WHERE cl.id_shop = ' . (int)$shopId . ' 
        AND cl.id_lang = ' . (int)$lang . ' 
        AND cl.id_category != 1
        AND cl.id_category != 219
        AND c.active = 1';
        


        $cats = Db::getInstance()->executeS($sql);
        
        
        $categoryArray = [];

        foreach ($cats as $category) {
            $categoryArray[] = [
                'id_category' => $category['id_category'],
                'id_shop' => $category['id_shop'],
                'id_lang' => $category['id_lang'],
                'name' => $category['name'],
                'description' => $category['description'],
                'additional_description' => $category['additional_description'],
                'link_rewrite' => $category['link_rewrite'],
                'meta_title' => $category['meta_title'],
                'meta_keywords' => $category['meta_keywords'],
                'meta_description' => $category['meta_description'],
            ];
        }
        
        
        
		$this->context->smarty->assign('cats', $categoryArray);		
    }


    public static function getMenu(){

        $id_brand = Tools::getValue("brand");
        
        $carsOfBrand = self::getCarsOfBrand($id_brand);
        // echo '<pre>'.print_r($carsOfBrand,1).'</pre>';
        // exit;

        $new_model = 0;
        $html = '';
        
        $html .= '<div style="background:#282828; padding: 0;display: block ruby; width: 100%;margin-top: 5px;">';
                   
                   
                //   $this->context->isMobile();
                    
                   
                    $html .='</div><div class="model-cars-container">';
                    
                
                
                        foreach ($carsOfBrand AS $car){
                           
                            if (  $new_model!= $car['id_model'] ){ 
                                if ($new_model != 0) {
                                   
                                        $html .= '</div>';
                                }
                                
                                $html .='<div class="model-cars">';
                            }
                        
                            
                                                               
                                                                    
                                                                    $html .= '<div class="car_item_holder">';
                                                                    
                                                                        $sql_version = "Select * FROM "._DB_PREFIX_."ukoocompat_compat_asm WHERE id_filter_value_1 = " . $car['id_brand'] . " AND id_filter_value_2 = " . $car['id_model'] . " AND id_filter_value_3 = " . $car['id_type'] . ' ORDER BY position';
                                                                        $versions = Db::getInstance()->executeS($sql_version);
                                                                        
                                                                        
                                                                        if (file_exists($_SERVER['DOCUMENT_ROOT'] . '/img/homepage/models/' . $car['id_brand'] . '_' . $car['id_type'] . '.png')) {
                                                                            $car_image = '/img/homepage/models/' . $car['id_brand'] . '_' . $car['id_type'] . '.png';
                                                                        } else {
                                                                            $car_image = '/img/homepage/models/unknown.png';
                                                                        }
                                                
                                                                            //$car_image = '/img/homepage/models/' . $car['id_brand'] . '_' . $car['id_type'] . '.png';
                                                // ' . $car['model'] . '
                                                                            $html .='<div class="myCarsBrand">
                                                                                        
                                                                                        <div style="display:flex;flex-direction:column;" onclick="$(\'#container_version_' . $car['id_brand'] . '_' . $car['id_type'] . '\').toggle(); globalModel = ' ."'". $car['model'] ."'". ';globalType = ' ."'". $car['type'] ."'". '"> 
                                                                                            
                                                                                            <img class="img-responsive" src="' . $car_image . '" style="margin: 0 auto;width: 200px; cursor: pointer;">
                                                                                        </div>
                                                                                    <div>
                                                                                    
                                                                                    <div class="spacer-10"></div>
                                                                                       <span class="carBrandMenu">' . $car['brand'] .'</span>  
                                                                                    <div id="container_version_parent" style="cursor: pointer;" onclick="$(\'#container_version_' . $car['id_brand'] . '_' . $car['id_type'] . '\').toggle();">
                                                                                        <div style="line-height: 1.4;margin:auto;padding:0.5rem 1rem;border-radius:5px;" onclick="$(\'#container_version_' . $car['id_brand'] . '_' . $car['id_type'] . '\').toggle();">
                                                                                            <span class="modelspan" onclick="$(\'#container_version_' . $car['id_brand'] . '_' . $car['id_type'] . '\').toggle();toggleStatus(this);">' . $car['model']   . '</span> | <span onclick="$(\'#container_version_' . $car['id_brand'] . '_' . $car['id_type'] . '\').toggle();toggleStatus(this);">' . $car['type']    . '</span>
                                                                                            <div class="container_x_x" id="container_version_' . $car['id_brand'] . '_' . $car['id_type'] . '" style="display: none;">';
                                                    
                                                                                                foreach($versions AS $version){
                                                                                                    $type = Db::getInstance()->getValue('SELECT value FROM '._DB_PREFIX_.'ukoocompat_criterion_lang WHERE id_lang=1 AND id_ukoocompat_criterion=' . $version['id_filter_value_4']);
                                                                                                   
                                                                                                if (!empty($type)) {
                                                                                                        $html .= '<div class="type_selector" onclick="setCarAndSearch(' . $car['id_brand'] . ', ' . $car['id_model'] . ', ' . $car['id_type'] . ', ' . $version['id_filter_value_4'] . ');globalImgBrand = ' . "'" . $car_image . "'" . ';globalBrand = ' . "'" . $car['brand'] . "'" . ';globalModel = ' . "'" . $car['model'] . "'" . ';globalType = ' . "'" . $car['type'] . "'" . ';globalVersion = ' . "'" . $type . "'" . ';"> ' . $type . '</div>';
                                                                                                    }
                                                                                                }
                                                                                                
                                                                                                
                                                                                            $html .='</div>
                                                                                            
                                                                                        </div>
                                                                                        
                                                                                    </div>
                                                                                    
                                                                            </div>
                                                                            
                                                                    </div>';
                                                                    
                                                                    
                                                                    
                                                                
                                                                $html .='</div>';
                                                               
                
                   $new_model = $car['id_model']; 
                  
                }
                
                 $html .='</div>';
                 
                 $html .='<script>

                 if(screen.width < 560){
                 function toggleStatus(element){
                 
                     element.parentElement.classList.toggle("show");
                 }
                 const modelCars = document.querySelectorAll(\'.model-cars\');
                    modelCars.forEach(function(container) {
                        if (container.children.length > 1) {
                            container.classList.add(\'has-multiple-children\');
                    
                            container.querySelectorAll(\'.car_item_holder\').forEach(function(child, index) {
                                const versionsParent = document.querySelectorAll("#container_version_parent");
                                
                                
                                child.style.position = "relative";
                                const div = document.createElement(\'div\');
                                div.innerHTML = `<span style="font-weight:bold;font-size:1.25rem;">${index + 1}</span><span style="color: #222222;font-size:1rem;"> / ${container.children.length}</span>`;
                                div.style.color = "red";
                                div.style.fontWeight = "regular";
                                div.style.textAlign = "center";
                                
                                div.style.margin = "0 0 1rem 0";
                                
                                // arrow right
                                    const arrowRight = document.createElement(\'span\')
                                    arrowRight.classList.add("fa");
                                    arrowRight.classList.add("fa-chevron-right");
                                    arrowRight.style.marginLeft = "1rem";
                                    arrowRight.style.fontSize = "30px";
                                    arrowRight.style.right = "1rem";
                                    arrowRight.style.bottom = "1rem";
                                    arrowRight.style.color = "red";
                                    arrowRight.style.background = "#282828";
                                    arrowRight.style.padding = "0.25rem 0.5rem";
                                    arrowRight.style.borderRadius = "5px";
                                    arrowRight.style.boxShadow = "2px 4px 4px #444444";
                                    arrowRight.style.position = "absolute";
                                    arrowRight.setAttribute("title", "Right click");
                                
                                // arrow left
                                
                                    const arrowLeft = document.createElement(\'span\');
                                    arrowLeft.classList.add("fa");
                                    arrowLeft.classList.add("fa-chevron-left");
                                    arrowLeft.style.fontSize = "30px";
                                    arrowLeft.style.left = "1rem";
                                    arrowLeft.style.bottom = "1rem";
                                    arrowLeft.style.color = "red";
                                    arrowLeft.style.background = "#282828";
                                    arrowLeft.style.padding = "0.25rem 0.5rem";
                                    arrowLeft.style.borderRadius = "5px";
                                    arrowLeft.style.boxShadow = "2px 4px 4px #444444";
                                    arrowLeft.style.position = "absolute";
                                    arrowLeft.setAttribute("title", "Left click");

                                
                                if (index === 0) {
                                    
                                    arrowRight.addEventListener(\'click\', function() {
                                    
                                        if (index < container.children.length - 1) {
                                            
                                            const nextIndex = index + 1;
                                            container.children[nextIndex].scrollIntoView({ behavior: \'smooth\', block: \'nearest\', inline: \'start\'  });
                                        }
                                    });
                                    child.appendChild(arrowRight)
                                } else if(index == container.children.length - 1){
                                    
                                    
                                    arrowLeft.addEventListener(\'click\', function() {
                                        if (index == container.children.length - 1) {
                                            
                                            const prevIndex = index - 1;
                                            container.children[prevIndex].scrollIntoView({ behavior: \'smooth\', block: \'nearest\', inline: \'start\'  });
                                        }
                                    });
                                    
                                    child.appendChild(arrowLeft)
                                }else{
                                    
                                    
                                    arrowLeft.addEventListener(\'click\', function() {
                                        
                                            
                                            const prevIndex = index - 1;
                                            container.children[prevIndex].scrollIntoView({ behavior: \'smooth\', block: \'nearest\', inline: \'start\'  });
                                    
                                    });
                                    arrowRight.addEventListener(\'click\', function() {
                                    
                                        if (index < container.children.length - 1) {
                                            
                                            const nextIndex = index + 1;
                                            container.children[nextIndex].scrollIntoView({ behavior: \'smooth\', block: \'nearest\', inline: \'start\'  });
                                        }
                                    });
                                
                                child.appendChild(arrowLeft)
                                child.appendChild(arrowRight)
                                    
                                }
                    
                                child.appendChild(div);
                                
                               
                            
                            });
                        }
                    });
                 }
                </script>';
                 

        return $html;
    }
}