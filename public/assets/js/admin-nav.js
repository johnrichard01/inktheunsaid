var myOffcanvas = new bootstrap.Offcanvas(document.getElementById('offcanvasScrolling'));
myOffcanvas.show();

document.getElementById('closeSide').addEventListener('click', function () {
    document.getElementById('dashContainer').classList.add('dash-expand');
});
document.getElementById('openButton').addEventListener('click', function () {
    if(document.getElementById('dashContainer').classList.contains('dash-expand')){
        document.getElementById('dashContainer').classList.remove('dash-expand');
    }else{
        document.getElementById('dashContainer').classList.add('dash-expand');
    } 
});