<!DOCTYPE html>
<html lang="fr">

<!-- Inclure l'en-tête -->
<?php include_once "../../layouts/heade.php" ?>

<body class="sidebar-mini" style="height: auto;">

    <div class="wrapper">
        <!-- Navigation -->
        <?php include_once "../../layouts/nav.php" ?>
        <!-- Barre latérale -->
        <?php include_once "../../layouts/aside.php" ?>



        <div class="content-wrapper" style="min-height: 1302.4px;">
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>Détails du consultation</h1>
                        </div>
                        <div class="col-sm-6">
                            <a href="./index.php" class="btn btn-default float-right"></i> Retour</a>
                        </div>
                       
                    </div>
                </div>
            </div>
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="col-sm-12">
                                        <label for="nom">Bilan:</label>
                                        <p>Test</p>
                                    </div>

                                    <div class="col-sm-12">
                                        <label for="description">Diagnostic:</label>
                                        <p>Test.</p>
                                    </div>

                                    <div class="col-sm-12">
                                        <label for="description">Date Enregistrement:</label>
                                        <p>12-05-2023</p>
                                    </div>

                                    <div class="col-sm-12">
                                        <label for="description">Date Consultation:</label>
                                        <p>12-05-2024</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

        </div>


        <!-- Inclure le pied de page -->
        <?php include_once "../../layouts/footer.php" ?>

    </div>

    <!-- Inclure le script -->
    <?php include_once "../../layouts/script-link.php" ?>
</body>

</html>