@php
$docData = Helper::getDocumentImage($document_type);
$svgname = Helper::validate_key_value('svg', $docData);
$svgname = empty($svgname) ? 'attorney_docs.svg' : $svgname;
$svgUrl = asset("assets/img/black_icons/".$svgname);
@endphp
<img src="{{ $svgUrl }}" class="licence-img ms-2 licence-icon" style="height:28px;" alt="logo">