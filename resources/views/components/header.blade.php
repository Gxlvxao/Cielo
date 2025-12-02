<header id="header" class="fixed top-0 left-0 right-0 z-50 transition-all duration-300 bg-transparent">
    <div class="container mx-auto px-4 py-4">
        <div class="flex items-center justify-between">
            <div class="font-heading text-2xl font-bold tracking-tight">
                <a href="{{ route('home') }}">
                    <span class="text-foreground">CROW</span>
                    <span class="text-accent"> GLOBAL</span>
                </a>
            </div>

            <nav class="hidden md:flex items-center gap-8">
                <a href="#municipalities" class="text-sm font-medium text-foreground/80 hover:text-accent transition-colors">
                    Municipalities
                </a>
                <a href="#services" class="text-sm font-medium text-foreground/80 hover:text-accent transition-colors">
                    Services
                </a>
                <a href="#contact" class="text-sm font-medium text-foreground/80 hover:text-accent transition-colors">
                    Contact
                </a>
                @auth
                    <a href="{{ route('dashboard') }}" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-accent hover:bg-accent/90 transition-colors">
                        Dashboard
                    </a>
                @else
                    <a href="{{ route('login') }}" class="inline-flex items-center px-4 py-2 border border-border text-sm font-medium rounded-md text-foreground bg-transparent hover:bg-accent/10 transition-colors">
                        Login
                    </a>
                @endauth
            </nav>
        </div>
    </div>
</header>

<script>
    window.addEventListener('scroll', function() {
        const header = document.getElementById('header');
        if (window.scrollY > 50) {
            header.classList.add('bg-background/95', 'backdrop-blur-md', 'border-b', 'border-border');
            header.classList.remove('bg-transparent');
        } else {
            header.classList.remove('bg-background/95', 'backdrop-blur-md', 'border-b', 'border-border');
            header.classList.add('bg-transparent');
        }
    });

    // Smooth scroll para seções
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({ behavior: 'smooth' });
            }
        });
    });
</script>
