<div class="row">
    <div class="col-md-12">
        <h3 class="text-center underline"><?php echo $mainTitle; ?></h3>
    </div>

    <?php
        if (!empty($list)) {
            foreach ($list as $listLabel => $listObject) {
                ?>
        <div class="col-md-12">
            <h3 class="underline"><?php echo $listLabel; ?></h3>
        </div>
        <?php if (!empty($listObject)) { ?>
            <ul class="mt-1">
                <?php foreach ($listObject as $objectLabel) { ?> 
                    <li><?php echo '• '.$objectLabel; ?></li>
                <?php } ?>
            </ul>
        <?php } ?>
    <?php }
            } ?>
</div>