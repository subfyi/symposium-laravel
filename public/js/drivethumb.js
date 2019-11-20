var createDriveThumbnails = function(){

    var nodesArray = Array.prototype.slice.call(document.querySelectorAll('img[data-drive-thumbnail-file]'));

    nodesArray.forEach(function(element) {
        var filePath = element.getAttribute('data-drive-thumbnail-file');
        var xhr = new XMLHttpRequest();
        xhr.responseType = 'arraybuffer';
        xhr.open('GET', filePath);
        xhr.onload = function (e) {
            url_content(filePath).success(function(data){
                element.src = data;
            });
        };
        xhr.send();
    });
};
function url_content(url){
    return $.get(url);
}
if (
    document.readyState === "complete" ||
    (document.readyState !== "loading" && !document.documentElement.doScroll)
) {
    createDriveThumbnails();
} else {
    document.addEventListener("DOMContentLoaded", createDriveThumbnails);
}
