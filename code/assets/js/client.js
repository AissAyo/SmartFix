function filterByService(serviceId) {
    const params = new URLSearchParams(window.location.search);
    const vehicleId = params.get('vehicleId');

    let url = '/mecanics';

    if (vehicleId) {
        url += `?vehicleId=${vehicleId}&serviceId=${serviceId}`;
    } else {
        url += `?serviceId=${serviceId}`;
    }

    window.location.href = url;
}