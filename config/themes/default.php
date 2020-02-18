<?php 
/* *******************************
 *
 * Developer by FelipheGomez
 *
 * ******************************/

return [
    'id' => 'app',
    'name' => 'demo',
    'lang' => 'es',
    'charset' => 'utf-8',
    'default' => 'main',
    'assets' => [
        'url' => '/public/assets',
        'includes' => [
            'head' => [
                [
                    'type' => 'stylesheet',
                    'file' => '/vendors/bootstrap/dist/css/bootstrap.min.css', // Bootstrap
                ],
                [
                    'type' => 'stylesheet',
                    'file' => '/vendors/font-awesome/css/font-awesome.min.css', // Font Awesome
                ],
                [
                    'type' => 'stylesheet',
                    'file' => '/vendors/nprogress/nprogress.css', // NProgress
                ],
                [
                    'type' => 'stylesheet',
                    'file' => '/vendors/animate.css/animate.min.css', // Animate.css
                ],
                [
                    'type' => 'stylesheet',
                    #'file' => '/build/css/style.css', // styling plus plugins
                    'file' => '/vendors/bootstrap-wysiwyg/css/style.css', // styling plus plugins
                ],
                [
                    'type' => 'stylesheet',
                    'file' => '/vendors/iCheck/skins/all.css', // End styling plus plugins
                ],
                [
                    'type' => 'stylesheet',
                    'file' => '/vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css', // bootstrap-progressbar
                ],
                [
                    'type' => 'stylesheet',
                    'file' => '/vendors/jqvmap/dist/jqvmap.min.css', // JQVMap
                ],
                [
                    'type' => 'stylesheet',
                    'file' => '/vendors/bootstrap-daterangepicker/daterangepicker.css', // bootstrap-daterangepicker
                ],
                [
                    'type' => 'stylesheet',
                    'file' => '/vendors/datatables.net-bs/css/dataTables.bootstrap.min.css', // Datatables
                ],
                [
                    'type' => 'stylesheet',
                    'file' => '/vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css', // 
                ],
                [
                    'type' => 'stylesheet',
                    'file' => '/vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css', // 
                ],
                [
                    'type' => 'stylesheet',
                    'file' => '/vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css', // 
                ],
                [
                    'type' => 'stylesheet',
                    'file' => '/vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css', // End Datatables
                ],
                [
                    'type' => 'stylesheet',
                    'file' => '/vendors/google-code-prettify/bin/prettify.min.css', // bootstrap-wysiwyg
                ],
                [
                    'type' => 'stylesheet',
                    'file' => '/vendors/select2/dist/css/select2.min.css', // Select2
                ],
                [
                    'type' => 'stylesheet',
                    'file' => '/vendors/switchery/dist/switchery.min.css', // Switchery
                ],
                [
                    'type' => 'stylesheet',
                    'file' => '/vendors/starrr/dist/starrr.css', // starrr
                ],
                [
                    'type' => 'stylesheet',
                    'file' => '/vendors/pnotify/dist/pnotify.css', // PNotify
                ],
                [
                    'type' => 'stylesheet',
                    'file' => '/vendors/pnotify/dist/pnotify.brighttheme.css', // PNotify
                ],
                [
                    'type' => 'stylesheet',
                    'file' => '/vendors/pnotify/dist/pnotify.buttons.css', // 
                ],
                [
                    'type' => 'stylesheet',
                    'file' => '/vendors/pnotify/dist/pnotify.nonblock.css', // End PNotify
                ],
                [
                    'type' => 'stylesheet',
                    'file' => '/vendors/dropzone/dist/min/dropzone.min.css', // Dropzone.js
                ],
                [
                    'type' => 'stylesheet',
                    'file' => '/vendors/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.min.css', // jQuery custom content scroller
                ],
				/*
                [
                    'type' => 'stylesheet',
                    'file' => '/vendors/fullcalendar/3.1.0/dist/scheduler.min.css', // fullcalendar Schedule
                ],*/
                [
                    'type' => 'stylesheet',
                    'file' => '/vendors/fullcalendar/3.1.0/dist/fullcalendar.min.css', // fullcalendar
                ],
				/*
                [
                    'type' => 'stylesheet',
                    'file' => '/vendors/fullcalendar/3.1.0/dist/fullcalendar.print.css', // End fullcalendar
                ],*/
                [
                    'type' => 'stylesheet',
                    # 'file' => '/build/css/custom.min.css', // Custom Theme Style
                    'file' => '/build/css/custom.css', // Custom Theme Style
                ],
                [
                    'type' => 'stylesheet',
                    'file' => '/vendors/cropper/dist/cropper.min.css', // Custom Theme Style
                ],
                [
                    'type' => 'script',
                    'file' => 'https://cdnjs.cloudflare.com/ajax/libs/vue/2.6.10/vue.js', // vue
                ],
                [
                    'type' => 'script',
                    'file' => 'https://cdnjs.cloudflare.com/ajax/libs/vue-router/3.0.2/vue-router.js', // vue-router
                ],
                [
                    'type' => 'script',
                    'file' => 'https://cdnjs.cloudflare.com/ajax/libs/axios/0.18.0/axios.js', // axios
                ],
				/*
                [
                    'type' => 'stylesheet',
                    'file' => '/vendors/tinymce/custom/skin.min.css', // Custom Theme Style
                ],*/
				/* Footer */
                [
                    'type' => 'script',
                    'file' => '/vendors/jquery/dist/jquery.min.js', // jQuery
                ],
                [
                    'type' => 'script',
                    'file' => '/vendors/bootstrap/dist/js/bootstrap.min.js', // Bootstrap
                ],
                [
                    'type' => 'script',
                    'file' => 'https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js', // Bootstrap
                ],
                [
                    'type' => 'script',
                    'file' => 'https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js', // End 
                ],
                [
                    'type' => 'script',
                    //'file' => '/vendors/fullcalendar/3.1.0/dist/lang-all.js', // 
                    'file' => 'https://cdnjs.cloudflare.com/ajax/libs/jqueryui-touch-punch/0.2.3/jquery.ui.touch-punch.min.js', // bootbox
                ],
                [
                    'type' => 'script',
                    'file' => 'https://cdnjs.cloudflare.com/ajax/libs/datepicker/0.6.5/datepicker.js', // End 
                ],
                [
                    'type' => 'script',
                    'file' => '/vendors/fastclick/lib/fastclick.js', // FastClick
                ],
                [
                    'type' => 'script',
                    'file' => '/vendors/jQuery-Smart-Wizard/js/jquery.smartWizard.js', // jQuery Smart Wizard
                ],
                [
                    'type' => 'script',
                    'file' => '/vendors/jquery-sparkline/dist/jquery.sparkline.min.js', // jQuery Sparklines
                ],
                [
                    'type' => 'script',
                    'file' => '/vendors/raphael/raphael.min.js', // morris.js
                ],
                [
                    'type' => 'script',
                    'file' => '/vendors/morris.js/morris.min.js', // End morris.js
                ],
                [
                    'type' => 'script',
                    'file' => '/vendors/nprogress/nprogress.js', // NProgress
                ],
                [
                    'type' => 'script',
                    'file' => '/vendors/validator/validator.js', // NProgress
                ],
                [
                    'type' => 'script',
                    'file' => '/vendors/Chart.js/dist/Chart.min.js', // Chart.js
                ],
                [
                    'type' => 'script',
                    'file' => '/vendors/gauge.js/dist/gauge.min.js', // gauge.js
                ],
                [
                    'type' => 'script',
                    'file' => '/vendors/bootstrap-progressbar/bootstrap-progressbar.min.js', // bootstrap-progressbar
                ],
                [
                    'type' => 'script',
                    'file' => '/vendors/iCheck/icheck.min.js', // iCheck
                ],
                [
                    'type' => 'script',
                    'file' => '/vendors/skycons/skycons.js', // Skycons
                ],
                [
                    'type' => 'script',
                    'file' => '/vendors/Flot/jquery.flot.js', // Flot
                ],
                [
                    'type' => 'script',
                    'file' => '/vendors/Flot/jquery.flot.pie.js', // 
                ],
                [
                    'type' => 'script',
                    'file' => '/vendors/Flot/jquery.flot.time.js', // 
                ],
                [
                    'type' => 'script',
                    'file' => '/vendors/Flot/jquery.flot.stack.js', // 
                ],
                [
                    'type' => 'script',
                    'file' => '/vendors/Flot/jquery.flot.resize.js', // End Flot
                ],
                [
                    'type' => 'script',
                    'file' => '/vendors/flot.orderbars/js/jquery.flot.orderBars.js', // Flot plugins
                ],
                [
                    'type' => 'script',
                    'file' => '/vendors/flot-spline/js/jquery.flot.spline.min.js', // 
                ],
                [
                    'type' => 'script',
                    'file' => '/vendors/flot.curvedlines/curvedLines.js', // End Flot plugins
                ],
                [
                    'type' => 'script',
                    'file' => '/vendors/DateJS/build/date.js', // DateJS
                ],
                [
                    'type' => 'script',
                    'file' => '/vendors/jqvmap/dist/jquery.vmap.js', // JQVMap
                ],
				/*
                [
                    'type' => 'script',
                    'file' => '/vendors/jqvmap/dist/maps/jquery.vmap.world.js', // 
                ],
                [
                    'type' => 'script',
                    'file' => '/vendors/jqvmap/dist/maps/jquery.vmap.usa.js', // 
                ],
				*/
                [
                    'type' => 'script',
                    'file' => '/vendors/jqvmap/examples/js/jquery.vmap.sampledata.js', // End JQVMap
                ],
                [
                    'type' => 'script',
                    'file' => '/vendors/moment/min/moment.min.js', // Moment
                ],
                [
                    'type' => 'script',
                    'file' => '/vendors/bootstrap-daterangepicker/daterangepicker.js', // bootstrap-daterangepicker
                ],
                [
                    'type' => 'script',
                    'file' => '/vendors/bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js', // End bootstrap-daterangepicker
                ],
                [
                    'type' => 'script',
                    'file' => '/vendors/bootstrap-wysiwyg/js/bootstrap-wysiwyg.min.js', // bootstrap-wysiwyg
                ],
                [
                    'type' => 'script',
                    'file' => '/vendors/jquery.hotkeys/jquery.hotkeys.js', // 
                ],
                [
                    'type' => 'script',
                    'file' => '/vendors/google-code-prettify/src/prettify.js', // End bootstrap-wysiwyg
                ],
                [
                    'type' => 'script',
                    'file' => '/vendors/jquery.tagsinput/src/jquery.tagsinput.js', // jQuery Tags Input
                ],
                [
                    'type' => 'script',
                    'file' => '/vendors/switchery/dist/switchery.min.js', // Switchery
                ],
                [
                    'type' => 'script',
                    'file' => '/vendors/select2/dist/js/select2.full.min.js', // Select2
                ],
                [
                    'type' => 'script',
                    'file' => '/vendors/parsleyjs/dist/parsley.min.js', // Parsley
                ],
                [
                    'type' => 'script',
                    'file' => '/vendors/autosize/dist/autosize.min.js', // Autosize
                ],
                [
                    'type' => 'script',
                    'file' => '/vendors/devbridge-autocomplete/dist/jquery.autocomplete.min.js', // jQuery autocomplete
                ],
                [
                    'type' => 'script',
                    'file' => '/vendors/starrr/dist/starrr.js', // starrr
                ],
                [
                    'type' => 'script',
                    'file' => '/vendors/echarts/dist/echarts.min.js', // ECharts
                ],
				/*
                [
                    'type' => 'script',
                    'file' => '/vendors/echarts/map/js/world.js', // End ECharts
                ],
				*/
                [
                    'type' => 'script',
                    'file' => '/vendors/jquery.easy-pie-chart/dist/jquery.easypiechart.min.js', // easy-pie-chart
                ],
                [
                    'type' => 'script',
                    'file' => '/vendors/datatables.net/js/jquery.dataTables.min.js', // Datatables
                ],
                [
                    'type' => 'script',
                    'file' => '/vendors/datatables.net-bs/js/dataTables.bootstrap.min.js', // 
                ],
                [
                    'type' => 'script',
                    'file' => '/vendors/datatables.net-buttons/js/dataTables.buttons.min.js', // 
                ],
                [
                    'type' => 'script',
                    'file' => '/vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js', // 
                ],
                [
                    'type' => 'script',
                    'file' => '/vendors/datatables.net-buttons/js/buttons.flash.min.js', // 
                ],
                [
                    'type' => 'script',
                    'file' => '/vendors/datatables.net-buttons/js/buttons.html5.min.js', // 
                ],
                [
                    'type' => 'script',
                    'file' => '/vendors/datatables.net-buttons/js/buttons.print.min.js', // 
                ],
                [
                    'type' => 'script',
                    'file' => '/vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js', // 
                ],
                [
                    'type' => 'script',
                    'file' => '/vendors/datatables.net-keytable/js/dataTables.keyTable.min.js', // 
                ],
                [
                    'type' => 'script',
                    'file' => '/vendors/datatables.net-responsive/js/dataTables.responsive.min.js', // 
                ],
                [
                    'type' => 'script',
                    'file' => '/vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js', // 
                ],
                [
                    'type' => 'script',
                    'file' => '/vendors/datatables.net-scroller/js/dataTables.scroller.min.js', // 
                ],
                [
                    'type' => 'script',
                    'file' => '/vendors/jszip/dist/jszip.min.js', // 
                ],
                [
                    'type' => 'script',
                    'file' => '/vendors/pdfmake/build/pdfmake.min.js', // 
                ],
                [
                    'type' => 'script',
                    'file' => '/vendors/pdfmake/build/vfs_fonts.js', // End Datatables
                ],
                [
                    'type' => 'script',
                    'file' => '/vendors/ion.rangeSlider/js/ion.rangeSlider.min.js', // Ion.RangeSlider
                ],
                [
                    'type' => 'script',
                    'file' => '/vendors/mjolnic-bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js', // Bootstrap Colorpicker
                ],
                [
                    'type' => 'script',
                    'file' => '/vendors/jquery.inputmask/dist/min/jquery.inputmask.bundle.min.js', // jquery.inputmask
                ],
                [
                    'type' => 'script',
                    'file' => '/vendors/jquery-knob/dist/jquery.knob.min.js', // jQuery Knob
                ],
                [
                    'type' => 'script',
                    'file' => '/vendors/cropper/dist/cropper.min.js', // Cropper
                ],
                [
                    'type' => 'script',
                    'file' => '/vendors/pnotify/dist/pnotify.js', // PNotify
                ],
                [
                    'type' => 'script',
                    'file' => '/vendors/pnotify/dist/pnotify.buttons.js', // 
                ],
                [
                    'type' => 'script',
                    'file' => '/vendors/pnotify/dist/pnotify.nonblock.js', // End PNotify
                ],
                [
                    'type' => 'script',
                    'file' => '/vendors/pnotify/dist/pnotify.callbacks.js', // 
                ],
				[
                    'type' => 'script',
                    'file' => '/vendors/pnotify/dist/pnotify.confirm.js', // 
                ],
				[
                    'type' => 'script',
                    'file' => '/vendors/pnotify/dist/pnotify.history.js', // 
                ],
				[
                    'type' => 'script',
                    'file' => '/vendors/pnotify/dist/pnotify.mobile.js', // 
                ],
                [
                    'type' => 'script',
                    'file' => '/vendors/dropzone/dist/min/dropzone.min.js', // Dropzone.js
                ],
                [
                    'type' => 'script',
                    'file' => '/vendors/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.concat.min.js', // jQuery custom content scroller
                ],
                [
                    'type' => 'script',
                    'file' => '/vendors/moment/min/moment.min.js', // Moment
                ],
                [
                    'type' => 'script',
                    'file' => '/vendors/fullcalendar/3.1.0/dist/fullcalendar.min.js', // End fullcalendar
                ],
				/*
                [
                    'type' => 'script',
                    'file' => '/vendors/fullcalendar/3.1.0/dist/scheduler.min.js', // End fullcalendar Schedule
                ],*/
				/*
                [
                    'type' => 'script',
                    'file' => '/vendors/fullcalendar/3.1.0/dist/locale/es.js', // fullcalendar
                ],*/
                [
                    'type' => 'script',
                    'file' => '/vendors/bootbox/bootbox.all.min.js', // bootbox
                ],
                [
                    'type' => 'script',
                    'file' => '/vendors/bootbox/bootbox.locales.min.js', // End bootbox
                ],
				/*
                [
                    'type' => 'script',
                    'file' => '/vendors/fullcalendar/3.1.0/dist/lang-all.js', // fullcalendar
                ],*/
				/*
                [
                    'type' => 'script',
                    'file' => 'https://cdn.tiny.cloud/1/86bdm4wz6s6i3vb1ja8m19wt904rgmypspgr60gmdcw4a5wz/tinymce/5/tinymce.min.js', // Scripts DEMO
                ],*/
                [
                    'type' => 'script',
                    'file' => '/vendors/tinymce/4.7.7/tinymce.min.js', // Custom Theme Style
                ],
                [
                    'type' => 'script',
                    'file' => '/vendors/hammer/hammer.js', // Hammer
                ]
            ],
            'footer_scripts' => [
                [
                    'type' => 'script',
                    'file' => '/build/js/custom.js', // Scripts DEMO
                ],
            ],
        ],
    ],
];
