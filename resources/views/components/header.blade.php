<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LMS Portal</title>

    <link rel="stylesheet" href="{{ URL::asset('frontend/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <style>
        /* ===== TOP BAR ===== */
        .top-bar {
            background-color: #009999;
            color: white;
            text-align: center;
            padding: 10px;
            font-size: 18px;
            font-weight: 600;
        }

        /* ===== NAV HEADER ===== */
        .nav-container {
            background: #000;
            color: #fff;
            padding: 15px 20px;
        }

        .nav-inner {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 15px;
        }

        /* ===== UNIVERSITY INFO ===== */
        .university-info {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .university-info img {
            height: 70px;
        }

        .university-info .text {
            font-size: 20px;
            font-weight: bold;
            line-height: 1.2;
        }

        /* ===== TOGGLE BUTTON ===== */
        .menu-toggle {
            display: none;
            background: none;
            border: none;
            color: white;
            font-size: 26px;
        }

        /* ===== NAV LINKS ===== */
        .nav-links {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
            justify-content: center;
            transition: all 0.3s ease;
        }

        .nav-btn {
            background: white;
            color: black;
            text-align: center;
            border-radius: 6px;
            padding: 6px 10px;
            text-decoration: none;
            font-weight: 500;
            font-size: 13px;
            min-width: 90px;
        }

        .nav-btn i {
            display: block;
            font-size: 16px;
            margin-bottom: 4px;
        }

        /* ===== STUDENT IMAGE ===== */
        .student-image img {
            height: 65px;
            width: 65px;
            object-fit: cover;
            border-radius: 10px;
        }

        /* ================= MOBILE ================= */
        @media (max-width: 768px) {

            .menu-toggle {
                display: block;
            }

            .nav-inner {
                flex-wrap: wrap;
            }

            .nav-links {
                width: 100%;
                display: none;
                margin-top: 15px;
                display: grid;
                grid-template-columns: repeat(2, 1fr);
                gap: 10px;
            }

            .nav-links.active {
                display: grid;
            }

            .nav-btn {
                font-size: 14px;
                padding: 10px;
            }

            .student-image {
                order: -1;
            }

            .university-info .text {
                font-size: 17px;
            }
        }
    </style>
</head>

<body>
@php
    use Illuminate\Support\Facades\Session;
    use App\Models\StudentsRegistration;

    $student = null;
    if (Session::has('id')) {
        $student = StudentsRegistration::with('image')->where('user_id', Session::get('id'))->first();
    }
@endphp

<!-- ===== TOP BAR ===== -->
<div class="top-bar">
    Welcome: {{ $student->full_name -- }} {{ $student->degree_program }}{{ $student->department }}-{{ $student->roll_no -- }}
</div>

<!-- ===== NAV HEADER ===== -->
<div class="nav-container">
    <div class="nav-inner">

        <!-- University Info -->
        <div class="university-info">
            <img src="{{ asset('frontend/images/logo/logo_01.png') }}">
            <div class="text">
                University Of<br>Albourne
            </div>
        </div>

        <!-- Mobile Toggle -->
        <button class="menu-toggle" onclick="toggleMenu()">
            <i class="fas fa-bars"></i>
        </button>

        <!-- Nav Links -->
        <div class="nav-links" id="navMenu">
            <a href="{{ route('Students.dashboard') }}" class="nav-btn"><i class="fas fa-home"></i>Dashboard</a>
            <a href="{{ route('Student.offerCourses') }}" class="nav-btn"><i class="fas fa-id-card"></i>Registration</a>
            <a href="{{ route('quizzes.list') }}" class="nav-btn"><i class="fas fa-list-alt"></i>Quizzes</a>
            <a href="#" class="nav-btn"><i class="fas fa-money-bill-wave"></i>Fees</a>
            <a href="#" class="nav-btn"><i class="fas fa-chart-bar"></i>Results</a>
            <a href="{{ route('assignments.student') }}" class="nav-btn"><i class="fas fa-user"></i>Assignments</a>
            <a href="{{ route('student.hostel.request') }}" class="nav-btn">
    <i class="fas fa-bed"></i>Hostel Request
</a>

            <a href="{{ route('logout') }}" class="nav-btn"><i class="fas fa-sign-out-alt"></i>Logout</a>
        </div>

        <!-- Student Image -->
        <div class="student-image">
            @if ($student && $student->image)
                <img src="{{ Storage::url($student->image->image_path) }}">
            @else
                <img src="{{ asset('frontend/images/Person.png') }}">
            @endif
        </div>

    </div>
</div>

<script>
function toggleMenu() {
    document.getElementById('navMenu').classList.toggle('active');
}
</script>


<!-- searching page script -->


<script>
let timer = null;

document.getElementById('globalSearch')?.addEventListener('keyup', function () {
    clearTimeout(timer);
    const query = this.value;
    const page = this.dataset.page;

    let url = '';
    let tableBodyId = '';

    // Map page to AJAX URL and table body ID
    switch(page) {
        case 'users':
            url = "{{ route('admin.users.search') }}";
            tableBodyId = 'usersTableBody';
            break;
        case 'professors':
            url = "{{ route('admin.professors.search') }}";
            tableBodyId = 'professorsTableBody';
            break;
        case 'students':
            url = "";
            tableBodyId = 'studentsTableBody';
            break;
        default:
            return; // unknown page
    }

    if(!query) return;

    timer = setTimeout(() => {
        fetch(url + '?q=' + query)
            .then(res => res.text())
            .then(html => {
                document.getElementById(tableBodyId).innerHTML = html;
            });
    }, 300);
});
</script>

</body>
</html>
