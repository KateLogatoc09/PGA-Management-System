
    
<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
          <div class="app-brand demo">
          <a href="/" class="app-brand-link gap-2">
                  <span class="app-brand-logo demo">
                    <img
                      src="<?= base_url() ?>img/pga.ico"
                      height="50px"
                    >
                  </span>
                </a>
              <span class="app-brand-text demo menu-text fw-bold ms-2">PGA</span>
            </a>

            <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
              <i class="bx bx-chevron-left bx-sm align-middle"></i>
            </a>
          </div>

          <div class="menu-inner-shadow"></div>

          <ul class="menu-inner py-1">
            <!-- Dashboards -->
            <li class="menu-item active">
              <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div data-i18n="Dashboards">Dashboard</div>
              </a>
              <ul class="menu-sub">

              
              <li class="menu-item">
                  <a href="/application" class="menu-link">
                    <div data-i18n="Analytics">Account Applications</div>
                  </a>
                </li>
              
              <li class="menu-item">
                  <a href="/alumni" class="menu-link">
                    <div data-i18n="Analytics">Alumni</div>
                  </a>
                </li>

                <li class="menu-item">
                  <a href="/email" class="menu-link">
                    <div data-i18n="Analytics">Mail</div>
                  </a>
                </li>
  
                <li class="menu-item">
                  <a href="/sections" class="menu-link">
                    <div data-i18n="Analytics">Sections</div>
                  </a>
                </li>

                <li class="menu-item">
                  <a href="/subjects" class="menu-link">
                    <div data-i18n="Analytics">Subjects</div>
                  </a>
                </li>

                <li class="menu-item">
                  <a href="/reggrade" class="menu-link">
                    <div data-i18n="Analytics">Grades</div>
                  </a>
                </li>
                
              </ul>
            </li>

            <li class="menu-item">
              <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-book-bookmark"></i>
                <div data-i18n="Academic">Enrollment Information</div>
              </a>
              <ul class="menu-sub">
             
                <li class="menu-item active">
                  <a href="/registrar" class="menu-link">
                    <div data-i18n="Analytics">Home</div>
                  </a>
                </li>
                

                <li class="menu-item">
                  <a href="/regadmissions" class="menu-link">
                    <div data-i18n="Analytics">Admissions</div>
                  </a>
                </li>

                <li class="menu-item">
                  <a href="/registerstudent" class="menu-link">
                    <div data-i18n="Analytics">Learner</div>
                  </a>
                </li>

                <li class="menu-item">
                  <a href="/regschool" class="menu-link">
                    <div data-i18n="Analytics">Schools Attended</div>
                  </a>
                </li>

                <li class="menu-item">
                  <a href="/regfam" class="menu-link">
                    <div data-i18n="Analytics">Parent</div>
                  </a>
                </li>

                <li class="menu-item">
                  <a href="/regaddress" class="menu-link">
                    <div data-i18n="Analytics">Address</div>
                  </a>
                </li>

                <li class="menu-item">
                  <a href="/regsibling" class="menu-link">
                    <div data-i18n="Analytics">Sibling</div>
                  </a>
                </li>
         
              </ul>
            </li>

            <!-- Misc -->
            <li class="menu-header small text-uppercase"><span class="menu-header-text">Misc</span></li>
            <li class="menu-item">
              <a
                href="https://github.com/themeselection/sneat-html-admin-template-free/issues"
                target="_blank"
                class="menu-link">
                <i class="menu-icon tf-icons bx bx-support"></i>
                <div data-i18n="Support">Support</div>
              </a>
            </li>
            <li class="menu-item">
              <a
                href="https://demos.themeselection.com/sneat-bootstrap-html-admin-template/documentation/"
                target="_blank"
                class="menu-link">
                <i class="menu-icon tf-icons bx bx-file"></i>
                <div data-i18n="Documentation">Documentation</div>
              </a>
            </li>
            <li class="menu-item">
                  <a href="/logout" class="menu-link">
                  <i class="menu-icon tf-icons bx bx-undo"></i>
                    <div data-i18n="Analytics">Logout</div>
                  </a>
                </li>
          </ul>
        </aside>
