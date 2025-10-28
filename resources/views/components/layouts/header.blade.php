  <header class=" home-two header-bottom">
      <div class="container">
          <nav class="navbar navbar-expand-lg navbar-light">
              <div class="collapse navbar-collapse" id="navbarSupportedContent">
                  <ul class="navbar-nav nav-menu ms-auto">

                      <li class="nav-item">
                          <div class="get-started-button d-lg-none d-block">
                              <a href="#" class="btn--base w-100">GET STARTED</a>
                          </div>
                      </li>
                      <li class="nav-item dropdown">
                      <li class="nav-item">
                          <a class="nav-link" href="{{ route('home.index') }}">@lang('translate.home')</a>
                      </li>
                      <li class="nav-item">
                          <a class="nav-link" href="{{ route('about_us.index') }}">@lang('translate.about')</a>
                      </li>
                      <li class="nav-item dropdown">
                          <a class="nav-link" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                              @lang('translate.multimedia') <i class="fa-solid fa-angle-down"></i></a>
                          <ul class="dropdown-menu">
                              <li><a class="dropdown-item" href="service.html">Service</a></li>
                              <li><a class="dropdown-item" href="service-details.html">Service Details</a></li>
                          </ul>
                      </li>
                      <li class="nav-item dropdown">
                          <a class="nav-link" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                              @lang('translate.publications') <i class="fa-solid fa-angle-down"></i></a>
                          <ul class="dropdown-menu">
                              <li><a class="dropdown-item" href="team.html">Team</a></li>
                              <li><a class="dropdown-item" href="team-details.html">Team Details</a></li>
                              <li><a class="dropdown-item" href="error.html">404</a></li>
                          </ul>
                      </li>
                      <li class="nav-item dropdown">
                          <a class="nav-link" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                              @lang('translate.programs') <i class="fa-solid fa-angle-down"></i></a>
                          <ul class="dropdown-menu">
                              <li><a class="dropdown-item" href="project.html">Project</a></li>
                              <li><a class="dropdown-item" href="project-details.html">Project Details</a></li>
                          </ul>
                      </li>
                      <li class="nav-item dropdown">
                          <a class="nav-link" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                              @lang('translate.news_and_events') <i class="fa-solid fa-angle-down"></i></a>
                          <ul class="dropdown-menu">
                              <li><a class="dropdown-item" href="blog.html">Blog</a></li>
                              <li><a class="dropdown-item" href="blog-details.html">Blog Details</a></li>
                          </ul>
                      </li>
                      <li class="nav-item">
                          <a class="nav-link" href="contact.html"> @lang('translate.cooperate_with_us')</a>
                      </li>

                      <!-- 🌐 Language Dropdown -->
                      @php
                      $currentLocale = app()->getLocale();
                      @endphp

                      <li class="nav-item dropdown ms-lg-3">
                          <a class="nav-link dropdown-toggle d-flex align-items-center gap-1" href="#"
                              id="languageDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                              🌐
                          </a>
                          <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="languageDropdown">
                              <li><a class="dropdown-item @if($currentLocale === 'en') active @endif"
                                      href="{{ route('locale', ['locale' => 'en']) }}">@lang('translate.english')</a>
                              </li>
                              <li><a class="dropdown-item @if($currentLocale === 'da') active @endif"
                                      href="{{ route('locale', ['locale' => 'da']) }}">@lang('translate.dari')</a></li>
                              <li><a class="dropdown-item @if($currentLocale === 'pa') active @endif"
                                      href="{{ route('locale', ['locale' => 'pa']) }}">@lang('translate.pashto')</a>
                              </li>
                              <li><a class="dropdown-item @if($currentLocale === 'ger') active @endif"
                                      href="{{ route('locale', ['locale' => 'ger']) }}">@lang('translate.german')</a>
                              </li>
                          </ul>
                      </li>

                  </ul>
              </div>
              <a class="navbar-brand logo" href="{{ route('home.index') }}"><img src="assets/images/logo/Logo.png" alt=""></a>
              <button class="navbar-toggler header-button" type="button" data-bs-toggle="collapse"
                  data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                  aria-label="Toggle navigation">
                  <i class="las la-bars"></i>
              </button>

              <!-- <div class="toggle-search-box">
                <div class="search-icon">
                    <i class="las la-search"></i>
                </div>
                <div class="search-input">
                    <form>
                        <input type="text" placeholder="Search...">
                        <button type="submit"><i class="las la-search"></i></button>
                    </form>
                </div>
            </div> -->

              <!-- <div class="get-started-button d-lg-block d-none">
                <a href="#" class="btn--base">GET STARTED</a>
            </div> -->

            
          </nav>
      </div>
  </header>