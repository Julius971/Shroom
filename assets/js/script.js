const mapContainer = document.getElementById("map");

if (mapContainer) {
  const map = L.map("map", {
    attributionControl: false,
    center: [51.7405, 7.1690],
    zoom: 18,
    zoomControl: false,
    className: "map-tiles",
  });

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

  L.tileLayer(
    "https://{s}.google.com/vt?lyrs=y&x={x}&y={y}&z={z}",
    {
      maxZoom: 20,
      subdomains: ["mt0", "mt1", "mt2", "mt3"],
    }
  ).addTo(map);

  const markerIcon = L.icon({
    iconUrl: "./assets/img/user.png",
    iconSize: [32, 37],
    iconAnchor: [16, 37],
    popupAnchor: [0, -30],
  });

  L.marker([51.7405, 7.1690], { icon: markerIcon })
    .addTo(map)
    .bindPopup("Haltern am See, NRW");

  setTimeout(() => map.invalidateSize(), 100);

  const zoomInBtn = document.getElementById("zoomIn");
  const zoomOutBtn = document.getElementById("zoomOut");
  const gotoBtn = document.getElementById("gotoLocation");

  if (zoomInBtn) zoomInBtn.addEventListener("click", () => map.zoomIn());
  if (zoomOutBtn) zoomOutBtn.addEventListener("click", () => map.zoomOut());
  if (gotoBtn) {
    gotoBtn.addEventListener("click", () => {
      if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(
          (pos) => {
            const lat = pos.coords.latitude;
            const lng = pos.coords.longitude;
            map.setView([lat, lng], 18);
            L.marker([lat, lng], { icon: markerIcon })
              .addTo(map)
              .bindPopup("You are here!");
          },
          (err) => {
            console.warn("Unable to get your location");
          }
        );
      } else {
        console.warn("Geolocation not supported");
      }
    });
  }
}


// MARK: - Add Sighting Modal Handling

const addModal = document.getElementById("addSightingModal");
if (addModal) {
  const openDesktopBtn = document.getElementById("addSightingDesktop");
  const openMobileBtn = document.getElementById("addSightingMobile");
  const closeBtn = document.getElementById("closeModal");

  function openModal() {
    addModal.classList.remove("hidden");
    addModal.classList.add("flex");
  }

  function closeModal() {
    addModal.classList.remove("flex");
    addModal.classList.add("hidden");
  }

  if (openDesktopBtn) openDesktopBtn.addEventListener("click", openModal);
  if (openMobileBtn) openMobileBtn.addEventListener("click", openModal);
  if (closeBtn) closeBtn.addEventListener("click", closeModal);

  addModal.addEventListener("click", (e) => {
    if (e.target === addModal) closeModal();
  });
}

// MARK: - Global Theme Handling

const theme = localStorage.getItem("theme");
if (theme === "dark") {
  document.documentElement.classList.add("dark");
  document.documentElement.classList.remove("hidden");
} else if (theme === "light") {
  document.documentElement.classList.remove("dark");
  document.documentElement.classList.remove("hidden");
} else {
  document.documentElement.classList.toggle("dark",
    window.matchMedia("(prefers-color-scheme: dark)").matches
  );
  document.documentElement.classList.remove("hidden");
}


// MARK: - Theme Input in Settings View

const select = document.getElementById('themeSelect');
if (select) {
  select.value = theme ?? 'system';

  const applyTheme = (theme) => {
    localStorage.setItem('theme', theme);
    if (theme === 'dark') document.documentElement.classList.add('dark');
    else if (theme === 'light') document.documentElement.classList.remove('dark');
    else document.documentElement.classList.toggle('dark', window.matchMedia('(prefers-color-scheme: dark)').matches);
  };

  select.addEventListener('change', e => applyTheme(e.target.value));
}


// MARK: - Username Input in Settings View

const usernameInput = document.getElementById('username');
if (usernameInput) {
  const savedUsername = localStorage.getItem('username') || '';
  usernameInput.value = savedUsername;

  usernameInput.addEventListener('input', (e) => {
    localStorage.setItem('username', e.target.value);
  });
}


// MARK: - Reset Settings Button in Settings View

const resetBtn = document.getElementById('resetSettings');
if (resetBtn) {
  resetBtn.addEventListener('click', () => {
    localStorage.clear();
    location.reload();
  });
}


// MARK: - Top Tabs in List View

const tabFindings = document.getElementById('tabFindings');
const tabTypes = document.getElementById('tabTypes');
const listFindings = document.getElementById('listFindings');
const listTypes = document.getElementById('listTypes');

if (tabFindings && tabTypes && listFindings && listTypes) {
  const activateTab = (tab) => {
    if (tab === 'findings') {
      listFindings.classList.remove('hidden');
      listTypes.classList.add('hidden');

      tabFindings.classList.add('bg-green-500', 'text-black', 'dark:text-white');
      tabFindings.classList.remove('bg-white', 'dark:bg-black', 'text-gray-700', 'dark:text-gray-300');
      tabTypes.classList.add('bg-white', 'dark:bg-black', 'text-gray-700', 'dark:text-gray-300');
      tabTypes.classList.remove('bg-green-500', 'text-black', 'dark:text-white');
    } else {
      listTypes.classList.remove('hidden');
      listFindings.classList.add('hidden');

      tabTypes.classList.add('bg-green-500', 'text-black', 'dark:text-white');
      tabTypes.classList.remove('bg-white', 'dark:bg-black', 'text-gray-700', 'dark:text-gray-300');
      tabFindings.classList.add('bg-white', 'dark:bg-black', 'text-gray-700', 'dark:text-gray-300');
      tabFindings.classList.remove('bg-green-500', 'text-black', 'dark:text-white');
    }
  };

  activateTab('findings');
  tabFindings.addEventListener('click', () => activateTab('findings'));
  tabTypes.addEventListener('click', () => activateTab('types'));
}