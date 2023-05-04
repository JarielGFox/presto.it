let listaAnnunci = []; // array vuoto

const printAnnunci = document.getElementById('elenco-annunci');
const ricercaLibera = document.getElementById('input-ricerca-libera');
const searchButton = document.getElementById('cerca-btn');
const select = document.getElementById('sort-select');
const categorySearch = document.getElementById('category-search');
const minPriceInput = document.getElementById('min-price');
const maxPriceInput = document.getElementById('max-price');

function onClickSearch() {
    let searchValue = ricercaLibera.value;
    let ricercaCategoria = categorySearch.value;
    let minPrice = Number(minPriceInput.value);
    let maxPrice = Number(maxPriceInput.value);
    let sortOrder = select.value;

    let newArrayFiltered = listaAnnunci;

    if (searchValue || ricercaCategoria || minPrice || maxPrice) {
        newArrayFiltered = listaAnnunci.filter((annuncio) => (
            clickFilter(annuncio, searchValue, ricercaCategoria, minPrice, maxPrice)
        ));

    }

    console.log('Filtered array:', newArrayFiltered);

    // le callback seguenti si trovano in /sort.js

    if (sortOrder == "a-alla-z") {


        newArrayFiltered.sort(nameSortAscending);


    } else if (sortOrder == "z-alla-a") {


        newArrayFiltered.sort(nameSortDescending);


    } else if (sortOrder == "more-expensive") {
        newArrayFiltered.sort(priceSortAscending);
    } else if (sortOrder == "less-expensive") {
        newArrayFiltered.sort(priceSortDescending);
    } else if (sortOrder == "older") {
        newArrayFiltered.sort(dateSortAscending);
    } else if (sortOrder == "newer") {
        newArrayFiltered.sort(dateSortDescending);
    }

    printAdvert(newArrayFiltered);


};

searchButton.addEventListener('click', onClickSearch);


function printAdvert(listaAnnunci) {

    printAnnunci.innerHTML = ''; // resetta l'elemento nell'HTML, altrimenti abbiamo sempre nuovi elementi con appendChild

    listaAnnunci.forEach(function (annuncio) { // prendo gli annunci singolarmente col forEach

        let containerAdvert = document.createElement('div'); // creo il div in cui il singolo annuncio deve apparire
        containerAdvert.classList.add('col-12', 'col-md-4'); // dò le classi al div di cui sopra

        const contenutoAnnunci = showAdvert(annuncio);
        containerAdvert.innerHTML = contenutoAnnunci;
        printAnnunci.appendChild(containerAdvert); // vedi commento ad inizio funzione printAnnunci.innerHTML


    })
}

function callAdvert() {
    fetch('/api/adverts')
        .then(function (response) {
            return response.json();
        })
        .then(function (_listaAnnunci) {

            listaAnnunci = _listaAnnunci;
            printAdvert(_listaAnnunci); // inserisco la callback della funzione che genera la lista degli annunci
        })

};

callAdvert();