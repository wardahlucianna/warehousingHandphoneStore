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

            <div class="row">
                <div class="col-lg-12">
                    <div class="card-box" id="table_area">
                        <div class="col-md-6">
                        </div>
                        <div class="col-md-6">
                        </div>
                        <div class="form-group row">
                            <h4 class="col-lg-10 col-md-9"><span id="table_area_title">Data</span> <?php echo $form_title ?></h4>
                            <div class='col-lg-2 col-md-3'>
                                <a class="dropdown-item notify-item text-danger" onclick='insert_display()' id = 'btn_add'>
                                    <i class="fa fa-plus"></i> <span>Add Data</span>
                                </a>
                            </div>    
                        </div>
                        <hr>
                        <div id = "table_area_content">

                        </div>
                    </div>

                    <div class="card-box" id="insert_area">
                        <div class="col-md-6">
                        </div>
                        <div class="col-md-6">
                        </div>
                        <div class="form-group row">
                            <h4 class="col-lg-10 col-md-9">Add <?php echo $form_title ?></h4>
                            <div class='col-lg-2 col-md-3'></div>    
                        </div>
                        <hr>

                        <form role="form" id="insert_area_form">
                            <div id ="insert_area_content">
                            </div>
                            <hr>
                            <div class="form-group text-right">
                                <div class="form-group">
                                    <button type="button" class="btn btn-primary btn-sm" id="insert_button" onclick="send_insert_data()">
                                        <i class="fa fa-save"></i> Save
                                    </button>
                                    <button type="button" class="btn btn-primary btn-sm" onclick="table_display()">
                                        <i class="fa fa-times"></i> Cancel
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>

                    <div class="card-box" id="edit_area">
                        <div class="col-md-6">
                        </div>
                        <div class="col-md-6">
                        </div>
                        <div class="form-group row">
                            <h4 class="col-lg-10 col-md-9"><span id="edit_area_title">Update Data</span> <?php echo $form_title ?></h4>
                            <div class='col-lg-2 col-md-3'></div>    
                        </div>
                        <hr>

                        <form role="form" id="edit_area_form">
                            <div id = "edit_area_content">
                            </div>
                            <hr>
                            <div class="form-group text-right">
                                <div class="form-group">
                                    <button type="button" class="btn btn-primary btn-sm" onclick="send_edit_data()" id="btn_edit">
                                        <i class="fa fa-save"></i> Save
                                    </button>    
                                    <button type="button" class="btn btn-primary btn-sm" onclick="table_display()" id="btn_edit_cancel">
                                        <i class="fa fa-times"></i> Cancel
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>

                    <div class="card-box" id="detail_area">
                        <div class="col-md-6">
                        </div>
                        <div class="col-md-6">
                        </div>
                        <div class="form-group row">
                            <h4 class="col-lg-10 col-md-9"><span id="edit_area_title">Detail Data</span> <?php echo $form_title ?></h4>
                            <div class='col-lg-2 col-md-3'></div>    
                        </div>
                        <hr>

                        <form role="form" id="detail_area_form">
                            <div id = "detail_area_content">
                            </div>
                            <hr>
                            <div class="form-group text-right">
                                <div class="form-group">
                                    <button type="button" class="btn btn-primary btn-sm" onclick="table_display()" id="btn_edit_cancel">
                                        <i class="fa fa-times"></i> Cancel
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>

                    <div class="card-box" id="report_filter_area">
                        <div class="col-md-6">
                        </div>
                        <div class="col-md-6">
                        </div>
                        <div class="form-group row">
                            <h4 class="col-lg-10 col-md-9"><span id="report_filter_area_title">Search </span><?php echo $form_title ?></h4>
                            <div class='col-lg-2 col-md-3'></div>    
                        </div>
                        <hr>

                        <form role="form" id="report_filter_area_form">
                            <div id = "report_filter_area_content">
                            </div>
                            <hr>
                            <div class="form-group text-right">
                                <div class="form-group">
                                    <button type="button" class="btn btn-primary btn-sm" onclick="display_report()" id="btn_search">
                                        <i class="fa fa-search"></i> Search
                                    </button>    
                                </div>
                            </div>
                        </form>
                    </div>

                    <div class="card-box" id="report_area">
                        <div class="col-md-6">
                        </div>
                        <div class="col-md-6">
                        </div>
                        <div class="form-group row">
                            <h4 class="col-lg-10 col-md-9"><span id="report_area_title">Data </span><?php echo $form_title ?></h4>
                            <div class='col-lg-2 col-md-3'></div>    
                        </div>
                        <hr>

                        <form role="form" id="report_area_form" method="POST" action="<?php echo $path.'/report_pdf'?>" target="_blank">
                            <div class="form-group text-right">
                                <div class="form-group" id="btn_report">
                                    <button type="submit" class="btn btn-primary btn-sm" name="btn_print">
                                        <i class="fa fa-print"></i> Print
                                    </button>    
                                </div>
                            </div>
                            <div id = "report_area_content">
                            </div>
                            <hr>
                            <div class="form-group text-right">
                                <div class="form-group">
                                    <button type="button" class="btn btn-primary btn-sm" onclick="display_filter_report()" id="btn_report_cancel">
                                        <i class="fa fa-times"></i> Cancel
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div> <!-- end col -->
            </div>
            <!-- end row -->

        </div> <!-- container -->
    </div> <!-- content -->
    <footer class="footer text-right">
        2019 © PT. Mitra Cakrawala International
    </footer>

</div>

<script type="text/javascript">
    table_display();
    function table_display() {
        reset_form()
        $("#table_area").css("display", "block");
        $("#insert_area").css("display", "none");
        $("#edit_area").css("display", "none");
        $("#report_filter_area").css("display", "none");
        $("#report_area").css("display", "none");
        $("#detail_area").css("display", "none");
        
        $('#table_area_content').load("<?php echo $path; ?>"+"/template?aksi=table_master&group_title=<?php echo $group_title; ?>&file_title=<?php echo $file_title; ?>");
    }

    function dashboard_display() {
        reset_form()
        $("#table_area").css("display", "none");
        $("#insert_area").css("display", "none");
        $("#edit_area").css("display", "none");
        $("#report_filter_area").css("display", "none");
        $("#report_area").css("display", "none");
        $("#detail_area").css("display", "none");
        
        //$('#table_area_content').load("<?php echo $path; ?>"+"/template?aksi=table_master&group_title=<?php echo $group_title; ?>&file_title=<?php echo $file_title; ?>");
    }

    function insert_display() {
        reset_form()
        $("#insert_area").css("display", "block");
        $("#table_area").css("display", "none");
        $("#edit_area").css("display", "none");
        $("#report_filter_area").css("display", "none");
        $("#report_area").css("display", "none");
        $("#detail_area").css("display", "none");

        $('#insert_area_content').load("<?php echo $path; ?>"+"/template?aksi=insert_handler&group_title=<?php echo $group_title; ?>&file_title=<?php echo $file_title; ?>");
    }

    function edit_display(id) {
        reset_form()
        $("#edit_area").css("display", "block");
        $("#table_area").css("display", "none");
        $("#insert_area").css("display", "none");
        $("#report_filter_area").css("display", "none");
        $("#report_area").css("display", "none");
        $("#detail_area").css("display", "none");

        $('#edit_area_content').load("<?php echo $path; ?>"+"/template?aksi=edit_handler&group_title=<?php echo $group_title; ?>&file_title=<?php echo $file_title; ?>&id="+id);
    }

    function display_filter_report() {
        reset_form()
        $("#report_filter_area").css("display", "block");
        $("#table_area").css("display", "none");
        $("#insert_area").css("display", "none");
        $("#edit_area").css("display", "none");
        $("#report_area").css("display", "none");
        $("#detail_area").css("display", "none");

        $('#report_filter_area_content').load("<?php echo $path; ?>"+"/template?aksi=filter_report&group_title=<?php echo $group_title; ?>&file_title=<?php echo $file_title; ?>");

    }

    function display_report() {
        $("#report_area").css("display", "block");
        $("#table_area").css("display", "none");
        $("#insert_area").css("display", "none");
        $("#edit_area").css("display", "none");
        $("#report_filter_area").css("display", "none");
        $("#detail_area").css("display", "none");

        var form_data = $('#report_filter_area_form').serialize();
        $('#report_area_content').load("<?php echo $path; ?>"+"/template?aksi=report&group_title=<?php echo $group_title; ?>&file_title=<?php echo $file_title; ?>",form_data);
    }

    function detail_display(id) {
        reset_form()
        $("#edit_area").css("display", "none");
        $("#table_area").css("display", "none");
        $("#insert_area").css("display", "none");
        $("#report_filter_area").css("display", "none");
        $("#report_area").css("display", "none");
        $("#detail_area").css("display", "block");

        $('#detail_area_content').load("<?php echo $path; ?>"+"/template?aksi=detail_handler&group_title=<?php echo $group_title; ?>&file_title=<?php echo $file_title; ?>&id="+id);
    }

    function scan_display(code) {
        reset_form()
        var form = "<?php echo $form_title ?>";
        if(form == "Scan QR Code"){
            code = "<?php echo $data ?>";
        }
        
        $("#edit_area").css("display", "block");
        $("#table_area").css("display", "none");
        $("#insert_area").css("display", "none");
        $("#report_filter_area").css("display", "none");
        $("#report_area").css("display", "none");

        $('#edit_area_content').load("<?php echo $path; ?>"+"/template?aksi=edit_handler&group_title=<?php echo $group_title; ?>&file_title=<?php echo $file_title; ?>&id="+code);
    }

    function reset_form(){
        $('#table_area_content').html("");
        $('#insert_area_content').html("");
        $('#insert_area_content').html("");
        $('#edit_area_content').html("");
        $('#report_filter_area_content').html("");
        $('#report_area_content').html("");
    }

    function send_insert_data(){
        invalid = form_validation("insert_area_form");
        if(invalid==false){
            $('body').loading({theme: 'dark'});
            var form = $('#insert_area_form').get(0);
            var form_data = new FormData(form);

            $.ajax({
                url: '<?php echo $path."/save" ?>',
                type: 'post',
                dataType: 'json',
                data: form_data,
                contentType: false,
                processData: false
            }).done(function (result) {
                if(result.status=="succsess"){
                    msg_warning(result.msg,"reload_table_master")
                }
                else{
                    msg_warning(result.msg)
                }
                $('#ModalSave').modal('hide'); 
                $('body').loading('stop');
            }).fail(function (xhr, status, error) {
                msg_warning("process failed","")
                $('body').loading('stop');
            })
        }
    }

    function send_edit_data(){
        invalid = form_validation("edit_area_form");
        
        if(invalid==false){
            $('body').loading({theme: 'dark'});
            var form = $('#edit_area_form').get(0);
            var form_data = new FormData(form);

            $.ajax({
                url: '<?php echo $path."/save" ?>',
                type: 'post',
                dataType: 'json',
                data: form_data,
                contentType: false,
                processData: false
            }).done(function (result) {
                if(result.status=="succsess"){
                    msg_warning(result.msg,"reload_table_master")
                }
                else{
                    msg_warning(result.msg)
                }
                $('body').loading('stop');
            }).fail(function (xhr, status, error) {
                msg_warning("process failed","")
                $('body').loading('stop');
            })
        }
    }
    

    function send_delete_data(id){
        $.confirm({
            title: 'Warning',
            content: 'Do you want delete?',
            icon: 'fa fa-warning',
            animation: 'scale',
            closeAnimation: 'scale',
            opacity: 0.5,
            buttons: {
                'confirm': {
                    text: 'Yes',
                    btnClass: 'btn-blue',
                    action: function () {
                        $.ajax({
                            url: "<?php echo $path; ?>"+"/delete?id="+id, 
                            type: 'post',
                            dataType: 'json',
                            contentType: false,
                            processData: false
                        }).done(function (result) {
                            if(result.status=="failed"){
                                msg_warning(result.msg)
                            }
                            else{
                                msg_warning(result.msg,"reload_table_master")
                            }
                        }).fail(function (xhr, status, error) {
                            msg_warning("process failed","")
                        })
                    }
                },
                cancel: function () {
                    
                },
            }
        });
    }

    function send_edit_password(){
        invalid = form_validation("edit_area_form");
        
        if(invalid==false){
            $('body').loading({theme: 'dark'});
            var form = $('#edit_area_form').get(0);
            var form_data = new FormData(form);

            $.ajax({
                url: '<?php echo $path."/save" ?>',
                type: 'post',
                dataType: 'json',
                data: form_data,
                contentType: false,
                processData: false
            }).done(function (result) {
                if(result.status=="succsess"){
                    msg_warning(result.msg,"reload_form_login")
                }
                else{
                    msg_warning(result.msg)
                }
                $('body').loading('stop');
            }).fail(function (xhr, status, error) {
                msg_warning("process failed","")
                $('body').loading('stop');
            })
        }
    }

    function send_search_data(){
        invalid = form_validation("report_filter_area_form");
        
        if(invalid==false){
            $('body').loading({theme: 'dark'});
            var form = $('#edit_area_form').get(0);
            var form_data = new FormData(form);

            $.ajax({
                url: '<?php echo $path."/search_data" ?>',
                type: 'post',
                dataType: 'json',
                data: form_data,
                contentType: false,
                processData: false
            }).done(function (result) {


                $('body').loading('stop');
            }).fail(function (xhr, status, error) {
                msg_warning("process failed","")
                $('body').loading('stop');
            })
        }
    }
</script>