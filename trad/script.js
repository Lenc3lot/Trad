const boutonConnexion = document.getElementById("connexion");

function MaFonction(monOption){
    let monPath = monOption.getAttribute('data-path');
}

function sendData(monInput){
    let monAttribut = monInput.getAttribute('data-id');
    let contenu = monInput.value;
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
} 

boutonConnexion.addEventListener("click",function(){
    window  .location.href = "./connexion.php";
})