// tutti i sort

const nameSort = (prev, next) => {
    const previousName = prev.title ? prev.title.toLowerCase() : '';
    const nextName = next.title ? next.title.toLowerCase() : '';

    if (previousName < nextName) {
        return -1;
    }
    if (previousName > nextName) {
        return 1;
    }
    return 0;
}

const nameSortAscending = (a, b) => {
    return nameSort(a, b);
};

const nameSortDescending = (a, b) => {
    return nameSort(b, a);
};

const priceSort = (prev, next) => (prev.price - next.price);

const priceSortAscending = (a, b) => priceSort(b, a);

const priceSortDescending = (a, b) => priceSort(a, b);

const dateSort = (prev, next) => { // facciamo il sort delle date come stringhe e poi le convertiamo in date per la comparazione
    const listingDateA = prev.created_at;
    const listingDateB = next.created_at;

    const morphedDateA = new Date(listingDateA);
    const morphedDateB = new Date(listingDateB);

    return morphedDateA - morphedDateB;
}

const dateSortAscending = (a, b) => {  // qui passiamo in astratto la funzione datesort()
    return dateSort(a, b);
}

const dateSortDescending = (a, b) => dateSort(b, a);


// const nameSort = (prev, next) => {
//     const previousName = prev.name.toLowerCase();
//     const nextName = next.name.toLowerCase();

//     if (previousName < nextName) {
//         return -1;
//     }
//     if (previousName > nextName) {
//         return 1;
//     }
//     return 0;
// }

// const nameSortAscending = (a, b) => {
//     return nameSort(a, b);
// };

// const nameSortDescending = (b, a) => {
//     return nameSort(b, a);
// };

// const priceSort = (prev, next) => (prev.price - next.price);

// const priceSortAscending = (a, b) => priceSort(b, a);

// const priceSortDescending = (a, b) => priceSort(a, b);

// const dateSort = (prev, next) => { // facciamo il sort delle date come stringhe e poi le convertiamo in date per la comparazione
//     const listingDateA = prev.created_date;
//     const listingDateB = next.created_date;

//     const morphedDateA = new Date(listingDateA);
//     const morphedDateB = new Date(listingDateB);

//     return morphedDateA - morphedDateB;
// }

// const dateSortAscending = (a, b) => {  // qui passiamo in astratto la funzione datesort()
//     return dateSort(a, b);
// }

// const dateSortDescending = (b, a) => dateSort(b, a);