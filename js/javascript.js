let attendance_table = [];
let table_width = 0;
let name_sort = 1;
let attendance_sort = 1;
let minutes_sort = 1;

$(document).ready(function () {
    $('#lectureDetail').on('show.bs.modal', function(e) {
        var lectureId = $(e.relatedTarget).data('lecture-id');
        var name = $(e.relatedTarget).data('name');
        $.post("modal.php", {lecture: lectureId.toString(), name: name}, function(result){
            let json = $.parseJSON(result);
            json = json[0];
            $('#exampleModalLabel').html(json[1] + ' ' + json[0]);
            var tableModal = $('#modalTableBody');
            tableModal.empty();
            $.each( json[2], function( key, value ) {
                tableModal.append(modalTableRow(value));
            });
        });

    });

    fetch('download.php')
        .then(
            function (response){
                if (response.status !== 200){
                    console.log("problem: " + response.status);
                    return;
                }
                response.json().then(function (data){
                    loadTableData();
                })
            }
        )
        .catch( function (err){
            console.log('fetch error: ', err);
        })
});

function loadTableData(){

    fetch('load.php')
        .then(
            function (response){
                if (response.status !== 200){
                    console.log("problem: " + response.status);
                    return;
                }

                response.json().then(function (data){
                    attendance_table = data;
                    table_width = (attendance_table[0]).length;
                    $('#loader .spinner-border').css("display", "none");
                    listTable();
                })
            }
        )
        .catch( function (err){
            console.log('fetch error: ', err);
        })
}



$('#name').click(function () {
    attendance_table.sort( compare_name );
    name_sort *= -1;
    listTable(attendance_table);
});


$('#attendance').click(function () {
    attendance_table.sort( compare_attendance );
    attendance_sort *= -1;
    listTable(attendance_table);
});


$('#minutes').click(function () {
    attendance_table.sort( compare_minutes );
    minutes_sort *= -1;
    listTable(attendance_table);
});



// compare functions for sort
// by surname
function compare_name( a, b ) {
    if ( a[0] < b[0] ){
        return -1 * name_sort;
    }
    if ( a[0] > b[0] ){
        return name_sort;
    }
    return 0;
}
// by year
function compare_attendance( a, b ) {
    if ( a[2] === b[2] ) {
        compare_name( a, b )
    }
    if ( a[2] < b[2] ){
        return -1 * attendance_sort;
    }
    if ( a[2] > b[2] ){
        return attendance_sort;
    }
    return 0;
}
// by type / year
function compare_minutes( a, b ) {
    if ( a[3] === b[3] ) {
        compare_name( a, b )
    }
    if ( a[3] < b[3] ){
        return -1 * minutes_sort;
    }
    if ( a[3] > b[3] ){
        return minutes_sort;
    }
    return 0;
}

function listTable() {
    var table = $('#table1Body');
    table.empty();
    $.each( attendance_table, function( key, value ) {
        table.append(tableRow(value));
    });
}

function modalTableRow(value){
    let tr = document.createElement("tr");
    let td1 = document.createElement("td");
    let td2 = document.createElement("td");
    td1.append(value[0]);
    td2.append(value[1]);
    tr.append(td1);
    tr.append(td2);
    return tr;
}

function tableRow(rowData){
    let tr = document.createElement("tr");
    tr.append(getInfoCell(rowData[0]));

    $.each(rowData[1], function( key, value ) {
        // console.log(value);
        tr.append(getLectureCell(value, rowData[0]));
    });

    tr.append(getInfoCell(rowData[2]));
    tr.append(getInfoCell(rowData[3]));
    return tr;
}


function getInfoCell(infoData){
    let td = document.createElement("td");
    td.append(infoData);
    return td;
}

function getLectureCell(value, name){

    let td = document.createElement("td");
    if (value[1] != null){
        td.classList.add("table-warning");
    }

    let link = document.createElement("a");
    link.setAttribute("data-bs-toggle", "modal");
    link.setAttribute("data-bs-target", "#lectureDetail");//data-bs-toggle="modal" data-bs-target="#lectureDetail"
    link.setAttribute("href", "#");
    link.setAttribute("data-lecture-id", value[2]);
    link.setAttribute("data-name", name);

    link.classList.add("link-dark");
    link.append(value[0]);
    td.append(link);

    return td;
}
























