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
    static post(uri,data) {
        return new Promise((resolve, reject) => {
            if(typeof window.fetch==='function'){
                fetch(uri, {
                    method: 'POST', // *GET, POST, PUT, DELETE, etc.
                    mode: 'cors', // no-cors, *cors, same-origin
                    cache: 'no-cache', // *default, no-cache, reload, force-cache, only-if-cached
                    credentials: 'same-origin', // include, *same-origin, omit
                    headers: {
                      'Content-Type': 'application/x-www-form-urlencoded'
                    },
                    redirect: 'follow', // manual, *follow, error
                    referrerPolicy: 'no-referrer', // no-referrer, *no-referrer-when-downgrade, origin, origin-when-cross-origin, same-origin, strict-origin, strict-origin-when-cross-origin, unsafe-url
                    body: data})
                    .then(result => {
                        resolve(result.json());
                    })
                    .catch(function(evt){
                        reject(evt);
                    });
            }else{
                var xhr=new XMLHttpRequest();
                xhr.open('POST', uri, true);
                xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
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
        
                xhr.send(data);
            }
        });
    }

    static get(uri) {
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