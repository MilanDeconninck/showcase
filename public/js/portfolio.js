const cards = document.querySelectorAll('.card');

cards.forEach(card => {
    const btn = card.querySelector('.toggle-btn');
    const content = card.querySelector('.card-content');
    const icon = card.querySelector('.arrow-icon');

    if (!btn || !content || !icon) return;

    btn.addEventListener('click', function(e) {
        e.preventDefault();
        e.stopPropagation();

        content.classList.toggle('hidden');
        icon.classList.toggle('rotate-180');
    });
});