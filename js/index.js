var bitress = {
    App: {
        lang: "en"
    },

    Http: {
        api_url: 'https://backend.ebasura.online'
    }
};


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
bitress.Util.checkServerStatus(bitress.Http.api_url);

