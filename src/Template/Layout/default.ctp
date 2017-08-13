<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
use Cake\I18n\Time;
$Description = 'Crafty Cuts Laser';
?>

<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>


    <title>
        <?= $Description ?>:
        
    </title>
    <?= $this->Html->meta(
    'favicon.png',
    '/favicon.png',
    ['type' => 'icon']); ?>

   
    <?= $this->Html->css('bootstrap.min.css') ?>
    <?= $this->Html->css('icomoon-social.css') ?>
    <?= $this->Html->css('http://fonts.googleapis.com/css?family=Open+Sans:400,700,600,800') ?>
    <?= $this->Html->css('leaflet.css') ?>
    <?= $this->Html->css('main.css') ?> 
    <?= $this->Html->css('custom.css') ?> 
   
    <?= $this->Html->script('modernizr-2.6.2-respond-1.1.0.min.js') ?> 

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>

<?= $this->Html->script('tiny_mce4/jQuery-2.1.4.min') ?> 
<?= $this->Html->script('tiny_mce4/tinymce.min') ?>  


</head>
<body>
    
            <!-- Navigation & Logo-->
        <div class="mainmenu-wrapper">
            <div class="container">
                <div class="menuextras">
                    <div class="extras">
                        <ul>
                          
                            <li> <?php if (is_null($this->request->session()->read('Auth.User.First_Name'))) {
                                  echo "You are currently logged out"; } else {$user = $this->request->session()->read('Auth.User.First_Name'); echo 'Hello, '; echo $this->Html->link($user,['controller'
                                => 'pages', 'action' =>  'Myaccount']); } ?></li>
                            <li class="shopping-cart-items"><i class="glyphicon glyphicon-shopping-cart icon-white"></i> <a href=""><b>3 items</b></a></li>
                            <li>
                                <div class="dropdown choose-country">
                                    <a class="#" data-toggle="dropdown" href="#"><?php echo $this->Html->image('flags/gb.png'); ?> UK</a>
                                    <ul class="dropdown-menu" role="menu">
                                        <li role="menuitem"><a href="#"><?php echo $this->Html->image('flags/us.png'); ?> US</a></li>
                                        <li role="menuitem"><a href="#"><?php echo $this->Html->image('flags/de.png'); ?></li>
                                        <li role="menuitem"><a href="#"><?php echo $this->Html->image('flags/es.png'); ?> ES</a></li>
                                    </ul>
                                </div>
                            </li>
                            <li><?php if (is_null($this->request->session()->read('Auth.User.First_Name'))){
                                 echo $this->Html->link('Log in', ['controller'=>'Users','action' => 'login']);
                                 } ?></li>
                            <li> <?php if (is_null($this->request->session()->read('Auth.User.First_Name'))){} else {
                                 echo $this->Html->link('Log out', ['controller'=>'Users','action' => 'logout']);
                                 } ?></li>

                             
                           

                        </ul>
                    </div>
                </div>
                <nav id="mainmenu" class="mainmenu">
                    <ul>
                        <li class="logo-wrapper">
                            <?php echo $this->Html->image('logo2.jpg'); ?>
                            </li>
                        <li class="active">
                           <?php echo $this->Html->link('Home','/',['class' => 'button']);?>
                        </li>
                        <li>
                            <a href="">News</a>
                        </li>
                        <li>
                            <?php echo $this->Html->link('About Us', ['controller'
                                => 'contents', 'action' =>  'view',$id=2]);?>
                            </li>
                        <li>
                            <?php echo $this->Html->link('Store',['controller'=> 'Products', 'action' =>  'displayproducts']); ?>
                        </li>
                        <li>
                             <?php echo $this->Html->link('Contact Us', ['controller'
                                => 'users', 'action' =>  'contactus']);?>
                        </li>
                        <li>
                            <?php if (is_null($this->request->session()->read('Auth.User.First_Name'))){
                               echo $this->Html->link('My account ','/',['class' => 'button']);} 
                               else{
                                 echo $this->Html->link('My account', ['controller' => 'pages', 'action' =>  'Myaccount']);
                                
                                } ?>
                        </li>
                    </ul>
                </nav>
            </div>

             </div>  
     

           
       <!-- fetch the title of the page -->
           <div class="section section-breadcrumbs">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h1>
                        <?= $this->assign('title', $title); ?>
                        <?= $this -> fetch('title') ?>
                    </h1>
                    </div>
                </div>
            </div>
        </div>
        <!-- fetch the content of the current page -->
         <?= $this->Flash->render() ?>
            <?= $this->Flash->render('auth') ?>
    <div class="section">
            <div class="container">
                <div class="row">
                <?= $this->fetch('content') ?>
            </div>
        </div>
    </div>
       
    <div class="footer">
            <div class="container">
                <div class="row">
          
                    <div class="col-footer col-md-4 col-xs-6">
                        <h3>Navigate</h3>
                        <ul class="no-list-style footer-navigate-section">
                            <li>Home</li>
                            <li>News</a></li>
                            <li>Materialsp</a></li>
                            <li>Contact Us</a></li>
                            <li>My account</li>
                        </ul>
                    </div>
                    
                    <div class="col-footer col-md-4 col-xs-6">
                        <h3>Contacts</h3>
                        <p class="contact-us-details">
                            <b>Address:</b> 123 Fake Street, melbourne,vic, Australia<br/>
                            <b>Phone:</b> +44 123 654321<br/>
                            <b>Fax:</b> +44 123 654321<br/>
                            <b>Email:</b> craftycutslaser@gmail.com</a>
                        </p>
                    </div>
                    <div class="col-footer col-md-4 col-xs-6">
                        <h3>Stay Connected</h3>
                        <ul class="footer-stay-connected no-list-style">
                            <li><a href="#" class="facebook"></a></li>
                            <li><a href="#" class="twitter"></a></li>
                            <li><a href="#" class="googleplus"></a></li>
                        </ul>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="footer-copyright">&copy; <?php $now = Time::now(); echo $now->year; ?> Crafty Cuts Laser. All rights reserved.</div>
                    </div>
                </div>

            </div>
        </div>
   
</body>
</html>
