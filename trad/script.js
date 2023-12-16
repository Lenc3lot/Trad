let btnDeco = document.getElementById("btndeco");
let lestextarea = document.getElementsByTagName("textarea");
btnDeco.addEventListener("click", function (e) {
    $.ajax({
        url: "http://localhost/Trad/trad/scripts/deconnexionUser.php",
        type: "post",
        success: function (data, statut) {
            location.reload();
        },
        error: function (data, result, statut) {
        },
        complete: function (data, statut) {
        }
    })
})

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
    let monUl = document.createElement("ul");
    $.ajax({
        url: "http://localhost/Trad/trad/recupTab.php",
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
                    for (const [keyCfg, valueCfg] of Object.entries(value)) {
                        //Parcoure toutes les données de l'objet renvoyé du fichier config de MERDE
                        if (keyCfg == currentObj && typeof (valueCfg) != "object") {
                            let monLICfg = document.createElement("LI");
                            monLICfg.innerHTML = keyCfg + " : " + valueCfg;
                            monUl.appendChild(monLICfg);
                            //Afficher l'élément si le ValueCfg est pas un objet tiré du fichier config de MERDE
                        } else if (keyCfg == currentObj && typeof (valueCfg) == "object") {
                            //Reparcoure toutes les données de l'objet sousjascent tiré du fichier config de MERDE
                            for (const [keyCfg2, valueCfg2] of Object.entries(valueCfg)) {
                                //Afficher l'élément si le valueCfg2 est pas un objet tiré du fichier config de MERDE
                                let monLICfg2 = document.createElement("LI");
                                monLICfg2.innerHTML = keyCfg2 + " : " + valueCfg2;
                                monUl.appendChild(monLICfg2);
                            }
                        }
                    }
                } else if (key == currentObj && key != "CalamityConfig") {
                    if (typeof (value) != "object") {
                        //Afficher l'élément si le value est pas un objet
                        let monLILvl0 = document.createElement("LI");
                        let monLITextAreaLvl0 = document.createElement("textarea");
                        monLITextAreaLvl0.setAttribute("data-elem", key);
                        monLITextAreaLvl0.addEventListener("change", function (e) {
                            console.log()
                        });
                        monLITextAreaLvl0.innerHTML = value;
                        let limitsize = value.length;
                        monLITextAreaLvl0.setAttribute("maxlength", limitsize * 2);
                        monLILvl0.appendChild(monLITextAreaLvl0);
                        monUl.appendChild(monLILvl0);
                    } else {
                        for (const [key2, value2] of Object.entries(value)) {
                            //Reparcoure toutes les données de l'objet sousjascent 
                            //Afficher l'élément si le value est pas un objet  

                            //Créé un nouvel élement LI
                            let monLILvl1 = document.createElement("LI");
                        
                            //Créé un nouvel élement textarea
                            let monLITextAreaLvl1 = document.createElement("textarea");

                            //Ajout des attributs data à la textarea
                            monLITextAreaLvl1.setAttribute("data-elem", key2);
                            monLITextAreaLvl1.setAttribute("data-key", key);
                            monLITextAreaLvl1.setAttribute("data-tab",filePath)

                            //Ajout fonction onchange pour récupérer la modification de l'élément
                            monLITextAreaLvl1.setAttribute("onchange","gloobibigler(this)");

                            //Description chargée depuis le fichier dans la textarea
                            monLITextAreaLvl1.innerHTML = value2;

                            //Limite de saisie = saisie originale*2
                            let limitsize = value2.length;

                            //Définition de la taille max de saisie
                            monLITextAreaLvl1.setAttribute("maxlength", limitsize * 2);

                            //Ajout de l'élément clé (identifiant 2ndaire de ce qui est modifié)
                            monLILvl1.innerHTML = key2 + " : ";

                            //Ajout à l'élément parent des attributs
                            monUl.appendChild(monLILvl1);
                            monUl.appendChild(monLITextAreaLvl1);
                        }
                    }
                }
            }
            monInput.appendChild(monUl);
        },
        error: function (data, result, statut) {
            console.log(result);
        },
        complete: function (data, statut) {
        }
    })
}

function gloobibigler(Elem) {
    console.log("tab : "+Elem.getAttribute("data-tab"));
    console.log("elem : "+Elem.getAttribute("data-elem"));
    console.log("key : "+Elem.getAttribute("data-key"));
    console.log("value : "+Elem.value)
    $.ajax({
        url : "http://localhost/Trad/trad/scripts/logModifsUser.php",
        type: "post",
        data: "tabElem="+Elem.getAttribute("data-tab")+"&elem="+Elem.getAttribute("data-elem")+"&keyElem="+Elem.getAttribute("data-key")+"&valueElem="+Elem.value+"&oldValueElem="+Elem.innerHTML,
    });
    $.ajax({
        
    })

}

function test(monParam){
    console.log(monParam.value);
    console.log(monParam.getAttribute("data-tab"));
}