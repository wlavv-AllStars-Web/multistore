<?php
/**
 * Recherche de produits par compatibilité
 *
 * @author    Guillaume Heid - Ukoo <modules@ukoo.fr>
 * @copyright Ukoo 2015 - 2016
 * @license   Ukoo - Tous droits réservés
 *
 * "In Ukoo we trust!"
 *
 * v4.5.0 - changelog (2016-10-14)
 *      [*] Fix : Correction d'échappements Smarty
 *      [/] Le module affiche directement la vue "liste" lors d'une recherche depuis une page de catégorie
 *      [+] Ajout d'une option pour afficher les produits des sous-catégories dans la vue "liste" lors d'une recherche
 *      [+] Ajout du champ "display_subcategories_products" dans la table "ukoocompat_search" pour gérer la
 *          nouvelle option
 *
 * v4.4.1 - changelog (2016-09-08)
 *      [*] Fix : On vérifie la configuration du module, et ajoute (/c/.../all/) aux URL du sitemap si nécessaire
 *
 * v4.4.0 - changelog (2016-08-15)
 *      [*] Fix : Test de l'existance d'une compatibilité avant sa création via le formulaire en BO
 *      [+] Possibilité d'associer plusieurs produits aux mêmes critères depuis le formulaire de création de
 *          compatibilités du BO.
 *
 * v4.3.2 - changelog (2016-08-04)
 *      [*] Fix : Test de la soumission et de la validité d'un fichier d'import et message d'erreur le cas échéant
 *      [*] Fix : Correction de l'affichage d'un aperçu d'image lors d'une erreur de création d'alias
 *      [*] Fix : Corrections dans la génération ajax des fichiers de sitemap
 *      [+] Suppression des fichiers de sitemap générés lors de la désinstallation du module
 *
 * v4.3.1 - changelog (2016-06-02)
 *      [*] Fix : Correction du lien du pathway vers la vue catalogue
 *      [*] Fix : Correction "Fatal error: Call to a member function updatePosition() on boolean"
 *      [*] Fix : Corrections et ajouts de traductions manquantes pour les messages d'erreurs
 *
 * v4.3.0 - changelog (2016-05-06)
 *      [*] Fix : Utilisation de la fonction "Hook::getIdByName()" au lieu des IDs des hooks en dur (plus souple)
 *      [*] Fix : la modification d'un critère entraînait l'affichage d'une erreur de token
 *      [*] Fix : les filtres de recherche désactivés s'affichaient quand même en front
 *      [*] Fix : la réorganisation des critères posaient problème
 *      [*] Fix : les shortcodes {FILTER:X} ne fonctionnaient pas si leur id_ukoocompat_search_filter était différents
 *      [*] Fix : corrections de traductions manquantes ou modifiées
 *      [+] Les journaux d'import sont à présent enregistrés dans le dossier /logs et dernier journal est accessible
 *          à partir de la liste des fichiers d'import.
 *      [+] Création d'une variable de configuration "UKOOCOMPAT_SECUREKEY" pour sécuriser les appels CRON
 *      [+] Ajout de la génération des sitemaps par recherche (liens vers les pages "catalog" uniquement
 *
 * v4.2.0 - changelog (2016-04-27)
 *      [*] Fix : la pagination ne fonctionnait pas correctement sur les pages de résultats en liste
 *      [*] Fix : correction de la redirection canonique combinée à la pagination et aux tries
 *      [*] Fix : les associations de catégories ne se supprimaient pas lors de la suppression d'une recherche
 *      [*] Fix : les filtres de recherche et les groupes ne se supprimaient pas lors de la suppression d'une recherche
 *      [*] Fix : les recherches ne fonctionnaient plus lors du changement d'ID de filtres de recherche
 *      [*] Fix : les recherches dynamiques avec un seul filtre ne fonctionnaient pas
 *      [*] Fix : certains filtres apparaissaient à la fois disponibles et utilsés lorsque plusieurs recherches
 *          étaient configurées
 *      [*] Fix : petit ajustement de positionnement du loader dans le fichier JS du module
 *      [*] Fix : 404 lors d'un recherche par alias (suite aux modif pour les ids de filtres de recherche)
 *      [*] Fix : Utilisation de PS_HOME_CATEGORY pour la génération de l'arbre des catégories dans les recherches
 *      [*] Fix : Modification du test d'existence de l'image d'alias dans les fichier listing.tpl et catalog.tpl
 *      [+] Une option de suppression des anciennes données est disponible lors de l'import (case à cocher)
 *      [+] Les règles de réécritures ont été améliorées. Elles sont à présent dynamiques et s'adaptent aux
 *          différentes recherches
 *      [/] Le dossier /img a été déplacé dans /views
 *
 * v4.1.1 - changelog (2016-03-30)
 *      [*] Fix produits "universels" : les champs de recherche affichaient tous les critères
 *      [*] Fix affichage : le module affichait toujours "Il y a 1 produit"
 *      [*] Fix positions : les critères ne pouvaient pas être re-positionnés en BO
 *      [*] Fix affichage : les lignes des compat étaient doublées lorsqu'il exitait plusieurs boutiques
 *      [/] La valeur d'un critère est dorénavant vérifiée par la règle de validation "isAnything" au lieu de
 *          "isGenericName"
 *      [/] La variable de réécriture "ModuleRoutes" prend en charge jusqu'à 5 filtres au lieu des 4 jusqu'à
 *          présent
 *
 * v4.1.0 - changelog (2016-01-14)
 *      [*] Compatibilité pour PS 1.6.0.14 - 1.6.1.4
 *      [/] Le filtrage des compatibilités en BO a été remis en place et ajusté
 *      [/] Nouvel icone de module. Format adapté pour PS 1.6.1.3 et plus (57x57px)
 *      [/] Le terme "Alias instance" a été remplacé par "Correspondance d'alias" pour plus de clarté
 *      [/] Le tri par valeur tiens désormais compte des valeurs alphanumériques (ex. : 1 < 2 < 11 < 1010)
 *      [/] Le système de CacheUkoo a été remplacé par le système de cache natif PrestaShop
 *      [/] Les templates "catalog" et "listing" ont été revus
 *      [/] Les listes de sélection précédentes conservent les autres options disponibles pour simplifier le
 *          changement de sélection
 *      [/] La vue "catalog" a été scindé en deux templates
 *      [+] Ajout des champs "image" et "link" dans la table des alias
 *      [+] Les alias peuvent désormais être enrichis d'une image, d'un lien et d'une pièce jointe
 *      [+] Les dossiers "/img" et "/pdf" ont été créés à la racine du module
 *      [+] La méthode getCategoryMaxDepth() permet dorénavant de récupérer dynamiquement le niveau de catégorie le
 *          plus profond pour la vue "catalog"
 *      [-] La méthode getCatalog() à été supprimée. Elle est remplacée par hookDisplayUkooCompatCatalogTree() qui
 *          permet une gestion de cache
 *
 * v4.0.1 - changelog (2015-07-24)
 *      [/] Corrections pour le respect des standards PrestaShop (validator.prestashop.com) et de la norme PSR-2
 *      [/] Modification d'un ID ne respectant pas les standards HTML
 *      [/] Modification du nom de l'attribut "separator" de l'objet ImportFile car c'était un mot-clé MySQL.
 *      [/] L'option "Créer et associer les nouveaux alias" n'est plus active par défaut
 *      [/] Les dossier /css et /js ont été déplacés de la racine du module au dossier /views (nouvelle norme)
 *      [+] Ajout d'un répertoire /upgrade pour l'automatisation des MAJ de la BDD
 *      [+] Le bloc de recherche peut à présent se greffer dans les positions Top et Footer
 *      [+] Utilisation de _PS_USE_SQL_SLAVE_ dans les requêtes de type SELECT
 *      [+] La variable "page_name" est à présent définie lors du rechargement AJAX des filtres
 *      [-] Suppression du point virgule en fin de ligne dans le fichier CSV d'export des compatibilités
 *
 *  v4.0 - changelog (2015-08-12)
 *      [*] Compatibilité pour PS 1.6.0.14 - 1.6.1.0
 *      [/] Modifications majeures dans l'ensemble du module
 *      [/] La configuration du module est abandonné. Chaque recherche peut à présent être configurée
 *          indépendamment des autres
 *      [+] Utilisations des Kpis
 *      [+] Possibilité de créer plusieurs instances de recherches et blocs de recherche
 *      [+] Possibilités de gérer les filtres et les critères indépendamment des blocs de recherche
 *      [+] Gestionnaire de fichiers d'imports
 *      [+] Gestionnaire d'alias et d'instances d'alias
 *      [+] Système de cache fichier des résultats des requêtes SQL
 *
 *  v3.2 - changelog (2014-07-28)
 *      [*] Compatibilité jusqu'à PS 1.6.0.8
 *      [/] Diverses modifications pour modifier la structure du module en fonction de la version de PrestaShop
 *          utilisée
 *      [+] Ajout d'une feuille de styles alternative pour PS1.6
 *
 *  v3.1 - changelog (2014-04-10)
 *      [*] Correction d'un bug dans le fichier listing.tpl
 *      [*] Correction d'un bug lors de la création de filtres multi-lingue
 *      [*] Correction d'un bug dans le fichier ajax.php
 *      [*] Correction d'un bug dans le fichier back-button.tpl
 *      [/] Modifications de l'interface admin
 *      [/] Modifications du CSS front-office (fichier ukoo_compat.css)
 *      [/] Déplacement du fichier ajax.php dans le dossier /models
 *      [/] Suppression du fichier export.php et intégration de la fonction d'export dans la class admin
 *      [/] Déplacement du fichier d'exemple dans le nouveau dossier /doc
 *      [/] Mise à jour de la librairie jQuery UI (1.10.4)
 *      [/] L'overlay et l'icone de chargement ne s'affiche plus lors de la sélection de la dernière liste de
 *          sélection
 *      [+] Ajout de liens vers la documentation du module
 *      [+] Ajout de la gestion des produits universels
 *      [+] Ajout de la gestion des groupes (tables ukoo_compat_group_X et nouveaux index)
 *      [+] Conservation des fichiers d'import/export et affichage de la liste de ces fichiers
 *      [+] A présent le cache se vide automatiquement à chaque modification de compatibilités (import, création,
 *          suppression...)
 *      [-] Simplification des fichiers de templates
 *
 *  v3.0 - changelog (2014-02-12)
 *      [*] Compatibilité jusqu'à PS 1.5.6.2
 *      [*] Correction d'un bug dans le fichier catalog.tpl
 *      [*] Appel au fichier /css/product-list.css à partir de PS 1.5.6
 *      [*] Correction d'un bug d'url de pagination lorsque la ré-écriture du module est active
 *      [/] Modifications dans le checkversion
 *      [/] Modifications dans le CSS
 *      [/] Modification de la profondeur des catégories parcouruent par le module
 *      [/] Modification de la fonction _getProducts() : basée sur les modifs dues à PS1.5.6
 *      [/] Au dessus de 500, les critères ne sont plus affichés en BO pour éviter de planter jQuery et
 *          les chargements de page trop longs
 *      [/] Les filtres sont rendus non-réorganisable pour éviter divers bugs (rewriting, import/export etc.)
 *      [+] Possibilité de choisir le système de trie des listes de sélection (AZ, ZA, position, ASC et DESC)
 *      [+] Possibilité de choisir de "sauter" la page catalogue et d'afficher directement le listing des produits
 *      [+] Possibilité de lancer la recherche directement après avoir choisi le dernier critère (pas de bouton)
 *      [+] Ajout d'un onglet "Compatibilités" dans la fiche produit en back-office
 *      [+] Compatible multi-boutiques (bêta)
 *      [+] Ajout d'un message d'avertissement si aucune catégories n'est sélectionnée dans la configuration
 *          du module
 *
 *  v2.2.0 - changelog
 *      [*] Compatibilité jusqu'à PS 1.5.5.0
 *      [*] Corrections de bugs mineurs, Warnings et Notices PHP
 *      [*] Au dessus de 50, les critères ne sont plus affichés en BO pour éviter de planter jQuery
 *      [/] Amélioration de la gestion des erreurs
 *      [/] Refactoring partiel pour se rapprocher du système MVC
 *      [/] On ne soumet plus l'ajout d'une compatibilité avec la touche entrer du clavier (jquery preventDefault)
 *          en BO
 *      [/] Modification majeure du template de listing (utilisation des TPL du thème courant)
 *      [/] Amélioration du CSS et du JS
 *      [/] Modifications majeures dans le système de ré-écriture des urls
 *      [/] Les critères au delà du premier filtre ne sont plus chargés dès le départ en front pour économiser
 *          du temps de chargement
 *      [/] Optimisation de requêtes lentes en BO et FO
 *      [+] Ajout d'index dans les tables du module, amélioration du temps d'execution des requêtes de recherche
 *      [+] Le comparateur natif peut être utilisé sur les résultats du module
 *      [+] Amélioration des traductions
 *      [+] Utilisation de l'objet Context
 *
 *  v2.1.0 - changelog
 *      [*] Fix pagination p=1 lorsque réécriture activée
 *      [+] Ajout de la génération d'un sitemap.xml
 *      [+] Génération du sitemap via CRON
 *      [/] Correction de Notices PHP
 *
 *  v2.0.3 - changelog
 *      [+] Message de confirmation lors de la ré-organisation des filtres et critères
 *      [/] Corrections d'erreurs php
 *
 *  v2.0.2 - changelog
 *      [*] Fix champs link_rewrite dans les tables en utilisant la méthode d'origine de PS
 *      [*] Fix non affichage de la listes des produits compatibles en BO lorsque la recherche ne retournait aucun
 *          résultat
 *      [*] Fix erreur lors de la recherche sur aucun critère
 *      [/] Refactoring partiel et nettoyage du code source
 *      [/] Modification des paramètres d'affichage dans le BO
 *      [/] Mise à jour de la librairie jQuery UI (1.8.19)
 *      [/] Optimisation de requêtes SQL
 *      [/] Mises à jour mineures des CSS
 *      [+] Rajout du fichier index.php à la racine
 *      [+] Rajout du paramètre d'affichage du module par catégorie
 *      [+] Gestion des langues pour les paramètres SEO (metas, title etc.)
 *      [-] Suppression du fichier index.html à la racine
 *      [-] Suppression des champs "nom" dans les tables compat_critere et compat_filtre
 */

if (!defined('_PS_VERSION_')) {
    exit;
}
require_once dirname(__FILE__).'/classes/UkooCompatCompat.php';
require_once dirname(__FILE__).'/classes/UkooCompatSearch.php';
require_once dirname(__FILE__).'/classes/UkooCompatSearchFilter.php';
require_once dirname(__FILE__).'/classes/UkooCompatFilter.php';
require_once dirname(__FILE__).'/classes/UkooCompatCriterion.php';
require_once dirname(__FILE__).'/classes/UkooCompatGroup.php';
require_once dirname(__FILE__).'/classes/UkooCompatImportFile.php';
require_once dirname(__FILE__).'/classes/UkooCompatAlias.php';
require_once dirname(__FILE__).'/classes/UkooCompatAliasInstance.php';
require_once dirname(__FILE__).'/controllers/admin/AdminUkooCompatCompatController.php';
require_once dirname(__FILE__).'/controllers/admin/AdminUkooCompatSearchController.php';
require_once dirname(__FILE__).'/controllers/admin/AdminUkooCompatSearchFilterController.php';
require_once dirname(__FILE__).'/controllers/admin/AdminUkooCompatFilterController.php';
require_once dirname(__FILE__).'/controllers/admin/AdminUkooCompatCriterionController.php';
require_once dirname(__FILE__).'/controllers/admin/AdminUkooCompatGroupController.php';
require_once dirname(__FILE__).'/controllers/admin/AdminUkooCompatImportFileController.php';
require_once dirname(__FILE__).'/controllers/admin/AdminUkooCompatAliasController.php';
require_once dirname(__FILE__).'/controllers/admin/AdminUkooCompatAliasInstanceController.php';

class UkooCompat extends Module
{
    public $allowed_hooks;
    public $display_type;
    public $order_by;
    public $order_way;
    public $link_to_product;
    public $import_status;

    public function __construct()
    {
        $this->name = 'ukoocompat';
        $this->tab = 'front_office_features';
        $this->version = '4.5.0';
        $this->author = 'Ukoo';
        //$this->author_uri = 'http://www.ukoo.fr/';
        $this->module_key = '57adef10a092a9d74538640b645db7de';
        $this->need_instance = 0;
        $this->bootstrap = true;
        $this->ps_versions_compliancy = [
            'min' => '1.7.0.0',
            'max' => '8.99.99',
        ];
        $this->context = Context::getContext();
        parent::__construct();

        $this->displayName = $this->trans('Search products by compatibility');
        $this->description = $this->trans('Allow your customers to find your products compatible with their.');
        $this->confirmUninstall = $this->trans('Are you sure you want to delete your details?');

        // Défini les hooks sur lesquels le bloc de recherche peut être accroché
        $this->allowed_hooks = array(
            1 => array(
                'id' => (int)Hook::getIdByName('displayRightColumn'),
                'name' => $this->trans('Right Column').' (displayRightColumn)'),
            2 => array(
                'id' => (int)Hook::getIdByName('displayLeftColumn'),
                'name' => $this->trans('Left Column').' (displayLeftColumn)'),
            3 => array(
                'id' => (int)Hook::getIdByName('displayHome'),
                'name' => $this->trans('Homepage').' (displayHome)'),
            4 => array(
                'id' => (int)Hook::getIdByName('displayTop'),
                'name' => $this->trans('Top of page').' (displayTop)'),
            5 => array(
                'id' => (int)Hook::getIdByName('displayFooter'),
                'name' => $this->trans('Footer').' (displayFooter)'),
            6 => array(
                'id' => (int)Hook::getIdByName('displayTopColumn'),
                'name' => $this->trans('Top Column').' (displayTopColumn)'));

        // Défini les types d'affichage possibles pour les filtres des blocs de recherche
        // TODO :: finaliser checkbox
        $this->display_type = array(
            1 => array(
                'id' => 'select',
                'name' => $this->trans('Select-list')),
            //			2 => array(
            //				'id' => 'checkbox',
            //				'name' => $this->l('Checkbox')
            //			),
            3 => array(
                'id' => 'radio',
                'name' => $this->trans('Radio')));

        // Défini les types de trie possible pour les critères des filtres
        $this->order_by = array(
            1 => array(
                'id' => 'position',
                'name' => $this->trans('Position')),
            2 => array(
                'id' => 'value',
                'name' => $this->trans('Value')),
            3 => array(
                'id' => 'id',
                'name' => $this->trans('ID')));

        // Défini les sens de trie possible pour les critères des filtres
        $this->order_way = array(
            1 => array(
                'id' => 'ASC',
                'name' => $this->trans('Ascending (A-Z)')),
            2 => array(
                'id' => 'DESC',
                'name' => $this->trans('Descending (Z-A)')));

        // Défini les méthodes d'associations des produits pour les imports
        $this->link_to_product = array(
            1 => array(
                'id' => 'id_product',
                'name' => $this->trans('Product ID')),
            2 => array(
                'id' => 'reference',
                'name' => $this->trans('Product reference')),
            3 => array(
                'id' => 'supplier_reference',
                'name' => $this->trans('Supplier reference')),
            4 => array(
                'id' => 'ean13',
                'name' => $this->trans('EAN13')),
            5 => array(
                'id' => 'upc',
                'name' => $this->trans('UPC')));

        // Défini les différents statuts des imports
        // TODO :: les rendres plus utiles car peu d'intérêt pour le moment
        $this->import_status = array(
            0 => array(
                'id' => '0',
                'name' => $this->l('Upload error'),
                'label_color' => '#DC143C',
                'text_color' => '#ffffff',),
            1 => array(
                'id' => '1',
                'name' => $this->l('Uploaded'),
                'label_color' => '#EAEDEF',
                'text_color' => '#666666'),
            2 => array(
                'id' => '2',
                'name' => $this->l('Ready to import'),
                'label_color' => '#108510',
                'text_color' => '#ffffff'));
    }

    /**
     * Fonction d'installation du module
     * Lance la création des tables, l'enregistrement sur les hooks
     * @return bool
     */
    public function install()
    {
        if (!parent::install()
            || !UkooCompatCompat::createDbTable()
            || !UkooCompatSearch::createDbTable()
            || !UkooCompatSearchFilter::createDbTable()
            || !UkooCompatFilter::createDbTable()
            || !UkooCompatCriterion::createDbTable()
            || !UkooCompatGroup::createDbTable()
            || !UkooCompatImportFile::createDbTable()
            || !UkooCompatAlias::createDbTable()
            || !UkooCompatAliasInstance::createDbTable()
            || !AdminUkooCompatCompatController::installInBO()
            || !$this->registerHook('displayBackOfficeHeader')
            || !$this->registerHook('displayHeader')
            || !$this->registerHook('displayFooter')
            || !$this->registerHook('displayTop')
            || !$this->registerHook('displayTopColumn')
            || !$this->registerHook('displayLeftColumn')
            || !$this->registerHook('displayRightColumn')
            || !$this->registerHook('displayHome')
            // plus utile avec le nouveau thème natif de PrestaShop
            //|| !$this->registerHook('displayProductTab')
            || !$this->registerHook('displayProductTabContent')
            || !$this->registerHook('displayAdminProductsExtra')
            // affiche le bloc de recherche sur les pages propres au module
            || !$this->registerHook('displayUkooCompatBlock')
            // affiche l'arborescence de la page catalogue (permet la mise en cache)
            || !$this->registerHook('displayUkooCompatCatalogTree')
            || !$this->registerHook('actionProductUpdate')
            || !$this->registerHook('actionProductDelete')
            || !$this->registerHook('moduleRoutes')
			|| !$this->registerHook('displayCompat')
            // Création d'une variable de configuration "secure_key" pour sécuriser les appels CRON
            || !Configuration::updateValue('UKOOCOMPAT_SECUREKEY', Tools::strtoupper(Tools::passwdGen(16)))
        ) {
            return false;
        }

        return true;
    }

    /**
     * Fonction de désinstallation du module
     * Supprime les tables créées lors de l'installation
     * La suppression des hooks est automatique (voir classe parente)
     * @return bool
     */
    public function uninstall()
    {
        if (!parent::uninstall()
            || !UkooCompatCompat::removeDbTable()
            || !UkooCompatSearch::removeDbTable()
            || !UkooCompatSearchFilter::removeDbTable()
            || !UkooCompatFilter::removeDbTable()
            || !UkooCompatCriterion::removeDbTable()
            || !UkooCompatGroup::removeDbTable()
            || !UkooCompatImportFile::removeDbTable()
            || !UkooCompatAlias::removeDbTable()
            || !UkooCompatAliasInstance::removeDbTable()
            || !AdminUkooCompatCompatController::removeFromBO()
            || !Configuration::deleteByName('UKOOCOMPAT_SECUREKEY')
        ) {
            return false;
        }

        // On supprime tous les sitemap associés au module
        array_map('unlink', glob(dirname(__FILE__).'/../sitemap/sitemap_*.xml'));

        return true;
    }

	/*webmaster hook display compat para nova posicao das compatibilidades*/
	 public function hookDisplayCompat($params) {
	   // On récupère les infos des filtres, puis on lance le rendu pour chacune des recherches
        $output = '';
        //echo '<pre>' . print_r($this->context->cookie, 1) . '</pre>';
        
        $search = new UkooCompatSearch(1, (int) $this->context->language->id);
        $search->current_id_lang = (int) $this->context->language->id;
        $search->filters = $search->getFilters((int) $this->context->language->id);

        // On assigne les critères sélectionnés à la recherche (pré-remplissage des valeurs saisies)
        $search->selected_criteria = unserialize($this->context->cookie->__get('ukoocompat_search_' . (int) $search->id));
        
        //echo '<pre>' . print_r($search->selected_criteria, 1) . '</pre>';
        
        $search->selected_criteria[4] = (strlen($search->selected_criteria[4]) < 1) ? Tools::getValue('filter4') : $search->selected_criteria[4];

        //echo '<pre>' . print_r($search->selected_criteria[4], 1) . '</pre>';
        //exit;
        
        // Si les cookies sont vides (première visite),
        // on initialise un tableau vide (pour empêcher l'affichage de warning)
        if (!$search->selected_criteria)
        {
            $search->selected_criteria = array();
        }

        $id_cache = array(
            's' . (int) $search->id,
        );

        // On modifie la structure du tableau des filtres (pour la réécriture)
        $params = array('id_search' => $search->id);
        foreach ($search->selected_criteria as $id => $value)
        {
            $params['filters' . (int) $id] = (int) $value;
            $id_cache[] = 'f' . (int) $id . 'c' . (int) $value;
        }

        $id_cache[] = 'wmsearchblocktopmenu';
        $id_cache = '|' . implode('|', $id_cache);
        $id_cache = $this->getCacheId('ukoocompat' . $id_cache);

        if (!$this->isCached('wm-search-block-topmenu.tpl', $id_cache))
        {
            // On récupère les critères pour chaque filtre
            foreach ($search->filters as $k => $filter)
            {
                // si le critères est déjà sélectionné, on ne charge pas l'ensemble des filtres
                if ($search->dynamic_criteria && array_key_exists((int) $filter->id, $search->selected_criteria)
                )
                {
                    $filter->criteria = $filter->getCriteria((int) $search->selected_criteria[(int) $filter->id]);
                    $filter->disabled = false;
                }
                elseif ($search->dynamic_criteria)
                {
                    // si le critères n'est pas sélectionné mais qu'on est en critères dynamiques, inutile de requêter

                    $filter->criteria = array(
                        0 => array(
                            'id' => '',
                            'id_ukoocompat_filter' => (int) $filter->id_ukoocompat_filter,
                            'value' => '--'));
                    if ($k != 0)
                    {
                        $filter->disabled = true;
                    }
                    else
                    {
                        $filter->disabled = false;
                    }
                }
                else
                {
                    // les critères dynamiques sont désactivés et que le critères n'est pas sélectionné
                    $filter->criteria = $filter->getCriteria();
                    $filter->disabled = false;
                }
            }
            // On détermine si la page à afficher sera la vue liste ou catalogue
            $search->controller = 'catalog';
            if ($search->skip_catalog)
            {
                $search->controller = 'listing';
            }
            // On affiche le reset ou pas ?
            $display_reset = false;
            if (is_array($search->selected_criteria))
            {
                foreach ($search->selected_criteria as $id_criterion)
                {
                    if ($id_criterion != '')
                    {
                        $display_reset = true;
                    }
                }
            }
            $this->context->smarty->assign(array(
                'is_rewrite_active' => (bool) Configuration::get('PS_REWRITING_SETTINGS'),
                'display_reset' => $display_reset,
                'search' => $search,
                'form_action' =>
                $this->context->link->getModuleLink('ukoocompat', $search->controller, $params),
                'catalog_link' => $this->context->link->getModuleLink('ukoocompat', 'catalog', $params),
                'listing_link' => $this->context->link->getModuleLink('ukoocompat', 'listing', $params),
                'alias_link' => $this->context->link->getModuleLink('ukoocompat', 'alias')));
        }

	    if( Context::getContext()->isMobile() ){
		    $output .= $this->display(__FILE__, 'wm-search-block-topmenu.tpl' , $id_cache);
	    }else{
            $output .= $this->display(__FILE__, 'wm-search-block-home-topmenu.tpl' , $id_cache);
	    }
			    

        return $output;
	 }

    /**
     * Charge le CSS du module spécifique à l'admin
     * Permet d'afficher un icon dans le menu latéral et quelques autres petits correctifs
     */
    public function hookDisplayBackOfficeHeader()
    {
        $this->context->controller->addCSS($this->_path.'views/css/admin.css');
    }

    /**
     * Exécution du hookHeader
     * Redirection d'une recherche par Alias vers l'URL de la recherche
     * Redirection vers l'URL canonique si nécessaire
     * Enregistrement de la recherche pour la conserver durant la navigation
     * Assignation des CSS et JS du module
     */
    public function hookDisplayHeader()
    {
        // Si on trouve une variable de recherche dans l'URL et un ID de recherche
        if (UkooCompat::isSubmitUrlFilters() && Tools::isSubmit('id_search')) {
            // on instancie la recherche
            $search = new ukooCompatSearch((int)Tools::getValue('id_search'), (int)$this->context->language->id);

            // On récupère les variables de recherche (filtres et valeurs)
            $filters = UkooCompat::getUrlFilters();

            // On récupère les autres variables comme la pagination ou le trie
            $others_vars = UkooCompat::getUrlParameters();
            // On enregistre la recherche dans les cookies pour la conserver lors de la navigation
            $this->context->cookie->__set('ukoocompat_search_'.(int)$search->id, serialize($filters));

            // Si la réécriture est active...
            if (Configuration::get('PS_REWRITING_SETTINGS')) {
                // On récupère l'URL canonique (réécrite)
                $canonical_url = UkooCompat::getCanonicalUrl(
                    (int)$this->context->language->id,
                    (int)Tools::getValue('id_search'),
                    (Tools::isSubmit('id_category') ?
                        (int)Tools::getValue('id_category') : ($search->skip_catalog ? 'all' : null)),
                    $filters,
                    $others_vars
                );
                $match_url = (rawurldecode($_SERVER['REQUEST_URI']));

                // Si l'url est différente de l'url Canonique, alors on l'y redirige en 301 (vu avec ukoo_kevin)
                if (__PS_BASE_URI__.$canonical_url != $match_url) {
                    Tools::redirect(
                        _PS_BASE_URL_.__PS_BASE_URI__.$canonical_url,
                        __PS_BASE_URI__,
                        null,
                        array(
                            'HTTP/1.0 301 Moved',
                            'Cache-Control: no-cache')
                    );
                    exit;
                }
            }
        } elseif (Tools::isSubmit('id_search')
            && Tools::isSubmit('id_alias_instance')
            && Tools::isSubmit('module')
            && Tools::isSubmit('controller')
            && Tools::getValue('module') == 'ukoocompat'
        ) {
            // La recherche a été soumise à partir d'un alias
            // On récupère les filtres associés...
            $filters = UkooCompatAliasInstance::getFiltersByAliasInstance(
                (int)Tools::getValue('id_alias_instance'),
                (int)Tools::getValue('id_search')
            );

            $params = array(
                'id_search' => (int)Tools::getValue('id_search'),
                'id_lang' => (int)$this->context->language->id,
                'ukoocompat_search_submit' => '');

            foreach ($filters as $id_filter => $id_criterion) {
                $params['filters'.(int)$id_filter] = (int)$id_criterion;
            }

            // On redirige la page pour avoir la bonne URL (301, vu avec ukoo_kevin)
            header('HTTP/1.0 301 Moved');
            header('Cache-Control: no-cache');
            Tools::redirectLink(
                $this->context->link->getModuleLink('ukoocompat', Tools::getValue('controller'), $params)
            );
            exit;
        }

        // Assignation des CSS et JS du module
        $this->context->controller->addCSS($this->_path.'views/css/ukoocompat.css');
        $this->context->controller->addJS($this->_path.'views/js/ukoocompat.js');
    }

    /**
     * Exécution du hookLeftColumn
     * Déclenché uniquement sur l'accueil et les catégories et les pages propres au module
     * Pour chaque recherche publiée sur la page courante, on affiche le bloc de recherche associé
     * @param $params
     * @return string
     */
    public function hookDisplayLeftColumn($params)
    {
        // On déclenche le module sur les pages catégories, accueil et les pages propres du module
        if (!(Tools::isSubmit('controller')
                && Tools::getValue('controller') == 'category'
                || Tools::getValue('controller') == 'index')
            && !(Tools::isSubmit('module')
                && Tools::getValue('module') == 'ukoocompat')
        ) {
            return;
        }

        // Si la variable "$params['hookDisplay']" n'est pas encore définie,
        // c'est la colonne de gauche qui est appelée
        if (!isset($params['hookDisplay'])) {
            $params['hookDisplay'] = 'displayLeftColumn';
        }

        // Si on est sur une page du module et que ce n'est pas le hook "displayUkooCompatBlock" qui est demandé
        // alors ne rien affiché (préviens le double affichage sur les pages du module)
        if (Tools::isSubmit('module') && Tools::getValue('module') == 'ukoocompat' &&
            isset($params['hookDisplay']) && $params['hookDisplay'] != 'displayUkooCompatBlock') {
            return;
        }

        // On récupère la liste des recherches publiées pour la page et le hook courant
        $search_blocks = UkooCompatSearch::getSearchByHook(
            $params['hookDisplay'],
            ($params['hookDisplay'] == 'displayHome' ? null : (int)Tools::getValue('id_category')),
            (int)$this->context->language->id
        );

        // On récupère les infos des filtres, puis on lance le rendu pour chacune des recherches
        $output = '';
        foreach ($search_blocks as $search_block) {
            // Si l'ID de la recherche est soumis, on est sur une page du module
            // et la recherche a déjà été soumise, donc ne charge que la recherche concernée
            if (Tools::isSubmit('id_search')
                && (int)$search_block['id_ukoocompat_search'] == (int)Tools::getValue('id_search')
                || !Tools::isSubmit('id_search')
            ) {
                $search = new UkooCompatSearch(
                    (int)$search_block['id_ukoocompat_search'],
                    (int)$this->context->language->id
                );
                $search->current_id_lang = (int)$this->context->language->id;
                $search->filters = $search->getFilters((int)$this->context->language->id);

                // On assigne les critères sélectionnés à la recherche (pré-remplissage des valeurs saisies)
                $search->selected_criteria =
                    unserialize($this->context->cookie->__get('ukoocompat_search_'.(int)$search->id));

                // Si les cookies sont vides (première visite),
                // on initialise un tableau vide (pour empêcher l'affichage de warning)
                if (!$search->selected_criteria) {
                    $search->selected_criteria = array();
                }

                $id_cache = array(
                    's'.(int)$search->id,
                );

                // On modifie la structure du tableau des filtres (pour la réécriture)
                $params = array('id_search' => $search->id);
                foreach ($search->selected_criteria as $id => $value) {
                    $params['filters'.(int)$id] = (int)$value;
                    $id_cache[] = 'f'.(int)$id.'c'.(int)$value;
                }

                $id_cache[] = 'searchblock';
                $id_cache = '|'.implode('|', $id_cache);
                $id_cache = $this->getCacheId('ukoocompat'.$id_cache);

                if (!$this->isCached('search-block.tpl', $id_cache)) {
                    // On récupère les critères pour chaque filtre
                    foreach ($search->filters as $k => $filter) {
                        // si le critères est déjà sélectionné, on ne charge pas l'ensemble des filtres
                        if ($search->dynamic_criteria
                            && array_key_exists((int)$filter->id, $search->selected_criteria)
                        ) {
                            $filter->criteria =
                                $filter->getCriteria((int)$search->selected_criteria[(int)$filter->id]);
                            $filter->disabled = false;
                        } elseif ($search->dynamic_criteria) {
                            // si le critères n'est pas sélectionné mais qu'on est en critères dynamiques,
                            // inutile de requêter
                            $filter->criteria = array(
                                0 => array(
                                    'id' => '',
                                    'id_ukoocompat_filter' => (int)$filter->id_ukoocompat_filter,
                                    'value' => '--'));
                            if ($k != 0) {
                                $filter->disabled = true;
                            } else {
                                $filter->disabled = false;
                            }
                        } else {
                            // les critères dynamiques sont désactivés et que le critères n'est pas sélectionné
                            $filter->criteria = $filter->getCriteria();
                            $filter->disabled = false;
                        }
                    }

                    // On détermine si la page à afficher sera la vue liste ou catalogue
                    $search->controller = 'catalog';
                    if ($search->skip_catalog) {
                        $search->controller = 'listing';
                    }

                    // On affiche le reset ou pas ?
                    $display_reset = false;
                    if (is_array($search->selected_criteria)) {
                        foreach ($search->selected_criteria as $id_criterion) {
                            if ($id_criterion != '') {
                                $display_reset = true;
                            }
                        }
                    }

                    $this->context->smarty->assign(array(
                        'is_rewrite_active' => (bool)Configuration::get('PS_REWRITING_SETTINGS'),
                        'display_reset' => $display_reset,
                        'search' => $search,
                        'form_action' =>
                            $this->context->link->getModuleLink('ukoocompat', $search->controller, $params),
                        'catalog_link' => $this->context->link->getModuleLink('ukoocompat', 'catalog', $params),
                        'listing_link' => $this->context->link->getModuleLink('ukoocompat', 'listing', $params),
                        'alias_link' => $this->context->link->getModuleLink('ukoocompat', 'alias')));
                }
                $output .= $this->display(__FILE__, 'search-block.tpl', $id_cache);
            }
        }

        return $output;
    }

    /**
     * Exécution du hookRightColum
     * Similaire à l'éxécution du hookLeftColumn
     * @param $params
     * @return string
     */
    public function hookDisplayRightColumn($params)
    {
        $params['hookDisplay'] = 'displayRightColumn';
        return $this->hookDisplayLeftColumn($params);
    }

    /**
     * Exécution du hookFooter
     * Similaire à l'éxécution du hookLeftColumn
     * @param $params
     * @return string
     */
    public function hookDisplayFooter($params)
    {
        $params['hookDisplay'] = 'displayFooter';
        return $this->hookDisplayLeftColumn($params);
    }

    /**
     * Exécution du hookTop
     * Similaire à l'éxécution du hookLeftColumn
     * @param $params
     * @return string
     */
    public function hookDisplayTop($params)
    {
        $params['hookDisplay'] = 'displayTop';
        return $this->hookDisplayLeftColumn($params);
    }

    /**
     * Exécution du hookTopColumn
     * Similaire à l'éxécution du hookLeftColumn
     * @param $params
     * @return string
     */
    public function hookDisplayTopColumn($params)
    {
        $params['hookDisplay'] = 'displayTopColumn';
        return $this->hookDisplayLeftColumn($params);
    }

    /**
     * Exécution du hookHome
     * Similaire à l'éxécution du hookLeftColumn
     * @param $params
     * @return string
     */
    public function hookDisplayHome($params)
    {
        $params['hookDisplay'] = 'displayHome';
        return $this->hookDisplayLeftColumn($params);
    }

    /**
     * Exécution du hookUkooCompatBlock
     * Similaire à l'éxécution du hookLeftColumn
     * Appelé par le module lui-même sur les pages catalog et listing
     * @param $params
     * @return string
     */
    public function hookDisplayUkooCompatBlock($params)
    {
        $params['hookDisplay'] = 'displayUkooCompatBlock';
        return $this->hookDisplayLeftColumn($params);
    }

    /**
     * Le module ne s'affiche pas dans cette position par défaut
     * (le template natif 1.6 n'utilise plus le système d'onglets sur la fiche produit)
     * Mais on laisse tout de même la possibilité aux utilisateurs de le mettre en place
     * @param $params
     */
    public function hookDisplayProductTab($params)
    {
        // On récupère la liste des recherches publiées sur la fiche produit
        $search_blocks = UkooCompatSearch::getSearchInProductTab((int)$this->context->language->id, true);
        $compatTab = array();

        // On récupère les compatibilités du produit puis on lance le rendu
        foreach ($search_blocks as $search_block) {
            // On récupère les filtres actifs de la recherche
            $search =
                new UkooCompatSearch((int)$search_block['id_ukoocompat_search'], (int)$this->context->language->id);
            $search->current_id_lang = (int)$this->context->language->id;
            $search->filters = $search->getFilters((int)$this->context->language->id, true);

            // On récupère la liste des compatibilités associées à ce produit et à cette recherche
            $compatibilities = UkooCompatCompat::getProductsCompatibilitiesFromSearch(
                (int)Tools::getValue('id_product'),
                $search,
                (int)$this->context->language->id
            );

            // On assigne les différents résultats à une varibale que l'on transmettra à smarty,
            // si le nombre de compat n'est pas nul
            if (count($compatibilities) > 0) {
                $compatTab[] = array(
                    'search' => $search,
                    'compatibilities' => $compatibilities);
            }
        }
        if (!empty($compatTab)) {
            $this->context->smarty->assign('compatTab', $compatTab);
            return $this->display(__FILE__, 'product-tab.tpl');
        } else {
            return;
        }
    }

    /**
     * Exécution du hookProductTabContent
     * Affiche un tableau de compatibilités pour chaque recherche publiée
     * et pour laquelle on trouve un résultat pour le produit courant
     * @param $params
     * @return mixed
     */
    public function hookDisplayProductTabContent($params)
    {
        // On récupère la liste des recherches publiées sur la fiche produit
        $search_blocks = UkooCompatSearch::getSearchInProductTab((int)$this->context->language->id, true);
        $compatTab = array();

        // On récupère les compatibilités du produit puis on lance le rendu
        foreach ($search_blocks as $search_block) {
            // On récupère les filtres actifs de la recherche
            $search = new UkooCompatSearch(
                (int)$search_block['id_ukoocompat_search'],
                (int)$this->context->language->id
            );
            $search->current_id_lang = (int)$this->context->language->id;
            $search->filters = $search->getFilters((int)$this->context->language->id, true);

            // On récupère la liste des compatibilités associées à ce produit et à cette recherche
            $compatibilities = UkooCompatCompat::getProductsCompatibilitiesFromSearch(
                (int)Tools::getValue('id_product'),
                $search,
                (int)$this->context->language->id
            );

            // Trie des compat par ordre alpha ?
            $tmp = array();
            foreach ($compatibilities as $compat) {
                $tmp2 = '';
                foreach ($compat as $key => $filter) {
                    if ($key != 'id_ukoocompat_compat') {
                        $tmp2 .= $filter;
                    }
                }
                $tmp[] = $tmp2;
            }
            asort($tmp); // trie alpha
            $sort_table = array();
            foreach ($tmp as $k => $v) {
                $sort_table[] = $compatibilities[$k];
            }
            $compatibilities = $sort_table;
            // end trie

            // On assigne les différents résultats à une varibale que l'on transmettra à smarty,
            // si le nombre de compat n'est pas nul
            if (count($compatibilities) > 0) {
                $compatTab[] = array(
                    'search' => $search,
                    'compatibilities' => $compatibilities);
            }
        }
        if (!empty($compatTab)) {
            $this->context->smarty->assign('compatTab', $compatTab);
            return $this->display(__FILE__, 'product-tab-content.tpl');
        } else {
            return;
        }
    }

    /**
     * Fonction similaire à hookDisplayProductTabContent() mais pour le BO
     * Créé un onglet sur la fiche produit reprenant les compatibilités du produit
     * @return mixed
     */
    public function hookDisplayAdminProductsExtra()
    {
        // Obtém a lista de pesquisas
        $search_blocks = UkooCompatSearch::getSearchInProductTab((int)$this->context->language->id);
        
        $compatTab = array();

        // On récupère les compatibilités du produit puis on lance le rendu
        foreach ($search_blocks as $search_block) {
            
            // On récupère les filtres actifs de la recherche
            $search = new UkooCompatSearch(
                (int)$search_block['id_ukoocompat_search'],
                (int)$this->context->language->id
            );

            
            $search->current_id_lang = (int)$this->context->language->id;
            $search->filters = $search->getFilters((int)$this->context->language->id, true);
            
            // On récupère la liste des compatibilités associées à ce produit et à cette recherche
            $compatibilities = UkooCompatCompat::getProductsCompatibilitiesFromSearch(
                (int)Tools::getValue('id_product'),
                $search,
                (int)$this->context->language->id
            );
            // echo '<pre>'.print_r($compatibilities,1).'</pre>';
            // exit;
            
            // On assigne les différents résultat à une varibale que l'on transmettra à smarty,
            // si le nombre de compat n'est pas nul
            if (count($compatibilities) > 0) {
                $compatTab[] = array(
                    'search' => $search,
                    'compatibilities' => $compatibilities);
            }
        }

        // echo '<pre>'.print_r($compatTab,1).'</pre>';
        //     exit;
        $this->context->smarty->assign(array(
            'compatTab' => $compatTab,
            'id_product' => (int)Tools::getValue('id_product'),
            'compatToken' => Tools::getAdminTokenLite('AdminUkooCompatCompat'),
            'filters' => UkooCompatFilter::getFilters((int)$this->context->language->id, true)));
        return $this->display(__FILE__, 'admin-product-extra.tpl');
    }

    /**
     * Exécution du hookActionUpdateProduct
     * Lors de la mise à jour d'un produit, on vérifie si une compatibilité à été soumise (création) ou supprimer
     * @param $params
     */
    public function hookUpdateProduct($params)
    {
        // Création d'une compatibilité ?
        if (Tools::isSubmit('id_ukoocompat_criterion')) {
            $selected_criteria = Tools::getValue('id_ukoocompat_criterion');
            $haveCompat = false;
            $compat = array('id_product' => (int)$params['id_product']);

            // On test d'abord si les champs sont vides (si tous les champs sont vide on ne créé pas de compat)
            $selected_criteria = array_filter($selected_criteria);
            foreach ($selected_criteria as $id_filter => $id_criterion) {
                if ($id_criterion !== '') {
                    $compat[(int)$id_filter] = (int)str_replace('*', '0', $id_criterion);
                    $haveCompat = true;
                }
            }

            // Si tous les champs sont vides, aucune compatibilité ne doit être créé
            if (!$haveCompat) {
                return;
            }

            // On test si la compatibilité existe déjà
            if (UkooCompatCompat::compatibilityExists($compat)) {
                //$this->context->controller->errors[] = $this->l('Compatibility already exists!');
                return;
            }

            // On créé la compatibilité
            $compatibility = new UkooCompatCompat();
            $compatibility->id_product = (int)$params['id_product'];
            if ($compatibility->save()) {
                $compatibility = new UkooCompatCompat((int)Db::getInstance()->Insert_ID());

                /** Bruno - Fill ps_ukoocompat_compat_asm data **/
                $id_filter_1 = $id_filter_2 = $id_filter_3 = $id_filter_4 = 0;

                foreach ($selected_criteria as $id_filter => $id_criterion) {

                    if($id_filter == 1) $id_filter_1 = $id_criterion;
                    if($id_filter == 2) $id_filter_2 = $id_criterion;
                    if($id_filter == 3) $id_filter_3 = $id_criterion;
                    if($id_filter == 4) $id_filter_4 = $id_criterion;

                    if (!$compatibility->addAssociatedCriterion(
                        (int)$id_filter,
                        (int)str_replace('*', '0', $id_criterion)
                    )
                    ) {
                        $this->context->controller->errors[] =
                            $this->l('Unabled to associate criterion to compatibility!');
                    }
                }

                Db::getInstance(_PS_USE_SQL_SLAVE_)->executeS('
                        INSERT INTO '._DB_PREFIX_.'ukoocompat_compat_asm (id_ukoocompat_compat, id_filter_value_1, id_filter_value_2, id_filter_value_3, id_filter_value_4) 
                        VALUES (' . $compatibility->id . ', ' . $id_filter_1 . ', ' . $id_filter_2 . ', ' . $id_filter_3 . ', ' . $id_filter_4 . ')'
                );

                /** Bruno - Fill ps_ukoocompat_compat_asm data **/

            } else {
                $this->context->controller->errors[] = $this->l('Unable to create the compatibility!');
                return;
            }
        } elseif (Tools::isSubmit('deletecompatibility')) {
            // Suppression d'une compatibilité ?
            $this->context->controller->errors[] = $this->l('delete compat!');
        }
    }

    /**
     * Exécution du hookDeleteProduct
     * Suppression complète de toutes les compatibilités associées lors de la suppression d'un produit
     * @param $params
     */
    public function hookDeleteProduct($params)
    {
        $compatibilities = UkooCompatCompat::getProductsCompatibilitiesFromSearch((int)$params['id_product'], array());
        if (!empty($compatibilities)) {
            foreach ($compatibilities as $compat) {
                if (Validate::isLoadedObject($compatibility = new UkooCompatCompat($compat['id_ukoocompat_compat']))) {
                    $compatibility->deleteAssociatedCriteria();
                    $compatibility->delete();
                }
            }
        }
    }

    /**
     * Exécution du hookDisplayUkooCompatCatalogTree
     * Récupération et mise en cache de l'arbre des catégories du catalogue correspondant à la recherche courante
     * @param $params
     * @return mixed
     */
    public function hookDisplayUkooCompatCatalogTree($params)
    {
        $id_cache = array(
            's' . (int)$params['search']->id,
        );
        foreach ($params['search']->selected_criteria as $id => $value) {
            $id_cache[] = 'f' . (int)$id . 'c' . (int)$value;
        }
        $id_cache[] = 'catalogtree';
        $id_cache = '|' . implode('|', $id_cache);
        $id_cache = $this->getCacheId('ukoocompat' . $id_cache);

        if (!$this->isCached('catalog-tree.tpl', $id_cache)) {

            $range = '';
            $from_category = (int)Configuration::get('PS_HOME_CATEGORY');
            $max_depth = (int)$this->getCategoryMaxDepth();
            $max_depth = ($max_depth != 0 ? $max_depth : 5);
            $category = new Category($from_category, $this->context->language->id);
            if ($category) {
                if ($max_depth > 0) {
                    $max_depth += $category->level_depth;
                }
                $range = 'AND nleft >= ' . $category->nleft . ' AND nright <= ' . $category->nright;
            }

            $resultIds = array();
            $resultParents = array();
            $result = Db::getInstance(_PS_USE_SQL_SLAVE_)->executeS(
                'SELECT c.id_parent, c.id_category, cl.name, cl.description, cl.link_rewrite
				FROM `'._DB_PREFIX_.'category` c
				INNER JOIN `'._DB_PREFIX_.'category_lang` cl
				    ON (c.`id_category` = cl.`id_category` AND cl.`id_lang` = '.(int)$this->context->language->id.
                Shop::addSqlRestrictionOnLang('cl').')
				INNER JOIN `'._DB_PREFIX_.'category_shop` cs
				    ON (cs.`id_category` = c.`id_category` AND cs.`id_shop` = '.(int)$this->context->shop->id.')
				WHERE (c.`active` = 1 OR c.`id_category` = '.(int)Configuration::get('PS_HOME_CATEGORY').')
				AND c.`id_category` != '.(int)Configuration::get('PS_ROOT_CATEGORY').'
				'.((int)$max_depth != 0 ? ' AND `level_depth` <= '.(int)$max_depth : '').'
				'.$range.'
				AND c.`id_category` IN (
					SELECT `id_category`
					FROM `'._DB_PREFIX_.'category_group`
					WHERE `id_group` IN ('.
                pSQL(
                    implode(
                        ', ',
                        Customer::getGroupsStatic((int)$this->context->customer->id)
                    )
                ).')
				)
				AND c.`id_category` IN (
					SELECT `id_category`
					FROM `'._DB_PREFIX_.'ukoocompat_category`
					WHERE `id_ukoocompat_search` = '.(int)$params['search']->id.'
				)
				ORDER BY `level_depth` ASC, cl.`name` ASC'
            );

            foreach ($result as &$row) {
                $resultParents[$row['id_parent']][] = &$row;
                $resultIds[$row['id_category']] = &$row;
            }

            // TODO :: récupérer les catégories est plus rapide que de compter le nombre de produits
            // (à améliorer)
            // on récupère le nombre de produits compatibles
            $products_categories = UkooCompatCompat::getCompatiblesProductsCategories(
                $params['search'],
                (Tools::isSubmit('id_category') ? (int)Tools::getValue('id_category') : null)
            );
            // TODO :: définie les catégories pour lesquelles il y a des produits (permet de masquer les autres)
            $nb_products = null; /*(int)UkooCompatCompat::getCompatiblesProducts(
                $search->selected_criteria,
                (int)$this->context->language->id,
                (Tools::isSubmit('id_category')?(int)Tools::getValue('id_category'):null),
                1,
                999,
                null,
                null,
                true
            );*/

            $catalogTree = $this->getTree(
                $params['search'],
                $resultParents,
                $resultIds,
                $max_depth,
                ($category ? $category->id : null)
            );

            $this->context->smarty->assign(array(
                'catalog_tree' => $catalogTree,
                'nb_products' => $nb_products,
                'active_categories' => $products_categories,
            ));

        }

        // Ne pas inclure au cache, car un override peut être réalisé sans avoir à vider le cache
        if (file_exists(_PS_THEME_DIR_ . 'modules/ukoocompat/views/templates/front/catalog-tree-branch.tpl')) {
            $this->context->smarty->assign(
                'catalog_branche_tpl_path',
                _PS_THEME_DIR_ . 'modules/ukoocompat/views/templates/front/catalog-tree-branch.tpl'
            );
        } else {
            $this->context->smarty->assign(
                'catalog_branche_tpl_path',
                _PS_MODULE_DIR_ . 'ukoocompat/views/templates/front/catalog-tree-branch.tpl'
            );
        }

        return $this->display(__FILE__, 'catalog-tree.tpl', $id_cache);
    }

    /**
     * Récupération dynamique du niveau de catégorie le plus profond
     * @return int
     */
    public function getCategoryMaxDepth()
    {
        $result = (int)Db::getInstance(_PS_USE_SQL_SLAVE_)->getValue('
            SELECT MAX(`level_depth`) FROM `'._DB_PREFIX_.'category` c
        ');
        return $result;
    }

    /**
     * Exécution du hookModulesRoutes
     * Permet de définir des routes personnalisées (url réécrite custom) pour le module
     * @return array
     */
    public function hookModuleRoutes()
    {
        $output = array();

        // On récupère les différentes recherches publiées
        $searchs = UkooCompatSearch::getAllActiveSearch();

        // Génération des règles de réécritures pour chaque recherche
        foreach ($searchs as $search) {

            $search = new UkooCompatSearch((int)$search['id_ukoocompat_search'], (int)$this->context->language->id);
            $search->filters = $search->getFilters((int)$this->context->language->id);

            // Génération des règles "module-ukoocompat-catalog-sX-Y"
            for ($i=1; $i <= count($search->filters); $i++) {
                $output['module-ukoocompat-catalog-s'.(int)$search->id.'-'.$i] = array(
                    'controller' => 'catalog',
                    'rule' => '',
                    'keywords' => array(
                        'id_search' => array(
                            'regexp' => '[('.(int)$search->id.')]',
                            'param' => 'id_search')),
                    'params' => array(
                        'fc' => 'module',
                        'module' => 'ukoocompat')
                );
                $rule1 = 'compat';
                $rule2 = '/{id_search}';
                foreach ($search->filters as $k => $filter) {
                    if ($k+1 <= $i) {
                        $rule1 .= '/{filters'.(int)$filter->id.'_rw}';
                        $rule2 .= '-{filters'.(int)$filter->id.'}';
                        $output['module-ukoocompat-catalog-s'.(int)$search->id.'-'.$i]['keywords']
                        ['filters'.(int)$filter->id] = array(
                            'regexp' => '[0-9]+',
                            'param' => 'filters'.(int)$filter->id);
                        $output['module-ukoocompat-catalog-s'.(int)$search->id.'-'.$i]['keywords']
                        ['filters'.(int)$filter->id.'_rw'] = array('regexp' => '[_a-zA-Z0-9-\pL]*');
                    }
                }
                $output['module-ukoocompat-catalog-s'.(int)$search->id.'-'.$i]['rule'] = $rule1.$rule2;
            }
            $output['module-ukoocompat-catalog-s'.(int)$search->id.'-'.$i] = array(
                'controller' => 'catalog',
                'rule' => 'compat/{id_search}',
                'keywords' => array(
                    'id_search' => array(
                        'regexp' => '[('.(int)$search->id.')]',
                        'param' => 'id_search')),
                'params' => array(
                    'fc' => 'module',
                    'module' => 'ukoocompat'));

            // Génération des règles "module-ukoocompat-listing-sX-Y"
            for ($i=1; $i <= count($search->filters); $i++) {
                $output['module-ukoocompat-listing-s'.(int)$search->id.'-'.$i] = array(
                    'controller' => 'listing',
                    'rule' => '',
                    'keywords' => array(
                        'id_search' => array(
                            'regexp' => '[('.(int)$search->id.')]',
                            'param' => 'id_search'),
                        'id_category' => array(
                            'regexp' => '[0-9]+',
                            'param' => 'id_category'),
                        'category_rewrite' => array('regexp' => '[_a-zA-Z0-9-\pL]*')),
                    'params' => array(
                        'fc' => 'module',
                        'module' => 'ukoocompat')
                );
                $rule1 = 'compat/c';
                $rule2 = '/{category_rewrite}/{id_search}';
                foreach ($search->filters as $k => $filter) {
                    if ($k+1 <= $i) {
                        $rule1 .= '/{filters'.(int)$filter->id.'_rw}';
                        $rule2 .= '-{filters'.(int)$filter->id.'}';
                        $output['module-ukoocompat-listing-s'.(int)$search->id.'-'.$i]['keywords']
                        ['filters'.(int)$filter->id] = array(
                            'regexp' => '[0-9]+',
                            'param' => 'filters'.(int)$filter->id);
                        $output['module-ukoocompat-listing-s'.(int)$search->id.'-'.$i]['keywords']
                        ['filters'.(int)$filter->id.'_rw'] = array('regexp' => '[_a-zA-Z0-9-\pL]*');
                    }
                }
                $output['module-ukoocompat-listing-s'.(int)$search->id.'-'.$i]['rule'] =
                    $rule1.$rule2.'-{id_category}';
            }
            $output['module-ukoocompat-listing-s'.(int)$search->id.'-'.$i] = array(
                'controller' => 'listing',
                'rule' => 'compat/c/{category_rewrite}/{id_search}-{id_category}',
                'keywords' => array(
                    'id_search' => array(
                        'regexp' => '[('.(int)$search->id.')]',
                        'param' => 'id_search'),
                    'id_category' => array(
                        'regexp' => '[0-9]+',
                        'param' => 'id_category'),
                    'category_rewrite' => array('regexp' => '[_a-zA-Z0-9-\pL]*')),
                'params' => array(
                    'fc' => 'module',
                    'module' => 'ukoocompat'));

            // Génération des règles "module-ukoocompat-listing-all-sX-Y"
            for ($i=1; $i <= count($search->filters); $i++) {
                $output['module-ukoocompat-listing-all-s'.(int)$search->id.'-'.$i] = array(
                    'controller' => 'listing',
                    'rule' => '',
                    'keywords' => array(
                        'id_search' => array(
                            'regexp' => '[('.(int)$search->id.')]',
                            'param' => 'id_search'),
                        'category_rewrite' => array('regexp' => '[_a-zA-Z0-9-\pL]*')),
                    'params' => array(
                        'fc' => 'module',
                        'module' => 'ukoocompat')
                );
                $rule1 = 'compat/c';
                $rule2 = '/{category_rewrite}/{id_search}';
                foreach ($search->filters as $k => $filter) {
                    if ($k+1 <= $i) {
                        $rule1 .= '/{filters'.(int)$filter->id.'_rw}';
                        $rule2 .= '-{filters'.(int)$filter->id.'}';
                        $output['module-ukoocompat-listing-all-s'.(int)$search->id.'-'.$i]['keywords']
                        ['filters'.(int)$filter->id] = array(
                            'regexp' => '[0-9]+',
                            'param' => 'filters'.(int)$filter->id);
                        $output['module-ukoocompat-listing-all-s'.(int)$search->id.'-'.$i]['keywords']
                        ['filters'.(int)$filter->id.'_rw'] = array('regexp' => '[_a-zA-Z0-9-\pL]*');
                    }
                }
                $output['module-ukoocompat-listing-all-s'.(int)$search->id.'-'.$i]['rule'] = $rule1.$rule2;
            }
            $output['module-ukoocompat-listing-all-s'.(int)$search->id.'-'.$i] = array(
                'controller' => 'listing',
                'rule' => 'compat/c/{category_rewrite}/{id_search}',
                'keywords' => array(
                    'id_search' => array(
                        'regexp' => '[('.(int)$search->id.')]',
                        'param' => 'id_search'),
                    'category_rewrite' => array('regexp' => '[_a-zA-Z0-9-\pL]*')),
                'params' => array(
                    'fc' => 'module',
                    'module' => 'ukoocompat'));
        }
        return $output;
    }

    /**
     * Fonction récursive pour générer l'arbre des catégories du catalogue
     * Inspiré du module blockcategories
     * TODO :: améliorer le temps de chargement et d'éxécution
     * @param $search
     * @param $result_parents
     * @param $result_ids
     * @param $max_depth
     * @param null $id_category
     * @param int $current_depth
     * @return array|bool
     */
    public function getTree($search, $result_parents, $result_ids, $max_depth, $id_category = null, $current_depth = 0, $nb_products_temp = null)
    {
        if (is_null($id_category)) {
            $id_category = $this->context->shop->getCategory();
        }

        $children = array();
        if (isset($result_parents[$id_category])
            && count($result_parents[$id_category])
            && ($max_depth == 0 || $current_depth < $max_depth)
        ) {
            foreach ($result_parents[$id_category] as $subcat) {
                $children[] = $this->getTree(
                    $search,
                    $result_parents,
                    $result_ids,
                    $max_depth,
                    $subcat['id_category'],
                    $current_depth + 1,
					$nb_products_temp
                );
            }
        }

        if (!isset($result_ids[$id_category])) {
            return false;
        }

        $params = array(
            'id_search' => $search->id,
            'id_category' => $id_category);

        foreach ($search->selected_criteria as $id_filter => $id_criterion) {
            $params['filters'.(int)$id_filter] = (int)$id_criterion;
        }

        $return = array(
            'id' => $id_category,
            'category_link' => $this->context->link->getCategoryLink(
                $id_category,
                $result_ids[$id_category]['link_rewrite']
            ),
            'link' => $this->context->link->getModuleLink('ukoocompat', 'listing', $params),
            'name' => $result_ids[$id_category]['name'],
            'link_rewrite' => $result_ids[$id_category]['link_rewrite'],
            'desc' => $result_ids[$id_category]['description'],
            'level_depth' => $current_depth,
            'children' => $children);

        return $return;
    }

    /**
     * Vide le cache du module
     */
    public static function clearUkooCompatCache()
    {
        $module = new UkooCompat();
        $module->_clearCache('search-block.tpl');
        $module->_clearCache('catalog-tree.tpl');
    }

    /**
     * Fonction permettant de recharger les valeurs des filtres dynamiquement selon les critères sélectionnés
     */
    public function ajaxReloadFilters()
    {
        // On récupère les filtres et critères sélectionnés
        if (Tools::isSubmit('id_lang') && Tools::isSubmit('id_search')) {
            // On récupère les informations soumisent via ajax
            $filters = $reload_filters = UkooCompat::getUrlFilters();

            // équivalence pour la selection des critères
            $filters_for_criteria = array();
            foreach ($filters as $id_search_filter => $criteria) {
                $filters_for_criteria[(int)UkooCompatSearchFilter::getFilterIdFromSearchFilterId(
                    (int)$id_search_filter
                )] = $criteria;
            }

            $id_lang = (int)Tools::getValue('id_lang');

            // On tiens compte de la catégorie courante, et de ses sous-catégories,
            // mais uniquement si elles sont sélectionnées dans la configuration de la recherche courante
            $id_category = (int)(Tools::isSubmit('id_category') ? Tools::getValue('id_category') : 0);
            $id_categories = UkooCompatCompat::getAllSubcategoriesIds((int)$id_category);
            $id_categories_to_include = UkooCompatSearch::getSearchCategories((int)Tools::getValue('id_search'));
            $id_categories = array_intersect($id_categories, $id_categories_to_include);

            $id_search = (int)Tools::getValue('id_search');
            $search = new UkooCompatSearch($id_search, $id_lang);
            $search->current_id_lang = $id_lang;
            $search->filters = $search->getFilters($id_lang, true);
            $search->selected_criteria = $filters;
            $filters_order = array();

            $id_cache = array(
                's'.(int)$search->id,
                'cat'.(int)$id_category
            );
            foreach ($search->selected_criteria as $id => $value) {
                $id_cache[] = 'f'.(int)$id.'c'.(int)$value;
            }
            $id_cache[] = 'searchblock|ajax';
            $id_cache = '|'.implode('|', $id_cache);
            $id_cache = $this->getCacheId('ukoocompat'.$id_cache);
            if (!$this->isCached('search-block.tpl', $id_cache)) {

                foreach ($search->filters as $filter) {
                    $filters_order[(int)$filter->id_ukoocompat_filter]['order_way'] = $filter->order_way;
                    $filters_order[(int)$filter->id_ukoocompat_filter]['order_by'] = $filter->order_by;
                }

                $id_previous_filter = 0;

                foreach ($filters as $id_search_filter => $id_criterion) {
                    $filter = new UkooCompatSearchFilter((int)$id_search_filter, (int)$id_lang);
                    $id_filter = (int)$filter->id_ukoocompat_filter;

                    $filter->groups = UkooCompatSearchFilter::getGroups((int)$filter->id, (int)$id_lang);
                    $reload_filters[(int)$id_search_filter] = $filter;
                    if ((isset($search->selected_criteria[(int)$id_previous_filter])
                            && !empty($search->selected_criteria[(int)$id_previous_filter]))
                        || (int)$id_previous_filter == 0
                    ) {
                        $reload_filters[(int)$id_search_filter]->criteria =
                            UkooCompatCriterion::getCriteria(
                                (int)$id_filter,
                                (int)$id_lang,
                                $id_categories,
                                $filters_order[(int)$id_filter]['order_by'],
                                $filters_order[(int)$id_filter]['order_way'],
                                $filters_for_criteria
                            );
                        $reload_filters[(int)$id_search_filter]->disabled = false;
                    } else {
                        // Sinon, le champ n'a pas besoin d'être chargé, car il est disabled
                        $reload_filters[(int)$id_search_filter]->criteria = array(
                            0 => array(
                                'id' => '',
                                'id_ukoocompat_filter' => (int)$id_filter,
                                'value' => '--'));
                        $reload_filters[(int)$id_search_filter]->disabled = true;
                    }
                    $id_previous_filter = (int)$id_search_filter;
                }

                // A-t-on cliqué sur le bouton reset ?
                if (Tools::isSubmit('reset')) {
                    $display_reset = false;
                    foreach ($search->filters as $k => $filter) {
                        if ($k == 0) {
                            $filter->criteria = $filter->getCriteria();
                            $filter->disabled = false;
                        } else {
                            $filter->criteria = array(
                                0 => array(
                                    'id' => '',
                                    'id_ukoocompat_filter' => (int)$filter->id_ukoocompat_filter,
                                    'value' => '--'));
                            $filter->disabled = true;
                        }
                    }
                    $search->selected_criteria = array();
                    // On reset les cookies et donc la recherche courante
                    $this->context->cookie->__set(
                        'ukoocompat_search_'.(int)$id_search,
                        serialize($search->selected_criteria)
                    );
                } else {
                    $display_reset = false;
                    foreach ($search->selected_criteria as $id_search_filter => $id_criterion) {
                        if ($id_criterion != '') {
                            $display_reset = true;
                        }
                    }
                    $search->filters = $reload_filters;

                    $this->context->cookie->__set(
                        'ukoocompat_search_'.(int)$id_search,
                        serialize($search->selected_criteria)
                    );

                }

                // On détermine si la page à afficher sera la vue liste ou catalogue
                $search->controller = 'catalog';
                if ($search->skip_catalog) {
                    $search->controller = 'listing';
                }

                $this->context->smarty->assign(array(
                    'ajax_reload' => true,
                    'page_name' =>
                        (Tools::isSubmit('page_name') ? Tools::getValue('page_name') : 'ukoocompat_ajax_reload'),
                    'is_rewrite_active' => (bool)Configuration::get('PS_REWRITING_SETTINGS'),
                    'display_reset' => $display_reset,
                    'display' => '',//$search->controller,
                    'search' => $search,
                    'form_action' => $this->context->link->getModuleLink('ukoocompat', $search->controller),
                    'catalog_link' => $this->context->link->getModuleLink('ukoocompat', 'catalog', array(
                        'id_search' => $search->id,
                        'filters' => $search->selected_criteria)),
                    'listing_link' => $this->context->link->getModuleLink('ukoocompat', 'listing', array(
                        'id_search' => $search->id,
                        'filters' => $search->selected_criteria))));
            }
			//webmaster so mostra na pagina index

			if( Tools::getValue('page_name')=='index'){
			    
			    if( Context::getContext()->isMobile() ){
				    echo $this->display(__FILE__, 'wm-search-block-topmenu.tpl', $id_cache);
			    }else{
				    echo $this->display(__FILE__, 'wm-search-block-home-topmenu.tpl', $id_cache);
			    }
			}
			else{
				 echo $this->display(__FILE__, 'search-block.tpl', $id_cache);
			}

        } else {
            die('{"hasError" : true, errors : "Invalid vars!"}');
        }
    }

    /**
     * Fonction permettant de rechercher par alias en ajax par le front
     */
    public function ajaxSearchByAlias()
    {
        // On récupère l'alias questionné
        if (Tools::isSubmit('q') && Tools::isSubmit('id_lang') && Tools::isSubmit('id_search')) {
            $id_lang = (int)Tools::getValue('id_lang');
            $id_search = (int)Tools::getValue('id_search');
            $alias = Tools::getValue('q');

            // On cherche dans notre base d'alias s'il est enregistré
            $alias_results = UkooCompatAlias::searchAlias($alias);

            if (count($alias_results) > 0) {
                foreach ($alias_results as $key => $alias) {
                    // On récupère les différentes instances (groupes de critères) pour l'alias
                    $alias_instances =
                        UkooCompatAliasInstance::getAliasInstancesByAlias($alias['id_ukoocompat_alias']);

                    // S'il y a des instances, on les ajoute au résultat
                    if (count($alias_instances) > 0) {
                        // Pour chaque instance on créé une chaine lisible
                        foreach ($alias_instances as $key2 => $instance) {
                            $criteria = UkooCompatAliasInstance::getAliasInstanceAssociatedCriteria(
                                (int)$instance['id_ukoocompat_alias_instance'],
                                (int)$id_lang
                            );
                            $output = array();
                            foreach ($criteria as $criterion) {
                                $output[] = ($criterion['id_ukoocompat_criterion'] == '*' ?
                                    $this->l('All') : $criterion['criterion_value']);
                            }
                            $alias_instances[$key2]['criteria'] = implode(' ', $output);
                            $alias_instances[$key2]['link'] = $this->context->link->getModuleLink(
                                'ukoocompat',
                                (Tools::isSubmit('search_controller') ?
                                    Tools::getValue('search_controller') : 'catalog'),
                                array(
                                    'id_search' => (int)$id_search,
                                    'id_alias_instance' => (int)$instance['id_ukoocompat_alias_instance'])
                            );
                        }
                        $alias_results[$key]['instances'] = $alias_instances;
                    } else {
                        // Sinon, on supprime l'alias du tableau, car sans instance, il ne sert à rien
                        unset($alias_results[$key]);
                    }
                }
                die(json_encode(array_values($alias_results)));
            }
        } else {
            die('{"hasError" : true, errors : "Invalid vars!"}');
        }
    }

    /**
     * Fonction appelé par le fichier cron.php
     * Vérifie que la recherche demandée existe bien et appel sa fonction de génération du sitemap
     * @param $id_search
     */
    public function generateSitemap($id_search)
    {
        // on tente de récupérer la recherche en question pour voir si elle existe
        if (!UkooCompatSearch::existsInDatabase((int)$id_search, 'ukoocompat_search')) {
            die('{"hasError" : true, errors : "Search dosent exists!"}');
        }

        $search = new UkooCompatSearch((int)$id_search);
        $search->generateSitemap();
    }

    /**
     * Permet de récupérer les variables de pagination et/ou de trie présentent dans l'URL
     * @return array Un tableau contenant les valeurs de pagination et de trie
     */
    private static function getUrlParameters()
    {
        $vars = $_GET;
        $others_vars = array();
        if (!empty($vars)) {
            foreach ($vars as $k => $val) {
                if ($val != '') {
                    switch ($k) {
                        case 'p':
                        case 'n':
                            $others_vars[$k] = (int)$val;
                            break;
                        case 'orderby':
                            switch ($val) {
                                case 'price':
                                case 'name':
                                case 'quantity':
                                case 'reference':
                                    $others_vars[$k] = $val;
                                    break;
                                default: $others_vars[$k] = 'position';
                            }
                            break;
                        case 'orderway':
                            $others_vars[$k] = ($val == 'desc' || $val == 'DESC' ? 'desc' : 'asc');
                            break;
                    }
                }
            }
        }
        return $others_vars;
    }

    /**
     * Permet de récupérer les variables de filtres présentent dans l'URL
     * @return array Un tableau contenant les valeurs des critères sélectionnés, indexé selon les ID des filtres
     */
    private static function getUrlFilters()
    {
        $vars = $_GET;
        $filters = array();
        if (!empty($vars)) {
            foreach ($vars as $k => $val) {
                if (preg_match('/filters[0-9]+/', $k)) {
                    $filters[(int)str_replace('filters', '', $k)] = ((int)$val == 0 ? '' : $val);
                }
            }
        }
        return $filters;
    }

    /**
     * Test la présence des variables de filtres dans l'URL
     * @return bool Vrai ou faux selon qu'au moins une variable de filtre ai été trouvée dans l'URL
     */
    private static function isSubmitUrlFilters()
    {
        $vars = $_GET;
        $filters = array();
        if (!empty($vars)) {
            foreach ($vars as $k => $val) {
                if (preg_match('/filters[0-9]+/', $k)) {
                    $filters[(int)str_replace('filters', '', $k)] = $val;
                }
            }
        }
        return !empty($filters);
    }

    /**
     * Construit et retourne l'URL réécrite pour une recherche
     * @param $id_lang
     * @param $id_search
     * @param $id_category
     * @param $filters
     * @param $others_vars
     * @return string
     */
    private static function getCanonicalUrl($id_lang, $id_search, $id_category, $filters, $others_vars = '')
    {
        $url = 'compat';
        $ids_criteria = '';
        $link_rewrite = '';
        foreach ($filters as $id_criterion) {
            if (!empty($id_criterion)) {
                $criterion = new UkooCompatCriterion((int)$id_criterion, (int)$id_lang);
                $rewrite = Tools::str2url($criterion->value);
                $link_rewrite .= ($rewrite != '' ? '/'.$rewrite : '/'.(int)$id_criterion);
                $ids_criteria .= '-'.$id_criterion;
            } else {
                $link_rewrite .= '/undefined';
                $ids_criteria .= '-0';
            }
        }
        if (!empty($id_category)) {
            $url .= '/c';
            if ($id_category == 'all') {
                // redirection directe vers le listing produit
                $link_rewrite .= '/all';
            } else {
                $category = new Category((int)$id_category, (int)$id_lang);
                $link_rewrite .= ($category->link_rewrite != '' ? '/'.$category->link_rewrite : '/'.(int)$id_category);
                $ids_criteria .= '-'.$id_category;
            }
        }

        // Ajout des paramètres de pagination et de trie
        if (isset($others_vars) && !empty($others_vars)) {
            if (is_string($others_vars)) {
                // Convert the string into an array (adjust the delimiter based on your string format)
                $others_vars = explode('&', $others_vars);
            }
        
            foreach ($others_vars as $k => &$val) {
                $val = $k . '=' . $val;
            }
        }
        
        

        return $url.$link_rewrite.'/'.(int)$id_search.$ids_criteria.
        (isset($others_vars) && !empty($others_vars) ? '?'.implode('&', $others_vars) : '');
    }

	/*V01-Include old - hookDisplayTopMenu*/
	 public function hookDisplayTopMenu($params)
    {

        // On récupère les infos des filtres, puis on lance le rendu pour chacune des recherches
        $output = '';

        $search = new UkooCompatSearch(1, (int) $this->context->language->id);
        $search->current_id_lang = (int) $this->context->language->id;
        $search->filters = $search->getFilters((int) $this->context->language->id);

        // On assigne les critères sélectionnés à la recherche (pré-remplissage des valeurs saisies)
        $search->selected_criteria = unserialize($this->context->cookie->__get('ukoocompat_search_' . (int) $search->id));

        // Si les cookies sont vides (première visite),
        // on initialise un tableau vide (pour empêcher l'affichage de warning)
        if (!$search->selected_criteria)
        {
            $search->selected_criteria = array();
        }

        $id_cache = array(
            's' . (int) $search->id,
        );

        // On modifie la structure du tableau des filtres (pour la réécriture)
        $params = array('id_search' => $search->id);
        foreach ($search->selected_criteria as $id => $value)
        {
            $params['filters' . (int) $id] = (int) $value;
            $id_cache[] = 'f' . (int) $id . 'c' . (int) $value;
        }

        $id_cache[] = 'searchblocktopmenu';
        $id_cache = '|' . implode('|', $id_cache);
        $id_cache = $this->getCacheId('ukoocompat' . $id_cache);

        if (!$this->isCached('search-block-topmenu.tpl', $id_cache))
        {
            // On récupère les critères pour chaque filtre
            foreach ($search->filters as $k => $filter)
            {
                // si le critères est déjà sélectionné, on ne charge pas l'ensemble des filtres
                if ($search->dynamic_criteria && array_key_exists((int) $filter->id, $search->selected_criteria)
                )
                {
                    $filter->criteria = $filter->getCriteria((int) $search->selected_criteria[(int) $filter->id]);
                    $filter->disabled = false;
                }
                elseif ($search->dynamic_criteria)
                {
                    // si le critères n'est pas sélectionné mais qu'on est en critères dynamiques, inutile de requêter

                    $filter->criteria = array(
                        0 => array(
                            'id' => '',
                            'id_ukoocompat_filter' => (int) $filter->id_ukoocompat_filter,
                            'value' => '--'));
                    if ($k != 0)
                    {
                        $filter->disabled = true;
                    }
                    else
                    {
                        $filter->disabled = false;
                    }
                }
                else
                {
                    // les critères dynamiques sont désactivés et que le critères n'est pas sélectionné
                    $filter->criteria = $filter->getCriteria();
                    $filter->disabled = false;
                }
            }

            // On détermine si la page à afficher sera la vue liste ou catalogue
            $search->controller = 'catalog';
            if ($search->skip_catalog)
            {
                $search->controller = 'listing';
            }

            // On affiche le reset ou pas ?
            $display_reset = false;
            if (is_array($search->selected_criteria))
            {
                foreach ($search->selected_criteria as $id_criterion)
                {
                    if ($id_criterion != '')
                    {
                        $display_reset = true;
                    }
                }
            }

            $this->context->smarty->assign(array(
                'is_rewrite_active' => (bool) Configuration::get('PS_REWRITING_SETTINGS'),
                'display_reset' => $display_reset,
                'search' => $search,
                'form_action' =>
                $this->context->link->getModuleLink('ukoocompat', $search->controller, $params),
                'catalog_link' => $this->context->link->getModuleLink('ukoocompat', 'catalog', $params),
                'listing_link' => $this->context->link->getModuleLink('ukoocompat', 'listing', $params),
                'alias_link' => $this->context->link->getModuleLink('ukoocompat', 'alias')));
        }

        $output .= $this->display(__FILE__, 'search-block-topmenu.tpl', $id_cache);

        return $output;
    }
/*V01-Include old*/

}
