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

/**
 * TODO: dynamically fetch from the python backend to fetch the values
 * Update the gauge
 */
function readGaugeValue() {
    updateGauge(0, 0);
    (async () => {
        try {
            // Get the selected trash bin ID from the select element
            var selectedTrashBinId =bitress.Utils.settings.active_bin
            const apiBaseUrl = bitress.Http.api_url;
            // Use the selected ID to construct the API URL
            const response = await fetch(`${apiBaseUrl}/gauge/${selectedTrashBinId}`);
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            const data = await response.json();

            let recyclable_depth = data.recyclable_bin;
            let non_recyclable_depth = data.non_recyclable_bin;

            const INITIAL_DEPTH_CM = bitress.Utils.settings.initial_depth;

            if (recyclable_depth > INITIAL_DEPTH_CM) {
                recyclable_depth = INITIAL_DEPTH_CM;
            }
            if (non_recyclable_depth > INITIAL_DEPTH_CM) {
                non_recyclable_depth = INITIAL_DEPTH_CM;
            }

            let recyclable_filled_height = INITIAL_DEPTH_CM - recyclable_depth;
            let non_recyclable_filled_height = INITIAL_DEPTH_CM - non_recyclable_depth;

            let recyclable_percentage_full = (recyclable_filled_height / INITIAL_DEPTH_CM) * 100;
            let non_recyclable_percentage_full = (non_recyclable_filled_height / INITIAL_DEPTH_CM) * 100;

            $("#recyclable_bin_value").text(`${recyclable_percentage_full.toFixed(2)}%`);
            $("#non_recyclable_bin_value").text(`${non_recyclable_percentage_full.toFixed(2)}%`);

            updateGauge(Math.round(recyclable_percentage_full), Math.round(non_recyclable_percentage_full));

        } catch (error) {
            console.error('Error fetching system info:', error);
        }
    })();
}


function systemMonitoring() {

    setInterval(async () => {

        try {
            const apiBaseUrl = bitress.Http.system_monitoring; // Ensure this variable is properly set
            const response = await fetch(`${apiBaseUrl}/system-info`); // Use template literal with `${}`
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            const data = await response.json();

            // Update HTML elements with fetched data
            document.getElementById('os-version').textContent = data.os;
            document.getElementById('kernel-version').textContent = data.kernel_version;
            document.getElementById('uptime').textContent = data.uptime;
            document.getElementById('temperature').textContent = data.temperature;
            document.getElementById('cpu-usage').textContent = `${data.cpu_usage}%`;
            document.getElementById('cpu-progress').style.width = `${data.cpu_usage}%`;
            document.getElementById('disk-usage').textContent = `${data.disk_usage.percent}%`;
            document.getElementById('disk-progress').style.width = `${data.disk_usage.percent}%`;
            document.getElementById('ram-usage').textContent = `${data.memory_usage.percent}%`;
            document.getElementById('ram-progress').style.width = `${data.memory_usage.percent}%`;
        } catch (error) {
            console.error('Error fetching system info:', error);
        }

    }, 1000)


}

function init(){
    readGaugeValue()
    currentBin()
}

window.onload = init;

setInterval(readGaugeValue, 30000);  // Update gauge every 30 seconds

$('#trash_bin_selector').on('change', function() {
    readGaugeValue();
});

function currentBin() { 
    const activeBin = bitress.Utils.settings.active_bin;
    
    if (activeBin == '1') {
        $("#current_bin").text('CAS Bin');
    } else if (activeBin == '2') {
        $("#current_bin").text('CTE Bin');
    } else if (activeBin == '3') {
        $("#current_bin").text('CBME Bin');

    } else {
        $("#current_bin").text('Unknown Bin'); // Optional fallback in case of unrecognized bin
    }
}
