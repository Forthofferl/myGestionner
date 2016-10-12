var initLotDataTable = function(){
    var dataTable = $('.allotment_datatable').dataTable( {
        stateSave: false,
        "aLengthMenu": [
            [10, 20, 50, 100, -1],
            [10, 20, 50, 100, "All"] // change per page values here
        ],
        // set the initial value
        "iDisplayLength": 10,
        "oLanguage": {
            "sProcessing":     "Traitement en cours...",
            "sSearch":         "Rechercher&nbsp;:&nbsp;",
            "sLengthMenu":     "Afficher _MENU_ &eacute;l&eacute;ments",
            "sInfo":           "Affichage de l'&eacute;lement _START_ &agrave; _END_ sur _TOTAL_ &eacute;l&eacute;ments",
            "sInfoEmpty":      "Affichage de l'&eacute;lement 0 &agrave; 0 sur 0 &eacute;l&eacute;ments",
            "sInfoFiltered":   "(filtr&eacute; de _MAX_ &eacute;l&eacute;ments au total)",
            "sInfoPostFix":    "",
            "sLoadingRecords": "Chargement en cours...",
            "sZeroRecords":    "Aucun &eacute;l&eacute;ment &agrave; afficher",
            "sEmptyTable":     "Aucune donnée disponible dans le tableau",
            "oPaginate": {
                "sFirst":      "Premier",
                "sPrevious":   "Pr&eacute;c&eacute;dent",
                "sNext":       "Suivant",
                "sLast":       "Dernier"
            },
            "oAria": {
                "sSortAscending":  ": activer pour trier la colonne par ordre croissant",
                "sSortDescending": ": activer pour trier la colonne par ordre décroissant"
            }
        },
        "columnDefs": [
        ],
        "order": [ 0, 'asc' ],
        "serverSide": false
    });
    jQuery('.flot_datatables .dataTables_filter input').addClass("m-wrap small"); // modify table search input
    jQuery('.flot_datatables .dataTables_length select').addClass("m-wrap small"); // modify table per page dropdown

    return dataTable;
};
