<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
 use App\Questioning;
use App\Answer;
class QuestioningController extends Controller
{

	public function index(){
    	 $labels=Questioning::all('label');
    	 $comment=Questioning::find(1)->comments()->get();
    	 
    	return View('printradio')->with('label',$labels)->with('comment',$comment);
	}

	public function store(){
		
// 		$path=storage_path()."/json/rawdata.json";
// $json =file_get_contents($path);
// $jsonarray=json_decode($json,true);
// $n=sizeof($jsonarray);
// $label=array();
// $name=array();
// $count=0;
// for($i=0;$i<$n;$i++){
// 	if($jsonarray[$i]['type'] == "radio-group"){
// 	$label[$count]=$jsonarray[$i]['label'];
// 	$name[$count]=$jsonarray[$i]['name'];
// 	$count++;
// }
// }


// 	for($i=0; $i<sizeof($label); $i++){
// 		$data=[
// 			'label' => $label[$i],
// 			'name' => $name[$i]
// 		];
// 		Questioning::create($data);
// 		}




 	}
 	public function getId(Request $request){
 		$choice=$request->choices;
 		$choices=Questioning::select('id')->where('label','=',$choice)->get();
 		return response()->json($choices);
 	}

 	public function searchcomment(Request $request){
 		$a=$request->ac;
 		$ques_idd=Questioning::select('id')->where('label','=',$a)->get();
 		
 		$comment=Questioning::find($ques_idd[0]->id)->comments;
 		
 		return response()->json($comment);
 	}


 	public function search(Request $request){
 		$a=$request->ac;
 		$question=new Questioning;
 		$ques_idd=Questioning::select('id')->where('label','=',$a)->get();
 		$ques_id=$ques_idd[0]['id'];
 		$options = Questioning::find($ques_id)->options;
 		
 		$count=array();
 		foreach ($options as $op) {
 			$opid=$op->id;
 			
 			$count[] = Answer::where('option_id','=',$opid)->count();
 			//$count[] = Questioning::find($opid)->answers->count();
 		}
 		
 		
 		$rows=array();
		$table=array();
		$table['cols']=array(
			array(
				'type'=>'string',
				'label'=>$a
				
			),	
			array(
				'type'=>'number',
				'label'=>'count'
				
			)
		);
		$i=0;
		foreach ($options as $row){

			$sub_array=array();
			$sub_array[]=array(
				"v"=>$row->label
			);
			$sub_array[]=array(
				"v"=>$count[$i]
			);
			$rows[]=array(
				"c"=>$sub_array
			);
			$i=$i+1;
		}
		$table['rows']=$rows;

		return response()->json($table);

 	}


}
