let btnDeco = document.getElementById("btndeco");

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

// function sendData(monInput) {
//     let monAttribut = monInput.getAttribute('data-id');
//     let contenu = monInput.value;
//     $.ajax({
//         url: "http://localhost/Trad/trad/CopierDonnee.php",
//         type: "post",
//         data: "monAttribut=" + monAttribut + "&contenu=" + contenu,
//         success: function (data, statut) {

//         },
//         error: function (data, result, statut) {

//         },
//         complete: function (data, statut) {
//         }

//     })
// }

function afficherDATA(data, monInput, typeFREN) {
    let recup = data
    let entries = Object.entries(recup);
    let filePath = monInput.getAttribute(typeFREN);
    let currentObj = monInput.innerHTML;
    console.log(currentObj);

    let monUl = document.createElement("ul");
    //Blagounette, ca renvoie un objet le parser HJSON
    for (const [key, value] of entries) {

        ////////////////////////////////
        //Spécifique au fichier config//
        ////////////////////////////////

        if (key == "CalamityConfig") {

            for (const [keyCfg, valueCfg] of Object.entries(value)) {

                //Parcoure toutes les données de l'objet renvoyé du fichier config 
                if (keyCfg == currentObj && typeof (valueCfg) != "object") {

                    let monLICfg = document.createElement("LI");
                    monLICfg.innerHTML = keyCfg + " : " + valueCfg;
                    monUl.appendChild(monLICfg);
                    //Afficher l'élément si le ValueCfg est pas un objet tiré du fichier config
                } else if (keyCfg == currentObj && typeof (valueCfg) == "object") {

                    //Reparcoure toutes les données de l'objet sousjascent tiré du fichier config
                    for (const [keyCfg2, valueCfg2] of Object.entries(valueCfg)) {

                        //Afficher l'élément si le valueCfg2 est pas un objet tiré du fichier config
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
                    monLITextAreaLvl1.setAttribute("data-tab", filePath)

                    //Ajout fonction onchange pour récupérer la modification de l'élément
                    monLITextAreaLvl1.setAttribute("onchange", "gloobibigler(this)");

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
}

function afficherValues(Input) {
    let filePath = Input.getAttribute("data-tabFR");
    let ENfilePath = Input.getAttribute("data-tab");
    //On récupère le path du fichier et le nom de la propriété à modifier 
    $.ajax({
        url: "http://localhost/Trad/trad/recupTab.php",
        type: "post",
        data: "monFichier=" + filePath,
        dataType: "json",
        success: function (data, statut) {

            afficherDATA(data, Input, "data-tabFR");
            $.ajax({
                url: "http://localhost/Trad/trad/recupTab.php",
                type: "post",
                data: "monFichier=" + ENfilePath,
                dataType: "json",
                success: function (data, statut) {
                    // console.log(data)
                    let recup = data
                    let entries = Object.entries(recup);
                    let filePath = Input.getAttribute("data-tab");
                    let currentObj = Input.getAttribute("value");
                    console.log(currentObj);
                    let monUlT = document.createElement("ul");
                    for (const [key, value] of entries) {
                        if (key == currentObj && key != "CalamityConfig") {
                            if (typeof (value) != "object") {
                                //Afficher l'élément si le value est pas un objet
                                let monLILvl0 = document.createElement("LI");

                                let monLITextAreaLvl0 = document.createElement("textarea");

                                monLITextAreaLvl0.setAttribute("data-elem", key);

                                monLITextAreaLvl0.innerHTML = "tets ";

                                monLILvl0.appendChild(monLITextAreaLvl0);
                                console.log(monLILvl0);

                                monUlT.appendChild(monLILvl0);
                            }
                        }
                    }
                    Input.appendChild(monUlT);
                }
            });
        },
        error: function (data, result, statut) {
            console.log(result);
        },
        complete: function (data, statut) {
        }
    })


}

function gloobibigler(Elem) {
    console.log("tab : " + Elem.getAttribute("data-tab"));
    console.log("elem : " + Elem.getAttribute("data-elem"));
    console.log("key : " + Elem.getAttribute("data-key"));
    console.log("value : " + Elem.value)
    // $.ajax({
    //     url : "https://localhost/Trad/trad/scripts/logModifsUser.php",
    //     type: "post",
    //     data: "tabElem="+Elem.getAttribute("data-tab")+"&elem="+Elem.getAttribute("data-elem")+"&keyElem="+Elem.getAttribute("data-key")+"&valueElem="+Elem.value+"&oldValueElem="+Elem.innerHTML,
    // });
    // $.ajax({
    //     url:"https://localhost/Trad/trad/scripts/modifierTab.php"
    // })

}