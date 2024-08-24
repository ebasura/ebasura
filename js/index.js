var bitress = {
    App: {
        lang: "en"
    },
    Util: {
        dataTables: {}
    },
    Http: {}
};


const table_logs = new simpleDatatables.DataTable("#table_logs");
bitress.Util.dataTables = table_logs;


/**
 * Fetch the camera feed from the Python API
 */
bitress.Util.cameraFeed = function(){
    alert("hello")
}

