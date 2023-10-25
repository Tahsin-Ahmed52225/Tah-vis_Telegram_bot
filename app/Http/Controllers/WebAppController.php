<?php

namespace App\Http\Controllers;

use App\Service\WebView\TaskManager;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class WebAppController extends Controller
{
    private $manager;

    public function getTasks(Request $request)
    {
        // @todo need to think what to do if user_id is missing
        $this->manager = new TaskManager($request->user_id);
        $response = $this->manager->getTasks();

        return JsonApiResponse(Response::HTTP_OK, 'success', $response);
    }

    public function updateTask(Request $request)
    {
        // @todo there's a delay based on the API request
        $this->manager = new TaskManager($request->user_id);
        $response = $this->manager->updateTask($request->task);
        return JsonApiResponse(Response::HTTP_OK, 'success', $response);
    }
}
