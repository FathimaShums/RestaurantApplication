export function toggleModal() {
    const modal = document.getElementById('loginModal');
    if (modal) {
        modal.classList.toggle('hidden');
    }
}
