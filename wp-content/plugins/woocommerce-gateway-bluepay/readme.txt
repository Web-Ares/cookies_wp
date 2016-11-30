== Installation ==

 * Unzip the files and upload the folder into your plugins folder (wp-content/plugins/) overwriting old versions if they exist
 * Activate the plugin in your WordPress admin area
 * Open the settings page for WooCommerce and click the "Payment Gateways" tab
 * Click on the sub tab for "BluePay"
 * Configure your BluePay settings
 
== Configuring BluePay settings in the WooCommerce admin area ==

 * Enable/Disable - Enable or disable this gateway from being used on the site
 * Title - This is the title that appears on the checkout page for this payment gateway
 * Description - This setting controls the message that appears under the payment fields on the checkout page. Here you can list the types of cards you accept
 * BluePay Account ID - Your 12-digit BluePay 2.0 Account ID (See below)
 * BluePay User ID - Your 12-digit BluePay 2.0 User ID  (See below)
 * BluePay Secret Key - Secret key from BluePay dashboard  (See below)
 * Payment Type - Which payment command to run: Sale authorizes and charges the card. Authorize Only verifies funds are available
 * Test Mode - If checked the transaction will be simulated by BluePay, but not actually processed
 * Gateway URL Override - Override for URL of BluePay
 * Debugging - Receive emails containing the data sent to and from BluePay. Does not include credit card number
 * Debugging Email - Email of recipient of debug emails
 
 Press "Save changes" to apply your changes. 


== Configuring BluePay ECheck settings in the WooCommerce admin area ==

 * Enable/Disable - Enable or disable this gateway from being used on the site
 * Title - This is the title that appears on the checkout page for this payment gateway
 * Description - This setting controls the message that appears under the payment fields on the checkout page. Here you can list the types of cards you accept
 * BluePay Account ID - Your 12-digit BluePay 2.0 Account ID (See below)
 * BluePay User ID - Your 12-digit BluePay 2.0 User ID (See below)
 * BluePay Secret Key - Secret key from BluePay dashboard (See below)
 * Test Mode - If checked the transaction will be simulated by BluePay, but not actually processed
 * Gateway URL Override - Override for URL of BluePay
 * Debugging - Receive emails containing the data sent to and from BluePay (does not include credit card information)
 * Debugging Email - Email of recipient of debug emails.
 
 Press "Save changes" to apply your changes. 



== Where to find your BluePay Credentials ==

To setup your BluePay payment gateway you will need to retrieve your Account ID, User ID, and Secret Key from the BluePay dashboard.

How to retrieve your credentials: 

1.  Login to the Merchant Console at https://secure.bluepay.com/
2.  In the top menu click on Administration > Users > List
3.  The User ID will be listed next to the Username that you want to use
4.  Copy this value to your WooCommerce BluePay settings page
5.  In the top menu click on Administration > Accounts > List
6.  The Account ID will be listed next to the Account Name that you want to use
7.  Copy this value to your WooCommerce BluePay settings page
8.  Click on the "View" icon that looks like a face with glasses under "Options"
9.  In the "Website Integration" group if the field to the right of "Secret Key" is blank press the "Create New Key" button
10. Copy this value to your WooCommerce BluePay settings page
11. Save the settings in the WooCommerce BluePay settings page
