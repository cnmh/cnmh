import "./bootstrap";
import "admin-lte";

import "https://code.jquery.com/jquery-3.6.0.min.js";
import "https://cdn.ckeditor.com/ckeditor5/41.4.2/classic/ckeditor.js";
import "https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js";


$(document).ready(function() {
    $('.type_handicap_select').select2({
        tags: true,
        tokenSeparators: [',', ' '],
        multiple: true
    });

    $('.services_select').select2({
        tags: true,
        tokenSeparators: [',', ' '],
        multiple: true
    });

   
    
});

$(document).ready(function () {
  function updateURLParameters(params) {
      var url = new URL(window.location.href);
      Object.keys(params).forEach(param => {
          if (params[param] && params[param] !== "") {
              url.searchParams.set(param, params[param]);
          } else {
              url.searchParams.delete(param);
          }
      });
      window.history.replaceState(null, "", url);
  }

  function fetchData(page, searchValue) {
    var neededUrl = window.location.pathname;

    if (searchValue.trim() !== "") {
        $("tbody").html('<tr><td colspan="100%"><div class="loading-spinner"></div></td></tr>');
    }

    $.ajax({
        url: neededUrl,
        data: { page: page, searchValue: searchValue },
        success: function (data) {
            setTimeout(function() {
                var newData = $(data);
                $("tbody").html(newData.find("tbody").html());
                $("#card-footer").html(newData.find("#card-footer").html());
                $(".pagination").html(newData.find(".pagination").html() || "");
    
                updateURLParameters({ page: page, searchValue: searchValue });
            }, 3000);
        }
    });
}


  function getUrlParameter(name) {
      return new URLSearchParams(window.location.search).get(name) || "";
  }

  var searchValueFromUrl = getUrlParameter("searchValue");
  var pageFromUrl = getUrlParameter("page") || 1;
  if (searchValueFromUrl) {
      $("#table_search").val(searchValueFromUrl);
  }
  fetchData(pageFromUrl, searchValueFromUrl);

  $("body").on("click", ".pagination button", function (event) {
      event.preventDefault();
      var page = $(this).attr("page-number");
      var searchValue = $("#table_search").val();
      fetchData(page, searchValue);
  });

  $("body").on("keyup", "#table_search", function () {
      var searchValue = $(this).val();
      if (searchValue === "") {
          console.log("here");
          updateURLParameters({ page: undefined, searchValue: undefined });
          fetchData(1, searchValue);
      } else {
          fetchData(1, searchValue);
      }
  });
});


const searchNumber = document.getElementById("nombre_seance");
if(searchNumber){
    searchNumber.addEventListener("input", function () {
        var container = document.getElementById("seance_dates_container");
        var existingSeanceDates = JSON.parse(this.dataset.existingSeanceDates);
      
        var nombreSeance = parseInt(this.value);
        var numExistingSeances = existingSeanceDates.length;
      
        while (container.children.length > nombreSeance) {
          container.removeChild(container.lastChild);
        }
      
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
      
}

ClassicEditor.create(document.querySelector(".editorObservation")).catch(
  (error) => {
    console.error(error);
  }
);
ClassicEditor.create(document.querySelector(".editorDiagnostic")).catch(
  (error) => {
    console.error(error);
  }
);
ClassicEditor.create(document.querySelector(".editorBilan")).catch((error) => {
  console.error(error);
});
