<?php 
/* *******************************
 *
 * Developer by FelipheGomez
 *
 * ******************************/

return [
  "id" => "app",
  "name" => "demo",
  "lang" => "es",
  "charset" => "utf-8",
  "default" => "main",
  "assets" => [
    "url" => "/public/assets",
    "includes" => [
      "head" => [
		// Header-Head verificado
        [ "type" => "stylesheet", "file" => "/vendors/font-awesome/css/font-awesome.min.css" ],
        [ "type" => "stylesheet", "file" => "/vendors/nprogress/nprogress.css" ],
        [ "type" => "stylesheet", "file" => "/vendors/animate.css/animate.min.css" ],
        # [ "type" => "stylesheet", "file" => "/vendors/iCheck/skins/all.css" ],
        # [ "type" => "stylesheet", "file" => "/vendors/jqvmap/dist/jqvmap.min.css" ],
        [ "type" => "stylesheet", "file" => "/vendors/google-code-prettify/bin/prettify.min.css" ],
        [ "type" => "stylesheet", "file" => "/vendors/select2/dist/css/select2.min.css" ],
        # [ "type" => "stylesheet", "file" => "/vendors/switchery/dist/switchery.min.css" ],
        [ "type" => "stylesheet", "file" => "/vendors/starrr/dist/starrr.css" ],
        [ "type" => "stylesheet", "file" => "/vendors/pnotify/dist/pnotify.css" ],
        [ "type" => "stylesheet", "file" => "/vendors/pnotify/dist/pnotify.brighttheme.css" ],
        [ "type" => "stylesheet", "file" => "/vendors/pnotify/dist/pnotify.buttons.css" ],
        [ "type" => "stylesheet", "file" => "/vendors/pnotify/dist/pnotify.nonblock.css" ],
        [ "type" => "stylesheet", "file" => "/vendors/dropzone/v5.7.0/src/dropzone.scss" ],
        [ "type" => "stylesheet", "file" => "/vendors/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.min.css" ],
        [ "type" => "stylesheet", "file" => "/vendors/fullcalendar/3.1.0/dist/fullcalendar.min.css" ],
        [ "type" => "stylesheet", "file" => "/vendors/zoom.js/css/zoom.css" ],
        [ "type" => "stylesheet", "file" => "/vendors/bootstrap/dist/css/bootstrap.min.css" ],
        [ "type" => "stylesheet", "file" => "/build/css/custom.css" ],
		
        [ "type" => "stylesheet", "file" => "/vendors/bootstrap-daterangepicker/daterangepicker.css" ],
        [ "type" => "stylesheet", "file" => "/vendors/datatables.net-bs/css/dataTables.bootstrap.min.css" ],
        [ "type" => "stylesheet", "file" => "/vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" ],
        [ "type" => "stylesheet", "file" => "/vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css" ],
        [ "type" => "stylesheet", "file" => "/vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" ],
        [ "type" => "stylesheet", "file" => "/vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css" ],
        [ "type" => "stylesheet", "file" => "/vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css" ],
        [ "type" => "stylesheet", "file" => "/vendors/bootstrap-wysiwyg/css/style.css" ],
        
        # [ "type" => "script", "file" => "/vendors/iCheck/icheck.min.js" ],
        # [ "type" => "script", "file" => "/vendors/skycons/skycons.js" ],        
        # [ "type" => "script", "file" => "/vendors/switchery/dist/switchery.min.js" ],
        # [ "type" => "script", "file" => "/vendors/autosize/dist/autosize.min.js" ],
        # [ "type" => "script", "file" => "/vendors/devbridge-autocomplete/dist/jquery.autocomplete.min.js" ],
        # [ "type" => "script", "file" => "/vendors/starrr/dist/starrr.js" ],
        # [ "type" => "script", "file" => "/vendors/ion.rangeSlider/js/ion.rangeSlider.min.js" ],
        # [ "type" => "script", "file" => "/vendors/mjolnic-bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js" ],
        # [ "type" => "script", "file" => "/vendors/jquery-knob/dist/jquery.knob.min.js" ],
        # [ "type" => "script", "file" => "/vendors/cropper/dist/cropper.min.js" ],
        # [ "type" => "script", "file" => "/vendors/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.concat.min.js" ],
        # [ "type" => "script", "file" => "/vendors/tinymce/4.7.7/tinymce.min.js" ],
		
		// Footer-Head verificado
		
        [ "type" => "script", "file" => "https://cdnjs.cloudflare.com/ajax/libs/vue/2.6.10/vue.js" ],
        [ "type" => "script", "file" => "https://cdnjs.cloudflare.com/ajax/libs/vue-router/3.0.2/vue-router.js" ],
        [ "type" => "script", "file" => "https://cdnjs.cloudflare.com/ajax/libs/axios/0.18.0/axios.js" ],
		// jQuery & BootStrap
        [ "type" => "script", "file" => "/vendors/jquery/dist/jquery.min.js" ],
        [ "type" => "script", "file" => "/vendors/bootstrap/dist/js/bootstrap.min.js" ],		
		[ "type" => "script", "file" => "https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" ],
        [ "type" => "script", "file" => "https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js" ],
        [ "type" => "script", "file" => "https://cdnjs.cloudflare.com/ajax/libs/jqueryui-touch-punch/0.2.3/jquery.ui.touch-punch.min.js" ],
        
		// Moment
        [ "type" => "script", "file" => "/vendors/moment/min/moment.min.js" ],
		// Zoom
        [ "type" => "script", "file" => "/vendors/zoom.js/js/zoom.js" ],
        [ "type" => "script", "file" => "/vendors/zoom.js/js/transition.js" ],
		
        [ "type" => "script", "file" => "https://cdnjs.cloudflare.com/ajax/libs/datepicker/0.6.5/datepicker.js" ],
        [ "type" => "script", "file" => "/vendors/fastclick/lib/fastclick.js" ],
		
		// smartWizard
		[ "type" => "script", "file" => "/vendors/jQuery-Smart-Wizard/js/jquery.smartWizard.js" ],
		
		// More Charts
		[ "type" => "script", "file" => "/vendors/jquery-sparkline/dist/jquery.sparkline.min.js" ],
        [ "type" => "script", "file" => "/vendors/raphael/raphael.min.js" ],
        [ "type" => "script", "file" => "/vendors/morris.js/morris.min.js" ],
        [ "type" => "script", "file" => "/vendors/nprogress/nprogress.js" ],
        [ "type" => "script", "file" => "/vendors/validator/validator.js" ],
        [ "type" => "script", "file" => "/vendors/Chart.js/dist/Chart.min.js" ],
		
		// Gauge Coffee
        [ "type" => "script", "file" => "/vendors/gauge.js/dist/gauge.min.js" ],
		
		// ProgressBar BootStrap
        [ "type" => "script", "file" => "/vendors/bootstrap-progressbar/bootstrap-progressbar.min.js" ],
        
		// Flot
        [ "type" => "script", "file" => "/vendors/Flot/jquery.flot.js" ],
        [ "type" => "script", "file" => "/vendors/Flot/jquery.flot.pie.js" ],
        [ "type" => "script", "file" => "/vendors/Flot/jquery.flot.time.js" ],
        [ "type" => "script", "file" => "/vendors/Flot/jquery.flot.stack.js" ],
        [ "type" => "script", "file" => "/vendors/Flot/jquery.flot.resize.js" ],
        [ "type" => "script", "file" => "/vendors/flot.orderbars/js/jquery.flot.orderBars.js" ],
        [ "type" => "script", "file" => "/vendors/flot-spline/js/jquery.flot.spline.min.js" ],
        [ "type" => "script", "file" => "/vendors/flot.curvedlines/curvedLines.js" ],
        # [ "type" => "script", "file" => "/vendors/jqvmap/dist/jquery.vmap.js" ],
        # [ "type" => "script", "file" => "/vendors/jqvmap/examples/js/jquery.vmap.sampledata.js" ],
		
		// DateJS
		[ "type" => "script", "file" => "/vendors/DateJS/build/date.js" ],
		
		// hotkeys
        [ "type" => "script", "file" => "/vendors/jquery.hotkeys/jquery.hotkeys.js" ],
		
		// prettify
        [ "type" => "script", "file" => "/vendors/google-code-prettify/src/prettify.js" ],
		
		// DateRangePicker
        [ "type" => "script", "file" => "/vendors/bootstrap-daterangepicker/daterangepicker.js" ],
        [ "type" => "script", "file" => "/vendors/bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js" ],
		
		// WYSIWYG BootStrap
        [ "type" => "script", "file" => "/vendors/bootstrap-wysiwyg/js/bootstrap-wysiwyg.min.js" ],
		
		// TagsInput jQuery
		[ "type" => "script", "file" => "/vendors/jquery.tagsinput/src/jquery.tagsinput.js" ],
		// Select2
		[ "type" => "script", "file" => "/vendors/select2/dist/js/select2.full.min.js" ],
		// ParsleJS
		[ "type" => "script", "file" => "/vendors/parsleyjs/dist/parsley.min.js" ],
		
		// eCharts
        [ "type" => "script", "file" => "/vendors/echarts/dist/echarts.min.js" ],
        [ "type" => "script", "file" => "/vendors/jquery.easy-pie-chart/dist/jquery.easypiechart.min.js" ],
		
		// DataTables
        [ "type" => "script", "file" => "/vendors/datatables.net/js/jquery.dataTables.min.js" ],
        [ "type" => "script", "file" => "/vendors/datatables.net-bs/js/dataTables.bootstrap.min.js" ],
        [ "type" => "script", "file" => "/vendors/datatables.net-buttons/js/dataTables.buttons.min.js" ],
        [ "type" => "script", "file" => "/vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js" ],
        [ "type" => "script", "file" => "/vendors/datatables.net-buttons/js/buttons.flash.min.js" ],
        [ "type" => "script", "file" => "/vendors/datatables.net-buttons/js/buttons.html5.min.js" ],
        [ "type" => "script", "file" => "/vendors/datatables.net-buttons/js/buttons.print.min.js" ],
        [ "type" => "script", "file" => "/vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js" ],
        [ "type" => "script", "file" => "/vendors/datatables.net-keytable/js/dataTables.keyTable.min.js" ],
        [ "type" => "script", "file" => "/vendors/datatables.net-responsive/js/dataTables.responsive.min.js" ],
        [ "type" => "script", "file" => "/vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js" ],
        [ "type" => "script", "file" => "/vendors/datatables.net-scroller/js/dataTables.scroller.min.js" ],
		
        [ "type" => "script", "file" => "/vendors/jszip/dist/jszip.min.js" ], // Validar
        [ "type" => "script", "file" => "/vendors/pdfmake/build/pdfmake.min.js" ], // Validar
        [ "type" => "script", "file" => "/vendors/pdfmake/build/vfs_fonts.js" ], // Validar
		
		// InputMask
		[ "type" => "script", "file" => "/vendors/jquery.inputmask/dist/min/jquery.inputmask.bundle.min.js" ],
		
		// PNotify
        [ "type" => "script", "file" => "/vendors/pnotify/dist/pnotify.js" ],
        [ "type" => "script", "file" => "/vendors/pnotify/dist/pnotify.buttons.js" ],
        [ "type" => "script", "file" => "/vendors/pnotify/dist/pnotify.nonblock.js" ],
        [ "type" => "script", "file" => "/vendors/pnotify/dist/pnotify.callbacks.js" ],
        [ "type" => "script", "file" => "/vendors/pnotify/dist/pnotify.confirm.js" ],
        [ "type" => "script", "file" => "/vendors/pnotify/dist/pnotify.history.js" ],
		[ "type" => "script", "file" => "/vendors/pnotify/dist/pnotify.mobile.js" ],
		
		// FullCalendar
        [ "type" => "script", "file" => "/vendors/fullcalendar/3.1.0/dist/fullcalendar.min.js" ],
		
		// BootBox
        [ "type" => "script", "file" => "/vendors/bootbox/bootbox.all.min.js" ],
        [ "type" => "script", "file" => "/vendors/bootbox/bootbox.locales.min.js" ],
		
		// Hammer
        [ "type" => "script", "file" => "/vendors/hammer/hammer.js" ],
		
		// DropZone
        [ "type" => "script", "file" => "/vendors/dropzone/v5.7.0/src/dropzone.js" ]
      ],
      "footer_scripts" => [
		// Footer verificado (PRUEBAS)
        [ "type" => "script", "file" => "/build/js/custom.js" ]
      ]
    ]
  ]
];