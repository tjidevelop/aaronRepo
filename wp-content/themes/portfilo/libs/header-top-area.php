<!-- header section -->
<header>
    <nav role="navigation" class="navbar navbar-inverse custom-nav">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
                
            <div class="navbar-header">
                <button data-target="#bs-example-navbar-collapse-1" data-toggle="collapse" class="navbar-toggle collapsed" type="button" aria-expanded="false">
                    <span class="sr-only"><?php _e( 'Toggle navigation' , 'portfilo' ); ?></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                    <?php portfilo_portfolio_logo(); ?>
            </div>
                <!-- Collect the nav links, forms, and other content for toggling -->
                <div id="bs-example-navbar-collapse-1" class="navbar-collapse collapse" style="height: 1px;">
                    <?php portfilo_wp_nav_menu(); ?>
                </div><!-- /.navbar-collapse -->
        </div><!-- /.container -->
    </nav>
</header>
<!-- header section end -->