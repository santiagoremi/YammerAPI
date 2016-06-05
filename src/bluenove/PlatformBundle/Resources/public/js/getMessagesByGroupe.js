///* 
// * To change this license header, choose License Headers in Project Properties.
// * To change this template file, choose Tools | Templates
// * and open the template in the editor.
// */
///* 
// * To change this license header, choose License Headers in Project Properties.
// * To change this template file, choose Tools | Templates
// * and open the template in the editor.
// */



function getMessagesByGroupe(group_id) {
//    var group_id = document.getElementById('group_id').value;
//    var olderID = document.getElementById('page_id').value;

    var tab = [];
    console.log(group_id);
    yam.getLoginStatus(
            function (response) {
                if (response.authResponse) {


                    console.log("logged in");
                    yam.platform.request({
                        url: "messages/in_group/" + group_id + ".json", //this is one of many REST endpoints that are available
                        method: "GET",
                        data: {//use the data object literal to specify parameters, as documented in the REST API section of this developer site
//                            "threaded": "true"
                        },
                        success: function (messages) { //print message response information to the console
//                            alert("The request was successful.");
                            console.log("HERE");
                            var object = messages["messages"];
                            var older = messages["meta"]["older_available"];
//                            console.log(JSON.stringify(object));
                            console.log(messages["messages"].length);
                            console.log(older);
                            $.ajax({
                                type: 'POST',
                                url: Routing.generate('load_messages'),
                                contentType: 'application/json',
                                data: JSON.stringify(object),
                                datatype: "json"

                            });

                            var p;
                            for (p = 0; p < messages["messages"].length; p++) {
                                tab.push(messages["messages"][p]["id"]);

                            }


                            if (tab.length > 10) {
                                var id = messages["messages"][10]["id"];
                                var x = setInterval(function () {

                                    console.log(id);
                                    console.log(group_id);
                                    yam.platform.request({
                                        url: "messages/in_group/" + group_id + ".json", //this is one of many REST endpoints that are available
                                        method: "GET",
//                                    timeout: 30000,
                                        data: {//use the data object literal to specify parameters, as documented in the REST API section of this developer site
//                                        "threaded": "true",
                                            "older_than": id
                                        },
                                        success: function (messages) { //print message response information to the console
//                                        alert("The request was successful.");
                                            console.log("HERE2");
                                            var object = messages["messages"];
                                            older = messages["meta"]["older_available"];
                                            console.log(object);
                                            console.log(older);
                                            $.ajax({
                                                type: 'POST',
                                                url: Routing.generate('load_messages'),
                                                contentType: 'application/json',
                                                data: JSON.stringify(object),
                                                datatype: "json"

                                            });


                                            for (p = 0; p < messages["messages"].length; p++) {
                                                tab.push(messages["messages"][p]["id"]);

                                            }

                                            if (older === false) {

                                                console.log("okokok");
                                                clearInterval(x);
                                                console.log(tab);


                                                var i = 0;
                                                var y = setInterval(function () {


                                                    yam.platform.request({
                                                        url: "users/liked_message/" + tab[i] + ".json", //this is one of many REST endpoints that are available
                                                        method: "GET",
                                                        success: function (likes) { //print message response information to the console
//                            alert("The request was successful.");
                                                            console.log("HERE");
//                                                        console.log(messages);
                                                            var object = likes["users"];
                                                            var older = likes["meta"]["more_available"];

                                                            if (object) {
                                                                $.ajax({
                                                                    type: 'POST',
                                                                    url: Routing.generate('load_likes', {messages_id: tab[i]}),
                                                                    contentType: 'application/json',
                                                                    data: JSON.stringify(object),
                                                                    datatype: "json"

                                                                });
                                                            }

                                                            var len = tab.length - 1;

                                                            console.log(i);

                                                            if (i >= len) {

                                                                console.log("okokok");
                                                                clearInterval(y);
                                                                tab = [];
                                                            }
                                                            i++;



                                                        },
                                                        error: function (likes) {
                                                            alert("There was an error with the  like request.");
                                                        }
                                                    });


                                                }, 2000);



                                            } else {

                                                id = messages["messages"][10]["id"];
                                            }

                                        },
                                        error: function (messages) {
                                            alert("There was an error with the request.");
                                        }
                                    });
                                }, 5000);
                            } else {
                                if (tab.length > 0) {
                                    var i = 0;
                                    var y = setInterval(function () {


                                        yam.platform.request({
                                            url: "users/liked_message/" + tab[i] + ".json", //this is one of many REST endpoints that are available
                                            method: "GET",
                                            success: function (likes) { //print message response information to the console
//                            alert("The request was successful.");
                                                console.log("HERE");
//                                                        console.log(messages);
                                                var object = likes["users"];
                                                var older = likes["meta"]["more_available"];

                                                if (object) {
                                                    $.ajax({
                                                        type: 'POST',
                                                        url: Routing.generate('load_likes', {messages_id: tab[i]}),
                                                        contentType: 'application/json',
                                                        data: JSON.stringify(object),
                                                        datatype: "json"

                                                    });
                                                }

                                                var len = tab.length - 1;

                                                console.log(i);

                                                if (i >= len) {

                                                    console.log("okokok");
                                                    clearInterval(y);
                                                    tab = [];
                                                }
                                                i++;



                                            },
                                            error: function (likes) {
                                                alert("There was an error with the  like request.");
                                            }
                                        });


                                    }, 2000);


                                } else {
                                  alert("There is no messages in this group.");

                                }
                            }
                        },
                        error: function (messages) {
                            alert("There was an error with the request.");
                        }

                    });
                } else {
                    alert("not logged in");
                }
            }
    );
}






