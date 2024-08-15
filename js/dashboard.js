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
var recycle_bin = document.getElementById('recyclable_bin'); // your canvas element
var recycle_bin_gauge = new Gauge(recycle_bin).setOptions(opts); // create sexy gauge!
recycle_bin_gauge.maxValue = 100; // set max gauge value
recycle_bin_gauge.setMinValue(0);  // Prefer setter over gauge.minValue = 0
recycle_bin_gauge.animationSpeed = 50; // set animation speed (32 is default value)
recycle_bin_gauge.set(60); // set actual value

var non_recycle_bin = document.getElementById('non_recyclable_bin'); // your canvas element
var non_recycle_bin_gauge = new Gauge(non_recycle_bin).setOptions(opts); // create sexy gauge!
non_recycle_bin_gauge.maxValue = 100; // set max gauge value
non_recycle_bin_gauge.setMinValue(0);  // Prefer setter over gauge.minValue = 0
non_recycle_bin_gauge.animationSpeed = 50; // set animation speed (32 is default value)
non_recycle_bin_gauge.set(20); // set actual value
