document.addEventListener("DOMContentLoaded", function() {
    var map = L.map('map');

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(map);

    var marker;

    map.on('click', function(e) {
        var latlng = e.latlng;
        if (marker) {
            map.removeLayer(marker);
        }
        marker = L.marker(latlng).addTo(map);
        document.getElementById('latitude').value = latlng.lat;
        document.getElementById('longitude').value = latlng.lng;
    });

    fetchReports();

    function fetchReports() {
        fetch('fetch_reports.php')
        .then(response => response.json())
        .then(data => {
            data.forEach(report => {
                L.marker([report.latitude, report.longitude])
                .addTo(map)
                .bindPopup(`<b>Utente:</b> ${report.username}<br><b>Tipo:</b> ${report.type}<br><b>Descrizione:</b> ${report.description}<br><b>Status</b> ${report.status}`);
            });
        });
    }

    if ("geolocation" in navigator) {
        navigator.geolocation.getCurrentPosition(function(position) {
            var userLat = position.coords.latitude;
            var userLng = position.coords.longitude;
            var userMarker = L.circle([userLat, userLng], {
                color: 'green',
                fillColor: '#0f0',
                fillOpacity: 0.5,
                radius: 50
            }).addTo(map);
            map.setView([userLat, userLng], 13);
        }, function() {
            map.setView([37.239, 15.215], 13); // Default view if geolocation is not available
            alert("Geolocalizzazione non disponibile.");
        });
    } else {
        map.setView([37.239, 15.215], 13); // Default view if geolocation is not available
        alert("Geolocalizzazione non disponibile.");
    }
});