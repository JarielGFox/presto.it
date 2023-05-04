'use strict';

let elementoNavbar = document.getElementById('main-navbar');
let categorie = [];
let categoryMapping;

// IIFE
(function () {

    function createCategoryMapping(categories) {
        const mapping = {};
        categories.forEach(category => {
            mapping[category.id] = category.name;
        });
        return mapping;
    }

    // funzione che richiama le categorie dal menù dropdown

    function fetchCategories() {
        let categorySelect = document.getElementById('category-search');

        fetch('/api/category')
            .then((response) => response.json())
            .then((categories) => {
                categories.forEach(category => {
                    let option = document.createElement('option');
                    option.value = category.name;
                    option.textContent = category.name;
                    categorySelect.appendChild(option);
                });
                categorie = categories;
                categoryMapping = createCategoryMapping(categories);
            })
            .catch(error => {
                console.error('Error fetching categories:', error);
            });
    }


    function menuClassActive() {
        let pathName = window.location.pathname;
        let elementiAnchorNavbar = document.querySelectorAll('#navbarSupportedContent .nav-link');

        for (let i = 0; i < elementiAnchorNavbar.length; i++) {
            let elementoAnchor = elementiAnchorNavbar[i];
            let valoreHref = elementoAnchor.getAttribute('href');

            if (pathName === ('/' + valoreHref)) {

                elementoAnchor.classList.add('active');
            }
        }

        console.log('menuClassActive -> pathName', pathName);
    }

    fetchCategories();
    menuClassActive();

    document.addEventListener('scroll', function (event) {

        let scrollAttualeVerticale = window.scrollY;

        if (scrollAttualeVerticale > 60) {
            elementoNavbar.classList.add('mt-0');
        }
        else {
            elementoNavbar.classList.remove('mt-0');
        }

    })

})();

