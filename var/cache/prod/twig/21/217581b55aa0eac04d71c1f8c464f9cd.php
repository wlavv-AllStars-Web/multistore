<?php

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Extension\SandboxExtension;
use Twig\Markup;
use Twig\Sandbox\SecurityError;
use Twig\Sandbox\SecurityNotAllowedTagError;
use Twig\Sandbox\SecurityNotAllowedFilterError;
use Twig\Sandbox\SecurityNotAllowedFunctionError;
use Twig\Source;
use Twig\Template;

/* @PrestaShop/Admin/Improve/International/Language/index.html.twig */
class __TwigTemplate_89abe4f35387eef3505c1cdca132def2 extends Template
{
    private $source;
    private $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->blocks = [
            'content' => [$this, 'block_content'],
            'language_listing' => [$this, 'block_language_listing'],
            'javascripts' => [$this, 'block_javascripts'],
        ];
    }

    protected function doGetParent(array $context)
    {
        // line 36
        return "@PrestaShop/Admin/layout.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 26
        $context["layoutHeaderToolbarBtn"] = ["add" => ["href" => $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("admin_languages_create"), "desc" => $this->extensions['Symfony\Bridge\Twig\Extension\TranslationExtension']->trans("Add new language", [], "Admin.International.Feature"), "icon" => "add_circle_outline"]];
        // line 33
        $context["layoutTitle"] = $this->extensions['Symfony\Bridge\Twig\Extension\TranslationExtension']->trans("Languages", [], "Admin.Global");
        // line 34
        $context["enableSidebar"] = true;
        // line 36
        $this->parent = $this->loadTemplate("@PrestaShop/Admin/layout.html.twig", "@PrestaShop/Admin/Improve/International/Language/index.html.twig", 36);
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 38
    public function block_content($context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 39
        echo "  ";
        $this->loadTemplate("@PrestaShop/Admin/Common/multistore-infotip.html.twig", "@PrestaShop/Admin/Improve/International/Language/index.html.twig", 39)->display($context);
        // line 40
        echo "
  <div class=\"alert alert-warning\" role=\"alert\">
    <p class=\"alert-text\">";
        // line 42
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\TranslationExtension']->trans("When you delete a language, all related translations in the database will be deleted.", [], "Admin.International.Notification"), "html", null, true);
        echo "</p>
  </div>

  ";
        // line 45
        if ( !($context["isHtaccessFileWriter"] ?? null)) {
            // line 46
            echo "    <div class=\"alert alert-info\" role=\"alert\">
      <p class=\"alert-text\">";
            // line 47
            echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\TranslationExtension']->trans("Your .htaccess file must be writable.", [], "Admin.International.Notification"), "html", null, true);
            echo "</p>
    </div>
  ";
        }
        // line 50
        echo "

  ";
        // line 52
        $this->displayBlock('language_listing', $context, $blocks);
    }

    public function block_language_listing($context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 53
        echo "    ";
        $this->loadTemplate("@PrestaShop/Admin/Common/Grid/grid_panel.html.twig", "@PrestaShop/Admin/Improve/International/Language/index.html.twig", 53)->display(twig_array_merge($context, ["grid" => ($context["languageGrid"] ?? null)]));
        // line 54
        echo "  ";
    }

    // line 57
    public function block_javascripts($context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 58
        echo "  ";
        $this->displayParentBlock("javascripts", $context, $blocks);
        echo "

  <script src=\"";
        // line 60
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("themes/new-theme/public/language.bundle.js"), "html", null, true);
        echo "\"></script>
  <script src=\"";
        // line 61
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("themes/default/js/bundle/pagination.js"), "html", null, true);
        echo "\"></script>
";
    }

    public function getTemplateName()
    {
        return "@PrestaShop/Admin/Improve/International/Language/index.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  115 => 61,  111 => 60,  105 => 58,  101 => 57,  97 => 54,  94 => 53,  87 => 52,  83 => 50,  77 => 47,  74 => 46,  72 => 45,  66 => 42,  62 => 40,  59 => 39,  55 => 38,  50 => 36,  48 => 34,  46 => 33,  44 => 26,  37 => 36,);
    }

    public function getSourceContext()
    {
        return new Source("", "@PrestaShop/Admin/Improve/International/Language/index.html.twig", "/home/asw200923/beta/src/PrestaShopBundle/Resources/views/Admin/Improve/International/Language/index.html.twig");
    }
}
