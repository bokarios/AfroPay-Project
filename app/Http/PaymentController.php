<?php

namespace CreatyDev\Http;

use CreatyDev\App\Controllers\Controller;
use Illuminate\Http\Request;
use phpseclib\Crypt\RSA;

class PaymentController extends Controller
{
    private $tmk = 'D020855E862F2A4F';
    private $terminal_id = '18000415';

    /**
     * 
     */
    public function pay(Requset $requset)
    {
        try{
            $this->validate($request, [
                'pan' => 'required|unique|max:17',
                'pin' => 'required|max:4',
                'amount' => 'required',
            ]);

            $terminal_id = $this->terminal_id;
            $transDateTime = Carbon\Carbon::now();
            $systemTraceAuditNumber = 40;
            $pan = $requset->$_POST['pan'];
            $pin = binInc($requset->$_POST['pin']);
            $expDate = $requset->$_POST['expdate'];
            $tranCurrencyCode = 'SDG';
            $tranAmount = $requset->$_POST['amount'];

            $data = array(
                'terminalId' => $terminal_id,
                'tranDateTime' => $transDateTime,
                'systemTraceAuditNumber' => $systemTraceAuditNumber,
                'PAN' => $pan,
                'PIN' => $pin,
                'expDate' => $expDate,
                'tarnCurrencyCode' => $tranCurrencyCode,
                'tranAmount' => $tranAmount
            );
            
            // Send request to morsal
            $response = Curl::to('212.0.129.118/terminal_api/transactions/purchase/')
            ->withData($data)
            ->post();

            return $response;
            
        }catch(Exception $e){
            echo 'Exception: '.$e;
        }

    }

    /**
     * PINBLOCK encryption
     */
    public function binInc($buffer)
    {
        // making request to get workingKey
        $response = Curl::to('212.0.129.118/terminal_api/workingKey/')
        ->withData( array( 
            'terminalId' => $this->terminal_id,
            'systemTraceAuditNumber' => 8,
            'tranDateTime' => Carbon\Carbon::now()
            ) 
        )
        ->post();

        // Decrypt workingKey
        $des_key = des($this->tmk, $response->workingKey, 0, 0, null, 2);

        //TODO: make the algorithem
        $rsa = new RSA();
        $rsa->loadKey($this->des_key);
        $rsa->setEncryptionMode(2); //
        return base64_encode($rsa->encrypt($buffer));
    }
}
