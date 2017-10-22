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
use App\User;

class CronController extends BaseController
{
    public function parse_page(Request $request){
        for ($i=205503;$i<206371;$i++){


        $text = file_get_contents('http://www.greatcare.co.uk/nanny-and-childcare-jobs/'.$i.'/russian-speaking-baby-nanny-needed---%C2%A31000p-w.html');
        $dom = new \DOMDocument();
        libxml_use_internal_errors(true);
        $dom->loadHTML($text);
        $element = $dom->getElementById('tblJobDetails');
        if(!$element)
            continue;
        $tables=$element->getElementsByTagName ('table');
        $tds=$tables[3]->getElementsByTagName('td');
        $apply = $dom->getElementById('tblApplyByEmail');
        if($apply)
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
        $image=$dom->getElementById('imgClient');
        $link=$dom->getElementById('aClient');
        if($link)
        $url = $link->getAttribute('href');
        else
            $url='http://www.greatcare.co.uk/recruiters/nannies_plus_us.html';
       $parts = explode('/',$url);
       if(count($parts)>4)
            $user = User::where('email',$parts[4].'@sumra.net')->first();
       else
           $user = User::where('email','nannies_plus_us.html@sumra.net')->first();

            if($image)
                $company =  $image->getAttribute('title');
            else
                $user->display_name;
            if($user===null){
                $user = new User;
                $user->email=$parts[4].'@sumra.net';
                $user->name=$company;
                $user->display_name=$company;
                $user->password= bcrypt('password');
                $user->phone='07777777777';
                // $user->more(['email' => 'g'.$body['source_id'].'@sumra.net', 'name' => $body['username'], 'password' => bcrypt('password'), 'phone' => '07777777777']);
                //  $user->id=(int)$body['user_id'];
                $user->save();
            }


        $phone = $dom->getElementById('tdTelephone');
        if(!$phone)
            $phone='07788778877';
        else
            $phone=$phone->nodeValue;
        echo $company;


        $advert = new Advert;
        $advert->category_id=$category;
        $advert->save();
        $advert->create_dd($user);



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
    public function indeed(Request $request){
        //PHP array containing forenames.
        $names = array(
            'Christopher',
            'Ryan',
            'Ethan',
            'John',
            'Zoey',
            'Sarah',
            'Michelle',
            'Samantha',
        );

//PHP array containing surnames.
        $surnames = array(
            'Walker',
            'Thompson',
            'Anderson',
            'Johnson',
            'Tremblay',
            'Peltier',
            'Cunningham',
            'Simpson',
            'Mercado',
            'Sellers'
        );


        $text=file_get_contents('https://www.indeed.co.uk/nanny-jobs-in-London-Borough-of-Hackney,-Greater-London');
        $dom = new \DOMDocument();
        libxml_use_internal_errors(true);
        $dom->loadHTML($text);
        $finder = new \DomXPath($dom);
        $classname="turnstileLink";
        $nodes = $finder->query("//*[contains(concat(' ', normalize-space(@class), ' '), ' $classname ')]");
        //echo $nodes[0]->getAttribute('href');
        $links=$nodes;
        for($i=0;$i<count($links);$i++) {


            $title = $links[$i]->nodeValue;
            $text = file_get_contents('https://www.indeed.co.uk' . $links[$i]->getAttribute('href'));
            $dom = new \DOMDocument();
            libxml_use_internal_errors(true);
            $dom->loadHTML($text);
            $finder = new \DomXPath($dom);
            $classname = "company";
            $nodes = $finder->query("//*[contains(concat(' ', normalize-space(@class), ' '), ' $classname ')]");
            echo $nodes[0]->nodeValue;
            //Generate a random forename.
            $random_name = $names[mt_rand(0, sizeof($names) - 1)];

//Generate a random surname.
            $random_surname = $surnames[mt_rand(0, sizeof($surnames) - 1)];

//Combine them together and print out the result.
            if ($nodes[0]->nodeValue === 'Private Family') {
                $fullname = $random_name . ' ' . $random_surname;
                $email = $random_name . $random_surname . '@sumra.net';
            } else {
                $fullname = $nodes[0]->nodeValue;
                $email = str_replace(' ', '', $nodes[0]->nodeValue) . '@sumra.net';
            }
            $user = User::where('email', $email)->first();
            if ($user === null) {
                $user = new User;
                $user->email = $email;
                $user->name = $fullname;
                $user->display_name = $fullname;
                $user->password = bcrypt('password');
                $user->phone = '07777777777';
                // $user->more(['email' => 'g'.$body['source_id'].'@sumra.net', 'name' => $body['username'], 'password' => bcrypt('password'), 'phone' => '07777777777']);
                //  $user->id=(int)$body['user_id'];
                $user->save();
            }
            $category = 418020000;
            $description = $dom->getElementById('job_summary')->nodeValue;
            echo $description;

            $advert = new Advert;
            $advert->category_id = $category;
            $advert->save();
            $advert->create_dd($user);


            $body = [];
            $body['title'] = $title;
            $body['category'] = $category;
            $body['description'] = $description;
            $body['location_id'] = 1250000000;
            $body['location'] = '52.2,0.13';
            $body['username'] = $user->display_name;
            $body['phone'] = $user->phone;
            $body['user_id'] = 0;
            $advert->update_fields($body);
            $advert->publish();
            echo 'done';
        }


    }

}