document.addEventListener('DOMContentLoaded', () => {
    const input = document.getElementById('course-search');
    const tbody = document.getElementById('course-table-body');
    const modal = document.getElementById('delete-course-modal');
    const confirmBtn = modal ? modal.querySelector('[data-modal-confirm]') : null;
    const cancelBtn = modal ? modal.querySelector('[data-modal-cancel]') : null;
    let timer = null;

    const openModal = (deleteUrl) => {
        if (!modal || !confirmBtn) return;
        confirmBtn.setAttribute('href', deleteUrl);
        modal.hidden = false;
        requestAnimationFrame(() => {
            modal.classList.add('is-visible');
            modal.setAttribute('aria-hidden', 'false');
        });
    };

    const closeModal = () => {
        if (!modal || !confirmBtn) return;
        modal.classList.remove('is-visible');
        modal.setAttribute('aria-hidden', 'true');
        confirmBtn.setAttribute('href', '#');
        modal.addEventListener('transitionend', () => {
            modal.hidden = true;
        }, { once: true });
    };

    async function doSearch(q) {
        try {
            const res = await fetch(`api/search_course.php?q=${encodeURIComponent(q)}`);
            if (!res.ok) throw new Error('Network error');
            tbody.innerHTML = await res.text();
        } catch (err) {
            console.error(err);
        }
    }

    if (input) {
        input.addEventListener('input', (e) => {
            const q = e.target.value.trim();
            clearTimeout(timer);
            timer = setTimeout(() => doSearch(q), 300); // 300ms debounce
        });
    }

    if (tbody && modal && confirmBtn && cancelBtn) {
        tbody.addEventListener('click', (event) => {
            const link = event.target.closest('.js-delete-course');
            if (!link) {
                return;
            }
            event.preventDefault();
            const deleteUrl = link.getAttribute('data-delete-url') || link.getAttribute('href');
            if (!deleteUrl) {
                return;
            }
            openModal(deleteUrl);
        });

        cancelBtn.addEventListener('click', closeModal);
        modal.addEventListener('click', (event) => {
            if (event.target === modal) {
                closeModal();
            }
        });

        document.addEventListener('keydown', (event) => {
            if (event.key === 'Escape' && modal.classList.contains('is-visible')) {
                closeModal();
            }
        });
    }
});