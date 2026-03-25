import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

document.addEventListener('DOMContentLoaded', () => {
    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');

    document.querySelectorAll('[data-ajax-delete]').forEach((button) => {
        button.addEventListener('click', async () => {
            if (!confirm(button.dataset.confirm || 'Delete this item?')) {
                return;
            }

            const response = await fetch(button.dataset.url, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': csrfToken,
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json',
                },
            });

            if (response.ok) {
                button.closest('[data-row]')?.remove();
            }
        });
    });

    document.querySelectorAll('[data-status-form]').forEach((form) => {
        form.addEventListener('change', async () => {
            const formData = new FormData(form);
            formData.append('_method', 'PUT');

            await fetch(form.action, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': csrfToken,
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json',
                },
                body: formData,
            });
        });
    });

    const contactForm = document.querySelector('[data-ajax-contact]');
    if (contactForm) {
        contactForm.addEventListener('submit', async (event) => {
            event.preventDefault();
            const notice = document.querySelector('[data-contact-notice]');
            const formData = new FormData(contactForm);

            const response = await fetch(contactForm.action, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': csrfToken,
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json',
                },
                body: formData,
            });

            const data = await response.json();
            notice.textContent = data.message;
            notice.classList.remove('hidden');

            if (response.ok) {
                contactForm.reset();
            }
        });
    }

    document.querySelectorAll('[data-instant-search]').forEach((input) => {
        input.addEventListener('input', () => {
            const target = document.querySelector(input.dataset.target);
            const term = input.value.toLowerCase();

            target?.querySelectorAll('[data-search-text]').forEach((row) => {
                row.classList.toggle('hidden', !row.dataset.searchText.toLowerCase().includes(term));
            });
        });
    });

    document.querySelectorAll('[data-load-sessions]').forEach((button) => {
        button.addEventListener('click', async () => {
            const container = document.querySelector(button.dataset.target);
            const response = await fetch(button.dataset.url, {
                headers: {
                    'Accept': 'application/json',
                },
            });
            const data = await response.json();

            container.innerHTML = data.sessions.map((session) => `
                <div class="rounded-2xl border border-slate-200 bg-white p-4 shadow-sm">
                    <p class="font-semibold text-slate-900">${session.starts_at}</p>
                    <p class="text-sm text-slate-600">${session.mode} ${session.city ? '• ' + session.city : ''}</p>
                    <p class="text-sm text-slate-600">${session.trainer ?? ''}</p>
                    <p class="mt-2 text-xs uppercase tracking-[0.2em] text-slate-500">${session.remaining_seats} seats left</p>
                </div>
            `).join('');
        });
    });
});
