let attendance_table = [];
let table_width = 0;

$(document).ready(function () {
     fetch('download.php')
         .then(
             function (response){
                 if (response.status !== 200){
                     console.log("problem: " + response.status);
                     return;
                 }

                 response.json().then(function (data){
                     loadTableData();

                     // listTable();
                 })
             }
         )
         .catch( function (err){
             console.log('fetch error: ', err);
         })
});

function loadTableData(){
    //TODO load to table

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


let name_sort = 1;
$('#name').click(function () {
    attendance_table.sort( compare_name );
    name_sort *= -1;
    listTable(attendance_table);
});

let attendance_sort = 1;
$('#attendance').click(function () {
    attendance_table.sort( compare_attendance );
    attendance_sort *= -1;
    listTable(attendance_table);
});

let minutes_sort = 1;
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
    if ( a[table_width-2] === b[table_width-2] ) {
        compare_name( a, b )
    }
    if ( a[table_width-2] < b[table_width-2] ){
        return -1 * attendance_sort;
    }
    if ( a[table_width-2] > b[table_width-2] ){
        return attendance_sort;
    }
    return 0;
}
// by type / year
function compare_minutes( a, b ) {
    if ( a[table_width-1] === b[table_width-1] ) {
        compare_name( a, b )
    }
    if ( a[table_width-1] < b[table_width-1] ){
        return -1 * minutes_sort;
    }
    if ( a[table_width-1] > b[table_width-1] ){
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

function tableRow(rowData){
    let tr = document.createElement("tr");
    tr.append(getInfoCell(rowData[0]));

    for(let i = 1; i < rowData.length - 2 ;i++){
        tr.append(getLectureCell(rowData[i]));
    }

    tr.append(getInfoCell(rowData[rowData.length - 2]));
    tr.append(getInfoCell(rowData[rowData.length - 1]));
    return tr;
}


function getInfoCell(infoData){
    let td = document.createElement("td");
    td.innerHTML = infoData;
    return td;
}

function getLectureCell(lectureInfo){
    let td = document.createElement("td");
    td.innerHTML = lectureInfo;
    //todo
    return td;
}
























