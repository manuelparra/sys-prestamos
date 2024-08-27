<?php
/**
 * Contents of Scripts.
 * Contents of the Scripts
 * PHP version 8.2.0
 *
 * @category Layout
 * @package  Layout
 * @author   Manuel Parra <manuelparra@live.com.ar>
 * @license  MIT <https://mit.org>
 * @version  CVS: <1.0.0>
 * @link     manuelparra.dev
 */
?>

<!-- jQuery V3.4.1 -->
<script src="<?php echo SERVER_URL; ?>App/View/js/jquery-3.4.1.min.js"></script>

<!-- popper -->
<script src="<?php echo SERVER_URL; ?>App/View/js/popper.min.js"></script>

<!-- Bootstrap V4.3 -->
<script src="<?php echo SERVER_URL; ?>App/View/js/bootstrap.min.js"></script>

<!-- jQuery Custom Content Scroller V3.1.5 -->
<script
    src="<?php echo SERVER_URL; ?>App/View/js/jquery.mCustomScrollbar.concat.min.js"
>
</script>

<!-- Bootstrap Material Design V4.0 -->
<script
src="<?php echo SERVER_URL; ?>App/View/js/bootstrap-material-design.min.js"
>
</script>

<script>
    $(document).ready(function() {
        $('body').bootstrapMaterialDesign();
    });
</script>

<script src="<?php echo SERVER_URL; ?>App/View/js/main.js"></script>

<script src="<?php echo SERVER_URL; ?>App/View/js/alerts.js"></script>
