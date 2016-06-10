/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */



function getDate(groupe_id) {

    var date_debut = document.getElementById('date_debut').value;
    var date_fin = document.getElementById('date_fin').value;

    var date = [];
    date.push(date_debut);
    date.push(date_fin);


    $.ajax({
        type: 'POST',
//        /summarygroupbydate/{groupe_id}
        url: 'http://localhost/ExportApiYammer/web/app_dev.php/summarygroupbydate/' + groupe_id,
//        url: Routing.generate('summary_groupe_by_date', {groupe_id: groupe_id}),
        contentType: 'application/json',
        data: JSON.stringify(date),
        datatype: "json"

    });


}




 