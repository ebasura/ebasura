var bitress = {
    App: {
        lang: "en"
    },
    Util: {
        dataTables: {}
    },
    Http: {
        live_monitoring: 'ws://ws.ebasura.online',
        system_monitoring: 'https://api.ebasura.online'
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

bitress.Util.checkServerStatus = function(url) {
    fetch(url)
        .then(response => {
            if (response.ok) {
                console.log("Server is online");
            } else {
                console.log("Server is offline or returned an error status");
            }
        })
        .catch(error => {
            console.log("Error: Server is offline or unreachable");
        });
}

// Example usage:
bitress.Util.checkServerStatus('https://example.com/api/endpoint');

