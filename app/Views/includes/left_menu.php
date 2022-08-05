<div class="sidebar sidebar-off">
    <?php
    $user = $login_user->id;
    $dashboard_link = get_uri("dashboard");
    $user_dashboard = get_setting("user_" . $user . "_dashboard");
    if ($user_dashboard) {
        $dashboard_link = get_uri("dashboard/view/" . $user_dashboard);
    }
    ?>
    <a class="sidebar-toggle-btn hide" href="#">
        <i data-feather="menu" class="icon mt-1 text-off"></i>
    </a>

    <a class="sidebar-brand brand-logo" href="<?php echo $dashboard_link; ?>"><img class="dashboard-image"
            src="<?php echo get_logo_url(); ?>" /></a>
    <a class="sidebar-brand brand-logo-mini" href="<?php echo $dashboard_link; ?>"><img class="dashboard-image"
            src="<?php echo get_favicon_url(); ?>" /></a>

    <div class="sidebar-scroll">
        <ul id="sidebar-menu" class="sidebar-menu">
            <?php
            if (!$is_preview) {
                $sidebar_menu = get_active_menu($sidebar_menu);
            }

            foreach ($sidebar_menu as $main_menu) {
                if (isset($main_menu["name"])) {
                    $submenu = get_array_value($main_menu, "submenu");
                    $expend_class = $submenu ? " expand " : "";
                    $active_class = isset($main_menu["is_active_menu"]) ? "active" : "";

                    $submenu_open_class = "";
                    if ($expend_class && $active_class) {
                        $submenu_open_class = " open ";
                    }

                    $badge = get_array_value($main_menu, "badge");
                    $badge_class = get_array_value($main_menu, "badge_class");
                    $target = (isset($main_menu['is_custom_menu_item']) && isset($main_menu['open_in_new_tab']) && $main_menu['open_in_new_tab']) ? "target='_blank'" : "";
                    ?>

            <li class="<?php echo $active_class . " " . $expend_class . " " . $submenu_open_class . " "; ?> main">
                <a <?php echo $target; ?> href="
                    <?php echo isset($main_menu['is_custom_menu_item']) ? $main_menu['url'] : get_uri($main_menu['url']); ?>">
                    <i data-feather="<?php echo ($main_menu['class']); ?>" class="icon"></i>
                    <span
                        class="menu-text <?php echo isset($main_menu['custom_class']) ? $main_menu['custom_class'] : ""; ?>">
                        <?php echo isset($main_menu['is_custom_menu_item']) ? $main_menu['name'] : app_lang($main_menu['name']); ?>
                    </span>
                    <?php
                            if ($badge) {
                                echo "<span class='badge rounded-pill $badge_class'>$badge</span>";
                            }
                            ?>
                </a>
                <?php
                        if ($submenu) {
                            echo "<ul>";
                            foreach ($submenu as $s_menu) {
                                if (isset($s_menu['name'])) {
                                    $sub_menu_target = (isset($s_menu['is_custom_menu_item']) && isset($s_menu['open_in_new_tab']) && $s_menu['open_in_new_tab']) ? "target='_blank'" : "";
                                    ?>
            <li>
                <a <?php echo $sub_menu_target; ?> href="
                    <?php echo isset($s_menu['is_custom_menu_item']) ? $s_menu['url'] : get_uri($s_menu['url']); ?>">
                    <i data-feather='minus' width='12'></i>
                    <span>
                        <?php echo isset($s_menu['is_custom_menu_item']) ? $s_menu['name'] : app_lang($s_menu['name']); ?>
                    </span>
                </a>
            </li>
            <?php
                            }
                        }
                        echo "</ul>";
                    }
                    ?>
            </li>
            <?php
                }
            }
           if($login_user->is_admin==1){

            ?>

            <li class="    main">
                <a href="#" title="Lista de asignacion" data-act="ajax-modal" data-title="Lista de asignacion"
                    data-action-url="team_members/assign">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                        class="feather feather-users icon">
                        <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                        <circle cx="9" cy="7" r="4"></circle>
                        <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                        <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                    </svg>
                    <span class="menu-text ">Lista de asginaci&oacute;n</span>
                </a>
            </li>

            <?php
             }
            ?>
           <!-- <li class="expand main">
                <a href="#">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-mail icon"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline></svg>
                        <circle data-name="layer2" cx="31" cy="32" r="14" fill="none" stroke="#fff"
                            stroke-miterlimit="10" stroke-width="2" stroke-linejoin="round" stroke-linecap="round">
                        </circle>
                        <path data-name="layer1" d="M45 18v20c0 10.9 17 12.3 17-6M46 58.5A30 30 0 1 1 62 32" fill="none"
                            stroke="#fff" stroke-miterlimit="10" stroke-width="2" stroke-linejoin="round"
                            stroke-linecap="round"></path>
                    </svg>
                    <span class="menu-text ">Correos</span>
                </a>
                <ul>
                    <li>
                    <a href="email_templates/send_mail" title="Enviar correo eléctronico" data-title="Enviar correo eléctronico">
                            <svg xmlns="http://www.w3.org/2000/svg" width="12" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="feather feather-minus">
                                <line x1="5" y1="12" x2="19" y2="12"></line>
                            </svg>
                            <span>Enviar correo</span>
                        </a>
                    </li>
                    <li>
                    <a href="email_templates/templates" title="Editar plantillas de correo" data-title="Editar plantillas de correo">
                            <svg xmlns="http://www.w3.org/2000/svg" width="12" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="feather feather-minus">
                                <line x1="5" y1="12" x2="19" y2="12"></line>
                            </svg>
                            <span>Editor de plantillas</span>
                        </a>
                    </li>
                </ul>
            </li>
            -->

            <li class="    main">
                <a href="#" title="Sincronización con formularios de facebook" data-act="ajax-modal"
                    data-title="Sincronización con formularios de facebook" data-action-url="facebook/sync">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                        class="bi bi-facebook" viewBox="0 0 16 16">
                        <path
                            d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951z" />
                    </svg><span class="menu-text ">Sincronizar con facebook</span>
                </a>
            </li>


            <!-- <li class="    main">
                            <a href="#" title="Editar plantillas de correo"  data-title="Editar plantillas de correo" data-action-url="email_templates">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-users icon"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
                                <span class="menu-text ">Editor de plantillas de correo</span>
                            </a>
                    </li> -->
        </ul>
    </div>
</div><!-- sidebar menu end -->