<?php
/**
 * Recherche de produits par compatibilité
 *
 * @author    Guillaume Heid - Ukoo <modules@ukoo.fr>
 * @copyright Ukoo 2015 - 2016
 * @license   Ukoo - Tous droits réservés
 *
 * "In Ukoo we trust!"
 */

class UkooCompatCompat extends ObjectModel
{
    public $id_product;

    public static $definition = array(
        'table' => 'ukoocompat_compat',
        'primary' => 'id_ukoocompat_compat',
        'multilang' => false,
        'fields' => array('id_product' => array('type' => self::TYPE_INT, 'required' => true)));

    /**
     * Création des tables de compatibilités
     * @return bool
     */
    public static function createDbTable()
    {
        return Db::getInstance()->execute('CREATE TABLE IF NOT EXISTS `'._DB_PREFIX_.'ukoocompat_compat`(
			`id_ukoocompat_compat` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
			`id_product` INT(10) UNSIGNED NOT NULL,
			PRIMARY KEY (`id_ukoocompat_compat`)
			) ENGINE='._MYSQL_ENGINE_.' DEFAULT CHARSET=utf8') &&
            Db::getInstance()->execute('CREATE TABLE IF NOT EXISTS `'._DB_PREFIX_.'ukoocompat_compat_criterion`(
			`id_ukoocompat_compat` INT(10) UNSIGNED NOT NULL,
			`id_ukoocompat_filter` INT(10) UNSIGNED NOT NULL,
			`id_ukoocompat_criterion` INT(10) UNSIGNED NOT NULL,
			PRIMARY KEY (`id_ukoocompat_compat`,`id_ukoocompat_filter`,`id_ukoocompat_criterion`)
			) ENGINE='._MYSQL_ENGINE_.' DEFAULT CHARSET=utf8');
    }

    /**
     * Suppression des tables de compatibilités
     * @return bool
     */
    public static function removeDbTable()
    {
        return Db::getInstance()->execute('DROP TABLE IF EXISTS `'._DB_PREFIX_.'ukoocompat_compat`')
            && Db::getInstance()->execute('DROP TABLE IF EXISTS `'._DB_PREFIX_.'ukoocompat_compat_criterion`');
    }

    /**
     * Réinitialisation des tables de compatibilités
     * @return bool
     */
    public static function resetDbTable()
    {
        return Db::getInstance()->execute('TRUNCATE `'._DB_PREFIX_.'ukoocompat_compat`')
            && Db::getInstance()->execute('TRUNCATE `'._DB_PREFIX_.'ukoocompat_compat_criterion`');
    }

    /**
     * Créé une liaison entre un critère, un filtre et une compatibilité
     * @param $id_filter
     * @param $id_criterion
     * @return bool
     */
    public function addAssociatedCriterion($id_filter, $id_criterion)
    {
        // On test la valeur de l'id_criterion. Seul un entier ou un zéro absolue doit être utilisé.
        // Une valeur vide n'est pas corecte.
        if ($id_criterion === '') {
            return true;
        }

        return Db::getInstance()->insert('ukoocompat_compat_criterion', array(
            'id_ukoocompat_compat' => (int)$this->id,
            'id_ukoocompat_filter' => (int)$id_filter,
            'id_ukoocompat_criterion' => (int)$id_criterion));
    }

    /**
     * Supprime les liaisons entre une compatibilité et les filtres, critères
     * @return mixed
     */
    public function deleteAssociatedCriteria()
    {
        return Db::getInstance()->delete('ukoocompat_compat_criterion', '`id_ukoocompat_compat` = '.(int)$this->id);
    }

    /**
     * Retourne la liste des critères d'une compatibilité
     * @param $id_lang
     * @return array
     */
    public function getAssociatedCriteria($id_lang)
    {
        return UkooCompatCompat::getCompatibilityAssociatedCriteria((int)$this->id, (int)$id_lang);
    }

    /**
     * Retourne la liste des critères d'une compatibilité (static)
     * @param $id_compatibility
     * @param $id_lang
     * @return array
     */
    public static function getCompatibilityAssociatedCriteria($id_compatibility, $id_lang)
    {
        // Le CASE permet de remplacer l'id criterion par "*" si celui-ci est égale à "0"
        // (compatible "Tous" critères)
        $ret = array();
        $criteria = Db::getInstance(_PS_USE_SQL_SLAVE_)->executeS('
            SELECT ucc.`id_ukoocompat_compat`, ucc.`id_ukoocompat_filter`,
            CASE WHEN ucc.`id_ukoocompat_criterion` = 0 THEN "*"
                ELSE ucc.`id_ukoocompat_criterion` END AS id_ukoocompat_criterion,
            ufl.`name` as filter_name, ucl.`value` as criterion_value
            FROM `'._DB_PREFIX_.'ukoocompat_compat_criterion` ucc
            LEFT JOIN `'._DB_PREFIX_.'ukoocompat_filter_lang` ufl
            	ON (ufl.`id_ukoocompat_filter` = ucc.`id_ukoocompat_filter` AND ufl.`id_lang` = '.(int)$id_lang.')
            LEFT JOIN `'._DB_PREFIX_.'ukoocompat_criterion_lang` ucl
            	ON (ucl.`id_ukoocompat_criterion` = ucc.`id_ukoocompat_criterion` AND ucl.`id_lang` = '.(int)$id_lang.')
            WHERE ucc.`id_ukoocompat_compat` = '.(int)$id_compatibility);
        foreach ($criteria as $criterion) {
            $ret[(int)$criterion['id_ukoocompat_filter']] = $criterion;
        }
        return $ret;
    }

    /**
     * Retourne le nombre total de compatibilités pour les KPIS (statique)
     * @return int
     */
    public static function getTotalCompatibilities()
    {
        return (int)Db::getInstance(_PS_USE_SQL_SLAVE_)->getValue(
            'SELECT COUNT(*) FROM `'._DB_PREFIX_.'ukoocompat_compat` WHERE 1'
        );
    }

    /**
     * Retourne le nombre total de produits compatibles pour les KPIS (statique)
     * @return int
     */
    public static function getTotalCompatibleProducts()
    {
        return (int)count(Db::getInstance(_PS_USE_SQL_SLAVE_)->executeS('SELECT *
            FROM `'._DB_PREFIX_.'ukoocompat_compat`
            GROUP BY `id_product`'));
    }

    /**
     * Retourne l'ID d'un produit correspondant à la référence passée (statique)
     * Le type de référence peut être : reference, supplier_reference, ean13, upc
     * @param $reference
     * @param $reference_type
     * @return int
     */
    public static function getIdProductFromReference($reference, $reference_type)
    {
        return (int)Db::getInstance(_PS_USE_SQL_SLAVE_)->getValue('
			SELECT `id_product`
			FROM `'._DB_PREFIX_.'product`
			WHERE `'.pSQL($reference_type).'` = "'.pSQL($reference).'"');
    }

    /**
     * Retourne true si la compatibilité existe déja avec les mêmes associations (critères et produits) (statique)
     * @param array $compatibility
     * @return bool
     */
    public static function compatibilityExists(array $compatibility)
    {
        if (isset($compatibility['id_alias'])) {
            unset($compatibility['id_alias']);
        }
        if (isset($compatibility['id_product'])) {
            $id_product = (int)$compatibility['id_product'];
            unset($compatibility['id_product']);
        } else {
            $id_product = 0;
        }
        $sql = '
            SELECT COUNT(uc.`id_ukoocompat_compat`)
            FROM `'._DB_PREFIX_.'ukoocompat_compat` uc';
        $i = 0;
        foreach ($compatibility as $id_filter => $id_criterion) {
            $sql .= ' INNER JOIN `'._DB_PREFIX_.'ukoocompat_compat_criterion` ucc'.$i.'
            	ON (ucc'.$i.'.`id_ukoocompat_compat` = uc.`id_ukoocompat_compat`
                AND ucc'.$i.'.`id_ukoocompat_filter` = '.(int)$id_filter.'
                AND ucc'.$i.'.`id_ukoocompat_criterion` = '.(int)$id_criterion.')';
            $i++;
        }
        $sql .= ' WHERE uc.`id_product` = '.$id_product;
        return ((int)Db::getInstance(_PS_USE_SQL_SLAVE_)->getValue($sql) > 0 ? true : false);
    }

    /**
     * Trie un tableau multi-dimentionnel
     * Utilisé pour le trie par valeur des critères
     * @param $array
     * @param $cols
     * @return array
     */
    /*public static function arrayMsort($array, $cols)
    {
        $colarr = array();
        foreach ($cols as $col => $order) {
            $colarr[$col] = array();
            foreach ($array as $k => $row) {
                $colarr[$col]['_'.$k] = Tools::strtolower($row[$col]);
            }
        }
        $eval = 'array_multisort(';
        foreach ($cols as $col => $order) {
            $eval .= '$colarr[\''.$col.'\'],'.$order.',';
        }
        $eval = Tools::substr($eval, 0, -1).');';
        eval($eval);
        $ret = array();
        foreach ($colarr as $col => $arr) {
            foreach ($arr as $k => $v) {
                $k = Tools::substr($k, 1);
                if (!isset($ret[$k])) {
                    $ret[$k] = $array[$k];
                }
                $ret[$k][$col] = $array[$k][$col];
            }
        }
        return $ret;
    }*/

    /**
     * Trie les critères par ordre alphabétique
     * Remplace la méthode "arrayMsort()" qui utilisait "eval()" non toléré par le validator PS
     * @param $criteria
     * @param string $order_way
     * @return array
     */
    public static function sortCriteriaByAlpha($criteria, $order_way = 'DESC')
    {
        $array_to_sort = array();
        foreach ($criteria as $index => $criterion) {
            $array_to_sort[$index] = $criterion['value'];
        }

        // Trie un tableau avec l'algorithme à "ordre naturel" insensible à la casse
        if ($order_way != 'ASC') {
            arsort($array_to_sort, SORT_NATURAL);
        } else {
            asort($array_to_sort, SORT_NATURAL);
        }

        $ret = array();
        foreach (array_keys($array_to_sort) as $index) {
            $ret[$index] = $criteria[$index];
        }

        return $ret;
    }

    /**
     * Retourne le nombre ou la liste des produits compatibles avec la recherche
     * Basé sur la fonction Category::getProducts()
     * TODO :: à mettre à jour régulièrement en se callant sur la fonction native Category::getProducts()
     * @param $search
     * @param $id_lang
     * @param null $id_category
     * @param int $p
     * @param int $n
     * @param null $order_by
     * @param null $order_way
     * @param bool $get_total
     * @param bool $active
     * @param bool $random
     * @param int $random_number_products
     * @param Context $context
     * @return array
     */
    public static function getCompatiblesProducts(
        $search,
        $id_lang,
        $id_category = null,
        $p = 1,
        $n = 10,
        $order_by = null,
        $order_way = 'DESC',
        $get_total = false,
        $active = true,
        $random = false,
        $random_number_products = 1,
        Context $context = null
    ) {
        
        if (!$context) $context = Context::getContext();

        if ($p < 1) $p = 1;
        $order_by = Tools::getValue('order_by_compats');
        $order_way = Tools::getValue('order_by_orientation_compats', 'DESC');
        /*$order_way = 'DESC';*/
        $multifilter_idCategory = Tools::getValue('multiFilter_id_category', 0);
        $multifilter_idManufacturer = Tools::getValue('id_manufacturer_compats', 0);

        if(strlen($order_by) < 1) $order_by ='price';
        if(strlen($order_way) < 1) $order_way ='DESC';

        if ($order_by == 'position') $order_by = 'price';
        if ($order_way == '') $order_by = 'DESC';

        $order_by_prefix = false;
        if ($order_by == 'date_add' || $order_by == 'price' || $order_by == 'reference') {
            $order_by_prefix = 'p';
        } elseif ($order_by == 'name') {
            $order_by_prefix = 'pl';
        } elseif ($order_by == 'quantity') {
            $order_by_prefix = 'sa';
        }

        if (!Validate::isBool($active) || !Validate::isOrderBy($order_by) || !Validate::isOrderWay($order_way)) {
            die (Tools::displayError());
        }


        // On tiens compte de la catégorie courante, et de ses sous-catégories,
        // mais uniquement si elles sont sélectionnées dans la configuration de la recherche courante
        if ($id_category != null && is_array($search->categories) && !empty($search->categories)) {
            $id_categories = UkooCompatCompat::getAllSubcategoriesIds((int)$id_category);
            $id_categories = array_intersect($id_categories, $search->categories);
        } else {
            $id_categories = null;
        }

        $newsSQL =             (Tools::getValue('news_compats', 0)) ? ' AND p.date_add > "' . date('Y-m-d', strtotime('-'.(Configuration::get('PS_NB_DAYS_NEW_PRODUCT') ? (int)Configuration::get('PS_NB_DAYS_NEW_PRODUCT') : 20).' DAY')).'" ' : '';
        $categorySQL =         (isset($multifilter_idCategory) && ( $multifilter_idCategory != 0 )) ? ' AND p.id_category_default = ' . $multifilter_idCategory . ' ' : '';
        $manufacturerSQL =     (isset($multifilter_idManufacturer) && ($multifilter_idManufacturer != 0 )) ? ' AND p.id_manufacturer = ' . $multifilter_idManufacturer . ' ' : '';

        // Retourne uniquement le nombre de produits
        if ($get_total) {
            $sql = 'SELECT COUNT(DISTINCT p.`id_product`) AS total
                    FROM `'._DB_PREFIX_.'ukoocompat_compat` uc
                    LEFT JOIN `'._DB_PREFIX_.'product` p
                        ON (p.`id_product` = uc.`id_product`)
                    '.Shop::addSqlAssociation('product', 'p').
                ($id_category != null ?
                    ' LEFT JOIN `'._DB_PREFIX_.'category_product` cp ON (p.`id_product` = cp.`id_product`)' : '');

            // on créé une jointure pour chaque filtre sélectionné
            foreach ($search->selected_criteria as $id_filter => $id_criterion) {
                // si l'id_criterion est vide, on saute la jointure
                if ($id_criterion !== '') {
                    $id_filter = (int)UkooCompatSearchFilter::getFilterIdFromSearchFilterId((int)$id_filter);
                    $prefix = 'ucc' . (int)$id_filter;
                    $sql .= ' INNER JOIN `' . _DB_PREFIX_ . 'ukoocompat_compat_criterion` ' . $prefix . '
                    ON (' . $prefix . '.`id_ukoocompat_compat` = uc.`id_ukoocompat_compat`
                        AND ' . $prefix . '.`id_ukoocompat_filter` = ' . (int)$id_filter . '
                        AND (
                            ' . $prefix . '.`id_ukoocompat_criterion` = ' . (int)$id_criterion . '
                            OR ' . $prefix . '.`id_ukoocompat_criterion` = 0
                        )
                    )';
                }
            }

            // suite et fin de la requête
            $sql .= '
                WHERE product_shop.`visibility` IN ("both", "catalog")'.
                
                $newsSQL .
                $categorySQL .
                // $manufacturerSQL .
                ($active ? ' AND product_shop.`active` = 1' : '').
                ($id_category != null && is_array($id_categories) && !empty($id_categories) ?
                    ' AND cp.`id_category` IN ('.pSQL(implode(', ', $id_categories)).')' :
                    ($id_category != null ? ' AND cp.`id_category` = '.(int)$id_category :
                        ''));
            // echo $sql;
            // exit;
            return (int)Db::getInstance(_PS_USE_SQL_SLAVE_)->getValue($sql);
        }

        $sql = '
            SELECT p.*, product_shop.*, stock.out_of_stock, IFNULL(stock.quantity, 0) as quantity,
                MAX(product_attribute_shop.id_product_attribute) id_product_attribute,
                product_attribute_shop.minimal_quantity AS product_attribute_minimal_quantity, pl.`description`,
                pl.`description_short`, pl.`available_now`, pl.`available_later`, pl.`link_rewrite`,
                pl.`meta_description`, pl.`meta_keywords`, pl.`meta_title`, pl.`name`,
                MAX(image_shop.`id_image`) id_image, il.`legend`, m.`name` AS manufacturer_name,
                cl.`name` AS category_default, DATEDIFF(product_shop.`date_add`, DATE_SUB(NOW(),
                INTERVAL '.(Validate::isUnsignedInt(Configuration::get('PS_NB_DAYS_NEW_PRODUCT')) ?
                Configuration::get('PS_NB_DAYS_NEW_PRODUCT') : 20).'
                DAY)) > 0 AS new, product_shop.price AS orderprice
            FROM `'._DB_PREFIX_.'ukoocompat_compat` uc
            LEFT JOIN `'._DB_PREFIX_.'product` p
                ON (p.`id_product` = uc.`id_product`)
            '.Shop::addSqlAssociation('product', 'p').'
            LEFT JOIN `'._DB_PREFIX_.'product_attribute` pa
                ON (p.`id_product` = pa.`id_product`)
            '.Shop::addSqlAssociation('product_attribute', 'pa', false, 'product_attribute_shop.`default_on` = 1').'
            '.Product::sqlStock('p', 'product_attribute_shop', false, $context->shop).'
            LEFT JOIN `'._DB_PREFIX_.'category_lang` cl
                ON (product_shop.`id_category_default` = cl.`id_category`
                AND cl.`id_lang` = '.(int)$id_lang.Shop::addSqlRestrictionOnLang('cl').')
            LEFT JOIN `'._DB_PREFIX_.'product_lang` pl
                ON (p.`id_product` = pl.`id_product`
                AND pl.`id_lang` = '.(int)$id_lang.Shop::addSqlRestrictionOnLang('pl').')
            LEFT JOIN `'._DB_PREFIX_.'image` i
                ON (i.`id_product` = p.`id_product`)'.
            Shop::addSqlAssociation('image', 'i', false, 'image_shop.cover=1').'
            LEFT JOIN `'._DB_PREFIX_.'image_lang` il
                ON (image_shop.`id_image` = il.`id_image`
                AND il.`id_lang` = '.(int)$id_lang.')
            LEFT JOIN `'._DB_PREFIX_.'manufacturer` m
                ON m.`id_manufacturer` = p.`id_manufacturer`'.($id_category != null ? '
            LEFT JOIN `'._DB_PREFIX_.'category_product` cp
                ON (p.`id_product` = cp.`id_product`)' : '') . 
            'LEFT JOIN `'._DB_PREFIX_.'stock_available` sa
                ON (p.`id_product` = sa.`id_product`)';
        // echo $sql;
        // exit;
        // on créé une jointure pour chaque filtre sélectionné
        foreach ($search->selected_criteria as $id_filter => $id_criterion) {
            // si l'id_criterion est vide, on saute la jointure
            if ($id_criterion !== '') {
                $id_filter = (int)UkooCompatSearchFilter::getFilterIdFromSearchFilterId((int)$id_filter);
                $prefix = 'ucc'.(int)$id_filter;
                $sql .= ' INNER JOIN `'._DB_PREFIX_.'ukoocompat_compat_criterion` '.$prefix.'
                ON ('.$prefix.'.`id_ukoocompat_compat` = uc.`id_ukoocompat_compat`
                    AND '.$prefix.'.`id_ukoocompat_filter` = '.(int)$id_filter.'
                    AND (
                        '.$prefix.'.`id_ukoocompat_criterion` = '.(int)$id_criterion.'
                        OR '.$prefix.'.`id_ukoocompat_criterion` = 0
                    )
                )';
            }
        }

        // suite et fin de la requête
        $sql .= '
            WHERE product_shop.`id_shop` = '.(int)$context->shop->id.'
            AND product_shop.`visibility` IN ("both", "catalog")'.
            ($active ? ' AND product_shop.`active` = 1' : '').
            ($id_category != null && is_array($id_categories) && !empty($id_categories) ?
                ' AND cp.`id_category` IN ('.pSQL(implode(', ', $id_categories)).')' :
                ($id_category != null ? ' AND cp.`id_category` = '.(int)$id_category :
                    '')).
            $newsSQL .
            $categorySQL .
            // $manufacturerSQL .
            ' GROUP BY product_shop.id_product';

        if ($random === true) {
            $sql .= ' ORDER BY p.`id_product` DESC LIMIT '.(int)$random_number_products;
        } else {
            $sql .= ' ORDER BY '.(!empty($order_by_prefix) ? $order_by_prefix.'.' : ' p.id_product ').'`'.bqSQL($order_by).'` '.
                pSQL($order_way).'
            LIMIT '.(((int)$p - 1) * (int)$n).','.(int)$n;
        }
        // echo $sql;
        // exit;
        $result = Db::getInstance(_PS_USE_SQL_SLAVE_)->executeS($sql);
        if ($order_by == 'orderprice') {
            Tools::orderbyPrice($result, $order_way);
        }

        if (!$result) return array();

        return Product::getProductsProperties($id_lang, $result);
    }
    
    
    public static function getUniversalProducts(
        $search,
        $id_lang,
        $id_category = null,
        $p = 1,
        $n = 10,
        $order_by = null,
        $order_way = 'DESC',
        $get_total = false,
        $active = true,
        $random = false,
        $random_number_products = 1,
        Context $context = null
    ) {
        
        if (!$context) $context = Context::getContext();

        if ($p < 1) $p = 1;
        $order_by = Tools::getValue('order_by_compats');
        $order_way = Tools::getValue('order_by_orientation_compats', 'DESC');
        /*$order_way = 'DESC';*/
        $multifilter_idCategory = Tools::getValue('multiFilter_id_category', 0);
        $multifilter_idManufacturer = Tools::getValue('id_manufacturer_compats', 0);

        if(strlen($order_by) < 1) $order_by ='price';
        if(strlen($order_way) < 1) $order_way ='DESC';

        if ($order_by == 'position') $order_by = 'price';
        if ($order_way == '') $order_by = 'DESC';

        $order_by_prefix = false;
        if ($order_by == 'date_add' || $order_by == 'price' || $order_by == 'reference') {
            $order_by_prefix = 'p';
        } elseif ($order_by == 'name') {
            $order_by_prefix = 'pl';
        } elseif ($order_by == 'quantity') {
            $order_by_prefix = 'sa';
        }

        if (!Validate::isBool($active) || !Validate::isOrderBy($order_by) || !Validate::isOrderWay($order_way)) {
            die (Tools::displayError());
        }


        // On tiens compte de la catégorie courante, et de ses sous-catégories,
        // mais uniquement si elles sont sélectionnées dans la configuration de la recherche courante
        if ($id_category != null && is_array($search->categories) && !empty($search->categories)) {
            $id_categories = UkooCompatCompat::getAllSubcategoriesIds((int)$id_category);
            $id_categories = array_intersect($id_categories, $search->categories);
        } else {
            $id_categories = null;
        }

        $newsSQL =             (Tools::getValue('news_compats', 0)) ? ' AND p.date_add > "' . date('Y-m-d', strtotime('-'.(Configuration::get('PS_NB_DAYS_NEW_PRODUCT') ? (int)Configuration::get('PS_NB_DAYS_NEW_PRODUCT') : 20).' DAY')).'" ' : '';
        $categorySQL =         (isset($multifilter_idCategory) && ( $multifilter_idCategory != 0 )) ? ' AND p.id_category_default = ' . $multifilter_idCategory . ' ' : '';
        $manufacturerSQL =     (isset($multifilter_idManufacturer) && ($multifilter_idManufacturer != 0 )) ? ' AND p.id_manufacturer = ' . $multifilter_idManufacturer . ' ' : '';

        // Retourne uniquement le nombre de produits
        if ($get_total) {
            $sql = 'SELECT COUNT(DISTINCT p.`id_product`) AS total
                    FROM `'._DB_PREFIX_.'ukoocompat_compat` uc
                    LEFT JOIN `'._DB_PREFIX_.'product` p
                        ON (p.`id_product` = uc.`id_product`)
                    '.Shop::addSqlAssociation('product', 'p').
                ($id_category != null ?
                    ' LEFT JOIN `'._DB_PREFIX_.'category_product` cp ON (p.`id_product` = cp.`id_product`)' : '');

            // on créé une jointure pour chaque filtre sélectionné
            foreach ($search->selected_criteria as $id_filter => $id_criterion) {
                // si l'id_criterion est vide, on saute la jointure
                if ($id_criterion !== '') {
                    $id_filter = (int)UkooCompatSearchFilter::getFilterIdFromSearchFilterId((int)$id_filter);
                    $prefix = 'ucc' . (int)$id_filter;
                    $sql .= ' INNER JOIN `' . _DB_PREFIX_ . 'ukoocompat_compat_criterion` ' . $prefix . '
                    ON (' . $prefix . '.`id_ukoocompat_compat` = uc.`id_ukoocompat_compat`
                        AND ' . $prefix . '.`id_ukoocompat_filter` = ' . (int)$id_filter . '
                        AND (
                            ' . $prefix . '.`id_ukoocompat_criterion` = ' . (int)$id_criterion . '
                            OR ' . $prefix . '.`id_ukoocompat_criterion` = 0
                        )
                    )';
                }
            }

            // suite et fin de la requête
            $sql .= '
                WHERE product_shop.`visibility` IN ("both", "catalog")'.

                $newsSQL .
                $categorySQL .
                // $manufacturerSQL .
                ($active ? ' AND product_shop.`active` = 1' : '').
                ($id_category != null && is_array($id_categories) && !empty($id_categories) ?
                    ' AND cp.`id_category` IN ('.pSQL(implode(', ', $id_categories)).')' :
                    ($id_category != null ? ' AND cp.`id_category` = '.(int)$id_category :
                        ''));

            return (int)Db::getInstance(_PS_USE_SQL_SLAVE_)->getValue($sql);
        }

        $sql = '
            SELECT p.*, product_shop.*, stock.out_of_stock, IFNULL(stock.quantity, 0) as quantity,
                MAX(product_attribute_shop.id_product_attribute) id_product_attribute,
                product_attribute_shop.minimal_quantity AS product_attribute_minimal_quantity, pl.`description`,
                pl.`description_short`, pl.`available_now`, pl.`available_later`, pl.`link_rewrite`,
                pl.`meta_description`, pl.`meta_keywords`, pl.`meta_title`, pl.`name`,
                MAX(image_shop.`id_image`) id_image, il.`legend`, m.`name` AS manufacturer_name,
                cl.`name` AS category_default, DATEDIFF(product_shop.`date_add`, DATE_SUB(NOW(),
                INTERVAL '.(Validate::isUnsignedInt(Configuration::get('PS_NB_DAYS_NEW_PRODUCT')) ?
                Configuration::get('PS_NB_DAYS_NEW_PRODUCT') : 20).'
                DAY)) > 0 AS new, product_shop.price AS orderprice
            FROM `'._DB_PREFIX_.'ukoocompat_compat` uc
            LEFT JOIN `'._DB_PREFIX_.'product` p
                ON (p.`id_product` = uc.`id_product`)
            '.Shop::addSqlAssociation('product', 'p').'
            LEFT JOIN `'._DB_PREFIX_.'product_attribute` pa
                ON (p.`id_product` = pa.`id_product`)
            '.Shop::addSqlAssociation('product_attribute', 'pa', false, 'product_attribute_shop.`default_on` = 1').'
            '.Product::sqlStock('p', 'product_attribute_shop', false, $context->shop).'
            LEFT JOIN `'._DB_PREFIX_.'category_lang` cl
                ON (product_shop.`id_category_default` = cl.`id_category`
                AND cl.`id_lang` = '.(int)$id_lang.Shop::addSqlRestrictionOnLang('cl').')
            LEFT JOIN `'._DB_PREFIX_.'product_lang` pl
                ON (p.`id_product` = pl.`id_product`
                AND pl.`id_lang` = '.(int)$id_lang.Shop::addSqlRestrictionOnLang('pl').')
            LEFT JOIN `'._DB_PREFIX_.'image` i
                ON (i.`id_product` = p.`id_product`)'.
            Shop::addSqlAssociation('image', 'i', false, 'image_shop.cover=1').'
            LEFT JOIN `'._DB_PREFIX_.'image_lang` il
                ON (image_shop.`id_image` = il.`id_image`
                AND il.`id_lang` = '.(int)$id_lang.')
            LEFT JOIN `'._DB_PREFIX_.'manufacturer` m
                ON m.`id_manufacturer` = p.`id_manufacturer`'.($id_category != null ? '
            LEFT JOIN `'._DB_PREFIX_.'category_product` cp
                ON (p.`id_product` = cp.`id_product`)' : '') . 
            'LEFT JOIN `'._DB_PREFIX_.'stock_available` sa
                ON (p.`id_product` = sa.`id_product`)';

        // on créé une jointure pour chaque filtre sélectionné
        foreach ($search->selected_criteria as $id_filter => $id_criterion) {
            // si l'id_criterion est vide, on saute la jointure
            if ($id_criterion !== '') {
                $id_filter = (int)UkooCompatSearchFilter::getFilterIdFromSearchFilterId((int)$id_filter);
                $prefix = 'ucc'.(int)$id_filter;
                $sql .= ' INNER JOIN `'._DB_PREFIX_.'ukoocompat_compat_criterion` '.$prefix.'
                ON ('.$prefix.'.`id_ukoocompat_compat` = uc.`id_ukoocompat_compat`
                    AND '.$prefix.'.`id_ukoocompat_filter` = '.(int)$id_filter.'
                    AND (
                        '.$prefix.'.`id_ukoocompat_criterion` = '.(int)$id_criterion.'
                        OR '.$prefix.'.`id_ukoocompat_criterion` = 0
                    )
                )';
            }
        }

        // suite et fin de la requête
        $sql .= '
            WHERE product_shop.`id_shop` = '.(int)$context->shop->id.'

            AND product_shop.`visibility` IN ("both", "catalog")'.
            ($active ? ' AND product_shop.`active` = 1' : '').
            ($id_category != null && is_array($id_categories) && !empty($id_categories) ?
                ' AND cp.`id_category` IN ('.pSQL(implode(', ', $id_categories)).')' :
                ($id_category != null ? ' AND cp.`id_category` = '.(int)$id_category :
                    '')).
            $newsSQL .
            $categorySQL .
            // $manufacturerSQL .
            ' GROUP BY product_shop.id_product';

        if ($random === true) {
            $sql .= ' ORDER BY p.`id_product` DESC LIMIT '.(int)$random_number_products;
        } else {
            $sql .= ' ORDER BY '.(!empty($order_by_prefix) ? $order_by_prefix.'.' : ' p.id_product ').'`'.bqSQL($order_by).'` '.
                pSQL($order_way).'
            LIMIT '.(((int)$p - 1) * (int)$n).','.(int)$n;
        }
        
        $result = Db::getInstance(_PS_USE_SQL_SLAVE_)->executeS($sql);
        if ($order_by == 'orderprice') {
            Tools::orderbyPrice($result, $order_way);
        }

        if (!$result) return array();

        return Product::getProductsProperties($id_lang, $result);
    }

    /**
     * TODO :: voir pour remplacer cette méthode
     * Retourne les catégories des produits compatibles
     * Basé sur la fonction Category::getProducts()
     * @param $search
     * @param null $id_category
     * @param bool $active
     * @param Context $context
     * @return array
     */
    public static function getCompatiblesProductsCategories(
        $search,
        $id_category = null,
        $active = true,
        Context $context = null
    ) {

        if (!$context) {
            $context = Context::getContext();
        }

        if (!Validate::isBool($active)) {
            die (Tools::displayError());
        }

        $id_supplier = (int)Tools::getValue('id_supplier');
        $sql = '
            SELECT DISTINCT cp.id_category
            FROM `'._DB_PREFIX_.'ukoocompat_compat` uc
            LEFT JOIN `'._DB_PREFIX_.'product` p
                ON (p.`id_product` = uc.`id_product`)
            LEFT JOIN `'._DB_PREFIX_.'category_product` cp
                ON (p.`id_product` = cp.`id_product`)
            '.Shop::addSqlAssociation('product', 'p');

        // on créé une jointure pour chaque filtre sélectionné
        foreach ($search->selected_criteria as $id_filter => $id_criterion) {
            // si l'id_criterion est vide, on saute la jointure
            if ($id_criterion !== '') {
                $id_filter = (int)UkooCompatSearchFilter::getFilterIdFromSearchFilterId((int)$id_filter);
                $prefix = 'ucc'.(int)$id_filter;
                $sql .= ' INNER JOIN `'._DB_PREFIX_.'ukoocompat_compat_criterion` '.$prefix.'
                ON ('.$prefix.'.`id_ukoocompat_compat` = uc.`id_ukoocompat_compat`
                    AND '.$prefix.'.`id_ukoocompat_filter` = '.(int)$id_filter.'
                    AND (
                        '.$prefix.'.`id_ukoocompat_criterion` = '.(int)$id_criterion.'
                        OR '.$prefix.'.`id_ukoocompat_criterion` = 0
                    )
                )';
            }
        }

        // suite et fin de la requête
        $sql .= '
            WHERE product_shop.`id_shop` = '.(int)$context->shop->id.'
            AND product_shop.`visibility` IN ("both", "catalog")'.
            ($active ? ' AND product_shop.`active` = 1' : '').
            ($id_supplier ? ' AND p.id_supplier = '.(int)$id_supplier : '').
            ($id_category != null ? ' AND cp.`id_category` = '.(int)$id_category : '')
            
            
        ;

        $result = Db::getInstance(_PS_USE_SQL_SLAVE_)->executeS($sql);
        $ids_categories = array();
        foreach ($result as $cat) {
            $ids_categories[] = (int)$cat['id_category'];
        }

        if (!$ids_categories) {
            return array();
        }

        return $ids_categories;
    }

    /**
     * Fonction pour associer les valeurs aux tags
     * @param $selected_criteria
     * @param $id_lang
     * @return array
     */
    public static function getTags($selected_criteria, $id_lang)
    {
        $tags = array();
        foreach ($selected_criteria as $id_filter => $id_criterion) {
            $id_filter = UkooCompatSearchFilter::getFilterIdFromSearchFilterId((int)$id_filter);
            $sql = '
				SELECT ucl.`value` 
				FROM `'._DB_PREFIX_.'ukoocompat_criterion_lang` ucl
				WHERE `id_ukoocompat_criterion` = '.(int)$id_criterion.'
				AND `id_lang` = '.(int)$id_lang;
            $tags['{FILTER:'.(int)$id_filter.'}'] = Db::getInstance(_PS_USE_SQL_SLAVE_)->getValue($sql);
        }
        return $tags;
    }

    /**
     * Retourne la liste des compatibilités d'un produit pour une recherche spécifique (affichage front)
     * @param $id_product
     * @param $search
     * @param null $id_lang
     * @return mixed
     */
    public static function getProductsCompatibilitiesFromSearch($id_product, $search, $id_lang = null)
    {
        $sql = 'SELECT uc.`id_ukoocompat_compat`';

        if (!empty($search)) {
            $sql .= ', ';
        }

        $i = 1;
        $tmp = array();
        foreach ($search->filters as $filter) {
            if($filter->id_ukoocompat_filter < 5){

            $tmp[] = 'CASE WHEN ucl'.(int)$i.'.`value` IS NULL THEN "*"
                ELSE ucl'.(int)$i.'.`value` END AS "filter_'.(int)$filter->id_ukoocompat_filter.'"';
            $i++;
            }
        }

        $sql .= (implode(', ', $tmp)).' FROM `'._DB_PREFIX_.'ukoocompat_compat` uc';

        $i = 1;
        foreach ($search->filters as $filter) {
            
            if($filter->id_ukoocompat_filter < 5){
            $sql .= '
				INNER JOIN `'._DB_PREFIX_.'ukoocompat_compat_criterion` ucc'.(int)$i.'
					ON (uc.`id_ukoocompat_compat` = ucc'.(int)$i.'.`id_ukoocompat_compat`
					    AND ucc'.(int)$i.'.`id_ukoocompat_filter` = '.(int)$filter->id_ukoocompat_filter.')
				LEFT JOIN `'._DB_PREFIX_.'ukoocompat_criterion_lang` ucl'.(int)$i.'
					ON (ucl'.(int)$i.'.`id_ukoocompat_criterion` = ucc'.(int)$i.'.`id_ukoocompat_criterion`
					    AND ucl'.(int)$i.'.`id_lang` = '.(int)$id_lang.')';
            $i++;
            }
        }
        $sql .= ' WHERE uc.`id_product` = '.(int)$id_product.'';
        // echo $sql;
        // exit;
        return Db::getInstance(_PS_USE_SQL_SLAVE_)->executeS($sql);
    }

    /**
     * Récupère la liste récursive des ID de catégories à partir d'une catégorie parente donnée
     * Restreint les résultats aux catégories sélectionnées dans la recherche donnée
     * @param $id_category
     * @param array $ids_subcategories
     * @return array
     */
    public static function getAllSubcategoriesIds(
        $id_category,
        $ids_subcategories = array()
    ) {
        $sql = 'SELECT `id_category` 
        FROM `'._DB_PREFIX_.'category`
        WHERE `id_parent` = '.(int)$id_category;

        $results = Db::getInstance(_PS_USE_SQL_SLAVE_)->executeS($sql);

        $array_tmp = array();
        foreach ($results as $result) {
            $array_tmp[] = (int)$result['id_category'];
        }

        if (is_array($results) && !empty($results)) {
            foreach ($results as $result) {
                $ids_subcategories = array_unique(
                    array_merge(
                        array((int)$id_category),
                        $ids_subcategories,
                        $array_tmp,
                        UkooCompatCompat::getAllSubcategoriesIds(
                            (int)$result['id_category'],
                            $ids_subcategories
                        )
                    )
                );
            }
        } else {
            $ids_subcategories = array_unique(
                array_merge(
                    array((int)$id_category),
                    $ids_subcategories,
                    $array_tmp
                )
            );
        }

        return $ids_subcategories;
    }
}
