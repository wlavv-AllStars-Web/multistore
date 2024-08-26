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

/* @PrestaShop/Admin/Configure/AdvancedParameters/Employee/FormTheme/employee_options.html.twig */
class __TwigTemplate_58bfb191236a48f6c29f778dbbe6ad58 extends Template
{
    private $source;
    private $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->parent = false;

        $this->blocks = [
            'employee_options_row' => [$this, 'block_employee_options_row'],
            'form_alert' => [$this, 'block_form_alert'],
        ];
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 25
        echo "
";
        // line 27
        $this->displayBlock('employee_options_row', $context, $blocks);
        // line 70
        $this->displayBlock('form_alert', $context, $blocks);
    }

    // line 27
    public function block_employee_options_row($context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 28
        ob_start(function () { return ''; });
        // line 29
        echo "    ";
        // line 30
        echo "    ";
        if (array_key_exists("label_tag_name", $context)) {
            // line 31
            echo "      ";
            echo $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(($context["form"] ?? null), 'label');
            echo "
    ";
        }
        // line 33
        echo "
    ";
        // line 34
        $macros["ps"] = $this->loadTemplate("@PrestaShop/Admin/macros.html.twig", "@PrestaShop/Admin/Configure/AdvancedParameters/Employee/FormTheme/employee_options.html.twig", 34)->unwrap();
        // line 35
        echo "    ";
        $context["disabledField"] = false;
        // line 36
        echo "    ";
        if ((twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["form"] ?? null), "vars", [], "any", false, true, false, 36), "attr", [], "any", false, true, false, 36), "disabled", [], "any", true, true, false, 36) && twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["form"] ?? null), "vars", [], "any", false, false, false, 36), "attr", [], "any", false, false, false, 36), "disabled", [], "any", false, false, false, 36))) {
            // line 37
            echo "      ";
            $context["disabledField"] = true;
            // line 38
            echo "    ";
        }
        // line 39
        echo "
    <div class=\"";
        // line 40
        $this->displayBlock("form_row_class", $context, $blocks);
        $this->displayBlock("widget_type_class", $context, $blocks);
        if ((( !($context["compound"] ?? null) || ((array_key_exists("force_error", $context)) ? (_twig_default_filter(($context["force_error"] ?? null), false)) : (false))) &&  !($context["valid"] ?? null))) {
            echo " has-error";
        }
        if ((twig_get_attribute($this->env, $this->source, ($context["attr"] ?? null), "visible", [], "any", true, true, false, 40) &&  !twig_get_attribute($this->env, $this->source, ($context["attr"] ?? null), "visible", [], "any", false, false, false, 40))) {
            echo " d-none";
        }
        echo "\">
      ";
        // line 41
        $context["multistoreCheckboxName"] = (($context["multistore_field_prefix"] ?? null) . twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["form"] ?? null), "vars", [], "any", false, false, false, 41), "name", [], "any", false, false, false, 41));
        // line 42
        echo "      ";
        if (twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["form"] ?? null), "parent", [], "any", false, true, false, 42), ($context["multistoreCheckboxName"] ?? null), [], "any", true, true, false, 42)) {
            // line 43
            echo "        ";
            echo $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["form"] ?? null), "parent", [], "any", false, false, false, 43), ($context["multistoreCheckboxName"] ?? null), [], "any", false, false, false, 43), 'errors');
            echo "
        ";
            // line 44
            echo $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["form"] ?? null), "parent", [], "any", false, false, false, 44), ($context["multistoreCheckboxName"] ?? null), [], "any", false, false, false, 44), 'widget');
            echo "
      ";
        }
        // line 46
        echo "
      ";
        // line 47
        if ( !array_key_exists("label_tag_name", $context)) {
            // line 48
            echo "        ";
            echo $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(($context["form"] ?? null), 'label');
            echo "
      ";
        }
        // line 50
        echo "      <div class=\"";
        $this->displayBlock("form_group_class", $context, $blocks);
        if (($context["disabledField"] ?? null)) {
            echo " disabled";
        }
        echo "\">
        ";
        // line 51
        echo $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(($context["form"] ?? null), 'widget');
        echo "
        ";
        // line 53
        echo "        ";
        echo $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(($context["form"] ?? null), 'errors', ["attr" => ["fieldError" => true]]);
        // line 54
        $this->displayBlock("form_alert", $context, $blocks);
        // line 55
        echo "</div>
      ";
        // line 56
        if ((twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["form"] ?? null), "parent", [], "any", false, true, false, 56), twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["form"] ?? null), "vars", [], "any", false, false, false, 56), "name", [], "any", false, false, false, 56), [], "any", true, true, false, 56) && (twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["form"] ?? null), "parent", [], "any", false, false, false, 56), twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["form"] ?? null), "vars", [], "any", false, false, false, 56), "name", [], "any", false, false, false, 56), [], "any", false, false, false, 56), "vars", [], "any", false, false, false, 56), "multistore_dropdown", [], "any", false, false, false, 56) != false))) {
            // line 57
            echo "        ";
            echo twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["form"] ?? null), "parent", [], "any", false, false, false, 57), twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["form"] ?? null), "vars", [], "any", false, false, false, 57), "name", [], "any", false, false, false, 57), [], "any", false, false, false, 57), "vars", [], "any", false, false, false, 57), "multistore_dropdown", [], "any", false, false, false, 57);
            echo "
      ";
        }
        // line 60
        $this->displayBlock("form_external_link", $context, $blocks);
        // line 61
        echo "</div>
  ";
        $___internal_parse_0_ = ('' === $tmp = ob_get_clean()) ? '' : new Markup($tmp, $this->env->getCharset());
        // line 28
        echo twig_spaceless($___internal_parse_0_);
        // line 63
        echo "
  ";
        // line 64
        if (($context["column_breaker"] ?? null)) {
            // line 65
            echo "    <div class=\"form-group form-column-breaker\"></div>
  ";
        }
    }

    // line 70
    public function block_form_alert($context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 71
        if (array_key_exists("alert_message", $context)) {
            // line 72
            echo "    <div class=\"alert alert-";
            echo twig_escape_filter($this->env, ($context["alert_type"] ?? null), "html", null, true);
            if (array_key_exists("alert_title", $context)) {
                echo " expandable-alert";
            }
            echo " mt-1\" role=\"alert\">
      ";
            // line 73
            if (array_key_exists("alert_title", $context)) {
                // line 74
                echo "        <p class=\"alert-text\">
          ";
                // line 75
                echo ($context["alert_title"] ?? null);
                echo "
        </p>
      ";
            } else {
                // line 78
                echo "        ";
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable(($context["alert_message"] ?? null));
                foreach ($context['_seq'] as $context["_key"] => $context["message"]) {
                    // line 79
                    echo "          <p class=\"alert-text\">
            ";
                    // line 80
                    echo $context["message"];
                    echo "
          </p>
        ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['message'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 83
                echo "      ";
            }
            // line 84
            echo "
      ";
            // line 85
            if (array_key_exists("alert_title", $context)) {
                // line 86
                echo "        <div class=\"alert-more collapse\" id=\"expandable_";
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["form"] ?? null), "vars", [], "any", false, false, false, 86), "id", [], "any", false, false, false, 86), "html", null, true);
                echo "\" style=\"\">
          ";
                // line 87
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable(($context["alert_message"] ?? null));
                foreach ($context['_seq'] as $context["_key"] => $context["message"]) {
                    // line 88
                    echo "            <p>
              ";
                    // line 89
                    echo $context["message"];
                    echo "
            </p>
          ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['message'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 92
                echo "        </div>
        <div class=\"read-more-container\">
          <button type=\"button\" class=\"read-more btn-link\" data-toggle=\"collapse\" data-target=\"#expandable_";
                // line 94
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["form"] ?? null), "vars", [], "any", false, false, false, 94), "id", [], "any", false, false, false, 94), "html", null, true);
                echo "\" aria-expanded=\"true\" aria-controls=\"collapseDanger\">
            ";
                // line 95
                echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\TranslationExtension']->trans("Read more", [], "Admin.Actions"), "html", null, true);
                echo "
          </button>
        </div>
      ";
            }
            // line 99
            echo "    </div>
  ";
        }
    }

    public function getTemplateName()
    {
        return "@PrestaShop/Admin/Configure/AdvancedParameters/Employee/FormTheme/employee_options.html.twig";
    }

    public function getDebugInfo()
    {
        return array (  255 => 99,  248 => 95,  244 => 94,  240 => 92,  231 => 89,  228 => 88,  224 => 87,  219 => 86,  217 => 85,  214 => 84,  211 => 83,  202 => 80,  199 => 79,  194 => 78,  188 => 75,  185 => 74,  183 => 73,  175 => 72,  173 => 71,  169 => 70,  163 => 65,  161 => 64,  158 => 63,  156 => 28,  152 => 61,  150 => 60,  144 => 57,  142 => 56,  139 => 55,  137 => 54,  134 => 53,  130 => 51,  122 => 50,  116 => 48,  114 => 47,  111 => 46,  106 => 44,  101 => 43,  98 => 42,  96 => 41,  85 => 40,  82 => 39,  79 => 38,  76 => 37,  73 => 36,  70 => 35,  68 => 34,  65 => 33,  59 => 31,  56 => 30,  54 => 29,  52 => 28,  48 => 27,  44 => 70,  42 => 27,  39 => 25,);
    }

    public function getSourceContext()
    {
        return new Source("", "@PrestaShop/Admin/Configure/AdvancedParameters/Employee/FormTheme/employee_options.html.twig", "/home/asw200923/beta/src/PrestaShopBundle/Resources/views/Admin/Configure/AdvancedParameters/Employee/FormTheme/employee_options.html.twig");
    }
}
