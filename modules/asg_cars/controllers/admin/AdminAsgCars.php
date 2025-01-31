<?php

class AdminAsgCarsController extends AdminController{
    
    public function __construct(){
        $this->bootstrap = true;
        parent::__construct();
        $this->context = Context::getContext();
    }

    public function initContent(){
        parent::initContent();
        include dirname(__FILE__).'/../../classes/WmModuleMain.php';
        $this->context->smarty->assign("wm_page_name", 'Alert Messages');

        $languages = Language::getLanguages(true, $this->context->shop->id);
        $context = Context::getContext();

        // pre($this->context->shop);
        if ($this->context->shop->id != 2) {
            // No shop explicitly selected, assign message to Smarty
            $this->context->smarty->assign('alert_only_asm', 'Please select a shop');
        }

        $cars = Db::getInstance(_PS_USE_SQL_SLAVE_)->executeS('SELECT * , asgcp.id_lang AS id_lang ,asgc.id_asg_car AS id_car, asgc.name AS nameCar FROM ps_asg_cars AS asgc LEFT JOIN ps_asg_cars_product AS asgcp ON asgc.id_asg_car = asgcp.id_asg_car WHERE asgc.id_shop ='.$this->context->shop->id.' ORDER BY asgc.position ASC');

        $groupedCars = [];

        foreach ($cars as $row) {
            $carId = $row['id_car'];
            $langId = $row['id_lang'];
            $category = $row['category'];
        
            // Initialize the car if not already added
            if (!isset($groupedCars[$carId])) {
                $groupedCars[$carId] = [
                    'id_asg_car' => $row['id_car'],
                    'id_shop' => $row['id_shop'],
                    'car_name' => $row['nameCar'],
                    'car_name_galleries' => $row['car_name_galleries'],
                    'description_en' => $row['description_en'],
                    'description_es' => $row['description_es'],
                    'description_fr' => $row['description_fr'],
                    'description_pt' => $row['description_pt'],
                    'description_it' => $row['description_it'],
                    'budget_en' => $row['budget_en'],
                    'budget_es' => $row['budget_es'],
                    'budget_fr' => $row['budget_fr'],
                    'budget_pt' => $row['budget_pt'],
                    'budget_it' => $row['budget_it'],
                    'display' => $row['display'],
                    'position' => $row['position'],
                    'created_at' => $row['created_at'],
                    'images' => [],
                    'products' => [] // Initialize the products array
                ];
            }

                // Process the images field
                if (!empty($row['images'])) {
                    // Convert images from JSON or serialized format (depending on how they're stored)
                    $imagePaths = json_decode($row['images']); // Assuming it's stored as JSON

                    // Generate the full URLs for each image
                    $imageUrls = [];
                    if ($imagePaths) {
                        foreach ($imagePaths as $imagePath) {
                            // Generate the full URL using Tools::getShopDomainSsl()
                            $imageUrl = $imagePath;
                            $imageUrls[] = $imageUrl; // Add to the list of full image URLs
                        }
                    }
                    
                    // Assign the full URLs to the car's images array
                    $groupedCars[$carId]['images'] = $imageUrls;
                }

        
            // Initialize the language array if not already added
            if (!isset($groupedCars[$carId]['products'][$langId])) {
                $groupedCars[$carId]['products'][$langId] = [];
            }
        
            // Initialize the category array if not already added
            if (!isset($groupedCars[$carId]['products'][$langId][$category])) {
                $groupedCars[$carId]['products'][$langId][$category] = [];
            }
        
            // Add the product to the appropriate category and language
            if ($row['id_asg_car_product'] !== null) {
                $groupedCars[$carId]['products'][$langId][$category][] = [
                    'id_asg_car_product' => $row['id_asg_car_product'],
                    'product_name' => $row['name'],
                    'link' => $row['link'],
                    'id_product' => $row['id_product']
                ];
            }
        }

        // pre($groupedCars);


        $this->context->smarty->assign("languages", $languages);
        $this->context->smarty->assign("context", $context);
        $this->context->smarty->assign("cars", $groupedCars);
        $contentBO = $this->context->smarty->fetch(_PS_MODULE_DIR_. 'asg_cars/views/templates/admin/view.tpl');
        $contentFO = $this->context->smarty->fetch(_PS_MODULE_DIR_. 'asg_cars/views/templates/front/cms.tpl');
        $this->context->smarty->assign("content", $contentBO);
        $this->context->smarty->assign("contentFront", $contentFO);
    }
    
    public function postProcess(){
        if(Tools::getValue('action') == 'saveCar') return self::saveCar();
        elseif(Tools::getValue('action') == 'deleteCar') return self::deleteCar();
        elseif(Tools::getValue('action') == 'getdataCar') return self::getCarData(Tools::getValue('id'));
        elseif(Tools::getValue('action') == 'update_position') return self::updatePosition(Tools::getValue('sortedIds'));
        elseif(Tools::getValue('action') == 'removeImageCar') return self::removeImageCar(Tools::getValue('img_url'));
        elseif(Tools::getValue('action') == 'updateImageOrder') return self::updateImageOrder(Tools::getValue('sortedImages'),Tools::getValue('carId'));
        elseif(Tools::getValue('action') == 'deleteProduct') return self::deleteProduct(Tools::getValue('idproductcar'));
    }

    public function deleteProduct($idproductcar){
        // pre($idproductcar);
        return Db::getInstance(_PS_USE_SQL_SLAVE_)->execute("DELETE FROM `ps_asg_cars_product` WHERE id_asg_car_product = " . $idproductcar);
    }

    public function getCarData($id_car){

        $car = Db::getInstance(_PS_USE_SQL_SLAVE_)->executeS('SELECT * , asgcp.id_lang AS id_lang ,asgc.id_asg_car AS id_car, asgc.name AS nameCar FROM ps_asg_cars AS asgc LEFT JOIN ps_asg_cars_product AS asgcp ON asgc.id_asg_car = asgcp.id_asg_car WHERE asgc.id_asg_car='. (int)$id_car);

        $dataCar = [];

        foreach ($car as $row) {
            $carId = $row['id_car'];
            $langId = $row['id_lang'];
            $category = $row['category'];
        
            // Initialize the car if not already added
            if (!isset($dataCar[$carId])) {
                $dataCar[$carId] = [
                    'id_asg_car' => $row['id_car'],
                    'id_shop' => $row['id_shop'],
                    'car_name' => $row['nameCar'],
                    'car_name_galleries' => $row['car_name_galleries'],
                    'description_en' => $row['description_en'],
                    'description_es' => $row['description_es'],
                    'description_fr' => $row['description_fr'],
                    'description_pt' => $row['description_pt'],
                    'description_it' => $row['description_it'],
                    'budget_en' => $row['budget_en'],
                    'budget_es' => $row['budget_es'],
                    'budget_fr' => $row['budget_fr'],
                    'budget_pt' => $row['budget_pt'],
                    'budget_it' => $row['budget_it'],
                    'display' => $row['display'],
                    'created_at' => $row['created_at'],
                    'images' => [],
                    'products' => [] // Initialize the products array
                ];
            }

            // Process the images field
            if (!empty($row['images'])) {
                // Convert images from JSON or serialized format (depending on how they're stored)
                $imagePaths = json_decode($row['images']); // Assuming it's stored as JSON

                // Generate the full URLs for each image
                $imageUrls = [];
                if ($imagePaths) {
                    foreach ($imagePaths as $imagePath) {
                        // Generate the full URL using Tools::getShopDomainSsl()
                        $imageUrl = $imagePath;
                        $imageUrls[] = $imageUrl; // Add to the list of full image URLs
                    }
                }
                
                // Assign the full URLs to the car's images array
                $dataCar[$carId]['images'] = $imageUrls;
            }

        
            // Initialize the language array if not already added
            if (!isset($dataCar[$carId]['products'][$langId])) {
                $dataCar[$carId]['products'][$langId] = [];
            }
        
            // Initialize the category array if not already added
            if (!isset($dataCar[$carId]['products'][$langId][$category])) {
                $dataCar[$carId]['products'][$langId][$category] = [];
            }
        
            // Add the product to the appropriate category and language
            if ($row['id_asg_car_product'] !== null) {
                $dataCar[$carId]['products'][$langId][$category][] = [
                    'id_asg_car_product' => $row['id_asg_car_product'],
                    'product_name' => $row['name'],
                    'link' => $row['link'],
                    'id_product' => $row['id_product']
                ];
            }
        }

        header('Content-Type: application/json');

        echo json_encode($dataCar);
        exit;
    }

    public function updatePosition($sortedIds){
        if (!is_array($sortedIds) || empty($sortedIds)) {
            return false;
        }

        // pre($sortedIds);

        foreach ($sortedIds as $item) {
            $idAsgCar = (int)$item['id_asg_car'];
            $newPosition = (int)$item['position'];
    
            // Execute the update query
            Db::getInstance()->execute(
                'UPDATE ' . _DB_PREFIX_ . 'asg_cars 
                SET position = ' . (int)$newPosition . ' 
                WHERE id_asg_car = ' . (int)$idAsgCar
            );
        }

        return true;
    }
    
    public function saveCar(){

        // pre(Tools::getAllValues());


        $nameFolder = Tools::getValue('name');
        $nameFolder = str_replace(' ', '_', $nameFolder);

        $words = explode('_', $nameFolder);
        $nameFolder = implode('_', array_slice($words, 0, 2));

        $nameFolder = strtolower($nameFolder);

        $uploadDir = _PS_MODULE_DIR_ . 'asg_cars/views/imgs/'.$nameFolder.'/';
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0755, true); // Create the folder with appropriate permissions
        }

        // Get existing images from the form
        $existingImagesJson = Tools::getValue('existing_images');
        $existingImages = json_decode($existingImagesJson, true);
        if (!is_array($existingImages)) {
            $existingImages = [];
        }

        $normalizedExistingImages = [];
        foreach ($existingImages as $image) {
            $normalizedPath = preg_replace('#^https?://[^/]+#', '', $image); // Remove domain
            $normalizedPath = preg_replace('#^/#', '', $normalizedPath);  // Fix double leading slash
            $normalizedExistingImages[] = $normalizedPath;
        }
    
        // Process uploaded images (multiple files)
        $uploadedImages = [];
        if (isset($_FILES['images']) && !empty($_FILES['images']['name'][0])) {
            error_log("Files detected for upload.");
            foreach ($_FILES['images']['tmp_name'] as $key => $tmpName) {
                // Check if the file was uploaded without errors
                if ($_FILES['images']['error'][$key] !== UPLOAD_ERR_OK) {
                    error_log("Error uploading file: " . $_FILES['images']['name'][$key] . 
                              " Error code: " . $_FILES['images']['error'][$key]);
                    continue;
                }
        
                if (is_uploaded_file($tmpName)) {
                    $fileName = basename($_FILES['images']['name'][$key]);
                    $filePath = $uploadDir . $fileName;
        
                    error_log("Processing file: " . $fileName);
                    error_log("Temporary path: " . $tmpName);
                    error_log("Destination path: " . $filePath);
        
                    if (move_uploaded_file($tmpName, $filePath)) {
                        error_log("File moved successfully: " . $filePath);
                        $uploadedImages[] = 'modules/asg_cars/views/imgs/' . $nameFolder . '/' . $fileName;
                    } else {
                        error_log("Failed to move file: " . $tmpName . " to " . $filePath);
                    }
                } else {
                    error_log("is_uploaded_file returned false for: " . $tmpName);
                }
            }
        } else {
            error_log("No files uploaded or empty files array.");
        }
        

        $allImages = array_merge($normalizedExistingImages, $uploadedImages);
    
        // Serialize image paths into a JSON string for the database
        $imagesJson = json_encode($allImages,JSON_UNESCAPED_SLASHES);
    
        // Insert or Update logic
        if (Tools::getValue('id') == 0) {
            $maxPosition = Db::getInstance()->getValue(
                'SELECT MAX(position) FROM ' . _DB_PREFIX_ . 'asg_cars'
            );

            $newPosition = $maxPosition ? $maxPosition + 1 : 1;

            // Insert new car data
            Db::getInstance(_PS_USE_SQL_SLAVE_)->execute(
                'INSERT INTO ' . _DB_PREFIX_ . 'asg_cars (
                    id_shop, name, car_name_galleries,description_en,description_es,description_fr,description_pt,description_it,budget_en,budget_es,budget_fr,budget_pt,budget_it, display, position,
                    images, created_at
                ) VALUES (
                    ' . (int)Tools::getValue('id_shop') . ',
                    "' . pSQL(Tools::getValue('name')) . '",
                    "' . pSQL(Tools::getValue('car_name_galleries')) . '",
                    "' . pSQL(Tools::getValue('description_en')) . '",
                    "' . pSQL(Tools::getValue('description_es')) . '",
                    "' . pSQL(Tools::getValue('description_fr')) . '",
                    "' . pSQL(Tools::getValue('description_pt')) . '",
                    "' . pSQL(Tools::getValue('description_it')) . '",
                    "' . pSQL(Tools::getValue('budget_en')) . '",
                    "' . pSQL(Tools::getValue('budget_es')) . '",
                    "' . pSQL(Tools::getValue('budget_fr')) . '",
                    "' . pSQL(Tools::getValue('budget_pt')) . '",
                    "' . pSQL(Tools::getValue('budget_it')) . '",
                    ' . (int)Tools::getValue('display') . ',
                    ' . (int)$newPosition . ',
                    "' . pSQL($imagesJson) . '",
                    NOW()
                )'
            );
    
            // Get the new car's ID
            $idAsgCar = Db::getInstance()->Insert_ID(); 
    
        } else {
            // Update existing car data
            Db::getInstance(_PS_USE_SQL_SLAVE_)->execute(
                'UPDATE ' . _DB_PREFIX_ . 'asg_cars 
                SET 
                    id_shop=' . (int)Tools::getValue('id_shop') . ',
                    name="' . pSQL(Tools::getValue('name')) . '",
                    car_name_galleries="' . pSQL(Tools::getValue('car_name_galleries')) . '",
                    description_en="' . pSQL(Tools::getValue('description_en')) . '",
                    description_es="' . pSQL(Tools::getValue('description_es')) . '",
                    description_fr="' . pSQL(Tools::getValue('description_fr')) . '",
                    description_pt="' . pSQL(Tools::getValue('description_pt')) . '",
                    description_it="' . pSQL(Tools::getValue('description_it')) . '",
                    budget_en="' . pSQL(Tools::getValue('budget_en')) . '",
                    budget_es="' . pSQL(Tools::getValue('budget_es')) . '",
                    budget_fr="' . pSQL(Tools::getValue('budget_fr')) . '",
                    budget_pt="' . pSQL(Tools::getValue('budget_pt')) . '",
                    budget_it="' . pSQL(Tools::getValue('budget_it')) . '",
                    display=' . (int)Tools::getValue('display') . ',
                    images="' . pSQL($imagesJson) . '"
                WHERE id_asg_car=' . (int)Tools::getValue('id')
            );
    
            // Get the car ID to update associated products
            $idAsgCar = (int)Tools::getValue('id');
        }
    
        // Collect all product data from the POST request (in JSON format)
        $productsData = json_decode(Tools::getValue('products_data'), true); 

        // pre($productsData);
    
        // Save products for each category in asg_cars_product table
        foreach ($productsData as $category => $products) {
            foreach ($products as $product) {
                if (!empty($product['name'])) {


                    $link = new Link();
                    $productLink = !empty($product['link']) ? $link->getProductLink(pSQL($product['link']),null,null,null,(int)$product['id_lang'],(int)Tools::getValue('id_shop'),null,false,false,false,[],true) : null;

                if($product['id_asg_car_product'] && $product['id_asg_car_product'] > 0){
                    Db::getInstance()->update('asg_cars_product',[
                        'id_asg_car' => (int)$idAsgCar,
                        'category' => $category, // category like 'motor', 'chassis', etc.
                        'id_lang' => (int)$product['id_lang'],
                        'name' => pSQL($product['name']),
                        'link' => $productLink,
                        'id_product' => $product['link'],
                        'created_at' => date('Y-m-d H:i:s')
                    ],
                    'id_asg_car_product =' . $product['id_asg_car_product']
                );
                }else{
                    Db::getInstance()->insert('asg_cars_product', [
                        'id_asg_car' => (int)$idAsgCar,
                        'category' => $category, // category like 'motor', 'chassis', etc.
                        'id_lang' => (int)$product['id_lang'],
                        'name' => pSQL($product['name']),
                        'link' => $productLink,
                        'id_product' => $product['link'],
                        'created_at' => date('Y-m-d H:i:s')
                    ]);
                }

                }
            }
        }

    }

    public function updateImageOrder($sortedImages,$carId){

        if (!$carId || !is_array($sortedImages)) {
            die(json_encode(['status' => 'error', 'message' => 'Invalid input']));
        }

        $imagesJson = json_encode(array_values($sortedImages));

        // Update the database
        $sql = "UPDATE " . _DB_PREFIX_ . "asg_cars 
                SET images = '" . pSQL($imagesJson) . "' 
                WHERE id_asg_car = $carId";
    
        if (Db::getInstance()->execute($sql)) {
            die(json_encode(['status' => 'success', 'message' => 'Image order updated']));
        } else {
            die(json_encode(['status' => 'error', 'message' => 'Database update failed']));
        }
    }   

    public function removeImageCar($img_url){
        if (!$img_url) {
            die(json_encode(['status' => 'error', 'message' => 'Invalid image URL']));
        }

        $img_url = ltrim($img_url, '/');
    
        // Fetch all records and filter manually
        $sql = "SELECT id_asg_car, images 
            FROM " . _DB_PREFIX_ . "asg_cars 
            WHERE JSON_SEARCH(images, 'one', '" . pSQL($img_url) . "') IS NOT NULL";
        $cars = Db::getInstance()->executeS($sql);
    
        foreach ($cars as $car) {
            $id_asg_car = (int) $car['id_asg_car'];
            $images = json_decode($car['images'], true);
    
            if (!is_array($images)) {
                continue;
            }
    
            // If the image exists in this car, remove it
            if (in_array($img_url, $images)) {
                $updatedImages = array_filter($images, function ($image) use ($img_url) {
                    return $image !== $img_url;
                });
    
                $updatedImagesJson = json_encode(array_values($updatedImages));
    
                // Update database
                $updateSql = "UPDATE " . _DB_PREFIX_ . "asg_cars SET images = '" . pSQL($updatedImagesJson) . "' WHERE id_asg_car = $id_asg_car";
                if (Db::getInstance()->execute($updateSql)) {
                    die(json_encode(['status' => 'success', 'message' => 'Image removed successfully']));
                } else {
                    die(json_encode(['status' => 'error', 'message' => 'Failed to update database']));
                }
            }
        }
    
        die(json_encode(['status' => 'error', 'message' => 'Image not found']));
    }
    
    
    public function deleteCar(){
        return Db::getInstance(_PS_USE_SQL_SLAVE_)->execute("DELETE FROM `ps_asg_cars` WHERE id_asg_car = " . (int)Tools::getValue('id'));
    }
    
    public function hookDisplayBackOfficeHeader()
    {
       $this->context->controller->addCss($this->_path.'css/tab.css');
    }
}