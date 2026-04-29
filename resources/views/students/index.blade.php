<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Information System</title>
    <style>
        :root {
            --bg-main: #ecf8f0;
            --bg-accent: #d4f3df;
            --text-dark: #102a1d;
            --text-soft: #4b6355;
            --card: #ffffff;
            --line: #e2e8f0;
            --green-700: #146c43;
            --green-600: #1f8a57;
            --green-500: #2ba56a;
            --green-100: #e7f8ee;
            --danger: #be123c;
            --slate: #475569;
        }
        * { box-sizing: border-box; }
        body {
            margin: 0;
            min-height: 100vh;
            font-family: "Segoe UI", Tahoma, Arial, sans-serif;
            color: var(--text-dark);
            background:
                radial-gradient(circle at 10% 10%, #c7f1d8 0%, transparent 28%),
                radial-gradient(circle at 88% 18%, #d7f4e3 0%, transparent 30%),
                linear-gradient(160deg, var(--bg-main) 0%, #f8fffb 100%);
        }
        .page {
            max-width: 1180px;
            margin: 26px auto;
            padding: 0 14px;
            display: grid;
            grid-template-columns: 230px 1fr;
            gap: 16px;
        }
        .side-panel {
            background: linear-gradient(180deg, var(--green-700), var(--green-600));
            border-radius: 18px;
            color: #e8fff2;
            padding: 20px 16px;
            box-shadow: 0 12px 24px rgba(20, 108, 67, 0.25);
            display: flex;
            flex-direction: column;
            gap: 18px;
        }
        .brand {
            font-size: 18px;
            font-weight: 700;
            line-height: 1.3;
        }
        .side-note {
            font-size: 13px;
            color: #c8f4da;
            line-height: 1.5;
        }
        .side-chip {
            background: rgba(255, 255, 255, 0.14);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 12px;
            padding: 10px;
        }
        .side-chip-label {
            font-size: 11px;
            opacity: 0.9;
            margin-bottom: 3px;
        }
        .side-chip-value {
            font-size: 18px;
            font-weight: 700;
        }
        .main-panel {
            background: rgba(255, 255, 255, 0.88);
            border: 1px solid rgba(255, 255, 255, 0.7);
            border-radius: 18px;
            backdrop-filter: blur(3px);
            box-shadow: 0 14px 30px rgba(15, 23, 42, 0.08);
            padding: 18px;
        }
        .top-bar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 12px;
            margin-bottom: 14px;
            flex-wrap: wrap;
        }
        .title {
            margin: 0;
            font-size: 26px;
            color: var(--green-700);
        }
        .subtitle {
            margin: 4px 0 0;
            color: var(--text-soft);
            font-size: 13px;
        }
        .actions-row {
            display: flex;
            gap: 8px;
            align-items: center;
            flex-wrap: wrap;
        }
        .btn {
            border: none;
            border-radius: 10px;
            padding: 9px 13px;
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
            text-decoration: none;
            color: #fff;
            transition: transform 0.15s ease, opacity 0.15s ease;
        }
        .btn:hover { transform: translateY(-1px); }
        .btn-main { background: linear-gradient(135deg, var(--green-500), var(--green-600)); }
        .btn-export { background: linear-gradient(135deg, #0f766e, #0f8f79); }
        .btn-secondary { background: var(--slate); }
        .btn-edit { background: #166534; }
        .btn-delete { background: var(--danger); }
        .btn-theme { background: linear-gradient(135deg, #334155, #1e293b); }
        .alert {
            border-radius: 12px;
            padding: 11px 12px;
            margin-bottom: 10px;
            font-size: 13px;
        }
        .alert-success {
            background: #eafaf1;
            color: #0f5132;
            border: 1px solid #bde8cc;
        }
        .alert-error {
            background: #fff1f2;
            color: #9f1239;
            border: 1px solid #fecdd3;
        }
        .filter-wrap {
            border: 1px solid var(--line);
            background: #f9fdfb;
            border-radius: 14px;
            padding: 12px;
            margin-bottom: 12px;
        }
        .filter-form {
            display: grid;
            grid-template-columns: 1.3fr 1fr auto auto;
            gap: 8px;
            align-items: center;
        }
        .filter-form input,
        .filter-form select {
            width: 100%;
            border: 1px solid #cfd8e3;
            border-radius: 9px;
            padding: 9px 10px;
            font-size: 13px;
            background: #fff;
        }
        .helper {
            margin-top: 8px;
            font-size: 12px;
            color: var(--text-soft);
        }
        .stats {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 9px;
            margin-bottom: 12px;
        }
        .stat-card {
            background: var(--card);
            border: 1px solid var(--line);
            border-radius: 12px;
            padding: 11px 12px;
        }
        .stat-label {
            color: var(--text-soft);
            font-size: 11px;
            margin-bottom: 4px;
        }
        .stat-value {
            color: var(--green-700);
            font-size: 18px;
            font-weight: 700;
        }
        .table-wrap {
            border: 1px solid var(--line);
            border-radius: 14px;
            overflow: hidden;
            background: #fff;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        thead th {
            background: var(--green-100);
            padding: 12px 10px;
            text-align: left;
            font-size: 13px;
        }
        tbody td {
            padding: 11px 10px;
            border-top: 1px solid #edf2f7;
            font-size: 14px;
        }
        tbody tr:nth-child(even) { background: #fcfefd; }
        .sort-link {
            color: var(--green-700);
            text-decoration: none;
            font-weight: 700;
        }
        .sort-link:hover { text-decoration: underline; }
        .row-actions {
            display: flex;
            gap: 7px;
            align-items: center;
            white-space: nowrap;
        }
        .pagination {
            margin-top: 10px;
            display: flex;
            justify-content: space-between;
            gap: 10px;
            align-items: center;
            flex-wrap: wrap;
        }
        .page-text {
            font-size: 13px;
            color: var(--text-soft);
        }
        .empty {
            text-align: center;
            border: 1px dashed #cbd5e1;
            border-radius: 12px;
            background: #f8fafc;
            padding: 18px;
            color: #475569;
        }
        .modal-backdrop {
            position: fixed;
            inset: 0;
            background: rgba(2, 16, 10, 0.55);
            display: none;
            align-items: center;
            justify-content: center;
            padding: 16px;
            z-index: 999;
            opacity: 0;
            pointer-events: none;
            transition: opacity 0.2s ease;
        }
        .modal-backdrop.show {
            display: flex;
            opacity: 1;
            pointer-events: auto;
        }
        .modal-backdrop.closing {
            opacity: 0;
            pointer-events: none;
        }
        .modal {
            width: 100%;
            max-width: 500px;
            background: #fff;
            border-radius: 14px;
            padding: 18px;
            border: 1px solid #d8e0ea;
            box-shadow: 0 18px 40px rgba(0, 0, 0, 0.22);
            transform: translateY(10px) scale(0.98);
            transition: transform 0.2s ease;
        }
        .modal-backdrop.show .modal {
            transform: translateY(0) scale(1);
        }
        .modal h3 {
            margin: 0 0 14px;
            color: var(--green-700);
        }
        .modal label {
            display: block;
            margin-bottom: 6px;
            font-size: 13px;
            font-weight: 600;
        }
        .modal input {
            width: 100%;
            border: 1px solid #cfd8e3;
            border-radius: 9px;
            padding: 9px 10px;
            margin-bottom: 11px;
            font-size: 13px;
        }
        .modal-actions {
            display: flex;
            justify-content: flex-end;
            gap: 8px;
            margin-top: 6px;
        }
        body[data-theme="nocturne"] {
            --bg-main: #0f172a;
            --text-dark: #e5e7eb;
            --text-soft: #94a3b8;
            --card: #111827;
            --line: #334155;
            --green-700: #22c55e;
            --green-600: #16a34a;
            --green-500: #22c55e;
            --green-100: #133022;
            --slate: #64748b;
            background:
                radial-gradient(circle at 8% 10%, rgba(34, 197, 94, 0.18) 0%, transparent 30%),
                radial-gradient(circle at 92% 14%, rgba(20, 184, 166, 0.16) 0%, transparent 34%),
                linear-gradient(170deg, #020617 0%, #0f172a 100%);
        }
        body[data-theme="nocturne"] .main-panel {
            background: rgba(2, 6, 23, 0.72);
            border-color: rgba(51, 65, 85, 0.75);
        }
        body[data-theme="nocturne"] .filter-wrap,
        body[data-theme="nocturne"] .stat-card,
        body[data-theme="nocturne"] .table-wrap,
        body[data-theme="nocturne"] .empty,
        body[data-theme="nocturne"] .modal {
            background: #0b1220;
            border-color: #334155;
        }
        body[data-theme="nocturne"] .filter-form input,
        body[data-theme="nocturne"] .filter-form select,
        body[data-theme="nocturne"] .modal input {
            background: #0f172a;
            color: #e2e8f0;
            border-color: #475569;
        }
        body[data-theme="nocturne"] thead th {
            background: #132a1f;
            color: #d1fae5;
        }
        body[data-theme="nocturne"] tbody td {
            border-top-color: #27364b;
            color: #e2e8f0;
        }
        body[data-theme="nocturne"] tbody tr:nth-child(even) {
            background: #111f33;
        }
        body[data-theme="nocturne"] .title,
        body[data-theme="nocturne"] .sort-link,
        body[data-theme="nocturne"] .stat-value {
            color: #4ade80;
        }
        body[data-theme="nocturne"] .alert-success {
            background: #0f2a1b;
            border-color: #166534;
            color: #bbf7d0;
        }
        body[data-theme="nocturne"] .alert-error {
            background: #3f0a1d;
            border-color: #9f1239;
            color: #fecdd3;
        }
        @media (max-width: 980px) {
            .page { grid-template-columns: 1fr; }
            .side-panel { order: 2; }
            .filter-form { grid-template-columns: 1fr; }
            .stats { grid-template-columns: 1fr; }
        }
    </style>
</head>
<body data-has-errors="{{ $errors->any() ? '1' : '0' }}" data-theme="mint">
    @php($exportQuery = request()->except('page'))
    <div class="page">
        <aside class="side-panel">
            <div class="brand">SIS Command Center</div>
            <div class="side-note">
                Unique dashboard layout with smart filtering, modal editing, and one-click exports.
            </div>
            <div class="side-chip">
                <div class="side-chip-label">Total Students</div>
                <div class="side-chip-value">{{ $students->total() }}</div>
            </div>
            <div class="side-chip">
                <div class="side-chip-label">Page Status</div>
                <div class="side-chip-value">{{ $students->currentPage() }} / {{ $students->lastPage() }}</div>
            </div>
            <div class="side-chip">
                <div class="side-chip-label">Distinct Courses</div>
                <div class="side-chip-value">{{ $courses->count() }}</div>
            </div>
        </aside>

        <main class="main-panel">
            <div class="top-bar">
                <div>
                    <h1 class="title">Student Information System</h1>
                    <p class="subtitle">Modern record manager with CRUD, auto-search, export, and secure actions.</p>
                </div>
                <div class="actions-row">
                    <button id="themeToggleBtn" class="btn btn-theme" type="button">Switch Theme</button>
                    <a class="btn btn-export" href="{{ route('students.export.csv', $exportQuery) }}">Export CSV</a>
                    <a class="btn btn-export" href="{{ route('students.export.pdf', $exportQuery) }}">Export PDF</a>
                    <button class="btn btn-main" type="button" onclick="openStudentModal()">Add Student</button>
                </div>
            </div>

            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            @if($errors->any())
                <div class="alert alert-error">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <section class="filter-wrap">
                <form id="filterForm" method="GET" action="/students" class="filter-form">
                    <input id="searchInput" type="text" name="q" placeholder="Search first name, last name, or course..." value="{{ request('q') }}">
                    <select id="courseSelect" name="course">
                        <option value="">All Courses</option>
                        @foreach($courses as $course)
                            <option value="{{ $course }}" {{ request('course') === $course ? 'selected' : '' }}>
                                {{ $course }}
                            </option>
                        @endforeach
                    </select>
                    <button class="btn btn-main" type="submit">Filter</button>
                    <a class="btn btn-secondary" href="/students">Reset</a>
                </form>
                <div class="helper">Auto-search triggers for 2+ characters.</div>
            </section>

            <section class="stats">
                <div class="stat-card">
                    <div class="stat-label">Showing Records</div>
                    <div class="stat-value">{{ $students->count() }}</div>
                </div>
                <div class="stat-card">
                    <div class="stat-label">Current Page</div>
                    <div class="stat-value">{{ $students->currentPage() }}</div>
                </div>
                <div class="stat-card">
                    <div class="stat-label">Available Courses</div>
                    <div class="stat-value">{{ $courses->count() }}</div>
                </div>
            </section>

            @if($students->isEmpty())
                <div class="empty">No student records found. Add a new student to get started.</div>
            @else
                <section class="table-wrap">
                    <table>
                        <thead>
                            <tr>
                                <th>
                                    <a class="sort-link" href="{{ request()->fullUrlWithQuery(['sort' => 'first_name', 'direction' => request('sort') === 'first_name' && request('direction', 'desc') === 'asc' ? 'desc' : 'asc']) }}">
                                        First Name
                                    </a>
                                </th>
                                <th>
                                    <a class="sort-link" href="{{ request()->fullUrlWithQuery(['sort' => 'last_name', 'direction' => request('sort') === 'last_name' && request('direction', 'desc') === 'asc' ? 'desc' : 'asc']) }}">
                                        Last Name
                                    </a>
                                </th>
                                <th>
                                    <a class="sort-link" href="{{ request()->fullUrlWithQuery(['sort' => 'age', 'direction' => request('sort') === 'age' && request('direction', 'desc') === 'asc' ? 'desc' : 'asc']) }}">
                                        Age
                                    </a>
                                </th>
                                <th>
                                    <a class="sort-link" href="{{ request()->fullUrlWithQuery(['sort' => 'course', 'direction' => request('sort') === 'course' && request('direction', 'desc') === 'asc' ? 'desc' : 'asc']) }}">
                                        Course
                                    </a>
                                </th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($students as $student)
                                <tr>
                                    <td>{{ $student->first_name }}</td>
                                    <td>{{ $student->last_name }}</td>
                                    <td>{{ $student->age }}</td>
                                    <td>{{ $student->course }}</td>
                                    <td>
                                        <div class="row-actions">
                                            <button
                                                class="btn btn-edit"
                                                type="button"
                                                data-id="{{ $student->id }}"
                                                data-first-name="{{ $student->first_name }}"
                                                data-last-name="{{ $student->last_name }}"
                                                data-age="{{ $student->age }}"
                                                data-course="{{ $student->course }}"
                                                onclick="openStudentFromButton(this)"
                                            >
                                                Edit
                                            </button>
                                            <form method="POST" action="/students/{{ $student->id }}" onsubmit="return openDeleteModal(event, this)">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-delete" type="submit">Delete</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </section>

                <div class="pagination">
                    <div class="page-text">
                        Page {{ $students->currentPage() }} of {{ $students->lastPage() }}
                    </div>
                    <div class="actions-row">
                        @if($students->onFirstPage())
                            <span class="btn btn-secondary" style="opacity:0.6; cursor:default;">Previous</span>
                        @else
                            <a class="btn btn-secondary" href="{{ $students->previousPageUrl() }}">Previous</a>
                        @endif

                        @if($students->hasMorePages())
                            <a class="btn btn-main" href="{{ $students->nextPageUrl() }}">Next</a>
                        @else
                            <span class="btn btn-main" style="opacity:0.6; cursor:default;">Next</span>
                        @endif
                    </div>
                </div>
            @endif
        </main>
    </div>

    <div id="studentModalBackdrop" class="modal-backdrop">
        <div class="modal">
            <h3 id="studentModalTitle">Add Student</h3>
            <form id="studentModalForm" method="POST" action="/students">
                @csrf
                <input type="hidden" id="studentMethod" name="_method" value="POST">

                <label for="studentFirstName">First Name</label>
                <input id="studentFirstName" type="text" name="first_name" required>

                <label for="studentLastName">Last Name</label>
                <input id="studentLastName" type="text" name="last_name" required>

                <label for="studentAge">Age</label>
                <input id="studentAge" type="number" name="age" min="1" required>

                <label for="studentCourse">Course</label>
                <input id="studentCourse" type="text" name="course" required>

                <div class="modal-actions">
                    <button class="btn btn-secondary" type="button" onclick="closeStudentModal()">Cancel</button>
                    <button id="studentSubmitBtn" class="btn btn-main" type="submit">Save</button>
                </div>
            </form>
        </div>
    </div>

    <div id="deleteModalBackdrop" class="modal-backdrop">
        <div class="modal">
            <h3>Delete Student</h3>
            <p>Are you sure you want to delete this student? This action cannot be undone.</p>
            <div class="modal-actions">
                <button class="btn btn-secondary" type="button" onclick="closeDeleteModal()">Cancel</button>
                <button class="btn btn-delete" type="button" onclick="confirmDelete()">Yes, Delete</button>
            </div>
        </div>
    </div>

    <script>
        let pendingDeleteForm = null;
        const studentBackdrop = document.getElementById('studentModalBackdrop');
        const deleteBackdrop = document.getElementById('deleteModalBackdrop');
        const studentForm = document.getElementById('studentModalForm');
        const studentMethod = document.getElementById('studentMethod');
        const studentModalTitle = document.getElementById('studentModalTitle');
        const studentSubmitBtn = document.getElementById('studentSubmitBtn');
        const firstNameInput = document.getElementById('studentFirstName');
        const lastNameInput = document.getElementById('studentLastName');
        const ageInput = document.getElementById('studentAge');
        const courseInput = document.getElementById('studentCourse');
        const hasValidationErrors = document.body.dataset.hasErrors === '1';
        const filterForm = document.getElementById('filterForm');
        const searchInput = document.getElementById('searchInput');
        const courseSelect = document.getElementById('courseSelect');
        const themeToggleBtn = document.getElementById('themeToggleBtn');
        const modalAnimationMs = 200;
        let lastFocusedElement = null;
        let searchDebounceTimer = null;

        function setTheme(themeName) {
            document.body.dataset.theme = themeName;
            window.localStorage.setItem('sis_theme', themeName);
            if (themeToggleBtn) {
                themeToggleBtn.textContent = themeName === 'nocturne' ? 'Use Mint Theme' : 'Use Nocturne Theme';
            }
        }

        function openStudentModal(id = null, firstName = '', lastName = '', age = '', course = '') {
            lastFocusedElement = document.activeElement;
            if (id) {
                studentModalTitle.textContent = 'Edit Student';
                studentSubmitBtn.textContent = 'Update';
                studentForm.action = `/students/${id}`;
                studentMethod.value = 'PUT';
                firstNameInput.value = firstName;
                lastNameInput.value = lastName;
                ageInput.value = age;
                courseInput.value = course;
            } else {
                studentModalTitle.textContent = 'Add Student';
                studentSubmitBtn.textContent = 'Save';
                studentForm.action = '/students';
                studentMethod.value = 'POST';
                studentForm.reset();
            }

            studentBackdrop.classList.add('show');
            studentBackdrop.classList.remove('closing');
            firstNameInput.focus();
        }

        function openStudentFromButton(button) {
            openStudentModal(
                button.dataset.id,
                button.dataset.firstName,
                button.dataset.lastName,
                button.dataset.age,
                button.dataset.course
            );
        }

        function closeStudentModal() {
            studentBackdrop.classList.add('closing');
            window.setTimeout(function () {
                studentBackdrop.classList.remove('show');
                studentBackdrop.classList.remove('closing');
                if (lastFocusedElement) {
                    lastFocusedElement.focus();
                }
            }, modalAnimationMs);
        }

        function openDeleteModal(event, form) {
            event.preventDefault();
            lastFocusedElement = document.activeElement;
            pendingDeleteForm = form;
            deleteBackdrop.classList.add('show');
            deleteBackdrop.classList.remove('closing');
            return false;
        }

        function closeDeleteModal() {
            pendingDeleteForm = null;
            deleteBackdrop.classList.add('closing');
            window.setTimeout(function () {
                deleteBackdrop.classList.remove('show');
                deleteBackdrop.classList.remove('closing');
                if (lastFocusedElement) {
                    lastFocusedElement.focus();
                }
            }, modalAnimationMs);
        }

        function confirmDelete() {
            if (pendingDeleteForm) {
                pendingDeleteForm.submit();
            }
        }

        studentBackdrop.addEventListener('click', function (event) {
            if (event.target === studentBackdrop) {
                closeStudentModal();
            }
        });

        deleteBackdrop.addEventListener('click', function (event) {
            if (event.target === deleteBackdrop) {
                closeDeleteModal();
            }
        });

        document.addEventListener('keydown', function (event) {
            const studentOpen = studentBackdrop.classList.contains('show');
            const deleteOpen = deleteBackdrop.classList.contains('show');
            const activeTag = document.activeElement ? document.activeElement.tagName : '';

            if (event.key === 'Escape') {
                if (deleteOpen) {
                    closeDeleteModal();
                } else if (studentOpen) {
                    closeStudentModal();
                }
            }

            if (event.key === 'Enter' && deleteOpen && activeTag !== 'TEXTAREA') {
                event.preventDefault();
                confirmDelete();
            }
        });

        if (searchInput && filterForm) {
            searchInput.addEventListener('input', function () {
                const value = searchInput.value.trim();
                window.clearTimeout(searchDebounceTimer);

                if (value.length === 0 || value.length >= 2) {
                    searchDebounceTimer = window.setTimeout(function () {
                        filterForm.submit();
                    }, 350);
                }
            });
        }

        if (courseSelect && filterForm) {
            courseSelect.addEventListener('change', function () {
                filterForm.submit();
            });
        }

        if (themeToggleBtn) {
            themeToggleBtn.addEventListener('click', function () {
                const nextTheme = document.body.dataset.theme === 'nocturne' ? 'mint' : 'nocturne';
                setTheme(nextTheme);
            });
        }

        const savedTheme = window.localStorage.getItem('sis_theme');
        if (savedTheme === 'nocturne' || savedTheme === 'mint') {
            setTheme(savedTheme);
        } else {
            setTheme('mint');
        }

        if (hasValidationErrors) {
            openStudentModal();
        }
    </script>
</body>
</html>
