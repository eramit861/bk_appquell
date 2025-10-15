<?php

if (is_array($requestedDocuments) && !empty($requestedDocuments)) {
    if (in_array($data['document_type'], array_keys($requestedDocuments))) {?>
        <span class='highlight_btn_requested d-inline-block <?php echo $colored ?? "red";?>'> Document(s) Requested </span>
<?php }
    } ?>