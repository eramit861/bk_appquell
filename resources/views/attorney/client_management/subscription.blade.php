<div class="info-section">
    <div class="info-section-title"><span onclick="event.stopPropagation();">Subscription</span></div>
    
    @if ($val['client_subscription'] > 0)
        <span class="status-badge status-{{ \App\Models\AttorneySubscription::classByPackageName($val['client_subscription']) }}" onclick="event.stopPropagation();">
            {{ \App\Models\AttorneySubscription::packageNameForClient($val['client_subscription']) }}
        </span>
    @endif
    
    <div class="mt-2">
        <!-- Client Type -->
        <x-attorney.client_management.subscriptionText
            :clientId="$client_id"
            :dataValue="$client_type"
            :dataLabel="$client_type_label"
            :dataSubscriptionId="$client_subscription_id"
            dataFor="clientType" />
            
        <!-- Paralegal -->
        <x-attorney.client_management.subscriptionText
            :clientId="$client_id"
            :dataValue="$paralegalId"
            :dataLabel="!empty($paralegalLabel) ? $paralegalLabel : 'Select Paralegal'"
            :showButtons="empty($parentAttorneyId)"
            dataFor="paralegal" />

        <!-- Law Firm -->
        @if (!empty($associates))
            <x-attorney.client_management.subscriptionText
                :clientId="$client_id"
                :dataValue="$associateId"
                :dataLabel="$associateLabel"
                :showButtons="empty($parentAttorneyId)"
                :options="$associateOptions"
                dataFor="lawFirm" />
        @endif
    </div>
    
    <button class="btn btn-outline-custom btn-custom mt-1" onclick="showSubscriptionAddon( {{ $val['id'] }} ); event.stopPropagation();">
        <i class="bi bi-ui-checks"></i> Click Here To Unlock Add-on Features
    </button>
    
    <div class="hide-data subscription-addon subscription-addon-{{ $val['id'] }}" onclick="event.stopPropagation();">
        @include('attorney.client.manage.subscription_addon')
    </div>
</div>