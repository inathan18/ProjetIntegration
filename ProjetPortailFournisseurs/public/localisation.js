document.addEventListener('DOMContentLoaded', ()=> {

    const selectDrop = document.querySelector('#city');
    const selectDrop2 = document.querySelector('#region');
    selectDrop.innerHTML = '<option value="">Sélectionner une municipalité</option>';
    selectDrop2.innerHTML = '<option value="">Sélectionner une région</option>';

    

    fetch('https://donneesquebec.ca/recherche/api/action/datastore_search_sql?sql=SELECT%20%22munnom%22%20,%20%22regadm%22%20FROM%20%2219385b4e-5503-4330-9e59-f998f5918363%22')
  
    .then((response) => {
    return response.json()
   
    }).then((data) => {
        let output = ""; 
        let output2 = ""; 
        let values = data.result.records ;

      

        let municipalite = [] ;

        // placer les values de la REGADM dans une array pour voir si ils ont déja passé et ensuite les faire sortir une a une grace a une boucle pour les mettre dans un ordre logique pour le choix

        values.forEach(element => {
            const municipality = element.munnom;
            const region = element.regadm;
            municipalite.push({ munnom: municipality, regadm: region })
        })
        let regions = [...new Set(municipalite.map(element => element.regadm))];  // Get unique regions
        regions.sort(); 
        
        let municipalityOptions = '<option value="">Sélectionner une municipalité</option>';  // Blank option for municipality
        municipalite.forEach(element => {
            municipalityOptions += `<option value="${element.munnom}">${element.munnom}</option>`;
        });

        let regionOptions = '<option value="">Sélectionner une région</option>';
        regions.forEach(region => {
            regionOptions += `<option value="${region}">${region}</option>`;
        });
        selectDrop.addEventListener('change', (event) => {
            const selectedMunicipality = event.target.value;

            // Find the corresponding region from the municipalite array
            const selectedRegion = municipalite.find(item => item.munnom === selectedMunicipality)?.regadm;

            // If a region is found, update the region dropdown, otherwise reset it to the blank option
            if (selectedRegion) {
                selectDrop2.value = selectedRegion;
            } else {
                selectDrop2.value = "";  // Reset region to blank if no municipality is selected
            }
        });
        


        console.log();

        selectDrop.innerHTML = municipalityOptions;
        selectDrop2.innerHTML = regionOptions
    }).catch((err) => {
        console.log(err);
    })


});



document.addEventListener('DOMContentLoaded', ()=> {

    fetch('https://www.donneesquebec.ca/recherche/api/3/action/datastore_search?resource_id=32f6ec46-85fd-45e9-945b-965d9235840a&q=')
});
function suppressionDuplicats(data) {
    return data.filter((value, index) => data.indexOf(value) === index);
}