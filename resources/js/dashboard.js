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
        swal("Logged out!", "Redirecting to Welcome page...", "success");
        setTimeout( () => {
            window.sessionStorage.setItem( "userID", "" );
            window.location.replace( "auth/logout" );
        }, 2000 );
    } );
};

const addSchedule = () => {

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
                "url": "http://localhost/ci2_exercise/schedule/updateSchedule",
                "method": "POST",
                "headers": {
                  "Content-Type": "application/x-www-form-urlencoded",
                  "cache-control": "no-cache",
                  "Postman-Token": "297bad04-328b-43f0-ade0-f5b48ce4fdf8"
                },
                "data": {
                  "schedID": schedID,
                  "description": inputValue
                }
              }
              
            $.ajax(settings).done(function (response) {
                var responseObj = JSON.parse( response );
                console.log(responseObj);
                
                if( ! responseObj.error ) {
                    swal( "Nice!", "Schedule is successfully updated", "success" );
                    getSchedules();
                }
            });
        }
    });
};

const deleteSchedule = ( schedID ) => {
    alert( "delete:" + schedID );
};

const getSchedules = () => {
    var settings = {
        "async": true,
        "crossDomain": true,
        "url": "http://localhost/ci2_exercise/schedule/getSchedulesByUser",
        "method": "POST",
        "headers": {
          "Content-Type": "application/x-www-form-urlencoded",
          "cache-control": "no-cache",
          "Postman-Token": "d4a18623-0a87-4b9a-a7e6-48135964f25d"
        },
        "data": {
          "userID": window.sessionStorage.getItem("userID")
        }
      }
      
      $.ajax(settings).done( (response) => {
        var responseObj = JSON.parse( response );
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
        }
        
      });
};



// on ready
$(document).ready( () => {

    getSchedules();

} );