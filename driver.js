let map, driverMarker, stopMarkers = [];
let currentRoutePolyline;               
let currentStopIndex = 0;            
let isGpsOnline = false;            
let watchId = null;                    


// --- ROUTE DEFINITION (BASE STOPS) ---
// Defines the default route and its properties. Coordinates are in [latitude, longitude] format.
const baseStops = [
    { name: "SM Lipa", location: [13.9450, 121.1600], distance: 0.0, eta: 0, status: "Pending", type: "terminal" },
    { name: "Balintawak", location: [13.9400, 121.1555], distance: 1.2, eta: 3, status: "Pending", type: "stop" },
    { name: "Bigben", location: [13.9425, 121.1525], distance: 0.8, eta: 2, status: "Pending", type: "stop" },
    { name: "Robinsons Lipa", location: [13.9405, 121.1635], distance: 1.5, eta: 3, status: "Pending", type: "stop" },
    { name: "De La Salle Lipa", location: [13.9350, 121.1700], distance: 1.0, eta: 2, status: "Pending", type: "stop" },
    { name: "Tambo", location: [13.9385, 121.1765], distance: 1.2, eta: 3, status: "Pending", type: "stop" },
    { name: "Brgy. Sico", location: [13.9350, 121.1850], distance: 2.0, eta: 4, status: "Pending", type: "stop" },
    { name: "Banaybanay", location: [13.9470, 121.1505], distance: 3.5, eta: 7, status: "Pending", type: "stop" },
    { name: "Mataas na Kahoy", location: [13.9500, 121.1300], distance: 2.5, eta: 5, status: "Pending", type: "terminal" }, // Final Stop
];

// Active trip data. This is a mutable copy of baseStops. Statuses are updated here.
let currentRouteStops = JSON.parse(JSON.stringify(baseStops)); 
let tripDirection = "SM Lipa to Mataas na Kahoy"; 
let currentDriverLocation = currentRouteStops[0].location;


const driverIcon = L.icon({
    iconUrl: 'data:image/svg+xml;charset=utf-8,' + encodeURIComponent('<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"><path fill="#293B8B" d="M144 80C144 35.8 179.8 0 224 0H528c23.5 0 42.7 19.3 42.7 42.7c0 3.3-.4 6.6-1.3 9.8l-72 256c-5.7 20-23.7 34.5-45 37.7l-9.5 1.4L400 512l-10.7-32H206.7c-21.3 0-41.2-11.8-51.5-30.8L12.9 198.5c-16.6-30-10.7-68 14.3-92.4C44.7 93.3 75 80 107.5 80H144zM256 160a32 32 0 1 0 -64 0 32 32 0 1 0 64 0zM352 240a32 32 0 1 0 0-64 32 32 0 1 0 0 64z"/></svg>'),
    iconSize: [32, 32], iconAnchor: [16, 32], popupAnchor: [0, -32]
});

const stopIcon = L.icon({
    iconUrl: 'data:image/svg+xml;charset=utf-8,' + encodeURIComponent('<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512"><path fill="#D74B2A" d="M215.7 499.2C267 435 384 279.4 384 192C384 86 298 0 192 0S0 86 0 192c0 87.4 117 243.3 168.3 307.2c12.3 15.3 35.1 15.3 47.4 0zM192 128a64 64 0 1 1 0 128 64 64 0 1 1 0-128z"/></svg>'),
    iconSize: [32, 32], iconAnchor: [16, 32], popupAnchor: [0, -32]
});

const terminalIcon = L.icon({
    iconUrl: 'data:image/svg+xml;charset=utf-8,' + encodeURIComponent('<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"><path fill="#667A56" d="M543.8 29.8C556 32.8 565.1 41.9 568.1 54.2L576 86.6L448 320V480c0 17.7-14.3 32-32 32H160c-17.7 0-32-14.3-32-32V320L0 86.6L7.9 54.2C10.9 41.9 20 32.8 32.2 29.8s24.4-1.2 35.8 5.8l100 60c2.7 1.6 5.8 2.4 8.8 2.4s6.1-.8 8.8-2.4l100-60c11.4-7 24.8-8.7 35.8-5.8zM240 400c0 8.8-7.2 16-16 16H184c-8.8 0-16-7.2-16-16V352c0-8.8 7.2-16 16-16h40c8.8 0 16 7.2 16 16v48zm96-48v48c0 8.8-7.2 16-16 16H296c-8.8 0-16-7.2-16-16V352c0-8.8 7.2-16 16-16h40c8.8 0 16 7.2 16 16zM416 400c0 8.8-7.2 16-16 16H360c-8.8 0-16-7.2-16-16V352c0-8.8 7.2-16 16-16h40c8.8 0 16 7.2 16 16v48z"/></svg>'),
    iconSize: [32, 32], iconAnchor: [16, 32], popupAnchor: [0, -32]
});


// --- LEAFLET INITIALIZATION FUNCTION ---
function initMap() {

    map = L.map("map").setView(currentDriverLocation, 14);

    L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png", {
        attribution: "&copy; OpenStreetMap contributors"
    }).addTo(map);

    driverMarker = L.marker(currentDriverLocation, {icon: driverIcon})
        .addTo(map)
        .bindPopup("Your Current Location")
        .openPopup();
        
    // Initial setup: Mark the starting terminal as 'Arrived'
    currentRouteStops[0].status = "Arrived"; 
    // Move to the next stop index (1) for the first confirmation
    currentStopIndex = 1; 

    updateMapElements(); 
    updateStopDisplay(currentStopIndex);
    
    // Attach event listener for the confirmation button
    document.getElementById("confirmStopBtn").addEventListener("click", handleConfirmStop);

    // Start real-time GPS monitoring using the Geolocation API
    startGpsMonitoring(); 

    // Fix map rendering issues common with Leaflet initialization within a flex container
    setTimeout(() => map.invalidateSize(), 500);
    window.addEventListener("resize", () => {
        setTimeout(() => map.invalidateSize(), 300);
    });
}

// ---GPS STATUS MONITORING FUNCTIONS (REAL-TIME)---
// Uses navigator.geolocation.watchPosition() to get continuous updates.

function updateGpsUi() {
    const statusEl = document.getElementById('gps-status');
    const statusTextEl = document.getElementById('gps-text');
    
    statusEl.classList.remove('status-online', 'status-offline');

    if (isGpsOnline) {
        statusEl.classList.add('status-online');
        statusTextEl.textContent = "GPS: Online";
    } else {
        statusEl.classList.add('status-offline');
        statusTextEl.textContent = "GPS: Offline";
    }
}

/**
 * Initializes continuous location monitoring using the browser's Geolocation API.
 * Calls onGpsSuccess or onGpsError on updates or failures.
 */
function startGpsMonitoring() {
    if ("geolocation" in navigator) {
        const options = {
            enableHighAccuracy: true,
            timeout: 10000, // Maximum time (ms) to wait for a location
            maximumAge: 0   // Don't use a cached position
        };
        
        // Starts the continuous position watcher
        watchId = navigator.geolocation.watchPosition(onGpsSuccess, onGpsError, options);
    } else {
        // Geolocation not supported by the device/browser
        isGpsOnline = false;
        updateGpsUi();
    }
}

/* Success callback for watchPosition. Called when a new, valid location is retrieved */
function onGpsSuccess(position) {
    // Only update the UI if the status was previously offline
    if (!isGpsOnline) {
        isGpsOnline = true;
        updateGpsUi();
    }
    
    // NOTE: This section is commented out but can be used for real-time driver movement simulation:
    // currentDriverLocation = [position.coords.latitude, position.coords.longitude];
    // driverMarker.setLatLng(currentDriverLocation);
}

/* Error callback for watchPosition. Called if GPS signal is lost, permission is denied, or a timeout occurs */
function onGpsError(error) {
    if (isGpsOnline) {
        isGpsOnline = false;
        updateGpsUi();
    }
    console.error(`GPS Error (${error.code}): ${error.message}`);
}

// --- ROUTE & MAP LOGIC FUNCTIONS ---

/* Reverses the stops array for the return trip and resets their status to "Pending" */
function reverseRoute(currentStops) {
    let reversed = JSON.parse(JSON.stringify(currentStops)).reverse();
    reversed.forEach(stop => stop.status = "Pending");
    return reversed;
}

/* Removes old markers/polyline and redraws the route, stops, and driver's current position on the map */
function updateMapElements() {
    if (currentRoutePolyline) {
        map.removeLayer(currentRoutePolyline);
    }
    stopMarkers.forEach(marker => map.removeLayer(marker));
    stopMarkers = [];
    
    // Update driver marker position
    driverMarker.setLatLng(currentDriverLocation);

    // Redraw route polyline (uses different color based on trip direction)
    let routeCoordinates = currentRouteStops.map(s => s.location);
    currentRoutePolyline = L.polyline(routeCoordinates, { 
        color: (tripDirection.includes("SM Lipa") ? "#F2B880" : "#667A56"), // Orange or Green
        weight:5, opacity:0.9 
    }).addTo(map);

    // Redraw stop markers
    currentRouteStops.forEach((stop, i) => {
        let iconToUse = stop.type === 'terminal' ? terminalIcon : stopIcon;
        
        const marker = L.marker(stop.location, {icon: iconToUse})
            .addTo(map)
            .bindPopup(`Stop ${i+1}: <b>${stop.name}</b>`);
        stopMarkers.push(marker);
    });
    
    map.setView(currentDriverLocation, 14);
    

    document.getElementById("route-direction-display").textContent = `ROUTE: ${tripDirection}`;
}

function updateStopDisplay(index) {
    const nextStop = currentRouteStops[index];
    const confirmBtn = document.getElementById("confirmStopBtn");
    const stopCountEl = document.getElementById("stop-counter");

    // Ensure button is visible and enabled
    confirmBtn.style.display = 'block'; 
    confirmBtn.disabled = false;
    
    // Update Info Box details
    document.getElementById("next-stop-name").textContent = nextStop.name;
    document.getElementById("stop-distance").textContent = `${nextStop.distance.toFixed(1)} km`;
    document.getElementById("stop-eta").textContent = `${nextStop.eta} mins`;
    
    const totalStops = currentRouteStops.length;
    stopCountEl.textContent = `NEXT DESIGNATED STOP (Stop ${index + 1} of ${totalStops})`;
    
    let buttonText = `<i class="fa-solid fa-circle-check"></i> ARRIVED at ${nextStop.name.toUpperCase()}`;
    
    // Reset button classes
    confirmBtn.classList.remove('btn-custom', 'btn-final', 'btn-resetting');

    if (index === totalStops - 1) {
        // Final Stop Styling (Green)
        buttonText = `
            CONFIRM FINAL ARRIVAL
            <br>
            <span style="font-size: 0.9em; font-weight: 700;">${nextStop.name.toUpperCase()}</span>
        `;
        confirmBtn.classList.add('btn-final');
    } else {
        // Regular Stop Styling (Orange)
        confirmBtn.classList.add('btn-custom');
    }

    confirmBtn.innerHTML = buttonText;
}

/**
 * Resets the trip state, reverses the route, and prepares for the return journey.
 * This is called automatically after the final stop is confirmed.
 */
function autoResetAndReverse() {
    // 1. Reverse the stops array
    currentRouteStops = reverseRoute(currentRouteStops);
    
    // 2. Toggle the trip direction string
    if (tripDirection === "SM Lipa to Mataas na Kahoy") {
        tripDirection = "Mataas na Kahoy to SM Lipa";
    } else {
        tripDirection = "SM Lipa to Mataas na Kahoy";
    }
    
    // 3. Reset index and driver location to the new starting terminal
    currentRouteStops[0].status = "Arrived"; 
    currentStopIndex = 1; 
    currentDriverLocation = currentRouteStops[0].location; 

    // 4. Update all map elements (polyline, markers, direction)
    updateMapElements(); 
    
    // 5. Restore Confirm Button state and display the next stop details
    document.getElementById("route-direction-display").textContent = `ROUTE: ${tripDirection}`;
    document.getElementById("confirmStopBtn").disabled = false;
    document.getElementById("confirmStopBtn").style.display = 'block'; 
    updateStopDisplay(currentStopIndex);
}

/* Main handler for the "Confirm Stop" button. Advances the trip state. */
function handleConfirmStop() {
    const totalStops = currentRouteStops.length;

    if (currentStopIndex < totalStops) {
        // Mark the current stop as 'Arrived' and advance the index
        currentRouteStops[currentStopIndex].status = "Arrived";
        currentStopIndex++;
        
        // Update driver location to the confirmed stop's coordinates
        currentDriverLocation = currentRouteStops[currentStopIndex - 1].location; 
        driverMarker.setLatLng(currentDriverLocation); 

        if (currentStopIndex < totalStops) {
            // Still stops remaining, update UI for the next stop
            updateStopDisplay(currentStopIndex);
        } 
        
        // Check for Route Completion (Last Stop)
        if (currentStopIndex === totalStops) {
            // UI update for 'Resetting Route' 
            const confirmBtn = document.getElementById("confirmStopBtn");
            confirmBtn.classList.add('btn-resetting');
            confirmBtn.classList.remove('btn-final', 'btn-custom');
            
            document.getElementById("confirmStopBtn").innerHTML = `<i class="fa-solid fa-sync-alt fa-spin"></i> RESETTING ROUTE...`; 
            document.getElementById("confirmStopBtn").disabled = true;

            // Execute instant reset and reverse logic after a short delay (1 second)
            setTimeout(autoResetAndReverse, 1000); 
        }
    }
}

/* Emergency button Bootstrap modal */
function handleEmergency() {
    // Initialize and show the Bootstrap modal instance
    const emergencyModal = new bootstrap.Modal(document.getElementById('emergencyModal'));
    emergencyModal.show();
}

// Event listener for the confirmation inside the modal
document.getElementById("confirmAlertBtn").addEventListener("click", () => {
    const confirmBtn = document.getElementById("confirmAlertBtn");
    
    confirmBtn.textContent = "Sending...";
    confirmBtn.disabled = true;

    // Simulate sending the alert (1.5 seconds delay)
    setTimeout(() => {
        alert("EMERGENCY ALERT SENT to Operations and Authorities! Stay Safe.");
        
        const emergencyModal = bootstrap.Modal.getInstance(document.getElementById('emergencyModal'));
        emergencyModal.hide();
        
        confirmBtn.textContent = "Send Alert Now";
        confirmBtn.disabled = false;
    }, 1500);
});

document.addEventListener("DOMContentLoaded", initMap);