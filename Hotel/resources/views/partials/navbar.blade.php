<section class="menu">
    <nav class="navbar navbar-expand-lg navbar-light">
      <div class="container">
        <!-- Navbar Toggler for smaller screens -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#menuCollapse"
                aria-controls="menuCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <!-- Navbar Links -->
        <div class="collapse navbar-collapse justify-content-center" id="menuCollapse">
            <ul class="navbar-nav gap-5">
                <li class="nav-item">
                    <a class="nav-link" href="/">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/#about">About Us</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/show-room">Rooms</a>
                </li>
                <!-- Online Appointment option for smaller screens -->
                {{-- <li class="nav-item d-lg-none {{ Request::is('appointment/create') ? 'active' : '' }}">
                    <a class="nav-link btn btn-primary" href="{{ route('appointment.create') }}">Online Appointment</a>
                </li> --}}
            </ul>
        </div>
      </div>
    </nav>
  </section>
  