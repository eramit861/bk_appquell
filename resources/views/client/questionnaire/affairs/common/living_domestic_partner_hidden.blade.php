@php
    $domestic_partner_living = Helper::validate_key_loop_toggle('domestic_partner_living', $finacial_affairs, 1, $i);
    $showSection = '';
    if (empty($domestic_partner_living)) {
        $showSection = 'hide-data';
    }
@endphp
<div class="{{ $showSection }}">
    <input type="hidden" name="domestic_partner_city[{{ $i }}]"
        value="{{ @$finacial_affairs['domestic_partner_city'][$i] }}">
    <input type="hidden" name="domestic_partner_city[{{ $i }}]"
        value="{{ @$finacial_affairs['domestic_partner_city'][$i] }}">
    <input type="hidden" name="domestic_partner_city[{{ $i }}]"
        value="{{ @$finacial_affairs['domestic_partner_city'][$i] }}">
    <input type="hidden" name="domestic_partner_city[{{ $i }}]"
        value="{{ @$finacial_affairs['domestic_partner_city'][$i] }}">
    <input type="hidden" name="community_property_state[{{ $i }}]"
        value="{{ @$finacial_affairs['community_property_state'][$i] }}">
    <input type="hidden" name="domestic_partner_living[{{ $i }}]"
        value="{{ @$finacial_affairs['domestic_partner_living'][$i] }}">
    <input type="hidden" name="domestic_partner[{{ $i }}]"
        value="{{ @$finacial_affairs['domestic_partner'][$i] }}">
    <input type="hidden" name="domestic_partner_street_address[{{ $i }}]"
        value="{{ @$finacial_affairs['domestic_partner_street_address'][$i] }}">
    <input type="hidden" name="domestic_partner_city[{{ $i }}]"
        value="{{ @$finacial_affairs['domestic_partner_city'][$i] }}">
    <input type="hidden" name="domestic_partner_state[{{ $i }}]"
        value="{{ @$finacial_affairs['domestic_partner_state'][$i] }}">
    <input type="hidden" name="domestic_partner_zip[{{ $i }}]"
        value="{{ @$finacial_affairs['domestic_partner_zip'][$i] }}">
</div>
