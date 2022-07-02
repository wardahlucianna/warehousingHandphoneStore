<!-- jQuery  -->
<script src="<?php echo base_url().'assets/js/modernizr.min.js'?>"></script>
<script src="<?php echo base_url().'assets/js/popper.min.js'?>"></script>
<script src="<?php echo base_url().'assets/js/bootstrap.min.js'?>"></script>
<script src="<?php echo base_url().'assets/js/metisMenu.min.js'?>"></script>
<script src="<?php echo base_url().'assets/js/waves.js'?>"></script>
<script src="<?php echo base_url().'assets/js/jquery.slimscroll.js'?>"></script>

<!-- Parsley js -->
<script src="<?php echo base_url().'assets/js/plugins/parsleyjs/parsley.min.js'?>"></script>

<!-- App js -->
<script src="<?php echo base_url().'assets/js/jquery.core.js'?>"></script>
<script src="<?php echo base_url().'assets/js/jquery.app.js'?>"></script>

<script type="text/javascript">
    $(document).ready(function() {
        $('form').parsley();
    });

    function msg_warning(msg_content,type = ""){
    	$.alert({
            title: 'Warning',
            content: msg_content,
            icon: 'fa fa-warning',
            animation: 'scale',
            closeAnimation: 'scale',
            buttons: {
                okay: {
                    text: 'OK',
                    btnClass: 'btn-blue',
                    action: function () {
                    	if(type=="reload_table_master"){
                    		table_display();
                    	}
                        else if(type=="reload_form_login"){
                            window.location.href = "<?php echo base_url().'s_login_controller/index'?>";
                        }
                        else if(type=="scan_barcode"){
                            window.location.href = "<?php echo base_url().'s_scan_qr_controller/index'?>";   
                        }
                        
                    }
                }
            }
        });
    }
</script>

