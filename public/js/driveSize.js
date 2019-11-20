var createDriveSize = function(){

    var nodesArray = Array.prototype.slice.call(document.querySelectorAll('div[data-drive-size-file]'));

    nodesArray.forEach(function(element) {
        var filePath = element.getAttribute('data-drive-size-file');
        var xhr = new XMLHttpRequest();
        xhr.responseType = 'arraybuffer';
        xhr.open('GET', filePath);
        xhr.onload = function (e) {
            url_content(filePath).success(function(data){
                element.append(formatBytes(data));
            });
        };
        xhr.send();
    });
};
function formatBytes(bytes,decimals) {
    if(bytes == 0) return '0B';
    var k = 1024,
        dm = decimals <= 0 ? 0 : decimals || 1,
        sizes = ['B', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB'],
        i = Math.floor(Math.log(bytes) / Math.log(k));
    return parseFloat((bytes / Math.pow(k, i)).toFixed(dm)) + sizes[i];
}

function url_content(url){
    return $.get(url);
}
if (
    document.readyState === "complete" ||
    (document.readyState !== "loading" && !document.documentElement.doScroll)
) {
    createDriveSize();
} else {
    document.addEventListener("DOMContentLoaded", createDriveSize);
}
