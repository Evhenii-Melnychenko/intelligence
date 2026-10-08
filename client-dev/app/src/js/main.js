import 'webp-in-css/polyfill';
import { initHeaderMenu } from './header';
import { initPostTabs } from './posts';
import { initReaderReviewsSlider } from './reader-reviews';
import { initContactForm } from './contact';

document.addEventListener('DOMContentLoaded', () => {
    initHeaderMenu();
    initPostTabs();
    initReaderReviewsSlider();
    initContactForm();
});