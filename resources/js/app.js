window.API_URL = "http://127.0.0.1:8000/api";

window.formatDate = function(dateString) {

    if (!dateString) return '-';

    const date = new Date(dateString);

    return date.toLocaleDateString('id-ID', {
        year: 'numeric',
        month: '2-digit',
        day: '2-digit'
    });

}

window.openModal = function(modalId) {

    const modal = document.getElementById(modalId);

    if (!modal) return;

    modal.classList.remove('hidden');
    modal.classList.add('flex');

}

window.closeModal = function(modalId) {

    const modal = document.getElementById(modalId);

    if (!modal) return;

    modal.classList.remove('flex');
    modal.classList.add('hidden');

}