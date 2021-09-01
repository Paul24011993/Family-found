<?php

    /* Style sheet */

    function register_style_sheet() {

        enqueue_style('Bootstrap', SERVER_URL . 'assets/css/bootstrap.min.css', '1.0', 'all');
        enqueue_style('all_buttons', SERVER_URL . 'assets/css/buttons.css', '1.0', 'all');
        enqueue_style('adminbag_main_css', SERVER_URL . 'assets/css/animate.css', '1.0', 'all');
        enqueue_style('adminbag_main_css', SERVER_URL . 'assets/css/main.css', '1.0', 'all');
        enqueue_style('aqua_black_theme_css', SERVER_URL . 'assets/css/aqua-black.css', '1.0', 'all');
        enqueue_style('sweetalert2', SERVER_URL . 'assets/css/sweetalert2.css', '1.0', 'all');
        enqueue_style('font-awesome.min', SERVER_URL . 'assets/css/font-awesome.min.css', '1.0', 'all');
        enqueue_style('adminbagdemo', SERVER_URL . 'assets/css/adminbagdemo.css', '1.0', 'all');


        if(is_page('profiles')){
            enqueue_style('buttons_dataTables', SERVER_URL . 'assets/css/buttons.dataTables.min.css', '1.0', 'all');
            enqueue_style('dataTables_bootstrap', SERVER_URL . 'assets/css/dataTables.bootstrap.min.css', '1.0', 'all');
            enqueue_style('responsive_dataTables', SERVER_URL . 'assets/css/responsive.dataTables.min.css', '1.0', 'all');
            enqueue_style('fixedHeader_dataTables', SERVER_URL . 'assets/css/fixedHeader.dataTables.min.css', '1.0', 'all');
        }
        
        if(is_page('users')){
            enqueue_style('buttons_dataTables', SERVER_URL . 'assets/css/buttons.dataTables.min.css', '1.0', 'all');
            enqueue_style('dataTables_bootstrap', SERVER_URL . 'assets/css/dataTables.bootstrap.min.css', '1.0', 'all');
            enqueue_style('responsive_dataTables', SERVER_URL . 'assets/css/responsive.dataTables.min.css', '1.0', 'all');
            enqueue_style('fixedHeader_dataTables', SERVER_URL . 'assets/css/fixedHeader.dataTables.min.css', '1.0', 'all');
        }
        
        if(is_page('updateUser') || is_page('updatePartner') ){
            enqueue_style('dropify', SERVER_URL . 'assets/css/dropify.min.css', '1.0', 'all');
            enqueue_style('select2', SERVER_URL . 'assets/css/select2.min.css', '1.0', 'all');
        }
         
        if(is_page('addUsers') ){
            enqueue_style('select2', SERVER_URL . 'assets/css/select2.min.css', '1.0', 'all');
        }
        
        if(is_page('business')){
            enqueue_style('jquery_slimscroll', SERVER_URL . 'assets/css/jquery.slimscroll.css', '1.0', 'all');
            enqueue_style('profile2', SERVER_URL . 'assets/css/profile2.css', '1.0', 'all');
            enqueue_style('main_media', SERVER_URL . 'assets/css/main.media.css', '1.0', 'all');
        }

        if(is_page('listPartners')){
            enqueue_style('buttons_dataTables', SERVER_URL . 'assets/css/buttons.dataTables.min.css', '1.0', 'all');
            enqueue_style('dataTables_bootstrap', SERVER_URL . 'assets/css/dataTables.bootstrap.min.css', '1.0', 'all');
            enqueue_style('responsive_dataTables', SERVER_URL . 'assets/css/responsive.dataTables.min.css', '1.0', 'all');
            enqueue_style('fixedHeader_dataTables', SERVER_URL . 'assets/css/fixedHeader.dataTables.min.css', '1.0', 'all');
        }
        
        if(is_page('addPartners') ){
            enqueue_style('select2', SERVER_URL . 'assets/css/select2.min.css', '1.0', 'all');
        }

        if(is_page('groupsPartners')){
            //enqueue_style('jquery_orgchart', SERVER_URL . 'assets/css/jquery.orgchart-ok.css', '1.0', 'all');
        }
        
        if(is_page('bankAccount')){
            enqueue_style('select2', SERVER_URL . 'assets/css/select2.min.css', '1.0', 'all');
            enqueue_style('bootstrapValidator', SERVER_URL . 'assets/css/bootstrapValidator.min.css', '1.0', 'all');
            enqueue_style('buttons_dataTables', SERVER_URL . 'assets/css/buttons.dataTables.min.css', '1.0', 'all');
            enqueue_style('dataTables_bootstrap', SERVER_URL . 'assets/css/dataTables.bootstrap.min.css', '1.0', 'all');
            enqueue_style('responsive_dataTables', SERVER_URL . 'assets/css/responsive.dataTables.min.css', '1.0', 'all');
            enqueue_style('fixedHeader_dataTables', SERVER_URL . 'assets/css/fixedHeader.dataTables.min.css', '1.0', 'all');
        }


        enqueue_style('style_fixed', SERVER_URL . 'assets/css/style-fixed.css', '1.0', 'all');
    }

    function register_script() {
        enqueue_script('jquery', SERVER_URL . 'assets/js/vendor/jquery.min.js', '1.0');
        enqueue_script('Bootstrap_js', SERVER_URL . 'assets/js/vendor/bootstrap.min.js', '1.0');
        enqueue_script('function_login', SERVER_URL . 'assets/js/function_login.js', '1.0');
        enqueue_script('sweetalert2', SERVER_URL . 'assets/js/sweetalert2.min.js', '1.0');
        enqueue_script('jquery_mobile', SERVER_URL . 'assets/js/vendor/jquery.mobile.custom.min.js', '1.0');
        enqueue_script('jquery_slimscroll', SERVER_URL . 'assets/js/vendor/jquery.slimscroll.js', '1.0');
        enqueue_script('jquery-key-restrictions', SERVER_URL . 'assets/js/jquery-key-restrictions.js', '1.0');
        enqueue_script('main', SERVER_URL . 'assets/js/main.js', '1.0');
        enqueue_script('adminbagdemo', SERVER_URL . 'assets/js/adminbagdemo.js', '1.0');
        
        if(is_user_logged_in()){
            enqueue_script('select2', SERVER_URL . 'assets/js/vendor/select2.min.js', '1.0');
            enqueue_script('main_function_ajax', SERVER_URL . 'assets/js/main_function_ajax.js', '1.0');
        }

        if(is_page('forgotPassword', true)){
            enqueue_script('forgotPassword', SERVER_URL . 'assets/js/forgotPassword.js', '1.0');
        }

        if(is_page('profiles')){
            enqueue_script('jquery_dataTables', SERVER_URL . 'assets/js/vendor/jquery.dataTables.js', '1.0');
            enqueue_script('dataTables_bootstrap', SERVER_URL . 'assets/js/vendor/dataTables.bootstrap.min.js', '1.0');

            enqueue_script('jquery_dataTables', SERVER_URL . 'assets/js/vendor/dataTables.buttons.min.js', '1.0');
            enqueue_script('jquery_dataTables', SERVER_URL . 'assets/js/vendor/buttons.flash.min.js', '1.0');
            enqueue_script('jquery_dataTables', SERVER_URL . 'assets/js/vendor/jszip.min.js', '1.0');
            enqueue_script('jquery_dataTables', SERVER_URL . 'assets/js/vendor/pdfmake.min.js', '1.0');
            enqueue_script('jquery_dataTables', SERVER_URL . 'assets/js/vendor/buttons.html5.min.js', '1.0');
            enqueue_script('jquery_dataTables', SERVER_URL . 'assets/js/vendor/buttons.print.min.js', '1.0');
            enqueue_script('jquery_dataTables', SERVER_URL . 'assets/js/vendor/dataTables.responsive.min.js', '1.0');
            enqueue_script('jquery_dataTables', SERVER_URL . 'assets/js/vendor/dataTables.fixedHeader.min.js', '1.0');
            
            enqueue_script('moment', SERVER_URL . 'assets/js/vendor/lib/moment.min.js', '1.0');
            enqueue_script('functions_profiles', SERVER_URL . 'assets/js/Profiles/functions_profiles.js', '1.0');
        }
        
        if(is_page('addProfile')){
            enqueue_script('functions_add_profiles', SERVER_URL . 'assets/js/Profiles/functions_add_profiles.js', '1.0');
        }
        
        if(is_page('updateProfile')){
            enqueue_script('functions_update_profiles', SERVER_URL . 'assets/js/Profiles/functions_update_profiles.js', '1.0');
        }
        
        if(is_page('users')){
            enqueue_script('jquery_dataTables', SERVER_URL . 'assets/js/vendor/jquery.dataTables.js', '1.0');
            enqueue_script('dataTables_bootstrap', SERVER_URL . 'assets/js/vendor/dataTables.bootstrap.min.js', '1.0');

            enqueue_script('jquery_dataTables', SERVER_URL . 'assets/js/vendor/dataTables.buttons.min.js', '1.0');
            enqueue_script('jquery_dataTables', SERVER_URL . 'assets/js/vendor/buttons.flash.min.js', '1.0');
            enqueue_script('jquery_dataTables', SERVER_URL . 'assets/js/vendor/jszip.min.js', '1.0');
            enqueue_script('jquery_dataTables', SERVER_URL . 'assets/js/vendor/pdfmake.min.js', '1.0');
            enqueue_script('jquery_dataTables', SERVER_URL . 'assets/js/vendor/buttons.html5.min.js', '1.0');
            enqueue_script('jquery_dataTables', SERVER_URL . 'assets/js/vendor/buttons.print.min.js', '1.0');
            enqueue_script('jquery_dataTables', SERVER_URL . 'assets/js/vendor/dataTables.responsive.min.js', '1.0');
            enqueue_script('jquery_dataTables', SERVER_URL . 'assets/js/vendor/dataTables.fixedHeader.min.js', '1.0');
            
            enqueue_script('moment', SERVER_URL . 'assets/js/vendor/lib/moment.min.js', '1.0');
            enqueue_script('functions_users', SERVER_URL . 'assets/js/Users/functions_users.js', '1.0');
        }
        
        if(is_page('addUsers')){
            enqueue_script('functions_add_users', SERVER_URL . 'assets/js/Users/functions_add_users.js', '1.0');
        }
        
        if(is_page('updateUser')){
            enqueue_script('dropify', SERVER_URL . 'assets/js/dropify.min.js', '1.0');
            enqueue_script('functions_update_users', SERVER_URL . 'assets/js/Users/functions_update_users.js', '1.0');
        }
        
        if(is_page('business')){
            enqueue_script('functions_update_users', SERVER_URL . 'assets/js/Business/functions_business.js', '1.0');
        }
        
        if(is_page('listPartners')){
             enqueue_script('jquery_dataTables', SERVER_URL . 'assets/js/vendor/jquery.dataTables.js', '1.0');
            enqueue_script('dataTables_bootstrap', SERVER_URL . 'assets/js/vendor/dataTables.bootstrap.min.js', '1.0');

            enqueue_script('jquery_dataTables', SERVER_URL . 'assets/js/vendor/dataTables.buttons.min.js', '1.0');
            enqueue_script('jquery_dataTables', SERVER_URL . 'assets/js/vendor/buttons.flash.min.js', '1.0');
            enqueue_script('jquery_dataTables', SERVER_URL . 'assets/js/vendor/jszip.min.js', '1.0');
            enqueue_script('jquery_dataTables', SERVER_URL . 'assets/js/vendor/pdfmake.min.js', '1.0');
            enqueue_script('jquery_dataTables', SERVER_URL . 'assets/js/vendor/buttons.html5.min.js', '1.0');
            enqueue_script('jquery_dataTables', SERVER_URL . 'assets/js/vendor/buttons.print.min.js', '1.0');
            enqueue_script('jquery_dataTables', SERVER_URL . 'assets/js/vendor/dataTables.responsive.min.js', '1.0');
            enqueue_script('jquery_dataTables', SERVER_URL . 'assets/js/vendor/dataTables.fixedHeader.min.js', '1.0');
            
            enqueue_script('moment', SERVER_URL . 'assets/js/vendor/lib/moment.min.js', '1.0');
            enqueue_script('functions_update_users', SERVER_URL . 'assets/js/Partners/functions_partners.js', '1.0');
        }
        
        if(is_page('addPartners')){
            enqueue_script('functions_add_users', SERVER_URL . 'assets/js/Partners/functions_add_partners.js', '1.0');
        }
                        
        if(is_page('updatePartner')){
            enqueue_script('dropify', SERVER_URL . 'assets/js/dropify.min.js', '1.0');
            enqueue_script('functions_update_users', SERVER_URL . 'assets/js/Partners/functions_update_partners.js', '1.0');
        }
                        
        if(is_page('groupsPartners')){
            enqueue_script('jquery_orgchart',  'https://balkangraph.com/js/latest/OrgChart.js', '1.0');
            enqueue_script('functions_group_partners', SERVER_URL . 'assets/js/Partners/functions_group_partners.js', '1.0');
        }
                        
        if(is_page('bankAccount')){
            enqueue_script('functions_group_partners', SERVER_URL . 'assets/js/Partners/functions_bank_account.js', '1.0');
            enqueue_script('bootstrapValidator', SERVER_URL . 'assets/js/bootstrapValidator.min.js', '1.0');
             enqueue_script('jquery_dataTables', SERVER_URL . 'assets/js/vendor/jquery.dataTables.js', '1.0');
            enqueue_script('dataTables_bootstrap', SERVER_URL . 'assets/js/vendor/dataTables.bootstrap.min.js', '1.0');
            enqueue_script('moment', SERVER_URL . 'assets/js/vendor/lib/moment.min.js', '1.0'); 
        }

        
        /*
        enqueue_script('functions_main', SERVER_URL . 'assets/js/functions.js', '1.0');*/
    }

   

