
    
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
                <div data-i18n="Dashboards">Dashboards</div>
              </a>
              <ul class="menu-sub">
             
                <li class="menu-item <?= set_active('teacher'); ?>">
                  <a href="<?= base_url('teacher') ?>" class="menu-link">
                    <div data-i18n="Analytics">Teacher Profile</div>
                  </a>
                </li>

                <li class="menu-item <?= set_active('advisoryClass'); ?>">
                  <a href="<?= base_url('advisoryClass') ?>" class="menu-link">
                    <div data-i18n="Analytics">Advisory Class</div>
                  </a>
                </li>

                <li class="menu-item <?= set_active('grade'); ?>">
                  <a href="<?= base_url('grade') ?>" class="menu-link">
                    <div data-i18n="Analytics">Encode Grades</div>
                  </a>
                </li>

                <li class="menu-item <?= set_active('chart'); ?>">
                  <a href="<?= base_url('chart') ?>" class="menu-link">
                    <div data-i18n="Analytics">Charts</div>
                  </a>
                </li>

                <li class="menu-item <?= set_active('feedback'); ?>">
                  <a href="<?= base_url('feedback') ?>" class="menu-link">
                    <div data-i18n="Analytics">Feedback</div>
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
                  <a href="/logout" id="logout1" class="menu-link">
                  <i class="menu-icon tf-icons bx bx-undo"></i>
                    <div data-i18n="Analytics">Logout</div>
                  </a>
                </li>
          </ul>
        </aside>
