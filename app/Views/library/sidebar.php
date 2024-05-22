
    
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

                <li class="menu-item <?= set_active('librarian'); ?>">
                  <a href="<?= base_url('librarian') ?>" class="menu-link">
                    <div data-i18n="Analytics">Home</div>
                  </a>
                </li>

                <li class="menu-item <?= set_active('books'); ?>">
                  <a href="<?= base_url('books') ?>" class="menu-link">
                    <div data-i18n="Analytics">Books</div>
                  </a>
                </li>

                <li class="menu-item <?= set_active('borrowers'); ?>">
                  <a href="<?= base_url('borrowers') ?>" class="menu-link">
                    <div data-i18n="Analytics">Borrowers</div>
                  </a>
                </li>
                
              </ul>
            </li>

            <li class="menu-item">
              <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-book-bookmark"></i>
                <div data-i18n="category">Book Categories</div>
              </a>
              <ul class="menu-sub">
             
                <li class="menu-item <?= set_active('textbooks'); ?>">
                  <a href="<?= base_url('textbooks') ?>" class="menu-link">
                    <div data-i18n="Analytics">Textbooks</div>
                  </a>
                </li>
                
                <li class="menu-item <?= set_active('fiction_storybook'); ?>">
                  <a href="<?= base_url('fiction_storybook') ?>" class="menu-link">
                    <div data-i18n="Analytics">Fiction & Storybooks</div>
                  </a>
                </li>
         
                <li class="menu-item">
                <a href="javascript:void(0);" class="menu-link menu-toggle">
                    <div data-i18n="Analytics">Reference & Filipiniana</div>
                </a>
                      <ul class="menu-sub">
                        <li class="menu-item <?= set_active('reference_filipiniana'); ?>">
                          <a href="<?= base_url('reference_filipiniana') ?>" class="menu-link">
                            <div data-i18n="Analytics">Shelf 4 & 10</div>
                          </a>
                        </li>
                   
                        <li class="menu-item <?= set_active('reference_filipiniana2'); ?>">
                        <a href="<?= base_url('reference_filipiniana2') ?>" class="menu-link">
                            <div data-i18n="Analytics">Shelf 11 & 12</div>
                          </a>
                        </li>

                        <li class="menu-item <?= set_active('reference_filipiniana3'); ?>">
                        <a href="<?= base_url('reference_filipiniana3') ?>" class="menu-link">
                            <div data-i18n="Analytics">Shelf 13 & 14</div>
                          </a>
                        </li>

                      </ul>
                  </a>
                </li>

                <li class="menu-item">
                <a href="javascript:void(0);" class="menu-link menu-toggle">
                    <div data-i18n="Analytics">Books with Multiple Copies</div>
                </a>
                      <ul class="menu-sub">
                        <li class="menu-item <?= set_active('multiple_copies'); ?>">
                        <a href="<?= base_url('multiple_copies') ?>" class="menu-link">
                            <div data-i18n="Analytics">Shelf 5 & 7</div>
                          </a>
                        </li>
                   
                        <li class="menu-item <?= set_active('multiple_copies2'); ?>">
                        <a href="<?= base_url('multiple_copies2') ?>" class="menu-link">
                            <div data-i18n="Analytics">Shelf 8 & 9</div>
                          </a>
                        </li>

                      </ul>
                  </a>
                </li>

                <li class="menu-item <?= set_active('teacher_references'); ?>">
                <a href="<?= base_url('teacher_references') ?>" class="menu-link">
                    <div data-i18n="Analytics">Teacher's References</div>
                  </a>
                </li>

                <li class="menu-item <?= set_active('other_textbooks'); ?>">
                <a href="<?= base_url('other_textbooks') ?>" class="menu-link">
                    <div data-i18n="Analytics">Other Textbooks</div>
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
