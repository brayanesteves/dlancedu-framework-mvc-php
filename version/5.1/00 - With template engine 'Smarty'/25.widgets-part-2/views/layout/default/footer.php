        <div id="footer">
            Copyright &copy; 2012 <?php echo APP_COMPANY; ?>
        </div>
    </div>

    <script src="<?php echo BASE_URL; ?>libs/jquery/version/1.7.1/js/jquery-1.7.1.js" type="text/javascript"></script>
    <script src="<?php echo BASE_URL; ?>libs/jquery-plugin/jquery-validation/version/1.9.0/js/jquery.validate.js" type="text/javascript"></script>
    <?php if(isset($_layoutParams['js']) && count($_layoutParams['js'])): ?>
    <?php for($i = 0; $i < count($_layoutParams['js']); $i++): ?>
    <script src="<?php echo $_layoutParams['js'][$i]; ?>" type="text/javascript"></script>
    <?php endfor; ?>
    <?php endif; ?>
</body>
</html>