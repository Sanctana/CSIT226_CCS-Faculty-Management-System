(function () {
    var form = document.querySelector('form');
    if (!form) return;

    var confirmedOnce = false;
    var overlay = document.getElementById('confirmOverlay');
    var list = document.getElementById('confirmList');
    var cancelBtn = document.getElementById('confirmCancel');
    var okBtn = document.getElementById('confirmOk');
    var titleEl = document.getElementById('confirmTitle');
    var lastActive = null;
    var submitBtn = form.querySelector('input[name="btnRegister"]');

    if (!overlay || !list || !cancelBtn || !okBtn) return;

    var showModal = function () {
        overlay.classList.add('is-open');
        overlay.setAttribute('aria-hidden', 'false');
        lastActive = document.activeElement;
        okBtn.focus();
    };

    var hideModal = function () {
        overlay.classList.remove('is-open');
        overlay.setAttribute('aria-hidden', 'true');
        if (lastActive && typeof lastActive.focus === 'function') {
            lastActive.focus();
        }
    };

    var addItem = function (label, value) {
        var item = document.createElement('li');
        item.className = 'confirm-item';
        var labelSpan = document.createElement('span');
        labelSpan.className = 'confirm-label';
        labelSpan.textContent = label;
        var valueSpan = document.createElement('span');
        valueSpan.className = 'confirm-value';
        valueSpan.textContent = value || '-';
        item.appendChild(labelSpan);
        item.appendChild(valueSpan);
        list.appendChild(item);
    };

    var getText = function (selector) {
        var el = form.querySelector(selector);
        if (!el) return '';
        return el.value.trim();
    };

    var isUpdateMode = function () {
        var typeInput = form.querySelector('input[name="form_type"]');
        return typeInput && typeInput.value === 'course_update';
    };

    var syncModalLabels = function () {
        var updateMode = isUpdateMode();
        if (titleEl) {
            titleEl.textContent = updateMode ? 'Confirm Course Update' : 'Confirm Course Registration';
        }
        if (okBtn) {
            okBtn.textContent = updateMode ? 'Update' : 'Confirm';
        }
    };

    form.addEventListener('submit', function (e) {
        if (confirmedOnce) return;
        if (!form.checkValidity()) {
            form.reportValidity();
            return;
        }
        e.preventDefault();
        list.innerHTML = '';

        var updateMode = isUpdateMode();
        addItem('Action', updateMode ? 'Update Course' : 'Register Course');

        addItem('Course Code', getText('input[name="coursecode"]'));
        addItem('Course Title', getText('input[name="coursetitle"]'));
        addItem('Units', getText('input[name="units"]'));
        addItem('Year Level', getText('input[name="yearlevel"]'));

        syncModalLabels();
        showModal();
    });

    cancelBtn.addEventListener('click', function () {
        hideModal();
    });

    okBtn.addEventListener('click', function () {
        confirmedOnce = true;
        hideModal();
        if (submitBtn) {
            var hiddenRegister = form.querySelector('input[name="btnRegister"][type="hidden"]');
            if (!hiddenRegister) {
                hiddenRegister = document.createElement('input');
                hiddenRegister.type = 'hidden';
                hiddenRegister.name = 'btnRegister';
                hiddenRegister.value = submitBtn.value || 'Register Course';
                form.appendChild(hiddenRegister);
            }
        }
        form.submit();
    });

    overlay.addEventListener('click', function (e) {
        if (e.target === overlay) {
            hideModal();
        }
    });

    document.addEventListener('keydown', function (e) {
        if (!overlay.classList.contains('is-open')) return;
        if (e.key === 'Escape') {
            hideModal();
        }
    });
})();
