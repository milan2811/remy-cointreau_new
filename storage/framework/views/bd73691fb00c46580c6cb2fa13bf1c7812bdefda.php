<!doctype html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>" class="no-js">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <title><?php echo e(config('app.name', 'Remy Cointreau')); ?></title>
    <link rel="shortcut icon" href="<?php echo e(asset('public/images/logo_rounded.png')); ?>" type="image/x-icon">
    <link rel="stylesheet" href="<?php echo e(asset('public/home/css/icons.css')); ?>">    
    <link rel="stylesheet" href="<?php echo e(asset('public/home/css/vendor/owl.carousel.min.css')); ?>" />        
    <link rel="stylesheet" href="<?php echo e(asset('public/home/css/style.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('public/home/css/responsive.css')); ?>">    
</head>

<body <?php echo e(isset($body_class) ? "class=$body_class" : null); ?>>
    <div id="wrapper">
        <header id="header">
            <div class="wrap">
                <div class="header-row">
                    <nav id="mainmenu">
                        <ul>
                            <li><a href="<?php echo e(url('/')); ?>/#cómo-funciona" title="Cómo funciona">Cómo funciona</a></li>
                            <li><a href="<?php echo e(url('/')); ?>/#características" title="Características">Características</a></li>
                            <li><a href="<?php echo e(url('/')); ?>/#beneficios" title="Beneficios">Beneficios</a></li>
                        </ul>
                    </nav>
                    <a href="<?php echo e(route('home')); ?>" id="logo" title="Cocktail Supply Co.">
                        <img src="<?php echo e(asset('public/home/images/logo.svg')); ?>" width="157" height="157" alt="Cocktail Supply Co." />
                    </a>
                    <div class="login-options">
                        <a href="<?php echo e(route("login")); ?>" title="Registrarse" class="button register">Registrarse <i class="icon-register"></i></a>
                        <a href="<?php echo e(route("register")); ?>" title="Iniciar sesión" class="button btn-outline sign-in">Iniciar sesión <i class="icon-user"></i></a>
                    </div>
                </div>
            </div>
            <!--/.wrap-->
        </header>
        <!--/#header-->

        <div id="main">
            <div id="primary" class="content-area one-column">
                <div id="content" class="site-content">
                    <?php echo $__env->yieldContent('content'); ?>
                </div>
                <!--/#content-->
            </div>
        </div>
        <!--/#main -->
        <footer id="footer">
            <?php if(!request()->is('*/') && !request()->is('*enquiry')): ?>
                <div class="top-footer">
                    <div class="wrap">
                        <div class="footer-row">
                            <div class="ftr-brands">
                                <h4>Brands</h4>
                                <ul>
                                <li class="<?php echo e(request()->is('*enquiry*') ? 'active' : null); ?>"><a href="<?php echo e(route('enquiry.create')); ?>" title="Labore">Labore</a></li>
                                <li><a href="#" title="Aliqua">Aliqua</a></li>
                                <li><a href="#" title="Dynamic">Dynamic</a></li>
                                <li><a href="#" title="Fugiat">Fugiat</a></li>
                                <li><a href="#" title="Magna">Magna</a></li>
                                </ul>
                            </div>
                            <div class="ftr-login">
                                <a href="<?php echo e(route("login")); ?>" title="Registrarse" class="button btn-white">Registrarse</a>
                                <a href="<?php echo e(route("register")); ?>" title="Iniciar sesión" class="button btn-outline">Iniciar sesión</a>
                            </div>
                        </div>
                    </div>
                </div>                
            <?php endif; ?>
    
            <div class="bottom-footer-section">
                <div class="wrap">
                    <div class="bottom-footer">
                        <div class="copyright">
                            <div class="ftr-logo">
                            <a href="#" title="Cocktail Supply Co."><img src="<?php echo e(asset('public/home/images/logo.svg')); ?>" alt="Cocktail Supply Co." /></a>
                            </div>
                            <div class="frt-copyright">
                            <p>
                                &copy;Copyright 2022. Todos los derechos reservados
                            </p>
                            <div class="powered-by">
                                <span>Powered by</span>
                                <a href="https://www.froztech.com/" target="_blank"><img src="<?php echo e(asset('public/home/images/froztech.png')); ?>" alt="froztech"
                                    width="98" height="14"></a>
                            </div>
                            </div>
                        </div>
            
                        <div class="connect-with-us">
                            <?php if(!request()->is('*enquiry*')): ?>
                            <h4><a href="<?php echo e(route('enquiry.create')); ?>" title="Conecta con nosotras">Conecta con nosotras <i class="icon-right-arrow"></i></a>
                            </h4>
                            <?php endif; ?>
                            <ul>
                            <li><a href="<?php echo e(route('privacy_policy')); ?>" title="Política de privacidad">Política de privacidad</a></li>
                            <li><a href="<?php echo e(route('terms_and_conditions')); ?>" title="Términos y condiciones">Términos y condiciones</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <!--/.wrap -->
        </footer>
        <!--/#footer -->
    </div>
    <!--/#wrapper-->    

    <script src="<?php echo e(asset('public/home/js/vendor/jquery.js')); ?>"></script>    
    <script src="<?php echo e(asset('public/home/js/vendor/stickyfill.min.js')); ?>"></script>
    <script src="<?php echo e(asset('public/home/js/vendor/owl.carousel.min.js')); ?>"></script>
    <script src="<?php echo e(asset('public/home/js/vendor/owlcarousel2-filter.min.js')); ?>"></script>
    <script src="<?php echo e(asset('public/home/js/vendor/jquery.matchHeight-min.js')); ?>"></script>
    <script src="<?php echo e(asset('public/home/js/general.js')); ?>"></script>
    
</body>

</html>
<?php /**PATH /home/admin/web/64.4.160.99/public_html/remy-cointreau/resources/views/layouts/home.blade.php ENDPATH**/ ?>