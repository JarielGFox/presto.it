import 'bootstrap';

import 'bootstrap';

window.onscroll = function() {myFunction()};

var navbar = document.getElementById("main-navbar");
const logout = document.getElementsByClassName("logout-button");
var scroll = navbar.offsetTop;

function myFunction() {
  if (window.pageYOffset > scroll) {
    navbar.classList.add("fixed-top");
  } else {
    navbar.classList.remove("fixed-top");
  }
}

const anchors = document.querySelectorAll('.anchor');

window.addEventListener('scroll', () => {
  if (window.pageYOffset > 0) {
    anchors.forEach(anchor => {
      anchor.classList.add('navbar-anchor');
    });
  } else {
    anchors.forEach(anchor => {
      anchor.classList.remove('navbar-anchor');
    });
  }
});

// CAROSELLO

const carousel = document.querySelector('.carousel');
const slides = carousel.querySelectorAll('.carousel-slide');
const prevBtn = carousel.querySelector('.prev');
const nextBtn = carousel.querySelector('.next');

let currentSlide = 0;
slides[currentSlide].classList.add('active');

function showSlide(n) {
  slides[currentSlide].classList.remove('active');
  currentSlide = (n + slides.length) % slides.length;
  slides[currentSlide].classList.add('active');
}

prevBtn.addEventListener('click', () => {
  showSlide(currentSlide - 1);
});

nextBtn.addEventListener('click', () => {
  showSlide(currentSlide + 1);
});
