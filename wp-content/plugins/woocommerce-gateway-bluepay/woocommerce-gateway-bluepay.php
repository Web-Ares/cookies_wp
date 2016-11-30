<?php
/**
 * Plugin Name: WooCommerce BluePay Gateway
 * Plugin URI: http://woothemes.com/products/bluepay-payment-gateway/
 * Description: Extends WooCommerce with a <a href="https://www.bluepay.com" target="_blank">BluePay</a> gateway. A BluePay gateway account, and a server with SSL support and an SSL certificate is required for security reasons.
 * Version: 1.1.3
 * Author: WooThemes
 * Author URI: http://woothemes.com/
 *
 * Text Domain: wc-gateway-bluepay
 * Domain Path: /languages/
 *
 * Originally authored by, and purchased from, Daniel Espinoza at Grow Development. http://www.growdevelopment.com/
 */

/**
 * Required functions
 */
if ( ! function_exists( 'woothemes_queue_update' ) )
	require_once( 'woo-includes/woo-functions.php' );

/**
 * Plugin updates
 */
woothemes_queue_update( plugin_basename( __FILE__ ), 'c60a92eb71e0de80cbd6d481e5b775b1', '18712' );

add_action('plugins_loaded', 'woocommerce_gateway_bluepay_init', 0);

// Load in the eCheck gateway as well.
include_once( 'woocommerce-gateway-bluepayecheck.php' );

function woocommerce_gateway_bluepay_init() {

	if ( ! class_exists( 'WC_Payment_Gateway' ) ) return;

	/**
	 * Localisation
	 */
	load_plugin_textdomain( 'wc-gateway-bluepay', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' );

	define('BLUEPAY_DIR', untrailingslashit( plugins_url( '/', __FILE__ ) ) . '/');

	/**
	 * BluePay Gateway Class
	 **/
	class WC_Gateway_Bluepay extends WC_Payment_Gateway {

		public function __construct() {
			global $woocommerce;

	        $this->id					= 'bluepay';
	        $this->method_title 		= __( 'BluePay', 'wc-gateway-bluepay' );
	        $this->method_description 	= __( 'BluePay allows customers to checkout using a credit card', 'wc-gateway-bluepay' );
	        $this->icon 				= untrailingslashit( plugins_url( '/', __FILE__ ) ) . '/images/cards.png';
	        $this->has_fields 			= false;

			// Load the form fields
			$this->init_form_fields();

			// Load the settings.
			$this->init_settings();

			// Get setting values
			$this->enabled 			= $this->settings['enabled'];
			$this->title 			= $this->settings['title'];
			$this->description		= $this->settings['description'];
			$this->account_id		= $this->settings['account_id'];
			$this->user_id			= $this->settings['user_id'];
			$this->secret_key		= $this->settings['secret_key'];
			$this->trans_type		= $this->settings['trans_type'];
			$this->testmode			= $this->settings['testmode'];
			$this->gatewayurl		= $this->settings['gatewayurl'];
			$this->debugon			= $this->settings['debugon'];
			$this->debugrecipient 	= $this->settings['debugrecipient'];

			// Actions

			add_action('woocommerce_receipt_bluepay', array(&$this, 'receipt_page'));
			add_action('admin_notices', array(&$this,'bluepay_ssl_check'));
			// Check if this is version 1.x.x of WooCommerce
			add_action('woocommerce_update_options_payment_gateways', array( $this, 'process_admin_options'));
			add_action('woocommerce_update_options_payment_gateways_' . $this->id, array( $this, 'process_admin_options'));
	    }


		/**
	 	* Check if SSL is enabled and notify the user
	 	**/
		function bluepay_ssl_check() {

		     if (get_option('woocommerce_force_ssl_checkout')=='no' && $this->enabled=='yes') :

		     	echo '<div class="error"><p>'.sprintf(__('BluePay is enabled and the <a href="%s">Force secure checkout</a> option is disabled; your checkout is not secure! Please enable this feature and ensure your server has a valid SSL certificate installed.', 'wc-gateway-bluepay'), admin_url('admin.php?page=woocommerce_settings')).'</p></div>';

		     endif;
		}


		/**
	     * Initialize Gateway Settings Form Fields
	     */
	    function init_form_fields() {

	    	$this->form_fields = array(
				'enabled' => array(
								'title' => __( 'Enable/Disable', 'wc-gateway-bluepay' ),
								'label' => __( 'Enable BluePay Gateway', 'wc-gateway-bluepay' ),
								'type' => 'checkbox',
								'description' => '',
								'default' => 'no'
							),
				'title' => array(
								'title' => __( 'Title', 'wc-gateway-bluepay' ),
								'type' => 'text',
								'description' => __( 'This controls the title which the user sees during checkout.', 'wc-gateway-bluepay' ),
								'default' => __( 'Credit Card (BluePay)', 'wc-gateway-bluepay' )
							),
				'description' => array(
								'title' => __( 'Description', 'wc-gateway-bluepay' ),
								'type' => 'textarea',
								'description' => __( 'This controls the description which is displayed to the customer.', 'wc-gateway-bluepay' ),
								'default' => 'Pay with your MasterCard, Visa, Discover or American Express'
							),
				'account_id' => array(
								'title' => __( 'BluePay Account ID', 'wc-gateway-bluepay' ),
								'type' => 'text',
								'description' => __( 'Your 12-digit BluePay 2.0 Account ID', 'wc-gateway-bluepay' ),
								'default' => ''
							),
				'user_id' => array(
								'title' => __( 'BluePay User ID', 'wc-gateway-bluepay' ),
								'type' => 'text',
								'description' => __( 'Your 12-digit BluePay 2.0 User ID.', 'wc-gateway-bluepay' ),
								'default' => ''
							),
				'secret_key' => array(
								'title' => __( 'BluePay Secret Key', 'wc-gateway-bluepay' ),
								'type' => 'text',
								'description' => __( 'Secret key from your BluePay dashboard.', 'wc-gateway-bluepay' ),
								'default' => ''
							),
				'trans_type' => array(
								'title' => __( 'Payment Type', 'wc-gateway-bluepay' ),
								'type' => 'select',
								'description' => __( 'Payment command to run. ', 'wc-gateway-bluepay' ),
								'options' => array('SALE'=>'Sale',
								                   'AUTH'=>'Authorize Only'),
								'default' => 'SALE'
							),
				'testmode' => array(
								'title' => __( 'Test Mode', 'wc-gateway-bluepay' ),
								'label' => __( 'Enable Test Mode', 'wc-gateway-bluepay' ),
								'type' => 'checkbox',
								'description' => __( 'If checked then the transaction will be simulated.', 'wc-gateway-bluepay' ),
								'default' => 'no'
							),
				'gatewayurl' => array(
								'title' => __( 'Gateway URL', 'wc-gateway-bluepay' ),
								'type' => 'text',
								'description' => __( 'Gateway URL for BluePay 2.0 interface.', 'wc-gateway-bluepay' ),
								'default' => 'https://secure.bluepay.com/interfaces/bp20post'
							),
				'debugon' => array(
								'title' => __( 'Debugging', 'wc-gateway-bluepay' ),
								'label' => __( 'Enable debug emails', 'wc-gateway-bluepay' ),
								'type' => 'checkbox',
								'description' => __( 'Receive emails containing the data sent to and from BluePay.', 'wc-gateway-bluepay' ),
								'default' => 'no'
							),
				'debugrecipient' => array(
								'title' => __( 'Debugging Email', 'wc-gateway-bluepay' ),
								'type' => 'text',
								'description' => __( 'Who should receive the debugging emails.', 'wc-gateway-bluepay' ),
								'default' =>  get_option('admin_email')
							),
				);
	    }


		/**
		 * Admin Panel Options
		 * - Options for bits like 'title' and availability on a country-by-country basis
		 **/
		public function admin_options() {
			?>
			<h3><?php _e('BluePay','woothemes'); ?></h3>
	    	<p><?php _e( 'BluePay allows customers to checkout using a credit card by adding credit card fields on the checkout page and then sending the details to BluePay.com for verification.', 'woothemes' ); ?></p>
			<p><a href="https://secure.bluepay.com/login" target="_blank">BluePay Payment Gateway</a></p>
	    	<table class="form-table">
	    		<?php $this->generate_settings_html(); ?>
			</table><!--/.form-table-->
	    	<?php
	    }


	    /**
		 * Payment fields for BluePay.
		 **/
	    function payment_fields() {
			?>
			<fieldset>

				<p class="form-row form-row-first">
					<label for="bluepay_ccnum"><?php echo __("Credit card number", 'wc-gateway-bluepay') ?> <span class="required">*</span></label>
					<input type="text" class="input-text" id="bluepay_ccnum" name="bluepay_ccnum" />
				</p>
				<div class="clear"></div>

				<p class="form-row form-row-first">
					<label for="bluepay_expmonth"><?php echo __("Expiration date", 'wc-gateway-bluepay') ?> <span class="required">*</span></label>
					<select name="bluepay_expmonth" id="bluepay_expmonth" class="woocommerce-select woocommerce-cc-month">
						<option value=""><?php _e('Month', 'woocommerce') ?></option>
						<?php
							$months = array();
							for ($i = 1; $i <= 12; $i++) {
							    $timestamp = mktime(0, 0, 0, $i, 1);
							    $months[date('m', $timestamp)] = date('F', $timestamp);
							}
							foreach ($months as $num => $name) {
					            printf('<option value="%s">%s</option>', $num, $name);
					        }
						?>
					</select>
					<select name="bluepay_expyear" id="bluepay_expyear" class="woocommerce-select woocommerce-cc-year">
						<option value=""><?php _e('Year', 'woocommerce') ?></option>
						<?php
							$years = array();
							for ($i = date('y'); $i <= date('y') + 15; $i++) {
							    printf('<option value="%u">20%u</option>', $i, $i);
							}
						?>
					</select>
				</p>
				<p class="form-row form-row-last">
					<label for="bluepay_cvv"><?php _e("Card security code", 'woocommerce') ?> <span class="required">*</span></label>
					<input type="text" class="input-text" id="bluepay_cvv" name="bluepay_cvv" maxlength="4" style="width:45px" />
				</p>

				<div class="clear"></div>
				<p><?php echo $this->description ?></p>
			</fieldset>
			<?php
	    }


		/**
		 * Process the payment and return the result
		 **/

		function process_payment( $order_id ) {
			global $woocommerce;

			$order = new WC_Order( $order_id );
			// ************************************************
			// Create request

			$testmode = ($this->testmode == 'yes') ? 'TEST' : 'LIVE';
			$hashstr = $this->secret_key .
						$this->account_id .
						$this->trans_type .
						$order->order_total .
						'' .
						$order->billing_first_name .
						$this->get_post('bluepay_ccnum');

			$tps = bin2hex( md5($hashstr, true));

			$bluepay_request = array(
				'ACCOUNT_ID' 	=> $this->account_id,
				'USER_ID' 		=> $this->user_id,
				'TAMPER_PROOF_SEAL' => $tps,
				'TRANS_TYPE' 	=> $this->trans_type,
				'F_REBILLING'	=> 0,
				'MODE' 			=> $testmode,
				'PAYMENT_ACCOUNT' => $this->get_post('bluepay_ccnum'),
				'CARD_CVV2' 	=> $this->get_post('bluepay_cvv'),
				'CARD_EXPIRE' 	=> $this->get_post('bluepay_expmonth') . $this->get_post('bluepay_expyear'),
				'COMPANY_NAME'	=> $order->billing_company,
				'AMOUNT' 		=> $order->order_total,
				'NAME1' 		=> $order->billing_first_name,
				'NAME2' 		=> $order->billing_last_name,
				'ADDR1' 		=> $order->billing_address_1,
				'ADDR2' 		=> $order->billing_address_2,
				'CITY' 			=> $order->billing_city,
				'STATE' 		=> $order->billing_state,
				'ZIP' 			=> $order->billing_postcode,
				'COUNTRY' 		=> $order->billing_country,
				'EMAIL' 		=> $order->billing_email,
				'PHONE' 		=> $order->billing_phone,
				'CUSTOMER_IP' 	=> $_SERVER['REMOTE_ADDR'],
				'ORDER_ID' 		=> $order->id
			);

			$bluepay_debug_request = array(
				'ACCOUNT_ID' 	=> $this->account_id,
				'USER_ID' 		=> $this->user_id,
				'TRANS_TYPE' 	=> $this->trans_type,
				'F_REBILLING'	=> 0,
				'MODE' 			=> $testmode,
				'COMPANY_NAME'	=> $order->billing_company,
				'AMOUNT' 		=> $order->order_total,
				'NAME1' 		=> $order->billing_first_name,
				'NAME2' 		=> $order->billing_last_name,
				'ADDR1' 		=> $order->billing_address_1,
				'ADDR2' 		=> $order->billing_address_2,
				'CITY' 			=> $order->billing_city,
				'STATE' 		=> $order->billing_state,
				'ZIP' 			=> $order->billing_postcode,
				'COUNTRY' 		=> $order->billing_country,
				'EMAIL' 		=> $order->billing_email,
				'PHONE' 		=> $order->billing_phone,
				'CUSTOMER_IP' 	=> $_SERVER['REMOTE_ADDR'],
				'ORDER_ID' 		=> $order->id
			);

			$this->send_debugging_email( "BluePay Gateway Request: " . $this->gatewayurl . "\n\nSENDING REQUEST:" . print_r($bluepay_debug_request,true));

			// ************************************************
			// Send request

				$post = '';
				foreach($bluepay_request as $key => $val){
					$post .= urlencode($key) . "=" . urlencode($val) . "&";
				}
				$post = substr($post, 0, -1);

				$response = wp_remote_post( $this->gatewayurl, array(
       				'method'		=> 'POST',
        			'body' 			=> $post,
        			'timeout' 		=> 70
    			));

    			if ( is_wp_error($response) ) throw new Exception(__('There was a problem connecting to the payment gateway.', 'wc-gateway-bluepay'));

    			if( empty($response['body']) ) throw new Exception(__('Empty Bluepay response.', 'wc-gateway-bluepay'));

				$content = explode('&', $response['body']);
				$data = array();
				foreach ($content as $key=>$val ) {
					$temp = explode("=",$val);
					$data[$temp[0]]= urldecode($temp[1]);
				}

				$this->send_debugging_email( "Bluepay Gateway Response: \n\nRESPONSE:\n"
											. print_r($response,true)
											. "\n\nDATA:\n". print_r($data,true));

error_log( "Bluepay Gateway Response: \n\nRESPONSE:\n"
											. print_r($response,true)
											. "\n\nDATA:\n". print_r($data,true));

			// ************************************************
			// Retreive response

				if ($data['STATUS'] == 1) {
					// Successful payment or authorization

					if ( $data['TRANS_TYPE'] == 'AUTH') {
						$trans_message = __('BluePay authorization complete. Complete payment capture in your BluePay dashboard. ', 'wc-gateway-bluepay');
					} else {
						$trans_message = __('BluePay payment complete and', 'wc-gateway-bluepay');
					}

					$order->add_order_note( $trans_message
							. ' (Auth Code: ' . $data['AUTH_CODE']
							. '| Message: '. $data['MESSAGE']
							. '| Trans ID: '. $data['TRANS_ID']
							. '| AVS: '. $data['AVS']
							. '| CVV2: '. $data['CVV2']
							. '| Trans Type: '. $data['TRANS_TYPE']
							. ')' );
					$order->payment_complete();

					$woocommerce->cart->empty_cart();

					// Empty awaiting payment session
					if ( preg_match('/1\.[0-9]*\.[0-9]*/', WOOCOMMERCE_VERSION )){
						unset($_SESSION['order_awaiting_payment']);
					} else {
						unset( $woocommerce->session->order_awaiting_payment );
					}

					// Return thank you redirect
					return array(
						'result' 	=> 'success',
						'redirect'	=> $this->get_return_url( $order )
					);

				} else {
					// Decline or error

					$message_details = '';
					$expected_keys = array( 'AUTH_CODE', 'MESSAGE', 'TRANS_ID', 'AVS', 'CVV2', 'TRANS_TYPE' );
					$missing_keys = array_diff( $expected_keys, array_keys( $data ) );
					if ( empty( $missing_keys ) ) {
						$message_details = ' (Auth Code: ' . $data['AUTH_CODE']
							. '| Message: '. $data['MESSAGE']
							. '| Trans ID: '. $data['TRANS_ID']
							. '| AVS: '. $data['AVS']
							. '| CVV2: '. $data['CVV2']
							. '| Trans Type: '. $data['TRANS_TYPE']
							. ')';
					} else if ( array_key_exists( 'MESSAGE', $data ) ) {
						$message_details = ' ( Message: ' . $data['MESSAGE'] . ')';
					}

					$this->send_debugging_email( "BLUEPAY ERROR:\n" . $message_details );

					$cancelNote = __('BluePay payment failed', 'wc-gateway-bluepay') . $message_details;

					$order->add_order_note( $cancelNote );

					$this->debug(__('Payment error. We can not process your payment at this time.', 'wc-gateway-bluepay'), 'error');
				}

		}


		/**
		 * Validate payment form fields
		 */

		public function validate_fields() {
			global $woocommerce;

			$cardNumber = $this->get_post('bluepay_ccnum');
			$cardCSC = $this->get_post('bluepay_cvv');
			$cardExpirationMonth = $this->get_post('bluepay_expmonth');
			$cardExpirationYear = '20' . $this->get_post('bluepay_expyear');

			//check security code
			if(!ctype_digit($cardCSC)) {
				$this->debug(__('Card security code is invalid (only digits are allowed)', 'wc-gateway-bluepay'), 'error');
				return false;
			}


			//check expiration data
			$currentYear = date('Y');

			if(!ctype_digit($cardExpirationMonth) || !ctype_digit($cardExpirationYear) ||
				 $cardExpirationMonth > 12 ||
				 $cardExpirationMonth < 1 ||
				 $cardExpirationYear < $currentYear ||
				 $cardExpirationYear > $currentYear + 20
			) {
				$this->debug(__('Card expiration date is invalid', 'wc-gateway-bluepay'), 'error');
				return false;
			}

			//check card number
			$cardNumber = str_replace(array(' ', '-'), '', $cardNumber);

			if(empty($cardNumber) || !ctype_digit($cardNumber)) {
				$this->debug(__('Card number is invalid', 'wc-gateway-bluepay'), 'error');
				return false;
			}

			return true;
		}

		/**
		 * receipt_page
		 **/
		function receipt_page( $order ) {

			echo '<p>'.__('Thank you for your order.', 'wc-gateway-bluepay').'</p>';

		}

		/**
		 * Get post data if set
		 **/
		private function get_post($name) {
			if(isset($_POST[$name])) {
				return $_POST[$name];
			}
			return NULL;
		}

		/**
		 * Output a message or error
		 * @param  string $message
		 * @param  string $type
		 */
		public function debug( $message, $type = 'notice' ) {
			if ( version_compare( WOOCOMMERCE_VERSION, '2.1', '>=' ) ) {
				wc_add_notice( $message, $type );
			} else {
				global $woocommerce;
				if ( $type == 'error' ) {
					$woocommerce->add_error( $message );
				} else {
					$woocommerce->add_message( $message );
				}
			}
		}


		/**
		 * Send debugging email
		 **/
		function send_debugging_email( $debug ) {

			if ($this->debugon!='yes') return; // Debug must be enabled
			if (!$this->debugrecipient) return; // Recipient needed

			// Send the email
			wp_mail( $this->debugrecipient, __('BluePay Debug', 'wc-gateway-bluepay'), $debug );

		}

	}

	/**
	 * Plugin page links
	 */
	function wc_bluepay_plugin_links( $links ) {

		if ( ! defined( 'WC_VERSION' ) ) {

			$plugin_links = array(
				'<a href="' . admin_url( 'admin.php?page=woocommerce_settings&tab=payment_gateways&section=WC_Gateway_Bluepay' ) . '">' . __( 'Settings', 'wc-gateway-bluepay' ) . '</a>',
				'<a href="http://support.woothemes.com/">' . __( 'Support', 'wc-gateway-bluepay' ) . '</a>',
				'<a href="http://wcdocs.woothemes.com/user-guide/extensions/bluepay/">' . __( 'Docs', 'wc-gateway-bluepay' ) . '</a>',
			);

		} else {

			$plugin_links = array(
				'<a href="' . admin_url( 'admin.php?page=wc-settings&tab=checkout&section=WC_Gateway_Bluepay' ) . '">' . __( 'Settings', 'wc-gateway-bluepay' ) . '</a>',
				'<a href="http://support.woothemes.com/">' . __( 'Support', 'wc-gateway-bluepay' ) . '</a>',
				'<a href="http://wcdocs.woothemes.com/user-guide/extensions/bluepay/">' . __( 'Docs', 'wc-gateway-bluepay' ) . '</a>',
			);

		}

		return array_merge( $plugin_links, $links );
	}

	add_filter( 'plugin_action_links_' . plugin_basename( __FILE__ ), 'wc_bluepay_plugin_links' );

	/**
	 * Add the gateway to woocommerce
	 **/
	function add_bluepay_gateway( $methods ) {
		$methods[] = 'WC_Gateway_Bluepay'; return $methods;
	}

	add_filter('woocommerce_payment_gateways', 'add_bluepay_gateway' );
}