const logout = () => {
    swal( {
        title: "Logout",
        text: "Are you sure you want to logout?",
        type: "warning",
        showCancelButton: true,
        confirmButtonClass: "btn-danger",
        confirmButtonText: "Logout",
        closeOnConfirm: false
    }, function(){
        swal( "Logged out!", "Redirecting to Welcome page...", "success" );
        setTimeout( () => {
            window.sessionStorage.setItem( "userID", "" );
            window.location.replace( "auth/logout" );
        }, 2000 );
    } );
};

const addSchedule = () => {
    swal( {
        title: "Add a Schedule",
        text: `
        <div class="container mt-5">
            <form action="http://localhost/ci2_exercise/schedule/insertSchedule" method="post" accept-charset="utf-8" name="frmAddSchedule" id="frmAddSchedule">
                <fieldset>
                    <legend><i class="pe-7s-note2"></i>&nbsp;Description</legend>
                    <input type="text" name="description" value="" class="form-control form-control-sm" placeholder="Enter Description Here">
                </fieldset>
                <fieldset>
                    <legend>
                        <i class="pe-7s-date"></i>&nbsp;Scheduled Date/Time
                    </legend>
                    <input type="date" name="scheduledDate" value="" class="form-control form-control-sm" placeholder="Enter Scheduled Date Here">
                    <input type="text" name="scheduledTime" value="" class="form-control form-control-sm" placeholder="Enter Scheduled Time Here (HH:mm:ss)">
                </fieldset>
            </form>
        </div>
        `,
        type: "success",
        html: true,
        showCancelButton: true,
        closeOnConfirm: false,
        confirmButtonText: "Add"
    }, () => {
        var frmAddSchedule = document.forms["frmAddSchedule"];
        var settings = {
            "async": true,
            "crossDomain": true,
            "url": "./schedule/insertSchedule",
            "method": "POST",
            "headers": {
              "content-type": "application/x-www-form-urlencoded",
              "cache-control": "no-cache",
              "postman-token": "1641ecd7-e091-a067-0af6-98435960c2bf"
            },
            "data": {
              "scheduledAt": ( frmAddSchedule["scheduledDate"].value + " " + frmAddSchedule["scheduledTime"].value ),
              "description": frmAddSchedule["description"].value,
              "createdBy": window.sessionStorage.getItem("userID")
            },
            "success": ( responseObj ) => {                    
                if( ! responseObj.error ) {
                    swal( "Nice!", "Schedule is successfully added", "success" );
                    getSchedules();
                }
            },
            "error": ( response ) => {
                var responseObj = response.responseJSON;
                if( responseObj.error ) {                
                    $.notify(
                        {
                            icon: "pe-7s-attention",
                            title: "<b>Error: </b>",
                            message: responseObj.message
                        }, {
                            type: "danger",
                            timer: 5000
                        }
                    );
                }
            }
        };
          
        $.ajax(settings);
    } );
};

const editSchedule = ( schedID, description ) => {
    swal({
        title: "Update Schedule",
        text: "Description",
        type: "input",
        showCancelButton: true,
        closeOnConfirm: false,
        animation: "slide-from-top",
        inputPlaceholder: "Enter Description Here",
        inputValue: description
    }, function (inputValue) {
        if (inputValue === false) return false;
        if (inputValue === "") {
            swal.showInputError("You need to write something!");
            return false;
        } else {

            var settings = {
                "async": true,
                "crossDomain": true,
                "url": "./schedule/updateSchedule",
                "method": "POST",
                "headers": {
                    "content-type": "application/x-www-form-urlencoded",
                    "cache-control": "no-cache",
                    "postman-token": "22f42b67-4cd0-db63-e6d3-0a0054a525fa"
                },
                "data": {
                    "schedID": schedID,
                    "description": inputValue
                },
                "success": ( responseObj ) => {                    
                    if( ! responseObj.error ) {
                        swal( "Nice!", "Schedule is successfully updated", "success" );
                        getSchedules();
                    }
                },
                "error": ( response ) => {
                    var responseObj = response.responseJSON;
                    if( responseObj.error ) {                
                        $.notify(
                            {
                                icon: "pe-7s-attention",
                                title: "<b>Error: </b>",
                                message: responseObj.message
                            }, {
                                type: "danger",
                                timer: 5000
                            }
                        );
                    }
                }
            };
              
            $.ajax(settings);

        }
    });
};

const deleteSchedule = ( schedID ) => {
    var settings = {
        "async": true,
        "crossDomain": true,
        "url": "./schedule/deleteSchedule",
        "method": "POST",
        "headers": {
          "content-type": "application/x-www-form-urlencoded",
          "cache-control": "no-cache",
          "postman-token": "1144aacf-e425-bf77-56c1-eea155e497d9"
        },
        "data": {
          "schedID": schedID
        },
        "success": ( responseObj ) => {
            if( ! responseObj.error ) {
                swal( "Deleted!", "Schedule is deleted successfully...", "success" );
                getSchedules();
            }
        },
        "error": ( response ) => {
            var responseObj = response.responseJSON;
            if( responseObj.error ) {                
                $.notify(
                    {
                        icon: "pe-7s-attention",
                        title: "<b>Error: </b>",
                        message: responseObj.message
                    }, {
                        type: "danger",
                        timer: 5000
                    }
                );
            }
        }
    }

    swal( {
        title: "Delete",
        text: "Are you sure you want to delete this schedule?",
        type: "warning",
        showCancelButton: true,
        confirmButtonClass: "btn-danger",
        confirmButtonText: "Delete",
        closeOnConfirm: false
    }, function(){        
        $.ajax(settings);
    } );
      
};

const getSchedules = () => {
    var settings = {
        "async": true,
        "crossDomain": true,
        "url": "./schedule/getSchedulesByUser",
        "method": "POST",
        "headers": {
          "content-type": "application/x-www-form-urlencoded",
          "cache-control": "no-cache",
          "postman-token": "935cff40-cc1d-3e43-c461-9cb1628140d0"
        },
        "data": {
          "userID": window.sessionStorage.getItem("userID")
        },
        "success": ( responseObj ) => {
            var schedulesContainer = $(`#schedules-container`);
                schedulesContainer.html(null);
            
            if( ! responseObj.error ) {
                if( responseObj.count > 0 ) {
                    for( var x=0; x<responseObj.count; x++ ) {
                        var sched = responseObj.data[x];
                        var schedTime = sched.scheduledAt.split(" ")[1];
                        
                        var schedEl = `
                            <div class=\"card border-info bg-dark text-dark col-5 mb-1 mr-4 ml-5\">
                                <div class=\"card-header\">
                                    <ul class=\"nav nav-pills card-header-pills float-right\">
                                        <li class=\"nav-item\">
                                            <a class=\"nav-link active bg-warning mr-1\" href=\"javascript:editSchedule(${sched.ID}, \'${sched.description}\')\">Edit</a>
                                        </li>
                                        <li class=\"nav-item\">
                                            <a class=\"nav-link active bg-danger\" href=\'javascript:deleteSchedule(${sched.ID})\'>Delete</a>
                                        </li>
                                    </ul>
                                </div>
                                <div class=\"card-body rounded bg-light\">
                                    <span class=\"text-warning\">
                                        <i class=\"pe-7s-ribbon\"></i>
                                    </span>
                                    ${sched.description}
                                </div>
                                <div class=\"card-footer rounded bg-light mt-1 mb-2\">
                                    <span class=\"text-warning\">
                                        <i class=\"pe-7s-stopwatch\"></i>
                                    </span>
                                    ${schedTime}
                                </div>
                            </div>`;
    
                        schedulesContainer.html( schedulesContainer.html() + schedEl );
                    }
                }

                var infoEl = $(`#schedule-info`);
                infoEl.html( responseObj.message );
            }        
        },
        "error": ( response ) => {
            var responseObj = response.responseJSON;
            if( responseObj.error ) {                
              $.notify(
                  {
                      icon: "pe-7s-attention",
                      title: "<b>Error: </b>",
                      message: responseObj.message
                  }, {
                      type: "danger",
                      timer: 5000
                  }
              );

              var infoEl = $(`#schedule-info`);
              infoEl.html( responseObj.message );
            }
        }
    };
      
    $.ajax(settings);
};



// on ready
$(document).ready( () => {

    getSchedules();

} );