<div class="d-flex">
    <div class="c100 p<?php echo $client_percent[$val['id']]['all_percentage']; ?> blue">
        <span><?php echo $client_percent[$val['id']]['all_percentage']; ?>%</span>
        <div class="slice">
            <div class="bar"></div>
            <div class="fill"></div>
        </div>
    </div>
    <div class="ml-2 c100 p<?php echo $documentProgress['progress']; ?> blue">
        <span><?php echo $documentProgress['progress']; ?>%</span>
        <div class="slice">
            <div class="bar"></div>
            <div class="fill"></div>
        </div>
    </div>
</div>