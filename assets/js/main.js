$(document).ready(function() {
  table = $("#example").DataTable();
  $("#example tbody").on("click", "tr", function() {
    console.log();
    var id = table.row(this).data()[0];
    var data = getId(id);
    data = JSON.parse(data.responseText);
    $("#myModal").modal("show");
    $("#myModal").on("hide.bs.modal", function() {
      $(".modal-body").empty();
    });
    data.forEach(function(row) {
      var str = null;
      str = "<div id='mensagens'>";
      str += "<h3 class='send'>" + row.Sender + "</h3>";
      str += "<p class='msg'>" + row.Message + "</p>";
      str += "</div>";
      $(".modal-body").append(str);
    });

    // for (i = 0; i < data.length; i++) {
    //   console.log(i);
    //   document.createElement("h3").innerHTML = data[i].Sender

    //   $("#send").html(data[i].Sender);
    //    $("#msg").html(data[i].Message);
    // }
  });
});

$(".date-range-filter").change(function() {
  $.fn.dataTable.ext.search.push(function(settings, data, dataIndex) {
    var min = $("#startDate").val();
    var max = $("#endDate").val();
    var dateCreate = data[3] || 0;
    if (
      min == "" ||
      max == "" ||
      (moment(dateCreate).isSameOrAfter(min) &&
        moment(dateCreate).isSameOrBefore(max))
    ) {
      return true;
    }
    return false;
  });

  table.draw();
});

$("#select-filter").on("change", function() {
  $.fn.dataTable.ext.search.push(function(settings, data, dataIndex) {
    var search = $("#select-filter").val();
    console.log(search);
    var target = data[5] || 0;
    if (search === target) {
      return true;
    } else if (search === "Todos") {
      return true;
    }
    return false;
  });

  table.draw();
});

var today = new Date(
  new Date().getFullYear(),
  new Date().getMonth(),
  new Date().getDate()
);
$("#startDate").datepicker({
  uiLibrary: "bootstrap4",
  iconsLibrary: "fontawesome",
  maxDate: function() {
    return $("#endDate").val();
  }
});
$("#endDate").datepicker({
  uiLibrary: "bootstrap4",
  iconsLibrary: "fontawesome",
  minDate: function() {
    return $("#startDate").val();
  }
});

function getId(id) {
  return $.ajax({
    async: false,
    type: "GET",
    url: "http://localhost/php-casetickets/server-php/?path=" + id,
    error: function(data) {
      console.log("Erro. " + data.responseText);
    },
    success: function(data) {
      return data;
    }
  });
}
