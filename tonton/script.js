function Test (){
    let id = document.getElementById("FRkey").value;
    let champ1 = document.getElementById("FRelementINTIT").value;
    let champ2 = document.getElementById("FR_desc").value;
    alert('Modif effectuée !');
    $.ajax({
        url:"http://localhost/Trad/tonton/CopierDonnee.php",
        type:"post",
        data:"FRkey="+id+"&FRelementINTIT="+champ1+"FR_desc="+champ2,
        success: function(data,statut){

        },
        error: function(data,result,statut){

        },
        complete : function(data,statut){
        }


    })
}