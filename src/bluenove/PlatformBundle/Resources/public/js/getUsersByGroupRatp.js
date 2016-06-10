/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */



function getUsersByGroupRatp(group_id) {

//
    var i = 1;
//    var len = groups.length - 1;
    yam.getLoginStatus(
            function (response) {
                if (response.authResponse) {


                    console.log("logged in");

                    var x = setInterval(function () {
                        yam.platform.request({
                            url: "users/in_group/" + group_id + ".json", //this is one of many REST endpoints that are available
                            method: "GET",
                            data: {//use the data object literal to specify parameters, as documented in the REST API section of this developer site
//                                        "threaded": "true",
                                "page": i
                            },
                            success: function (users) { //print message response information to the console
//                            alert("The request was successful.");
                                console.log("HERE");
                                var object = users["users"];
                                var older = users["more_available"];
                                console.log(users["more_available"]);

                                console.log(older);
                                if (object) {
                                    $.ajax({
                                        type: 'POST',
                                        url: 'http://localhost/ExportApiYammer/web/app_dev.php/users/' + group_id,
//                                        url: Routing.generate('load_users_by_groupes', {group_id: group_id}),
                                                contentType: 'application/json',
                                        data: JSON.stringify(object),
                                        datatype: "json"

                                    });
                                }
                                if (older === false) {
                                    console.log("okokok");
                                    clearInterval(x);
                                    getMessagesByGroupe(group_id);
                                } else {
                                    i++;

                                }
                            }
                            ,
                            error: function (users) {
                                alert("You are not allowed to access to that group .");

                            }
                        });


                    }, 6000);
                }
            }
    )

}






