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
            </div>

            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">

                            <div class="card card-info">
                                <div class="card-header">
                                    <h3 class="card-title"> <i class="nav-icon fas fa-table"></i></h3>
                                </div>
                                <!-- Obtenir le formulaire -->

                                <div class="row">

                                    <div class="col-md-12">
                                        <div class="card card-default">



                                            <div class="card-body p-0 mt-2">

                                                <div class="form-group col-12">
                                                    <label> Date Consultation </label>
                                                    <div class="input-group date" id="reservationdate"
                                                        data-target-input="nearest">
                                                        <input type="text" class="form-control datetimepicker-input"
                                                            value="04/03/2023" />

                                                    </div>
                                                </div>
                                                <div class="form-group col-12">

                                                    <div class="form-group">
                                                        <label> Type de handicap </label>
                                                        <select class="form-control select2" style="width: 100%;">
                                                            <option selected="selected">Sélectionner un type de handicap
                                                            </option>
                                                            <option>TSA</option>
                                                            <option selected="selected">RETARD MENTAL</option>
                                                            <option>TRISOMIE 21</option>
                                                            <option>IMC</option>
                                                            <option>RPM</option>
                                                            <option>RETARD DE LANGUAGE</option>
                                                            <option>HANDICAP MOTEUR</option>
                                                            <option>AUTRES</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="d-flex">

                                                <div class="form-group col-md-12">
                                                    <label>Observation</label>
                                                    <div id="reservationdate" data-target-input="nearest">
                                                        <textarea name="Observation" id="summernote"
                                                            class="form-control"
                                                            rows="4">Lorem ipsum dolor sit amet consectetur adipisicing elit. Qui nemo modi quisquam iure voluptatum fugit quia facere atque, sint obcaecati ipsam totam sunt ipsum incidunt doloremque repellendus omnis voluptas tempora.</textarea>

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="d-flex">
                                                <div class="form-group col-md-12">
                                                    <label>Diagnostic</label>
                                                    <div id="reservationdate" data-target-input="nearest">
                                                        <textarea name="Remarque" id="summernote2" class="form-control"
                                                            rows="4">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Ab, quod cum dolore vel odio cupiditate. Blanditiis debitis voluptas recusandae commodi numquam itaque a. Ullam possimus recusandae deserunt optio magni repellat.</textarea>

                                                    </div>
                                                </div>
                                            </div>

                                            <div class="d-flex">

                                                <div class="form-group col-md-12">
                                                    <label>Bilan</label>
                                                    <div id="reservationdate" data-target-input="nearest">
                                                        <textarea name="Diagnostic" id="summernote3"
                                                            class="form-control"
                                                            rows="4">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Voluptatibus natus iusto delectus fugit totam, fuga esse sit reiciendis, maiores non tempore repudiandae! Suscipit repellat eius sunt incidunt sequi, tempore quae!</textarea>

                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group col-12">
                                                <label>Nombre de séances</label>
                                                <input type="number" class="form-control" name="nombre_seance"
                                                    id="nombre_seance" value="2">
                                            </div>


                                            <div class="d-flex flex-wrap" id="seance_dates_container">

                                                <div class="form-group col-md-6">
                                                    <label>Date Séance 1</label>
                                                    <div class="input-group date" data-target-input="nearest">
                                                        <input type="date" class="form-control datetimepicker-input"
                                                            data-target="#reservationdate" value="2024-01-05"/>
                                                    </div>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label>Date Séance 2</label>
                                                    <div class="input-group date" data-target-input="nearest">
                                                        <input type="date" class="form-control datetimepicker-input"
                                                            data-target="#reservationdate" value="2024-10-05"/>
                                                    </div>
                                                </div>

                                            </div>

                                            <div class="d-flex">
                                                <div class="form-group col-md-12">
                                                    <label>Remarque</label>
                                                    <div id="reservationdate" data-target-input="nearest">
                                                        <textarea name="Remarque" id="summernote5" class="form-control"
                                                            rows="4">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Obcaecati distinctio ut quod eum quis iste porro blanditiis molestiae nesciunt quam dolorum, cupiditate dicta ducimus corporis, aliquid sapiente numquam quaerat atque.</textarea>

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="ml-4 mb-3">
                                                <a href="./index.php" class="btn btn-primary">Retour</a>
                                                <a href="./index.php" class="btn btn-primary">Editer</a>
                                            </div>
                                            </form>

                                        </div>
                                        <!-- /.card-body -->

                                    </div>
                                    <!-- /.card -->

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </div>

        </section>

    </div>
    </div>
    <style>
    .md-stepper-horizontal {
        display: table;
        width: 100%;
        margin: 0 auto;
        background-color: #FFFFFF;
        box-shadow: 0 3px 8px -6px rgba(0, 0, 0, .50);
    }

    .md-stepper-horizontal .md-step {
        display: table-cell;
        position: relative;
        padding: 24px;
    }

    .md-stepper-horizontal .md-step:hover,
    .md-stepper-horizontal .md-step:active {
        background-color: rgba(0, 0, 0, 0.04);
    }

    .md-stepper-horizontal .md-step:active {
        border-radius: 15% / 75%;
    }

    .md-stepper-horizontal .md-step:first-child:active {
        border-top-left-radius: 0;
        border-bottom-left-radius: 0;
    }

    .md-stepper-horizontal .md-step:last-child:active {
        border-top-right-radius: 0;
        border-bottom-right-radius: 0;
    }

    .md-stepper-horizontal .md-step:hover .md-step-circle {
        background-color: #757575;
    }

    .md-stepper-horizontal .md-step:first-child .md-step-bar-left,
    .md-stepper-horizontal .md-step:last-child .md-step-bar-right {
        display: none;
    }

    .md-stepper-horizontal .md-step .md-step-circle {
        width: 30px;
        height: 30px;
        margin: 0 auto;
        background-color: #999999;
        border-radius: 50%;
        text-align: center;
        line-height: 30px;
        font-size: 16px;
        font-weight: 600;
        color: #FFFFFF;
    }


    /* .md-stepper-horizontal .md-step.done .md-step-circle:before {

        font-weight: 100;
        content: "\f00c";
    } */

    .md-stepper-horizontal .md-step.done .md-step-circle *,
    .md-stepper-horizontal .md-step.editable .md-step-circle * {
        display: block;
    }

    .md-stepper-horizontal .md-step.editable .md-step-circle {
        -moz-transform: scaleX(-1);
        -o-transform: scaleX(-1);
        -webkit-transform: scaleX(-1);
        transform: scaleX(-1);
    }

    .md-stepper-horizontal .md-step.editable .md-step-circle:before {
        /* font-family:'FontAwesome'; */
        font-weight: 100;
        content: "\f040";
    }

    .md-stepper-horizontal .md-step .md-step-title {
        margin-top: 16px;
        font-size: 16px;
        font-weight: 600;
    }

    .md-stepper-horizontal .md-step .md-step-title,
    .md-stepper-horizontal .md-step .md-step-optional {
        text-align: center;
        color: rgba(0, 0, 0, .26);
    }

    .md-stepper-horizontal .md-step.active .md-step-title {
        font-weight: 600;
        color: rgba(0, 0, 0, .87);
    }

    .md-stepper-horizontal .md-step.active.done .md-step-title,
    .md-stepper-horizontal .md-step.active.editable .md-step-title {
        font-weight: 600;
    }

    .md-stepper-horizontal .md-step .md-step-optional {
        font-size: 12px;
    }

    .md-stepper-horizontal .md-step.active .md-step-optional {
        color: rgba(0, 0, 0, .54);
    }

    .md-stepper-horizontal .md-step .md-step-bar-left,
    .md-stepper-horizontal .md-step .md-step-bar-right {
        position: absolute;
        top: 36px;
        height: 1px;
        border-top: 1px solid #DDDDDD;
    }

    .md-stepper-horizontal .md-step .md-step-bar-right {
        right: 0;
        left: 50%;
        margin-left: 20px;
    }

    .md-stepper-horizontal .md-step .md-step-bar-left {
        left: 0;
        right: 50%;
        margin-right: 20px;
    }
    </style>

    <script>
    document.getElementById("nombre_seance").addEventListener("input", function() {
        var container = document.getElementById("seance_dates_container");
        container.innerHTML = "";

        var nombreSeance = parseInt(this.value);

        for (var i = 1; i <= nombreSeance; i++) {
            var inputGroup = document.createElement("div");
            inputGroup.classList.add("form-group", "col-md-6");

            var label = document.createElement("label");
            label.textContent = "Date Séance " + i;

            var input = document.createElement("input");
            input.type = "date";
            input.classList.add("form-control", "datetimepicker-input");
            input.setAttribute("data-target", "#reservationdate");

            inputGroup.appendChild(label);
            inputGroup.appendChild(input);
            container.appendChild(inputGroup);
        }
    });
    </script>






    <!-- Inclure le pied de page -->
    <?php include_once "../../layouts/footer.php" ?>

    </div>

    <!-- Inclure le script -->
    <?php include_once "../../layouts/script-link.php"; ?>
</body>

</html>