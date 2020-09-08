

function login(){
    login = $('#login').val();
    password = $('#password').val();

    $.ajax({
        url: '../ctrl/authentification.action.php',
        type: 'POST',
        dataType: 'json', //text
        data: {
            login: login,
            password: password

        },
        error: function (response) {

            console.log('error');
            console.log(response);


        },
        success: function (response) {
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
function addWorker() {

    $.post('../ctrl/adminController.action.php', $('#formWorker').serialize(), function (data) {
        console.log(data);
    }, "json").fail(function () {
        console.log("error");
    })
}

function addOperation(){

    $.post('../ctrl/operationController.action.php', $('#formAddOperation').serialize(),function( data ) {
        console.log( data);
    }, "json").fail(function() {
        console.log( "error" );
    })
    // var jqxhr = $.post( "example.php", function() {
    //     alert( "success" );
    // })
    //     .done(function() {
    //         alert( "second success" );
    //     })
    //     .fail(function() {
    //         alert( "error" );
    //     })
    //     .always(function() {
    //         alert( "finished" );
    //     });
}

// function login() {
//
//     $.post('../ctrl/authentification.action.php', $('#authentification').serialize(), function (data) {
//         console.log(data);
//     }, "json").fail(function () {
//         console.log("error");
//     })
// }
/*
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

 */