//#region    shink nav bar styling
document.addEventListener("scroll", function() {
  const navbar = document.querySelector(".navbar");

  // Only apply effect on desktop (lg and up)
  if (window.innerWidth >= 992) {
    if (window.scrollY > 50) {
      navbar.classList.remove("shrink");
    } else {
      navbar.classList.add("shrink");
    }
  } else {
    // Always reset navbar on mobile
    navbar.classList.remove("shrink");
  }
});

//#endregion shrink nav bar

//#region    toogle the sound button hero 
let player;

// Called automatically by the YouTube IFrame API
function onYouTubeIframeAPIReady() {
  player = new YT.Player("heroVideo", {
    events: {
      onReady: onPlayerReady
    }
  });
}

function onPlayerReady(event) {
  console.log("✅ YouTube player ready");

  player.mute(); // force mute to ensure autoplay works
  
  player.playVideo();

  // Update button icon
  const button = document.getElementById("muteToggle");
  if (button) {
    const icon = button.querySelector("i");
    icon.classList.add("bx-volume-mute");
    icon.classList.remove("bx-volume-full");

    button.addEventListener("click", () => {
      if (player.isMuted()) {
        player.unMute();
        icon.classList.remove("bx-volume-mute");
        icon.classList.add("bx-volume-full");
      } else {
        player.mute();
        icon.classList.remove("bx-volume-full");
        icon.classList.add("bx-volume-mute");
      }
    });
  }
}
//#endregion toogle the sound button hero 

//#region    What chat icon 
    const whatsappIcon = document.getElementById('whatsappIcon');
    const chatPopup = document.getElementById('chatPopup');
    const closeChat = document.getElementById('closeChat');
    const openChatBtn = document.getElementById('openChatBtn');

    let isPopupOpen = false;

    
    if (whatsappIcon && chatPopup && closeChat) {
    
        // Toggle chat popup when icon is clicked
        whatsappIcon.addEventListener('click', function(e) {
            e.stopPropagation();
            if (isPopupOpen) {
                closeChatPopup();
            } else {
                openChatPopup();
            }
        });

        // Close chat when close button is clicked
        closeChat.addEventListener('click', function(e) {
            e.stopPropagation();
            closeChatPopup();
        });

        // Close popup when clicking outside
        document.addEventListener('click', function(e) {
            if (isPopupOpen && !chatPopup.contains(e.target) && !whatsappIcon.contains(e.target)) {
                closeChatPopup();
            }
        });

        function openChatPopup() {
            chatPopup.classList.add('show');
            whatsappIcon.classList.remove('show');
            isPopupOpen = true;
        }

        function closeChatPopup() {
            whatsappIcon.classList.add('show');
            chatPopup.classList.remove('show');
            isPopupOpen = false;
        }

        // Add escape key functionality
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape' && isPopupOpen) {
                closeChatPopup();
            }
        });

        // Optional: Add a subtle floating animation
        let floatDirection = 1;

        setInterval(() => {
            if (!whatsappIcon.matches(':hover') && !isPopupOpen) {
                whatsappIcon.style.transform += ` translateY(${floatDirection * 1}px)`;
                floatDirection *= -1;
            }
        }, 3000);
        
    }

//#endregion  What chat icon 

//#region count animation 
    function animateCounters() {
        const counters = document.querySelectorAll('.stat-number');
    
        counters.forEach(counter => {
        const target = +counter.getAttribute('data-target');
        const duration = 2000; // total animation time in ms
        const frameRate = 30;  // frames per second
        const totalFrames = Math.round(duration / (1000 / frameRate));
        let frame = 0;
    
        const counterInterval = setInterval(() => {
            frame++;
            const progress = frame / totalFrames;
            const currentCount = Math.round(target * progress);
    
            counter.innerText = currentCount;
    
            if (frame === totalFrames) {
            clearInterval(counterInterval);
            counter.innerText = target; // add plus sign at the end
            }
        }, 1000 / frameRate);
        });
    }
    
    const statsSection = document.querySelector('.stats-section');
    
    if (statsSection) {
        window.addEventListener('scroll', () => {
        const sectionTop = statsSection.getBoundingClientRect().top;
        const sectionBottom = statsSection.getBoundingClientRect().bottom;
        const screenHeight = window.innerHeight;
    
        // When section is visible -> animate
        if (sectionTop < screenHeight && sectionBottom > 0) {
            const counters = document.querySelectorAll('.stat-number');
            counters.forEach(c => {
            if (c.innerText === "0") { // prevent re-triggering mid animation
                animateCounters();
            }
            });
        } else {
            // When section is out of view -> reset to 0
            const counters = document.querySelectorAll('.stat-number');
            counters.forEach(c => c.innerText = "0");
        }
        });
    }
//#endregion count animation

//#region filter tour 
document.addEventListener("DOMContentLoaded", function () {
        const buttons = document.querySelectorAll(".category-btn");
        const cards = document.querySelectorAll(".tour-card");

        buttons.forEach(button => {
            button.addEventListener("click", function () {
                const selectedCategory = this.getAttribute("data-category");

                // Remove active from all
                buttons.forEach(btn => btn.classList.remove("active"));
                // Add active to clicked
                this.classList.add("active");

                // Show/hide cards
                cards.forEach(card => {
                    if (selectedCategory === "all" || card.getAttribute("data-category") === selectedCategory) {
                        card.style.display = "block";
                    } else {
                        card.style.display = "none";
                    }
                });

                    
                // Refresh AOS so newly visible cards animate correctly
                if (AOS) {
                    AOS.refresh();
                }
            });
        });
    });
//#endregion filter tour 

//#region search tour 
    document.addEventListener("DOMContentLoaded", function () {
        const buttons = document.querySelectorAll(".category-btn");
        const cards = document.querySelectorAll(".tour-card");
        const searchInput = document.getElementById("searchInput");

    // Only run filter logic if #searchInput exists
    if (searchInput) {
        let selectedCategory = "all";

        function filterCards() {
            const searchTerm = searchInput.value.toLowerCase();

            cards.forEach(card => {
                const category = card.getAttribute("data-category");
                const title = card.querySelector(".card-title").textContent.toLowerCase();

                const matchesCategory = selectedCategory === "all" || category === selectedCategory;
                const matchesSearch = title.includes(searchTerm);

                if (matchesCategory && matchesSearch) {
                    card.style.display = "block";
                } else {
                    card.style.display = "none";
                }
            });
        }

        // Handle category button click
        buttons.forEach(button => {
            button.addEventListener("click", function () {
                buttons.forEach(btn => btn.classList.remove("active"));
                this.classList.add("active");

                selectedCategory = this.getAttribute("data-category");
                filterCards();
            });
        });

        // Handle search input
        searchInput.addEventListener("input", filterCards);
      }
    });
//#endregion search tour

//#region Carousel (Home Carousel)
    document.addEventListener('DOMContentLoaded', function () {
        const homeSwiperEl = document.querySelector('.mySwiper');
        if (homeSwiperEl) {
            const homeSwiper = new Swiper('.mySwiper', {
                slidesPerView: 1,
                spaceBetween: 20,
                loop: true,
                autoplay: {
                    delay: 4000,
                    disableOnInteraction: false,
                },
                pagination: {
                    el: '.swiper-pagination',
                    clickable: true,
                },
                navigation: {
                    nextEl: '.swiper-button-next',
                    prevEl: '.swiper-button-prev',
                },
                breakpoints: {
                    640: {
                        slidesPerView: 2,
                        spaceBetween: 20,
                    },
                    768: {
                        slidesPerView: 2,
                        spaceBetween: 30,
                    },
                    1024: {
                        slidesPerView: 3,
                        spaceBetween: 30,
                    },
                    1200: {
                        slidesPerView: 4,
                        spaceBetween: 30,
                    },
                },
            });

            // Optional: Button interactions
            document.querySelectorAll('.square-yellow-btn').forEach(button => {
                button.addEventListener('click', function () {
                    const serviceName = this.closest('.car-card').querySelector('h5').textContent;
                    alert(`Learn more about: ${serviceName}`);
                });
            });

            const viewAllBtn = document.querySelector('.view-all-btn');
            if (viewAllBtn) {
                viewAllBtn.addEventListener('click', function () {
                    alert('Redirecting to all services page...');
                });
            }
        }
    });
//#endregion Carousel
  
//#region gallery swiper tour detailed

// document.addEventListener('DOMContentLoaded', function () {
    let gallerySwiper;
    const modal = document.getElementById('galleryModal');

    if (modal) {
        modal.addEventListener('shown.bs.modal', function () {
            if (!gallerySwiper) {
                gallerySwiper = new Swiper('#gallerySwiper', {
                    direction: 'horizontal',
                    loop: true,
                    centeredSlides: true,
                    slidesPerView: 1,
                    spaceBetween: 20,
                    speed: 800,
                    grabCursor: true,
                    keyboard: { enabled: true, onlyInViewport: true },
                    mousewheel: { enabled: true, sensitivity: 1 },
                    autoplay: {
                        delay: 6000,
                        disableOnInteraction: false,
                        pauseOnMouseEnter: true,
                    },
                    navigation: {
                        nextEl: '.swiper-button-next',
                        prevEl: '.swiper-button-prev',
                    },
                    pagination: {
                        el: '.swiper-pagination',
                        clickable: true,
                        type: 'bullets',
                    },
                    effect: 'slide',
                    parallax: true,
                    on: {
                        slideChange: updateCounter,
                        init: updateCounter,
                        slideChangeTransitionStart() {
                            const activeSlide = this.slides[this.activeIndex];
                            const img = activeSlide.querySelector('img');
                            if (img) {
                                img.style.transform = 'scale(1.1)';
                                setTimeout(() => {
                                    img.style.transform = 'scale(1)';
                                }, 100);
                            }
                        }
                    }
                });
            } else {
                gallerySwiper.autoplay.start();
            }
        });

        modal.addEventListener('hidden.bs.modal', function () {
            if (gallerySwiper) {
                gallerySwiper.autoplay.stop();
            }
        });

        // Touch gesture support for swipe navigation
        let touchStartX = 0;
        let touchEndX = 0;

        document.addEventListener('touchstart', function (e) {
            touchStartX = e.changedTouches[0].screenX;
        });

        document.addEventListener('touchend', function (e) {
            touchEndX = e.changedTouches[0].screenX;
            const threshold = 50;
            if (modal.classList.contains('show') && gallerySwiper) {
                if (touchEndX < touchStartX - threshold) gallerySwiper.slideNext();
                if (touchEndX > touchStartX + threshold) gallerySwiper.slidePrev();
            }
        });

        // ESC closes modal
        document.addEventListener('keydown', function (e) {
            if (e.key === 'Escape' && modal.classList.contains('show')) {
                bootstrap.Modal.getInstance(modal).hide();
            }
        });

        // Update counter
        function updateCounter() {
            if (!gallerySwiper) return;
        
            document.getElementById('currentSlide').textContent = gallerySwiper.realIndex + 1;
        
            let totalSlides = gallerySwiper.slides.length;
            if (gallerySwiper.params.loop) {
                // Subtract duplicated slides added by loop mode
                totalSlides -= gallerySwiper.loopedSlides;
            }
        
            document.getElementById('totalSlides').textContent = totalSlides + 1;
        }
    }
// });

//#endregion gallery swiper tour detailed

//#region    animation on scroll(use library aos)
  AOS.init({
    duration: 1000, // animation duration
    once: false,     // whether animation happens only once
  });
//#endregion animation on scroll(use library)