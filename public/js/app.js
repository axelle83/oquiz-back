var app = {

  basePath: BASE_PATH,

  init: function() {
    // écouteur d'événement sur le formulaire d'inscription
    $('#subscribe').on('submit', app.subscription);
  },

  // gère la validation du formulaire d'inscription
  subscription: function(evt) {

    var results = {};
    // on empêche le rechargement de la page
    evt.preventDefault();
    // on récupère les données du formulaire
    var fields = $('#subscribe').serializeArray();
    fields.forEach(function(field) {
      // on récupère chaque élément du tableau
      results[ field.name ] = field.value;
    });
    // on définit la liste des champs obligatoires et on vérifie qu'ils sont bien renseignés
    var mandatoryFields = [
      'firstname',
      'lastname',
      'email',
      'password',
      'confirm_password',
    ];
    var mandatoryErrors = false;
    $('.form-group input').removeClass('mandatory');
    mandatoryFields.forEach(function(fieldName) {
      if (results[ fieldName ] === "") {
        // un champ n'est pas renseigné
        mandatoryErrors = true;
        $('#' + fieldName).addClass('mandatory');
      }
    });
    // on vérifie que les deux mots de passe sont identiques
    var passwordErrors = false;
    if (results['password'] !== results['confirm_password']) {
      passwordErrors=true;
    };
    // On supprime les précédents messages d'erreurs
    app.resetForm();
    // on vérifie s'il y a des erreurs
    if (mandatoryErrors) {
      // il y a un champ obligatoire non renseigné : on affiche le message correspondant dans le HTML
      var div = $('<div>')
        .addClass('alert alert-danger')
        .text("Merci de remplir les champs obligatoires");
      $('#subscribe').before(div);
    }
    if (passwordErrors) {
      console.log(passwordErrors);
      // les deux mots de passe ne sont pas identiques : on affiche le message correspondant dans le HTML
      var div = $('<div>')
        .addClass('alert alert-danger')
        .text("Les mots de passe saisis sont différents");
      $('#subscribe').before(div);
    }
    if (passwordErrors || mandatoryErrors) {
      return;
    }
    // il n'y a pas d'erreur : on envoie les données du formulaire au serveur
    $.ajax(app.basePath + '/signup', {
      method: 'post',
      data: results
    })
    .done(function(response) {
      if (!Array.isArray(response)) {
        // tout s'est bien passé, on redirige vers la page de connexion
        document.location.href = app.basePath + '/signin';
      }
      else {
        // il y a une erreur
        var errors = JSON.parse( response );
        errors.forEach(function( msg ) {
          var div = $('<div>')
            .addClass('alert alert-danger')
          $('#subscribe').before(div);
        });
      }
    })
    .fail(function() {
      // il y a eu des erreurs HTTP
      console.log('ERREUR ?!');
    });
  },

  // On supprime les messages d'erreurs
  resetForm: function() {
    $('.alert').remove();
  },
};
$(app.init);
