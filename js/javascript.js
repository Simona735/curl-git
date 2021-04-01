$(document).ready(function () {
     fetch('download.php')
         .then(
             function (response){
                 if (response.status !== 200){
                     console.log("problem: " + response.status);
                     return;
                 }

                 response.json().then(function (data){
                     console.log(data);
                 })
             }
         )
         .catch( function (err){
             console.log('fetch error: ', err);
         })
});