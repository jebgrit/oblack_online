$(function () {
  $(document).on('click', '#delete', function (e) {
    e.preventDefault();
    var link = $(this).attr("href");


    Swal.fire({
      title: 'Êtes-vous sûr?',
      text: "Cette action est irréversible !",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Oui, supprimer!',
      cancelButtonText: 'Annuler',
    }).then((result) => {
      if (result.isConfirmed) {
        window.location.href = link
        Swal.fire(
          'Supprimer!',
          'Votre fichier a été supprimé.',
          'success'
        )
      }
    })


  });

});

// for ticket
$(function () {
  $(document).on('click', '#close', function (e) {
    e.preventDefault();
    var link = $(this).attr("href");


    Swal.fire({
      title: 'Êtes-vous sûr?',
      text: "Vous allez fermer ce ticket !",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Oui, fermer!',
      cancelButtonText: 'Annuler',
    }).then((result) => {
      if (result.isConfirmed) {
        window.location.href = link
        Swal.fire(
          'Fermer!',
          'Ce ticket est maintenant fermé.',
          'success'
        )
      }
    })


  });

});


// confirm order, valider la commande
$(function () {
  $(document).on('click', '#confirm', function (e) {
    e.preventDefault();
    var link = $(this).attr("href");


    Swal.fire({
      title: 'Êtes-vous sûr?',
      text: "Une fois le statut changé, vous ne pourrez plus le modifier!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Oui, valider',
      cancelButtonText: 'Annuler',
    }).then((result) => {
      if (result.isConfirmed) {
        window.location.href = link
        Swal.fire(
          'Valider!',
          'La commande est maintenant validée.',
          'success'
        )
      }
    })


  });

});

// processing order, passer la commande à 'en cours'
$(function () {
  $(document).on('click', '#processing', function (e) {
    e.preventDefault();
    var link = $(this).attr("href");


    Swal.fire({
      title: 'Êtes-vous sûr?',
      text: "Une fois le statut changé, vous ne pourrez plus le modifier!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Oui, valider',
      cancelButtonText: 'Annuler',
    }).then((result) => {
      if (result.isConfirmed) {
        window.location.href = link
        Swal.fire(
          'Valider!',
          'La commande est maintenant validée.',
          'success'
        )
      }
    })


  });

});


// delivered order, passer la commande à 'livrée'
$(function () {
  $(document).on('click', '#delivered', function (e) {
    e.preventDefault();
    var link = $(this).attr("href");


    Swal.fire({
      title: 'Êtes-vous sûr?',
      text: "Une fois le statut changé, vous ne pourrez plus le modifier!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Oui, valider',
      cancelButtonText: 'Annuler',
    }).then((result) => {
      if (result.isConfirmed) {
        window.location.href = link
        Swal.fire(
          'Valider!',
          'La commande est maintenant validée.',
          'success'
        )
      }
    })


  });

});


// approve return order
$(function () {
  $(document).on('click', '#review', function (e) {
    e.preventDefault();
    var link = $(this).attr("href");


    Swal.fire({
      title: 'Approuver ce commentaire?',
      text: "Une fois approuvée, vous ne pourrez plus le désapprouver!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Oui, approuver',
      cancelButtonText: 'Annuler',
    }).then((result) => {
      if (result.isConfirmed) {
        window.location.href = link
        Swal.fire(
          'valider!',
          'La commantaire est maintenant approuvée.',
          'success'
        )
      }
    })


  });

});

