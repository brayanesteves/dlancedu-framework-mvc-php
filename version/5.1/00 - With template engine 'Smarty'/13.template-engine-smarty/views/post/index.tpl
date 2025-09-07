<h2>Últimos Posts</h2>
{if isset($posts) && count($posts)}
<table>
    {foreach item=datos from=$posts}
    <tr>
        <td>{$datos.id}</td>
        <td>{$datos.titulo}</td>
        <td>{$datos.cuerpo}</td>
        <td>
            <a href="{$_layoutParams.root}post/editar/{$datos.id}">Editar</a>
            <a href="{$_layoutParams.root}post/eliminar/{$datos.id}">Eliminar</a>
        </td>
    </tr>
    {/foreach}
</table>
{else}
<p>
    <strong>¡No ahi <b>posts</b>!</strong>
</p>
{/if}

{if isset($paginacion)}
{$paginacion}
{/if}

{if Session::accesoViewEstricto(array('especial'))}
<p>
    <a href="{$_layoutParams.root}post/nuevo">Agregar Post</a>
</p>
{/if}