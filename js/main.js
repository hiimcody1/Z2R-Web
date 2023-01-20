window.addEventListener('message', function(e) {
    switch(e.data.action) {
        case "switchUrl":
            if(e.data.url !== "undefined")
                window.location=e.data.url;
            break;
        default:
            break;
    }
}, false);