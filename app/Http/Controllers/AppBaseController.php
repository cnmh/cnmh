<?php

namespace App\Http\Controllers;

use App\Models\User;
use InfyOm\Generator\Utils\ResponseUtil;

/**
 * @OA\Server(url="/api")
 * @OA\Info(
 *   title="InfyOm Laravel Generator APIs",
 *   version="1.0.0"
 * )
 * This class should be parent class for other API controllers
 * Class AppBaseController
 */
class AppBaseController extends Controller
{


    public function callAction($method, $parameters)
    {

        $controller = class_basename(get_class($this));
        $action = $method;
        $permissions = $action . '-' . $controller; 
        // dd($permissions);
        $this->authorize($permissions);  
        return parent::callAction($method, $parameters);
    }

    
   

    public function sendResponse($result, $message)
    {
        return response()->json(ResponseUtil::makeResponse($message, $result));
    }

    public function sendError($error, $code = 404)
    {
        return response()->json(ResponseUtil::makeError($error), $code);
    }

    public function sendSuccess($message)
    {
        return response()->json([
            'success' => true,
            'message' => $message
        ], 200);
    }
}
