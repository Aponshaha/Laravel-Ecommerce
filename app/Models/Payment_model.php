<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB; 
use Illuminate\Support\Facades\Input;   
use Config;
use Crypt;         
use App\Libraries\PaymentProcessor;  

class Payment_model extends Model
{
      var $ipAddress = '72.32.221.225';     
      public $gateway_config_setting = array();
       
      public function __construct()
      {
          parent::__construct();
         // $this->load->library('PaymentProcessor');
      }

      function getPaymentProcessor($realTimeGateway)
      {
                         
          $this->gateway_config_setting = $gateway_config_setting = Config::get('gateway_config.gateway_config_setting'); 		  
          switch($realTimeGateway)
          {
              case $gateway_config_setting['payment_gateway_authorize_dot_net']:
                return new PaymentProcessor(AUTHORIZE_DOT_NET);
              case $gateway_config_setting['payment_gateway_first_data']:
              case $gateway_config_setting['payment_gateway_first_data_mobile']:
                return new PaymentProcessor(FIRST_DATA);
              case $gateway_config_setting['payment_gateway_payflow_pro']:
                return new PaymentProcessor(PAYFLOW_PRO);
              case $gateway_config_setting['payment_gateway_paypal_website_payment_pro']:
                return new PaymentProcessor(PAYPAL_PAYMENT_PRO);
              case $gateway_config_setting['payment_gateway_eway']:
                return new PaymentProcessor(EWAY);
              case $gateway_config_setting['payment_gateway_transfirst']:
                return new PaymentProcessor(TRANS_FIRST);
              case $gateway_config_setting['payment_gateway_sagepay']:
                return new PaymentProcessor(SAGEPAY);
              case $gateway_config_setting['payment_gateway_beanstream']:
                return new PaymentProcessor(BEANSTREAM);
              case $gateway_config_setting['payment_gateway_quickbooks_intuit']:
                return new PaymentProcessor(QUICKBOOKS_MERCHANT_SERVICES);
              case $gateway_config_setting['payment_gateway_usaepay']:
                return new PaymentProcessor(USAEPAY);
              case $gateway_config_setting['payment_gateway_merchantone']:
                return new PaymentProcessor(MERCHANTONE);
              case $gateway_config_setting['payment_gateway_fastcharge']:
                return new PaymentProcessor(FASTCHARGE);
              case $gateway_config_setting['payment_gateway_internet_secure']:
                return new PaymentProcessor(INTERNET_SECURE);
              case $gateway_config_setting['payment_gateway_caledon']:
                return new PaymentProcessor(CALEDON_CARD_SERVICES);
              case $gateway_config_setting['payment_gateway_virtual']:
                return new PaymentProcessor(VIRTUAL_CARD_SERVICES);
              case $gateway_config_setting['payment_gateway_virtual_merchant']:
                return new PaymentProcessor(VIRTUAL_MERCHANT);
              case $gateway_config_setting['payment_gateway_psigate']:
                return new PaymentProcessor(PSIGATE);
              case $gateway_config_setting['payment_gateway_moneris_eselect']:
                return new PaymentProcessor(MONERIS_ESELECT_PLUS);
              case $gateway_config_setting['payment_gateway_network_merchants']:
                return new PaymentProcessor(NETWORK_MERCHANTS);
              case $gateway_config_setting['payment_gateway_exact']:
                return new PaymentProcessor(EXACT_TRANSACTIONS);
              case $gateway_config_setting['payment_gateway_payment_express']:
                return new PaymentProcessor(PAYMENT_EXPRESS);
              case $gateway_config_setting['payment_gateway_pay_junction']:
                return new PaymentProcessor(PAY_JUNCTION);
              case $gateway_config_setting['payment_gateway_pay_simple']:
                return new PaymentProcessor(PAY_SIMPLE);
              case $gateway_config_setting['payment_gateway_moneris_canada']:
                return new PaymentProcessor(MONERIS_ESELECT_PLUS_CANADA);
              case $gateway_config_setting['payment_gateway_quantum']:                        
               return new PaymentProcessor(QUANTUM_GATEWAY);
			  case $gateway_config_setting['payment_gateway_samurai']:
                return new PaymentProcessor(SAMURAI);
              case $gateway_config_setting['payment_gateway_payleap']:
              case $gateway_config_setting['payment_gateway_payleap_mobile']:
                return new PaymentProcessor(PAYLEAP);
              case $gateway_config_setting['payment_gateway_securepay']:
                return new PaymentProcessor(SECUREPAY);
              case $gateway_config_setting['payment_gateway_wonderpay']:
               return new PaymentProcessor(WONDERPAY);
			  case $gateway_config_setting['payment_gateway_cardsave']:
               return new PaymentProcessor(CARDSAVE);
              case $gateway_config_setting['payment_gateway_paypal_advanced']:
               return new PaymentProcessor(PAYPAL_ADVANCED);
              case $gateway_config_setting['payment_gateway_first_atlantic_commerce']:
               return new PaymentProcessor(FIRST_ATLANTIC_COMMERCE);
              case $gateway_config_setting['payment_gateway_optimal_payments']:
               return new PaymentProcessor(OPTIMAL_PAYMENTS);
              case $gateway_config_setting['payment_gateway_plugnpay']:
               return new PaymentProcessor(PLUGNPAY);
              case $gateway_config_setting['payment_gateway_msdpay']:
               return new PaymentProcessor(MSDPAY);
              case $gateway_config_setting['payment_gateway_beanstream_mobile']:
              return new PaymentProcessor(BEANSTREAM_MOBILE);
              case $gateway_config_setting['payment_gateway_bluepay']:
               return new PaymentProcessor(BLUEPAY);
			 case $gateway_config_setting['payment_gateway_eprocessing_network']:
               return new PaymentProcessor(EPROCESSING_NETWORK);
              case $gateway_config_setting['payment_gateway_stripe']:
              return new PaymentProcessor(STRIPE);
              case $gateway_config_setting['payment_gateway_sage_payment']:
              return new PaymentProcessor(SAGE_PAYMENT);
              case $gateway_config_setting['payment_gateway_wepay']:
              return new PaymentProcessor(WEPAY);
              case $gateway_config_setting['payment_gateway_first_data_gloabal_e4']:
              return new PaymentProcessor(FIRST_DATA_GLOBAL_E4);
          }
      }

      function chargeOrder($orderDetails, $gatewaySetup, $cvv2 = '', $fromAPI = 0)
      { 
               
         //echo $orderDetails->total_price;
          $processor = $this->getPaymentProcessor($gatewaySetup->real_time_gateway);               
          $processor->setAPIUserName($gatewaySetup->authorize_api_login_key);                  
          $processor->setAPIKey($gatewaySetup->authorize_api_transaction_key);
          $processor->setAPISignature($gatewaySetup->authorize_api_signature);
         
          $processor->setIPAddress($this->ipAddress); 
          $processor->setFirstName($orderDetails->name);
          //$processor->setLastName($orderDetails->last_name); 
          $processor->setEmail($orderDetails->email);

          $phone = '';

          if (! empty($orderDetails->home_phone_number))
          {
              $phone = $orderDetails->home_phone_number;
          }
          else if (! empty($orderDetails->work_phone_number))
          {
              $phone = $orderDetails->work_phone_number;
          }
          
              
          

        /*  $processor->setPhone($phone);
          $processor->setFax($orderDetails->fax);
          $processor->setBillingAddress1($orderDetails->address_line1);
          $customer->address_line2 = $orderDetails->address_line2 ? $orderDetails->address_line2 : '';
          $processor->setBillingAddress2($orderDetails->address_line2);
          $processor->setCompanyName($orderDetails->company_name);
          $processor->setBillingCity($orderDetails->customer_city);
          $processor->setBillingState($orderDetails->customer_state);
          $processor->setBillingZip($orderDetails->customer_zip);
          $processor->setBillingCountry($orderDetails->country);

          $customer->shipping_name = str_replace('  ', ' ', trim($orderDetails->shipping_name));
          $shippingNameParts = explode(' ', $orderDetails->shipping_name);
          $cnt = count($shippingNameParts);

          if($cnt == 2)
          {
              $firstName = $shippingNameParts[0];
              $lastName = $shippingNameParts[1];
          }
          else if($cnt > 2)
          {
              $firstName = '';

              for($i = 0; $i < ($cnt - 1); $i++)
              {
                  $firstName .= $shippingNameParts[$i] . ' ';
              }
              $firstName = trim($firstName);
              $lastName = $shippingNameParts[$cnt - 1];
          }
          else
          {
              $firstName = $shippingNameParts[0];
              $lastName = '-';
          }

          $processor->setShippingFirstName($firstName);
          $processor->setShippingLastName($lastName);
          $processor->setShippingAddress1($orderDetails->shipping_address_line1);
          $customer->shipping_address_line2 = $orderDetails->shipping_address_line2 ? $orderDetails->shipping_address_line2 : '';
          $processor->setShippingAddress2($orderDetails->shipping_address_line2);
          $processor->setShippingCompany($orderDetails->shipping_company_name);
          $processor->setShippingCity($orderDetails->shipping_customer_city);
          $processor->setShippingState($orderDetails->shipping_customer_state);
          $processor->setShippingZip($orderDetails->shipping_customer_zip);
          $processor->setShippingCountry($orderDetails->shipping_country);
          */
          
                            
          $processor->setCardNumber($orderDetails->card_number);
          $processor->setCardType($orderDetails->card_type);
          $processor->setNameOnCard($orderDetails->card_holder_contactname);
          $processor->setExpiryMonth($orderDetails->card_exp_month);
          $processor->setExpiryYear($orderDetails->card_exp_year);
         
          
          $processor->setCVV($cvv2);
          /*
          if(isset($orderDetails->card_track_data))
             $processor->setMagData($orderDetails->card_track_data);
          $processor->setNote($orderDetails->order_product_names);
          
          if($this->input->post('gateway_card_profile_id'))
             $processor->setCustomVariable1($this->input->post('gateway_card_profile_id'), 'gateway_card_profile_id');
             
          $processor->setCustomVariable2($gatewaySetup->merchant_row_id, 'merchant_row_id');   
          
          */
            
          if($cvv2 && $gatewaySetup->real_time_gateway == $this->gateway_config_setting['payment_gateway_paypal_website_payment_pro'])
          {
              //temporary storage of CVV2. This will be deleted in next processes.
              //if failed to delete, a schedule job will delete it. Deletion is required
              //for PCI complience.
              if($orderDetails->customer_id)
              {
                  $sql = "DELETE FROM tbl_customer_temp_data WHERE customer_id = " . $orderDetails->customer_id;
                  $this->db->query($sql);
              }

              $tempData = array();
              $tempData['customer_id'] = $orderDetails->customer_id;
              $tempData['data'] = encrypt($cvv2);
              $this->db->insert('tbl_customer_temp_data', $tempData);
          }

          

          /*
          if($orderDetails->gift_certificate_payment)
          {
              $totalAmount = $orderDetails->total_amount - $orderDetails->gift_certificate_payment;
          }
          else
          {
              $totalAmount = $orderDetails->total_amount;
          }
          */
          
          $totalAmount = $orderDetails->total_price;

          $processor->setAmount($totalAmount);
          $processor->setCurrencyCode($gatewaySetup->real_time_currency);
          
          //$processor->setInvoiceNumber($orderDetails->order_id);    
          $processor->setInvoiceNumber('Inv-12');                       

          /*if($this->config->item('test_mode') || in_array($gatewaySetup->merchant_row_id, $this->config->item('test_accounts')))
          {
              $processor->enableTestMode();
          }
          */
          $processor->enableTestMode(); 

          //$processor->enableDebugging();

          $paymentDetails = array();
            
           
          if(!$fromAPI && $gatewaySetup->payment_process_model == $this->gateway_config_setting['process_model_authorize'])
          { 
              $paymentDetails['payment_process_model'] = $gatewaySetup->payment_process_model;
              $response = $processor->authorize();
          }                                                                       
          else
          {                          
              $response = $processor->sale();   
          }
          
          
     
          $paymentDetails['reason_code'] = $response->reasonCode;
          $paymentDetails['response_code'] = $response->responseCode;
          $paymentDetails['response_reason_code'] = $response->reasonCode;
          $paymentDetails['payment_gateway'] = $gatewaySetup->real_time_gateway;
          $paymentDetails['gateway_account_no'] = $gatewaySetup->real_gateway_account_no;
          $paymentDetails['amount'] = $response->amount;
          $paymentDetails['curl_error_message'] = addslashes($response->curlErrorMessage);
          $paymentDetails['version'] = $processor->getAPIVersion();
          $paymentDetails['auth_code'] = $response->authorizationId;
          $paymentDetails['security_code'] = $response->securityKey;
          $paymentDetails['transaction_id'] = $response->transactionId;
          $paymentDetails['vendor_tx_code'] = $response->invoiceNumber;
          $paymentDetails['transaction_type'] = $response->transactionType;
          $paymentDetails['correlation_id'] = $response->correlationId;
          $paymentDetails['success'] = $response->success;
          $paymentDetails['ack'] = $response->ack;
          $paymentDetails['error_text'] = addslashes($response->getErrorString());
          $paymentDetails['currency'] = $gatewaySetup->real_time_currency;

          return $paymentDetails;
      }

      function capture($transaction, $gatewaySetup, $orderDetails)
      {
          $processor = $this->getPaymentProcessor($gatewaySetup->real_time_gateway);

          $processor->setAPIUserName($gatewaySetup->authorize_api_login_key);
          $processor->setAPIKey($gatewaySetup->authorize_api_transaction_key);
          $processor->setAPISignature($gatewaySetup->authorize_api_signature);

          $processor->setAuthorizationId($transaction->auth_code);
          $processor->setTransactionId($transaction->transaction_id);
          $processor->setInvoiceNumber($transaction->vendor_tx_code);
          $processor->setSecurityCode($transaction->security_code);
          $processor->setAmount($transaction->amount);

          $getInstance = &get_instance();
          //$getInstance->load->model('customers/Customer_Setup_model', 'Customer_Setup_model', TRUE);
          //$customer = $getInstance->Customer_Setup_model->getCustomerWithCardInfo($transaction->customer_id);
          $processor->setNameOnCard($orderDetails->card_holder_contactname);
          $processor->setCardNumber($orderDetails->card_number);
          $processor->setExpiryMonth($orderDetails->card_exp_month);
          $processor->setExpiryYear($orderDetails->card_exp_year);

          if($this->config->item('test_mode') || in_array($gatewaySetup->merchant_row_id, $this->config->item('test_accounts')))
          {
              $processor->enableTestMode();
          }
          $response = $processor->capture();

          $details = array();
          $details['transaction_id'] = $response->transactionId ? $response->transactionId : $transaction->transaction_id;
          $details['authorization_id'] = $response->authorizationId;
          $details['correlation_id'] = $response->correlationId;
          $details['is_success'] = $response->success;
          $details['reason_code'] = $response->responseCode;
          $details['error_text'] = $response->getErrorString();
          $details['created_on'] = getCurrentDateTimeForDB();
          $this->db->insert('tbl_payment_capture', $details);

          return $response;
      }

      function chargeRecurringOrder($orderInfo, $customer, $gatewaySetup)
      {
          $processor = $this->getPaymentProcessor($gatewaySetup->real_time_gateway);

          $processor->setAPIUserName($gatewaySetup->authorize_api_login_key);
          $processor->setAPIKey($gatewaySetup->authorize_api_transaction_key);
          $processor->setAPISignature($gatewaySetup->authorize_api_signature);

          $processor->setFirstName($customer->first_name);
          $processor->setLastName($customer->last_name);
          $processor->setEmail($customer->customer_email);

          $phone = '';

          if (! empty($customer->home_phone_number))
          {
              $phone = $customer->home_phone_number;
          }
          else if (! empty($customer->work_phone_number))
          {
              $phone = $customer->work_phone_number;
          }

          $processor->setPhone($phone);
          $processor->setFax($customer->fax);
          $processor->setBillingAddress1($customer->address_line1);
          $customer->address_line2 = $customer->address_line2 ? $customer->address_line2 : '';
          $processor->setBillingAddress2($customer->address_line2);
          $processor->setCompanyName($customer->company_name);
          $processor->setBillingCity($customer->customer_city);
          $processor->setBillingState($customer->customer_state);
          $processor->setBillingZip($customer->customer_zip);
          $processor->setBillingCountry($customer->country);
          if($customer->gateway_card_profile_id)
             $processor->setCustomVariable1($customer->gateway_card_profile_id, 'gateway_card_profile_id');
          
          $processor->setCustomVariable2($gatewaySetup->merchant_row_id, 'merchant_row_id');
          
          $shippingNameParts = explode(' ', $customer->shipping_name);
          $cnt = count($shippingNameParts);

          if($cnt == 2)
          {
              $firstName = $shippingNameParts[0];
              $lastName = $shippingNameParts[1];
          }
          else if($cnt > 2)
          {
              $firstName = '';

              for($i = 0; $i < ($cnt - 1); $i++)
              {
                  $firstName .= $shippingNameParts[$i] . ' ';
              }
              $firstName = trim($firstName);
              $lastName = $shippingNameParts[$cnt - 1];
          }
          else
          {
              $firstName = $shippingNameParts[0];
              $lastName = '-';
          }

          $processor->setShippingFirstName($firstName);
          $processor->setShippingLastName($lastName);
          $processor->setShippingAddress1($customer->shipping_address_line1);
          $customer->shipping_address_line2 = $customer->shipping_address_line2 ? $customer->shipping_address_line2 : '';
          $processor->setShippingAddress2($customer->shipping_address_line2);
          $processor->setShippingCompany($customer->shipping_company_name);
          $processor->setShippingCity($customer->shipping_customer_city);
          $processor->setShippingState($customer->shipping_customer_state);
          $processor->setShippingZip($customer->shipping_customer_zip);
          $processor->setShippingCountry($customer->shipping_country);

          $processor->setCardNumber($customer->card_number);
          $processor->setCardType($customer->card_type);
          $processor->setNameOnCard($customer->card_holder_contactname);
          $processor->setExpiryMonth($customer->card_exp_month);
          $processor->setExpiryYear($customer->card_exp_year);
          $processor->setAmount($orderInfo->recurring_price);
          $processor->setCurrencyCode($gatewaySetup->real_time_currency);

          //$processor->setNote('Charging order of' . $customer->first_name . ' ' . $customer->last_name);
          $processor->setNote($orderInfo->product_description);

          $getInstance = &get_instance();
          $getInstance->load->model('orders/Order_model','',TRUE);
          $orderId = $getInstance->Order_model->getOrderId($orderInfo->order_row_id);
          $invoiceNumber = $orderId . '-' . date('dmHms');
          $processor->setInvoiceNumber($invoiceNumber); //New Order ID for recurring order

          if($this->config->item('test_mode'))
          {
              $processor->enableTestMode();
          }

          if($gatewaySetup->cvv2_required && $gatewaySetup->real_time_gateway == $this->config->item('payment_gateway_sagepay'))
          {
              $mainOrderPaymentDetails = $getInstance->Order_model->getTransactionIDByOrderRowID($orderInfo->order_row_id);
              $processor->setRelatedInvoiceNumber($mainOrderPaymentDetails->vendor_tx_code);
              $processor->setTransactionId($mainOrderPaymentDetails->transaction_id);
              $processor->setAuthorizationId($mainOrderPaymentDetails->auth_code);
              $processor->setSecurityCode($mainOrderPaymentDetails->security_code);
              $processor->setTransactionAsRecurring();
          }

          //$processor->enableDebugging();
          $response = $processor->sale();

          $paymentDetails['reason_code'] = $response->reasonCode;
          $paymentDetails['response_code'] = $response->responseCode;
          $paymentDetails['response_reason_code'] = $response->reasonCode;
          $paymentDetails['payment_gateway'] = $gatewaySetup->real_time_gateway;
          $paymentDetails['gateway_account_no'] = $gatewaySetup->real_gateway_account_no;
          $paymentDetails['amount'] = $response->amount;
          $paymentDetails['curl_error_message'] = addslashes($response->curlErrorMessage);
          $paymentDetails['version'] = $processor->getAPIVersion();
          $paymentDetails['auth_code'] = $response->authorizationId;
          $paymentDetails['security_code'] = $response->securityKey;
          $paymentDetails['transaction_id'] = $response->transactionId;
          $paymentDetails['vendor_tx_code'] = $response->invoiceNumber;
          $paymentDetails['transaction_type'] = $response->transactionType;
          $paymentDetails['success'] = $response->success;
          $paymentDetails['ack'] = $response->ack;
          $paymentDetails['error_text'] = addslashes($response->getErrorString());
          $paymentDetails['currency'] = $gatewaySetup->real_time_currency;

          return $paymentDetails;
      }

      function refundPayment($paymentInfo, $orderRowId)
      {
          $paymentDetails = array();

          $getInstance = &get_instance();

          $getInstance->load->model('carts/Cart_Setup_model', 'Cart_Setup_model', TRUE);
          $gatewaySetup = $getInstance->Cart_Setup_model->getRealTimeGatewaySetupByID($paymentInfo['payment_gateway'], getCurrentMerchantId(), $paymentInfo['gateway_account_no']);

          if(empty($gatewaySetup))
          {
              $paymentDetails['success'] = 0;
              $gatewayName = getGatewayName($paymentInfo['payment_gateway']) . ($paymentInfo['gateway_account_no'] > 1 ? ' (' . $paymentInfo['gateway_account_no'] . ')' : '');
              $paymentDetails['error_text'] = 'The order could not be refunded because it was processed with ' . $gatewayName . '.';
              return $paymentDetails;
          }

          $processor = $this->getPaymentProcessor($gatewaySetup->real_time_gateway);

          $processor->setAPIUserName($gatewaySetup->authorize_api_login_key);
          $processor->setAPIKey($gatewaySetup->authorize_api_transaction_key);
          $processor->setAPISignature($gatewaySetup->authorize_api_signature);

          $processor->setTransactionId( $paymentInfo['transactionID'] );
          $processor->setAuthorizationId($paymentInfo['auth_code']);
          $processor->setSecurityCode($paymentInfo['security_code']);

          if(isset($paymentInfo['vendor_tx_code']) && $paymentInfo['vendor_tx_code']) //specially for SagePay
          {
              $processor->setInvoiceNumber($paymentInfo['vendor_tx_code']);
          }
          else
          {
              $getInstance->load->model('orders/Order_model','',TRUE);
              $orderId = $getInstance->Order_model->getOrderId($orderRowId);
              $processor->setInvoiceNumber($orderId);
          }

          $processor->setAmount($paymentInfo['amount']);
          $processor->setCurrencyCode($paymentInfo['currency']);

          $getInstance->load->model('customers/Customer_Setup_model','',TRUE);
          $customer = $getInstance->Customer_Setup_model->getCustomerByOrderRowId($orderRowId);

          $processor->setFirstName($customer->first_name);
          $processor->setLastName($customer->last_name);
          $processor->setEmail($customer->customer_email);

          if(isset($paymentInfo['memo']) && $paymentInfo['memo'])
          {
              $processor->setNote($paymentInfo['memo']);
          }
          else
          {
              $processor->setNote('Refunding order of ' . $customer->first_name . ' ' . $customer->last_name);
          }

          $phone = '';

          if (! empty($customer->home_phone_number))
          {
              $phone = $customer->home_phone_number . ' (Home), ';
          }

          if (! empty($customer->work_phone_number))
          {
              $phone .= $customer->work_phone_number. ' (Work)';
          }

          $processor->setPhone($phone);
          $processor->setFax($customer->fax);
          $processor->setBillingAddress1($customer->address_line1);
          $customer->address_line2 = $customer->address_line2 ? $customer->address_line2 : '';
          $processor->setBillingAddress2($customer->address_line2);
          $processor->setCompanyName($customer->company_name);
          $processor->setBillingCity($customer->customer_city);
          $processor->setBillingState($customer->customer_state);
          $processor->setBillingZip($customer->customer_zip);
          $processor->setBillingCountry($customer->country);

          $processor->setNameOnCard($customer->card_holder_contactname);
          $processor->setCardNumber($customer->card_number);
          $processor->setExpiryMonth($customer->card_exp_month);
          $processor->setExpiryYear($customer->card_exp_year);

          if($this->config->item('test_mode') || in_array($gatewaySetup->merchant_row_id, $this->config->item('test_accounts')))
          {
              $processor->enableTestMode();
          }
          //$processor->enableDebugging();
          $response = $processor->refund();

          $paymentDetails['reason_code'] = $response->reasonCode;
          $paymentDetails['payment_gateway'] = $gatewaySetup->real_time_gateway;
          $paymentDetails['gateway_account_no'] = $gatewaySetup->real_gateway_account_no;
          $paymentDetails['amount'] = $response->amount;
          $paymentDetails['error_text'] = addslashes($response->getErrorString());

          $paymentDetails['version'] = $processor->getAPIVersion();
          $paymentDetails['auth_code'] = $response->authorizationId;
          $paymentDetails['transaction_id'] = $response->transactionId;
          $paymentDetails['transaction_type'] = $response->transactionType;
          $paymentDetails['response_code'] = $response->responseCode;
          $paymentDetails['response_reason_code'] = $response->reasonCode;

          $paymentDetails['success'] = $response->success;
          $paymentDetails['ack'] = $response->ack;
          $paymentDetails['curl_error_message'] = addslashes($response->curlErrorMessage);

          return $paymentDetails;
      }

      function chargeForMerchantSignUp($merchantData, $gatewaySetup, $isFromSignUp = 0)
      {
          $processor = $this->getPaymentProcessor($gatewaySetup->real_time_gateway);

          $processor->setAPIUserName($gatewaySetup->authorize_api_login_key);
          $processor->setAPIKey($gatewaySetup->authorize_api_transaction_key);
          $processor->setAPISignature($gatewaySetup->authorize_api_signature);

          if($isFromSignUp)
          {
              $processor->setFirstName($merchantData['first_name']);
              $processor->setLastName($merchantData['last_name']);
              $processor->setEmail($merchantData['email_address']);
              $processor->setCompanyName($merchantData['company_name']);
              $processor->setPhone($merchantData['merchant_contact_phone']);

              if($merchantData['billing_address'])
              {
                  $processor->setBillingAddress1($merchantData['billing_address']);
                  $processor->setBillingCity($merchantData['billing_city']);
                  $processor->setBillingState($merchantData['billing_state']);
                  $processor->setBillingZip($merchantData['billing_zip_code']);
                  $processor->setBillingCountry($merchantData['billing_country']);
              }
              else
              {
                  $processor->setBillingAddress1($merchantData['merchant_address']);
                  $processor->setBillingCity($merchantData['merchant_city']);
                  $processor->setBillingState($merchantData['state_province_name']);
                  $processor->setBillingZip($merchantData['merchant_zip_code']);
                  $processor->setBillingCountry($merchantData['merchant_country']);
              }
          }
          else
          {
              $nameParts = explode(' ', $merchantData['billing_name']);
              $totalParts = count($nameParts);

              if($totalParts == 1)
              {
                  $processor->setLastName($nameParts[0]);
              }
              else if($totalParts > 1)
              {
                  $processor->setFirstName($nameParts[0]);
                  $lastName = '';

                  for($i = 1; $i < $totalParts; $i++)
                  {
                      $lastName .= $nameParts[$i] . ' ';
                  }

                  $processor->setLastName(trim($lastName));
              }

              //$processor->setLastName($merchantData['billing_name']);
              $processor->setEmail($merchantData['billing_email']);
              $processor->setBillingAddress1($merchantData['billing_address']);
              $processor->setCompanyName($merchantData['billing_company']);
              $processor->setBillingCity($merchantData['billing_city']);
              $processor->setBillingState($merchantData['billing_state']);
              $processor->setBillingZip($merchantData['billing_zip_code']);
              $processor->setBillingCountry($merchantData['billing_country']);
              $processor->setPhone($merchantData['billing_phone']);
          }

          $processor->setCardType($merchantData['card_type']);
          $processor->setCardNumber($merchantData['card_number']);
          $processor->setExpiryMonth($merchantData['card_exp_month']);
          $processor->setExpiryYear($merchantData['card_exp_year']);
          $processor->setNameOnCard($merchantData['card_holder_contactname']);
          $processor->setAmount($merchantData['signup_amount']);

          $processor->setNote($merchantData['description']);

          if($this->config->item('test_mode'))
          {
              $processor->enableTestMode();
          }
          //$processor->enableDebugging();
          $response = $processor->sale();

          $paymentDetails['reason_code'] = $response->reasonCode;
          $paymentDetails['response_code'] = $response->responseCode;
          $paymentDetails['response_reason_code'] = $response->reasonCode;
          $paymentDetails['payment_gateway'] = $gatewaySetup->real_time_gateway;
          $paymentDetails['amount'] = $response->amount;
          $paymentDetails['curl_error_message'] = addslashes($response->curlErrorMessage);
          $paymentDetails['version'] = $processor->getAPIVersion();
          $paymentDetails['auth_code'] = $response->authorizationId;
          $paymentDetails['transaction_id'] = $response->transactionId;
          $paymentDetails['transaction_type'] = $response->transactionType;
          $paymentDetails['success'] = $response->success;
          $paymentDetails['ack'] = $response->ack;
          $paymentDetails['error_text'] = addslashes($response->getErrorString());
          $paymentDetails['description'] = $merchantData['description'];

          return $paymentDetails;
      }
      
    function getGatewaySetup()
    {
         $sql = 'SELECT  gs.merchant_row_id,
                        gs.credit_cards_selected,
                        gs.payment_process_model,
                        gs.real_time_gateway,
                        gs.real_time_gateway_mobile,
                        gs.real_gateway_account_no,
                        gs.standard_gateway_paypal,
                        gs.standard_gateway_alertpay,
                        gs.standard_gateway_rbsworldpay,
                        gs.enable_realtime_rotator,
                        sg1.authorize_email AS paypal_user_email,
                        sg1.authorize_api_login_key AS paypal_api_user_name,
                        sg1.authorize_api_transaction_key AS paypal_api_password,
                        sg1.authorize_api_signature AS paypal_api_signature,
                        sg2.authorize_email AS alertpay_merchant_email,
                        sg2.authorize_api_signature AS alertpay_ipn_security_code,
                        sg3.authorize_api_login_key AS rbsworldpay_installation_id,
                        sg3.authorize_api_transaction_key AS rbsworldpay_response_password,
                        sg3.authorize_api_signature AS rbsworldpay_md5_password,
                        rg.authorize_api_login_key,
                        rg.authorize_api_transaction_key,
                        rg.authorize_api_signature,
                        rg.real_time_currency,
                        rg.transactions_per_cycle,
                        rg.cvv2_required
                FROM tbl_gateway_setup gs
                LEFT OUTER JOIN tbl_gateway_standard sg1 ON sg1.standard_gateway = gs.standard_gateway_paypal
                AND sg1.merchant_row_id = gs.merchant_row_id
                LEFT OUTER JOIN tbl_gateway_standard sg2 ON sg2.standard_gateway = gs.standard_gateway_alertpay
                AND sg2.merchant_row_id = gs.merchant_row_id
                LEFT OUTER JOIN tbl_gateway_standard sg3 ON sg3.standard_gateway = gs.standard_gateway_rbsworldpay
                AND sg3.merchant_row_id = gs.merchant_row_id
                LEFT OUTER JOIN tbl_gateway_real_time rg ON rg.merchant_row_id = gs.merchant_row_id
                AND rg.real_time_gateway = gs.real_time_gateway AND rg.gateway_account_no = gs.real_gateway_account_no';
                
                
        $resultSet = DB::select($sql);                
        $row = $resultSet[0];
       
	   
	   
        if(is_object($row))
        {  
        
            if(trim($row->paypal_api_user_name))
            {
                
             $row->paypal_api_user_name = Crypt::decrypt($row->paypal_api_user_name);                             
            }
                 
            if(trim($row->paypal_api_password))
            {
                $row->paypal_api_password = Crypt::decrypt($row->paypal_api_password);
            }
              
            if(trim($row->paypal_api_signature))
            {
                $row->paypal_api_signature = Crypt::decrypt($row->paypal_api_signature);
            }
          
           
            if(trim($row->authorize_api_login_key))
            {
                $row->authorize_api_login_key = Crypt::decrypt($row->authorize_api_login_key);
            }
            if(trim($row->authorize_api_transaction_key))
            {
                $row->authorize_api_transaction_key = Crypt::decrypt($row->authorize_api_transaction_key);
            }
            if(trim($row->authorize_api_signature))
            {
                $row->authorize_api_signature = Crypt::decrypt($row->authorize_api_signature);
            }
            
            
            if(trim($row->alertpay_ipn_security_code))
            {
                $row->alertpay_ipn_security_code = Crypt::decrypt($row->alertpay_ipn_security_code);
            }
            if(trim($row->rbsworldpay_installation_id))
            {
                $row->rbsworldpay_installation_id = Crypt::decrypt($row->rbsworldpay_installation_id);
            }
            
            if(trim($row->rbsworldpay_response_password))
            {
                $row->rbsworldpay_response_password = Crypt::decrypt($row->rbsworldpay_response_password);
            }
            if(trim($row->rbsworldpay_md5_password))
            {
                $row->rbsworldpay_md5_password = Crypt::decrypt($row->rbsworldpay_md5_password);
            }
           
        }

        return $row;
    }
  }
?>