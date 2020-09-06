function login(login,password){
    $.ajax({
        url: '../ctrl/authentification.action.php',
        type: 'POST',
        dataType: 'json', //text
        data: {
            username: login,
            password: password

        },
        error: function (response, status, titi) {
            console.log(titi);
            console.log('error');
            console.log(response);


        },
        success: function (response, status) {
          // let json = $.parseJSON(response);
            console.log(response);
            console.log(status);
            $('#login').val(response);

        },
  /*
        complete : function(response){
            alert("completed");
        }*/
    })
}

function getOperations(){
    $.ajax({
        url: '../ctrl/operationController.action.php',
        type: 'GET',
        dataType: 'json', //text

        error: function (response, status, titi) {
            console.log(titi);
            console.log('error');
            console.log(response);


        },
        success: function (response, status) {
            //let json = $.parseJSON(response);
            console.log(response);
            console.log(status);


        },
        /*
              complete : function(response){
                  alert("completed");
              }*/
    })
}
$(document).ready(function() {
    //login(10, 24);
    //login(1, 85233);
    $('#datatable').DataTable({
        "ajax": "../ctrl/operationController.action.php",
        "columns": [
            { "data": "name" },
            { "data": "position" },
            { "data": "office" },
            { "data": "extn" },
            { "data": "start_date" },
            { "data": "salary" }
        ]});
    getOperations();
})