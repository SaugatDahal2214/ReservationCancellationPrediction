<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Ephesis&family=Poppins&display=swap" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css2?family=Ephesis&family=Poppins&family=Questrial&display=swap" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css2?family=Ephesis&family=Oxygen:wght@300;400;700&family=Poppins&family=Questrial&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
  @vite(['resources/css/index.css','resources/sass/app.scss', 'resources/js/app.js', 'resources/js/site.js'])
  <title>Hotel Book</title>
</head>
<body>
  @include('partials.header')

  <main>
    @yield('content')
  </main>

  @include('partials.footer')

  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-element-bundle.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

<script>

document.addEventListener('DOMContentLoaded', function () {
    const swiper = new Swiper('.mySwiper', {
        initialSlide: 1,
        effect: 'fade',
        fadeEffect: {
            crossFade: true
        },
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
        autoplay: {
            delay: 5000, // Change slide every 5 seconds
            disableOnInteraction: false,
        },
        on: {
            slideChange: function () {
                let previousSlide = document.querySelector('.swiper-slide-active .overlay-text');
                if (previousSlide) {
                    previousSlide.classList.remove('fade-in-up');
                    void previousSlide.offsetWidth; // Trigger reflow to restart animation
                    previousSlide.classList.add('fade-in-up');
                }
            },
            init: function () {
                let initialSlide = document.querySelector('.swiper-slide-active .overlay-text');
                if (initialSlide) {
                    initialSlide.classList.add('fade-in-up');
                }
            }
        }
    });

    // Function to handle intersection changes
    const handleIntersection = (entries, observer) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('fade-in');
                observer.unobserve(entry.target); // Optionally, stop observing after animation
            } else {
                entry.target.classList.remove('fade-in');
            }
        });
    };

    // Create an Intersection Observer instance
    const observer = new IntersectionObserver(handleIntersection, {
        threshold: 0.6// Adjust the threshold as needed
    });

    // Observe elements to animate
    document.querySelectorAll('.about-body p, .about-image img, .our-stories, .Departments-home, .Departments-home .card-body, .doctors, .doctors .member, .testimonials .swiper-container, .packages .card , .about-section, .Departments, .Departments .cards ').forEach(element => {
        observer.observe(element);
    });
});


</script>


  
</body>
</html>