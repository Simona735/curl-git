let graph_data = [];
let count = [];
let lecture = [];

$(document).ready(function () {
    fetch('graphData.php')
        .then(
            function (response){
                if (response.status !== 200){
                    console.log("problem: " + response.status);
                    return;
                }

                response.json().then(function (data){
                    graph_data = data;
                    count = graph_data.map(function(value,index) { return value[0]; });
                    lecture = graph_data.map(function(value,index) { return value[1]; });

                    drawPlot();
                    // listTable();
                })
            }
        )
        .catch( function (err){
            console.log('fetch error: ', err);
        })
});



function drawPlot(){
    var data = [{
        x: lecture,
        y: count,
        type: 'bar',
        marker: {
            color: 'rgb(255,127,14)',
        },
        width: 0.3
    }];

    var layout = {
        title: '',
        plot_bgcolor: '#F8F9FA',
        paper_bgcolor: '#F8F9FA',
    };

    Plotly.newPlot('tester', data, layout);
}


