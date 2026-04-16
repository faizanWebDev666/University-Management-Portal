
		<!-- Optional JavaScript _____________________________  -->

		<!-- jQuery first, then Bootstrap JS -->
		<!-- jQuery -->
		<script src="{{URL::asset('backend_faculity/vendor/jquery.min.js')}}"></script>
		<!-- Bootstrap JS -->
		<script src="{{URL::asset('backend_faculity/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
		<!-- WOW js -->
		<script src="{{URL::asset('backend_faculity/vendor/wow/wow.min.js')}}"></script>
		<!-- Slick Slider -->
		<script src="{{URL::asset('backend_faculity/vendor/slick/slick.min.js')}}"></script>
		<!-- Fancybox -->
		<script src="{{URL::asset('backend_faculity/vendor/fancybox/dist/jquery.fancybox.min.js')}}"></script>
		<!-- Lazy -->
		<script src="{{URL::asset('backend_faculity/vendor/jquery.lazy.min.js')}}"></script>
		<!-- js Counter -->
		<script src="{{URL::asset('backend_faculity/vendor/jquery.counterup.min.js')}}"></script>
		<script src="{{URL::asset('backend_faculity/vendor/jquery.waypoints.min.js')}}"></script>
		<!-- Nice Select -->
		<script src="{{URL::asset('backend_faculity/vendor/nice-select/jquery.nice-select.min.js')}}"></script>
		<!-- validator js -->
		<script src="{{URL::asset('backend_faculity/vendor/validator.js')}}"></script>

		<!-- Theme js -->
		<script src="{{URL::asset('backend_faculity/js/theme.js')}}"></script>
		
		<!-- Inactivity Timeout -->
		<script src="{{ asset('js/inactivity-timeout.js') }}"></script>
		<script>
			(function () {
				const sidebar = document.querySelector('.dash-aside-navbar');
				const openBtn = document.getElementById('facultySidebarOpenBtn');
				const overlay = document.getElementById('facultySidebarOverlay');
				const closeBtn = document.querySelector('.dash-aside-navbar .close-btn');
				const mobileQuery = window.matchMedia('(max-width: 991.98px)');

				if (!sidebar || !openBtn || !overlay) {
					return;
				}

				const openSidebar = function () {
					if (!mobileQuery.matches) {
						return;
					}
					sidebar.classList.add('sidebar-open');
					overlay.classList.add('show');
					document.body.classList.add('faculty-sidebar-open');
				};

				const closeSidebar = function () {
					sidebar.classList.remove('sidebar-open');
					overlay.classList.remove('show');
					document.body.classList.remove('faculty-sidebar-open');
				};

				openBtn.addEventListener('click', openSidebar);
				overlay.addEventListener('click', closeSidebar);
				if (closeBtn) {
					closeBtn.addEventListener('click', closeSidebar);
				}

				sidebar.querySelectorAll('a').forEach(function (link) {
					link.addEventListener('click', function () {
						if (mobileQuery.matches) {
							closeSidebar();
						}
					});
				});

				window.addEventListener('resize', function () {
					if (!mobileQuery.matches) {
						closeSidebar();
					}
				});
			})();
		</script>
	</div> <!-- /.main-page-wrapper -->
	
	<!-- Inactivity Modal -->
	@include('components.inactivity-modal')
</body>
</html>