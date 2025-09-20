<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="en">
<head>
    <title>{$titulo | default : "Sin titulo"}</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf8" />
    <link href="{$_layoutParams.ruta_css}estilos.css" rel="stylesheet" type="text/css" />
</head>
<body>
    <div id="main">
        <div id="header">
            <h1>{$_layoutParams.configs.app_name}</h1>
        </div>

        <noscript>
            <p>Para el correcto funcionamiento, debe tener el soporte de JavaScript habilitado.</p>            
        </noscript>
        {if isset($_error)}
        <div id="error" class="error">{$_error}</div>
        {/if}

        {if isset($_mensaje)}
        <div id="mensaje" class="mensaje">{$_mensaje}</div>
        {/if}

        <div id="menu_top">
            <ul>
                {if isset($_layoutParams.menu)}
                    {foreach item = it from = $_layoutParams.menu}
                        {if isset($_layoutParams.item) && $_layoutParams.item == $it.id}
                            {assign var="_item_style" value="current"}
                        {else}
                            {assign var="_item_style" value=""}
                        {/if}
                    <li><a class="{$_item_style}" href="{$it.enlace}">{$it.titulo}</a></li>
                    {/foreach}
                {/if}
            </ul>
        </div>

        {include file=$_contenido}

        <div id="footer">
            Copyright &copy; 2012 {$_layoutParams.configs.app_company}
        </div>
    </div>

    <script src="{$_layoutParams.root}libs/jquery/version/1.7.1/js/jquery-1.7.1.js" type="text/javascript"></script>
    <script src="{$_layoutParams.root}libs/jquery-plugin/jquery-validation/version/1.9.0/js/jquery.validate.js" type="text/javascript"></script>
    {if isset($_layoutParams.js) && count($_layoutParams.js)}
    {foreach item = js from = $_layoutParams.js}
    <script src="{$js}" type="text/javascript"></script>
    {/foreach}
    {/if}
</body>
</html>