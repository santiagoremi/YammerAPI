/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */



function getUsersRatp() {
    yam.getLoginStatus(
            function (response) {
                if (response.authResponse) {
                    console.log("logged in");
                    var j = 1;
                    var users_tab = [];

                    var y = setInterval(function () {
                        yam.platform.request({
                            url: "users.json", //this is one of many REST endpoints that are available
                            method: "GET",
                            data: {//use the data object literal to specify parameters, as documented in the REST API section of this developer site
                                "page": j
                            },
                            success: function (users) { //print message response information to the console
//                                    alert("The request was successful.");
                                console.log("HERE");
                                if (users.length != 0) {

                                    j++;
                                    console.log(j);
                                    for (var i = 0; i < users.length; i++) {
                                        users_tab.push(users[i]);
                                    }
                                    var object = JSON.stringify(users);
                                    console.log(users_tab);


                                    $.ajax({
                                        type: 'POST',
                                        url: Routing.generate('load_users'),
                                        contentType: 'application/json',
                                        data: object,
                                        datatype: "json",
                                        complete: function (object) {
                                            $('#target').html(object);
                                        }
                                    });

                                } else {
                                    clearInterval(y);
                                    console.log("okokok");
                                    getGroupesRatp();
                                }
                            },
                            error: function (users) {
                                alert("There was an error with the request.");
                            }
                        });
                    }, 3500);
                }
            });
}


