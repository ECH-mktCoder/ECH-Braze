<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://127.0.0.1
 * @since      1.0.0
 *
 * @package    Ech_Braze
 * @subpackage Ech_Braze/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Ech_Braze
 * @subpackage Ech_Braze/public
 * @author     Rowan Chang <rowanchang@prohaba.com>
 */
class Ech_Braze_Public
{
    /**
     * The ID of this plugin.
     *
     * @since    1.0.0
     * @access   private
     * @var      string    $plugin_name    The ID of this plugin.
     */
    private $plugin_name;

    /**
     * The version of this plugin.
     *
     * @since    1.0.0
     * @access   private
     * @var      string    $version    The current version of this plugin.
     */
    private $version;

    /**
     * Initialize the class and set its properties.
     *
     * @since    1.0.0
     * @param      string    $plugin_name       The name of the plugin.
     * @param      string    $version    The version of this plugin.
     */
    public function __construct($plugin_name, $version)
    {

        $this->plugin_name = $plugin_name;
        $this->version = $version;

    }

    /**
     * Register the stylesheets for the public-facing side of the site.
     *
     * @since    1.0.0
     */
    public function enqueue_styles()
    {

        /**
         * This function is provided for demonstration purposes only.
         *
         * An instance of this class should be passed to the run() function
         * defined in Ech_Braze_Loader as all of the hooks are defined
         * in that particular class.
         *
         * The Ech_Braze_Loader will then create the relationship
         * between the defined hooks and the functions defined in this
         * class.
         */

        wp_enqueue_style($this->plugin_name, plugin_dir_url(__FILE__) . 'css/ech-braze-public.css', [], $this->version, 'all');

    }

    /**
     * Register the JavaScript for the public-facing side of the site.
     *
     * @since    1.0.0
     */
    public function enqueue_scripts()
    {

        /**
         * This function is provided for demonstration purposes only.
         *
         * An instance of this class should be passed to the run() function
         * defined in Ech_Braze_Loader as all of the hooks are defined
         * in that particular class.
         *
         * The Ech_Braze_Loader will then create the relationship
         * between the defined hooks and the functions defined in this
         * class.
         */

        wp_enqueue_script($this->plugin_name, plugin_dir_url(__FILE__) . 'js/ech-braze-public.js', [ 'jquery' ], $this->version, false);

    }

    public function initialize_Braze_SDK()
    {
        $apiKey = get_option('ech_braze_api_key');
        $baseUrl = get_option('ech_braze_base_url');
        if (!$apiKey || !$baseUrl) {
            return;
        }
        ?>
		<script type="text/javascript">
			+function(a,p,P,b,y){a.braze={};a.brazeQueue=[];for(var s="BrazeSdkMetadata DeviceProperties Card Card.prototype.dismissCard Card.prototype.removeAllSubscriptions Card.prototype.removeSubscription Card.prototype.subscribeToClickedEvent Card.prototype.subscribeToDismissedEvent Card.fromContentCardsJson ImageOnly CaptionedImage ClassicCard ControlCard ContentCards ContentCards.prototype.getUnviewedCardCount ControlMessage InAppMessage InAppMessage.SlideFrom InAppMessage.ClickAction InAppMessage.DismissType InAppMessage.OpenTarget InAppMessage.ImageStyle InAppMessage.Orientation InAppMessage.TextAlignment InAppMessage.CropType InAppMessage.prototype.closeMessage InAppMessage.prototype.removeAllSubscriptions InAppMessage.prototype.removeSubscription InAppMessage.prototype.subscribeToClickedEvent InAppMessage.prototype.subscribeToDismissedEvent InAppMessage.fromJson FullScreenMessage ModalMessage HtmlMessage SlideUpMessage User User.Genders User.NotificationSubscriptionTypes User.prototype.addAlias User.prototype.addToCustomAttributeArray User.prototype.addToSubscriptionGroup User.prototype.getUserId User.prototype.getUserId User.prototype.incrementCustomUserAttribute User.prototype.removeFromCustomAttributeArray User.prototype.removeFromSubscriptionGroup User.prototype.setCountry User.prototype.setCustomLocationAttribute User.prototype.setCustomUserAttribute User.prototype.setDateOfBirth User.prototype.setEmail User.prototype.setEmailNotificationSubscriptionType User.prototype.setFirstName User.prototype.setGender User.prototype.setHomeCity User.prototype.setLanguage User.prototype.setLastKnownLocation User.prototype.setLastName User.prototype.setPhoneNumber User.prototype.setPushNotificationSubscriptionType User.prototype.setLineId InAppMessageButton InAppMessageButton.prototype.removeAllSubscriptions InAppMessageButton.prototype.removeSubscription InAppMessageButton.prototype.subscribeToClickedEvent FeatureFlag FeatureFlag.prototype.getStringProperty FeatureFlag.prototype.getNumberProperty FeatureFlag.prototype.getBooleanProperty FeatureFlag.prototype.getImageProperty FeatureFlag.prototype.getJsonProperty FeatureFlag.prototype.getTimestampProperty Banner Banner.prototype.getStringProperty Banner.prototype.getNumberProperty Banner.prototype.getBooleanProperty Banner.prototype.getImageProperty Banner.prototype.getJsonProperty Banner.prototype.getTimestampProperty automaticallyShowInAppMessages hideContentCards showContentCards showInAppMessage deferInAppMessage toggleContentCards changeUser destroy getDeviceId getDeviceId initialize isPushBlocked isPushPermissionGranted isPushSupported logCardDismissal logContentCardImpressions logContentCardClick logBannerImpressions logBannerClick logCustomEvent logInAppMessageButtonClick logInAppMessageClick logInAppMessageHtmlClick logInAppMessageImpression logPurchase openSession requestPushPermission removeAllSubscriptions removeSubscription requestContentCardsRefresh refreshFeatureFlags requestImmediateDataFlush enableSDK isDisabled setLogger setSdkAuthenticationSignature addSdkMetadata disableSDK subscribeToContentCardsUpdates subscribeToInAppMessage subscribeToSdkAuthenticationFailures toggleLogging unregisterPush wipeData handleBrazeAction subscribeToFeatureFlagsUpdates getAllFeatureFlags logFeatureFlagImpression requestBannersRefresh insertBanner getAllBanners subscribeToBannersUpdates isInitialized".split(" "),i=0;i<s.length;i++){for(var m=s[i],k=a.braze,l=m.split("."),j=0;j<l.length-1;j++)k=k[l[j]];k[l[j]]=(new Function("return function "+m.replace(/\./g,"_")+"(){window.brazeQueue.push(arguments); return true}"))()}window.braze.getDeferredInAppMessage=function(){return new window.braze.InAppMessage};window.braze.getCachedContentCards=function(){return new window.braze.ContentCards};window.braze.getUser=function(){return new window.braze.User};window.braze.getFeatureFlag=function(){return new window.braze.FeatureFlag};window.braze.getBanner=function(){return new window.braze.Banner};window.braze.newBannerFromJson=function(){return new window.braze.Banner};(y=p.createElement(P)).type='text/javascript';
				y.src='https://js.appboycdn.com/web-sdk/6.5/braze.min.js';
				y.async=1;(b=p.getElementsByTagName(P)[0]).parentNode.insertBefore(y,b)
			}(window,document,'script');
		</script>
		<script>
			// initialize the SDK
			braze.initialize('<?php echo esc_js($apiKey); ?>', {
					baseUrl: '<?php echo esc_js($baseUrl); ?>',
					enableLogging: false, // set to `true` for debugging
					allowUserSuppliedJavascript: false, // set to `true` to support custom HTML messages
			});

			// Enable automatic display of in-app messages
			// Required if you want in-app messages to display automatically when triggered
			braze.automaticallyShowInAppMessages();

			// `openSession` should be called last - after `changeUser` and `automaticallyShowInAppMessages`
			braze.openSession();
		</script>
		<?php
    }

    public function braze_tracking_script()
    {
        $business_name = get_option('ech_braze_website_brand_name');
        ?>
		<script>
    (function($) {
        "use strict";

        $(document).ready(function() {
            const brazeEnabled = window.braze !== undefined;
            if (!brazeEnabled) return;

            const getCreateDate = () => {
                const today = new Date();
                return today.getFullYear() + '-' + 
                    String(today.getMonth() + 1).padStart(2, '0') + '-' + 
                    String(today.getDate()).padStart(2, '0');
            };

            $('a[data-btn="whatsapp"]').on('click', function() {
                const wtsUrl = $(this).attr('href');
                try {

                    const urlObj = new URL(wtsUrl),
						params = new URLSearchParams(urlObj.search);

					const brazePayload = {
                        'destination_url': wtsUrl,
                        'current_page': window.location.href,
                        'whatsapp_phone': params.get('phone') || '',
                        'whatsapp_text': params.get('text') || '',
                        'business_name': '<?php echo $business_name; ?>',
                        'create_date': getCreateDate()
					};

                    window.braze.logCustomEvent('whatsapp_click', brazePayload);

                    window.braze.requestImmediateDataFlush();
					console.log("Braze: WhatsApp Click Sent", brazePayload);
                } catch (e) { console.error("Braze Error:", e); }
            });

            $('form.ech_lfg_form').on('submit', function() {
                const rawData = $(this).serializeArray();
                const formData = {};
                const items = [];

                rawData.forEach(field => {
                    if (field.name === 'item') {
                        items.push(field.value);
                    } else {
                        formData[field.name] = field.value;
                    }
                });

				const externalID = (formData.telPrefix || '') + (formData.tel || '');	
                if (externalID) {
                    window.braze.changeUser(externalID);
                }
				const brazePayload = {
					'dbricks_form_type': 'lead_form',
					'page_url': window.location.href,
					'last_name': formData.last_name || '',
					'first_name': formData.first_name || '',
					'tel': externalID,
					'email': formData.email || '',
					'booking_date': formData.booking_date || '',
					'booking_time': formData.booking_time || '',
					'shop': formData.shop || "",
					'item': items.join(', '),
					'info_remark': formData['info_remark[]'] || '',
					'create_date': getCreateDate()
				};
                window.braze.logCustomEvent('lead_form_submit', brazePayload);
                // console.log("Braze: Lead Form Submitted", brazePayload);
                window.braze.requestImmediateDataFlush();
            });
        });
    })(jQuery);
    </script>
		<?php
    }



}
