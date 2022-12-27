<nav class="flex items-center justify-between navbar navbar-expand-md">
  <a class="mr-4 navbar-brand" href="{{route('home')}}">
      <img src="{{asset('gradebook-frontend-blue/images/dmo-logo.png')}}" alt="Logo">
  </a>

  <button class="block navbar-toggler focus:outline-none md:hidden" type="button" data-toggle="collapse" data-target="#navbarOne" aria-controls="navbarOne" aria-expanded="false" aria-label="Toggle navigation">
      <span class="toggler-icon"></span>
      <span class="toggler-icon"></span>
      <span class="toggler-icon"></span>
  </button>

  <!-- justify-center hidden md:flex collapse navbar-collapse sub-menu-bar -->
  <div class="absolute left-0 z-30 hidden w-full px-5 py-3 duration-300 bg-white shadow md:opacity-100 md:w-auto collapse navbar-collapse md:block top-100 mt-full md:static md:bg-transparent md:shadow-none" id="navbarOne">
      <ul class="items-center content-start mr-auto lg:justify-center md:justify-end navbar-nav md:flex">
          <!-- flex flex-row mx-auto my-0 navbar-nav -->
          <li class="nav-item active" id="home">
              <a class="page-scroll" href="{{route('home')}}#home">HOME</a>
          </li>
          <li class="nav-item">
              <a class="page-scroll" href="{{route('home')}}#service">OFFERS</a>
          </li>
          <li class="nav-item">
              <a class="page-scroll" href="{{route('home')}}#contact">GET STARTED</a>
          </li>
          <li class="nav-item" id="login">
            <a class="page-scroll" href="{{route('login')}}">LOGIN</a>
        </li>
      </ul>
  </div>

</nav> <!-- navbar -->