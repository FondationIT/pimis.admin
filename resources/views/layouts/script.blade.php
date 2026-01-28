
<!-- jQuery -->
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script src="{{  asset('vendors/jquery/dist/jquery.min.js')}}"></script>
<!-- jQuery -->

    <!-- Bootstrap Core JavaScript -->
    <script src="{{  asset('vendors/popper.js/dist/umd/popper.min.js')}}"></script>
    <script src="{{  asset('vendors/bootstrap/dist/js/bootstrap.min.js')}}"></script>



    <!-- Slimscroll JavaScript -->
    <script src="{{  asset('dist/js/jquery.slimscroll.js')}}"></script>
  <!-- Tinymce JavaScript -->
  <script src="{{  asset('vendors/tinymce/tinymce.min.js')}}"></script>

  <!-- Tinymce Wysuhtml5 Init JavaScript -->
  <script src="{{  asset('dist/js/tinymce-data.js')}}"></script>

    <!-- Fancy Dropdown JS -->
    <script src="{{  asset('dist/js/dropdown-bootstrap-extended.js')}}"></script>

    <!-- FeatherIcons JavaScript -->
    <script src="{{  asset('dist/js/feather.min.js')}}"></script>

    <!-- Toggles JavaScript -->
    <script src="{{  asset('vendors/jquery-toggles/toggles.min.js')}}"></script>
    <script src="{{  asset('dist/js/toggle-data.js')}}"></script>

    <!-- Toastr JS -->
    <script src="{{  asset('vendors/jquery-toast-plugin/dist/jquery.toast.min.js')}}"></script>

    <!-- Counter Animation JavaScript -->
    <script src="{{  asset('vendors/waypoints/lib/jquery.waypoints.min.js')}}"></script>
    <script src="{{  asset('vendors/jquery.counterup/jquery.counterup.min.js')}}"></script>

    <!-- Morris Charts JavaScript -->
    <script src="{{  asset('vendors/raphael/raphael.min.js')}}"></script>
    <script src="{{  asset('vendors/morris.js/morris.min.js')}}"></script>

    <!-- Easy pie chart JS -->
    <script src="{{  asset('vendors/easy-pie-chart/dist/jquery.easypiechart.min.js')}}"></script>

    <!-- Flot Charts JavaScript -->
    <script src="{{  asset('vendors/flot/excanvas.min.js')}}"></script>
    <script src="{{  asset('vendors/flot/jquery.flot.js')}}"></script>
    <script src="{{  asset('vendors/flot/jquery.flot.pie.js')}}"></script>
    <script src="{{  asset('vendors/flot/jquery.flot.resize.js')}}"></script>
    <script src="{{  asset('vendors/flot/jquery.flot.time.js')}}"></script>
    <script src="{{  asset('vendors/flot/jquery.flot.stack.js')}}"></script>
    <script src="{{  asset('vendors/flot/jquery.flot.crosshair.js')}}"></script>
    <script src="{{  asset('vendors/jquery.flot.tooltip/js/jquery.flot.tooltip.min.js')}}"></script>

    <!-- EChartJS JavaScript -->
    <script src="{{  asset('vendors/echarts/dist/echarts-en.min.js')}}"></script>

    <!-- Team Drop JavaScript -->
    <script src="{{  asset('vendors/team_dropdown/dist/js/team_dropdown.min.js')}}"></script>

    <!-- Team Drop JavaScript -->
    <script src="{{  asset('vendors/duration/dist/css/duration.js')}}"></script>
    

    <!-- Init JavaScript -->
    <script src="{{  asset('dist/js/init.js')}}"></script>
    <script src="{{  asset('dist/js/dashboard2-data.js')}}"></script>

    <!-- Select2 JavaScript -->
    <script src="{{  asset('vendors/select2/dist/js/select2.full.min.js')}}"></script>
    <script src="{{  asset('dist/js/select2-data.js')}}"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/js/standalone/selectize.min.js" integrity="sha256-+C0A5Ilqmu4QcSPxrlGpaZxJ04VjsRjKu+G82kl5UJk=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/css/selectize.bootstrap3.min.css" integrity="sha256-ze/OEYGcFbPRmvCnrSeKbRTtjG4vGLHXgOqsyLFTRjg=" crossorigin="anonymous" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <script src="{{  asset('js/moment.min.js.map')}}"></script>
    <script src="{{  asset('js/nav.js')}}"></script>

    <script src="{{  asset('js/pages/agent.js')}}"></script>


    <script src="{{  asset('js/pages/fin.js')}}"></script>
    <script src="{{  asset('js/pages/rh.js')}}"></script>

    <script src="{{  asset('js/pages/stock.js')}}"></script>

    {{-- Calendar plugin JS --}}
    <script src="{{  asset('vendors/fullcalendar/packages/core/index.global.min.js') }}"></script>
    <script src="{{  asset('vendors/fullcalendar/packages/daygrid/index.global.min.js') }}"></script>

    <script src="{{  asset('vendors/calendar-script/calendar_script.js') }}"></script>
    
    <script src="{{  asset('vendors/partnerSelect/partner-select.js') }}"></script>

    <script src="{{  asset('vendors/worning-popup/worning-popup.js') }}"></script>





    @livewireScripts

    <script>
        window.addEventListener('formSuccess', event => {
            $('.close').click()
            $.toast().reset('all');
            $.toast({
                text: '<i class="jq-toast-icon ti-location-pin"></i><p>Effectué</p>',
                position: 'top-center',
                loaderBg:'#7a5449',
                class: 'jq-has-icon jq-toast-success',
                hideAfter: 3500,
                stack: 6,
                showHideTransition: 'fade'
            });
        });


    </script>
