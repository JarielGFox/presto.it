// tutti i filter

const clickFilter = (annuncio, searchValue, ricercaCategoria, minPrice, maxPrice) => {

    const annuncioPrice = Number(annuncio.price);

    const resultOfFreeSearch = searchValue ? (
        (annuncio.title && annuncio.title.toLowerCase().includes(searchValue.toLowerCase())) ||
        (annuncio.body && annuncio.body.toLowerCase().includes(searchValue.toLowerCase()))
    ) : true;

    const resultOfCategorySearch = ricercaCategoria ? categoryMapping[annuncio.category_id] == ricercaCategoria : true;

    const resultOfMinPrice = annuncioPrice && minPrice ? annuncioPrice >= minPrice : true;
    const resultOfMaxPrice = annuncioPrice && maxPrice ? annuncioPrice <= maxPrice : true;

    return resultOfFreeSearch && resultOfCategorySearch && resultOfMinPrice && resultOfMaxPrice;
};



// const clickFilter = (annuncio, searchValue, ricercaCategoria, minPrice, maxPrice) => {

//     const annuncioPrice = Number(annuncio.price);

//     const resultOfFreeSearch = searchValue ? annuncio.title.toLowerCase().includes(searchValue.toLowerCase()) : true;

//     const resultOfCategorySearch = ricercaCategoria ? annuncio.category.includes(ricercaCategoria) : true;

//     const resultOfMinPrice = annuncioPrice && minPrice ? annuncioPrice >= minPrice : true;
//     const resultOfMaxPrice = annuncioPrice && maxPrice ? annuncioPrice <= maxPrice : true;

//     return resultOfFreeSearch && resultOfCategorySearch && resultOfMinPrice && resultOfMaxPrice;
// };





