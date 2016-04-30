<?php
/**
 * Lithium: the most rad php framework
 *
 * @copyright     Copyright 2013, Union of RAD (http://union-of-rad.org)
 * @license       http://opensource.org/licenses/bsd-license.php The BSD License
 */
?>
<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang=""> <!--<![endif]-->
    <head>
		<?php echo $this->html->charset();?>
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <meta name="description" content="">
        <!-- <meta name="viewport" content="width=device-width, initial-scale=1"> -->
		<meta name='viewport' content='initial-scale=1,maximum-scale=1,user-scalable=no' />
		<title><?php echo $this->title(); ?></title>

		<?php echo $this->html->style(array('bootstrap.min',/*'bootstrap-theme.min', 'lithified',*/ 'main', 'login')); ?>

		<?php echo $this->html->script('vendor/modernizr-2.8.3-respond-1.4.2.min'); ?>
		<?php echo $this->html->script('vendor/jquery-1.11.2.min'); ?>

		<?php echo $this->html->link('icon', null, array('type' => 'icon')); ?>

        <?php
            // renders app/views/elements/head.html.php
            echo $this->_render('element', 'head');
        ?>
        
    </head>
    <?php use lithium\core\Environment;?>
    <body data-locale="<?=Environment::get('locale')?>">
        <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
        <?php
        // renders app/views/elements/nav.html.php
        echo $this->_render('element', 'nav');
        ?>
        <div class="container">
			<?php echo $this->content(); ?>
	    </div> <!-- /container -->
   
	    <div class="container-fluid navbar-fixed-bottom footer">   
            <?php
                // renders app/views/elements/footer.html.php
                echo $this->_render('element', 'footer');
            ?>
	    </div> <!-- /container -->  

	    <!--<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="/js/vendor/jquery-1.11.2.min.js"><\/script>')</script>-->

        <script src="/js/vendor/bootstrap.min.js"></script>

        <script src="/js/main.js"></script>

        <!-- Google Analytics: change UA-XXXXX-X to be your site's ID. -->
        <script>
            (function(b,o,i,l,e,r){b.GoogleAnalyticsObject=l;b[l]||(b[l]=
            function(){(b[l].q=b[l].q||[]).push(arguments)});b[l].l=+new Date;
            e=o.createElement(i);r=o.getElementsByTagName(i)[0];
            e.src='//www.google-analytics.com/analytics.js';
            r.parentNode.insertBefore(e,r)}(window,document,'script','ga'));
            ga('create','UA-XXXXX-X','auto');ga('send','pageview');
        </script>
    </body>
</html>
