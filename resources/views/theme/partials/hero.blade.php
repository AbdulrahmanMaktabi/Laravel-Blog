  <!--================ Hero sm Banner start =================-->
  <section class="mb-30px">
      <div class="container">
          <div class="hero-banner hero-banner--sm">
              <div class="hero-banner__content">
                  <h1> @yield('page-title') </h1>
                  <nav aria-label="breadcrumb" class="banner-breadcrumb">
                      <ol class="breadcrumb">
                          <li class="breadcrumb-item"><a href="{{ route('theme.home') }}">Home</a></li>
                          <li class="breadcrumb-item active" aria-current="page">@yield('page-title')</li>
                      </ol>
                  </nav>
              </div>
          </div>
      </div>
  </section>
  <!--================ Hero sm Banner end =================-->
