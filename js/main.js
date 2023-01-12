/* Pour mettre ce JavaScript sur une page, ajouter
<script src="./main.js"></script>
dans le body d'un fichier, de préférence à la fin. */

function cache() { // Cache une division si le checkbox est tické
    // Pour vous en servir, assignez l'ID "stuff" a un element HTML et l'ID "cache" a une checkbox.
    // Get the checkbox
    var checkBox = document.getElementById("cache");
    // Get the output
    var text = document.getElementById("text");
  
    // If the checkbox is checked, display the output
    if (checkBox.checked == false){
      stuff.style.display = "contents";
    } else {
      stuff.style.display = "none";
    }
  }

function disable() { // Désactive les textboxes si le checkbox est tické
      // Get the checkbox
      var checkBox = document.getElementById("disable");
      // Get the output
      var text = document.getElementsByClassName("actualform");

      if (checkBox.checked == false){
        for (var i = 0; i < text.length; i++) {
          text[i].readOnly = false;
          text[i].style.background = "#fff";
        }
      } else {
        for (var i = 0; i < text.length; i++) {
          text[i].readOnly = true;
          text[i].style.background = "#e9ecef";
        } 
      }
}


(function($){ //pour ajouter produit panier sans recharger la page
  $('.addPanier').click(function(event){
    event.preventDefault();
    
    $.get($(this).attr('href'),{},function(data){
      if(data.error){// marche pas
        alert('data.error'); 
      }
          
          
          
          
      },'json');
      
      return false;
  });

})(jQuery);


//POUR AJOUTER PRODUIT PANIER SANS RECHARGER LA PAGE, pour la partie ajax de la page de resultat de recherche
(function($){
  $('#didier').on('click','.addPanier',function(event){
    event.preventDefault();
    const toast = new bootstrap.Toast(toastLiveExample)
    toast.show()
    $.get($(this).attr('href'),{},function(data){
      if(data.error){// marche pas
        alert('data.error'); 
      }
          
          
          
          
      },'json');
      
      return false;
  });


})(jQuery);


//pour notif ajout panier
//pour notif ajout panier

const toastTrigger = document.getElementsByClassName('addPanier')
const toastLiveExample = document.getElementById('liveToast')


if(toastTrigger){
  for (var i = 0; i < toastTrigger.length; i++) {
    toastTrigger[i].addEventListener('click', () => {
      const toast = new bootstrap.Toast(toastLiveExample)

      toast.show()
    })
  }
}

//si la recherche est vide, on ne peut pas valider
$(document).ready(function() {
  $("button[name='valider']").prop("disabled", true);
  $("input[name='keywords']").keyup(function() {
    if ($(this).val().length == 0) {
      $("button[name='valider']").prop("disabled", true);
    } else {
      $("button[name='valider']").prop("disabled", false);
    }
  });
});


