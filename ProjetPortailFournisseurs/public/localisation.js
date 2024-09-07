document.addEventListener('DOMContentLoaded', ()=> {

    const selectDrop = document.querySelector('#city');
    const selectDrop2 = document.querySelector('#province');

    

    fetch('https://donneesquebec.ca/recherche/api/action/datastore_search_sql?sql=SELECT%20%22munnom%22%20,%20%22regadm%22%20FROM%20%2219385b4e-5503-4330-9e59-f998f5918363%22')
  
    .then((response) => {
    return response.json()
   
    }).then((data) => {
        let output = ""; 
        let output2 = ""; 
        let values = data.result.records ;

        // placer les values de la REGADM dans une array pour voir si ils ont déja passé et ensuite les faire sortir une a une grace a une boucle pour les mettre dans un ordre logique pour le choix

        values.forEach(element => {
            output += `<option>${element.munnom}</option>`;
        })

        values.forEach(element => {
            output2 += `<option>${element.regadm}</option>`;
        })

        selectDrop.innerHTML = output;
        selectDrop2.innerHTML = output2;
    }).catch((err) => {
        console.log(err);
    })


});
