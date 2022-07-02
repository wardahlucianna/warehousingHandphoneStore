<div class="left side-menu">
    <div class="slimscroll-menu" id="remove-scroll">
        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu" id="side-menu">
                <?php
                    if($form_title!="Change Password"){
                        echo "<li><a href='".base_url()."h_home_controller/index'><i class='fa fa-home'></i><span> Home </span></a>
                            </li>";

                        foreach ($hak_akses['m_feature_group'] as $key => $value) {
                            echo "<li id = 'group_feature_".$value->m_feature_group_id."'><a href='javascript: void(0);'><i class='".$value->m_feature_group_icon."'></i><span> ".$value->m_feature_group_name." </span></a>
                            </li>";
                        }

                        $id_lama = 0;
                        foreach ($hak_akses['m_feature_left'] as $key => $value) 
                        {
                            $id_baru = $value->m_feature_group_id;

                            if($id_baru!=$id_lama)
                            {
                                $id_lama = $id_baru;
                                ?>
                                    <script type="text/javascript">
                                        $("#group_feature_"+<?php echo $id_baru ?>).append("<ul class='nav-second-level' aria-expanded=false id='feature_"+<?php echo $id_baru ?>+"''></ul>");
                                    </script>
                                <?php
                            }

                            ?>  
                                <script type="text/javascript">
                                    $("#feature_"+<?php echo $id_baru ?>).append("<li><a href='<?php echo base_url().$value->m_feature_url ?>'><?php echo $value->m_feature_name ?></a></li>");
                                </script>
                            <?php
                        }
                    }
                ?>
            </ul>
        </div>
        <!-- Sidebar -->
    </div>
    <!-- Sidebar -left -->
</div>