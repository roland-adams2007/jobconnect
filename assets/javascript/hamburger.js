

document.getElementById('toggleSidebar').addEventListener('click',function(){
    const sidebar = document.getElementById("sidebar");
    const body = document.body;
    sidebar.classList.toggle("hidden");
    body.classList.toggle("no-scroll");
})

document.getElementById('closeSidebar').addEventListener('click',function(){
    const sidebar = document.getElementById("sidebar");
    const body = document.body;
    sidebar.classList.add("hidden");
    body.classList.remove("no-scroll");
})