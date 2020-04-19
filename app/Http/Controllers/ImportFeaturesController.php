<?php

namespace App\Http\Controllers;

use App\Http\Requests\ImgFilter;
use App\Models\TmpImg;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class ImportFeaturesController extends Controller
{
    //

    /**
     * 完成图片上传功能
     * @param Request $imgFilter
     * @return \Illuminate\Http\JsonResponse
     */
    public function uploadImg(Request $imgFilter)
    {

        $path = $imgFilter->file('file')->store('images');

        $data = Arr::only($imgFilter->post(), [
            'uid','name'
        ]);

        $data['img_path'] = $path;

        $model_res = TmpImg::create($data);

        if ($model_res)
        {
            $res = true;
        }else{
            $res = false;
        }

        return response()->json(['status'=>$res, 'result' => $path, 'url' => asset($path), 'data' => $model_res->toArray()]);
    }

    /**
     * xls文件导入
     * @param Request $request
     */
    public function uploadXls(Request $request)
    {

    }
}
