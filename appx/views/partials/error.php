<?php
    if( validation_errors() ) { 
        echo validation_errors( "<script>$.notify({icon:\"pe-7s-attention\",title:\"<b>Error: </b>\",message:\"", "\"},{type:\"danger\", timer:5000});</script>" );    
    }
?>
<?php if( isset( $error_extra ) ) { ?>
    <script>
        $.notify(
            {
                icon: "pe-7s-attention",
                title: "<b>Error: </b>",
                message: "<?php echo $error_extra; ?>"
            }, {
                type: "danger",
                timer: 5000
            }
        );
    </script>
<?php } ?>