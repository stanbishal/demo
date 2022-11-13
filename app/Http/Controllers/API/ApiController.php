<?php

namespace App\Http\Controllers\API;

use App\Models\Link;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;

class ApiController extends Controller
{
    use ApiResponse;
    
    private $link;

    public function __construct(Link $link)
    {
        $this->link = $link;
    }

    public function index(): JsonResponse
    {
        $links = $this->link->all();
        return $this->successResponse($links);
    }

    public function view(int $id): JsonResponse
    {
        $data = $this->link->find($id);
        return $data ? $this->successResponse($data) : $this->failedResponse("failed",'Sorry Invalid Id');
    }

    public function delete(int $id): JsonResponse
    {
  
        $link = $this->link->whereId($id)->first();
        if($link) {
            $link->delete();            
            return $this->successResponse(null,"success","Deleted Successfully",Response::HTTP_OK);
        } else{
            return $this->failedResponse("failed","URL not found");
        }
    }

    public function getLinkDetails(Request $request): JsonResponse
    {
        $link = $this->link->where($request->field,$request->value)->first();
        return $link 
            ? $this->successResponse($link) 
            : $this->failedResponse("failed","URL not found"); 
    }

}
