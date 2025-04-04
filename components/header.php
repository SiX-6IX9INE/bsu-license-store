<header class="">
  <nav class="navbar navbar-expand-lg">
    <div class="container">
    <a class="navbar-brand" href="/Home">
      <h2><em>BSU</em> License Store</h2>
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive"
      aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarResponsive">
      <ul class="navbar-nav ml-auto">
      <li class="nav-item <?= $page === 'home' ? 'active' : '' ?>">        <a class="nav-link" href="/Home">Home
        <?= $page === 'Home' ? '<span class="sr-only">(current)</span>' : '' ?>
        </a>
      </li>

      <li class="nav-item <?= in_array($page, ['products', 'product-details', 'checkout']) ? 'active' : '' ?>">
        <a class="nav-link" href="/Products">Products</a>
      </li>

      <li class="nav-item dropdown <?= in_array($page, ['about-us', 'blog', 'testimonials', 'terms']) ? 'active' : '' ?>">
        <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true"
        aria-expanded="false">More</a>

        <div class="dropdown-menu">
          <a class="dropdown-item <?= $page === 'testimonials' ? 'active' : '' ?>" href="/Testimonials">Testimonials</a>
        <a class="dropdown-item <?= $page === 'about-us' ? 'active' : '' ?>" href="/About-Us">About Us</a>
        <a class="dropdown-item <?= $page === 'blog' ? 'active' : '' ?>" href="/Blog">Blog</a>
        <a class="dropdown-item <?= $page === 'terms' ? 'active' : '' ?>" href="/Terms">Terms</a>
        </div>
      </li>

      <li class="nav-item <?= $page === 'contact' ? 'active' : '' ?>">
        <a class="nav-link" href="/Contact">Contact Us</a>
      </li>

      <li class="nav-item <?= $page === 'login' ? 'active' : '' ?>">
        <a class="nav-link" href="/Login">Login</a>
      </li>

      </ul>
    </div>
    </div>
  </nav>
</header>