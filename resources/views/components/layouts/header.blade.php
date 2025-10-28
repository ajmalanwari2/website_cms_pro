 <header class=" home-two header-bottom">
     <div class="container">
         <nav class="navbar navbar-expand-lg navbar-light">
             <a class="navbar-brand logo" href="index.html"><img src="assets/images/logo/Logo.png" alt=""></a>
             <button class="navbar-toggler header-button" type="button" data-bs-toggle="collapse"
                 data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                 aria-label="Toggle navigation">
                 <i class="las la-bars"></i>
             </button>

             <div class="toggle-search-box">
                 <div class="search-icon">
                     <i class="las la-search"></i>
                 </div>

                 <div class="search-input">
                     <form>
                         <input type="text" placeholder="Search...">
                         <button type="submit"><i class="las la-search"></i></button>
                     </form>
                 </div>
             </div>

             <div class="get-started-button d-lg-block d-none">
                 <a href="#" class="btn--base">Donate Now</a>
             </div>

             <div class="collapse navbar-collapse" id="navbarSupportedContent">
                 <ul class="navbar-nav nav-menu ms-auto">

                     <li class="nav-item">
                         <div class="get-started-button d-lg-none d-block">
                             <a href="#" class="btn--base w-100">Donate Now</a>
                         </div>
                     </li>
                     <!-- <li class="nav-item dropdown">
                         <a class="nav-link" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                             Home <i class="fa-solid fa-angle-down"></i></a>
                         <ul class="dropdown-menu">
                             <li><a class="dropdown-item" href="index.html">Home 01</a></li>
                             <li><a class="dropdown-item" href="index-two.html">Home 02</a></li>
                         </ul>
                     </li> -->
                     <li class="nav-item">
                        <a class="nav-link" href="{{route('home.index')}}">Home</a>
                    </li>
                     <li class="nav-item">
                         <a class="nav-link" href="{{route('about_us.index')}}">About</a>
                     </li>
                     <li class="nav-item dropdown">
                         <a class="nav-link" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                             Service <i class="fa-solid fa-angle-down"></i></a>
                         <ul class="dropdown-menu">
                             <li><a class="dropdown-item" href="service.html">Service</a></li>
                             <li><a class="dropdown-item" href="service-details.html">Service Details</a></li>
                         </ul>
                     </li>
                     <li class="nav-item dropdown">
                         <a class="nav-link" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                             Pages <i class="fa-solid fa-angle-down"></i></a>
                         <ul class="dropdown-menu">
                             <li><a class="dropdown-item" href="team.html">Team</a></li>
                             <li><a class="dropdown-item" href="team-details.html">Team Details</a></li>
                             <li><a class="dropdown-item" href="error.html">404</a></li>
                         </ul>
                     </li>
                     <li class="nav-item dropdown">
                         <a class="nav-link" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                             Project <i class="fa-solid fa-angle-down"></i></a>
                         <ul class="dropdown-menu">
                             <li><a class="dropdown-item" href="project.html">Project</a></li>
                             <li><a class="dropdown-item" href="project-details.html">Project Details</a></li>
                         </ul>
                     </li>
                     <li class="nav-item dropdown">
                         <a class="nav-link" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                             Blog <i class="fa-solid fa-angle-down"></i></a>
                         <ul class="dropdown-menu">
                             <li><a class="dropdown-item" href="blog.html">Blog</a></li>
                             <li><a class="dropdown-item" href="blog-details.html">Blog Details</a></li>
                         </ul>
                     </li>
                     <li class="nav-item">
                         <a class="nav-link" href="contact.html">Contact</a>
                     </li>
                 </ul>
             </div>
         </nav>
     </div>
 </header>