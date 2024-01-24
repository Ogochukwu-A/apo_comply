<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DrugInteraction;
use Illuminate\Support\Facades\Http;

class DrugInteractionController extends Controller
{
    // Handles all the drug interaction 

    public function index(){ 

        $user_id = Auth()->user()->id; 

        $drugInteraction = DrugInteraction::where('user_id', $user_id)->latest()->get();

        return view('druginteraction')->with(['drugInteraction' => $drugInteraction]);
    }


    public function saveDrug(Request $request)
    {
        $request->validate([
            'search_input' => ['required', 'string', 'max:255']
        ]);

        $user_id = Auth()->user()->id;

        $search_input = $request->input('search_input');

        // fetch all the users drugs 

        $users_drugs = DrugInteraction::where('user_id', $user_id)->select('name')->get()->toArray();

        // check if the item already exists in the database 

        $drug_exists = DrugInteraction::where('user_id', $user_id)->select('name')->where('name', $search_input)->count();

        if ($drug_exists > 0) {
            toastr()->error('Drug already exists');
            return redirect()->back();
        }

        $nameArray = array_map(function ($item) {
            return $item['name'];
        }, $users_drugs);

        array_push($nameArray, $search_input);

        // pass the drug array to the expert for checks 
        $drug_interaction_response = $this->checkDrugInteraction($nameArray);

        $content = $drug_interaction_response['choices'][0]['message']['content'];

        // Create formatted content with HTML line breaks
        $formattedContent = nl2br($content);

        $drug_interaction = DrugInteraction::create([
            'user_id' => $user_id,
            'name' => $search_input
        ]);

        if (!$drug_interaction) {
            toastr()->error('Drug could not be added, Try again later');
            return redirect()->back();
        }

        toastr()->success('Drug Added Successfully');

        return redirect()->back()->with(['message' => $formattedContent]);
    }

   

    public function checkDrugInteraction(array $users_drugs)
    {
        // Set your OpenAI API key
        $apiKey = env('OPENAI_API_KEY');
    
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $apiKey,
        ])->post('https://api.openai.com/v1/chat/completions', [
            'model' => 'gpt-3.5-turbo',
            "messages"=> [
                [
                  "role"=> "system",
                  "content"=> "You are an pharmaceutical expert with several years of experience. You are to give detailed explanation to about the interaction of several drugs listed."
                ],
                [
                  "role"=> "user",
                  "content"=> "As an expert, Kindly review the following drugs and give exact / specific professional medical advice on their compactibility and interaction only. Please space your response appropriately for easy reading. Make it a maximum of 300 words Drugs - ". implode(', ', $users_drugs)
                ]
            ],
            'temperature' => 0.1,
            'max_tokens' => 3000,
        ]);
    
        // Debugging: Log the response
        logger($response);
    
        // Extract and return the generated response
        return $response->json();
    }

    public function deleteDrug(Request $request){
        
        $request->validateWithBag('drugDeletion', [
            'name' => ['required', 'string', 'max:255']
        ]);

        $name = $request->name;

        $drug = DrugInteraction::where('name',$name)->first();

        if(!$drug){

            toastr()->error('Sorry drug could not be found');
    
            return redirect()->back();
        }

        $delete_drug = $drug->delete();

        // get loggedin user 

        $user_id = Auth()->user()->id;

        // check for the drug for the 
        $users_drugs = DrugInteraction::where('user_id', $user_id)->select('name')->get()->toArray();

        $nameArray = array_map(function ($item) {
            return $item['name'];
        }, $users_drugs);

        // pass the drug array to the expert for checks 
        $drug_interaction_response = $this->checkDrugInteraction($nameArray);

        $content = $drug_interaction_response['choices'][0]['message']['content'];

        // Create formatted content with HTML line breaks
        $formattedContent = nl2br($content);
        
        if(!$delete_drug){

            toastr()->error('Drug could not be deleted');
    
            return redirect()->back();
        }

        toastr()->success('Drug Deleted Successfully');
    
        return redirect()->back()->with(['message' => $formattedContent]);
    }

}
