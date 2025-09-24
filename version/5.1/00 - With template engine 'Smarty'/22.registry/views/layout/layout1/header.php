<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="en">
<head>
    <title><?php if(isset($this->titulo)) echo $this->titulo; ?></title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf8" />
    <link href="<?php echo $_layoutParams['ruta_css']; ?>style.css" rel="stylesheet" type="text/css" />
</head>
<body>
    <div id="dvmaincontainer">
    <!--main div container starts here-->

        <div id="dvtopcontainer">
        <!--top div container starts here-->
            <div id="dvlogocontainer">
            <!--logo div container starts here-->

                <h1><?php echo APP_NAME; ?></h1>
                <h1><?php echo APP_SLOGAN; ?></h1>
            <!--logo div container end here-->
            </div>

            <div id="dvnavicontainer">
            <!--navigation div container starts here-->
                <img src="<?php echo $_layoutParams['ruta_img'] ?>navi_left.jpg" alt="navi_left" />
                <div id="tabs1">
                    <ul>
                    <?php if(isset($_layoutParams['menu'])): ?>
                    <?php for($i = 0; $i < count($_layoutParams['menu']); $i++): ?>
                    <?php
                        if($item && $_layoutParams['menu'][$i]['id'] == $item) {
                            $_item_style = 'current';
                        } else {
                            $_item_style = '';
                        }
                    ?>
                        <li id="<?php echo $_item_style; ?>"><a href="<?php echo $_layoutParams['menu'][$i]['enlace']; ?>"><?php echo $_layoutParams['menu'][$i]['titulo']; ?></a></li>
                    <?php endfor; ?>
                    <?php endif; ?>
                    </ul>
                </div>

                <img src="<?php echo $_layoutParams['ruta_img'] ?>navi_right.jpg" alt="navi_right" />
            <!--navigation div container end here-->
            </div>
        </div>

        <?php if(isset($this->_error)): ?>
        <div id="error"><?php echo $this->_error; ?></div>
        <?php endif; ?>

        <?php if(isset($this->_mensaje)): ?>
        <div id="mensaje"><?php echo $this->_mensaje; ?></div>
        <?php endif; ?>