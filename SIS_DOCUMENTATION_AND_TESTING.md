# Student Information System (Laravel)

## Complete Documentation and Testing Materials

Prepared for: Activity Requirement  
System Name: Student Information System  
Platform: Laravel + MySQL

---

## Part I - Documentation

### 1. Program Description

The Student Information System is a web-based CRUD application built in Laravel that manages student records. It allows users to add, view, edit, delete, search, sort, filter, and export student data.

- **What the system does**
  - Stores student information (`first_name`, `last_name`, `age`, `course`) in a MySQL database
  - Displays records in a paginated table (5 records per page)
  - Supports live search (minimum 2 letters), course filtering, and sortable columns
  - Supports CSV and PDF export of filtered/sorted records
  - Uses modal forms for add/edit and confirmation modal for delete
- **Who might use it**
  - School registrar staff
  - Teachers/advisers managing class lists
  - Student assistants encoding records
  - IT students for learning database-backed web systems
- **What problem it solves**
  - Replaces manual paper/spreadsheet tracking
  - Reduces record entry and update errors
  - Makes student data easy to search and export
  - Provides a cleaner and faster workflow for managing records

---

### 2. IPO (Input - Process - Output)


| Input                                                  | Process                                                             | Output                                            |
| ------------------------------------------------------ | ------------------------------------------------------------------- | ------------------------------------------------- |
| First Name, Last Name, Age, Course (Add form)          | Validate required fields and data types -> Save to `students` table | New student appears in table with success message |
| Updated First Name, Last Name, Age, Course (Edit form) | Validate fields -> Find student by ID -> Update record              | Updated student data shown in table               |
| Student ID (Delete action)                             | Show confirmation modal -> Delete selected row from database        | Row removed from table and success message shown  |
| Search text (`q`)                                      | Filter query with `LIKE` on first name, last name, or course        | Matching records only                             |
| Course selected (`course`)                             | Apply `WHERE course = selected` condition                           | Records belonging to selected course              |
| Sort field + direction                                 | Validate allowed sort columns/directions -> Apply `ORDER BY`        | Table sorted ascending/descending                 |
| Export CSV request                                     | Run same filtered/sorted query -> Stream CSV response               | Downloaded `.csv` file                            |
| Export PDF request                                     | Run same filtered/sorted query -> Render Blade to PDF using DomPDF  | Downloaded `.pdf` report                          |


---

### 3. Algorithm (Numbered Steps)

1. Start the application and open `/students`.
2. Load the student list from MySQL using optional search/filter/sort parameters.
3. Show records in a paginated table (5 per page).
4. If user clicks **Add Student**, open add modal and accept input.
5. Validate input fields:
  - first name and last name must be text and required
  - age must be integer between 1 and 120
  - course must be text and required
6. If validation passes, save record and reload table with success message.
7. If user clicks **Edit**, open edit modal pre-filled with selected student data.
8. Validate edited values and update the selected record.
9. If user clicks **Delete**, show confirmation modal.
10. If user confirms, delete selected record and reload list.
11. If user types search text (2+ letters), auto-submit filters and refresh table.
12. If user selects a course, auto-submit and refresh table.
13. If user clicks a sortable column, toggle sort direction and refresh table.
14. If user clicks **Export CSV** or **Export PDF**, generate and download export file using current filter/sort.
15. End.

---

### 4. Pseudocode

```text
BEGIN
  OPEN students page

  SET sort, direction from request
  IF sort not allowed THEN sort = id
  IF direction not allowed THEN direction = desc

  CREATE query from students table

  IF search input is not empty THEN
    FILTER query where first_name OR last_name OR course contains search text
  ENDIF

  IF course filter is not empty THEN
    FILTER query where course equals selected course
  ENDIF

  ORDER query by sort and direction
  PAGINATE query by 5 records
  DISPLAY table

  IF user submits add form THEN
    VALIDATE fields
    IF valid THEN INSERT student
    ELSE SHOW errors
  ENDIF

  IF user submits edit form THEN
    VALIDATE fields
    IF valid THEN UPDATE selected student
    ELSE SHOW errors
  ENDIF

  IF user confirms delete THEN
    DELETE selected student
  ENDIF

  IF user requests CSV export THEN
    FETCH filtered and sorted records
    GENERATE csv file
    DOWNLOAD csv
  ENDIF

  IF user requests PDF export THEN
    FETCH filtered and sorted records
    RENDER pdf template
    DOWNLOAD pdf
  ENDIF
END
```

---

### 5. Variable Description


| Variable              | Data Type                         | Description                                                              |
| --------------------- | --------------------------------- | ------------------------------------------------------------------------ |
| `$students`           | Collection / LengthAwarePaginator | Holds student records for table display or export                        |
| `$courses`            | Collection                        | Distinct list of courses for dropdown filter                             |
| `$query`              | Eloquent Builder                  | Dynamic query object used for filter/search/sort                         |
| `$sort`               | String                            | Requested column to sort by (`first_name`, `last_name`, `age`, `course`) |
| `$direction`          | String                            | Sort order (`asc` or `desc`)                                             |
| `$search`             | String                            | Search keyword from request (`q`)                                        |
| `$validated`          | Array                             | Validated form data for create/update                                    |
| `$student`            | Student Model Object              | One selected student record for edit/delete                              |
| `$filename`           | String                            | Generated filename for export files                                      |
| `$pdf`                | DomPDF Instance                   | PDF object used to generate downloadable report                          |
| `pendingDeleteForm`   | JavaScript Object/HTMLFormElement | Stores targeted delete form before confirmation                          |
| `searchDebounceTimer` | JavaScript Number                 | Timer ID for delayed auto-search submission                              |


---

## Part II - User and Technical Documentation

### 6. User Documentation

#### A. How to Open the System

1. Start XAMPP (`Apache` and `MySQL` ON).
2. Open terminal in project folder.
3. Run:
  - `php artisan serve`
4. Open browser:
  - `http://127.0.0.1:8000/students`

#### B. How to Add a Student

1. Click **Add Student**.
2. Enter:
  - First Name
  - Last Name
  - Age
  - Course
3. Click **Save**.
4. System shows success message and displays new record in table.

#### C. How to Edit a Student

1. Click **Edit** in the student row.
2. Update details in modal.
3. Click **Update**.
4. Table refreshes with updated information.

#### D. How to Delete a Student

1. Click **Delete** in the target row.
2. Confirmation popup appears.
3. Click **Yes, Delete** to continue.
4. Selected record is removed.

#### E. How to Search, Filter, and Sort

1. Type at least 2 letters in search box to auto-search.
2. Select course from dropdown to filter.
3. Click table headers to sort ascending/descending.
4. Use pagination buttons to navigate pages.

#### F. How to Export

1. Apply any search/filter/sort you want.
2. Click **Export CSV** for spreadsheet format.
3. Click **Export PDF** for printable report format.
4. Download starts automatically.

#### G. Output Meaning

- **Table rows** = current matching records in database
- **Success message** = operation completed correctly
- **Validation error** = required/invalid field must be corrected
- **CSV/PDF file** = exported copy of current filtered/sorted data

---

### 7. Technical Documentation

#### A. Programming Language and Framework

- PHP 8.x
- Laravel 12.x
- Blade templating
- JavaScript (vanilla) for modal and live search behaviors
- MySQL for database

#### B. Required Tools / Software

- XAMPP (Apache + MySQL + PHP)
- Composer
- Node.js (for Laravel frontend toolchain, if needed)
- VS Code / Cursor IDE
- Browser (Chrome/Edge/Firefox)

#### C. Logical Conditions Used

- Validation rules:
  - `required|string|max:255` for names/course
  - `required|integer|min:1|max:120` for age
- Search condition:
  - `LIKE %keyword%` on first name, last name, or course
- Sort protection:
  - Sort field restricted to whitelist
  - Direction restricted to `asc`/`desc`
- Query filters:
  - Optional `q` and `course` parameters

#### D. System Requirements

- OS: Windows 10/11 (or Linux/macOS equivalent)
- PHP: 8.2+
- Composer: 2.x
- MySQL/MariaDB (via XAMPP)
- RAM: at least 4GB recommended
- Browser with JavaScript enabled

#### E. Code Screenshot/Comment Guide (for report insertion)

Use these files as screenshot sources (add short comments under each screenshot in your report):

1. `app/Http/Controllers/StudentController.php`
  - Comment: Handles CRUD, filtering, sorting, pagination, and export logic.
2. `routes/web.php`
  - Comment: Defines URL endpoints for student features and exports.
3. `app/Models/Student.php`
  - Comment: Declares fillable columns for mass assignment.
4. `database/migrations/2026_04_29_110814_create_students_table.php`
  - Comment: Defines database schema for the students table.
5. `resources/views/students/index.blade.php`
  - Comment: Main UI including table, filters, modals, and interaction scripts.
6. `resources/views/students/pdf.blade.php`
  - Comment: Template used to generate printable/exportable PDF reports.

---

## Part III - Testing

### 8. Test Cases Table (Minimum 5)


| Test Case ID | Test Scenario                             | Input Data                                 | Expected Result                                           | Actual Result              | Status      |
| ------------ | ----------------------------------------- | ------------------------------------------ | --------------------------------------------------------- | -------------------------- | ----------- |
| TC-01        | Add student (normal)                      | `John`, `Doe`, `20`, `BSIT`                | Record is saved and appears in table with success message | *To fill during execution* | *Pass/Fail* |
| TC-02        | Add student with empty first name (edge)  | `""`, `Doe`, `20`, `BSIT`                  | Validation error shown; record not saved                  | *To fill during execution* | *Pass/Fail* |
| TC-03        | Update student (normal)                   | Change course from `BSIT` to `BSCS`        | Updated value appears after save                          | *To fill during execution* | *Pass/Fail* |
| TC-04        | Delete student with confirmation (normal) | Click Delete -> Confirm                    | Record is removed; success message shown                  | *To fill during execution* | *Pass/Fail* |
| TC-05        | Delete cancelled (edge)                   | Click Delete -> Cancel                     | Record remains unchanged                                  | *To fill during execution* | *Pass/Fail* |
| TC-06        | Live search with 2 letters                | `Jo`                                       | Matching records appear automatically                     | *To fill during execution* | *Pass/Fail* |
| TC-07        | Export CSV with filters                   | Filter course = `BSIT`, click Export CSV   | Downloaded CSV contains only filtered/sorted records      | *To fill during execution* | *Pass/Fail* |
| TC-08        | Export PDF with no results (edge)         | Search unmatched keyword, click Export PDF | PDF downloads with "No records found" note                | *To fill during execution* | *Pass/Fail* |


---

### 9. Types of Testing

#### a. Manual Testing

Perform user actions directly in browser:

- create, edit, delete
- search/filter/sort
- pagination
- export CSV/PDF  
Verify UI behavior, success/error messages, and record consistency.

#### b. Unit Testing

Test isolated backend logic such as:

- validation rules for `store()` and `update()`
- sort input sanitization (`resolveSortInputs()`)
- filter logic (`buildFilteredQuery()`)  
Can be done via Laravel PHPUnit feature/unit tests.

#### c. Integration Testing

Test full flow between components:

- form submit -> controller -> model -> database -> redirect/view
- export endpoints -> filtered query -> file response  
Ensures routes, controller, model, and DB all work together.

#### d. User Acceptance Testing (UAT)

End users (e.g., registrar/teacher) validate if system satisfies real workflow:

- easy record encoding
- fast searching
- correct exports for reporting  
Collect feedback on usability and output quality.

---

### 10. Error Identification (Possible Issues)

1. **Database connection error**
  - Cause: wrong `.env` DB values or MySQL not running.
  - Fix: verify `DB_HOST`, `DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD`; start MySQL.
2. **419 Page Expired**
  - Cause: missing `@csrf` token in form.
  - Fix: ensure every POST/PUT/DELETE form has `@csrf`.
3. **Record not found on edit/delete**
  - Cause: invalid or deleted student ID.
  - Fix: handled by `findOrFail`; show proper error page/message if needed.
4. **Export file empty**
  - Cause: active filters return no matching rows.
  - Fix: clear filters or verify data matches query.
5. **Invalid input values**
  - Cause: empty required field or age outside valid range.
  - Fix: follow validation messages and input constraints.
6. **Sorting parameter tampering**
  - Cause: manual URL change to unsupported sort field.
  - Fix: already controlled by whitelist fallback to safe defaults.

---

## Suggested Submission Format

To submit as Word/PDF:

1. Copy this file content into Microsoft Word.
2. Insert screenshots from the listed source files.
3. Save as `.docx`.
4. Export as `.pdf` for final submission.

