<div class="position-relative">
    <div class="sidebar__content" id="sidebar-content">
        <!-- brand and navigations -->
        <div>
            <!-- brand -->
            <div class="sidebar__content-brand">
                <a href="#" class="d-flex align-items-center">
                    <img src="/assets/img/undip-logo-color.png" alt="logo-undip" />
                    <h4>SIPMPP UNDIP</h4>
                </a>
            </div>

            <!-- navigation -->
            <div class="sidebar__content-nav">
                <ul class="sidebar-nav__list">
                    <!-- dashboard -->
                    <li>
                        <a href="/" class="nav__list__link <?php if ($tab == "home") : echo 'active';
                                                            endif; ?>">
                            <i class="fa-solid fa-house"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>
                    <!-- data induk -->
                    <li>
                        <a href="/home/datainduk" class="nav__list__link <?php if ($tab == "induk") : echo 'active';
                                                                            endif; ?>">
                            <i class="fa-solid fa-book"></i>
                            <span>Data Induk</span>
                        </a>
                    </li>
                    <!-- Nilai SPMI -->
                    <li>
                        <a href="/home/standar" class="nav__list__link <?php if ($tab == "standar") : echo 'active';
                                                                        endif; ?>">
                            <i class="fa-solid fa-chart-bar"></i>
                            <span>Nilai SPMI</span>
                        </a>
                    </li>
                    <!-- report -->
                    <li>
                        <a href="/home/report" class="nav__list__link <?php if ($tab == "report") : echo 'active';
                                                                        endif; ?>">
                            <i class="fa-solid fa-print"></i>
                            <span>Report</span>
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
            <p class="mb-4">@sipmppundip . 2019</p>
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