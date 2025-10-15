<div class="d-flex">

    <?php if ($val['concierge_service'] == 1 && $val['concierge_service_status'] == 0) { ?>
        <img class="w-40px pending_client" src="{{ asset('assets/img/concierge_services_notdone.png') }}" alt="Concierge Service" />
    <?php } ?>
    <?php if ($val['concierge_service'] == 1 && $val['concierge_service_status'] == 1) { ?>
        <img class="w-40px done_client" src="{{ asset('assets/img/concierge_services_done.png') }}" alt="Concierge Service" />
    <?php } ?>
    <?php if ($val['concierge_service'] != 1) { ?>
        <span class="w-40px">&nbsp;</span>
    <?php } ?>

    &nbsp;
    &nbsp;
    &nbsp;

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