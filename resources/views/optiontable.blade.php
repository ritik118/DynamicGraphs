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
      <th scope="col">value</th>
      <th scope="col">ques_id</th>
    </tr>
  </thead>
  <tbody>
  	@foreach ($alloption as $option)
    <tr>
      <th scope="row">{{$option->id}}</th>
      <td>{{$option->label}}</td>
      <td>{{$option->value}}</td>
      <td>{{$option->ques_id}}</td>
    </tr>
   @endforeach
    
  </tbody>
</table>

    </body>

    </html>



