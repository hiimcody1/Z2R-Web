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

class WebRequest {
    static fetch(uri) {
        return new Promise((resolve, reject) => {
            if(typeof window.fetch==='function'){
                fetch(uri)
                    .then(result => {
                        resolve(result.json());
                    })
                    .catch(function(evt){
                        reject(evt);
                    });
            }else{
                var xhr=new XMLHttpRequest();
                xhr.open('GET', uri, true);
                xhr.responseType='json';
        
                xhr.onload=function(evt){
                    if(this.status===200){
                        resolve(xhr.response);
                    }else{
                        reject([this.status,evt])
                    }
                };
        
                xhr.onerror=function(evt){
                    reject([this.status,evt])
                };
        
                xhr.send(null);
            }
        });
    }
}