<?php
add_action('plugins_loaded', 'woocommerce_gateway_bluepayecheck_init', 0);

function woocommerce_gateway_bluepayecheck_init() {

	if ( ! class_exists( 'WC_Payment_Gateway' ) ) return;

	/**
	 * Localisation
	 */
	load_plugin_textdomain( 'wc-gateway-bluepay-echeck', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' );

	define('BLUEPAYECHECK_DIR', WP_PLUGIN_DIR . "/" . plugin_basename( dirname(__FILE__) ) . '/');

	/**
	 * BluePay Echeck Gateway Class
	 **/
	class WC_Gateway_Bluepay_Echeck extends WC_Payment_Gateway {

		public function __construct() {
			global $woocommerce;

	        $this->id					= 'bluepayecheck';
	        $this->method_title 		= __( 'BluePay ECheck', 'wc-gateway-bluepay-echeck' );
	        $this->method_description 	= __( 'BluePay allows customers to checkout using a bank routing number and bank account number', 'wc-gateway-bluepay' );
	        $this->icon 				= untrailingslashit( plugins_url( '/', __FILE__ ) ) . '/images/check.png';
	        $this->has_fields 			= false;
			$this->trans_type			= 'SALE';

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
			$this->testmode			= $this->settings['testmode'];
			$this->gatewayurl		= $this->settings['gatewayurl'];
			$this->debugon			= $this->settings['debugon'];
			$this->debugrecipient 	= $this->settings['debugrecipient'];

			// Actions

			add_action('woocommerce_receipt_bluepayecheck', array(&$this, 'receipt_page'));
			add_action('admin_notices', array(&$this,'bluepayecheck_ssl_check'));
			// Check if this is version 1.x.x of WooCommerce
			if ( preg_match('/1\.[0-9]*\.[0-9]*/', WOOCOMMERCE_VERSION )){
				add_action('woocommerce_update_options_payment_gateways', array( $this, 'process_admin_options'));
			} else {
				add_action('woocommerce_update_options_payment_gateways_' . $this->id, array( $this, 'process_admin_options'));
			}
	    }


		/**
	 	* Check if SSL is enabled and notify the user
	 	**/
		function bluepayecheck_ssl_check() {

		     if (get_option('woocommerce_force_ssl_checkout')=='no' && $this->enabled=='yes') :

		     	echo '<div class="error"><p>'.sprintf(__('BluePay ECheck is enabled and the <a href="%s">Force secure checkout</a> option is disabled; your checkout is not secure! Please enable this feature and ensure your server has a valid SSL certificate installed.', 'wc-gateway-bluepay'), admin_url('admin.php?page=woocommerce_settings')).'</p></div>';

		     endif;
		}


		/**
	     * Initialize Gateway Settings Form Fields
	     */
	    function init_form_fields() {

	    	$this->form_fields = array(
				'enabled' => array(
								'title' => __( 'Enable/Disable', 'wc-gateway-bluepay' ),
								'label' => __( 'Enable BluePay ECheck Gateway', 'wc-gateway-bluepay' ),
								'type' => 'checkbox',
								'description' => '',
								'default' => 'no'
							),
				'title' => array(
								'title' => __( 'Title', 'wc-gateway-bluepay' ),
								'type' => 'text',
								'description' => __( 'This controls the title which the user sees during checkout.', 'wc-gateway-bluepay' ),
								'default' => __( 'ECheck (BluePay)', 'wc-gateway-bluepay' )
							),
				'description' => array(
								'title' => __( 'Description', 'wc-gateway-bluepay' ),
								'type' => 'textarea',
								'description' => __( 'This controls the description which is displayed to the customer.', 'wc-gateway-bluepay' ),
								'default' => 'Pay via ACH with your bank account'
							),
				'account_id' => array(
								'title' => __( 'BluePay Account ID', 'wc-gateway-bluepay' ),
								'type' => 'text',
								'description' => __( 'Your 12-digit Bluepay 2.0 Account ID', 'wc-gateway-bluepay' ),
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
			<h3><?php _e('BluePay ECheck','woothemes'); ?></h3>
	    	<p><?php _e( 'BluePay allows customers to checkout via ACH using a routing number and bank account number by adding fields on the checkout page and then sending the details to BluePay.com.  ACH payments take 3-5 days to complete.', 'woothemes' ); ?></p>
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
					<label for="bluepay_routing"><?php echo __("Bank Routing Number", 'wc-gateway-bluepay') ?> <span class="required">*</span></label>
					<input type="text" class="input-text" id="bluepay_routing" name="bluepay_routing" />
				</p>
				<div class="clear"></div>

				<p class="form-row">
					<label for="bluepay_bankaccount"><?php echo __("Account Number", 'wc-gateway-bluepay') ?> <span class="required">*</span></label>
					<input type="text" class="input-text" id="bluepay_bankaccount" name="bluepay_bankaccount" />
				</p>
				<div class="clear"></div>

				<p class="form-row form-row">
					<label for="bluepay_bankaccounttype"><?php echo __("Account Type", 'wc-gateway-bluepay') ?> <span class="required">*</span></label>
					<select name="bluepay_bankaccounttype" id="bluepay_bankaccounttype" class="woocommerce-select woocommerce-bank-account">
						<option value="C">Checking</option>
					    <option value="S">Savings</option>
					</select>
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

			$account = $this->get_post('bluepay_bankaccounttype') . ':'. $this->get_post('bluepay_routing') . ':'. $this->get_post('bluepay_bankaccount');

			$hashstr = $this->secret_key .
						$this->account_id .
						$this->trans_type .
						$order->order_total .
						'' .
						$order->billing_first_name .
						$account;

			$tps = bin2hex( md5($hashstr, true));

			$bluepay_request = array(
				'ACCOUNT_ID' 	=> $this->account_id,
				'USER_ID' 		=> $this->user_id,
				'TAMPER_PROOF_SEAL' => $tps,
				'TRANS_TYPE' 	=> $this->trans_type,
				'F_REBILLING'	=> 0,
				'MODE' 			=> $testmode,
				'PAYMENT_TYPE'  => 'ACH',
				'DOC_TYPE'		=> 'WEB',
				'PAYMENT_ACCOUNT' => $account,
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
				'PAYMENT_TYPE'  => 'ACH',
				'DOC_TYPE'		=> 'WEB',
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

			$this->send_debugging_email( "BluePay ECheck Gateway Request: " . $this->gatewayurl . "\n\nSENDING REQUEST:" . print_r($bluepay_debug_request,true));

			// ************************************************
			// Send request

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
					$temp = split("=",$val);
					$data[$temp[0]]= urldecode($temp[1]);
				}


				$this->send_debugging_email( "Bluepay ECheck Gateway Response: \n\nRESPONSE:\n"
											. print_r($response,true)
											. "\n\nDATA:\n". print_r($data,true));

			// ************************************************
			// Retreive response

				if ($data['STATUS'] == 1) {
					// Successful payment

					$order->add_order_note( __('BluePay ECheck payment submitted', 'wc-gateway-bluepay')
							. ' (Auth Code: ' . $data['AUTH_CODE']
							. '| Message: '. $data['MESSAGE']
							. '| Trans ID: '. $data['TRANS_ID']
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

					$this->send_debugging_email( "BLUEPAY ERROR:\n"
							. ' (Auth Code: ' . $data['AUTH_CODE']
							. '| Message: '. $data['MESSAGE']
							. '| Trans ID: '. $data['TRANS_ID']
							. '| Trans Type: '. $data['TRANS_TYPE']
							. ')' );

					$cancelNote = __('BluePay payment failed', 'wc-gateway-bluepay')
							. ' (Auth Code: ' . $data['AUTH_CODE']
							. '| Message: '. $data['MESSAGE']
							. '| Trans ID: '. $data['TRANS_ID']
							. '| Trans Type: '. $data['TRANS_TYPE']
							. ')' ;

					$order->add_order_note( $cancelNote );

					$this->debug(__('Payment error. We can not process your payment at this time.', 'wc-gateway-bluepay'), 'error');
				}

		}


		/**
		 *Validate payment form fields
		 */

		public function validate_fields() {
			global $woocommerce;

			$bankaccount = $this->get_post('bluepay_bankaccount');
			$bankrouting = $this->get_post('bluepay_routing');

			if(empty($bankaccount) || !ctype_digit($bankaccount)) {
				$this->debug(__('Bank account number is invalid', 'wc-gateway-bluepay'), 'error');
				return false;
			}

			if(empty($bankrouting) || !ctype_digit($bankrouting)) {
				$this->debug(__('Routing number is invalid', 'wc-gateway-bluepay'), 'error');
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
	 * Add the gateway to woocommerce
	 **/
	function add_bluepayecheck_gateway( $methods ) {
		$methods[] = 'WC_Gateway_Bluepay_Echeck'; return $methods;
	}

	add_filter('woocommerce_payment_gateways', 'add_bluepayecheck_gateway' );
}