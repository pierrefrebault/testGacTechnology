<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0"/>
        <title>Gac Technology</title>

        <!-- CSS  -->
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link href="css/materialize.min.css" type="text/css" rel="stylesheet" media="screen,projection"/>
        <link href="css/style.css" type="text/css" rel="stylesheet" media="screen,projection"/>
        <link href="css/app.css" type="text/css" rel="stylesheet" media="screen,projection"/>
    </head>
    <body>
        <nav class="light-blue lighten-1" role="navigation">
            <div class="nav-wrapper container">
            </div>
        </nav>
        <div class="section no-pad-bot" id="index-banner">
            <div class="container">
                <br><br>
                <div class="header center"><img id="logo-container" src="images/logo-gac-couleur.svg" width="100"/></div>
                <div class="row center">
                    <div class="icon-block center">
                        <a id="reloadTickets" class="btn-large waves-effect waves-light orange">
                            Recharger les tickets
                        </a>
                        <h2 class="light-blue-text">
                            <div id="preloaderTickets" class="preloader-wrapper big active" style="display: none">
                                <div class="spinner-layer spinner-blue-only">
                                    <div class="circle-clipper left">
                                        <div class="circle"></div>
                                    </div><div class="gap-patch">
                                        <div class="circle"></div>
                                    </div><div class="circle-clipper right">
                                        <div class="circle"></div>
                                    </div>
                                </div>
                            </div>
                        </h2>
                    </div>
                </div>
                <br><br>
            </div>
        </div>
        <div class="container">
            <div class="section">
                <div class="row">
                    <div class="col s12 m4">
                        <div class="icon-block center">
                            <h2 class="light-blue-text"><i class="material-icons">flash_on</i></h2>
                            <h5>Duréee totale réelle des appels effectués après le 15/02/2012</h5>
                            <a id="getTotalCall" class="btn-large waves-effect waves-light orange">
                                Calculer
                            </a>
                        </div>
                    </div>
                    <div class="col s12 m4 center">
                        <div class="icon-block">
                            <h2 class="light-blue-text"><i class="material-icons">group</i></h2>
                            <h5 >Top 10 des volumes data facturés en dehors de la tranche horaire 8h00-
                                18h00, par abonné.</h5>
                            <a
                                href="action/topXInvoiceDataByHours.php"
                                class="btn-large waves-effect waves-light orange"
                            >
                                Téléchargement
                            </a>
                        </div>
                    </div>
                    <div class="col s12 m4 center">
                        <div class="icon-block">
                            <h2 class="light-blue-text"><i class="material-icons">settings</i></h2>
                            <h5>Quantité totale de SMS envoyés par l'ensemble des abonnés</h5>
                            <a id="getTotalSMSSend" class="btn-large waves-effect waves-light orange">
                                Calculer
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!--  Scripts-->
        <script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
        <script src="js/materialize.js"></script>
        <script src="js/init.js"></script>
        <script>
            $("#reloadTickets").click(() => {
                $("#preloaderTickets").show();
                $.ajax({
                    type: "POST",
                    url: "action/uploadCSVAction.php",
                }).done(function( msg ) {
                    $("#preloaderTickets").hide();
                    alert("Chargement terminé");
                });
            });

            $("#getTotalCall").click(() => {
                $.ajax({
                    type: "POST",
                    url: "action/getTotalCallByDateAction.php",
                }).done((msg) => {
                    alert("La durée totale réelle des appels effectués après le 15/02/2012 est de: " + msg);
                });
            });

            $("#getTotalSMSSend").click(() => {
                $.ajax({
                    type: "POST",
                    url: "action/getTotalSMSSend.php",
                }).done((msg) => {
                    alert("Le nombre total d'sms envoyés est de: " + msg);
                });
            });
        </script>
    </body>
</html>