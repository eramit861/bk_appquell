<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <?php  $content = '<style>'.file_get_contents(public_path('assets/css/bootstrap.min.css'));
    $content .= '</style>';
    echo $content;
    ?>
<style>
 .page-break {
    page-break-after: always;
}
   /*21092022 For Creditors PDF Format*/
.content_center_text_left{
   float: left;
    position: relative;
    left: 30%;
   text-align: left;
}
.content_center_text_center{
    width: 100%;
    display: flex;
   justify-content: center;
   text-align: center;
}
.content_center_text_right{
   float: right;
    position: relative;
    right: 30%;
   text-align: right;
}
.content_left_text_left{
   float:left;
   display:block;
   text-align: left;
}
.content_left_text_center{
   float:left;
   display:block;
   text-align: center;
}
.content_left_text_right{
   display: block;
   float: left;
   text-align: right;
}
.content_right_text_left{
   float:right;
   display: block;
   text-align: left;
}
.content_right_text_center{
   display:block;
   float:right;
   text-align: center;
}
.content_right_text_right{
   float:right;
   display:block;
   text-align: right;
}
</style>

   
 <link>
<?php //$web_view = Session::get('web_view');
?>

</head>
<body>
<div class="profitlosspopup  profitpopup">
    <div class="row no-border-elements">
       
        @csrf
        <div class="col-xs-12" style="text-align:center;">
           <?php
           $itemPerPage = 10;
    $style = '';
    $html = '';
    $baseContent = '';
    if (@$creditor_settings->text_content_field == "center" && @$creditor_settings->text_align_field == "center") {
        $content_class = 'content_center_text_center';
    } elseif (@$creditor_settings->text_content_field == "center" && @$creditor_settings->text_align_field == "left") {
        $content_class = 'content_center_text_left';
    } elseif (@$creditor_settings->text_content_field == "center" && @$creditor_settings->text_align_field == "right") {
        $content_class = 'content_center_text_right';
    } elseif (@$creditor_settings->text_content_field == "left" && @$creditor_settings->text_align_field == "left") {
        $content_class = 'content_left_text_left';
    } elseif (@$creditor_settings->text_content_field == "left" && @$creditor_settings->text_align_field == "center") {
        $content_class = 'content_left_text_center';
    } elseif (@$creditor_settings->text_content_field == "left" && @$creditor_settings->text_align_field == "right") {
        $content_class = 'content_left_text_right';
    } elseif (@$creditor_settings->text_content_field == "right" && @$creditor_settings->text_align_field == "left") {
        $content_class = 'content_right_text_left';
    } elseif (@$creditor_settings->text_content_field == "right" && @$creditor_settings->text_align_field == "center") {
        $content_class = 'content_right_text_center';
    } elseif (@$creditor_settings->text_content_field == "right" && @$creditor_settings->text_align_field == "right") {
        $content_class = 'content_right_text_right';
    } else {
        $content_class = 'content_center';
    }


    if (@$creditor_settings->text_spacing == Helper::TEXT_SPACING_SINGLE) {
        $spacing = "\r\n";
    } elseif (@$creditor_settings->text_spacing == Helper::TEXT_SPACING_TWO) {
        $spacing = "\r\n\r\n";
    } elseif (@$creditor_settings->text_spacing == Helper::TEXT_SPACING_THREE) {
        $spacing = "\r\n\r\n\r\n";
    } else {
        $spacing = "\r\n\r\n";
    }

    if (@$creditor_settings->font_size == Helper::FONT_SIZE_NORMAL) {
        $style .= '';
    } elseif (@$creditor_settings->font_size == Helper::FONT_SIZE_SMALL) {
        $style .= "font-size:12px;";
    } elseif (@$creditor_settings->font_size == Helper::FONT_SIZE_MEDIUM) {
        $style .= "font-size:16px;";
    } elseif (@$creditor_settings->font_size == Helper::FONT_SIZE_LARGE) {
        $style .= "font-size:18px;";
    } else {
        $style .= '';
    }

    if (@$creditor_settings->text_capitalize == Helper::FONT_STYLE_NORMAL) {
        $style .= 'text-transform: none;';
    } elseif (@$creditor_settings->text_capitalize == Helper::FONT_STYLE_UPPERCASE) {
        $style .= "text-transform: uppercase;";
    } elseif (@$creditor_settings->text_capitalize == Helper::FONT_STYLE_CAPITALIZE) {
        $style .= "text-transform: capitalize;";
    } elseif (@$creditor_settings->text_capitalize == Helper::FONT_STYLE_LOWERCASE) {
        $style .= "text-transform: lowercase;";
    } else {
        $style .= 'text-transform: none;';
    }


    if (@$creditor_settings->font_size == Helper::FONT_SIZE_MEDIUM && $creditor_settings->text_spacing == Helper::TEXT_SPACING_TWO) {
        $itemPerPage = 10;
    } elseif (@$creditor_settings->font_size == Helper::FONT_SIZE_LARGE && $creditor_settings->text_spacing == Helper::TEXT_SPACING_TWO) {
        $itemPerPage = 9;
    } elseif (@$creditor_settings->font_size == Helper::FONT_SIZE_MEDIUM && $creditor_settings->text_spacing == Helper::TEXT_SPACING_THREE) {
        $itemPerPage = 8;
    } elseif (@$creditor_settings->font_size == Helper::FONT_SIZE_LARGE && $creditor_settings->text_spacing == Helper::TEXT_SPACING_THREE) {
        $itemPerPage = 7;
    } elseif (@$creditor_settings->font_size == Helper::FONT_SIZE_SMALL && $creditor_settings->text_spacing == Helper::TEXT_SPACING_TWO) {
        $itemPerPage = 13;
    } elseif (@$creditor_settings->font_size == Helper::FONT_SIZE_SMALL && $creditor_settings->text_spacing == Helper::TEXT_SPACING_THREE) {
        $itemPerPage = 11;
    } elseif (@$creditor_settings->font_size == Helper::FONT_SIZE_NORMAL && $creditor_settings->text_spacing == Helper::TEXT_SPACING_TWO) {
        $itemPerPage = 10;
    } elseif (@$creditor_settings->font_size == Helper::FONT_SIZE_NORMAL && $creditor_settings->text_spacing == Helper::TEXT_SPACING_THREE) {
        $itemPerPage = 8;
    } else {
        $itemPerPage = 10;
    }

    $totalitems = count($creditors);
    $i = 0;
    foreach ($creditors as $creditor) {
        $creditor['creditor_name_addresss'] = str_replace("-", " ", $creditor['creditor_name_addresss']);
        $creditor['creditor_name_addresss'] = preg_replace("/[^A-Za-z0-9 ]/", '', $creditor['creditor_name_addresss']);
        $i++;
        $baseContent .= "<div style='width: 100%; clear: both'><div class='".$content_class."' style='".$style."'>".$creditor['creditor_name']."\r\n".$creditor['creditor_name_addresss']."\r\n".$creditor['creditor_city'].", ".$creditor['creditor_state']." ".$creditor['creditor_zip']."".$spacing."</div></div>";
        if ($i % $itemPerPage == 0 && $i != $totalitems) {
            $baseContent .= '<div class="page-break"></div>';
        }
    }
    echo nl2br($baseContent);
    ?>


        </div>


    </div>
</div>
</body>