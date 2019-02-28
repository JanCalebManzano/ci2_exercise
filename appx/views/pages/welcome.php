<?php $this->load->view( 'partials/header' ); ?>

<body class="welcome-page">

    <video autoplay muted loop id="welcome-vid">
        <source src="<?php echo base_url("resources/images/welcome-vid-2.mov"); ?>">
        Your browser does not support HTML5 video.
    </video>

    <div id="cover">

        <div class="container mt-5">
    
            <div class="row">
    
                <div class="col-sm-6 offset-sm-3">

                    <div class="card">

                        
                        <div class="card-header bg-dark">
                            <img class="float-right" src="<?php echo base_url("resources/images/logo-3.png"); ?>" alt="card-img" width="120px">
                            <h2 class="text-info float-right">TodoBird</h2>
                        </div>

                        <div class="card-body">

                            <?php $this->load->view( "partials/form_login" ); ?>

                            <?php $this->load->view( "partials/form_signup" ); ?>
                            
                            <?php if( $signup == true ) { ?>
                                <script>
                                    $(`div#wrapper-login`).hide();
                                    $(`div#wrapper-signup`).show(`medium`);
                                </script>
                            <?php } else if( $signup == false ) { ?>
                                <script>
                                    $(`div#wrapper-signup`).hide();
                                    $(`div#wrapper-login`).show(`medium`);
                                </script>
                            <?php } ?>
    
                        </div><!-- .card-body -->

                    </div><!-- ..card -->                    

                </div><!-- .col -->
    
            </div><!-- .row -->
    
        </div><!-- .container -->

    </div><!-- #cover -->

</body>
    
<?php $this->load->view( "partials/footer" ); ?>

<!-- SCRIPTS -->
<script src="<?php echo base_url("resources/js/welcome.js"); ?>"></script>

<?php $this->load->view( "partials/error" ); ?>