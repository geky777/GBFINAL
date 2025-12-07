// Royal Portfolio JavaScript - Swinging Card Animations
document.addEventListener('DOMContentLoaded', function() {
    initializePortfolio();
    initializeSkillBars();
    addMobileSupport();
});

// Initialize the portfolio functionality
function initializePortfolio() {
    // Add golden glow animation to buttons
    addGoldenGlow();
    
    // Initialize hover effects for cards
    initializeCardHoverEffects();
    
    // Initialize floating animation
    startFloatingAnimation();
    
    // Initialize contact item animations
    initializeContactAnimations();
}

// Main function to navigate to portfolio
function enterPortfolio() {
    const landingCard = document.getElementById('landingCard');
    const portfolioGrid = document.getElementById('portfolioGrid');
    
    if (!landingCard || !portfolioGrid) return;
    
    // Hide landing card with swing out animation
    landingCard.style.transition = 'all 1s cubic-bezier(0.68, -0.55, 0.265, 1.55)';
    landingCard.style.transform = 'translateX(100vw) rotate(15deg)';
    landingCard.style.opacity = '0';
    
    // Show portfolio after animation completes
    setTimeout(() => {
        landingCard.style.display = 'none';
        portfolioGrid.style.display = 'block';
        
        // Trigger portfolio cards swing animation
        animatePortfolioCards();
    }, 1000);
}

// Function to go back to landing page
function backToLanding() {
    const landingCard = document.getElementById('landingCard');
    const portfolioGrid = document.getElementById('portfolioGrid');
    
    if (!landingCard || !portfolioGrid) return;
    
    // Hide portfolio grid
    portfolioGrid.style.display = 'none';
    
    // Show and animate landing card back
    landingCard.style.display = 'block';
    landingCard.style.transform = 'translateX(-100vw) rotate(-15deg)';
    landingCard.style.opacity = '0';
    
    // Animate back to center
    setTimeout(() => {
        landingCard.style.transition = 'all 1.5s cubic-bezier(0.25, 0.46, 0.45, 0.94)';
        landingCard.style.transform = 'translateX(0) rotate(0deg)';
        landingCard.style.opacity = '1';
    }, 100);
}

// Animate portfolio cards with swinging effect
function animatePortfolioCards() {
    const portfolioCards = document.querySelectorAll('.portfolio-card');
    
    portfolioCards.forEach((card, index) => {
        // Reset card position
        card.style.opacity = '0';
        card.style.transform = 'translateX(-100vw) rotate(-15deg)';
        
        // Animate each card with staggered delay
        setTimeout(() => {
            card.style.transition = 'all 1.5s cubic-bezier(0.25, 0.46, 0.45, 0.94)';
            card.style.opacity = '1';
            
            // Create swinging motion: left to right to center
            setTimeout(() => {
                card.style.transform = 'translateX(15px) rotate(5deg)';
            }, 50);
            
            setTimeout(() => {
                card.style.transform = 'translateX(-8px) rotate(-2deg)';
            }, 400);
            
            setTimeout(() => {
                card.style.transform = 'translateX(0) rotate(0deg)';
            }, 800);
            
        }, index * 300 + 200);
    });
}

// Initialize skill bar animations
function initializeSkillBars() {
    const skillProgressBars = document.querySelectorAll('.skill-progress');
    
    // Set up intersection observer for skill bars
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const skillBar = entry.target;
                const targetWidth = skillBar.getAttribute('data-width');
                
                if (targetWidth) {
                    // Animate skill bar
                    setTimeout(() => {
                        skillBar.style.width = targetWidth + '%';
                    }, 500);
                }
                
                // Stop observing after animation
                observer.unobserve(skillBar);
            }
        });
    }, {
        threshold: 0.3
    });
    
    // Observe all skill bars
    skillProgressBars.forEach(bar => {
        observer.observe(bar);
    });
}

// Add golden glow effect to buttons
function addGoldenGlow() {
    const buttons = document.querySelectorAll('.enter-btn, .back-btn, .contact-btn');
    
    buttons.forEach(button => {
        button.addEventListener('mouseenter', () => {
            button.style.boxShadow = '0 12px 24px rgba(58, 38, 25, 0.3), 0 0 30px rgba(212, 175, 55, 0.5)';
        });
        
        button.addEventListener('mouseleave', () => {
            button.style.boxShadow = '0 8px 16px rgba(58, 38, 25, 0.2)';
        });
    });
}

// Initialize card hover effects
function initializeCardHoverEffects() {
    const projectItems = document.querySelectorAll('.project-item');
    
    projectItems.forEach(item => {
        item.addEventListener('mouseenter', () => {
            item.style.transform = 'translateY(-5px) scale(1.02)';
            item.style.boxShadow = '0 15px 30px rgba(58, 38, 25, 0.3)';
        });
        
        item.addEventListener('mouseleave', () => {
            item.style.transform = 'translateY(0) scale(1)';
            item.style.boxShadow = 'none';
        });
    });
}

// Start floating animation for cards
function startFloatingAnimation() {
    const cards = document.querySelectorAll('.royal-card');
    
    cards.forEach((card, index) => {
        // Add different animation delays for variety
        const delay = index * 0.5;
        card.style.animationDelay = delay + 's';
        
        // Ensure the floating animation continues
        card.addEventListener('animationend', () => {
            card.style.animation = `gentle-float 3s ease-in-out infinite ${delay}s`;
        });
    });
}

// Initialize contact item animations
function initializeContactAnimations() {
    const contactItems = document.querySelectorAll('.contact-item');
    
    contactItems.forEach((item, index) => {
        // Animate contact items on scroll
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    setTimeout(() => {
                        entry.target.style.opacity = '1';
                        entry.target.style.transform = 'translateX(0)';
                    }, index * 100);
                    
                    observer.unobserve(entry.target);
                }
            });
        });
        
        // Initial state
        item.style.opacity = '0';
        item.style.transform = 'translateX(-20px)';
        item.style.transition = 'all 0.5s ease-out';
        
        observer.observe(item);
        
        // Add hover effect for contact icons
        const icon = item.querySelector('.contact-icon');
        if (icon) {
            item.addEventListener('mouseenter', () => {
                icon.style.transform = 'scale(1.1) rotate(5deg)';
                icon.style.boxShadow = '0 6px 15px rgba(212, 175, 55, 0.4)';
            });
            
            item.addEventListener('mouseleave', () => {
                icon.style.transform = 'scale(1) rotate(0deg)';
                icon.style.boxShadow = 'none';
            });
        }
    });
}

// Add mobile support
function addMobileSupport() {
    // Touch events for mobile devices
    document.addEventListener('touchstart', handleTouchStart, { passive: true });
    document.addEventListener('touchend', handleTouchEnd, { passive: true });
    
    // Handle orientation changes
    window.addEventListener('orientationchange', handleOrientationChange);
    window.addEventListener('resize', handleResize);
}

// Handle touch start for mobile
function handleTouchStart(e) {
    const touch = e.touches[0];
    const element = document.elementFromPoint(touch.clientX, touch.clientY);
    
    if (element && element.classList.contains('project-item')) {
        element.style.transform = 'translateY(-3px) scale(1.02)';
        element.style.boxShadow = '0 8px 16px rgba(58, 38, 25, 0.2)';
    }
}

// Handle touch end for mobile
function handleTouchEnd(e) {
    const projectItems = document.querySelectorAll('.project-item');
    projectItems.forEach(item => {
        item.style.transform = 'translateY(0) scale(1)';
        item.style.boxShadow = 'none';
    });
}

// Handle orientation change
function handleOrientationChange() {
    setTimeout(() => {
        // Recalculate positions after orientation change
        const cards = document.querySelectorAll('.royal-card');
        cards.forEach(card => {
            card.style.transform = 'translateX(0) rotate(0deg)';
        });
    }, 500);
}

// Handle window resize
function handleResize() {
    const isMobile = window.innerWidth <= 768;
    const cards = document.querySelectorAll('.royal-card');
    
    cards.forEach(card => {
        if (isMobile) {
            card.style.maxWidth = '350px';
        } else {
            card.style.maxWidth = '400px';
        }
    });
}

// Add keyboard navigation support
document.addEventListener('keydown', function(e) {
    if (e.key === 'Enter' || e.key === ' ') {
        const focusedElement = document.activeElement;
        
        if (focusedElement.classList.contains('enter-btn')) {
            e.preventDefault();
            enterPortfolio();
        } else if (focusedElement.classList.contains('back-btn')) {
            e.preventDefault();
            backToLanding();
        }
    }
    
    // Arrow key navigation for portfolio cards
    if (e.key === 'ArrowRight' || e.key === 'ArrowLeft') {
        const portfolioCards = document.querySelectorAll('.portfolio-card');
        const currentIndex = Array.from(portfolioCards).findIndex(card => 
            card.contains(document.activeElement)
        );
        
        if (currentIndex !== -1) {
            let nextIndex;
            if (e.key === 'ArrowRight') {
                nextIndex = (currentIndex + 1) % portfolioCards.length;
            } else {
                nextIndex = (currentIndex - 1 + portfolioCards.length) % portfolioCards.length;
            }
            
            portfolioCards[nextIndex].focus();
        }
    }
});

// Add sparkle effect function
function addSparkleEffect(element) {
    const sparkle = document.createElement('div');
    sparkle.style.position = 'absolute';
    sparkle.style.width = '4px';
    sparkle.style.height = '4px';
    sparkle.style.background = 'var(--antique-gold)';
    sparkle.style.borderRadius = '50%';
    sparkle.style.pointerEvents = 'none';
    sparkle.style.opacity = '0';
    sparkle.style.zIndex = '1000';
    
    const rect = element.getBoundingClientRect();
    sparkle.style.left = (Math.random() * rect.width) + 'px';
    sparkle.style.top = (Math.random() * rect.height) + 'px';
    
    element.appendChild(sparkle);
    
    // Animate sparkle
    sparkle.animate([
        { opacity: 0, transform: 'scale(0) rotate(0deg)' },
        { opacity: 1, transform: 'scale(1) rotate(180deg)' },
        { opacity: 0, transform: 'scale(0) rotate(360deg)' }
    ], {
        duration: 1000,
        easing: 'ease-out'
    }).onfinish = () => sparkle.remove();
}

// Add sparkle effect to buttons on hover
document.addEventListener('DOMContentLoaded', function() {
    const buttons = document.querySelectorAll('.enter-btn, .back-btn, .contact-btn');
    
    buttons.forEach(button => {
        let sparkleInterval;
        
        button.addEventListener('mouseenter', () => {
            sparkleInterval = setInterval(() => {
                addSparkleEffect(button);
            }, 300);
        });
        
        button.addEventListener('mouseleave', () => {
            clearInterval(sparkleInterval);
        });
    });
});

// Smooth page loading effect
window.addEventListener('load', function() {
    document.body.style.opacity = '0';
    document.body.style.transition = 'opacity 0.5s ease-in-out';
    
    setTimeout(() => {
        document.body.style.opacity = '1';
    }, 100);
});

// Add scroll-triggered animations
window.addEventListener('scroll', function() {
    const scrolled = window.pageYOffset;
    const ornateElements = document.querySelectorAll('.ornate-border');
    
    // Subtle parallax effect
    ornateElements.forEach(element => {
        element.style.transform = `translateY(${scrolled * 0.1}px)`;
    });
});

// Performance optimization: Throttle scroll events
function throttle(func, limit) {
    let inThrottle;
    return function() {
        const args = arguments;
        const context = this;
        if (!inThrottle) {
            func.apply(context, args);
            inThrottle = true;
            setTimeout(() => inThrottle = false, limit);
        }
    }
}

// Apply throttling to scroll events
window.addEventListener('scroll', throttle(function() {
    // Scroll-based animations here
}, 50));