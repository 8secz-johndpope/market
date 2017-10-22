<?php
/**
 * Created by PhpStorm.
 * User: anil
 * Date: 21/10/2017
 * Time: 17:55
 */

namespace App\Http\Controllers;

use App\Model\Advert;
use Illuminate\Http\Request;


class CronController extends BaseController
{
    public function parse_page(Request $request){
        $text = file_get_contents('http://www.greatcare.co.uk/nanny-and-childcare-jobs/206372/russian-speaking-baby-nanny-needed---%C2%A31000p-w.html');
        $dom = new \DOMDocument();
        libxml_use_internal_errors(true);
        $dom->loadHTML($text);
        $element = $dom->getElementById('tblJobDetails');
        $tables=$element->getElementsByTagName ('table');
        $tds=$tables[3]->getElementsByTagName('td');
        $apply = $dom->getElementById('tblApplyByEmail');
        $apply->parentNode->removeChild($apply);
            //echo $dom->saveHTML($tds[0]);
        $lines=[];
        foreach ($tds[0]->childNodes as $node){
          //  echo $node->nodeValue;
          //  echo "<br>";
            $lines[]=$node->nodeValue;
        }
        $title=$dom->getElementById('hTitle')->nodeValue;
        if(strpos(strtolower($title),'live-in')!==false)
            $category=418010000;
        else if(strpos(strtolower($title),'live-out')!==false)
            $category=418020000;
        else if(strpos(strtolower($title),'maternity')!==false)
            $category=418030000;
        else
            $category=418050000;
        $name=$dom->getElementById('pContactName')->nodeValue;
        $image=$dom->getElementById('imgClient');
        $link=$dom->getElementById('aClient');
        $url = $link->getAttribute('href');
       $parts = explode('/',$url);
        return $parts;

        $advert = new Advert;
        $advert->category_id=$category;
        $advert->save();
        $advert->create_draft();


        $company =  $image->getAttribute('title');
        $phone = $dom->getElementById('tdTelephone');
        if(!$phone)
            $phone='07788778877';
        else
            $phone=$phone->nodeValue;
        echo $company;
        $body=[];
        $body['title']=$title;
        $body['category']=$category;
        $body['description']=implode("\n",$lines);
        $body['location_id']=1250000000;
        $body['location']='52.2,0.13';
        $body['username']=$company;
        $body['phone']=$phone;
        $body['user_id']=0;
        $advert->update_fields($body);
        $advert->publish();
        echo 'done';

    }

}