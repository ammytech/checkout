<?php 
$title = (!empty($title) ? $title : $this->site_name);
$callEditurl = $this->router->class.'/edit'.ucfirst($this->router->class);
$callPubUrl = $this->router->class.'/publish'.ucfirst($this->router->class);
$callDeleteUrl = $this->router->class.'/delete'.ucfirst($this->router->class);
$loader = '  <img class="loader hide" width="20px" alt="please wait ..." src="'. ADMIN_THEME1.'img/loader.gif">';
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title><?php echo $title;?></title>
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<meta name="apple-mobile-web-app-capable" content="yes">
<link href="<?php echo ADMIN_THEME1?>css/bootstrap.min.css" rel="stylesheet">
<link href="<?php echo ADMIN_THEME1?>css/bootstrap-responsive.min.css" rel="stylesheet">
<link href="<?php echo PROTOCOL?>fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600"
        rel="stylesheet">
<link href="<?php echo ADMIN_THEME1?>css/font-awesome.css" rel="stylesheet">
<link href="<?php echo ADMIN_THEME1?>css/style.css?r=885" rel="stylesheet">

<!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
<!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
   <script type="text/javascript">
   var base_url = '<?php echo DOMAIN_PATH . $this->router->class;?>';
   var filePath = '<?php echo DOMAIN_PATH ?>';

   </script>
</head>
<body class="bodyp" style="display:none;">