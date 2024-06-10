<!DOCTYPE html>
<html lang="fr">

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
                            <h1>Suiver des seances</h1>
                        </div>
                    </div>
                </div>
            </div>
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header col-md-12">
                                    <div class=" p-0">
                                        <div class="input-group input-group-sm float-sm-right col-md-3 p-0">
                                            <input type="text" name="table_search" class="form-control float-right"
                                                placeholder="Recherche">
                                            <div class="input-group-append">
                                                <button type="submit" class="btn btn-default">
                                                    <i class="fas fa-search"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="card-body table-responsive p-0">

                                    <table class="table table-striped text-nowrap">
                                        <thead>
                                            <tr>
                                                <th style="width: 15%" class="text-center"> N° dossier
                                                </th>
                                                <th style="width: 15%" class="text-center">
                                                    Nom
                                                </th>
                                                <th style="width: 15%" class="text-center">
                                                    Prenom
                                                </th>
                                                <th style="width: 15%" class="text-center">
                                                    Date de seance
                                                </th>
                                                <th style="width: 15%" class="text-center">
                                                    Etat
                                                </th>
                                                <th style="width: 15%" class="text-center">
                                                    Actions
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            <tr>

                                                <td class="text-center">A-1700</td>

                                                <td class="text-center">
                                                    salhi
                                                </td>
                                                <td class="text-center">
                                                    karima
                                                </td>
                                                <td class="text-center">
                                                    2024-05-12
                                                </td>
                                                <td class="text-center">
                                                  Présent
                                                </td>

                                                <td class="project-actions text-right d-flex d-md-block text-center">
                                                    <button class="btn btn-success btn-sm presence-btn"
                                                        data-id="seance_id">
                                                        <i class="fas fa-check"></i>
                                                        Présent
                                                    </button>

                                                    <button class="btn btn-danger btn-sm absence-btn"
                                                        data-id="seance_id">
                                                        <i class="fas fa-times"></i>
                                                        Absent
                                                    </button>
                                                </td>

                                            </tr>
                                            <tr>
                                                <td class="text-center">A-1700</td>
                                                <td class="text-center">
                                                    radi
                                                </td>
                                                <td class="text-center">
                                                    aya
                                                </td>
                                                <td class="text-center">
                                                    2024-05-01
                                                </td>
                                                <td class="text-center">
                                                  Absent
                                                </td>

                                                <td class="project-actions text-right d-flex d-md-block text-center">
                                                    <button class="btn btn-success btn-sm presence-btn"
                                                        data-id="seance_id">
                                                        <i class="fas fa-check"></i>
                                                        Présent
                                                    </button>

                                                    <button class="btn btn-danger btn-sm absence-btn"
                                                        data-id="seance_id">
                                                        <i class="fas fa-times"></i>
                                                        Absent
                                                    </button>
                                                </td>


                                            </tr>
                                            <tr>
                                                <td class="text-center">A-1700</td>
                                                <td class="text-center">
                                                    radi
                                                </td>
                                                <td class="text-center">
                                                    aya
                                                </td>
                                                <td class="text-center">
                                                    2024-05-10
                                                </td>
                                                <td class="text-center">
                                                  -
                                                </td>
                                                

                                                <td class="project-actions text-right d-flex d-md-block text-center">
                                                    <button class="btn btn-success btn-sm presence-btn"
                                                        data-id="seance_id">
                                                        <i class="fas fa-check"></i>
                                                        Présent
                                                    </button>

                                                    <button class="btn btn-danger btn-sm absence-btn"
                                                        data-id="seance_id">
                                                        <i class="fas fa-times"></i>
                                                        Absent
                                                    </button>
                                                </td>


                                            </tr>

                                        </tbody>
                                    </table>
                                </div>

                                <div class="d-flex justify-content-end align-items-center p-2">

                                        <ul class="pagination  m-0 float-right">
                                            <li class="page-item"><a class="page-link text-secondary" href="#">«</a>
                                            </li>
                                            <li class="page-item"><a class="page-link text-secondary active"
                                                    href="#">1</a></li>
                                            <li class="page-item"><a class="page-link text-secondary" href="#">2</a>
                                            </li>
                                            <li class="page-item"><a class="page-link text-secondary" href="#">3</a>
                                            </li>
                                            <li class="page-item"><a class="page-link text-secondary" href="#">»</a>
                                            </li>
                                        </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>

    </div>
</body>

<!-- get script -->
<?php include_once "../../layouts/script-link.php"; ?>

</html>