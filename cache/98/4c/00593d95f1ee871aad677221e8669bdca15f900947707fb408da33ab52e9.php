<?php

/* base.html.twig */
class __TwigTemplate_984c00593d95f1ee871aad677221e8669bdca15f900947707fb408da33ab52e9 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
            'head' => array($this, 'block_head'),
            'title' => array($this, 'block_title'),
            'content' => array($this, 'block_content'),
            'footer' => array($this, 'block_footer'),
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        echo "<!DOCTYPE html>
<html>
<head>
";
        // line 4
        $this->displayBlock('head', $context, $blocks);
        // line 8
        echo "</head>

<body>
<div class=\"container\">
\t<div id=\"content\">";
        // line 12
        $this->displayBlock('content', $context, $blocks);
        echo "</div>
\t<div id=\"footer\">
\t    ";
        // line 14
        $this->displayBlock('footer', $context, $blocks);
        // line 17
        echo "\t</div>
</div>
</body>
</html>";
    }

    // line 4
    public function block_head($context, array $blocks = array())
    {
        // line 5
        echo "\t<link href=\"//maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css\" rel=\"stylesheet\">
    <title>";
        // line 6
        $this->displayBlock('title', $context, $blocks);
        echo "</title>
";
    }

    public function block_title($context, array $blocks = array())
    {
    }

    // line 12
    public function block_content($context, array $blocks = array())
    {
    }

    // line 14
    public function block_footer($context, array $blocks = array())
    {
        // line 15
        echo "\t        &copy; '15 <a href=\"http://emrys.cymru/\">em</a>.
\t    ";
    }

    public function getTemplateName()
    {
        return "base.html.twig";
    }

    public function getDebugInfo()
    {
        return array (  74 => 15,  71 => 14,  66 => 12,  56 => 6,  53 => 5,  50 => 4,  43 => 17,  41 => 14,  36 => 12,  30 => 8,  28 => 4,  23 => 1,);
    }
}
