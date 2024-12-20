<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="en">
<head>
    <title><?php if(isset($this->titulo)) echo $this->titulo; ?></title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf8" />
    <link href="<?php echo $_layoutParams['ruta_css']; ?>estilos.css" rel="stylesheet" type="text/css" />
</head>
<body>
    <div id="main">
        <div id="header">
            <h1><?php echo APP_NAME; ?></h1>
        </div>

        <div id="menu_top">
            <ul>
                <?php if(isset($_layoutParams['menu'])): ?>
                    <?php for($i = 0; $i < count($_layoutParams['menu']); $i++): ?>
                    <li><a href="<?php echo $_layoutParams['menu'][$i]['enlace']; ?>"><?php echo $_layoutParams['menu'][$i]['titulo']; ?></a></li>
                    <?php endfor; ?>
                <?php endif; ?>
            </ul>
        </div>