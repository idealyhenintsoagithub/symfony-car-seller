/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)
import './styles/app.scss';
import '@popperjs/core';
import * as bootstrap from 'bootstrap';

window.bootstrap = bootstrap;

$(function() {
  const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]');
  const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl));

  $('.supplier-navlink').on('click', function (event) {
    $('#supplier-menu').fadeToggle();
  });

  $('.models-navlink').on('click', function (event) {
    $('#models-menu').fadeToggle();
  });

  console.info(window.shouldScroll);
  if (window.shouldScroll) {
    document.getElementById('product-list-container').scrollIntoView({ behavior : 'smooth' });
  }
});