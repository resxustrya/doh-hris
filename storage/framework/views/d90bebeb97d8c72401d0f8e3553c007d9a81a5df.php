<html>
<style type="text/css">
    .barcode {
        <?php if($size=='letter'): ?>
        top: 960px;
        <?php elseif($size=='a4'): ?>
        top: 1030px;
        <?php elseif($size=='legal'): ?>
        top: 1255px;
        <?php endif; ?>
        position: relative;
        left: -50%;
    }
    .route_no {
        font-size: 1em;
        text-align:center;
    }
</style>
<title><?php echo e(Session::get('route_no')); ?></title>
<body>
<div style="position: absolute; left: 50%;">
    <div class="barcode">
        <font class="route_no"><?php echo e(Session::get('route_no')); ?></font>
        <?php echo DNS1D::getBarcodeHTML(Session::get('route_no'),"C39E",1,15) ?>
    </div>
</div>
</body>
</html>