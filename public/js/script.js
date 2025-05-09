

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

function toggleTestimoni(button) {
    const card = button.closest('.testimoni-card');
    const text = card.querySelector('.testimoni-text');

    text.classList.toggle('expanded');

    if (text.classList.contains('expanded')) {
        button.textContent = 'Sembunyikan';
        card.style.height = 'auto';
    } else {
        button.textContent = 'Lihat Selengkapnya';
        card.style.height = '230px';
    }
}

