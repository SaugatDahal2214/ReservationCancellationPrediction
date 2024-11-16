@extends('users.master')

@section('content')

<section id="home">
<div class="swiper-container mySwiper">
    <div class="swiper-wrapper">
      @foreach ($sliders as $slider)
      <div class="swiper-slide">
        <div class="swiper-slide-overlay swiperClass">
          <img src="{{ asset($slider->image) }}" alt="{{ $slider->title }}" class="slider-image" />
          <div class="container">
            <div class="overlay-text d-flex flex-column flex-lg-row align-items-lg-center">
              <div class="line d-none d-lg-block"></div>
              <div class="message py-4">
                <h2 class="large-text text-center text-lg-start">{{ $slider->description }}</h2>
                {{-- <p class="small-text text-center text-lg-start mb-0">Dirghayu Hospital</p> --}}
                <!-- Navigation buttons -->
                <div class="navigation-buttons mt-3 d-flex d-none d-lg-flex">
                  <div class="swiper-button-prev me-2"></div>
                  <div class="swiper-button-next ms-2"></div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      @endforeach
    </div>
  </div>
</section>

  <section class="about-us pt-5" id="about"> 
    <div class="container">
        <h2 class="our-stories text-center pb-4 pb-md-5">
            Our <span class="green-text">Stories</span>
        </h2>
        <div class="row align-items-center">
            <div class="col-lg-6 mb-4 mb-lg-0 text-center text-md-start">
                <div class="about-body">
                    <p class="first-paragraph" style="line-height: 1.6; text-align: center;">
                        {{ $story->paragraph_one }}
                    </p>
                    <p class="first-paragraph" style="line-height: 1.6; text-align: center;">
                        {{ $story->paragraph_two }}
                    </p>
                </div>
            </div>
            <div class="col-lg-6 d-none d-lg-block">
                <div class="about-image text-center">
                    <img src="{{ asset('storage/' . $story->image) }}" alt="About Us Image" />
                </div>
            </div>
        </div>
    </div>
</section>


<section class="Departments-home py-5 mt-5" id="rooms">
  <div class="container">
      <h2 class="our-stories text-center pb-5">
          Our <span class="green-text">Rooms</span>
      </h2>
      <div class="row text-center my-3">
          @foreach ($rooms as $room)
              <div class="col-sm-6 col-md-3 mb-4">
                  <div class="card h-100">
                      <div class="card-body d-flex flex-column justify-content-center align-items-center">
                          <img class="depart-image rounded mb-4" src="{{ asset('storage/' . $room->image) }}"
                              alt="{{ $room->title }}" />
                          <div class="depart-name text-center mt-2">{{ $room->type_as_string }}</div>
                          <div class="text-center mt-2">{{ Str::limit($room->description, 40) }}</div>
                      </div>
                  </div>
              </div>
          @endforeach
      </div>
  </div>
  <div class="row justify-content-center">
      <div class="department-end col-auto">
          <a class="depart-button btn btn-primary mt-5" href="/show-room">Explore All</a>
      </div>
  </div>
</section>



  @endsection