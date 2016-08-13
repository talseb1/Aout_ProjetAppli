
$(document).ready(function() {
   //LISTE DEROULANTE SANS VALIDATION
  //cacher le bouton Go du form. liste déroulante ds réservation
  $('#submit_search_td').remove();
  
  $('#choix_liste_deroulante').change(function() {   
    // trouver le nom de l'attribut
     var attribut=$(this).attr('name');
     //récupérer la valeur du select 
     var val = $(this).val();  
     //construire la chaîne d'url
     var refresh = 'index.php?'+attribut+'='+val;
     //alert(refresh);
     window.location.href = refresh;
  });
   
  //VERIFIER FORMULAIRE AVEC REGEX 
  $('input#nom_client').blur(function() {
     var regex= new RegExp(/[0-9\?!\.,;]/);
     var ch = $(this).val();
     if(regex.test(ch)){   
         $('input#nom_client').val('');
         
         $('div#error').html("Caracteres invalide");
       
     }     
  });

  //ENVOYER FORMULAIRE CONTACT PAR AJAX
  
   $('input#submit_reserv').on ('click',function(event) {
      
      event.preventDefault();// ou return false à la fin
      var type;
      var nom_client = $('input#nom_client').val();
      var pren_client = $('input#pren_client').val();
      var comm_client = document.getElementById('comm_client').value;
      var email=$('input#email').val();
      if($('input#Homme').is(':checked')){
          type=0;
      }
      if($('input#Femme').is(':checked')){
          type=1;
      }
      
      if((type==1 || type==0) && $.trim(nom_client)!='' && $.trim(pren_client)!='' && $.trim(comm_client)!='' && $.trim(email)!='') {
          var data_form=$('form#form_contact').serialize();
          //alert(data_form);
          $.ajax({               
            type : 'GET',            
            data : data_form,
            dataType : "json",//type du retour des données par le php
            url : '../admin/lib/php/ajax/AjaxContact_submit.php',
            //callback exécuté en cas de succès uniquement :
            success : function(data){ //data : ce qui est retourné par le fichier php 
                //effacer les valeurs
                $('form').find('input[type=text]').val('');
                $('form').find('input[type=email]').val('');
                //$('form').find('input[type=date]').val('');
                $('input[name="type"]').prop('checked', false);

                if(data.retour == 1) {  //stricte égalité type compris (sinon valeurs peuvent être de types != et rester =
                    
                    $('section#resultat').html("Votre demande a bien été envoyée ! ");
                }
                else if(data.retour == 2){    
                    
                    $('section#resultat').html("Déjà dans la base de données...");
                }
                else {  
                    
                    $('section#resultat').html("Echec.");
                }
               // $('form#form_reservation').reset(); // ne fonctionne pas
            },
          //callback en cas d'échec
            fail : function() {
                document.write("Planté");
              alert("échec url");           
          }
        })//fin $.ajax    
      } //fin if
      //si champs manquants
      else {
         
          $('section#resultat').html("Remplissez tous les champs !"); 
          
      }
      
    });    
    
    //ENVOYER FORMULAIRE AJOUT JEU PAR AJAX
  
  $('input#submit_jeu').on ('click',function(event) {
      
      event.preventDefault();// ou return false à la fin
      //alert("arrivé");
      
      var Titre_jeu = $('input#Titre_jeu').val();
      var Prix_jeu = $('input#Prix_jeu').val();
      var Joueur_jeu = $('input#Joueur_jeu').val();//document.getElementById('comm_client').value;
      var Developpeur_jeu=$('input#Developpeur_jeu').val();
      var Categorie_jeu=$('input#Categorie_jeu').val();
      var Plateforme_jeu=$('input#Plateforme_jeu').val();
      
           
      if($.trim(Titre_jeu)!='' && $.trim(Prix_jeu)!='' && $.trim(Joueur_jeu)!='' && $.trim(Developpeur_jeu)!='' && $.trim(Categorie_jeu)!='' && $.trim(Plateforme_jeu)!='' ) {
          var data_form=$('form#form_ajout_jeu').serialize();
          //alert(data_form);
          $.ajax({               
            type : 'GET',            
            data : data_form,
            dataType : "json",//type du retour des données par le php
            url : '../admin/lib/php/ajax/AjaxJeu_submit.php',
            //callback exécuté en cas de succès uniquement :
            success : function(data){ //data : ce qui est retourné par le fichier php 
                //effacer les valeurs
                $('form').find('input[type=text]').val('');
                $('form').find('input[type=email]').val('');
                //$('form').find('input[type=date]').val('');
                $('input[name="type"]').prop('checked', false);

                if(data.retour == 1) {  //stricte égalité type compris (sinon valeurs peuvent être de types != et rester =
                    
                    $('section#resultat').html("Votre demande a bien été envoyée ! ");
                }
                else if(data.retour == 2){    
                    
                    $('section#resultat').html("Déjà dans la base de données...");
                }
                else {  
                    
                    $('section#resultat').html("Echec.");
                }
               // $('form#form_reservation').reset(); // ne fonctionne pas
            },
          //callback en cas d'échec
            fail : function() {
                document.write("Planté");
              alert("échec url");           
          }
        })//fin $.ajax    
      } //fin if
      //si champs manquants
      else {
         
                   
          $('section#resultat').html("Remplissez tous les champs !"); 
          
      }
      
    });
    
    //ENVOYER FORMULAIRE AJOUT DEVELOPPEUR PAR AJAX
  
   $('input#submit_dev').on ('click',function(event) {
      
      event.preventDefault();// ou return false à la fin
      //alert("arrivé");
      var Nom_dev = $('input#Nom_dev').val();
      var Pays_dev = $('input#Pays_dev').val();
      
      if($.trim(Nom_dev)!='' && $.trim(Pays_dev)!='') {
          var data_form=$('form#form_ajout_dev').serialize();
          //alert(data_form);
          $.ajax({               
            type : 'GET',            
            data : data_form,
            dataType : "json",//type du retour des données par le php
            url : '../admin/lib/php/ajax/AjaxDev_submit.php',
            //callback exécuté en cas de succès uniquement :
            success : function(data){ //data : ce qui est retourné par le fichier php 
                //effacer les valeurs
                $('form').find('input[type=text]').val('');
                $('form').find('input[type=email]').val('');
                //$('form').find('input[type=date]').val('');
                $('input[name="type"]').prop('checked', false);

                if(data.retour == 1) {  //stricte égalité type compris (sinon valeurs peuvent être de types != et rester =
                   
                    $('section#resultat').html("Votre demande a bien été envoyée ! ");
                }
                else if(data.retour == 2){    
                    
                    $('section#resultat').html("Déjà dans la base de données...");
                }
                else {  
                    
                    $('section#resultat').html("Echec.");
                }
               // $('form#form_reservation').reset(); // ne fonctionne pas
            },
          //callback en cas d'échec
            fail : function() {
                document.write("Planté");
              alert("échec url");           
          }
        })//fin $.ajax    
      } //fin if
      //si champs manquants
      else {
         
          $('section#resultat').html("Remplissez tous les champs !"); 
          
      }
      
    });    
       
    
    //ENVOYER FORMULAIRE CREER COMPTE CLIENT  PAR AJAX
  
   $('button#submit_ccompte').on ('click',function(event) {
      
      event.preventDefault();// ou return false à la fin
      var nom_cc = $('input#nom_cc').val();
      var pren_cc = $('input#pren_cc').val();
      var adresse_cc = $('input#adresse_cc').val();
      var ville_cc = $('input#ville_cc').val();
      var cp_cc = $('input#cp_cc').val();
      var pays_cc = $('input#pays_cc').val();
      var num_cc = $('input#num_cc').val();

      
      if( $.trim(nom_cc)!='' && $.trim(pren_cc)!='' && $.trim(adresse_cc)!='' && $.trim(ville_cc)!=''&& $.trim(cp_cc)!='' && $.trim(pays_cc)!='' && $.trim(num_cc)!='') {
          var data_form=$('form#form_ccompte').serialize();
          //alert(data_form);
          $.ajax({               
            type : 'GET',            
            data : data_form,
            dataType : "json",//type du retour des données par le php
            url : '../admin/lib/php/ajax/AjaxCCompte_submit.php',
            //callback exécuté en cas de succès uniquement :
            success : function(data){ //data : ce qui est retourné par le fichier php 
                //effacer les valeurs
                $('form').find('input[type=text]').val('');
                $('form').find('input[type=email]').val('');
                //$('form').find('input[type=date]').val('');
                $('input[name="type"]').prop('checked', false);

                if(data.retour >= 0) {  //stricte égalité type compris (sinon valeurs peuvent être de types != et rester =
                    
                    $('section#resultat').html("Votre demande a bien été envoyée ! Votre numéro de client est :"+data.retour +" ! ");
                }
                else if(data.retour == -1){    
                    
                    $('section#resultat').html("Déjà dans la base de données...");
                }
                else {  
                    
                    $('section#resultat').html("Echec.");
                }
               // $('form#form_reservation').reset(); // ne fonctionne pas
            },
          //callback en cas d'échec
            fail : function() {
                document.write("Planté");
              alert("échec url");           
          }
        })//fin $.ajax    
      } //fin if
      //si champs manquants
      else {
         
          $('section#resultat').html("Remplissez tous les champs !"); 
          
      }
      
    });    
     
  
});