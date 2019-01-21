<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript" src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js">
        </script>
    

   


           <script type="text/javascript">
    
    // Load the Visualization API and the piechart package.
    google.charts.load('current', {'packages':['corechart']});
      google.charts.load('current', {'packages':['table']});
    // Set a callback to run when the Google Visualization API is loaded.
   google.charts.setOnLoadCallback(drawChart);

    
    function drawChart(){
      
      var e = document.getElementById("graph");
      var b = e.options[e.selectedIndex].value;

      var choice = document.getElementById("testbox");
      var strUser = choice.options[choice.selectedIndex].value;
      
       
      var jsonData = $.ajax({
          type:'GET',
          url: "/radio",
          data: {
            ac:strUser,
          },
          beforeSend:function(){
            $('#spin').removeClass('d-none');
          },
          async:false,
          success:function(){
            $('#spin').addClass('d-none');
          }
          }).responseText;
      var data = new google.visualization.DataTable(jsonData);

      var options = {
        title:strUser,
        legend:{position:'right'},
        chartArea:{width:'90%',height:'60%'},
        is3D:true
      };
      if(b== "piechart"){
        var chart = new google.visualization.PieChart(document.getElementById('chart_div'));
      chart.draw(data,options);
      }
      else if (b== "tablechart") {
      var chart = new google.visualization.Table(document.getElementById('chart_div'));
      chart.draw(data,options);
    }
    else if(b== "linechart") {
      var chart = new google.visualization.LineChart(document.getElementById('chart_div'));
      chart.draw(data,options);
    }
    else if (b== "barchart") {
      var chart = new google.visualization.BarChart(document.getElementById('chart_div'));
      chart.draw(data,options);
    }
    else {
      var chart = new google.visualization.ColumnChart(document.getElementById('chart_div'));
      chart.draw(data,options);
    }
    }

    
    
 </script>

    </head>

    <body>
       <div class="spinner-border d-none" id="spin"></div>
        <div id="chart_div" style="width: 100%;height:300px;"></div>
       

         <label for="testbox">Select a parameter to create graph</label>
  <div class="row">
    <div class="col-md-7 text-center">
  <div class="form-group">
    
    <select class="form-control text-center custom-select" id="testbox" onchange="drawChart();">
     @foreach ($label as $l)
            <option value="{{$l->label}}">{{$l->label}}</option>
            @endforeach
    </select>
   
  </div>
  </div>
  <div class="col-md-4">
   <select class="form-control text-center custom-select" id="graph" onchange="drawChart();">
     
            <option value="piechart" selected>piechart</option>
            <option value="linechart">linechart</option>
            <option value="barchart">barchart</option>
            <option value="columnchart">columnchart</option>
            <option value="tablechart">tablechart</option>
            
    </select>
  </div>
  <div class="col-md-1"></div>
</div>


       
         
     

    

    </body>


    </html>