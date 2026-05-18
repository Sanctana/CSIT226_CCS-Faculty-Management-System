(function () {
    var form = document.querySelector('form');
    if (!form) return;
    var confirmedOnce = false;
    var overlay = document.getElementById('confirmOverlay');
    var list = document.getElementById('confirmList');
    var cancelBtn = document.getElementById('confirmCancel');
    var okBtn = document.getElementById('confirmOk');
    var lastActive = null;

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

    var setListItem = function (label, value) {
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

    form.addEventListener('submit', function (e) {
        if (confirmedOnce) return;
        e.preventDefault();

        var getByName = function (name) {
            var el = form.querySelector('[name="' + name + '"]');
            return el ? el.value.trim() : '';
        };

        var getById = function (id) {
            var el = document.getElementById(id);
            return el ? el.value.trim() : '';
        };

        list.innerHTML = '';
        setListItem('Course', getById('summaryCourse'));
        setListItem('Faculty', getById('summaryFaculty'));
        setListItem('Section', getById('summarySection'));
        setListItem('School Year', getById('summarySchoolYear'));
        setListItem('Day', getByName('dayofweek'));
        setListItem('Start Time', getByName('starttime'));
        setListItem('End Time', getByName('endtime'));
        setListItem('Room Type', getByName('roomtype'));
        setListItem('Building', getByName('building'));
        setListItem('Room Number', getByName('roomnumber'));
        showModal();
    });

    cancelBtn.addEventListener('click', function () {
        hideModal();
    });

    okBtn.addEventListener('click', function () {
        confirmedOnce = true;
        hideModal();
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