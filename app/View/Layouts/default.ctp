<?php
$appTitle = 'BAtTask'
?>
<!DOCTYPE html>
<!-- paulirish.com/2008/conditional-stylesheets-vs-css-hacks-answer-neither/ -->
<!--[if IE 8]>    <html class="no-js lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en"> <!--<![endif]-->
<head>

	<?php echo $this->Html->charset(); ?>
	<title>
		<?php echo $appTitle ?>:
		<?php echo $title_for_layout; ?>
	</title>
    <meta name="viewport" content="width=device-width" />
	<?php
		echo $this->Html->meta('icon');

        echo $this->Html->css('foundation');
        echo $this->Html->css('app');

        echo $this->Html->script('//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js');
        echo $this->Html->script('modernizr.foundation.js');
        echo $this->Html->script('//use.typekit.net/opu2uit.js');
        echo $this->Html->script('battask');

		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
	?>
    <script type="text/javascript">try{Typekit.load();}catch(e){}</script>
</head>
<body>
    <div class="fixed gray">
        <div class="row">
            <div class="twelve">
                <nav class="top-bar">
                    <ul>
                        <!-- Title Area -->
                        <li class="name">
                            <h1>
                                <a href="#">
                                    BAtTask
                                </a>
                            </h1>
                        </li>
                        <li class="toggle-topbar"><a href="#"></a></li>
                    </ul>


                    <section>
                        <!-- Left Nav Section -->
                        <ul class="left">
                            <li class="divider"></li>
                            <li class="tagline">The Blue Acorn AtTask Utility</li>
                            <li class="divider hide-for-small"></li>
                            <li><a class="active" href="/entries">Time Entries</a></li>
                            <li class="divider hide-for-small"></li>
                            <li><a class="active" href="/config">Config</a></li>
                            <li class="divider hide-for-small"></li>
                        </ul>

                        <!-- Right Nav Section -->
                        <ul class="right">
                            <li class="divider show-for-medium-and-up"></li>
                            <?php echo $this->element('header_dates')?>
                        </ul>
                    </section></nav>
            </div>
        </div>
    </div>



    <div class="row">
        <?php echo $this->Session->flash('flash', array('params'=>array('class'=>'alert-box')))?>

        <?php echo $this->fetch('content'); ?>
    </div>

    <?/*
    <div id="GhettoMenu" >
        <ul>
            <li><a href="/entries">Time Entries</a></li>
            <li><a href="/config">Config</a></li>
        </ul>
    </div>*/?>

	<?php echo $this->element('sql_dump'); ?>
</body>
</html>
