<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;

use App\Models\AiChat;

class ChatbotController extends Controller
{

    public function index(){

        $user_id = Auth()->user()->id;

        $fetch_user_chats = AiChat::where('user_id',$user_id)
            ->orderBy('created_at', 'desc')->simplePaginate(5);

        // return gettype($fetch_user_chats);

        return view('chatbot')->with(['chat_history' => $fetch_user_chats]);
    }

    public function getChatGPTResponse($userInput)
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
                  "content"=> "You are an pharmaceutical expert with several years of experience. You are to give detailed explanation to users. Summarise it into 300 words. "
                ],
                [
                  "role"=> "user",
                  "content"=> $userInput
                ]
            ],
            'temperature' => 0.2,
            'max_tokens' => 300,
        ]);
    
        // Debugging: Log the response
        logger($response);
    
        // Extract and return the generated response
        return $response->json();
    }

    public function getBotResponse(Request $request)
    {
        $userInput = $request->input('chat_input');
        
        // Call the function to get the OpenAI GPT response
        $response = $this->getChatGPTResponse($userInput);

        // Return the bot response
        // return $botResponse;

        // save the response for chat history purposes 
        
        // let the response be this array 

        // $response = [
        //     "id"=> "chatcmpl-8bQcm4hCoBJ0GLZ9AuyWArUu28RTH",
        //     "object"=> "chat.completion",
        //     "created"=> 1703931172,
        //     "model"=> "gpt-3.5-turbo-0613",
        //     "choices"=> [
        //       [
        //         "index"=> 0,
        //         "message"=> [
        //           "role"=> "assistant",
        //           "content"=> "Paracetamol, also known as acetaminophen, is a commonly used over-the-counter medication for pain relief and reducing fever. It belongs to a class of drugs known as analgesics or pain relievers. Paracetamol is widely available in various forms such as tablets, capsules, syrups, and even as a component in combination medications.\n\nParacetamol works by blocking the production of certain chemicals in the brain that cause pain and fever. It is particularly effective in relieving mild to moderate pain, such as headaches, toothaches, muscle aches, and menstrual cramps. It can also help reduce fever associated with various illnesses.\n\nOne of the advantages of paracetamol is its relatively low risk of side"
        //         ],
        //         "logprobs"=> null,
        //         "finish_reason"=> "length"
        //       ]
        //     ],
        //     "usage"=> [
        //       "prompt_tokens"=> 35,
        //       "completion_tokens"=> 150,
        //       "total_tokens"=> 185
        //     ],
        //     "system_fingerprint"=> null
        // ];

        // return $response['choices'][0]['index'];

        $chat_id = $response['id'];
            $user_id = Auth()->user()->id;
            $model = $response['model'];
            $object = $response['object'];
            $prompt_tokens = $response['usage']['prompt_tokens'];
            $completion_tokens = $response['usage']['completion_tokens'];
            $total_tokens = $response['usage']['total_tokens'];
            $system_fingerprint = $response['system_fingerprint'];
            $index = $response['choices'][0]['index'];
            $role = $response['choices'][0]['message']['role'];
            $content = $response['choices'][0]['message']['content'];
            $logprobs = $response['choices'][0]['logprobs'];
            $finish_reason = $response['choices'][0]['finish_reason'];

            $search_term = $userInput;

        $data = [
            'chat_id' => $response['id'],
            'user_id' => Auth()->user()->id,
            'model' => $model,
            'object' => $object,
            'prompt_tokens' => $prompt_tokens,
            'completion_tokens' => $completion_tokens,
            'total_tokens' => $total_tokens,
            'system_fingerprint' => $system_fingerprint,
            'index' => $index,
            'role' => $role,
            'content' => $content,
            'logprobs' => $logprobs,
            'finish_reason' => $finish_reason,
            'search_term' => $search_term
        ];

        // finally saving it to db for history sake 

        $this->saveAiChat($data);

        $user_id = Auth()->user()->id;

        $fetch_user_chats = AiChat::where('user_id',$user_id)->orderBy('created_at', 'desc')->simplePaginate(5);

        // return ($fetch_user_chats);

        return back()->with(['chat_history' => $fetch_user_chats,'result' => nl2br($content) ]);
    }

    public function saveAiChat(array $data){
        // chat_id,user_id,model,object,prompt_tokens,completion_tokens,total_tokens,system_fingerprint
        // index,role,content,logprobs,finish_reason

        $chat_id = $data['chat_id'];

        // return $chat_id;
        $user_id = $data['user_id'];
        $model = $data['model'];
        $object = $data['object'];
        $prompt_tokens = $data['prompt_tokens'];
        $completion_tokens = $data['completion_tokens'];
        $total_tokens = $data['total_tokens'];
        $system_fingerprint = $data['system_fingerprint'];
        $index = $data['index'];
        $role = $data['role'];
        $content = $data['content'];
        $logprobs = $data['logprobs'];
        $finish_reason = $data['finish_reason'];
        $search_term = $data['search_term'];
        
        try {
            $save_data = AiChat::create([
                'chat_id' => $chat_id,
                'user_id'=> $user_id,
                'model' => $model,
                'object' => $object,
                'prompt_tokens' => $prompt_tokens,
                'completion_tokens' => $completion_tokens,
                'total_tokens' => $total_tokens,
                'system_fingerprint' => $system_fingerprint,
                'index' => $index,
                'role' => $role,
                'content' => nl2br($content), // use {!! $content_goes_here !!} to display it 
                'logprobs' => $logprobs,
                'finish_reason' => $finish_reason,
                'search_term' => $search_term
            ]);

            toastr()->info('Chat history saved successfully');

        } catch (e $error){
            
            toastr()->info('Chat could not be saved');

            toastr()->error($error);
        }
    }
}
