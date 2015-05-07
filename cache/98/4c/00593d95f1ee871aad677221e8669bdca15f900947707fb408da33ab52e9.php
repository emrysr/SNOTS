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
<html lang=\"en\">

<head>
";
        // line 5
        $this->displayBlock('head', $context, $blocks);
        // line 13
        echo "
    <meta charset=\"utf-8\">
    <meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge\">
    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1\">
    <meta name=\"description\" content=\"\">
    <meta name=\"author\" content=\"\">

    <title>";
        // line 20
        $this->displayBlock('title', $context, $blocks);
        echo "</title>

    <!-- Bootstrap Core CSS -->
    <link href=\"css/bootstrap.min.css\" rel=\"stylesheet\">

    <!-- Custom CSS -->
    <style>
    body {
        padding-top: 70px;
        /* Required padding for .navbar-fixed-top. Remove if using .navbar-static-top. Change if height of navigation changes. */
    }
    </style>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src=\"https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js\"></script>
        <script src=\"https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js\"></script>
    <![endif]-->

</head>

<body>

    <!-- Navigation -->
    <nav class=\"navbar navbar-inverse navbar-fixed-top\" role=\"navigation\">
        <div class=\"container\">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class=\"navbar-header\">
                <button type=\"button\" class=\"navbar-toggle\" data-toggle=\"collapse\" data-target=\"#bs-example-navbar-collapse-1\">
                    <span class=\"sr-only\">Toggle navigation</span>
                    <span class=\"icon-bar\"></span>
                    <span class=\"icon-bar\"></span>
                    <span class=\"icon-bar\"></span>
                </button>
                <a class=\"navbar-brand\" href=\"#\">Slim|NotORM|Twig|SQLite</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class=\"collapse navbar-collapse\" id=\"bs-example-navbar-collapse-1\">
                <ul class=\"nav navbar-nav\">
                    <li>
                        <a href=\"#\">Create</a>
                    </li>
                    <li>
                        <a href=\"#\">Read</a>
                    </li>
                    <li>
                        <a href=\"#\">Update</a>
                    </li>
                    <li>
                        <a href=\"#\">Delete</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>

    <!-- Page Content -->
    <div class=\"container\">

        <div class=\"row\">
            <div class=\"col-lg-12 text-center\">
                ";
        // line 84
        $this->displayBlock('content', $context, $blocks);
        // line 85
        echo "            </div>
        </div>
        <!-- /.row -->

    </div>
    <!-- /.container -->

\t<div id=\"footer\">
\t    ";
        // line 93
        $this->displayBlock('footer', $context, $blocks);
        // line 96
        echo "\t</div>

    <!-- jQuery Version 1.11.1 -->
    <script src=\"js/jquery.js\"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src=\"js/bootstrap.min.js\"></script>

</body>

</html>
";
    }

    // line 5
    public function block_head($context, array $blocks = array())
    {
        // line 6
        echo "\t<!-- 
\t ";
        // line 7
        echo twig_escape_filter($this->env, $this->env->getExtension('slim')->currentUrl(), "html", null, true);
        echo "
\t ";
        // line 8
        echo twig_escape_filter($this->env, $this->env->getExtension('slim')->base(), "html", null, true);
        echo " 
\t ";
        // line 9
        echo twig_escape_filter($this->env, $this->env->getExtension('slim')->site("/about/me"), "html", null, true);
        echo "
\t <a href=\"";
        // line 10
        echo twig_escape_filter($this->env, $this->env->getExtension('slim')->urlFor("dash", array("name" => $this->getAttribute((isset($context["person"]) ? $context["person"] : null), "name", array()), "age" => $this->getAttribute((isset($context["person"]) ? $context["person"] : null), "age", array()))), "html", null, true);
        echo "\">Hello ";
        echo twig_escape_filter($this->env, (isset($context["name"]) ? $context["name"] : null), "html", null, true);
        echo "</a>
\t -->
";
    }

    // line 20
    public function block_title($context, array $blocks = array())
    {
    }

    // line 84
    public function block_content($context, array $blocks = array())
    {
    }

    // line 93
    public function block_footer($context, array $blocks = array())
    {
        // line 94
        echo "\t        &copy; '15 <a href=\"http://emrys.cymru/\">em</a>.
\t    ";
    }

    public function getTemplateName()
    {
        return "base.html.twig";
    }

    public function getDebugInfo()
    {
        return array (  176 => 94,  173 => 93,  168 => 84,  163 => 20,  154 => 10,  150 => 9,  146 => 8,  142 => 7,  139 => 6,  136 => 5,  121 => 96,  119 => 93,  109 => 85,  107 => 84,  40 => 20,  31 => 13,  29 => 5,  23 => 1,);
    }
}
