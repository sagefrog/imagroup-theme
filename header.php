<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js no-svg">
<head>
	<!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-T342PPNM');</script>
<!-- End Google Tag Manager -->
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
	
<?php wp_head(); ?>
<?
  if (!sf::isLocal()):
?>
<script type="text/javascript" src="https://www.bugherd.com/sidebarv2.js?apikey=yvh7j8emxisehzfivcbria" async="true"></script>
<?
  endif;
?>
</head>

<body <?php body_class(); ?>>
	<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-T342PPNM"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
    <div class="wrapper">

        <!-- header -->
        <header>
            <div class="header-part">
                <div class="container">
                    <!-- desktop-header -->
                    <div class="desktop-header">
                        <div class="main-area main-content-middle">
                            <div class="main-content-wrap ">
                                <div class="main-col main-left-col">
                                    <div class="header-logo"><?php
                                        $header_logo = imagroup_theme_option( 'header_logo' );
                                        if( !empty($header_logo) ){ ?>
                                            <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="main-element">
                                                <img src="<?php echo esc_url($header_logo['url']); ?>" alt="<?php echo esc_attr($header_logo['alt']); ?>" width="282" height="60">
                                            </a><?php
                                        } ?>
                                    </div>
                                </div>
                                <div class="main-col main-center-col"></div>
                                <div class="main-col main-right-col">
                                    <nav id="menu"><?php
                                        if( has_nav_menu( 'main-menu' ) ){
                                            wp_nav_menu( array( 'theme_location' => 'main-menu', 'items_wrap' => '<ul class="main-menu">%3$s</ul>' ) );
                                        } ?>
                                    </nav>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end-desktop-header -->
                    <!-- mobile-header -->
                    <div class="mobile-header">
                        <div class="main-area main-content-middle">
                            <div class="main-content-wrap ">
                                <div class="main-col main-left-col">
                                    <div class="header-logo"><?php
                                        $header_logo = imagroup_theme_option( 'header_logo' );
                                        if( !empty($header_logo) ){ ?>
                                            <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="main-element">
                                                <img src="<?php echo esc_url($header_logo['url']); ?>" alt="<?php echo esc_attr($header_logo['alt']); ?>" width="282" height="60">
                                            </a><?php
                                        } ?>
                                    </div>
                                </div>
                                <div class="main-col main-center-col"></div>
                                <div class="main-col main-right-col">
                                    <div class="canvas-menu sk-offcanvas main-element">
                                        <a class="sk-dropdown-toggle" data-canvas=".mobile" href="#" title="Menu"><span></span></a>
                                    </div>
                                    <div class="sk-offcanvas-content mobile">
                                        <div class="wp-sidebar">
                                            <div id="sk-mobile-menu" class="navbar-collapse">
                                                <nav><?php
                                                    if( has_nav_menu( 'main-menu' ) ){
                                                        wp_nav_menu( array( 'theme_location' => 'main-menu', 'items_wrap' => '<ul id="menu-main-menu" class="sk-nav-menu sk-mobile-menu">%3$s</ul>' ) );
                                                    } ?>
                                                </nav>
                                            </div>
                                            <div class="after-offcanvas"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end-desktop-header -->
                </div>
            </div>
        </header>
        <!-- header -->

        <!-- main -->
        <main>
            <div id="wp-main-content" class="main-part"><?php
                $notice_information_content = get_field( 'notice_information_content', get_the_id() );
                if( !empty($notice_information_content) ){ ?>
                    <div class="sectop-top-bar">
                        <div class="container">
                            <?php echo imagroup_remove_empty_p( wpautop($notice_information_content) ); ?>
                        </div>
                    </div><?php
                } ?>