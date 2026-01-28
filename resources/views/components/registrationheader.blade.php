<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="keywords" content="Digital marketing agency, Digital marketing company, Digital marketing services">
    <meta name="description" content="Jobi is a beautiful website template designed for job board websites.">
    <meta property="og:site_name" content="Jano">
    <meta property="og:url" content="https://creativegigstf.com/">
    <meta property="og:type" content="website">
    <meta property="og:title" content="Jobi - Responsive Job Board HTML Template">
    <meta name='og:image' content='../backend_faculity/images/assets/ogg.png'>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#244034">
    <meta name="msapplication-navbutton-color" content="#244034">
    <meta name="apple-mobile-web-app-status-bar-style" content="#244034">
    <title>Registration Branch</title>
    <link rel="icon" type="image/png" sizes="56x56" href="frontend/images/icon/icon.png">
    <link rel="stylesheet" type="text/css" href="backend_faculity/css/bootstrap.min.css" media="all">
    <link rel="stylesheet" type="text/css" href="backend_faculity/css/style.min.css" media="all">
    <link rel="stylesheet" type="text/css" href="backend_faculity/css/responsive.css" media="all">

</head>

<body>
    <div class="main-page-wrapper">
        <aside class="dash-aside-navbar">
            <div class="position-relative">
                <div class="logo text-md-center d-md-block d-flex align-items-center justify-content-between">
                    <a href="candidate-dashboard-index.html">
                        <img src="frontend/images/logo/logo_01_whitebg.png" alt="">
                    </a>
                    <button class="close-btn d-block d-md-none"><i class="bi bi-x-lg"></i></button>
                </div>
                
                
                </div>

                <nav class="dasboard-main-nav">
                    <ul class="style-none">
                        <li><a href="{{ 'Registration_index' }}" class="d-flex w-100 align-items-center active">
                                <img src="../backend_faculity/images/lazy.svg"
                                    data-src="backend_faculity/images/icon/icon_1_active.svg" alt=""
                                    class="lazy-img">
                                <span>Dashboard</span>
                            </a></li>
                        <li><a href="{{ URL::to('RegisterStudents') }}" class="d-flex w-100 align-items-center">
                                <img src="../backend_faculity/images/lazy.svg"
                                    data-src="backend_faculity/images/icon/icon_2.svg" alt="" class="lazy-img">
                                <span>Register Students</span>
                            </a></li>
                            <li>
  <a href="javascript:void(0);" onclick="sendUpdateRequest()" class="d-flex w-100 align-items-center">
    <img src="../backend_faculity/images/lazy.svg" data-src="backend_faculity/images/icon/icon_2.svg" alt="" class="lazy-img">
    <span>Update Students</span>
  </a>
</li>

<script>
function sendUpdateRequest() {
    fetch("{{ route('request.update.students') }}", {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify({})
    })
    .then(response => response.json())
    .then(data => alert(data.message))
    .catch(error => console.error(error));
}
</script>

                        <li><a href="{{ URL::to('RegisterTeachers') }}" class="d-flex w-100 align-items-center">
                                <img src="../backend_faculity/images/lazy.svg"
                                    data-src="backend_faculity/images/icon/icon_3.svg" alt="" class="lazy-img">
                                <span>Register Teachers</span>
                            </a></li>
                       
                        <li><a href="{{ URL::to('NewCourseRegistration') }}" class="d-flex w-100 align-items-center">
                                <img src="../backend_faculity/images/lazy.svg"
                                    data-src="backend_faculity/images/icon/icon_5.svg" alt=""
                                    class="lazy-img">
                                <span>Add New Courses</span>
                            </a></li>
                        <li><a href="{{ URL::to('RegisterNewClasses') }}" class="d-flex w-100 align-items-center">
                                <img src="../backend_faculity/images/lazy.svg"
                                    data-src="backend_faculity/images/icon/icon_6.svg" alt=""
                                    class="lazy-img">
                                <span>Add New Classes</span>
                            </a></li>
                             <li><a href="{{ route('register.new.departments') }}" class="d-flex w-100 align-items-center">
                                <img src="backend_faculity/images/lazy.svg"
                                    data-src="backend_faculity/images/icon/icon_6.svg" alt=""
                                    class="lazy-img">
                                <span>Add New Departments</span>
                            </a></li>
                        <li><a href="{{ URL::to('OfferCoursesToClasses') }}" class="d-flex w-100 align-items-center">
                                <img src="../backend_faculity/images/lazy.svg"
                                    data-src="backend_faculity/images/icon/icon_7.svg" alt=""
                                    class="lazy-img">
                                <span>Courses Allocation</span>
                            </a></li>
                        <li><a href="{{ route('delete.accounts') }}" class="d-flex w-100 align-items-center">
                                <img src="../backend_faculity/images/lazy.svg"
                                    data-src="backend_faculity/images/icon/icon_8.svg" alt=""
                                    class="lazy-img">
                                <span>Delete Account</span>
                            </a></li>
                    </ul>
                </nav>
                <div class="profile-complete-status">
                    <div class="progress-value fw-500">87%</div>
                    <div class="progress-line position-relative">
                        <div class="inner-line" style="width:80%;"></div>
                    </div>
                    <p>Profile Complete</p>
                </div>

                <a href="#" class="d-flex w-100 align-items-center logout-btn">
                    <img src="../backend_faculity/images/lazy.svg" data-src="backend_faculity/images/icon/icon_9.svg"
                        alt="" class="lazy-img">
                    <span>Logout</span>
                </a>
            </div>
        </aside>

        <div class="dashboard-body">
            <div class="position-relative">
               
