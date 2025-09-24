<h2>Prueba</h2>

<!-- <div>
    <form class="well well-small">
        Nombre: <input type="text" name="nombre" id="nombre" />
        <button type="button" id="btnEnviar" class="btn"><i class="icon-search"></i></button>

        <br /> <br />

        <select id="pais">
            <option value=""> - Seleccione pais - </option>
        </select>

        <select id="ciudad">
            <option value=""> - Seleccione ciudad - </option>
        </select>
    </form>
</div> -->

<div id="lista_registros">
    {if isset($posts) && count($posts)}
        <table class="table table-bordered table-condensed table-striped">
            <tr>
                <th>ID</th>
                <th>Nombre</th>
            </tr>

            {foreach item=datos from=$posts}
            <tr>
                <td>{$datos.id}</td>
                <td>{$datos.nombre}</td>
            </tr>
            {/foreach}
        </table>
    {else}
        <p>
            <strong>No hay posts!</strong>
        </p>
    {/if}

    {$paginacion|default:""}
</div>