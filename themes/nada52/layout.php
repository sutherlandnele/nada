<?php
header("Cache-Control: no-cache, must-revalidate");
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");
$menu_horizontal = TRUE;
$bootstrap_theme = 'themes/' . $this->template->theme();

$data = array();
//side menu
$data['menus'] = $this->Menu_model->select_all();
$sidebar = $this->load->view('default_menu', $data, true);

// Inject current pages as classes in the body wrapper 
$uri_ = $this->uri->segment_array();
foreach ($uri_ as $key => $val) {
    if (is_numeric($val)) {
        unset($uri_[$key]);
    }
}
$uri_ = implode("-", $uri_);


//default page content wrapper class
$content_wrap_class = "container page-" . $this->uri->segment(1) . " " . $uri_;
if (isset($body_class)) {
    $content_wrap_class = $body_class . " " . $uri_;
}

$use_cdn = true;

?>
<!DOCTYPE html>
<html>

<head>
    <?php require_once 'head.php'; ?>
</head>

<body>

    <!-- site header -->
    <?php include_once 'header.php'; ?>

    <!-- page body -->
    <div class="wp-page-body <?php echo $content_wrap_class; ?>">

        <div class="body-content-wrap theme-nada-2">

            <!--breadcrumbs -->
            <div class="container">
                <?php $breadcrumbs_str = $this->breadcrumb->to_string(); ?>
                <?php if ($breadcrumbs_str != '') : ?>
                    <ol class="breadcrumb wb-breadcrumb">
                        <?php echo $breadcrumbs_str; ?>
                    </ol>
                <?php endif; ?>
            </div>
            <!-- /breadcrumbs -->

            <?php echo isset($content) ? $content : ''; ?>
        </div>
    </div>

    <!-- page footer -->
    <?php include_once 'footer.php'; ?>
</body>

</html>