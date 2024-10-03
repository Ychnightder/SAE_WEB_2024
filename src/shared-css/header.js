const hamburger = document.querySelector('.hamburger');
const navLinks = document.querySelector('.nav-links');
const ctaBtn = document.querySelector('.cta-buttons');
const navButtons = document.querySelectorAll('.nav-button.with-submenu');
hamburger.addEventListener('click', () => {
	navLinks.classList.toggle('active');
	ctaBtn.classList.toggle('active');
});

navButtons.forEach((button) => {
	button.addEventListener('click', () => {
		navButtons.forEach((btn) => {
           
			if (btn !== button) {
				btn.classList.remove('active');
				const submenu = btn.querySelector('.submenu');
				// if (submenu) {
				// 	submenu.style.opacity = '0'; // Masquer le sous-menu
				// 	submenu.style.pointerEvents = 'none'; // Désactiver les événements de pointeur
				// }
			}
		});


        button.classList.toggle('active');
        const submenu = button.querySelector('.submenu');
        if (button.classList.contains('active')) {
            submenu.style.opacity = '1'; // Afficher le sous-menu
            submenu.style.pointerEvents = 'auto'; // Activer les événements de pointeur
        } else {
            submenu.style.opacity = '0'; // Masquer le sous-menu
            submenu.style.pointerEvents = 'none'; // Désactiver les événements de pointeur
        }
	});
});
