  <!--begin::App-->
  <div class="d-flex flex-column flex-root app-root" id="kt_app_root">
      <!--begin::Page-->
      <div class="app-page flex-column flex-column-fluid" id="kt_app_page">
          <!--begin::Header-->
          <div id="kt_app_header" class="app-header" data-kt-sticky="true" data-kt-sticky-activate="{default: true, lg: true}" data-kt-sticky-name="app-header-minimize" data-kt-sticky-offset="{default: '200px', lg: '0'}" data-kt-sticky-animation="false">
              <!--begin::Header container-->
              <div class="app-container container-fluid d-flex align-items-stretch justify-content-between" id="kt_app_header_container">
                  <!--begin::Sidebar mobile toggle-->
                  <div class="d-flex align-items-center d-lg-none ms-n3 me-1 me-md-2" title="Show sidebar menu">
                      <div class="btn btn-icon btn-active-color-primary w-35px h-35px" id="kt_app_sidebar_mobile_toggle">
                          <i class="ki-duotone ki-abstract-14 fs-2 fs-md-1">
                              <span class="path1"></span>
                              <span class="path2"></span>
                          </i>
                      </div>
                  </div>
                  <!--end::Sidebar mobile toggle-->
                  <!--begin::Mobile logo-->
                  <div class="d-flex align-items-center flex-grow-1 flex-lg-grow-0">
                      <a href="index.html" class="d-lg-none">
                          <img alt="Logo" src="<?php echo URLROOT ?>/public/assets/media/logos/YVLogo.svg" class="h-30px" />
                      </a>
                  </div>
                  <!--end::Mobile logo-->
                  <!--begin::Header wrapper-->
                  <div class="d-flex align-items-stretch justify-content-between flex-lg-grow-1" id="kt_app_header_wrapper">
                      <!--begin::Menu wrapper-->

                      <?php
                        require APPROOT . '/views/includes/header_wrapper.php';
                        ?>


                      <!--end::Menu wrapper-->
                      <!--begin::Navbar-->
                      <?php
                        require APPROOT . '/views/includes/navbar.php';
                        ?>
                      <!--end::Navbar-->
                  </div>
                  <!--end::Header wrapper-->
              </div>
              <!--end::Header container-->
          </div>
          <!--end::Header-->
          <!--begin::Wrapper-->
          <div class="app-wrapper flex-column flex-row-fluid" id="kt_app_wrapper">
              <!--begin::Sidebar-->
              <div id="kt_app_sidebar" class="app-sidebar flex-column" data-kt-drawer="true" data-kt-drawer-name="app-sidebar" data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true" data-kt-drawer-width="225px" data-kt-drawer-direction="start" data-kt-drawer-toggle="#kt_app_sidebar_mobile_toggle">
                  <!--begin::Logo-->
                  <div class="app-sidebar-logo px-6" id="kt_app_sidebar_logo">
                      <!--begin::Logo image-->
                      <a href="index.html">
                          <img alt="Logo" src="<?php echo URLROOT ?>/public/assets/media/logos/YVLogo.svg" class="h-100px app-sidebar-logo-default" style="width: 100px; height: 250px;" />YouthVentures
                          <img alt="Logo" src="<?php echo URLROOT ?>/public/assets/media/logos/YVLogo.svg" class="h-20px app-sidebar-logo-default" style="width: 40px; height: 40px;" />

                      </a>
                      <!--end::Logo image-->
                      <!--begin::Sidebar toggle-->
                      <!--begin::Minimized sidebar setup:
                if (isset($_COOKIE["sidebar_minimize_state"]) && $_COOKIE["sidebar_minimize_state"] === "on") { 
                    1. "src/js/layout/sidebar.js" adds "sidebar_minimize_state" cookie value to save the sidebar minimize state.
                    2. Set data-kt-app-sidebar-minimize="on" attribute for body tag.
                    3. Set data-kt-toggle-state="active" attribute to the toggle element with "kt_app_sidebar_toggle" id.
                    4. Add "active" class to to sidebar toggle element with "kt_app_sidebar_toggle" id.
                }
            -->




                      <div id="kt_app_sidebar_toggle" class="app-sidebar-toggle btn btn-icon btn-shadow btn-sm btn-color-muted btn-active-color-primary h-30px w-30px position-absolute top-50 start-100 translate-middle rotate" data-kt-toggle="true" data-kt-toggle-state="active" data-kt-toggle-target="body" data-kt-toggle-name="app-sidebar-minimize">
                          <i class="ki-duotone ki-black-left-line fs-3 rotate-180">
                              <span class="path1"></span>
                              <span class="path2"></span>
                          </i>
                      </div>
                      <!--end::Sidebar toggle-->
                  </div>
                  <!--end::Logo-->
                  <!--begin::sidebar menu-->
                  <?php
                    require APPROOT . '/views/includes/sidebar_menu.php';
                    ?>

              </div>
              <!--end::Sidebar-->
              <!--begin::Main-->
              <div class="app-main flex-column flex-row-fluid" id="kt_app_main">