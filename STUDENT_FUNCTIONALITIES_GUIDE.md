# Student Functionalities Guide (University Management Portal)

This document summarizes student-facing features currently implemented in this project, based on existing routes, controllers, and views.

Use this as workflow context for chatbot/system prompts so answers stay accurate to the real system behavior.

---

## 1) Authentication and Session

- Students log in through the main login flow.
- Student session identity is read mostly from `session('id')`.
- If session is missing/invalid, student routes redirect back with an error.
- Logout is available through `route('logout')`.
- Session inactivity middleware is enabled globally for web routes.

---

## 2) Student Dashboard

**Route**
- `GET Students_Dashboard` (`Students.dashboard`)

**What student sees**
- Registered courses list (from `registeredCourses` relation).
- Per-course attendance percentage summary (computed from attendance sessions).

**How attendance percentage is computed**
- For each registered offered course:
  - Count all attendance sessions.
  - Count how many sessions mark student as `present`.
  - Percentage = `present / total * 100`.

---

## 3) Offered Courses and Registration

**Routes**
- `GET Students_Offer_Courses_Display` (`Student.offerCourses`)
- `POST /register-offerCourses` (`course.register`)

**Behavior**
- Student sees courses offered for their assigned class.
- Student can register/toggle registration status for offered course.
- If no class is assigned, page shows no offered courses.

---

## 4) Student Course Details Page (Main Academic Workspace)

**Route**
- `GET /student/course/{course_id}` (`student.course.details`)

This page is the central student experience for a selected registered course. It includes:

### A) Attendance tab
- Session-by-session attendance list with date/time/status.
- Summary cards:
  - total classes
  - present count
  - absent count
  - percentage
- Header also shows overall attendance progress bar and eligibility hint text.

### B) Assignments tab
- List of posted assignments for that course/class.
- Download assignment file.
- Upload assignment submission from this page (AJAX).
- Deadline-aware behavior:
  - shows overdue state after deadline
  - blocks late submission in backend
- Duplicate submission protection (one submission per assignment/student).

### C) Quizzes tab
- Lists quizzes filtered for same course/class.
- Supports quiz types:
  - `file`
  - `mcq`
  - `written`
- Student submission behavior:
  - file quiz: upload answer file
  - mcq quiz: in-page timed question flow, answer JSON submission
  - written quiz: text answer submission
- Deadline enforced server-side.
- Re-submission blocked once submitted.

### D) Marks tab (separate panel)
- Dedicated marks area separate from assignment/quiz content.
- Split sections:
  - Assignment Marks
  - Quiz Marks
- Status labels:
  - `Not Submitted`
  - `Submitted - Pending Grade`
  - `Graded`
- Includes summary widgets:
  - attendance summary
  - assignment marks summary
  - quiz marks summary

---

## 5) Standalone Student Assignments Page

**Route**
- `GET /student/assignments` (`assignments.student`)

**Purpose**
- Shows currently active assignments for student’s registered courses.
- Displays submission state using student submissions map.

---

## 6) Quiz Listing Page for Student

**Route**
- `GET /faculty/quizzes` (`quizzes.list`)  
  (name is legacy; function is student quiz listing)

**Behavior**
- Returns quizzes relevant to student’s registered offered courses.
- Adds computed flags per quiz:
  - `already_submitted`
  - `is_deadline_over`

---

## 7) Student Submission Endpoints

### Assignment submission
- `POST /student/submit-assignment/{assignment}` (`assignment.submit`)
- Validation:
  - required file (`pdf/doc/docx`)
  - max file size
- Additional checks:
  - student must be logged in
  - assignment deadline not passed
  - prevent duplicate submission

### Quiz submission
- `POST /student/upload-answer/{quiz}` (`student.uploadAnswer`)
- Validation and logic depend on quiz type.
- Rejects submission if deadline passed or already submitted.

---

## 8) Hostel Request (Student Side)

**Routes**
- `GET student/hostal/request` (`student.hostel.request`)
- `POST /hostel-request` (`student.hostel.store`)

**Behavior**
- Student can submit one hostel request with personal/emergency details.
- Duplicate hostel request by same student is blocked.

---

## 9) Role Boundaries Relevant to Student Experience

- Student cannot mark attendance.
- Student cannot edit posted assignments/quizzes.
- Student can only view marks assigned by professor/admin workflows.
- Student views only their own submissions/grade status on course pages.

---

## 10) Important Status Language for Chatbot Answers

When chatbot explains student results:

- **Not Submitted**: Student has not submitted required work.
- **Submitted - Pending Grade**: Submitted successfully; evaluator has not entered marks yet.
- **Graded**: Marks are available and shown in Marks tab.
- **Overdue/Closed**: Deadline passed; submission blocked.

Use these exact labels for consistency with UI.

---

## 11) Suggested “How to see marks” Answer Template

`Login as student -> Students Dashboard -> open your course -> Marks tab.`

Then explain:
- Assignment Marks table
- Quiz Marks table
- status meanings

---

## 12) Known Naming Quirks (for support/chatbot clarity)

- Some route names/paths contain legacy spelling:
  - `faculity` (faculty)
  - `hostal` (hostel)
- Chatbot should use user-friendly wording in answers, but can reference exact route/page names when needed.

---

## 13) Short Prompt Context Snippet (Optional)

If you need a compact block for workflow memory:

> Student core flow: Dashboard -> registered course details -> Attendance / Assignments / Quizzes / Marks tabs.  
> Students can submit assignments and quizzes before deadlines, once per item.  
> Marks are shown in a separate Marks tab with statuses: Not Submitted, Submitted - Pending Grade, Graded.  
> Hostel request submission exists with duplicate-request prevention.

