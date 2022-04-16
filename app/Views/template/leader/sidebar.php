<div class="position-relative">
    <div class="sidebar__content" id="sidebar-content">
        <!-- brand and navigations -->
        <div>
            <!-- brand -->
            <div class="sidebar__content-brand">
                <a href="/leader/index" class="d-flex align-items-center">
                    <img src="/leader/assets/img/undip-logo-color.png" alt="logo-undip" />
                    <h4>SIPMPP UNDIP</h4>
                </a>
            </div>

            <!-- navigation -->
            <div class="sidebar__content-nav">
                <ul class="sidebar-nav__list">
                    <!-- dashboard -->
                    <li>
                        <a href="/leader/index" class="nav__list__link <?php if ($tab == "home") : echo 'active';
                                                                        endif; ?>">
                            <i class="fa-solid fa-house"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>
                    <!-- unit -->
                    <li>
                        <a href="/leader/units" class="nav__list__link <?php if ($tab == "units") : echo 'active';
                                                                        endif; ?>">
                            <i class="fa-solid fa-building-columns"></i>
                            <span>Unit</span>
                        </a>
                    </li>
                    <!-- logout -->
                    <li>
                        <a href="/logout" class="nav__list__link">
                            <i class="fa-solid fa-arrow-right-from-bracket"></i>
                            <span>Log Out</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>

        <!-- footer sidebar -->
        <div class="sidebar__content-footer">
            <p class="mb-4">@leader.sipmppundip . <span id="sidebarfooterYearNow"></p>
            <p>
                Sistem Informasi Penjaminan Mutu Penelitian dan Pengabdian
                Universitas Diponegoro
            </p>
        </div>
        <div class="sidebar__content-footer-icon">
            <div>
                <i class="fa-solid fa-circle-info"></i>
            </div>
        </div>
    </div>
</div>