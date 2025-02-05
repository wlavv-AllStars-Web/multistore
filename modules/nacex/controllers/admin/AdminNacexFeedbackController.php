<?php
include _PS_MODULE_DIR_ . 'nacex/nacexDTO.php';
include _PS_MODULE_DIR_ . 'nacex/nacexFeedback.php';

class AdminNacexFeedbackController extends ModuleAdminController
{
    protected $ncx_logo200url;
    protected $filpath;
    protected $filenames;
    protected $ndto;
    protected $fb;

    public function __construct()
    {
        parent::__construct();

        $this->ncx_logo200url = _MODULE_DIR_ . 'nacex/images/logos/NACEX_logo.svg';

        // Nombre el Manual de Usuario. Cambiarlo si éste se modifica
        $this->filpath = _MODULE_DIR_ . 'nacex/docs/';
        $this->filenames = [
            'Nacex_Prestashop_Configuracion.pdf',
            'Nacex_Prestashop_GeneracionMasiva.pdf',
            'Nacex_Prestashop_GenerarExpedicion.pdf',
            'Nacex_Prestashop_Listado.pdf',
            'Nacex_Prestashop_TrackingNumber.pdf'
        ];

        $this->ndto = new NacexDTO();
        $this->fb = new NacexFeedback();
    }

    public function setMedia($isNewTheme = false)
    {
        $this->addCSS(_MODULE_DIR_ . 'nacex/css/nacex-rss.css', 'all', NULL, true);
        $this->addCSS(_MODULE_DIR_ . 'nacex/css/nacex.css', 'all', NULL, true);
        parent::setMedia();
    }

    public function initContent()
    {
        $this->context->smarty->assign(array(
            'module_root' => _MODULE_DIR_ . 'nacex',
            'ncx_logo200url' => $this->ncx_logo200url,
            'filepath' => $this->filpath,
            'filenames' => $this->filenames,
            'ndto' => $this->ndto,
            'fb' => $this->fb,
            'loader_img' => _MODULE_DIR_ . 'nacex/images/loading.gif'
        ));

        $this->setTemplate('feedback.tpl');

        parent::initContent();

    }
}
?>