
    // Load the Visualization API and the piechart package.
    google.charts.load('current', {'packages':['corechart']});
    // Set a callback to run when the Google Visualization API is loaded.
   google.charts.setOnLoadCallback(drawChart);

    
    function drawChart(){
      $('#comment').prop('readonly', true);
      $('#comment').addClass("bg-light");
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

    function editComment(){
      $('#comment').prop('readonly', false);
      $('#comment').removeClass("bg-light");
    }


    function saveComment(){
      $('#comment').prop('readonly', true);
      $('#comment').addClass("bg-light");
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
