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
var inProgressOperationDatatable = undefined;
var finishedOperationDatatable = undefined;

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
            document.location.reload(true);
        },
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
            document.location.reload(true);
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
    })
}
function addWorker() {

    $.post('../ctrl/addWorker.action.php', $('#formWorker').serialize(), function (data) {
        console.log(data);
        document.location.reload(true);
    }, "json").fail(function () {
        console.log("error");
   })
 }

function addOperation() {

    $.post('../ctrl/addOperation.action.php', $('#formAddOperation').serialize(), function (data) {
        console.log(data);
        document.location.reload(true);
    }, "json").fail(function () {
        console.log("error");
    })
}


function finishOperationById() {
    let idOperation = $('#idOperation').val();


    $.ajax({
        url: '../ctrl/finishOperation.action.php',
        type: 'POST',
        dataType: 'json', //text
        data: {
            idOperation: idOperation,
        },
        error: function (response) {

            console.log('error');
            console.log(response);
        },
        success: function (response) {
            console.log(response);
            document.location.reload(true);
        }
     })
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
        document.getElementById("calculCA").style.visibility = "hidden";
        document.getElementById("loginLink").style.visibility = "hidden";
        document.getElementById("addOperationLink").style.visibility = "visible";
        document.getElementById("finishOperationLink").style.visibility = "visible";
        document.getElementById("logoutLink").style.visibility = "visible";

        if (userRole == "expert"){
            document.getElementById("addWorkerLink").style.visibility = "visible";
            document.getElementById("calculCA").style.visibility = "visible";
        }
    }else {
        document.getElementById("profileLink").style.visibility = "hidden";
        document.getElementById("addWorkerLink").style.visibility = "hidden";
        document.getElementById("addOperationLink").style.visibility = "hidden";
        document.getElementById("finishOperationLink").style.visibility = "hidden";
        document.getElementById("calculCA").style.visibility = "hidden";
        document.getElementById("loginLink").style.visibility = "visible";
        document.getElementById("logoutLink").style.visibility = "hidden";
    }

    setInProgressOperationDatatable();

    setFinishedOperationDatatable();
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

    $.ajax({
        url: '../ctrl/adminController.action.php',
        type: 'POST',
        dataType: 'json', //text
        data: {

            action: "getCa"
        },
        error: function (response) {

            console.log('error');
            console.log(response);
        },
        success: function (response, httpStatusCode) {
          alert(response);

        }
    })
}

function getLoggedUser(){
    $.ajax({
        url: '../ctrl/getUser.action.php',
        type: 'GET',
        dataType: 'json', //text
        error: function (response) {
            console.log('error');
            console.log(response);
        },
        success: function (response, httpStatusCode) {
            console.log(response.login);
            if (response == "NoUserLogged"){
                resetGlobalVariables();
            }
            else{
                isLogged = true;
                userLogin = response.login;
                userRole = response.role;
                userName = response.name;
                userSurname = response.surname;
                SetGlobalVariables();
            }
        }})
}


function setInProgressOperationDatatable(){
$.ajax({
        url: '../ctrl/getInProgressOperations.action.php',
        type: 'POST',
        dataType: 'json', //text
        error: function (response) {
            console.log('error');
            console.log(response);
        },
        success: function (response, httpStatusCode) {
            console.log(response);
            data=response;
            inProgressOperationDatatable = $('#inProgressOperationTable').DataTable({
                data: data,
                columns: [
                    { data: "login", title: "login" },
                    { data: "Id_Operation", title: "N° Operation" },
                    { data: "Description", title: "Description"},
                    { data: "StartDate", title: "Debut" },
                    { data: "EndDate", title: "Fin" },
                    { data: "Type_Operation", title: "Type" },
                    { data: "name", title: "Name" },
                    { data: "surname", title: "Surname" }
                ],
                paging: false,
                scrollY: 400,
                ordering: true
            });
        }})

}

function setFinishedOperationDatatable(){

    $.ajax({
        url: '../ctrl/getFinishedOperations.action.php',
        type: 'POST',
        dataType: 'json', //text
        error: function (response) {
            console.log('error');
            console.log(response);
        },
        success: function (response, httpStatusCode) {
            console.log(response);
            data=response;
            finishedOperationDatatable = $('#finishedOperationTable').DataTable({
                data: data,
                columns: [
                    { data: "login", title: "login" },
                    { data: "Id_Operation", title: "N° Operation" },
                    { data: "Description", title: "Description"},
                    { data: "StartDate", title: "Debut" },
                    { data: "EndDate", title: "Fin" },
                    { data: "Type_Operation", title: "Type" },
                    { data: "name", title: "Name" },
                    { data: "surname", title: "Surname" }
                ],
                paging: false,
                scrollY: 400,
                ordering: true
            });
        }})

}

$(document).ready(function() {

    getLoggedUser();

})

