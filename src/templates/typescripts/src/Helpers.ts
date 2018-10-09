const baseUrl = 'http://localhost:8080';

export class ApiRequest {

    static send(type: string, uri: string, data: any) {
        const url = baseUrl+ '/' + uri;
        return $.ajax({
            url,
            type,
            data,
            contentType: 'application/json; charset=utf-8',            
            error: function(jqXHR: any) {
               console.log('Errors: ', jqXHR);
            },
        });
    }
}


export const delay = (() => {
    let timer = 0;
    return (callback: any, ms: number) => {
        clearTimeout (timer);
        timer = setTimeout(callback, ms);
    };
})();