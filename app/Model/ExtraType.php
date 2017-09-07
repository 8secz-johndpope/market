<?php
/**
 * Created by PhpStorm.
 * User: sumra
 * Date: 07/09/2017
 * Time: 13:49
 */

namespace App\Model;
use Illuminate\Database\Eloquent\Model;


class ExtraType extends Model
{
    public function prices($category,$lat,$lng)
    {
        $current = Category::find($category);
        while($current!==null){
            $prices = ExtraPrice::where('category',$current->id)->where('min_lat','<',$lat)->where('max_lat','>',$lat)->where('min_lng','<',$lng)->where('max_lng','>',$lng)->get();
            if($prices===null){
                $current=$current->parent;
            }else{
                return $prices;
            }

        }
        return ExtraPrice::find(1);
    }
}