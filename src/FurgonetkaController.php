<?php
    namespace Rataq\Furgonetka;

    use Carbon\Carbon;
    use App\Http\Controllers\Controller;
    
    class FurgonetkaController extends Controller
    {
        public function getLabel($packageID, $pageFormat, $access){
            $url = 'https://api.furgonetka.pl/packages/'.$packageID.'/label';
            $headers = [
                'Content-Type: application/x-www-form-urlencoded',
                'Authorization: '.$access
            ];
            $data = [
                'label' => (object)[
                    'page_format' => $pageFormat
                ]
            ];
            $ch = curl_init( $url );
            curl_setopt( $ch, CURLOPT_HTTPHEADER, $headers);
            curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
            curl_setopt( $ch, CURLOPT_CUSTOMREQUEST, 'GET');
            curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
            $result = curl_exec($ch);
            curl_close($ch);
            $result = json_decode($result);
            return $result;
        }
        public function createPackage($type, $packages, $services, $receiver, $user_reference_number, $service_id, $codAmount, $codCurrency, $codExpress, $codIban, $codName, $codSwift, $codTransferDone, $codTransferDateInfo, $rod,
        $cud, $private_shipping, $guarantee_0930, $guarantee_1200,$saturday_delivery, $additional_handling, $sms_predelivery_information, $documents_supply, $saturday_sunday_delivery, $guarantee_next_day, $fedex_priority, $ups_saver, $valuable_shipment,
        $fragile, $personal_delivery, $poczta_kurier48, $registered_letter, $registered_company_letter, $registered_letter_international, $poczta_globalexpres, $delivery_confirmation, $waiting_time, $deligoo_express, $ambro_size20, 
        $poczta_kurier24, $access){
            $calculate = [];
            foreach($packages as $q){
                array_push($calculate, (object)[
                    'width' => intval($q -> width),
                    'depth' => intval($q -> depth),
                    'height' => intval($q -> height),
                    'weight' => floatval($q -> weight),
                    'value' => floatval($q -> value),
                    'description' => $q -> description
                ]);
            }
            $headers = [
                'Content-Type: application/x-www-form-urlencoded',
                'Authorization: '.$access
            ];
            $additional_services = [];
                if($rod != null){
                    array_push($additional_services, [
                        'rod' => $rod
                    ]);
                }
                if($cud != null){
                    array_push($additional_services, [
                        'cud' => $cud
                    ]);
                }
                if($private_shipping != null){
                    array_push($additional_services, [
                        'private_shipping' => $private_shipping
                    ]);
                }
                if($guarantee_0930 != null){
                    array_push($additional_services, [
                        'guarantee_0930' => $guarantee_0930
                    ]);
                }
                if($guarantee_1200 != null){
                    array_push($additional_services, [
                        'guarantee_1200' => $guarantee_1200
                    ]);
                }
                if($saturday_delivery != null){
                    array_push($additional_services, [
                        'saturday_delivery' => $saturday_delivery
                    ]);
                }
                if($additional_handling != null){
                    array_push($additional_services, [
                        'additional_handling' => $additional_handling
                    ]);
                }
                if($sms_predelivery_information != null){
                    array_push($additional_services, [
                        'sms_predelivery_information' => $sms_predelivery_information
                    ]);
                }
                if($documents_supply != null){
                    array_push($additional_services, [
                        'documents_supply' => $documents_supply
                    ]);
                }
                if($saturday_sunday_delivery != null){
                    array_push($additional_services, [
                        'saturday_sunday_delivery' => $saturday_sunday_delivery
                    ]);
                }
                if($guarantee_next_day != null){
                    array_push($additional_services, [
                        'guarantee_next_day' => $guarantee_next_day
                    ]);
                }
                if($fedex_priority != null){
                    array_push($additional_services, [
                        'fedex_priority' => $fedex_priority
                    ]);
                }
                if($ups_saver != null){
                    array_push($additional_services, [
                        'ups_saver' => $ups_saver
                    ]);
                }
                if($valuable_shipment != null){
                    array_push($additional_services, [
                        'valuable_shipment' => $valuable_shipment
                    ]);
                }
                if($fragile != null){
                    array_push($additional_services, [
                        'fragile' => $fragile
                    ]);
                }
                if($personal_delivery != null){
                    array_push($additional_services, [
                        'personal_delivery' => $personal_delivery
                    ]);
                }
                if($poczta_kurier48 != null){
                    array_push($additional_services, [
                        'poczta_kurier48' => $poczta_kurier48
                    ]);
                }
                if($registered_letter != null){
                    array_push($additional_services, [
                        'registered_letter' => $registered_letter
                    ]);
                }
                if($registered_company_letter != null){
                    array_push($additional_services, [
                        'registered_company_letter' => $registered_company_letter
                    ]);
                }
                if($registered_letter_international != null){
                    array_push($additional_services, [
                        'registered_letter_international' => $registered_letter_international
                    ]);
                }
                if($poczta_globalexpres != null){
                    array_push($additional_services, [
                        'poczta_globalexpres' => $poczta_globalexpres
                    ]);
                }
                if($delivery_confirmation != null){
                    array_push($additional_services, [
                        'delivery_confirmation' => $delivery_confirmation
                    ]);
                }
                if($waiting_time != null){
                    array_push($additional_services, [
                        'waiting_time' => $waiting_time
                    ]);
                }
                if($deligoo_express != null){
                    array_push($additional_services, [
                        'deligoo_express' => $deligoo_express
                    ]);
                }
                if($ambro_size20 != null){
                    array_push($additional_services, [
                        'ambro_size20' => $ambro_size20
                    ]);
                }
                if($poczta_kurier24 != null){
                    array_push($additional_services, [
                        'poczta_kurier24' => $poczta_kurier24
                    ]);
                }
            if($codAmount > 0){
                $cod = [
                    "amount" => $codAmount,
                    "currency" => $codCurrency,
                ];
                if($codExpress == true){
                    array_push($cod, [
                        'express' => true
                    ]);
                }
                if($codIban == true){
                    array_push($cod, [
                        'iban' => $codIban
                    ]);
                }
                if($codIban == true){
                    array_push($cod, [
                        'iban' => $codIban
                    ]);
                }
                if($codName != false){
                    array_push($cod, [
                        'name' => $codName,
                    ]);
                }
                if($codSwift != false){
                    array_push($cod, [
                        'swift' => $codSwift,
                    ]);
                }
                if($codTransferDone != false){
                    array_push($cod, [
                        'transferDone' => $codTransferDone,
                    ]);
                }
                if($codTransferDateInfo != false){
                    array_push($cod, [
                        'transferDateInfo' => $codTransferDateInfo
                    ]);
                }
                $cod = (object)$cod;
                array_push($additional_services, [
                    'cod' => $cod
                ]);
            }
            $additional_services = (object)$additional_services;
            $data = (object)[
                'pickup' => (object)[
                    'street' => env('FURGO_pickup_street'),
                    'postcode' => env('FURGO_pickup_postcode'),
                    'city' => env('FURGO_pickup_city'),
                    'phone' => env('FURGO_pickup_phone'),
                    'email' => env('FURGO_pickup_email'),
                    'name' => env('FURGO_name'),
                    'company' => env('FURGO_company')
                ],
                'receiver' => (object)[
                    'street' => $receiver -> street,
                    'postcode' => $receiver -> postcode,
                    'city' => $receiver -> city,
                    'phone' => $receiver -> phone,
                    'email' => $receiver -> email,
                    'name' => $receiver -> name,
                    'company' => ''
                ],
                "user_reference_number" => $user_reference_number,
                "service_id" =>  $service_id,
                "type" => $type,
                "parcels" => $calculate,
                "additional_services" => $additional_services
            ];
            $url = 'https://api.furgonetka.pl/packages';
            $ch = curl_init( $url );
            curl_setopt( $ch, CURLOPT_HTTPHEADER, $headers);
            curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
            curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
            $result = curl_exec($ch);
            curl_close($ch);
            $result = json_decode($result);
            return $result;
        }
        public function calculatePrice($type, $packages, $services, $receiver, $access){
            $url = 'https://api.furgonetka.pl/packages/calculate-price';
            $calculate = [];
            foreach($packages as $q){
                array_push($calculate, (object)[
                    'width' => intval($q -> width),
                    'depth' => intval($q -> depth),
                    'height' => intval($q -> height),
                    'weight' => floatval($q -> weight),
                    'value' => floatval($q -> value),
                    'description' => $q -> description
                ]);
            }
            $package = (object)[
                'pickup' => (object)[
                    'street' => env('FURGO_pickup_street'),
                    'postcode' => env('FURGO_pickup_postcode'),
                    'city' => env('FURGO_pickup_city'),
                    'phone' => env('FURGO_pickup_phone'),
                    'email' => env('FURGO_pickup_email'),
                ],
                'receiver' => (object)[
                    'street' => $receiver -> street,
                    'postcode' => $receiver -> postcode,
                    'city' => $receiver -> city
                ],
                'type' => $type,
                'parcels' => $calculate
            ];
            $data = (object)[
                'services' => (object)[
                    'service' => $services
                ],
                'package' => $package
            ];
            $headers = [
                'Content-Type: application/x-www-form-urlencoded',
                'Authorization: '.$access
            ];
            $post = json_encode($data, true);
            $ch = curl_init( $url );
            curl_setopt( $ch, CURLOPT_HTTPHEADER, $headers);
            curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
            curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
            $result = curl_exec($ch);
            curl_close($ch);
            $result = json_decode($result);
            return $result;
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
