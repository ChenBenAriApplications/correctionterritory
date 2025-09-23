<style>
  .bg-light {
    --bs-bg-opacity: 1;
    background-color: rgb(222 222 223) !important;
  }
  

  .navbar-brand {
    margin-right: auto;
    margin-left: 140px; /* Moves the logo 100px to the right */
  }

  .navbar-nav {
    position: absolute;
    left: 50%; /* Moves the menu items further to the right */
    transform: translateX(-40%); /* Adjusts the centering of the items */
    display: contents !important;
  }

  .navbar-collapse {
    justify-content: end;
  }

  .navbar-dark .navbar-nav .nav-link {
    color: rgb(255 255 255 / 100%);
    font-size: 15px;
    font-weight: 500;
  }

  .navbar-dark .navbar-nav .nav-link:hover {
    color: rgb(255 255 255 / 75%);
  }
  .container-fluid{
    width: 100%;
    padding-right: var(--bs-gutter-x, 6.75rem);
    padding-left: var(--bs-gutter-x, .75rem);
    margin-right: auto;
    margin-left: auto;
}
.me-3 {
    margin-right: 0.5rem !important;
}

.navbar {
    background-image: linear-gradient(to right, #383838, #383838);
    position: fixed;
    width: 100%;
    z-index: 999;
}

@media (max-width: 768px) {
.navbar-brand {
    margin-right: auto;
    margin-left: 0px;
}
}


</style>

<nav class="navbar navbar-expand-sm bg-light navbar-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="#"><img src="images/logo.png" style="max-width: 190px;" /></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavbar">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="collapsibleNavbar">
      <ul class="navbar-nav mx-auto">
        <li class="nav-item me-3">
          <a class="nav-link" href="https://correctionterritory.com/">Home</a>
        </li>
        <li class="nav-item me-3">
          <a class="nav-link" href="#">About Us</a>
        </li>
        <li class="nav-item me-3">
          <a class="nav-link" href="https://correctionterritory.com/blogs">Our Blogs</a>
        </li>
        <li class="nav-item me-3">
          <a class="nav-link" href="#">Contact Us</a>
        </li>
      </ul>
    </div>
  </div>
</nav>
