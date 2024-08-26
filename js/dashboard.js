var opts = {
    angle: 0.01, // The span of the gauge arc
    lineWidth: 0.26, // The line thickness
    radiusScale: 0.71, // Relative radius
    pointer: {
        length: 0.49, // // Relative to gauge radius
        strokeWidth: 0.06, // The thickness
        color: '#000000' // Fill color
    },
    limitMax: false,     // If false, max value increases automatically if value > maxValue
    limitMin: false,     // If true, the min value of the gauge will be fixed
    colorStart: '#6F6EA0',   // Colors
    colorStop: '#C0C0DB',    // just experiment with them
    strokeColor: '#EEEEEE',  // to see which ones work best for you
    generateGradient: true,
    highDpiSupport: true,     // High resolution support
    // renderTicks is Optional
    renderTicks: {
        divisions: 6,
        divWidth: 0.9,
        divLength: 0.33,
        divColor: '#333333',
        subDivisions: 8,
        subLength: 0.24,
        subWidth: 0.4,
        subColor: '#666666'
    }

};


/**
 * Update the gauge dynamically
 * @param non_recycle
 * @param recycle
 */
function updateGauge(non_recycle = 0, recycle = 0   ) {

    var recycle_bin = document.getElementById('recyclable_bin'); // your canvas element
    var recycle_bin_gauge = new Gauge(recycle_bin).setOptions(opts); // create sexy gauge!
    recycle_bin_gauge.maxValue = 100; // set max gauge value
    recycle_bin_gauge.setMinValue(0);  // Prefer setter over gauge.minValue = 0
    recycle_bin_gauge.set(recycle); // set actual value

    var non_recycle_bin = document.getElementById('non_recyclable_bin'); // your canvas element
    var non_recycle_bin_gauge = new Gauge(non_recycle_bin).setOptions(opts); // create sexy gauge!
    non_recycle_bin_gauge.maxValue = 100; // set max gauge value
    non_recycle_bin_gauge.setMinValue(0);  // Prefer setter over gauge.minValue = 0
    non_recycle_bin_gauge.set(non_recycle   ); // set actual value

}


function readGaugeValue(){
    updateGauge(0,0)
    setInterval(() => {
        const num1 = getRandomValue();
        const num2 = getRandomValue();
        updateGauge(num1, num2);
    }, 5000);
}

function getRandomValue() {
    return Math.floor(Math.random() * 100) + 1;
}

function liveVideoMonitoring(){

    const videoStream = document.getElementById('video-stream');
    const socket = new WebSocket('ws://localhost:8765');

    socket.onopen = function() {
        console.log("WebSocket connection established");
    };

    socket.onmessage = function(event) {
        // Set the image source to the received base64 image data
        videoStream.src = 'data:image/jpeg;base64,' + event.data;
    };

    socket.onclose = function() {
        console.log("WebSocket connection closed");
    };

    socket.onerror = function(error) {
        console.error("WebSocket error observed:", error);
    };

}



function init(){
    liveVideoMonitoring()
    readGaugeValue()
}



const dataTable = new simpleDatatables.DataTable("#table_logs")

window.onload = init;
