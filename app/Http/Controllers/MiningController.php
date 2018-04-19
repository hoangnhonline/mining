<?php
namespace App\Http\Controllers;
use App\Helpers\simple_html_dom;
use Mail;

class MiningController extends Controller
{
    
    public function transend(){

        $ch = curl_init();
        curl_setopt( $ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 5.1; rv:1.7.3) Gecko/20041001 Firefox/0.10.1" );
        curl_setopt( $ch, CURLOPT_URL, "https://pool.transendcoin.com/site/wallet_miners_results?address=TQ85Tqh6dtuYRS9oEuomtYY3cDGdtPxC9d" );   
         curl_setopt( $ch, CURLOPT_FOLLOWLOCATION, true );
        curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);         
        $result = curl_exec($ch);            
        curl_close($ch);
        
        $crawler = new simple_html_dom();
        
        $crawler->load($result);
        $miner = $crawler->find('.ssrow',0)->find('td', 1)->innertext;
        if($miner != 14){
            Mail::send('email',
                [                   
                    'so_may'             => 14-$miner
                ],
                function($message) {                    
                    $message->subject('Khách hàng gửi Tư vấn / Góp ý / Báo giá');
                    $message->to('hoangnhonline@gmail.com');                       
                    $message->from('web.0917492306@gmail.com', 'COIN TRANSEND');
                    $message->sender('web.0917492306@gmail.com', 'COIN TRANSEND');
            }); 
        }
       
    }
}