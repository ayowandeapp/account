<div class="row-fluid" style="margin-top: 5%;">
    <div id="footer" class="span12"> 2020 &copy; Cash Book Keeping</div>
    {{-- <a href="http://tapinns.com">tapinns.com</a> --}}
</div>
<script src="{{ asset('site_assets/js/jquery-3-4-1.js') }}"></script>
<script src="{{ asset('site_assets/js/properjs.js') }}"></script>
<script src="{{ asset('site_assets/js/bootstrap-4-4-1.js') }}"></script>




<script src="{{ asset('site_assets/js/excanvas.min.js') }}"></script>
<script src="{{ asset('site_assets/js/jquery.min.js') }}"></script>
<script src="{{ asset('site_assets/js/jquery.ui.custom.js') }}"></script>
<script src="{{ asset('site_assets/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('site_assets/js/jquery.flot.min.js') }}"></script>
<script src="{{ asset('site_assets/js/jquery.flot.resize.min.js') }}"></script>
<script src="{{ asset('site_assets/js/jquery.peity.min.js') }}"></script>
<script src="{{ asset('site_assets/js/fullcalendar.min.js') }}"></script>
<script src="{{ asset('pluginns/js/dataTables.min.js') }}"></script>
<script src="{{ asset('pluginns/js/dataTablesButtons.min.js') }}"></script>
<script src="{{ asset('pluginns/js/dataTablesButtonFlush.min.js') }}"></script>
<script src="{{ asset('pluginns/js/jszip.min.js') }}"></script>
<script src="{{ asset('pluginns/js/pdfmake.min.js') }}"></script>
<script src="{{ asset('pluginns/js/vfs_fonts.js') }}"></script>
<script src="{{ asset('pluginns/js/buttonsHtml.min.js') }}"></script>
<script src="{{ asset('pluginns/js/print.min.js') }}"></script>

{{-- <script src="{{ asset('site_assets/js/datatable.js') }}"></script>
--}}

<script src="{{ asset('pluginns/js/select2.min.js') }}"></script>
<script src="{{ asset('site_assets/js/maruti.js') }}"></script>
<script src="{{ asset('site_assets/js/maruti.dashboard.js') }}"></script>
<script src="{{ asset('site_assets/js/maruti.chat.js') }}"></script>


<script type="text/javascript">
    // This function is called from the pop-up menus to transfer to
    // a different page. Ignore if the value returned is a null string:
    function goPage(newURL) {

        // if url is empty, skip the menu dividers and reset the menu selection to default
        if (newURL != "") {

            // if url is "-", it is this page -- reset the menu:
            if (newURL == "-") {
                resetMenu();
            }
            // else, send page to designated URL
            else {
                document.location.href = newURL;
            }
        }
    }

    // resets the menu selection upon entry to this page:
    function resetMenu() {
        document.gomenu.selector.selectedIndex = 2;
    }

</script>
