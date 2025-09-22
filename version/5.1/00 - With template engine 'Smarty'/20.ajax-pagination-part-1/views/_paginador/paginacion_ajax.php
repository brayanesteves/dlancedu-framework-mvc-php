<?php if(isset($this->_paginacion)): ?>
    <div class="pagination" style="text-align:center;">
        &nbsp;

        <?php if(isset($this->_paginacion['primero'])): ?>  
        <li><a class="pagina" pagina="<?php echo $this->_paginacion['primero']; ?>" href="javascript:void(0);">&Lt;</a></li>
        <?php else: ?>
        <li class="disabled"><span>&Lt;</span></li>
        <?php endif; ?>

        &nbsp;

        <?php if(isset($this->_paginacion['anterior'])): ?>  
        <li><a class="pagina" pagina="<?php echo $this->_paginacion['anterior']; ?>" href="javascript:void(0);">&lt;</a></li>
        <?php else: ?>
        <li class="disabled"><span>&lt;</span></li>
        <?php endif; ?>

        &nbsp;

        <?php for($i = 0; $i < count($this->_paginacion['rango']); $i++): ?>  
            <?php if($this->_paginacion['actual'] == $this->_paginacion['rango'][$i]): ?>  
            <li class="active"><span><?php echo $this->_paginacion['rango'][$i]; ?></span></li>
            <?php else: ?>
            <li>
                <a class="pagina" pagina="<?php echo $this->_paginacion['rango'][$i]; ?>" href="javascript:void(0);"><?php echo $this->_paginacion['rango'][$i]; ?></a>
            </li>
            <?php endif; ?>
        <?php endfor; ?>

        &nbsp;

        <?php if(isset($this->_paginacion['siguiente'])): ?>  
        <li><a class="pagina" pagina="<?php echo $this->_paginacion['siguiente']; ?>" href="javascript:void(0);">&gt;</a></li>
        <?php else: ?>
        <li class="disabled"><span>&gt;</span></li>
        <?php endif; ?>

        &nbsp;

        <?php if(isset($this->_paginacion['ultimo'])): ?>  
        <li><a class="pagina" pagina="<?php echo $this->_paginacion['ultimo']; ?>" href="javascript:void(0);">&Gt;</a></li>
        <?php else: ?>
        <li class="disabled"><span>&Gt;</span></li>
        <?php endif; ?>
    </div>

<?php endif; ?>