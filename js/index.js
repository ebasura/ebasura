var bitress = {
    App: {
        lang: "en"
    },
    Util: {
        dataTables: {}
    },
    Http: {
        live_monitoring: 'ws://192.168.0.125:8765',
        system_monitoring: 'http://192.168.0.125:5000'
    }
};


const table_logs = new simpleDatatables.DataTable("#table_logs");
bitress.Util.dataTables = table_logs;


/**
 * Fetch the camera feed from the Python API
 */
bitress.Util.cameraFeed = function(){
    alert("hello")
}

