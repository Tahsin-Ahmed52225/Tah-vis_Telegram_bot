<?php

namespace App\Http\Controllers;

use App\Service\WebView\TaskManager;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class WebAppController extends Controller
{
    private $manager;

    public function getTasks(Request $request){
        $this->manager = new TaskManager($request->user_id);
        $response = $this->manager->getTasksForWebApp();

        return JsonApiResponse(Response::HTTP_OK,'success',$response);
    }
}
