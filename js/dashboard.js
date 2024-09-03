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
function readGaugeValue(){
    updateGauge(0,0)
    setInterval(async () => {

        try {
            const apiBaseUrl = bitress.Http.system_monitoring; // Ensure this variable is properly set
            const response = await fetch(`${apiBaseUrl}/gauge`); // Use template literal with `${}`
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            const data = await response.json();

            updateGauge(data.recyclable_bin, data.non_recyclable_bin);


        } catch (error) {
            console.error('Error fetching system info:', error);
        }


    }, 1000);
}



function liveVideoMonitoring(){

    const videoStream = document.getElementById('video-stream');
    const socket = new WebSocket(bitress.Http.live_monitoring);

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
            document.getElementById('ram-usage').textContent = `${data.memory_usage.percent}%`;
            document.getElementById('ram-progress').style.width = `${data.memory_usage.percent}%`;
        } catch (error) {
            console.error('Error fetching system info:', error);
        }

    }, 1000)


}


var monthly_waste_segregated = {
    series: [
        {
            name: "Recyclable",
            data: [28, 29, 33, 36, 32, 32, 33]
        },
        {
            name: "Non-Recyclable",
            data: [12, 11, 14, 18, 17, 13, 13]
        }
    ],
    chart: {
        height: 350,
        type: 'line',
        dropShadow: {
            enabled: true,
            color: '#000',
            top: 18,
            left: 7,
            blur: 10,
            opacity: 0.2
        },
        zoom: {
            enabled: false
        },
        toolbar: {
            show: false
        }
    },
    colors: ['#77B6EA', '#545454'],
    dataLabels: {
        enabled: true,
    },
    stroke: {
        curve: 'smooth'
    },
    title: {
        text: 'Amount of Waste Segregated',
        align: 'left'
    },
    grid: {
        borderColor: '#e7e7e7',
        row: {
            colors: ['#f3f3f3', 'transparent'], // takes an array which will be repeated on columns
            opacity: 0.5
        },
    },
    markers: {
        size: 1
    },
    xaxis: {
        categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul'],
        title: {
            text: 'Month'
        }
    },
    yaxis: {
        title: {
            text: 'Trash Level'
        },
        min: 5,
        max: 100
    },
    legend: {
        position: 'top',
        horizontalAlign: 'right',
        floating: true,
        offsetY: -25,
        offsetX: -5
    }
};

var chart = new ApexCharts(document.querySelector("#monthly_logs_chart"), monthly_waste_segregated);
chart.render();




var options1 = {
    title: {
        text: 'Daily Waste Segregation',
        align: 'left'
    },
    series: [{
        name: 'Recyclable',
        data: [31, 40, 28, 51, 42, 109, 100]
    }, {
        name: 'Non Recyclable',
        data: [11, 32, 45, 32, 34, 52, 41]
    }],
    chart: {
        height: 350,
        type: 'area'
    },
    dataLabels: {
        enabled: false
    },
    stroke: {
        curve: 'smooth'
    },
    xaxis: {
        type: 'datetime',
        categories: ["2018-09-19T00:00:00.000Z", "2018-09-19T01:30:00.000Z", "2018-09-19T02:30:00.000Z", "2018-09-19T03:30:00.000Z", "2018-09-19T04:30:00.000Z", "2018-09-19T05:30:00.000Z", "2018-09-19T06:30:00.000Z"]
    },
    tooltip: {
        x: {
            format: 'dd/MM/yy HH:mm'
        },
    },
};

var chart = new ApexCharts(document.querySelector("#daily_logs_chart"), options1);
chart.render();



var options2 = {
    series: [{
        data: [100, 50]
    }],
    chart: {
        height: 250,
        type: 'bar',
        events: {
            click: function(chart, w, e) {
                // console.log(chart, w, e)
            }
        }
    },
    colors: ['#77B6EA', '#545454'],
    plotOptions: {
        bar: {
            columnWidth: '45%',
            distributed: true,
        }
    },
    dataLabels: {
        enabled: false
    },
    legend: {
        show: false
    },
    xaxis: {
        categories: [ 'Recyclable', 'Non Recyclable'
        ],
        labels: {
            style: {
                colors: ['#77B6EA', '#545454'],
                fontSize: '12px'
            }
        }
    }
};

var chart = new ApexCharts(document.querySelector("#trash_bin_weights"), options2);
chart.render();

function init(){
    liveVideoMonitoring()
    systemMonitoring()
    readGaugeValue()
}

window.onload = init;
