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

function afficherValues(monInput){
    //On récupère le path du fichier et le nom de la propriété à modifier 
    let filePath = monInput.getAttribute("data-tab");
    let currentObj = monInput.innerHTML;
    console.log(currentObj);
        $.ajax({
        url:"http://localhost/Trad/trad/test.php",
        type:"post",
        data:"monFichier="+filePath,
        dataType:"json",
        success: function(data,statut){
            console.log("blop");
            let recup = data
            entries = Object.entries(recup);
            console.log(entries);
            entries.forEach(element => {
                console.log(element);
            });
            // console.log(test.DefaultAttunement.Name);
        },
        error: function(data,result,statut){
            console.log(result);

        },
        complete : function(data,statut){
        }
    })
}