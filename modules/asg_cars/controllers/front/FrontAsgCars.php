<?php

class asg_carsFrontAsgCarsModuleFrontController extends ModuleFrontController
{
    public function initContent()
    {
        parent::initContent();

        $this->setMedia(); 

        $languages = Language::getLanguages(true, $this->context->shop->id);
        $context = Context::getContext();

        $id_car = (int)Tools::getValue('id_car'); // Get the car ID from the request

        // pre($id_car);

        if ($id_car) {
            // Fetch car details
            $car = Db::getInstance()->getRow('SELECT * FROM `' . _DB_PREFIX_ . 'asg_cars` WHERE `id_asg_car` = ' . $id_car);

            if (!$car) {
                Tools::redirect('index.php'); // Redirect to the home page if the car doesn't exist
            }

            // Fetch related products
            $car['products'] = Db::getInstance()->executeS('SELECT * FROM `' . _DB_PREFIX_ . 'asg_cars_product` WHERE `id_asg_car` = ' . $id_car);

            if (!empty($car['images'])) {
                // Convert images from JSON or serialized format (depending on how they're stored)
                $imagePaths = json_decode($car['images']); // Assuming it's stored as JSON

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
                $car['images'] = $imageUrls;
            }

            // Assign data to Smarty
            $this->context->smarty->assign("languages", $languages);
            $this->context->smarty->assign("context", $context);
            $this->context->smarty->assign([
                'car' => $car,
            ]);

            // Render the car detail template
            $this->setTemplate('module:asg_cars/views/templates/front/detail.tpl');
        } else {
            // If no `id_car` is provided, show the list of cars (default behavior)
            $cars = Db::getInstance()->executeS('SELECT * FROM ' . _DB_PREFIX_ . 'asg_cars WHERE display = 1');

            $this->context->smarty->assign('cars', $cars);
            $this->setTemplate('module:asg_cars/views/templates/front/cms.tpl');
        }
    }


    public function setMedia()
    {
        // Add your CSS and JS here for front office
        $this->registerStylesheet('font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css', ['media' => 'all', 'priority' => 10000]);
        $this->registerJavascript('gsap-js', 'https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js', ['position' => 'head', 'priority' => 10000]);
        $this->registerJavascript('scrollTrigger-js', 'https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/ScrollTrigger.min.js', ['position' => 'head', 'priority' => 10000]);
        $this->registerJavascript('lenis-js', 'https://cdn.jsdelivr.net/npm/lenis@1.1.20/dist/lenis.min.js', ['position' => 'head', 'priority' => 10000]);

        // Optionally, add more CSS/JS if required
    }


    public function getBreadcrumbLinks()
    {
        $breadcrumb = parent::getBreadcrumbLinks();

        $breadcrumb['links'][] = [
            'title' => $this->trans('Our Cars', [], 'Shop.Theme.MyCars'),
            'url' => $this->context->link->getCMSLink(28),
        ];

        return $breadcrumb;
    }


}
