<div class="container" id="wrapper-add-schedule">

    <h3 class="card-title">Add a Schedule</h3>

    <?php
        echo form_open( "schedule/insertSchedule", array(
            "name"  => "frmAddSchedule",
            "id"    => "frmAddSchedule"
        ) );
        
            // Email
            echo form_fieldset( "<i class='pe-7s-note2'></i>&nbsp;Description" );
                echo form_input( array(
                    "class"         => "form-control form-control-sm",
                    "type"          => "text",
                    "name"          => "description",
                    "placeholder"   => "Enter Description Here"
                ), set_value( "description", "" ) );
            echo form_fieldset_close();

            // Password
            echo form_fieldset( "<i class='pe-7s-date'></i>&nbsp;Scheduled Date/Time" );
                echo form_input( array(
                    "class"         => "form-control form-control-sm",
                    "type"          => "text",
                    "name"          => "scheduledAt",
                    "placeholder"   => "Enter Scheduled Date/Time Here"
                ) );
            echo form_fieldset_close();

            // Submit Button
            echo "<div class='row'>";
                echo "<div class='col-sm-6 offset-sm-3'>";
                    echo form_button( array(
                        "type"  => "submit",
                        "name"  => "btnSubmit",
                        "class" => "btn btn-info btn-block mt-3"
                    ), "<i class='pe-7s-note'></i>&nbsp;Add" );
                echo "</div>";
            echo "</div>";

        echo form_close();
    ?>

</div><!-- #wrapper-add-schedule -->