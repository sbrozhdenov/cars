/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)
import './styles/app.css';

// start the Stimulus application
import './bootstrap';

import Vue from 'vue';
import VueImageLightboxCarousel from './components/VueImageLightboxCarousel'
import VuePlayerComponent from './components/VuePlayerComponent'
import FlipCountdown from 'vue2-flip-countdown'

new Vue({
    el: '#app',
    components: {VueImageLightboxCarousel,FlipCountdown, VuePlayerComponent}
})
