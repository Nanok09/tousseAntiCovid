<?php
// Si la page est appelée directement par son adresse, on redirige en passant pas la page index
if (basename($_SERVER["PHP_SELF"]) != "index.php")
{
	header("Location:../index.php");
	die("");
}




  $query = "SELECT * FROM `test`";

  
  $PDO = SQLSelect($query);
  $data = parcoursRs($PDO);


?>



<div class="container">
	<div class="row">
		<div id="my_dataviz">
			
		</div>
	</div>
</div>


<div class="container">
  <div class="row">
    <div id="id1">
    </div>
  </div>
</div>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js" integrity="sha384-q2kxQ16AaE6UbzuKqyBE9/u/KzioAlnx2maXQHiDX9d4/zp8Ok3f+M7DPm+Ib6IU" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-pQQkAEnwaBkjpqZ8RU1fF1AKtTcHJwFl3pblpTlHXybJjHpMYo79HY3hIi4NKxyj" crossorigin="anonymous"></script>
    -->
<script src="https://d3js.org/d3.v4.js"></script>


<script>
  var data = <?php echo(json_encode($data));?>;
  console.log(data);

var mesure1 = data[0].date;

var L = [];
console.log(mesure1.split(","));
var M = mesure1.split(",");
console.log(parseInt(M[1]));
for (var i = 0; i < M.length; i++) {
  L.push(parseInt(M[i]));
}

var fonctionCool = function(mesure){
  var L = [];
  var M = mesure.split(",");
  for (var i = 0; i < M.length; i++) {
    L.push(parseInt(M[i]));
  }
  var dateCool = new Date(...L);
  return dateCool
}


console.log(L);

var date1 = new Date(...L);
console.log(date1);
// set the dimensions and margins of the graph
var margin = {top: 25, right: 30, bottom: 30, left: 60},
    width = 560 - margin.left - margin.right,
    height = 480 - margin.top - margin.bottom;
// append the svg object to the body of the page
var svg = d3.select("#my_dataviz")
  .append("svg")
    .attr("width", width + margin.left + margin.right)
    .attr("height", height + margin.top + margin.bottom)
  .append("g")
    .attr("transform",
          "translate(" + margin.left + "," + margin.top + ")");


  


    console.log(data)
    for (var i = 0; i < data.length; i++) {
      var truc = fonctionCool(data[i].date)
      data[i].date = truc;
    }
    console.log(data);
    // Add X axis --> it is a date format
    var x = d3.scaleTime()
      .domain(d3.extent(data, function(d) { return d.date; }))
      .range([ 0, width ]);
    svg.append("g")
      .attr("transform", "translate(0," + height + ")")
      .call(d3.axisBottom(x));
    // Add Y axis
    var y = d3.scaleLinear()
      .domain( [0, 30])
      .range([ height, 0 ]);
    svg.append("g")
      .call(d3.axisLeft(y));
    // Add the line
    svg.append("path")
      .datum(data)
      .attr("fill", "none")
      .attr("stroke", "#69b3a2")
      .attr("stroke-width", 1.5)
      .attr("d", d3.line()
        .x(function(d) { return x(d.date) })
        .y(function(d) { return y(d.accel) })
        )
    // Add the points
    svg
      .append("g")
      .selectAll("dot")
      .data(data)
      .enter()
      .append("circle")
        .attr("cx", function(d) { return x(d.date) } )
        .attr("cy", function(d) { return y(d.accel) } )
        .attr("r", 5)
        .attr("fill", "#69b3a2")

    svg.append("text")
        .attr("x", (width / 2))             
        .attr("y", 0 - (margin.top / 2))
        .attr("text-anchor", "middle")  
        .style("font-size", "16px") 
        .style("text-decoration", "underline")  
        .text("Accélération en fonction du temps");
</script>


