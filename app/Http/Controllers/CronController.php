<?php
/**
 * Created by PhpStorm.
 * User: anil
 * Date: 21/10/2017
 * Time: 17:55
 */

namespace App\Http\Controllers;

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
        echo $tds[0]->nodeValue;



    }

}