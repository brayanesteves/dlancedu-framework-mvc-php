<form id="form1" method="POST" action="{$_layoutParams.root}post/nuevo" enctype="multipart/form-data">
    <input type="hidden" name="Guardar" value="1" />
    <p>
        Titulo:<br/>
        <input type="text" name="titulo" id="titulo" value="{$datos.titulo|default:""}" />
    </p>
    <p>
        Cuerpo:<br/>
        <textarea name="cuerpo" id="cuerpo">{$datos.cuerpo|default:""}</textarea>
    </p>

    <p>
        Imagen:<br/>
        <input type="file" name="imagen" id="imagen" />
    </p>

    <input type="submit" class="button" value="Guardar" />
</form>