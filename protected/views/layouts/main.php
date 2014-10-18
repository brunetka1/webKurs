<?php /* @var $this Controller */ ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8' />
    <?php
        Yii::app()->bootstrap->register();

        $cs = Yii::app()->clientScript;
        $cs->registerCssFile(Yii::app()->getBaseUrl() .  '/css/main.css');
        $cs->registerCssFile(Yii::app()->getBaseUrl() .  '/css/pager.css');
        $cs->registerCssFile(Yii::app()->getBaseUrl() .  '/css/fontAwesome.css');
        $cs->registerCssFile(Yii::app()->getBaseUrl() .  '/css/switch.css');

        $cs->registerCoreScript('jquery.ui');
        $cs->registerCssFile($cs->getCoreScriptUrl().'/jui/css/base/jquery-ui.css');
    ?>
    <title><?= Yii::app()->name.' Release 1.0, version 1.0,'. date(' m-d-Y'); ?></title>
</head>

<body>
<div class='container'>
        <div class='row'>
            <div id='confirm-logout' class='modal hide fade'>
                <div class='modal-header'>
                    <button type='button' class='close' data-dismiss='modal' aria-hidden='true'>&times;</button>
                    <h3 id='confirm-logout-header'>Warning</h3>
                </div>
                <div class='modal-body'>
                    <p>Are you sure you want to log out from the application?</p>
                </div>
                <div class='modal-footer'>
                    <a class='btn btn-primary' onclick="javascript:window.location.assign
                        ('<?php echo CHtml::normalizeUrl(array('site/logout')) ?>')">Yes
                    </a>
                    <a class='btn' data-dismiss='modal' aria-hidden='true'>No</a>
                </div>
            </div>
            <header class='wrp1'>
                <div class="navbar">
                    <div class='navbar-inner'>
                        <div class='container'>
                            <a class='brand' href='#'>
                               <??>
                            </a>
                            <ul class='nav'>
                                <li>
                                    <?php $userHome = $this->id;
                                        $this->widget('bootstrap.widgets.TbMenu', array(
                                            'items' => array(
                                            array(
                                                'label' => 'Administration',
                                                'url'  => '#',
                                                'active' => true,
                                                'visible' => $userHome == 'admin'),
                                            ),
                                        ));
                                    ?>
                                </li>
                            </ul>
                            <ul class="nav pull-right">
                                <li>
                                    <a href=""><?= 'Logged user: '. Yii::app()->user->name; ?></a>
                                </li>
                                <li>
                                    <a href="#" data-toggle='modal' data-target='#confirm-logout' title='Log out/in'>
                                        <?= ' Logout ' .'<i class="icon-signout icon-large"></i>' ?>
                                    </a>
                                </li>
                                <li>
                                     <?php  ?>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </header>
            <section>
            	
            		 <?php echo $content; ?>
            	
            </section>
<!--            <footer></footer>-->
        </div>
    </div>
</body>
</html>
