/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */



function getGroupesRatp() {

    yam.getLoginStatus(
            function (response) {
                if (response.authResponse) {
                    console.log("logged in");


                    var j = 1;
                    var groups_tab = [];
                    var y = setInterval(function () {

                        yam.platform.request({
                            url: "groups.json", //this is one of many REST endpoints that are available
                            method: "GET",
                            data: {//use the data object literal to specify parameters, as documented in the REST API section of this developer site
                                "page": j
                            },
                            success: function (groups) { //print message response information to the console
//                                alert("The request was successful.");
                                console.log("HERE");


                                if (groups.length != 0) {
                                    console.log(j);

                                    j++;
                                    
                                    for (var i = 0; i < groups.length; i++) {
                                        groups_tab.push(groups[i]);
                                    }
                                    
                                    var object = JSON.stringify(groups);
                                    console.log(groups_tab);

                                    $.ajax({
                                        type: 'POST',
                                        url: Routing.generate('load_groupes'),
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
//                                    getUsersByGroupRatp(groups_tab);
                                }
                            },
                            error: function (groups) {
                                alert("There was an error with the request.");
                            }
                        });
                    }, 3500);
                } else {
                    alert("not logged in")
                }
            }
    );

}




 