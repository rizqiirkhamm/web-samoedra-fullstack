const mobileMenuTrigger = document.getElementById('mobile-menu-trigger');
const menuButton = document.getElementById('menu-button');
const mobileMenu = document.getElementById('mobile-menu');
const hamburgerIcon = document.getElementById('hamburger-icon');
const closeIcon = document.getElementById('close-icon');

// Trigger untuk membuka menu
mobileMenuTrigger.addEventListener('click', () => {
    mobileMenu.classList.remove('-translate-x-full');
    hamburgerIcon.classList.add('hidden');
    closeIcon.classList.remove('hidden');
});

// Trigger untuk menutup menu
menuButton.addEventListener('click', () => {
    mobileMenu.classList.add('-translate-x-full');
    hamburgerIcon.classList.remove('hidden');
    closeIcon.classList.add('hidden');
});

// Menutup menu saat link diklik
mobileMenu.querySelectorAll('a').forEach(link => {
    link.addEventListener('click', () => {
        mobileMenu.classList.add('-translate-x-full');
        hamburgerIcon.classList.remove('hidden');
        closeIcon.classList.add('hidden');
    });
});

// Mobile dropdown functionality
const mobileDropdownTrigger = document.getElementById('mobile-dropdown-trigger');
const mobileDropdownContent = document.getElementById('mobile-dropdown-content');
const dropdownArrow = mobileDropdownTrigger.querySelector('svg');

mobileDropdownTrigger.addEventListener('click', () => {
    mobileDropdownContent.classList.toggle('hidden');
    dropdownArrow.classList.toggle('rotate-180');
});

// Menutup dropdown saat link di dalamnya diklik
mobileDropdownContent.querySelectorAll('a').forEach(link => {
    link.addEventListener('click', () => {
        mobileDropdownContent.classList.add('hidden');
        dropdownArrow.classList.remove('rotate-180');
        // Menutup mobile menu juga
        mobileMenu.classList.add('-translate-x-full');
        hamburgerIcon.classList.remove('hidden');
        closeIcon.classList.add('hidden');
    });
});

function toggleFAQ(index) {
    const faqItems = document.querySelectorAll(".faq-item");

    faqItems.forEach((item, i) => {
        const desc = document.getElementById(`desc-${i + 1}`);
        const icon = document.getElementById(`icon-${i + 1}`);

        if (i + 1 === index) {
            const isHidden = desc.classList.contains("hidden");

            if (isHidden) {
                desc.classList.remove("hidden");
                desc.style.maxHeight = desc.scrollHeight + "px";
            } else {
                desc.style.maxHeight = "0px";
                setTimeout(() => desc.classList.add("hidden"), 300);
            }

            icon.classList.toggle("rotate-180", isHidden);
        } else {
            desc.style.maxHeight = "0px";
            setTimeout(() => desc.classList.add("hidden"), 300);
            icon.classList.remove("rotate-180");
        }
    });
}

