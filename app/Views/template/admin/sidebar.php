<div class="position-relative">
    <div class="sidebar__content" id="sidebar-content">
        <!-- brand and navigations -->
        <div>
            <!-- brand -->
            <div class="sidebar__content-brand">
                <a href="/admin/index" class="d-flex align-items-center">
                    <img src="/admin/assets/img/undip-logo-color.png" alt="logo-undip" />
                    <h4>SIPMPP UNDIP</h4>
                </a>
            </div>

            <!-- navigation -->
            <div class="sidebar__content-nav">
                <ul class="sidebar-nav__list">
                    <!-- dashboard -->
                    <li>
                        <a href="/admin/index" class="nav__list__link <?php if ($tab == "home") : echo 'active';
                                                                        endif; ?>">
                            <i class="fa-solid fa-house"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>
                    <!-- user -->
                    <li>
                        <a class="nav__list__link-dropdown <?php if ($tab == "user") : echo 'active';
                                                            endif; ?>" data-bs-toggle="collapse" href="#user-collapse" role="button" aria-expanded="false" aria-controls="user-collapse">
                            <div class="link-dropdown__sidebar">
                                <i class="fa-solid fa-id-card-clip"></i>
                                <span>User</span>
                            </div>
                            <i class="fa-solid fa-chevron-down"></i>
                        </a>

                        <!-- dropdown -->
                        <div class="collapse collapse__dropside" id="user-collapse">
                            <ul class="sidebar-nav__list-collapse">
                                <li>
                                    <a href="/admin/daftarUser" class="nav__list__link-collapse ellipsis__text">Daftar User</a>
                                </li>
                                <li>
                                    <a href="/admin/user" class="nav__list__link-collapse ellipsis__text">Base
                                        User</a>
                                </li>
                                <li>
                                    <a href="/admin/auditor" class="nav__list__link-collapse ellipsis__text">Auditor</a>
                                </li>
                                <li>
                                    <a href="/admin/leader" class="nav__list__link-collapse ellipsis__text">Leader</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <!-- unit -->
                    <li>
                        <a href="/admin/units" class="nav__list__link <?php if ($tab == "unit") : echo 'active';
                                                                        endif; ?>">
                            <i class="fa-solid fa-building-columns"></i>
                            <span>Unit</span>
                        </a>
                    </li>
                    <!-- kategori -->
                    <li>
                        <a href="/admin/kategori" class="nav__list__link <?php if ($tab == "kategori") : echo 'active';
                                                                            endif; ?>">
                            <i class="fa-solid fa-list-alt"></i>
                            <span>Kategori</span>
                        </a>
                        <!-- data induk -->
                    <li>
                        <a href="/admin/dataInduk" class="nav__list__link <?php if ($tab == "induk") : echo 'active';
                                                                            endif; ?>">
                            <i class="fa-solid fa-book"></i>
                            <span>Data Induk</span>
                        </a>
                    </li>
                    <!-- standar -->
                    <li>
                        <a href="/admin/standar" class="nav__list__link <?php if ($tab == "standar") : echo 'active';
                                                                        endif; ?>">
                            <i class="fa-solid fa-chart-pie"></i>
                            <span>Standar</span>
                        </a>
                    </li>
                    <!-- penilaian -->
                    <li>
                        <a href="/admin/penilaian" class="nav__list__link <?php if ($tab == "penilaian") : echo 'active';
                                                                            endif; ?>">
                            <i class="fa-solid fa-chart-bar"></i>
                            <span>Penilaian</span>
                        </a>
                        <!-- report -->
                    <li>
                        <a href="/admin/report" class="nav__list__link <?php if ($tab == "report") : echo 'active';
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
            <p class="mb-4">@admin.sipmppundip . 2019</p>
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