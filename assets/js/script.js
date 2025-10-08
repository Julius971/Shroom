const mapContainer = document.getElementById("map");

if (mapContainer) {
    const map = L.map("map", { 
        attributionControl: false,
        center: [51.7430, 6.8635],
        zoom: 18,
        zoomControl: false,
        className: 'map-tiles'
    })

    /**

        NASA VIIRS City Lights 2012
     
        L.tileLayer('https://map1.vis.earthdata.nasa.gov/wmts-webmerc/VIIRS_CityLights_2012/default/{time}/{tilematrixset}{maxZoom}/{z}/{y}/{x}.{format}',{
            bounds: [[-85.0511287776, -179.999999975], [85.0511287776, 179.999999975]],
            minZoom: 1,
            maxZoom: 8,
            format: 'jpg',
            time: '',
            tilematrixset: 'GoogleMapsCompatible_Level'
        }).addTo(map);

     **/

    L.tileLayer('https://{s}.google.com/vt?lyrs=y@221097413,traffic&x={x}&y={y}&z={z}',{
        maxZoom: 20,
        subdomains:['mt0','mt1','mt2','mt3']
    }).addTo(map);

    

    const markerIcon = L.icon({
        iconUrl: './assets/img/user.png',
        iconSize: [32, 37],
        iconAnchor: [16, 37],
        popupAnchor: [0, -30],
    });

    L.marker([51.7430, 6.8635], { icon: markerIcon })
    .addTo(map)
    .bindPopup("Haltern am See, NRW")
    .openPopup();

    const zoomInBtn = document.getElementById("zoomIn");
    const zoomOutBtn = document.getElementById("zoomOut");
    const gotoBtn = document.getElementById("gotoLocation");

    if (zoomInBtn) zoomInBtn.addEventListener("click", () => map.zoomIn());
    if (zoomOutBtn) zoomOutBtn.addEventListener("click", () => map.zoomOut());
    if (gotoBtn) {
        gotoBtn.addEventListener("click", () => {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(pos => {
                    const lat = pos.coords.latitude;
                    const lng = pos.coords.longitude;
                    map.setView([lat, lng], 18);
                    L.marker([lat, lng], { icon: markerIcon })
                        .addTo(map)
                        .bindPopup("You are here!")
                        .openPopup();
                }, err => {
                    console.warn("Unable to get your location");
                });
            } else {
                console.warn("Geolocation not supported");
            }
        });
    }

    const addModal = document.getElementById('addSightingModal');
    const openDesktopBtn = document.getElementById('addSightingDesktop');
    const openMobileBtn = document.getElementById('addSightingMobile');
    const closeBtn = document.getElementById('closeModal');

    function openModal() {
        addModal.classList.remove('hidden');
        addModal.classList.add('flex');
    }

    function closeModal() {
        addModal.classList.remove('flex');
        addModal.classList.add('hidden');
    }

    if (openDesktopBtn) openDesktopBtn.addEventListener('click', openModal);
    if (openMobileBtn) openMobileBtn.addEventListener('click', openModal);
    if (closeBtn) closeBtn.addEventListener('click', closeModal);

    // Optional: close modal if clicking outside content
    addModal.addEventListener('click', (e) => {
        if (e.target === addModal) closeModal();
    });
}