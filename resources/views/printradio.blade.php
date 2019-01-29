@extends('layouts.printl')

    @section('content')
      <div class="alert alert-primary d-none" role="alert" id="alert">
  Comment is saved in the database successfully !!!!
</div>
       

       <div class="spinner-border d-none" id="spin"></div>
       
       <div class="row ml-1 mr-1">
         <div class="col-md-10">
          <div id="print_chart">
            <div id="chart_div" style="width: 100%;height:340px;">
              
            </div>
            <div class="card mb-1">
                <h5 class="card-header"> Comment</h5>
  
                  <textarea rows="4" style="width: 100%;border-width:0px; resize: none;font-weight: bold;" id="comment" readonly>
                    {{$comment[0]->comment}}
                  </textarea>
           </div>
              </div>
              <br>
              <button class="btn btn-primary mb-3" onclick="saveComment();">Save Comment</button>
              <button class="btn btn-primary mb-3" onclick="editComment();">Edit your Comment</button>
         </div>

         <div class="col-md-2 mb-5 mt-5">
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
  @endsection