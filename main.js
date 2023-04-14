function toggleTheme() {
  var switchBtn = document.getElementById("switch");
  if (switchBtn.classList.contains("switch-left")) {
    switchBtn.classList.remove("switch-left");
    switchBtn.classList.add("switch-right");
    document.body.classList.add("dark-mode");
  } else {
    switchBtn.classList.remove("switch-right");
    switchBtn.classList.add("switch-left");
    document.body.classList.remove("dark-mode");
  }
}

function toggleSidebar() {
  var sidebar = document.getElementById("sidebar");
  var header = document.querySelector("header");
  var main = document.querySelector("main");
  if (sidebar.classList.contains("sidebar-open")) {
    sidebar.classList.remove("sidebar-open");
    header.classList.remove("open-header");
    main.classList.remove("open-main");
  } else {
    sidebar.classList.add("sidebar-open");
    header.classList.add("open-header");
    main.classList.add("open-main");
  }
}
