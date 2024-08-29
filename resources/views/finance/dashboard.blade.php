

<canvas id="myChart" width="400" height="400"></canvas>

<script>
	var ctx = $("#myChart").get(0).getContext("2d");
	var myNewChart = new Chart(ctx);

	var data = [
    {
        value: {{ $payable }},
        color:"#F7464A",
        highlight: "#FF5A5E",
        label: "Payable"
    },
    {
        value: {{ $receivable }},
        color: "#46BFBD",
        highlight: "#5AD3D1",
        label: "Receivable"
    },
    ];

	var myDoughnutChart = new Chart(ctx).Doughnut(data);
</script>