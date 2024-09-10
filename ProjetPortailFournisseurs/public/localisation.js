document.addEventListener("DOMContentLoaded", () => {
    const selectDrop = document.querySelector("#city");
    const selectDrop2 = document.querySelector("#province");

    fetch(
        "https://donneesquebec.ca/recherche/api/action/datastore_search_sql?sql=SELECT%20%22munnom%22%20,%20%22regadm%22%20FROM%20%2219385b4e-5503-4330-9e59-f998f5918363%22",
    )
        .then((response) => {
            return response.json();
        })
        .then((data) => {
            let output = "";
            let output2 = "";
            let values = data.result.records;

            let regions = [];

            let municipalite = [];

            // placer les values de la REGADM dans une array pour voir si ils ont
            // déja passé et ensuite les faire sortir une a une grace a une boucle
            // pour les mettre dans un ordre logique pour le choix

            values.forEach((element) => {
                regions.push(element.regadm);
                municipalite.push(element.munnom);
            });

            regions.sort();

            function suppressionDuplicats(data) {
                return data.filter(
                    (value, index) => data.indexOf(value) === index,
                );
            }

            suppressionDuplicats(municipalite).forEach((element) => {
                output += `<option>${element}</option>`;
            });

            suppressionDuplicats(regions).forEach((element) => {
                output2 += `<option>${element}</option>`;
            });

            console.log();

            selectDrop.innerHTML = output;
            selectDrop2.innerHTML = output2;
        })
        .catch((err) => {
            console.log(err);
        });
});
