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
        <script src="{{asset('js/html2canvas.min.js')}}"></script>
        <style type="text/css">

          canvas {
            max-width: 100%;
            max-height: 100%;
          }

        </style>
           <script type="text/javascript">

    
    // Load the Visualization API and the piechart package.
    google.charts.load('current', {'packages':['corechart']});
    // Set a callback to run when the Google Visualization API is loaded.
   google.charts.setOnLoadCallback(drawChart);

    
    function drawChart(){
      $('#alert').addClass("d-none");
      var e = document.getElementById("graph");
      var b = e.options[e.selectedIndex].value;

      var choice = document.getElementById("testbox");
      var strUser = choice.options[choice.selectedIndex].value;
      
      var comment=document.getElementById("comment").value;
       
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
      var jsoncomment = $.ajax({
          type:'GET',
          url: "/radiocom",
          data: {
            ac:strUser,
          },
          async:false,
          }).responseText;
         var obj=JSON.parse(jsoncomment);
         var comment=obj['comment'];
         document.getElementById("comment").value=comment;
      var data = new google.visualization.DataTable(jsonData);

      var options = {
        title:strUser,
        legend:{position:'right'},
        chartArea:{width:'90%',height:'60%'},
        is3D:true
      };
      if(b== "piechart"){
        var chart = new google.visualization.PieChart(document.getElementById('chart_div'));
        
      }
    else if(b== "linechart") {
      var chart = new google.visualization.LineChart(document.getElementById('chart_div'));
      
    }
    else if (b== "barchart") {
      var chart = new google.visualization.BarChart(document.getElementById('chart_div'));
    }
    else {
      var chart = new google.visualization.ColumnChart(document.getElementById('chart_div'));
    }
    chart.draw(data,options);

    }

    function getScreenshot(){
      var choice = document.getElementById("testbox");
      var strUser = choice.options[choice.selectedIndex].value;
      html2canvas(document.getElementById("print_chart")).then(function(canvas){
          $('#blank').attr('href',canvas.toDataURL("image/png"));
          $('#blank').attr('download',strUser+".png");
          $('#blank')[0].click();
      });

    }


    function saveComment(){
      var choice = document.getElementById("testbox");
      var strUser = choice.options[choice.selectedIndex].value;
      var comment=document.getElementById("comment").value;
      console.log(strUser,comment);
     var jsonid = $.ajax({
        type:'GET',
        url:'/getid',
        data:{
          choices:strUser,
        },
        async:false,
      }).responseText;
      var obj=JSON.parse(jsonid);
      var id=obj[0]['id'];
      $.ajax({
        type:'GET',
        url:'/postcomment',
        data:{
          comments:comment,
          choices:id,
        },
        async:false,
      });
      $('#alert').removeClass("d-none");
    }

    
    
 </script>

    </head>

    <body>
      <div class="alert alert-primary d-none" role="alert" id="alert">
  Comment is saved in the database successfully !!!!
</div>
       

       <div class="spinner-border d-none" id="spin"></div>
       
       <div class="row">
         <div class="col-md-10">
          <div id="print_chart">
            <div id="chart_div" style="width: 100%;height:340px;">
              
            </div>
            <div class="card mb-1">
                <h5 class="card-header"> Comment</h5>
  
                  <textarea rows="4" style="width: 100%;border-width:0px; resize: none;font-weight: bold;" id="comment" >
                    {{$comment[0]->comment}}
                  </textarea>
           </div>
              </div>
              <button class="btn btn-primary mb-3" onclick="saveComment();">Save Comment</button></br>
         </div>

         <div class="col-md-2 mt-5">
           <a href="javascript:getScreenshot();" class="btn btn-outline-primary">Download the graph</a>
           <a href="" id="blank"></a>
         </div>
       </div>
        
    

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
            
    </select>
  </div>
  <div class="col-md-1"></div>
</div>
    </body>
    </html>