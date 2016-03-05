<!DOCTYPE HTML>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-COMPATIBLE" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">
	<title>
		Project Police
	</title>

	<link rel="stylesheet" href="../../assets/css/bootstrap.min.css" />
	<link rel="stylesheet" href="../../assets/css/bootstrap-theme.min.css">
	<link rel="stylesheet" type="text/css" href="../../assets/css/theme.css">
</head>
<body role="document">
    <div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#">PST</a>
            </div>

            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <?php
                    $arrUserData = $this->session->userdata('user');
                    $strShowPrivate = 'hide';
                    if(is_array($arrUserData)) {
                        $strShowPrivate = 'show';
                    }
                ?>
                <ul class="nav navbar-nav navbar-right">
                    <li class='<?php echo $strShowPrivate ?>' >
                        <a href="<?php echo base_url();?>Dashboard/home">Dashboard</a>
                    </li>
                    <li class='<?php echo $strShowPrivate ?>' >
                        <a href="<?php echo base_url();?>Project/view">Project List</a>
                    </li>
					<li class='<?php echo $strShowPrivate ?>'>
						<a href="<?php echo base_url();?>Auth/logout">Logout</a>
					</li>
				</ul>
            </div>

        </div>
    </div>
    <div class="container theme-showcase" role="main">
