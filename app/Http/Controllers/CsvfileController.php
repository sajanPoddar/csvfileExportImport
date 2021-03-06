<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use Excel;

class CsvfileController extends Controller
{
    //
    public function importExport()
    {
    	return view('importexport');
    }
    public function downloadExcel(Request $request, $type)

	{

		$data = Item::get()->toArray();

		return Excel::create('testexcel', function($excel) use ($data) {

			$excel->sheet('mySheet', function($sheet) use ($data)

	        {

				$sheet->fromArray($data);

	        });

		})->download($type);

	}

	public function importExcel(Request $request)

	{


		if($request->hasFile('import_file')){

			$path = $request->file('import_file')->getRealPath();


			$data = Excel::load($path, function($reader) {})->get();
			// dd($data);


			if(!empty($data) && $data->count()){


				foreach ($data->toArray() as $key => $value) {

						$id = $value['id'];
						if(!empty($value)){
							$insert['title'] =  $value['title'];
							$insert['description']  = $value['description'];


						}
					if(!empty($insert)){

						$q = Item::find($id);
						if($q != null)
						{	
							// dd('test');
							$r =	$q->update($insert);
							
						}
						else
						{
						Item::insert($insert);

						
						} 

						}
					
				}
				return back()->with('success','Insert Record successfully.');


				

				


			}


		}


		return back()->with('error','Please Check your file, Something is wrong there.');

	}
	public function map()
	{
		$items = Item::all();
                //$items = Item::distance(0.1,'45.05,7.6667')->get();
 	
		return view('map')->with(['items'=>$items]);
	}
}
