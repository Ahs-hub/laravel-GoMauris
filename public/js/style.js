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
            });
        });
    });
//#endregion filter tour 

//#region search tour 
    document.addEventListener("DOMContentLoaded", function () {
        const buttons = document.querySelectorAll(".category-btn");
        const cards = document.querySelectorAll(".tour-card");
        const searchInput = document.getElementById("searchInput");

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
    });
//#endregion search tour

//#region gallery swiper tour detailed
    let gallerySwiper;
            
    // Initialize Swiper when modal is shown
    document.getElementById('galleryModal').addEventListener('shown.bs.modal', function () {
        if (!gallerySwiper) {
            gallerySwiper = new Swiper('#gallerySwiper', {
                // Basic settings
                direction: 'horizontal',
                loop: true,
                centeredSlides: true,
                slidesPerView: 1,
                spaceBetween: 20,
                
                // Enable touch/swipe gestures
                touchRatio: 1,
                touchAngle: 45,
                grabCursor: true,
                
                // Smooth transitions
                speed: 800,
                
                // Keyboard control
                keyboard: {
                    enabled: true,
                    onlyInViewport: true,
                },
                
                // Mouse wheel control
                mousewheel: {
                    enabled: true,
                    sensitivity: 1,
                },
                
                // Navigation arrows
                navigation: {
                    nextEl: '.swiper-button-next',
                    prevEl: '.swiper-button-prev',
                },
                
                // Pagination
                pagination: {
                    el: '.swiper-pagination',
                    clickable: true,
                    type: 'bullets',
                },
                
                // Autoplay
                autoplay: {
                    delay: 6000,
                    disableOnInteraction: false,
                    pauseOnMouseEnter: true,
                },
                
                // Effects
                effect: 'slide',
                
                // Parallax effect
                parallax: true,
                
                // Events
                on: {
                    slideChange: function () {
                        updateCounter();
                    },
                    init: function () {
                        updateCounter();
                    },
                    slideChangeTransitionStart: function () {
                        // Add entrance animation
                        const activeSlide = this.slides[this.activeIndex];
                        const img = activeSlide.querySelector('img');
                        const overlay = activeSlide.querySelector('.slide-overlay');
                        
                        if (img) {
                            img.style.transform = 'scale(1.1)';
                            setTimeout(() => {
                                img.style.transform = 'scale(1)';
                            }, 100);
                        }
                    }
                }
            });
        }
    });

    // Pause autoplay when modal is hidden
    document.getElementById('galleryModal').addEventListener('hidden.bs.modal', function () {
        if (gallerySwiper) {
            gallerySwiper.autoplay.stop();
        }
    });

    // Resume autoplay when modal is shown
    document.getElementById('galleryModal').addEventListener('shown.bs.modal', function () {
        if (gallerySwiper) {
            gallerySwiper.autoplay.start();
        }
    });

    // Update photo counter
    function updateCounter() {
        if (gallerySwiper) {
            const current = gallerySwiper.realIndex + 1;
            const total = gallerySwiper.slides.length;
            document.getElementById('currentSlide').textContent = current;
            document.getElementById('totalSlides').textContent = total;
        }
    }

    // Keyboard shortcuts
    document.addEventListener('keydown', function(e) {
        const modal = document.getElementById('galleryModal');
        if (modal.classList.contains('show')) {
            if (e.key === 'Escape') {
                bootstrap.Modal.getInstance(modal).hide();
            }
        }
    });

    // Add touch gestures for mobile
    let touchStartX = 0;
    let touchEndX = 0;

    document.addEventListener('touchstart', function(e) {
        touchStartX = e.changedTouches[0].screenX;
    });

    document.addEventListener('touchend', function(e) {
        touchEndX = e.changedTouches[0].screenX;
        handleSwipe();
    });

    function handleSwipe() {
        const swipeThreshold = 50;
        const modal = document.getElementById('galleryModal');
        
        if (modal.classList.contains('show') && gallerySwiper) {
            if (touchEndX < touchStartX - swipeThreshold) {
                gallerySwiper.slideNext();
            }
            if (touchEndX > touchStartX + swipeThreshold) {
                gallerySwiper.slidePrev();
            }
        }
    }

    // Smooth entrance animation
    window.addEventListener('load', function() {
        const tourCard = document.querySelector('.tour-card');
        tourCard.style.opacity = '0';
        tourCard.style.transform = 'translateY(50px)';
        
        setTimeout(() => {
            tourCard.style.transition = 'all 0.8s ease';
            tourCard.style.opacity = '1';
            tourCard.style.transform = 'translateY(0)';
        }, 300);
    });
//#endregion gallery swiper tour detailed
