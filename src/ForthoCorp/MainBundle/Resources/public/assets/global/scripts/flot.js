/**
 Core script to handle the entire layout and base functionsx
 **/
var Flot = function () {
    var initInterface = function(){

        $('.btnHelpContextual').click(function(){
            $.fn.wbdHelp($(this).attr('id'));
        });

        $('.inlineHelper').each(function(){
            $(this).tooltip({
                placement: 'top',
                title: $(this).attr("data-help")

            })
        });

        jQuery.fn.errorModal = function (txt) {
            $("#errorContent").html(txt);
            $("#btnErrorModal").trigger('click');
        };

        jQuery.fn.reset = function () {
            $(this).each (function() { this.reset(); });
            $(this).validate().resetForm();
            $(".control-group").removeClass('success');
            $(".control-group").removeClass('error');
            $(this).find(".alert").hide();
        }

        toastr.options = {
            "closeButton": true,
            "debug": false,
            "positionClass": "toast-top-right",
            "onclick": null,
            "showDuration": "1000",
            "hideDuration": "1000",
            "timeOut": "10000",
            "extendedTimeOut": "10000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        }

    };
    var initDataTable = function(){
        var dataTable = $('.wbdDataTable').dataTable( {
            stateSave: true,
            "aLengthMenu": [
                [5, 15, 20, -1],
                [5, 15, 20, "All"] // change per page values here
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
            }

        });

        jQuery('.wbdDataTable .dataTables_filter input').addClass("m-wrap small"); // modify table search input
        jQuery('.wbdDataTable .dataTables_length select').addClass("m-wrap small"); // modify table per page dropdown
        jQuery('.wbdDataTable .dataTables_length select').select2(); // initialzie select2 dropdown

        $('#columnToggler span').on('click', function(){
            var iCol = parseInt($(this).attr("data-column"));
            var bVis = dataTable.fnSettings().aoColumns[iCol].bVisible;
            dataTable.fnSetColumnVis(iCol, (bVis ? false : true));
        });

        $("#actionTable").prependTo("#wbdDataTable_length").show();

        return dataTable;

    };

    var isValidEmail = function(email)
    {
        var emailReg = new RegExp(/^(("[\w-\s]+")|([\w-]+(?:\.[\w-]+)*)|("[\w-\s]+")([\w-]+(?:\.[\w-]+)*))(@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$)|(@\[?((25[0-5]\.|2[0-4][0-9]\.|1[0-9]{2}\.|[0-9]{1,2}\.))((25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\.){2}(25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\]?$)/i);
        var valid = emailReg.test(email);

            return valid;
    };

    //* END:CORE HANDLERS *//

    var doToastr = function(toastrType,toastrTitle,toastrMsg)
    {
        var toastCount = 0;
        var $toastlast;
        var $toast = toastr[toastrType](toastrMsg,toastrTitle ); // Wire up an event handler to a button in the toast, if it exists
        toastIndex = toastCount++;
        $toastlast = $toast;
    }

    return {

        //main function to initiate template pages
        init: function () {
            initInterface();
        },
        initDataTable: function () {
           return initDataTable();
        },
        isValidEmail: function(email){
            return isValidEmail(email);
        },
        doToastr: function(toastrType,toastrTitle,toastrMsg){
            return doToastr(toastrType,toastrTitle,toastrMsg);
        }
    };

}();