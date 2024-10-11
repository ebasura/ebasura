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
            var selectedTrashBinId = $('#trash_bin_selector').val();

            const apiBaseUrl = bitress.Http.api_url;
            // Use the selected ID to construct the API URL
            const response = await fetch(`${apiBaseUrl}/gauge/${selectedTrashBinId}`);
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            const data = await response.json();

            $("#recyclable_bin_value").text(data.recyclable_bin);
            $("#non_recyclable_bin_value").text(data.non_recyclable_bin);

            updateGauge(data.recyclable_bin, data.non_recyclable_bin);

        } catch (error) {
            console.error('Error fetching system info:', error);
        }
    })();
}




function liveVideoMonitoring() {
    const updateInterval = 30; 

    setInterval(async () => {
        try {
            const apiBaseUrl = bitress.Http.api_url; 
            const response = await fetch(`${apiBaseUrl}/detection`);
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            const data = await response.json();

            console.log('API Response:', data); 

            const videoStream = document.getElementById('video-stream');
            if (videoStream) {
                if (data.image) {
                    const imageSrc = 'data:image/jpeg;base64,' + data.image;
                    videoStream.src = imageSrc;
                } else {
                    console.warn('Image data not found in response');
                }
            } else {
                console.warn('Video stream element not found');
            }
            const predictedCategoryElement = document.getElementById('predicted_category');
            if (predictedCategoryElement) {
                predictedCategoryElement.textContent = data.predicted_label || 'Unknown';
            } else {
                console.warn('Predicted category element not found');
            }

        } catch (error) {
            console.error('Error fetching system info:', error);
        }
    }, updateInterval);
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
    // liveVideoMonitoring()
    // systemMonitoring()
    readGaugeValue()
}

window.onload = init;


$('#trash_bin_selector').on('change', function() {
    readGaugeValue();
});
