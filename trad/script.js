function Test (selfkey){
    alert (selfkey.toString());
    let id = document.getElementById(selfkey).value;
    alert('Modif effectuée !');
    $.ajax({
        url:"http://localhost/Trad/trad/CopierDonnee.php",
        type:"post",
        data:"FRkey="+id,
        success: function(data,statut){

        },
        error: function(data,result,statut){

        },
        complete : function(data,statut){
        }


    })
}