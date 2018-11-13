const baseUrl = 'http://localhost:4000';

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

    let timer: any = 0;

    return (callback: any, ms: number) => {
        clearTimeout (timer);
        timer = setTimeout(callback, ms);
    };
})();

declare global {
    interface Window { clipboardData: any; }
}

export const copyToClipboard = (text: string | number) => {
    if (window.clipboardData && window.clipboardData.setData) {
        // IE specific code path to prevent textarea being shown while dialog is visible.
        return window.clipboardData.setData("Text", text); 

    } else if (document.queryCommandSupported && document.queryCommandSupported("copy")) {
        var textarea = document.createElement("textarea");
        textarea.textContent = text;
        textarea.style.position = "fixed";  // Prevent scrolling to bottom of page in MS Edge.
        document.body.appendChild(textarea);
        textarea.select();
        try {
            return document.execCommand("copy");  // Security exception may be thrown by some browsers.
        } catch (ex) {
            console.warn("Copy to clipboard failed.", ex);
            return false;
        } finally {
            document.body.removeChild(textarea);
        }
    }
}
