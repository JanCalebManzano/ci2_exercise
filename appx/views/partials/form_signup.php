<div class="container" id="wrapper-signup" style="display:none;">

    <h3 class="card-title">Signup</h3>
    
    <?php
        echo form_open( "auth/signup", array(
            "name"  => "frmSignup",
            "id"    => "frmSignup"
        ) );

            // Email
            echo form_fieldset( "<i class='pe-7s-mail'></i>&nbspEmail Address" );
                echo form_input( array(
                    "class"         => "form-control form-control-sm",
                    "type"          => "text",
                    "name"          => "email",
                    "placeholder"   => "Enter Email Address Here"
                ), set_value( "email", "" ) );
            echo form_fieldset_close();

            // Password
            echo form_fieldset( "<i class='pe-7s-key'></i>&nbspPassword" );
                echo form_input( array(
                    "class"         => "form-control form-control-sm",
                    "type"          => "password",
                    "name"          => "password",
                    "placeholder"   => "Enter Password Here"
                ) );
            echo form_fieldset_close();

            // Password Confirm
            echo form_fieldset( "<i class='pe-7s-key'></i>&nbspConfirm Password" );
                echo form_input( array(
                    "class"         => "form-control form-control-sm",
                    "type"          => "password",
                    "name"          => "password_confirm",
                    "placeholder"   => "Enter Password Here"
                ) );
            echo form_fieldset_close();

            // Submit Button
            echo "<div class='row'>";
                echo "<div class='col-sm-6 offset-sm-3'>";
                    echo form_button( array(
                        "type"  => "submit",
                        "name"  => "btnSubmit",
                        "class" => "btn btn-info btn-block mt-3"
                    ), "<i class='pe-7s-user'></i>&nbspSignup" );
                echo "</div>";
            echo "</div>";

        echo form_close();
    ?>

    <a href="#" class="card-link text-info float-right" id="toggle-login">Already have an account? Login here</a>
                            
</div><!-- #wrapper-signup -->