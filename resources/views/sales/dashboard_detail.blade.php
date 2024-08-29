

<canvas id="myChart" width="400" height="400"></canvas>

<script>
	var ctx = $("#myChart").get(0).getContext("2d");
	var myNewChart = new Chart(ctx);

	var data = [
    {
        value: {{ $lost_sales }},
        color:"#F7464A",
        highlight: "#FF5A5E",
        label: "Won Sales"
    },
    {
        value: {{ $won_sales }},
        color: "#46BFBD",
        highlight: "#5AD3D1",
        label: "Lost Sales"
    },
    {
        value: {{ $open_sales }},
        color: "green",
        highlight: "limegreen",
        label: "Open Sales"
    }
    ];

	var myDoughnutChart = new Chart(ctx).Doughnut(data);
</script>