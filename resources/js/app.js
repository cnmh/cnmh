import './bootstrap';
import 'admin-lte';


import "https://code.jquery.com/jquery-3.6.0.min.js";

$(document).ready(function () {
    // Fonction pour mettre à jour un paramètre dans l'URL
    function updateURLParameter(param, paramVal) {
        var url = window.location.href;
        var hash = location.hash;
        url = url.replace(hash, "");
        if (url.indexOf(param + "=") >= 0) {
            var prefix = url.substring(0, url.indexOf(param + "="));
            var suffix = url.substring(url.indexOf(param + "="));
            suffix = suffix.substring(suffix.indexOf("=") + 1);
            suffix =
                suffix.indexOf("&") >= 0
                    ? suffix.substring(suffix.indexOf("&"))
                    : "";
            url = prefix + param + "=" + paramVal + suffix;
        } else {
            if (url.indexOf("?") < 0) url += "?" + param + "=" + paramVal;
            else url += "&" + param + "=" + paramVal;
        }
        window.history.replaceState({ path: url }, "", url + hash);
    }

    // Fonction pour récupérer les données avec AJAX
    function fetchData(page, searchValue) {
        var neededUrl = window.location.pathname;
        console.log(neededUrl);
        $.ajax({
            url: neededUrl + "/?page=" + page + "&searchValue=" + searchValue,
            success: function (data) {
                var newData = $(data);
    
                $("tbody").html(newData.find("tbody").html());
                $("#card-footer").html(newData.find("#card-footer").html());
                var paginationHtml = newData.find(".pagination").html();
                if (paginationHtml) {
                    $(".pagination").html(paginationHtml);
                } else {
                    $(".pagination").html("");
                }
            },
        });
        if (page !== null && searchValue !== null) {
            updateURLParameter("page", page);
            updateURLParameter("searchValue", searchValue);
        } else {
            window.history.replaceState({}, document.title, window.location.pathname);
        }
    }

    // Function to get URL parameter value by name
    function getUrlParameter(name) {
        name = name.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");
        var regex = new RegExp("[\\?&]" + name + "=([^&#]*)");
        var results = regex.exec(location.search);
        return results === null
            ? ""
            : decodeURIComponent(results[1].replace(/\+/g, " "));
    }

    var searchValueFromUrl = getUrlParameter("searchValue");
    if (searchValueFromUrl) {
        $("#table_search").val(searchValueFromUrl);
        fetchData($("#page").val(), searchValueFromUrl);
    }

    $("body").on("click", ".pagination button", function (param) {
        param.preventDefault();
        var page = $(this).attr("page-number");
        var searchValue = $("#table_search").val();
        fetchData(page, searchValue);
        location.reload();
    });

    // Gestion de l'événement de saisie dans la barre de recherche
    $("body").on("keyup", "#table_search", function () {
        var page = $("#page").val();
        var searchValue = $(this).val();
        console.log(searchValue);
        fetchData(page, searchValue);
    });

});


document.getElementById("nombre_seance").addEventListener("input", function() {
    var container = document.getElementById("seance_dates_container");
    var existingSeanceDates = JSON.parse(this.dataset.existingSeanceDates);

    var nombreSeance = parseInt(this.value);
    var numExistingSeances = existingSeanceDates.length;

    // Remove any extra inputs
    while (container.children.length > nombreSeance) {
        container.removeChild(container.lastChild);
    }

    // Update or add new inputs
    for (var i = 1; i <= nombreSeance; i++) {
        var inputGroup = container.children[i - 1] || document.createElement("div");
        inputGroup.classList.add("form-group", "col-md-6");

        var label = inputGroup.children[0] || document.createElement("label");
        label.textContent = "Date Séance " + i;

        var input = inputGroup.children[1] || document.createElement("input");
        input.type = "date";
        input.classList.add("form-control", "datetimepicker-input");
        input.setAttribute("data-target", "#reservationdate");
        input.setAttribute("name", "date_seance" + i);

        if (existingSeanceDates[i - 1]) {
            input.value = existingSeanceDates[i - 1];
        }

        inputGroup.appendChild(label);
        inputGroup.appendChild(input);

        if (!container.children[i - 1]) {
            container.appendChild(inputGroup);
        }
    }
});