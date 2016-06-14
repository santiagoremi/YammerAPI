/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function getMessages() {

    yam.getLoginStatus(
            function (response) {
                if (response.authResponse) {
                    console.log("logged in");
                    yam.platform.request({
                        url: "messages.json", //this is one of many REST endpoints that are available
                        method: "GET",
                        data: {//use the data object literal to specify parameters, as documented in the REST API section of this developer site
                            "threaded": "true",
                            "limit": "100"

                        },
                        success: function (messages) { //print message response information to the console
                            alert("The request was successful.");
                            console.dir(messages);


                            var object = JSON.stringify(messages);


                            $.ajax({
                                type: 'POST',
                                url: 'http://localhost/YammerAPI/web/app_dev.php/messages',
//                                url: Routing.generate('load_messages'),
                                        contentType: 'application/json',
                                data: object,
                                datatype: "json",
                                complete: function (object) {
                                    $('#target').html(object);
                                }
                            });


                        },
                        error: function (messages) {
                            alert("There was an error with the request.");
                        }
                    });
                } else {
                    alert("not logged in")
                }
            }
    );
}
