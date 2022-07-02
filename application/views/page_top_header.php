<div class="topbar">
    <!-- LOGO -->
    <div class="topbar-left">
        <a href="index.html" class="logo">
            <span>
                <img src="<?php echo base_url().'assets/images/logo.png'?>" style='max-height: 70px;max-width: 170px;height: auto;'>
            </span>
            <i>
                <img src="<?php echo base_url().'assets/images/logo_sm.png'?>" style='max-height: 70px;max-width: 170px;height: 40px;'>
            </i>
        </a>
    </div>

    <nav class="navbar-custom">

        <ul class="list-inline float-right mb-0">
            <li class="list-inline-item dropdown notification-list">
                <a class="nav-link dropdown-toggle arrow-none waves-light waves-effect" href="<?php echo base_url().'s_scan_qr_controller/index'?>" role="button"
                   aria-haspopup="false" aria-expanded="false">
                    <i class="fa fa-qrcode noti-icon"></i>
                </a>

                <a class="nav-link dropdown-toggle arrow-none waves-light waves-effect" data-toggle="dropdown" href="#" role="button"
                   aria-haspopup="false" aria-expanded="false">
                    <i class="dripicons-bell noti-icon"></i>
                    <span class="badge badge-pink noti-icon-badge">4</span>
                </a>
                <div class="dropdown-menu dropdown-menu-right dropdown-arrow dropdown-lg" aria-labelledby="Preview">
                    <!-- item-->
                    <div class="dropdown-item noti-title">
                        <h5><span class="badge badge-danger float-right">5</span>Notification</h5>
                    </div>

                    <!-- item-->
                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                        <div class="notify-icon bg-success"><i class="icon-bubble"></i></div>
                        <p class="notify-details">Robert S. Taylor commented on Admin<small class="text-muted">1 min ago</small></p>
                    </a>

                    <!-- item-->
                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                        <div class="notify-icon bg-info"><i class="icon-user"></i></div>
                        <p class="notify-details">New user registered.<small class="text-muted">1 min ago</small></p>
                    </a>

                    <!-- item-->
                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                        <div class="notify-icon bg-danger"><i class="icon-like"></i></div>
                        <p class="notify-details">Carlos Crouch liked <b>Admin</b><small class="text-muted">1 min ago</small></p>
                    </a>

                    <!-- All-->
                    <a href="javascript:void(0);" class="dropdown-item notify-item notify-all">
                        View All
                    </a>

                </div>
            </li>

            <li class="list-inline-item dropdown notification-list">
                <a class="nav-link dropdown-toggle waves-effect waves-light nav-user" data-toggle="dropdown" href="#" role="button"
                   aria-haspopup="false" aria-expanded="false">
                    <img src="<?php echo base_url().'assets/images/admin.png'?>" alt="user" class="rounded-circle">
                </a>
                <div class="dropdown-menu dropdown-menu-right profile-dropdown " aria-labelledby="Preview">
                    <!-- item-->
                    <div class="dropdown-item noti-title">
                        <h5 class="text-overflow"><small>Welcome ! <?php echo $_SESSION['employee_sort_name'] ?></small> </h5>
                    </div>
                    <?php
                        foreach ($hak_akses['m_feature_top'] as $key => $value) 
                        {
                            echo "<a href='".base_url().$value->m_feature_url."' class='dropdown-item notify-item'>
                                    <i class='".$value->m_feature_icon."'></i> <span>".$value->m_feature_name."</span>
                                </a>";
                        }
                    ?>
                    <!-- item-->
                </div>
            </li>

        </ul>

        <ul class="list-inline menu-left mb-0">
            <li class="float-left">
                <button class="button-menu-mobile open-left waves-light waves-effect">
                    <i class="dripicons-menu"></i>
                </button>
            </li>
            <li class="hide-phone app-search">
                <form role="search" class="">
                    <input type="text" placeholder="Search..." class="form-control">
                    <a href=""><i class="fa fa-search"></i></a>
                </form>
            </li>
        </ul>
    </nav>
</div>