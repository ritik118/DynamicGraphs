<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    </head>

    <body>
    	
    	<table class="table table-bordered">
  <thead>
    <tr>
      <th scope="col">id</th>
      <th scope="col">label</th>
      <th scope="col">name</th>
    </tr>
  </thead>
  <tbody>
  	@foreach ($allquestion as $ques)
    <tr>
      <th scope="row">{{$ques->id}}</th>
      <td>{{$ques->label}}</td>
      <td>{{$ques->name}}</td>
      
    </tr>
   @endforeach
    
  </tbody>
</table>

    </body>

    </html>



