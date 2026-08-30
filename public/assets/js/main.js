// BluMiga Documentation JS
document.addEventListener('DOMContentLoaded', function() {
    // Mobile menu toggle
    var hamburger = document.querySelector('.hamburger');
    var sidebar = document.querySelector('.sidebar');
    var overlay = document.querySelector('.sidebar-overlay');

    if (hamburger && sidebar) {
        hamburger.addEventListener('click', function() {
            sidebar.classList.toggle('open');
            if (overlay) overlay.classList.toggle('active');
        });

        if (overlay) {
            overlay.addEventListener('click', function() {
                sidebar.classList.remove('open');
                overlay.classList.remove('active');
            });
        }
    }

    // Smooth scroll para âncoras
    document.querySelectorAll('a[href^="#"]').forEach(function(anchor) {
        anchor.addEventListener('click', function(e) {
            e.preventDefault();
            var target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({ behavior: 'smooth', block: 'start' });
            }
        });
    });

    // Copiar código ao clicar em blocos de código
    document.querySelectorAll('.code-block').forEach(function(block) {
        block.style.cursor = 'pointer';
        block.title = 'Clique para copiar';

        block.addEventListener('click', function() {
            var code = this.querySelector('code') || this;
            var text = code.textContent;

            navigator.clipboard.writeText(text).then(function() {
                var original = block.style.outline;
                block.style.outline = '2px solid #10b981';
                setTimeout(function() {
                    block.style.outline = original || 'none';
                }, 1000);
            });
        });
    });

    // Animação de fade-in ao scrollar
    var observerOptions = { threshold: 0.1, rootMargin: '0px 0px -50px 0px' };
    var observer = new IntersectionObserver(function(entries) {
        entries.forEach(function(entry) {
            if (entry.isIntersecting) {
                entry.target.classList.add('fade-in');
                observer.unobserve(entry.target);
            }
        });
    }, observerOptions);

    document.querySelectorAll('.card, .code-block').forEach(function(el) {
        observer.observe(el);
    });
});
