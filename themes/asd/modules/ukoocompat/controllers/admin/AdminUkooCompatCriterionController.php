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

class AdminUkooCompatCriterionController extends ModuleAdminController
{
    public function __construct()
    {
        $this->bootstrap = true;
        $this->table = 'ukoocompat_criterion';
        $this->className = 'UkooCompatCriterion';
        $this->lang = true;
        $this->_defaultOrderBy = 'position';
        $this->position_identifier = 'id_ukoocompat_criterion';
        $this->context = Context::getContext();

        parent::__construct();

        $this->bulk_actions = array(
            'delete' => array(
                'text' => $this->l('Delete selected'),
                'confirm' => $this->l('Delete selected items?'),
                'icon' => 'icon-trash'));

        if (Tools::getIsset('id_ukoocompat_filter')) {
            $id_filter = (int)Tools::getValue('id_ukoocompat_filter');
            $this->_where = sprintf('AND `id_ukoocompat_filter` = %d', $id_filter);

            $filter = new UkooCompatFilter($id_filter, (int)$this->context->employee->id_lang);
            $this->toolbar_title = $filter->name;
        }

        $this->fields_list = array(
            'id_ukoocompat_criterion' => array(
                'title' => $this->l('ID'),
                'align' => 'center',
                'class' => 'fixed-width-xs'),
            'value' => array(
                'title' => $this->l('Value'),
                'align' => 'left'),
            'id_ukoocompat_filter' => array(
                'title' => $this->l('Filter'),
                'align' => 'left',
                'callback' => 'getFilterName'),
            'position' => array(
                'title' => $this->l('Order'),
                'filter_key' => 'position',
                'position' => 'position',
                'class' => 'fixed-width-xs',
                'align' => 'center'));

    }

    /**
     * Ajoute des boutons spécifiques dans la barre d'outils
     */
    public function initPageHeaderToolbar()
    {
        parent::initPageHeaderToolbar();

        if ($this->display != 'edit' && $this->display != 'add') {
            $this->page_header_toolbar_btn['new_ukoocompat_criterion'] = array(
                'href' => self::$currentIndex.'&addukoocompat_criterion&token='.$this->token,
                'desc' => $this->l('Add new criterion', null, null, false),
                'icon' => 'process-icon-new');
        }

        // Bouton documentation dans la toolbar
        $this->page_header_toolbar_btn['doc_ukoocompat_compat'] = array(
            'href' => '../modules/ukoocompat/doc/documentation_'.
                ($this->context->language->iso_code == 'fr' ? 'FR' : 'EN').'.pdf',
            'desc' => $this->l('Documentation'), 'target' => '_blank', 'icon' => 'process-icon-book');
    }

    /**
     * Fonction qui retourne le nom du filtre associé au critère pour plus de clareté
     * @return mixed
     */
    public function getFilterName()
    {
        return $this->toolbar_title[0];
    }

    /**
     * Affiche la liste des critères
     * @return mixed
     */
    public function renderList()
    {
        $this->addRowAction('edit');
        $this->addRowAction('delete');

        $this->addJS(_PS_JS_DIR_.'admin-dnd.js'); // nécessaire pour la réorganisation des positions en ajax
        return parent::renderList();
    }

    /**
     * Affiche le formulaire de création d'un critère
     * @return mixed
     */
    public function renderForm()
    {
        $this->initToolbar();

        if (!($this->loadObject(true))) {
            return;
        }


        $this->fields_form = array(
            'tinymce' => false,
            'legend' => array(
                'title' => $this->l('Criterion settings'),
                'icon' => 'icon-info-sign'),
            'input' => array(
                array(
                    'type' => 'select',
                    'label' => $this->l('Filter'),
                    'name' => 'id_ukoocompat_filter',
                    'required' => true,
                    'options' => array(
                        'query' => UkooCompatFilter::getFilters($this->context->language->id),
                        'id' => 'id',
                        'name' => 'name'),
                    'col' => '3'),
                array(
                    'type' => 'select',
                    'label' => 'Parent relation',
                    'name' => 'id_parent_item',
                    'required' => true,
                    'options' => array(
                        'query' => UkooCompatFilter::getParentRelationShip($this->context->language->id, (int)$_GET['id_ukoocompat_criterion']),
                        'id' => 'id_ukoocompat_criterion',
                        'name' => 'value'),
                    'col' => '3'),
                array(
                    'type' => 'text',
                    'label' => $this->l('Value'),
                    'name' => 'value',
                    'lang' => true,
                    'required' => true),
                array(
                    'type' => 'text',
                    'label' => $this->l('Value Position'),
                    'name' => 'position',
                    'lang' => false,
                    'required' => true)
            ),
            'submit' => array(
                'title' => $this->l('Save'),
                'name' => 'submitAdd'.$this->table.'AndBackToParent'),
            'buttons' => array(
                'save_and_new' => array(
                    'name' => 'submitAdd'.$this->table.'AndNew',
                    'type' => 'submit',
                    'title' => $this->l('Save and new'),
                    'class' => 'btn btn-default pull-right',
                    'icon' => 'process-icon-save'),
                'cancel' => array(
                    'name' => 'cancel',
                    'title' => $this->l('Cancel'),
                    'class' => 'btn btn-default',
                    'href' => 'index.php?controller=AdminUkooCompatFilter&token='.
                        Tools::getAdminTokenLite('AdminUkooCompatFilter'),
                    'icon' => 'process-icon-cancel')));

        // on affiche pas le bouton annuler de base, on le remplace pour re-diriger vers les filtre lorsqu'on annule
        $this->show_form_cancel_button = false;

        return parent::renderForm();
    }

    /**
     * Fonction exécutée lors de la création d'un nouveau critère
     * Rajout de l'utilisation d'un bouton "Enregistrer et nouveau"
     * Changement de redirection pour le bouton "Enregistrer" pour redir vers le controlleur des filtres
     * Positionnement du nouveau filtre à la fin
     * @return mixed
     */
    public function processAdd()
    {

        // $object = new UkooCompatCriterion();
        $object = parent::processAdd();

        if (!Validate::isLoadedObject($object)) {
            $this->errors[] = $this->l('Unable to add criterion!');
            return false;
        }

        // Rajout de l'utilisation d'un bouton "Enregistrer et nouveau"
        if (Tools::isSubmit('submitAdd'.$this->table.'AndNew') && !count($this->errors)) {
            $this->redirect_after = self::$currentIndex.'&add'.$this->table.'&conf=3&token='.$this->token;
        }

        // Changement de redirection pour le bouton "Enregistrer" pour redir vers le controlleur des filtres
        if (Tools::isSubmit('submitAdd'.$this->table.'AndBackToParent') && !count($this->errors)) {
            $this->redirect_after = 'index.php?controller=AdminUkooCompatFilter&'.
                $this->identifier.'=&conf=3&token='.Tools::getAdminTokenLite('AdminUkooCompatFilter');
        }

        // Positionnement à la fin
        if (!count($this->errors) && !$object->updatePosition()) {
            $this->errors[] = $this->l('Unable to update criterion position!');
        }

        /** ASM **/
        $sql_update_parent_id = "UPDATE eu_ukoocompat_criterion_lang SET id_filter=" . (int)$_POST['id_ukoocompat_filter'] . ", id_parent_item=" . (int)$_POST['id_parent_item'] . " WHERE id_ukoocompat_criterion = " . $object->id;
        // echo $sql_update_parent_id;
        // exit;
        Db::getInstance(_PS_USE_SQL_SLAVE_)->execute($sql_update_parent_id);

        /** ASM **/

        // Suppression du cache du module
        UkooCompat::clearUkooCompatCache();

        return $object;
    }

    /**
     * Fonction exécutée lors de la mise à jour d'un critère
     * @return mixed
     */
    public function processUpdate()
    {
        $object = parent::processUpdate();

        /** ASM **/
        $sql_update_parent_id = "UPDATE eu_ukoocompat_criterion_lang SET id_parent_item=" . (int)$_POST['id_parent_item'] . ' WHERE id_ukoocompat_criterion = ' . $_POST['id_ukoocompat_criterion'];
        Db::getInstance(_PS_USE_SQL_SLAVE_)->execute($sql_update_parent_id);
        /** ASM **/

        // Rajout de l'utilisation d'un bouton "Enregistrer et nouveau"
        if (Tools::isSubmit('submitAdd'.$this->table.'AndNew') && !count($this->errors)) {
            $this->redirect_after = self::$currentIndex.'&add'.$this->table.'&conf=4&token='.$this->token;
        }

        // Changement de redirection pour le bouton "Enregistrer" pour redir vers le controlleur des filtres
        if (Tools::isSubmit('submitAdd'.$this->table.'AndBackToParent') && !count($this->errors)) {
            $this->redirect_after = 'index.php?controller=AdminUkooCompatFilter&'.
                $this->identifier.'=&conf=4&token='.Tools::getAdminTokenLite('AdminUkooCompatFilter');
        }

        // Suppression du cache du module
        UkooCompat::clearUkooCompatCache();

        return $object;
    }

    /**
     * Fonction exécutée lors de la suppression d'un critère
     * @return mixed
     */
    public function processDelete()
    {
        $object = parent::processDelete();

        // Suppression du cache du module
        UkooCompat::clearUkooCompatCache();

        return $object;
    }

    /**
     * Fonction AJAX pour mettre à jour les positions
     */
    public function ajaxProcessUpdatePositions()
    {
        if (Tools::isSubmit('ukoocompat_criterion') && Tools::isSubmit('id')) {
            // on récupère les informations sur les lignes après le changement de position
            $error = false;
            foreach (Tools::getValue('ukoocompat_criterion') as $position => $row) {
                $r = explode('_', $row);
                if (!UkooCompatCriterion::updateCriterionPosition((int)$r[2], (int)$position)) {
                    $error = true;
                }
            }
            if ($error) {
                die('{"hasError" : true, errors : "Can not update criteria position"}');
            } else {

                // Suppression du cache du module
                UkooCompat::clearUkooCompatCache();

                die(true);
            }
        } else {
            die('{"hasError" : true, errors : "Can not update positions!"}');
        }
    }
}
