@php
$propertyresident = $property_info['propertyresident']->toArray();
@endphp

<div class="part-a outline-gray-border-area mt-4">
    
    @if(!empty($propertyresident))
        @php $i=0; @endphp
        @php $primary_text = ""; @endphp
        @foreach($propertyresident as $key =>$resident)
            @include("attorney.form_elements.resident_listing", ['hide_docs' => (!isset($hide_docs) || $hide_docs == false ? false:true)])
            @php $i++; @endphp
        @endforeach
    @endif
   
</div>