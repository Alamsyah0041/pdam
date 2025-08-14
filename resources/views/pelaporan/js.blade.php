<!-- Core vendor JS -->
<script src="{{ asset('assets/vendors/js/vendor.bundle.base.js') }}"></script>

<!-- Plugin JS -->
<script src="{{ asset('assets/vendors/chart.js/chart.umd.js') }}"></script>
<script src="{{ asset('assets/js/dataTables.select.min.js') }}"></script>

<!-- Template scripts -->
<script src="{{ asset('assets/js/off-canvas.js') }}"></script>
<script src="{{ asset('assets/js/template.js') }}"></script>
<script src="{{ asset('assets/js/settings.js') }}"></script>
<script src="{{ asset('assets/js/todolist.js') }}"></script>

<!-- Custom scripts -->
<script src="{{ asset('assets/js/jquery.cookie.js') }}"></script>
<script src="{{ asset('assets/js/dashboard.js') }}"></script>

<!-- Initialize components -->
<script>
$(document).ready(function() {
    // // Initialize collapse toggles with null check
    // document.querySelectorAll('[data-bs-toggle="collapse"]').forEach(button => {
    //     button.addEventListener('click', () => {
    //         const target = document.querySelector(button.dataset.bsTarget);
    //         if(target) {
    //             target.classList.toggle('show');
    //         }
    //     });
    // });

    // Initialize ECharts with null check
    var chartDom = document.getElementById('echart_pie2');
    if (chartDom) {
        var myChart = echarts.init(chartDom);
        var option = {
            // Your chart options
        };
        myChart.setOption(option);
    }
});
</script>