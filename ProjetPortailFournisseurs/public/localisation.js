document.addEventListener('DOMContentLoaded', ()=> {

    const selectDrop = document.querySelector('countries');

    

    fetch('https://donneesquebec.ca/recherche/api/action/datastore_search_sql?sql=SELECT%20%22munnom%22%20,%20%22regadm%22%20FROM%20%2219385b4e-5503-4330-9e59-f998f5918363%22')
  
    .then((response) => {
    return response.json()
   
    }).then((data) => {
         let values = data.result.records ;
         
        values.forEach(element => {
            console.log(element.munnom);
        });
      
    }).catch((err) => {
        console.log(err);
    })


});
