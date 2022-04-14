<?php
    namespace Rataq\Furgonetka;

    use Carbon\Carbon;
    use App\Http\Controllers\Controller;
    
    class FurgonetkaController extends Controller
    {
        public function transfersShow(){
            $access = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiJyYXRhcXBhY2thZ2UtODM0NzI1NzQxYmUxNzU4Zjk3ZjZmYmY3NTI2Yjg5ZTQiLCJqdGkiOiJhMTE4N2ZlZTRiZTg2ODI5MWQ2MTAyYTAyN2NjYzM0ZGUwMWU1NDgyODZmYThmYTVhMDUxYzU0N2U2MWMyNWM2NmM2NDY2ZjQ2Njg2OGJkNiIsImlhdCI6MTY0OTk1MDM1MS41MTU1OTEsIm5iZiI6MTY0OTk1MDM1MS41MTU1OTMsImV4cCI6MTY1MjU0MjM1MS41MTIyODQsInN1YiI6IjE3Mzk5ODIiLCJzY29wZXMiOlsiYXBpIl19.Cxi0jC7CGtSiAWfNMz0PL2fO8DyEbIIvy_vmqAwry2aah2ipHccit5xbhKtYQmDk-uoLwSZgVEIHQDJE-M6NXuEVvZ4c7ZsEt13uJcUDeSRS95D0-ymSVnq5YM7YnHkNRJbCaVqu2IxNzQA2QbURiMh10YDxZMKZsK8jxUQhew5Kj96hTJwAI13_drRN9FFY2ETjZSpLJjaoWWzXLUC07L7TOAQMQS2XLoP0TqfDvkx0v6IHLuo1YEi306Nevlj5VdSzTrU01ouGQPicAaZFXungRe5kCctgxvVuRZrJkqWfyyfcsRvnbCjMEEQaWKhKmtu_Dzsqn6J4lraQABSNOA';
            $q = FurgonetkaController::packages(0, null, null, null, $access);
            return $q;
        }
        public function packages($limit, $last_package_id, $list_type, $query, $access){
            $url = 'https://api.furgonetka.pl/packages';
            $headers = [
                'Content-Type: application/x-www-form-urlencoded',
                'Authorization: '.$access
            ];
            $data = [
                'limit' => $limit,
                'last_package_id' => $last_package_id,
                'list_type' => $list_type,
                'query' => $query
            ];
            $ch = curl_init( $url );
            curl_setopt( $ch, CURLOPT_HTTPHEADER, $headers);
            curl_setopt( $ch, CURLOPT_POSTFIELDS, $data );
            curl_setopt( $ch, CURLOPT_CUSTOMREQUEST, 'GET');
            curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
            $result = curl_exec($ch);
            curl_close($ch);
            $result = json_decode($result);
            return $result;
        }
        public function transfers($limit, $last_transfer_uuid, $transfer_type, $access){
            $url = 'https://api.furgonetka.pl/finances/transfers';
            $headers = [
                'Content-Type: application/x-www-form-urlencoded',
                'Authorization: '.$access
            ];
            $data = [
                'limit' => $limit,
                'last_transfer_uuid' => $last_transfer_uuid,
                'transfer_type' => $transfer_type
            ];
            $ch = curl_init( $url );
            curl_setopt( $ch, CURLOPT_HTTPHEADER, $headers);
            curl_setopt( $ch, CURLOPT_POSTFIELDS, $data );
            curl_setopt( $ch, CURLOPT_CUSTOMREQUEST, 'GET');
            curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
            $result = curl_exec($ch);
            curl_close($ch);
            $result = json_decode($result);
            return $result;
        }
        public function services($access){
            $url = 'https://api.furgonetka.pl/account/services';
            $headers = [
                'Content-Type: application/x-www-form-urlencoded',
                'Authorization: '.$access
            ];
            $ch = curl_init( $url );
            curl_setopt( $ch, CURLOPT_HTTPHEADER, $headers);
            curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
            $result = curl_exec($ch);
            curl_close($ch);
            $result = json_decode($result);
            return $result;
        }
        public function getCode()
        {
            if(env('FURGO_state') != null){
                $url = 'https://konto.furgonetka.pl/oauth/authorize?response_type=code&client_id='.env('FURGO_id').'&redirect_uri='.env('FURGO_return').'&state='.env('FURGO_state');
            }else{
                $url = 'https://konto.furgonetka.pl/oauth/authorize?response_type=code&client_id='.env('FURGO_id').'&redirect_uri='.env('FURGO_return');
            }
            return redirect($url);
        }
        public function auth(){
            $code = request()->get('code');
            
            $headers = [
                'Content-Type: application/x-www-form-urlencoded',
                'Authorization: Basic '.FurgonetkaController::b64()
            ];
            $url = 'https://konto.furgonetka.pl/oauth/token';
            $data = 'grant_type=password&scope=api&username='.env('FURGO_username').'&password='.env('FURGO_password');
            $method = 'POST';
            $q = FurgonetkaController::postCurl($url, $data, $headers, $method);
            return $q;
        }
        public function postCurl($url, $data, $headers, $method){
            $ch = curl_init( );
            curl_setopt( $ch, CURLOPT_URL, $url);
            curl_setopt( $ch, CURLOPT_ENCODING, '');
            curl_setopt( $ch, CURLOPT_CUSTOMREQUEST, $method);
            curl_setopt( $ch, CURLOPT_POSTFIELDS, $data );
            curl_setopt( $ch, CURLOPT_HTTPHEADER, $headers);
            curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
            
            $result = curl_exec($ch);
            curl_close($ch);
            return $result;
        }
        public function b64(){
            return base64_encode(env('FURGO_id').':'.env('FURGO_secret'));
        }
    }
?>