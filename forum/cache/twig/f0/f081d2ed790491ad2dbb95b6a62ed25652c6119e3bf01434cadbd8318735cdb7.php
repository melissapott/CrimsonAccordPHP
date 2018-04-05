<?php

/* login_body_oauth.html */
class __TwigTemplate_f8219057a25404599ef241d28c53bc5924ff4916d49ac97db03f11cd3ff5f33e extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        echo "<div class=\"content\">
\t";
        // line 2
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute((isset($context["loops"]) ? $context["loops"] : null), "oauth", array()));
        foreach ($context['_seq'] as $context["_key"] => $context["oauth"]) {
            // line 3
            echo "\t<dl>
\t\t<dt>&nbsp;</dt>
\t\t<dd><a href=\"";
            // line 5
            echo $this->getAttribute($context["oauth"], "REDIRECT_URL", array());
            echo "\" class=\"button2\">";
            echo $this->getAttribute($context["oauth"], "SERVICE_NAME", array());
            echo "</a></dd>
\t</dl>
\t";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['oauth'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 8
        echo "</div>
";
    }

    public function getTemplateName()
    {
        return "login_body_oauth.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  41 => 8,  30 => 5,  26 => 3,  22 => 2,  19 => 1,);
    }
}
/* <div class="content">*/
/* 	<!-- BEGIN oauth -->*/
/* 	<dl>*/
/* 		<dt>&nbsp;</dt>*/
/* 		<dd><a href="{oauth.REDIRECT_URL}" class="button2">{oauth.SERVICE_NAME}</a></dd>*/
/* 	</dl>*/
/* 	<!-- END oauth -->*/
/* </div>*/
/* */
