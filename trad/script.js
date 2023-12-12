function MaFonction(monOption) {
    let monPath = monOption.getAttribute('data-path');
}

function sendData(monInput) {
    let monAttribut = monInput.getAttribute('data-id');
    let contenu = monInput.value;
    $.ajax({
        url: "http://localhost/Trad/trad/CopierDonnee.php",
        type: "post",
        data: "monAttribut=" + monAttribut + "&contenu=" + contenu,
        success: function (data, statut) {

        },
        error: function (data, result, statut) {

        },
        complete: function (data, statut) {
        }

    })
}

function afficherValues(monInput) {
    //On récupère le path du fichier et le nom de la propriété à modifier 
    let filePath = monInput.getAttribute("data-tab");
    let currentObj = monInput.innerHTML;
    // console.log(currentObj);
    $.ajax({
        url: "http://localhost/Trad/trad/test.php",
        type: "post",
        data: "monFichier=" + filePath,
        dataType: "json",
        success: function (data, statut) {
            let recup = data
            let entries = Object.entries(recup);
            //Blagounette, ca renvoie un objet le parser HJSON de merde
            for (const [key, value] of entries) {
                //Spécifique au fichier config de MERDE
                if (key == "CalamityConfig") {              
                    for (const [keyCfg,valueCfg] of Object.entries(value)){
                        //Parcoure toutes les données de l'objet renvoyé du fichier config de MERDE
                        if(keyCfg == currentObj && typeof(valueCfg) != "object"){
                            //Afficher l'élément si le ValueCfg est pas un objet tiré du fichier config de MERDE
                            console.log("Key :"+keyCfg + "\nValue : "+valueCfg);
                        }else if(keyCfg == currentObj && typeof(valueCfg) == "object"){
                            //Reparcoure toutes les données de l'objet sousjascent tiré du fichier config de MERDE
                            for (const [keyCfg2,valueCfg2] of Object.entries(valueCfg)){
                            //Afficher l'élément si le valueCfg2 est pas un objet tiré du fichier config de MERDE
                                console.log("Key : "+keyCfg2+"\nValue : "+valueCfg2);
                            }
                        }
                    }
                } else if (key == currentObj && key != "CalamityConfig") {
                    if (typeof (value) != "object") {
                        //Afficher l'élément si le value est pas un objet
                        console.log(key + " : " + value);
                    } else {
                        for (const [key, value2] of Object.entries(value)) {
                            //Reparcoure toutes les données de l'objet sousjascent 
                            //Afficher l'élément si le value est pas un objet  
                            console.log(key + " : " + value2);
                        }
                    }
                }
            }
        },
        error: function (data, result, statut) {
            console.log(result);
        },
        complete: function (data, statut) {
        }
    })
}