<?php

namespace App\Http\Controllers;

use App\Models\PropagationModel;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    protected $promotionModel;

    public function __construct(PropagationModel $model)
    {
        $this->promotionModel = $model;
    }

    public function index()
    {
        $img = new \Imagick();
        $img->newImage( 200, 200, new \ImagickPixel( 'lime' ) );
        $img->setImageFormat( "png" );
        header( "Content-Type: image/png" );
        echo $img;
        exit();
    }

    public function list_find()
    {
        $arr = [];
        $pipeline = [
            ['$sort' => ['time' => 1]],
            ['$group' => ['_id' => '$activity_id', 'arr' => ['$push' => ['id' => '$_id', 'activity_id' => '$activity_id', 'time'=> '$time']]]],
//            ['$unwind' => ['']]
//            ['$group' => ['_id' => null, 'total' => ['$sum'=>1]]]
            ['$limit' => 30]
        ];
        $allow = ['allowDiskUse' => true];
        $list = $this->promotionModel->aggregate($pipeline, $allow);
        foreach($list as $obj)
        {
            $data = [];
            foreach ($obj->arr as $item)
            {
                $data[] = (array)$item;
            }
            $arr[$obj->_id] = $data;
        }

        dd($arr);
    }

    public function record()
    {

    }
}
