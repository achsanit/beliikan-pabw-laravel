<?php

namespace App\Http\Controllers\Api\Seller;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Service\Seller\CategoryService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    protected $serviceCategory;

    public function __construct(CategoryService $serviceCategory)
    {
        $this->serviceCategory = $serviceCategory;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $category = $this->serviceCategory->index();


        return ResponseFormatter::success($category,"success");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, CategoryService $serviceCategory)
    {
        //
        $validator = Validator::make($request->all(),[
            'name' => 'string|required|max:366',
            'image_url' => 'image|file|max:3072'
        ]);

        if ($validator->fails()) {
            # code...
            $message = $validator->getMessageBag();
            return ResponseFormatter::error(null, $message);
        }

        if($request->file('img_url')){
            $img_url = $request->file('img_url')->store('img-product');
        }

        $newCategory = [
            'name' => $request->name,
            'image_url' => $img_url
        ];

        $category = $serviceCategory->store($newCategory);

        if ($category) {
            # code...
            return ResponseFormatter::success($category, "new category has been created");
        } else {
            # code...
            return ResponseFormatter::error(null, "failed to create category");
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $data = $this->serviceCategory->show($id);

        if ($data) {
            # code...
            return ResponseFormatter::success($data, "get category success");
        } else {
            # code...
            return ResponseFormatter::error(null, "get category failed");
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, CategoryService $serviceCategory)
    {
        //
        $deleteCategory = $serviceCategory->deleteCategory($id);

        if ($deleteCategory) {
            # code...
            return ResponseFormatter::success(null,"delete category successfully");
        } else {
            return ResponseFormatter::error(null, "delete category unsuccess..");
        }
    }
}
