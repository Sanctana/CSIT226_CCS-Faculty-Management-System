document.addEventListener('DOMContentLoaded', function () {
    const yearSelect = document.querySelector('select[name="year_level"]');
    const sectionSelect = document.querySelector('select[name="section"]');
    const courseSelect = document.querySelector('select[name="course_code"]');
    const schedulesContainer = document.getElementById('schedules_container');
    const addScheduleBtn = document.getElementById('add_schedule_btn');

    function setLoading(select) {
        select.innerHTML = '<option value="">Loading...</option>';
    }

    function clearSelect(select, placeholder) {
        select.innerHTML = '<option value="">' + placeholder + '</option>';
    }

    async function fetchSections(year) {
        const res = await fetch('api/get_sections_by_year.php?year=' + encodeURIComponent(year));
        if (!res.ok) return [];
        return res.json();
    }
    async function fetchCourses(year) {
        const res = await fetch('api/get_courses_by_year.php?year=' + encodeURIComponent(year));
        if (!res.ok) return [];
        return res.json();
    }

    async function updateOptions(year) {
        if (!year) {
            clearSelect(sectionSelect, 'Select Section');
            clearSelect(courseSelect, 'Select Course');
            return;
        }
        setLoading(sectionSelect);
        setLoading(courseSelect);

        try {
            const [sections, courses] = await Promise.all([fetchSections(year), fetchCourses(year)]);

            sectionSelect.innerHTML = '<option value="">Select Section</option>';
            sections.forEach(s => {
                const opt = document.createElement('option');
                opt.value = s.id;
                opt.textContent = s.text;
                sectionSelect.appendChild(opt);
            });

            courseSelect.innerHTML = '<option value="">Select Course</option>';
            courses.forEach(c => {
                const opt = document.createElement('option');
                opt.value = c.id;
                opt.textContent = c.text;
                courseSelect.appendChild(opt);
            });
        } catch (err) {
            clearSelect(sectionSelect, 'Select Section');
            clearSelect(courseSelect, 'Select Course');
            console.error(err);
        }
    }

    yearSelect.addEventListener('change', function () {
        updateOptions(this.value);
    });

    if (yearSelect.value) {
        updateOptions(yearSelect.value);
    }

    function createScheduleRow() {
        const wrapper = document.createElement('div');
        wrapper.className = 'schedule-row';
        wrapper.style.display = 'flex';
        wrapper.style.gap = '8px';
        wrapper.style.flexWrap = 'wrap';
        wrapper.style.alignItems = 'center';
        wrapper.style.marginBottom = '8px';
        wrapper.innerHTML = `
                <select name="schedule_day[]" class="form-select" required>
                    <option value="">Day</option>
                    <option value="M">M</option>
                    <option value="T">T</option>
                    <option value="W">W</option>
                    <option value="TH">TH</option>
                    <option value="F">F</option>
                    <option value="SAT">SAT</option>
                    <option value="SUN">SUN</option>
                </select>
                <input type="time" name="schedule_start[]" class="form-input" required>
                <input type="time" name="schedule_end[]" class="form-input" required>
                <input type="text" name="schedule_roomtype[]" class="form-input" placeholder="Room Type">
                <input type="text" name="schedule_building[]" class="form-input" placeholder="Building">
                <input type="text" name="schedule_roomnumber[]" class="form-input" placeholder="Room #">
                <button type="button" class="btn-remove-schedule" style="background:#eee;border:1px solid #ccc;padding:6px 8px;border-radius:4px;">Remove</button>
            `;
        return wrapper;
    }

    addScheduleBtn.addEventListener('click', function () {
        schedulesContainer.appendChild(createScheduleRow());
    });

    schedulesContainer.addEventListener('click', function (e) {
        if (e.target && e.target.classList.contains('btn-remove-schedule')) {
            const row = e.target.closest('.schedule-row');
            if (row) row.remove();
        }
    });
});
(function () {
    var form = document.querySelector('form');
    if (!form) return;
    var confirmedOnce = false;
    var overlay = document.getElementById('confirmOverlay');
    var list = document.getElementById('confirmList');
    var cancelBtn = document.getElementById('confirmCancel');
    var okBtn = document.getElementById('confirmOk');
    var lastActive = null;
    var submitBtn = form.querySelector('input[name="btnAssign"]');

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
        if (el.tagName === 'SELECT') {
            var opt = el.options[el.selectedIndex];
            return opt ? opt.textContent.trim() : '';
        }
        return el.value.trim();
    };

    var getRowSelectText = function (row, selector) {
        var el = row.querySelector(selector);
        if (!el) return '';
        var opt = el.options[el.selectedIndex];
        return opt ? opt.textContent.trim() : '';
    };

    var buildSchedulesSummary = function () {
        var rows = form.querySelectorAll('#schedules_container .schedule-row');
        var summaries = [];
        rows.forEach(function (row, index) {
            var day = getRowSelectText(row, 'select[name="schedule_day[]"]');
            var start = row.querySelector('input[name="schedule_start[]"]')?.value || '';
            var end = row.querySelector('input[name="schedule_end[]"]')?.value || '';
            var roomType = row.querySelector('input[name="schedule_roomtype[]"]')?.value || '';
            var building = row.querySelector('input[name="schedule_building[]"]')?.value || '';
            var roomNumber = row.querySelector('input[name="schedule_roomnumber[]"]')?.value || '';

            if (!day || !start || !end) {
                return;
            }

            var roomParts = [];
            if (roomType) roomParts.push(roomType);
            if (building) roomParts.push(building);
            if (roomNumber) roomParts.push(roomNumber);
            var roomText = roomParts.length ? ' | ' + roomParts.join(' ') : '';
            summaries.push('Schedule ' + (index + 1) + ': ' + day + ' ' + start + '-' + end + roomText);
        });
        return summaries;
    };

    form.addEventListener('submit', function (e) {
        if (confirmedOnce) return;
        if (!form.checkValidity()) {
            form.reportValidity();
            return;
        }
        e.preventDefault();
        list.innerHTML = '';

        addItem('Teacher', getText('select[name="teacher"]'));
        addItem('Year Level', getText('select[name="year_level"]'));
        addItem('Section', getText('select[name="section"]'));
        addItem('Course Code', getText('select[name="course_code"]'));

        var schedules = buildSchedulesSummary();
        if (schedules.length === 0) {
            addItem('Schedules', '-');
        } else {
            addItem('Schedules', schedules.join('\n'));
            var scheduleValue = list.lastChild.querySelector('.confirm-value');
            scheduleValue.style.whiteSpace = 'pre-line';
        }

        showModal();
    });

    cancelBtn.addEventListener('click', function () {
        hideModal();
    });

    okBtn.addEventListener('click', function () {
        confirmedOnce = true;
        hideModal();
        if (submitBtn && typeof form.requestSubmit === 'function') {
            form.requestSubmit(submitBtn);
            return;
        }
        if (submitBtn) {
            var hiddenAssign = form.querySelector('input[name="btnAssign"][type="hidden"]');
            if (!hiddenAssign) {
                hiddenAssign = document.createElement('input');
                hiddenAssign.type = 'hidden';
                hiddenAssign.name = 'btnAssign';
                hiddenAssign.value = submitBtn.value || 'Assign Workload';
                form.appendChild(hiddenAssign);
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