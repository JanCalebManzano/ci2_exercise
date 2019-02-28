<?php $this->load->view( 'partials/header' ); ?>

<body class="dashboard-page">

    <!-- NAVBAR -->
    <nav class="navbar navbar-dark bg-dark mb-5">
        <div class="container">
            <a class="navbar-brand" href="dashboard">
                <img src="<?php echo base_url("resources/images/logo-3.png"); ?>" width="30" height="30" class="d-inline-block align-top" alt="">
                TodoBird
            </a>
            <a class="navbar-brand" href="dashboard">
                <h3 class="text-info">Dashboard</h3>
            </a>
            <a class="btn btn-danger btn-md" href="javascript:logout();" role="button">
                <i class="pe-7s-delete-user"></i>
                Logout
            </a>        
        </div>
    </nav>



    <!-- JUMBOTRON -->
    <div class="container">

        <div class="jumbotron">
            <h1 class="display-4"><?php echo $page_header; ?></h1>
            
            <p class="lead">Welcome to your TodoBird dashboard.</p>
            <hr class="my-4">
            <p class="lead">
                <a class="btn btn-info btn-lg" href="javascript:addSchedule();" role="button">
                    <i class="pe-7s-note"></i>
                    Add a Schedule
                </a>
                
            </p>
        </div><!-- .jumbotron -->
        
    </div><!-- .container -->



    <!-- SCHEDULES -->
    <!-- INFO -->
    <div class="container mb-3">
        <div class="row">
            <div class="col-8 offset-2">
                
                <div class="card bg-dark text-white">
                    <div class="card-body">
                        Here's your schedule for today,
                        <i class="text-info">
                            <?php echo date("d-M-Y"); ?>
                        </i>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- LIST -->
    <div class="container scroll">

            <div class="row" id="schedules-container"></div>

    </div><!-- .container -->


</body>

<?php $this->load->view( 'partials/footer' ); ?>

<!-- SCRIPTS -->
<script>
    window.sessionStorage.setItem( "userID", "<?php echo $this->session->userdata("ID"); ?>" );    
</script>
<script src="<?php echo base_url("resources/js/dashboard.js"); ?>"></script>