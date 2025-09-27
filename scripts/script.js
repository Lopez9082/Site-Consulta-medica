
    // Script para o Menu Hamburger
    document.addEventListener('DOMContentLoaded', function() {
        const hamburgerBtn = document.querySelector('.hamburger-btn');
        const menuContainer = document.querySelector('.menu-container');
        const navLinks = document.querySelector('.nav-links');
        const menuLinks = document.querySelectorAll('.nav-links a');

        // Função para abrir/fechar menu
        function toggleMenu() {
            const isActive = menuContainer.classList.contains('active');
            
            if (isActive) {
                // Fechar menu
                menuContainer.classList.remove('active');
                navLinks.classList.remove('active');
                hamburgerBtn.classList.remove('active');
                hamburgerBtn.setAttribute('aria-expanded', 'false');
                hamburgerBtn.setAttribute('aria-label', 'Abrir menu de navegação');
            } else {
                // Abrir menu
                menuContainer.classList.add('active');
                navLinks.classList.add('active');
                hamburgerBtn.classList.add('active');
                hamburgerBtn.setAttribute('aria-expanded', 'true');
                hamburgerBtn.setAttribute('aria-label', 'Fechar menu de navegação');
                
                // Foco no primeiro link para acessibilidade
                if (window.innerWidth <= 768) {
                    menuLinks[0].focus();
                }
            }
        }

        // Event listener para o botão hamburger
        hamburgerBtn.addEventListener('click', toggleMenu);

        // Fechar menu ao clicar em um link
        menuLinks.forEach(link => {
            link.addEventListener('click', function() {
                toggleMenu(); // Fecha o menu após clique
                // Scroll suave para a seção (já no CSS com scroll-behavior: smooth)
            });
        });

        // Fechar menu ao clicar fora (apenas mobile)
        if (window.innerWidth <= 768) {
            menuContainer.addEventListener('click', function(e) {
                if (e.target === menuContainer || e.target === this.querySelector('::before')) {
                    toggleMenu();
                }
            });
        }

        // Fechar menu ao redimensionar para desktop (opcional, para limpar estado)
        window.addEventListener('resize', function() {
            if (window.innerWidth > 768 && menuContainer.classList.contains('active')) {
                toggleMenu();
            }
        });
    });