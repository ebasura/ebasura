// Initialize the chart variable
let wasteChart;

// Function to show the loader
function showLoader() {
    document.getElementById("loader").style.display = "block";
}

// Function to hide the loader
function hideLoader() {
    document.getElementById("loader").style.display = "none";
}

// Function to fetch data from the Flask API
async function fetchData(year, binId) {
    showLoader(); // Show loader before fetching data
    try {
        const response = await fetch(`${bitress.Http.api_url}/api/getWasteData?year=${year}&binId=${binId}`);
        const data = await response.json();

        // Check for errors in the response
        if (data.error) {
            console.error("Error fetching data:", data.error);
            hideLoader(); // Hide loader if there's an error
            return null; // Return null if there's an error
        }

        return data; // Return the data as it is structured for ApexCharts
    } catch (error) {
        console.error("Fetch error:", error);
        hideLoader(); // Hide loader on fetch error
        return null; // Return null on fetch error
    } finally {
        hideLoader(); // Always hide loader after fetching
    }
}

// Function to create and render the ApexCharts chart
function createChart(data) {
    if (!data) {
        console.error("No data available to create the chart.");
        return; // Exit if there's no data
    }

    const options = {
        series: data.series, // Data formatted for ApexCharts
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
                colors: ['#f3f3f3', 'transparent'],
                opacity: 0.5
            },
        },
        markers: {
            size: 1
        },
        xaxis: {
            categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
            title: {
                text: 'Month'
            }
        },
        yaxis: {
            title: {
                text: 'Waste Amount'
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

    // Render the chart
    if (wasteChart) {
        wasteChart.updateOptions(options);  // Update the chart if it already exists
    } else {
        wasteChart = new ApexCharts(document.querySelector("#wasteChart"), options);
        wasteChart.render();  // Render the chart if it doesn't exist
    }
}

// Function to update the chart based on selected year and bin
async function updateChart() {
    const year = document.getElementById('wasteChartyear').value; // Get selected year
    const binId = document.getElementById('trash_bin_selector').value; // Get selected bin

    const data = await fetchData(year, binId); // Fetch data from the API
    const iframe = document.getElementById('binIframe');

    iframe.src = `https://backend.ebasura.online/daily-waste/${binId}/`;
    createChart(data);
}

// Initial chart load with default values
document.addEventListener("DOMContentLoaded", function () {
    updateChart();  // Load the chart with default selections
});
