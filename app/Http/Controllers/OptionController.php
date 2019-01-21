<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Questioning;
use App\Option;
class OptionController extends Controller
{
    

	public function store(){
		
		$path=storage_path()."/json/rawdata.json";
$json =file_get_contents($path);
$jsonarray=json_decode($json,true);
$n=sizeof($jsonarray);
$label=array();
$name=array();
$count=0;
for($i=0;$i<$n;$i++){
	if($jsonarray[$i]['type'] == "radio-group"){
	$label[$count]=$jsonarray[$i]['label'];
	$name[$count]=$jsonarray[$i]['name'];
	$count++;
}
}
 for($i=1; $i<=sizeof($label); $i++){
$post = Questioning::find($i);
$label1=$post->label;

for($j=0;$j<$n;$j++) {
	if($jsonarray[$j]['label'] == $label1){
		foreach ($jsonarray[$j]['values'] as $key => $value) {
			$l=$value['label'];
			$v=$value['value'];
			$data=[
			'label'=>$l,
			'value'=>$v,
			'ques_id'=>$i
		];
		//Option::create($data);
		}
		
	}
}
}


	// for($i=0; $i<sizeof($label); $i++){
	// 	$data=[
	// 		'label' => $label[$i],
	// 		'name' => $label[$i]
	// 	];
	// 	Questioning::create($data);
	// 	}
 	}

 	public function search(){
 		$options=Option::all();
        
        return View('optiontable')->with('alloption',$options);
 	}

}
