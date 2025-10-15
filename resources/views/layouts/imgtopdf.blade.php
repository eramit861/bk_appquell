<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <?php  $content = '<style>'.file_get_contents(public_path('assets/css/bootstrap.min.css'));
    $content .= '</style>';
    echo $content;
    ?>

    <?php  $content = '<style>'.file_get_contents(public_path('assets/css/style.css'));
    $content .= '</style>';
    echo $content;
    ?>
 <link>
<?php //$web_view = Session::get('web_view');
?>
</head>
<body>
<div class="row">
<div class="col-md-12">
<img alt="image" width="100%" src="<?php echo @$image_path; ?>" />
</div>
</div>
</body>
</html>