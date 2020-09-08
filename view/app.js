var isLogged = false;
var userRole = "";
var userLogin = "";
var userName = "";
var userSurname = "";
var isCaVisible = false;
var CanAddUser = false;
var CanFinishOperation = false;
var CanAddOperation = false;
var data = undefined;

function login(){
    let login = $('#login').val();
    let password = $('#password').val();

    $.ajax({
        url: '../ctrl/authentification.action.php',
        type: 'POST',
        dataType: 'json', //text
        data: {
            login: login,
            password: password,
            action: "login"
        },
        error: function (response) {

            console.log('error');
            console.log(response);
        },
        success: function (response, httpStatusCode) {
            console.log(response);
            userRole = response.role;
            userLogin = response.login;
            userName = response.name;
            userSurname = response.surname;
            isLogged = true;
            SetGlobalVariables();
        },
  /*
        complete : function(response){
            alert("completed");
        }*/
    })
}

function logout() {
    $.ajax({
        url: '../ctrl/authentification.action.php',
        type: 'POST',
        dataType: 'json', //text
        data: {
            action: "logout"
        },
        error: function (response) {
            console.log('error');
            console.log(response);
        },
        success: function (response, httpStatusCode) {
            console.log(response);
            resetGlobalVariables();
        }})
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

function SetGlobalVariables() {
    if (isLogged){
        CanFinishOperation = true;
        CanAddOperation = true;

        if (userRole === "Expert"){
            isCaVisible=true;
            CanAddUser = true;
        }
    }
    else {
        resetGlobalVariables();
    }
    displayInterface();
}

function displayInterface(){
    if(isLogged){
        document.getElementById("profileLink").style.visibility = "visible";
        document.getElementById("addWorkerLink").style.visibility = "hidden";
        document.getElementById("loginLink").style.visibility = "hidden";
        document.getElementById("logoutLink").style.visibility = "visible";
        if (userRole == "Expert"){
            document.getElementById("addWorkerLink").style.visibility = "visible";
        }
    }else {
        document.getElementById("profileLink").style.visibility = "hidden";
        document.getElementById("addWorkerLink").style.visibility = "hidden";
        document.getElementById("loginLink").style.visibility = "visible";
        document.getElementById("logoutLink").style.visibility = "hidden";
    }
}

function resetGlobalVariables(){
    isLogged = false;
    userRole = "";
    userLogin = "";
    userName = "";
    userSurname = "";
    isCaVisible = false;
    CanAddUser = false;
    CanFinishOperation = false;
    CanAddOperation = false;

    displayInterface();
}

function getCa(){

    $.get('../ctrl/adminController.action.php', function( data ) {
        console.log( data);
    }, "json").fail(function() {
        console.log("error");
    })
}
// function login() {
//
//     $.post('../ctrl/authentification.action.php', $('#authentification').serialize(), function (data) {
//         console.log(data);
//     }, "json").fail(function () {
//         console.log("error");
//     })
// }

$(document).ready(function() {

    $.ajax({
        url: '../ctrl/operationController.action.php',
        type: 'POST',
        dataType: 'json', //text
        data: {
            action: "list"
        },
        error: function (response) {
            console.log('error');
            console.log(response);
        },
        success: function (response, httpStatusCode) {
            console.log(response);
            data=response;
            $('#myDatatableAMoi').DataTable({
                data: data,
                columns: [
                    { data: "Description" },
                    { data: "EndDate" },
                    { data: "StartDate" },
                    { data: "Type_Operation" },
                    { data: "name" },
                    { data: "surname" }
                ],
                columnDefs: [
                    { type: "html",  orderable: true, targets: [0, 3, 4 , 5] },
                    { type: "date", targets: 1 }
                ],
                paging: false,
                scrollY: 400,
                ordering: true
            });
        }})
    /*$('#myDatatableAMoi').DataTable({
        "ajax": "../ctrl/operationController.action.php",
        "columns": [
            { "data": "name" },
            { "data": "position" },
            { "data": "office" },
            { "data": "extn" },
            { "data": "start_date" },
            { "data": "salary" }
        ]});*/
    //getOperations();

    resetGlobalVariables();
    displayInterface();

})

