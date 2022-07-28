<div class="content-page">
    <!-- Start content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <h4 class="page-title float-left"><?php echo $form_title ?></h4>

                        <ol class="breadcrumb float-right">
                            <li class="breadcrumb-item"><?php echo $group_title ?></li>
                            <li class="breadcrumb-item"><?php echo $form_title ?></li>
                        </ol>

                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
            <!-- end row -->
            <div id='load_dashboard'></div>
            <div class="row">
                <div class="col-lg-6 col-md-12">
                    <div class="card-box" id="count_all_product_area">
                        <div class="pb-1">
                            <div class="clearfix mb-1">
                                <span class="text-muted" style="font-size: 30px;">Total Product</span>
                                <span id="total_all_product" class="font-large-2 text-bold-300 info float-right" style="font-size: 30px;">0</span>
                            </div>
                            <div class="clearfix">
                                <i class="fa fa-arrow-up font-large-1 blue-grey float-left mt-1" style="color:#00000000;font-size: 25px;"></i>
                                <span class="info float-right" style="color:#00000000;font-size: 25px;"><i class="ft-arrow-up info"></i>0</span>
                            </div>
                        </div>
                        <div class="progress mb-0" style="height: 7px;background-color: transparent;">
                            <div class="progress-bar bg-info" role="progressbar" style="width: 100%;background-color: transparent !important;" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-12">
                    <div class="card-box" id="count_stoct_in_area">
                        <div class="pb-1">
                            <div class="clearfix mb-1">
                                <span class="text-muted" style="font-size: 30px;">Total Stoct Out</span>
                                <span id="total_stoct_in" class="font-large-2 text-bold-300 info float-right" style="font-size: 30px;">0</span>
                            </div>
                            <div class="clearfix">
                                <i class="fa fa-arrow-up" id="icon_stoct_in" style="font-size: 25px;"></i>
                                <span class="info float-right" id="persen_stoct_in" style="font-size: 25px;"><i class="ft-arrow-up info" ></i> 16.89%</span>
                            </div>
                        </div>
                        <div class="progress mb-0" style="height: 7px;">
                            <div class="progress-bar bg-info" role="progressbar"  aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" id="progressbar_stoct_in"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6 col-md-12">
                    <div class="card-box" id="table_area">
                        <div class="form-group row">
                            <span class="text-muted" style="font-size: 30px;">Stock Below Limit</span>
                        </div>
                        <hr>
                        <div id = "table_area_content">

                        </div>
                    </div>
                </div>

                <div class="col-lg-6 col-md-12">
                    <div class="card-box" id="table_summary_area">
                        <div class="col-md-6">
                        </div>
                        <div class="col-md-6">
                        </div>
                        <div class="form-group row">
                            <span class="text-muted" style="font-size: 30px;">Summary Product</span>
                        </div>
                        <hr>
                        <div id = "table_summary_area_content">

                        </div>
                    </div>
                </div>
            </div>
            <!-- end row -->

        </div> <!-- container -->
    </div> <!-- content -->
    <footer class="footer text-right">
        2022 © Dmax asia
    </footer>

</div>

<script type="text/javascript">
   


    dashboard_display();
    function dashboard_display() {
        $('#table_area_content').load("<?php echo $path; ?>"+"/template?aksi=total_all_product&group_title=<?php echo $group_title; ?>&file_title=<?php echo $file_title; ?>");

        $('#table_summary_area_content').load("<?php echo $path; ?>"+"/template?aksi=summary_product&group_title=<?php echo $group_title; ?>&file_title=<?php echo $file_title; ?>");
    }

  

  
</script>