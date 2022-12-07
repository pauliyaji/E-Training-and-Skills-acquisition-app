<footer class="footer mt-auto">
    <div class="copyright bg-white">
        <p>
            &copy; <span id="copy-year">2019</span> Copyright Sleek Dashboard Bootstrap Template by
            <a
                class="text-primary"
                href="http://www.iamabdus.com/"
                target="_blank"
            >Abdus</a
            >.
        </p>
    </div>
    <script>
        var d = new Date();
        var year = d.getFullYear();
        document.getElementById("copy-year").innerHTML = year;
    </script>
</footer>

</div>
</div>

<script src="{{ asset('/assets/plugins/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('/assets/plugins/slimscrollbar/jquery.slimscroll.min.js') }}"></script>
<script src="{{ asset('/assets/plugins/jekyll-search.min.js ') }}"></script>



<script src="{{ asset('/assets/plugins/daterangepicker/moment.min.js') }}"></script>
<script src="{{ asset('/assets/plugins/daterangepicker/daterangepicker.js') }}"></script>
<script>
    jQuery(document).ready(function() {
        jQuery('input[name="dateRange"]').daterangepicker({
            autoUpdateInput: false,
            singleDatePicker: true,
            locale: {
                cancelLabel: 'Clear'
            }
        });
        jQuery('input[name="dateRange"]').on('apply.daterangepicker', function (ev, picker) {
            jQuery(this).val(picker.startDate.format('MM/DD/YYYY'));
        });
        jQuery('input[name="dateRange"]').on('cancel.daterangepicker', function (ev, picker) {
            jQuery(this).val('');
        });
    });
</script>



<script src="{{ asset('/assets/js/sleek.js') }}"></script>
</body>

</html>
