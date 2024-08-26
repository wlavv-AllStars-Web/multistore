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

/* @PrestaShop/Admin/Common/Grid/Columns/Content/data.html.twig */
class __TwigTemplate_d76c14a0dc4f1a49a04e1daedd70d8fe extends Template
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
        // line 19
        if (((twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["column"] ?? null), "options", [], "any", false, false, false, 19), "field", [], "any", false, false, false, 19) == "seo_score") || (twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["column"] ?? null), "options", [], "any", false, false, false, 19), "field", [], "any", false, false, false, 19) == "readability_score"))) {
            // line 20
            echo "    <span class=\"ets_seo_col_center\">";
            echo (($__internal_compile_0 = ($context["record"] ?? null)) && is_array($__internal_compile_0) || $__internal_compile_0 instanceof ArrayAccess ? ($__internal_compile_0[twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["column"] ?? null), "options", [], "any", false, false, false, 20), "field", [], "any", false, false, false, 20)] ?? null) : null);
            echo "</span>
";
        } elseif (((twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source,         // line 21
($context["column"] ?? null), "options", [], "any", false, false, false, 21), "field", [], "any", false, false, false, 21) == "is_verified") || (twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["column"] ?? null), "options", [], "any", false, false, false, 21), "field", [], "any", false, false, false, 21) == "last_free_download"))) {
            // line 22
            echo "    <span class=\"ets_fd_col_center\">";
            echo (($__internal_compile_1 = ($context["record"] ?? null)) && is_array($__internal_compile_1) || $__internal_compile_1 instanceof ArrayAccess ? ($__internal_compile_1[twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["column"] ?? null), "options", [], "any", false, false, false, 22), "field", [], "any", false, false, false, 22)] ?? null) : null);
            echo "</span>
";
        } elseif ((($__internal_compile_2 =         // line 23
($context["record"] ?? null)) && is_array($__internal_compile_2) || $__internal_compile_2 instanceof ArrayAccess ? ($__internal_compile_2[twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["column"] ?? null), "options", [], "any", false, false, false, 23), "field", [], "any", false, false, false, 23)] ?? null) : null)) {
            // line 24
            echo "    ";
            echo (($__internal_compile_3 = ($context["record"] ?? null)) && is_array($__internal_compile_3) || $__internal_compile_3 instanceof ArrayAccess ? ($__internal_compile_3[twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["column"] ?? null), "options", [], "any", false, false, false, 24), "field", [], "any", false, false, false, 24)] ?? null) : null);
            echo "
    ";
            // line 25
            if (((twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["column"] ?? null), "options", [], "any", false, false, false, 25), "field", [], "any", false, false, false, 25) == "id_customer") && twig_get_attribute($this->env, $this->source, ($context["record"] ?? null), "create_social", [], "array", true, true, false, 25))) {
                // line 26
                echo "        ";
                if (((($__internal_compile_4 = ($context["record"] ?? null)) && is_array($__internal_compile_4) || $__internal_compile_4 instanceof ArrayAccess ? ($__internal_compile_4["create_social"] ?? null) : null) == 1)) {
                    // line 27
                    echo "            <span title=\"";
                    echo twig_escape_filter($this->env, ($context["text_ets_opc_create_paypal"] ?? null), "html", null, true);
                    echo "\" class=\"create_social paypal\"><svg  viewBox=\"0 0 1792 1792\" xmlns=\"http://www.w3.org/2000/svg\"><path d=\"M1647 646q18 84-4 204-87 444-565 444h-44q-25 0-44 16.5t-24 42.5l-4 19-55 346-2 15q-5 26-24.5 42.5t-44.5 16.5h-251q-21 0-33-15t-9-36q9-56 26.5-168t26.5-168 27-167.5 27-167.5q5-37 43-37h131q133 2 236-21 175-39 287-144 102-95 155-246 24-70 35-133 1-6 2.5-7.5t3.5-1 6 3.5q79 59 98 162zm-172-282q0 107-46 236-80 233-302 315-113 40-252 42 0 1-90 1l-90-1q-100 0-118 96-2 8-85 530-1 10-12 10h-295q-22 0-36.5-16.5t-11.5-38.5l232-1471q5-29 27.5-48t51.5-19h598q34 0 97.5 13t111.5 32q107 41 163.5 123t56.5 196z\"/></svg></span>  
        ";
                } elseif (((($__internal_compile_5 =                 // line 28
($context["record"] ?? null)) && is_array($__internal_compile_5) || $__internal_compile_5 instanceof ArrayAccess ? ($__internal_compile_5["create_social"] ?? null) : null) == 2)) {
                    // line 29
                    echo "            <span title=\"";
                    echo twig_escape_filter($this->env, ($context["text_ets_opc_create_facebook"] ?? null), "html", null, true);
                    echo "\" class=\"create_social facebook\"><svg  viewBox=\"0 0 1792 1792\" xmlns=\"http://www.w3.org/2000/svg\"><path d=\"M1343 12v264h-157q-86 0-116 36t-30 108v189h293l-39 296h-254v759h-306v-759h-255v-296h255v-218q0-186 104-288.5t277-102.5q147 0 228 12z\"/></svg></span>
        ";
                } elseif (((($__internal_compile_6 =                 // line 30
($context["record"] ?? null)) && is_array($__internal_compile_6) || $__internal_compile_6 instanceof ArrayAccess ? ($__internal_compile_6["create_social"] ?? null) : null) == 3)) {
                    // line 31
                    echo "            <span title=\"";
                    echo twig_escape_filter($this->env, ($context["text_ets_opc_create_google"] ?? null), "html", null, true);
                    echo "\" class=\"create_social google\"><svg  viewBox=\"0 0 1792 1792\" xmlns=\"http://www.w3.org/2000/svg\"><path d=\"M896 786h725q12 67 12 128 0 217-91 387.5t-259.5 266.5-386.5 96q-157 0-299-60.5t-245-163.5-163.5-245-60.5-299 60.5-299 163.5-245 245-163.5 299-60.5q300 0 515 201l-209 201q-123-119-306-119-129 0-238.5 65t-173.5 176.5-64 243.5 64 243.5 173.5 176.5 238.5 65q87 0 160-24t120-60 82-82 51.5-87 22.5-78h-436v-264z\"/></svg></span>
        ";
                }
                // line 33
                echo "    ";
            }
            // line 34
            echo "    ";
            if (((twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["column"] ?? null), "options", [], "any", false, false, false, 34), "field", [], "any", false, false, false, 34) == "connect") && twig_get_attribute($this->env, $this->source, ($context["record"] ?? null), "login_social", [], "array", true, true, false, 34))) {
                // line 35
                echo "        ";
                if (((($__internal_compile_7 = ($context["record"] ?? null)) && is_array($__internal_compile_7) || $__internal_compile_7 instanceof ArrayAccess ? ($__internal_compile_7["login_social"] ?? null) : null) == 1)) {
                    // line 36
                    echo "            <span title=\"";
                    echo twig_escape_filter($this->env, ($context["text_ets_opc_login_paypal"] ?? null), "html", null, true);
                    echo "\" class=\"create_social paypal\"><svg viewBox=\"0 0 1792 1792\" xmlns=\"http://www.w3.org/2000/svg\"><path d=\"M1647 646q18 84-4 204-87 444-565 444h-44q-25 0-44 16.5t-24 42.5l-4 19-55 346-2 15q-5 26-24.5 42.5t-44.5 16.5h-251q-21 0-33-15t-9-36q9-56 26.5-168t26.5-168 27-167.5 27-167.5q5-37 43-37h131q133 2 236-21 175-39 287-144 102-95 155-246 24-70 35-133 1-6 2.5-7.5t3.5-1 6 3.5q79 59 98 162zm-172-282q0 107-46 236-80 233-302 315-113 40-252 42 0 1-90 1l-90-1q-100 0-118 96-2 8-85 530-1 10-12 10h-295q-22 0-36.5-16.5t-11.5-38.5l232-1471q5-29 27.5-48t51.5-19h598q34 0 97.5 13t111.5 32q107 41 163.5 123t56.5 196z\"/></svg></span>  
        ";
                } elseif (((($__internal_compile_8 =                 // line 37
($context["record"] ?? null)) && is_array($__internal_compile_8) || $__internal_compile_8 instanceof ArrayAccess ? ($__internal_compile_8["login_social"] ?? null) : null) == 2)) {
                    // line 38
                    echo "            <span title=\"";
                    echo twig_escape_filter($this->env, ($context["text_ets_opc_login_facebook"] ?? null), "html", null, true);
                    echo "\" class=\"create_social facebook\"><svg viewBox=\"0 0 1792 1792\" xmlns=\"http://www.w3.org/2000/svg\"><path d=\"M1343 12v264h-157q-86 0-116 36t-30 108v189h293l-39 296h-254v759h-306v-759h-255v-296h255v-218q0-186 104-288.5t277-102.5q147 0 228 12z\"/></svg></span>
        ";
                } elseif (((($__internal_compile_9 =                 // line 39
($context["record"] ?? null)) && is_array($__internal_compile_9) || $__internal_compile_9 instanceof ArrayAccess ? ($__internal_compile_9["login_social"] ?? null) : null) == 3)) {
                    // line 40
                    echo "            <span title=\"";
                    echo twig_escape_filter($this->env, ($context["text_ets_opc_login_google"] ?? null), "html", null, true);
                    echo "\" class=\"create_social google\"><svg viewBox=\"0 0 1792 1792\" xmlns=\"http://www.w3.org/2000/svg\"><path d=\"M896 786h725q12 67 12 128 0 217-91 387.5t-259.5 266.5-386.5 96q-157 0-299-60.5t-245-163.5-163.5-245-60.5-299 60.5-299 163.5-245 245-163.5 299-60.5q300 0 515 201l-209 201q-123-119-306-119-129 0-238.5 65t-173.5 176.5-64 243.5 64 243.5 173.5 176.5 238.5 65q87 0 160-24t120-60 82-82 51.5-87 22.5-78h-436v-264z\"/></svg></span>
        ";
                }
                // line 42
                echo "    ";
            }
        } else {
            // line 44
            echo "    --
";
        }
    }

    public function getTemplateName()
    {
        return "@PrestaShop/Admin/Common/Grid/Columns/Content/data.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  116 => 44,  112 => 42,  106 => 40,  104 => 39,  99 => 38,  97 => 37,  92 => 36,  89 => 35,  86 => 34,  83 => 33,  77 => 31,  75 => 30,  70 => 29,  68 => 28,  63 => 27,  60 => 26,  58 => 25,  53 => 24,  51 => 23,  46 => 22,  44 => 21,  39 => 20,  37 => 19,);
    }

    public function getSourceContext()
    {
        return new Source("", "@PrestaShop/Admin/Common/Grid/Columns/Content/data.html.twig", "/home/asw200923/beta/modules/ets_onepagecheckout/views/PrestaShop/Admin/Common/Grid/Columns/Content/data.html.twig");
    }
}
