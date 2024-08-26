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

/* @PrestaShop/Admin/Common/Grid/Columns/Content/shop_list.html.twig */
class __TwigTemplate_79c9d8d757794a576a1d3b28938804ad extends Template
{
    private $source;
    private $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->parent = false;

        $this->blocks = [
        ];
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 25
        echo "
";
        // line 27
        $context["shopsIds"] = (($__internal_compile_0 = ($context["record"] ?? null)) && is_array($__internal_compile_0) || $__internal_compile_0 instanceof ArrayAccess ? ($__internal_compile_0[twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["column"] ?? null), "options", [], "any", false, false, false, 27), "ids_field", [], "any", false, false, false, 27)] ?? null) : null);
        // line 28
        $context["shops"] = (($__internal_compile_1 = ($context["record"] ?? null)) && is_array($__internal_compile_1) || $__internal_compile_1 instanceof ArrayAccess ? ($__internal_compile_1[twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["column"] ?? null), "options", [], "any", false, false, false, 28), "field", [], "any", false, false, false, 28)] ?? null) : null);
        // line 29
        $context["productId"] = (($__internal_compile_2 = ($context["record"] ?? null)) && is_array($__internal_compile_2) || $__internal_compile_2 instanceof ArrayAccess ? ($__internal_compile_2[twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["column"] ?? null), "options", [], "any", false, false, false, 29), "product_id_field", [], "any", false, false, false, 29)] ?? null) : null);
        // line 30
        $context["allShops"] = twig_join_filter(($context["shops"] ?? null), ", ");
        // line 31
        echo "
";
        // line 32
        $context["routeParams"] = ["productId" => ($context["productId"] ?? null)];
        // line 33
        if ( !(null === twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["column"] ?? null), "options", [], "any", false, false, false, 33), "shop_group_id", [], "any", false, false, false, 33))) {
            // line 34
            echo "  ";
            $context["routeParams"] = twig_array_merge(($context["routeParams"] ?? null), ["shopGroupId" => twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["column"] ?? null), "options", [], "any", false, false, false, 34), "shop_group_id", [], "any", false, false, false, 34)]);
        }
        // line 36
        echo "
<span class=\"product-shop-list\" title=\"";
        // line 37
        echo twig_escape_filter($this->env, ($context["allShops"] ?? null), "html", null, true);
        echo "\" data-shop-ids=\"";
        echo twig_escape_filter($this->env, twig_join_filter(($context["shopsIds"] ?? null), ","), "html", null, true);
        echo "\">
  <div class=\"product-shop-list-names\">
    ";
        // line 39
        $context["firstShop"] = (($__internal_compile_3 = ($context["shops"] ?? null)) && is_array($__internal_compile_3) || $__internal_compile_3 instanceof ArrayAccess ? ($__internal_compile_3[0] ?? null) : null);
        // line 40
        echo "    <strong>";
        echo twig_escape_filter($this->env, ($context["firstShop"] ?? null), "html", null, true);
        echo "</strong>";
        // line 41
        if ((twig_length_filter($this->env, ($context["shops"] ?? null)) > 1)) {
            // line 42
            echo ",
      ";
            // line 43
            $context["otherShops"] = twig_join_filter(twig_slice($this->env, ($context["shops"] ?? null), 1, twig_length_filter($this->env, ($context["shops"] ?? null))), ", ");
            // line 44
            echo "      ";
            // line 45
            echo "      ";
            if (((twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["column"] ?? null), "options", [], "any", false, false, false, 45), "max_displayed_characters", [], "any", false, false, false, 45) > 0) && (twig_length_filter($this->env, ($context["allShops"] ?? null)) > twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["column"] ?? null), "options", [], "any", false, false, false, 45), "max_displayed_characters", [], "any", false, false, false, 45)))) {
                // line 46
                echo "        ";
                echo twig_escape_filter($this->env, twig_slice($this->env, ($context["otherShops"] ?? null), 0, (twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["column"] ?? null), "options", [], "any", false, false, false, 46), "max_displayed_characters", [], "any", false, false, false, 46) - twig_length_filter($this->env, ($context["firstShop"] ?? null)))), "html", null, true);
                echo "&mldr;
      ";
            } else {
                // line 48
                echo "        ";
                echo twig_escape_filter($this->env, ($context["otherShops"] ?? null), "html", null, true);
                echo "
      ";
            }
        }
        // line 51
        echo "</div>";
        // line 52
        if ((twig_length_filter($this->env, ($context["shops"] ?? null)) > 1)) {
            // line 53
            echo "<div
      class=\"product-shop-details-toggle\"
      data-product-id=\"";
            // line 55
            echo twig_escape_filter($this->env, ($context["productId"] ?? null), "html", null, true);
            echo "\"
      data-shop-previews-url=\"";
            // line 56
            echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("admin_products_grid_shop_previews", ($context["routeParams"] ?? null)), "html", null, true);
            echo "\"
    >
    </div>
  ";
        }
        // line 60
        echo "</span>
";
    }

    public function getTemplateName()
    {
        return "@PrestaShop/Admin/Common/Grid/Columns/Content/shop_list.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  119 => 60,  112 => 56,  108 => 55,  104 => 53,  102 => 52,  100 => 51,  93 => 48,  87 => 46,  84 => 45,  82 => 44,  80 => 43,  77 => 42,  75 => 41,  71 => 40,  69 => 39,  62 => 37,  59 => 36,  55 => 34,  53 => 33,  51 => 32,  48 => 31,  46 => 30,  44 => 29,  42 => 28,  40 => 27,  37 => 25,);
    }

    public function getSourceContext()
    {
        return new Source("", "@PrestaShop/Admin/Common/Grid/Columns/Content/shop_list.html.twig", "/home/asw200923/beta/src/PrestaShopBundle/Resources/views/Admin/Common/Grid/Columns/Content/shop_list.html.twig");
    }
}
