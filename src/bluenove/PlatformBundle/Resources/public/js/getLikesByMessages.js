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



function getLikesByMessages(messages) {
    console.log(messages);
    yam.getLoginStatus(
            function (response) {
                if (response.authResponse) {
                    console.log("logged in");

                    var i = 0;
                    var x = setInterval(function () {



                        yam.platform.request({
                            url: "users/liked_message/" + messages[i] + ".json", //this is one of many REST endpoints that are available
                            method: "GET",
//                        data: {//use the data object literal to specify parameters, as documented in the REST API section of this developer site
//                            "threaded": "true"
//                        },


                            success: function (likes) { //print message response information to the console
//                            alert("The request was successful.");
                                console.log("HERE");
                                console.log(messages);
                                console.log(messages[i]);
                                var object = likes["users"];
                                var older = likes["meta"]["more_available"];

                                if (object) {
                                    $.ajax({
                                        type: 'POST',
                                        url: Routing.generate('load_likes', {messages_id: messages[i]}),
                                        contentType: 'application/json',
                                        data: JSON.stringify(object),
                                        datatype: "json"

                                    });
                                }

                                var len = messages.length-1;

                                console.log(i);

                                if (i >= len) {

                                    console.log("okokok");
                                    clearInterval(x);
                                }
                                i++;





                            },
                            error: function (likes) {
                                alert("There was an error with the request.");
                            }
                        });


                    }, 2000);


                } else {
                    alert("not logged in");
                }
            }
    );
}






