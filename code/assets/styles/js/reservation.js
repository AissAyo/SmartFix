// Fonction pour accepter un rendez-vous
function acceptAppointment(id) {
    alert('Appointment ' + id + ' accepted.');
}

// Fonction pour éditer un rendez-vous
function editAppointment(id) {
    alert('Edit appointment ' + id);
}

// Fonction pour supprimer un rendez-vous
function deleteAppointment(id) {
    if (confirm('Are you sure you want to delete this appointment?')) {
        alert('Appointment ' + id + ' deleted.');
    }
}

// Gérer l'ajout d'un rendez-vous
document.getElementById('appointmentForm').addEventListener('submit', function (e) {
    e.preventDefault();
    let clientName = document.getElementById('clientName').value;
    let service = document.getElementById('service').value;
    let date = document.getElementById('appointmentDate').value;
    let time = document.getElementById('appointmentTime').value;

    // Exemple d'ajout du rendez-vous
    alert('Appointment added: ' + clientName + ' - ' + service + ' - ' + date + ' ' + time);

    // Tu peux ajouter ici de la logique pour mettre à jour dynamiquement la table
});
