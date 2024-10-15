import './bootstrap';
import { toggleModal } from './modal';
document.addEventListener('DOMContentLoaded', () => {
    const loginButton = document.getElementById('loginButton');
    if (loginButton) {
        loginButton.addEventListener('click', toggleModal);
    }
});
