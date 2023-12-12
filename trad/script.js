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
            for (const [key, value] of entries) {
                if (key == "CalamityConfig") {              
                    for (const [keyCfg,valueCfg] of Object.entries(value)){
                        if(keyCfg == currentObj && typeof(valueCfg) != "object"){
                            console.log("Key :"+keyCfg + "\nValue : "+valueCfg);
                        }else if(keyCfg == currentObj && typeof(valueCfg) == "object"){
                            for (const [keyCfg2,valueCfg2] of Object.entries(valueCfg)){
                                console.log("Key : "+keyCfg2+"\nValue : "+valueCfg2);
                            }
                        }
                    }
                } else if (key == currentObj && key != "CalamityConfig") {
                    if (typeof (value) != "object") {
                        console.log(key + " : " + value);
                    } else {
                        for (const [key, value2] of Object.entries(value)) {
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