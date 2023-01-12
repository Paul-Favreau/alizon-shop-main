//pour la checkbox textile
var checkBoxText = document.getElementById("checktextile");
checkBoxText.addEventListener("change", function() {
    
    var xhr=new XMLHttpRequest();
    xhr.onreadystatechange=function() {
        if (xhr.readyState==4 && xhr.status==200) {
            var demo = document.getElementById("didier");
            demo.innerHTML = xhr.responseText;
        }
    }

    var check=checkBoxText.checked;

    if(check==true){
        checkBoxAlim.disabled=true;
        checkBoxSouv.disabled=true;
    }
    else{
        checkBoxAlim.disabled=false;
        checkBoxSouv.disabled=false;
    }

    xhr.open("POST", "./requetecheckbox.php", true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        
    xhr.send("checktextile="+check);
});



//pour la checkbox alimentation
var checkBoxAlim = document.getElementById("checkalimentation");

checkBoxAlim.addEventListener("change", function() {
    
    var xhr = new XMLHttpRequest();
    
    
    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && xhr.status == 200) {
            var demo = document.getElementById("didier"); //on selectionne la ou ça va mettre dans notre fichier php (d'affichage de produit)
            demo.innerHTML = xhr.responseText;
        }
    }
    //on regarde si la checkbox est cochée ou non
    var check = checkBoxAlim.checked;

    //si la checkbox est coché on désactive les deux autres
    if (check == true) {
        checkBoxSouv.disabled = true;
        checkBoxText.disabled = true;
    }
    else {
        checkBoxSouv.disabled = false;
        checkBoxText.disabled = false;
    }
    
    xhr.open("POST", "./requetecheckbox.php", true); 

    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded"); 
    xhr.send("checkalimentation="+check);//on set checkalimentation dans la variable $_POST['checkalimentation'] dans le fichier requetecheckbox.php

});


//pour la checkbox souvenir
var checkBoxSouv = document.getElementById("checksouvenir");

checkBoxSouv.addEventListener("change", function() {
        
        var xhr = new XMLHttpRequest();
        
        xhr.onreadystatechange = function() {
            if (xhr.readyState == 4 && xhr.status == 200) {
                var demo = document.getElementById("didier");
                demo.innerHTML = xhr.responseText;
            }
        }
        
        var check = checkBoxSouv.checked;
        //si la checkbox souvenir est choché, les autres sont grisés
        if (check == true) {
            checkBoxAlim.disabled = true;
            checkBoxText.disabled = true;
        }
        else {
            checkBoxAlim.disabled = false;
            checkBoxText.disabled = false;
        }
        
        xhr.open("POST", "./requetecheckbox.php", true); 
        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded"); 
        xhr.send("checksouvenir="+check);
    
});

//si checkboxsouv n'est pas coché, on affiche tout
if (checkBoxSouv.checked == false && checkBoxAlim.checked == false && checkBoxText.checked == false) {
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && xhr.status == 200) {
            var demo = document.getElementById("didier");
            demo.innerHTML = xhr.responseText;
        }
    }
    

    xhr.open("POST", "./requetecheckbox.php", true); 
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    
    xhr.send("riencoche=ok");
}


//Pour la range minimum
var rangeMin = document.getElementById("rangeMin");
var rangeMax = document.getElementById("rangeMax");

rangeMin.addEventListener("change", function() {
    var xhr = new XMLHttpRequest();
    if((rangeMin.value>rangeMax.value) && rangeMax.value!=100){//on met le 100 car il y a un bug au début sinon
        alert("Attention, la valeur minimum doit être inférieure à la valeur maximum");
        rangeMin.value=rangeMax.value;
    }


    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && xhr.status == 200) {
            var demo = document.getElementById("didier");
            demo.innerHTML = xhr.responseText;
        }
    }
    var valeur=rangeMin.value;

    var checkAlim = checkBoxAlim.checked;
    var checkSouv = checkBoxSouv.checked;
    var checkText = checkBoxText.checked;


    xhr.open("POST", "./requetecheckbox.php", true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    //on envoie la valeur des deux range en meme temps, si on envoie que un par un ça ne marche pas
    //car les deux ne peuvent pas etre set en meme temps
    xhr.send("rangeMin="+valeur+"&rangeMax="+rangeMax.value+"&checkalimentation="+checkAlim+"&checksouvenir="+checkSouv+"&checktextile="+checkText);


    /*xhr2= new XMLHttpRequest();

    xhr2.onreadystatechange = function() {
        if (xhr2.readyState == 4 && xhr2.status == 200) {
            var demo = document.getElementById("didier");
            demo.innerHTML = xhr2.responseText;
        }
    }

    xhr2.open("POST", "./pageproduittest.php", true);
    xhr2.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr2.send("rangeMin="+valeur+"&rangeMax="+rangeMax.value);*/
});





rangeMax.addEventListener("change", function() {
    var xhr = new XMLHttpRequest();
    
    

    if((rangeMax.value<rangeMin.value)){
        alert("Attention, la valeur maximum doit être supérieure à la valeur minimum");
        rangeMax.value=rangeMin.value;
    }

    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && xhr.status == 200) {
            var demo = document.getElementById("didier");
            demo.innerHTML = xhr.responseText;
        }
    }
    var valeur=rangeMax.value;

    var checkAlim = checkBoxAlim.checked;
    var checkSouv = checkBoxSouv.checked;
    var checkText = checkBoxText.checked;


    xhr.open("POST", "./requetecheckbox.php", true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    //on envoie la valeur des deux range en meme temps, si on envoie que un par un ça ne marche pas
    //car les deux ne peuvent pas etre set en meme temps
    //alert("rangeMax="+valeur+"&rangeMin="+rangeMin.value+"&checkalimentation="+checkAlim+"&checksouvenir="+checkSouv+"&checktextile="+checkText);
    xhr.send("rangeMax="+valeur+"&rangeMin="+rangeMin.value+"&checkalimentation="+checkAlim+"&checksouvenir="+checkSouv+"&checktextile="+checkText);
    
});



const selectElement = document.querySelector('#tris');

selectElement.addEventListener('change', (event) => {
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && xhr.status == 200) {
            var demo = document.getElementById("didier");
            demo.innerHTML = xhr.responseText;
        }
    }
    var valeur=event.target.value;
    var checkAlim = checkBoxAlim.checked;
    var checkSouv = checkBoxSouv.checked;
    var checkText = checkBoxText.checked;
    xhr.open("POST", "./requetecheckbox.php", true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.send("tris="+valeur+"&rangeMin="+rangeMin.value+"&rangeMax="+rangeMax.value+"&checkalimentation="+checkAlim+"&checksouvenir="+checkSouv+"&checktextile="+checkText);
});


























