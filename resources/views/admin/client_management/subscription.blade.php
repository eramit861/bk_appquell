<div class="info-section">
    <div class="info-section-title" ><span onclick="event.stopPropagation();">Subscription</span></div>
    <?php if ($val['client_subscription'] > 0) { ?>
        <span class="status-badge status-<?php echo \App\Models\AttorneySubscription::classByPackageName($val['client_subscription']); ?>" onclick="event.stopPropagation();">
            <?php echo \App\Models\AttorneySubscription::packageNameForClient($val['client_subscription']); ?>
        </span>
    <?php } ?>
    <div class="mt-2">

        <!-- Attorney -->
        <x-admin.client_management.subscriptionText
            :dataLabel="$val->ClientsAttorneybyclient->getuserattorney->name ?? ''"
            dataFor="attorney" />

        <!-- Client Type -->
        <x-admin.client_management.subscriptionText
            :dataLabel="$client_type_label"
            dataFor="clientType" />
    </div>
    <button class="btn btn-outline-custom btn-custom mt-1" onclick="showSubscriptionAddon(<?php echo $val['id']; ?>); event.stopPropagation();">
        <i class="bi bi-ui-checks"></i> Click Here To Unlock Add-on Features
    </button>
    <div class="hide-data subscription-addon subscription-addon-<?php echo $val['id']; ?>" onclick="event.stopPropagation();">
        @include('attorney.client.manage.subscription_addon')
    </div>
</div>