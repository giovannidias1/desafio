$(document).ready(function() {
  table = $("#example").DataTable();
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
        var search = $("#select-filter").val();;
        console.log(search);
        var target = data[5] || 0;
        if (search === target) {
          return true;
        }else if(search === 'Todos'){
            return true
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
