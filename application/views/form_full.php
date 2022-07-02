<?php 
    ini_set('display_errors','off');
?>


<!DOCTYPE html>
<html>
    <head>
        <?php $this->load->view('page_header'); ?>
    </head>
    <body>
        
        <!-- Begin page -->
        <div id="wrapper">
            <!-- Top Bar Start -->
                <?php $this->load->view('page_top_header'); ?>
            <!-- Top Bar End -->

            <!-- ========== Left Sidebar Start ========== -->
                <?php $this->load->view('page_left_navigator'); ?>
            <!-- Left Sidebar End -->

            <!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->
                <?php $this->load->view('page_content'); ?>
            <!-- ============================================================== -->
            <!-- End Right content here -->
            <!-- ============================================================== -->

        </div>
        <!-- END wrapper -->
        <?php $this->load->view('page_footer'); ?>
    </body>
</html>
