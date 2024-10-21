import './bootstrap';
import { toggleModal } from './modal';

document.addEventListener('DOMContentLoaded', () => {
    const loginButton = document.getElementById('loginButton');
    if (loginButton) {
        console.log('Button Clicked');
        loginButton.addEventListener('click', toggleModal);
    }
});
