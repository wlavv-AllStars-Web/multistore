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

/* @PrestaShop/Admin/Sell/Catalog/Product/shop_previews.html.twig */
class __TwigTemplate_7a8beaf5f59e509d53774176f08808e1 extends Template
{
    private $source;
    private $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->parent = false;

        $this->blocks = [
            'content' => [$this, 'block_content'],
        ];
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 25
        $this->displayBlock('content', $context, $blocks);
    }

    public function block_content($context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 26
        echo "  ";
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["shopDetailsGrid"] ?? null), "data", [], "any", false, false, false, 26), "records", [], "any", false, false, false, 26));
        foreach ($context['_seq'] as $context["_key"] => $context["record"]) {
            // line 27
            echo "    <tr class=\"shop-preview-row\" data-product-id=\"";
            echo twig_escape_filter($this->env, (($__internal_compile_0 = $context["record"]) && is_array($__internal_compile_0) || $__internal_compile_0 instanceof ArrayAccess ? ($__internal_compile_0["id_product"] ?? null) : null), "html", null, true);
            echo "\" data-shop-id=\"";
            echo twig_escape_filter($this->env, (($__internal_compile_1 = $context["record"]) && is_array($__internal_compile_1) || $__internal_compile_1 instanceof ArrayAccess ? ($__internal_compile_1["id_shop"] ?? null) : null), "html", null, true);
            echo "\">
      ";
            // line 28
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, ($context["shopDetailsGrid"] ?? null), "columns", [], "any", false, false, false, 28));
            foreach ($context['_seq'] as $context["_key"] => $context["column"]) {
                // line 29
                echo "        <td
          ";
                // line 30
                if ((twig_get_attribute($this->env, $this->source, $context["column"], "type", [], "any", false, false, false, 30) == "identifier")) {
                    echo "data-identifier=\"";
                    echo twig_escape_filter($this->env, (($__internal_compile_2 = $context["record"]) && is_array($__internal_compile_2) || $__internal_compile_2 instanceof ArrayAccess ? ($__internal_compile_2[twig_get_attribute($this->env, $this->source, $context["column"], "id", [], "any", false, false, false, 30)] ?? null) : null), "html", null, true);
                    echo "\"";
                }
                // line 31
                echo "          class=\"";
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["column"], "type", [], "any", false, false, false, 31), "html", null, true);
                echo "-type column-";
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["column"], "id", [], "any", false, false, false, 31), "html", null, true);
                if ((twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, $context["column"], "options", [], "any", false, true, false, 31), "clickable", [], "any", true, true, false, 31) && twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, $context["column"], "options", [], "any", false, false, false, 31), "clickable", [], "any", false, false, false, 31))) {
                    echo " clickable";
                }
                if ((twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, $context["column"], "options", [], "any", false, true, false, 31), "alignment", [], "any", true, true, false, 31) && twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, $context["column"], "options", [], "any", false, false, false, 31), "alignment", [], "any", false, false, false, 31))) {
                    echo " text-";
                    echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, $context["column"], "options", [], "any", false, false, false, 31), "alignment", [], "any", false, false, false, 31), "html", null, true);
                }
                echo "\"
        >
          ";
                // line 33
                echo $this->extensions['PrestaShopBundle\Twig\Extension\GridExtension']->renderColumnContent($context["record"], $context["column"], ($context["shopDetailsGrid"] ?? null));
                echo "
        </td>
      ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['column'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 36
            echo "    </tr>
  ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['record'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
    }

    public function getTemplateName()
    {
        return "@PrestaShop/Admin/Sell/Catalog/Product/shop_previews.html.twig";
    }

    public function getDebugInfo()
    {
        return array (  94 => 36,  85 => 33,  70 => 31,  64 => 30,  61 => 29,  57 => 28,  50 => 27,  45 => 26,  38 => 25,);
    }

    public function getSourceContext()
    {
        return new Source("", "@PrestaShop/Admin/Sell/Catalog/Product/shop_previews.html.twig", "/home/asw200923/beta/src/PrestaShopBundle/Resources/views/Admin/Sell/Catalog/Product/shop_previews.html.twig");
    }
}
