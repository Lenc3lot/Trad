function MaFonction(monOption){
    let monPath = monOption.getAttribute('data-path');
    alert("bonjour " +monPath);
}

function sendData(monInput){
    let monAttribut = monInput.getAttribute('data-id');
    let contenu = monInput.value;
    alert (monAttribut + " " +contenu);
    $.ajax({
        url:"http://localhost/Trad/trad/CopierDonnee.php",
        type:"post",
        data:"monAttribut="+monAttribut+"&contenu="+contenu,
        success: function(data,statut){

        },
        error: function(data,result,statut){

        },
        complete : function(data,statut){
        }

    })
    // alert(monInput.getAttribute('data-id') + ' ' + monInput.parentNode.parentNode.getElementsByTagName('TD')[1].innerHTML); //avant l'espace vide = le data-id à la chaine "tab1.tab2..." de l'autre côté
} 