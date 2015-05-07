<?php

/* home.html.twig */
class __TwigTemplate_a057d015d4ea1f87a695915b2b4d26e46563b5b3874b9c79888cb0bb56b7f949 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->blocks = array(
            'title' => array($this, 'block_title'),
            'content' => array($this, 'block_content'),
        );
    }

    protected function doGetParent(array $context)
    {
        // line 1
        return $this->loadTemplate((($this->getAttribute((isset($context["request"]) ? $context["request"] : null), "ajax", array())) ? ("base_ajax.html.twig") : ("base.html.twig")), "home.html.twig", 1);
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $this->getParent($context)->display($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    public function block_title($context, array $blocks = array())
    {
        echo twig_escape_filter($this->env, twig_title_string_filter($this->env, (isset($context["page_title"]) ? $context["page_title"] : null)), "html", null, true);
    }

    // line 5
    public function block_content($context, array $blocks = array())
    {
        // line 6
        echo "    <h1>Start</h1>
    <p class=\"lead\">Is a mixture of smaller framework components better than one large one?</p>
    <ul>
    \t<li>Create base framework</li>
    \t<li>Create Tests</li>
    \t<li>CRUD</li>
    \t<li>Speed Tests</li>
    \t<li>Backups</li>
    \t<li>Restore</li>
    \t<li>Size limitations</li>
    </ul>
";
    }

    public function getTemplateName()
    {
        return "home.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  37 => 6,  34 => 5,  28 => 3,  19 => 1,);
    }
}
