/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */



function getDateUser() {

    var date_debut = document.getElementById('date_debut').value;
    var date_fin = document.getElementById('date_fin').value;

    var date = [];
    date.push(date_debut);
    date.push(date_fin);


    $.ajax({
        type: 'POST',
        url: 'http://localhost/YammerAPI/web/app_dev.php/users/usersbydate',
//        url: Routing.generate('user_by_date'),
        contentType: 'application/json',
        data: JSON.stringify(date),
        datatype: "json"

    });

    console.log("here");
    console.log(date);

}




 