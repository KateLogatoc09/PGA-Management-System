
    
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
             
                <li class="menu-item <?= set_active('AAC'); ?>">
                  <a href="<?= base_url('AAC') ?>" class="menu-link">
                    <div data-i18n="Analytics">Home</div>
                  </a>
                </li>

                <li class="menu-item <?= set_active('aacsections'); ?>">
                  <a href="<?= base_url('aacsections') ?>" class="menu-link">
                    <div data-i18n="Analytics">Section List</div>
                  </a>
                </li>

                <li class="menu-item <?= set_active('aacsubjects'); ?>">
                  <a href="<?= base_url('aacsubjects') ?>" class="menu-link">
                    <div data-i18n="Analytics">Subjects</div>
                  </a>
                </li>

                <li class="menu-item <?= set_active('scheduleList'); ?>">
                  <a href="<?= base_url('scheduleList') ?>" class="menu-link">
                    <div data-i18n="Analytics">Schedules</div>
                  </a>
                </li>

                <li class="menu-item <?= set_active('feedback'); ?>">
                  <a href="<?= base_url('feedback') ?>" class="menu-link">
                    <div data-i18n="Analytics">Feedback</div>
                  </a>
                </li>


              </ul>
            </li>

            <!-- Sections -->
            <li class="menu-item">
              <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-book"></i>
                <div data-i18n="Sections">Sections</div>
              </a>
              <ul class="menu-sub">

              <li class="menu-item">
                <a href="javascript:void(0);" class="menu-link menu-toggle">
                    <div data-i18n="Analytics">Kinder Section</div>
                </a>
                      <ul class="menu-sub">

                      <li class="menu-item <?= set_active('St_Joseph_Husband_of_Mary'); ?>">
                            <a href="<?= base_url('St_Joseph_Husband_of_Mary') ?>" class="menu-link">
                              <div data-i18n="Analytics">St. Joseph Husband of Mary</div>
                            </a>
                          </li>

                      </ul>
                  </a>
                </li>
              
              <li class="menu-item">
                <a href="javascript:void(0);" class="menu-link menu-toggle">
                    <div data-i18n="Analytics">Elementary Sections</div>
                </a>
                      <ul class="menu-sub">

                          <li class="menu-item <?= set_active('St_Perpetua_and_Felicity'); ?>">
                            <a href="<?= base_url('St_Perpetua_and_Felicity') ?>" class="menu-link">
                              <div data-i18n="Analytics">St. Perpetua and Felicity</div>
                            </a>
                          </li>

                          <li class="menu-item <?= set_active('St_Louise_de_Marillac'); ?>">
                            <a href="<?= base_url('St_Louise_de_Marillac') ?>" class="menu-link">
                              <div data-i18n="Analytics">St. Louise de Marillac</div>
                            </a>
                          </li>

                          <li class="menu-item <?= set_active('St_Dominic_Savio'); ?>">
                            <a href="<?= base_url('St_Dominic_Savio') ?>" class="menu-link">
                              <div data-i18n="Analytics">St. Dominic Savio</div>
                            </a>
                          </li>

                          <li class="menu-item <?= set_active('St_Pedro_Calungsod'); ?>">
                            <a href="<?= base_url('St_Pedro_Calungsod') ?>" class="menu-link">
                              <div data-i18n="Analytics">St. Pedro Calungsod</div>
                            </a>
                          </li>

                          <li class="menu-item <?= set_active('St_Gemma_Galgani'); ?>">
                            <a href="<?= base_url('St_Gemma_Galgani') ?>" class="menu-link">
                              <div data-i18n="Analytics">St. Gemma Galgani</div>
                            </a>
                          </li>

                          
                      <li class="menu-item <?= set_active('St_Catherine_of_Siena'); ?>">
                        <a href="<?= base_url('St_Catherine_of_Siena') ?>" class="menu-link">
                          <div data-i18n="Analytics">St. Catherine of Siena</div>
                        </a>
                      </li>

                      </ul>
                  </a>
                </li>

                <li class="menu-item">
                <a href="javascript:void(0);" class="menu-link menu-toggle">
                    <div data-i18n="Analytics">Grade 7 Sections</div>
                </a>
                      <ul class="menu-sub">

                      <li class="menu-item <?= set_active('St_Lawrence_of_Manila'); ?>">
                  <a href="<?= base_url('St_Lawrence_of_Manila') ?>" class="menu-link">
                    <div data-i18n="Analytics">St. Lawrence of Manila</div>
                  </a>
                </li>

                <li class="menu-item <?= set_active('St_Pio_of_Pietrelcina'); ?>">
                  <a href="<?= base_url('St_Pio_of_Pietrelcina') ?>" class="menu-link">
                    <div data-i18n="Analytics">St. Pio of Pietrelcina</div>
                  </a>
                </li>
        
                <li class="menu-item <?= set_active('St_Matthew_the_Evangelist'); ?>">
                  <a href="<?= base_url('St_Matthew_the_Evangelist') ?>" class="menu-link">
                    <div data-i18n="Analytics">St. Matthew the Evangelist</div>
                  </a>
                </li>

                
                <li class="menu-item <?= set_active('St_Jerome_of_Stridon'); ?>">
                  <a href="<?= base_url('St_Jerome_of_Stridon') ?>" class="menu-link">
                    <div data-i18n="Analytics">St. Jerome of Stridon</div>
                  </a>
                </li>


                      </ul>
                  </a>
                </li>

                <li class="menu-item">
                <a href="javascript:void(0);" class="menu-link menu-toggle">
                    <div data-i18n="Analytics">Grade 8 Sections</div>
                </a>
                      <ul class="menu-sub">

                      <li class="menu-item <?= set_active('St_Francis_of_Assisi'); ?>">
                  <a href="<?= base_url('St_Francis_of_Assisi') ?>" class="menu-link">
                    <div data-i18n="Analytics">St. Francis of Assisi</div>
                  </a>
                </li>

                
                <li class="menu-item <?= set_active('St_Luke_the_Evangelist'); ?>">
                  <a href="<?= base_url('St_Luke_the_Evangelist') ?>" class="menu-link">
                    <div data-i18n="Analytics">St. Luke the Evangelist</div>
                  </a>
                </li>
                
                <li class="menu-item <?= set_active('St_Therese_of_Lisieux'); ?>">
                  <a href="<?= base_url('St_Therese_of_Lisieux') ?>" class="menu-link">
                    <div data-i18n="Analytics">St. Therese of Lisieux</div>
                  </a>
                </li>
                      
                      </ul>
                  </a>
                </li>

                <li class="menu-item">
                <a href="javascript:void(0);" class="menu-link menu-toggle">
                    <div data-i18n="Analytics">Grade 9 Sections</div>
                </a>
                      <ul class="menu-sub">

                      <li class="menu-item <?= set_active('St_Cecelia'); ?>">
                  <a href="<?= base_url('St_Cecelia') ?>" class="menu-link">
                    <div data-i18n="Analytics">St. Cecelia</div>
                  </a>
                </li>

                <li class="menu-item <?= set_active('St_Martin_the_Porres'); ?>">
                  <a href="<?= base_url('St_Martin_the_Porres') ?>" class="menu-link">
                    <div data-i18n="Analytics">St. Martin the Porres</div>
                  </a>
                </li>

                <li class="menu-item <?= set_active('St_Albert_the_Great'); ?>">
                  <a href="<?= base_url('St_Albert_the_Great') ?>" class="menu-link">
                    <div data-i18n="Analytics">St. Albert the Great</div>
                  </a>
                </li>

                      
                      </ul>
                  </a>
                </li>

               <li class="menu-item">
                <a href="javascript:void(0);" class="menu-link menu-toggle">
                    <div data-i18n="Analytics">Grade 10 Sections</div>
                </a>
                      <ul class="menu-sub">

                      <li class="menu-item <?= set_active('St_Stephen'); ?>">
                  <a href="<?= base_url('St_Stephen') ?>" class="menu-link">
                    <div data-i18n="Analytics">St. Stephen</div>
                  </a>
                </li>

                <li class="menu-item <?= set_active('St_Francis_Xavier'); ?>">
                  <a href="<?= base_url('St_Francis_Xavier') ?>" class="menu-link">
                    <div data-i18n="Analytics">St. Francis Xavier</div>
                  </a>
                </li>

                <li class="menu-item <?= set_active('St_John_the_Beloved'); ?>">
                  <a href="<?= base_url('St_John_the_Beloved') ?>" class="menu-link">
                    <div data-i18n="Analytics">St. John the Beloved</div>
                  </a>
                </li>
                      
                      </ul>
                  </a>
                </li>

                <li class="menu-item">
                <a href="javascript:void(0);" class="menu-link menu-toggle">
                    <div data-i18n="Analytics">Grade 11 Sections</div>
                </a>
                      <ul class="menu-sub">

                      <li class="menu-item <?= set_active('St_Joseph_Freinademetz'); ?>">
                  <a href="<?= base_url('St_Joseph_Freinademetz') ?>" class="menu-link">
                    <div data-i18n="Analytics">St. Joseph Freinademetz</div>
                  </a>
                </li>

                <li class="menu-item <?= set_active('St_Thomas_Aquinas'); ?>">
                  <a href="<?= base_url('St_Thomas_Aquinas') ?>" class="menu-link">
                    <div data-i18n="Analytics">St. Thomas Aquinas</div>
                  </a>
                </li>

                <li class="menu-item <?= set_active('St_Arnold_Janssen'); ?>">
                  <a href="<?= base_url('St_Arnold_Janssen') ?>" class="menu-link">
                    <div data-i18n="Analytics">St. Arnold Janssen</div>
                  </a>
                </li>


                      </ul>
                  </a>
                </li>

                <li class="menu-item">
                <a href="javascript:void(0);" class="menu-link menu-toggle">
                    <div data-i18n="Analytics">Grade 12 Sections</div>
                </a>
                      <ul class="menu-sub">

                      <li class="menu-item <?= set_active('St_Agatha_Sicily'); ?>">
                  <a href="<?= base_url('St_Agatha_Sicily') ?>" class="menu-link">
                    <div data-i18n="Analytics">St. Agatha Sicily</div>
                  </a>
                </li>

                <li class="menu-item <?= set_active('St_Scholastica'); ?>">
                  <a href="<?= base_url('St_Scholastica') ?>" class="menu-link">
                    <div data-i18n="Analytics">St. Scholastica</div>
                  </a>
                </li>

                      </ul>
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
