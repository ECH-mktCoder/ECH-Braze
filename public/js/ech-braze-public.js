(function ($) {
	'use strict';
	$(document).ready(function () {
		const brazeEnabled = window.braze !== undefined;
		if (!brazeEnabled) return;

		const getCreateDate = () => {
			const today = new Date();
			return today.getFullYear() + '-' +
				String(today.getMonth() + 1).padStart(2, '0') + '-' +
				String(today.getDate()).padStart(2, '0');
		};
		

		let $activeForm = null;

		$(document).on('submit', 'form.ech_lfg_form', function () {
			$activeForm = $(this);
		});

		$(document).ajaxSuccess((event, xhr, settings) => {
			let isTargetAction = false;

			if (typeof settings.data === 'string') {
				isTargetAction = settings.data.includes('action=lfg_formToMSP');
			} else if (typeof settings.data === 'object' && settings.data !== null) {
				isTargetAction = settings.data.action === 'lfg_formToMSP';
			}

			if (isTargetAction && $activeForm) {
				let response;
				try {
					const jsonResponse = (typeof xhr.responseText === 'string') ? JSON.parse(xhr.responseText) : xhr.responseJSON;
					response = jsonResponse?.data || jsonResponse;
				} catch (e) {
					console.error("Braze: Failed to parse AJAX response.", e);
					return;
				}

				if (response && response.result === 0) {
					// console.log("Braze: MSP Success detected. Processing payload...");

					const rawData = $activeForm.serializeArray();
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
						const user = window.braze.getUser();
						if (formData.first_name) user.setFirstName(formData.first_name);
						if (formData.last_name) user.setLastName(formData.last_name);
						if (formData.email && formData.email.includes('@')) {
							user.setEmail(formData.email);
						}
						user.setPhoneNumber(externalID);
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
						'create_date': getCreateDate(),
					};

					// 正式發送事件給 Braze
					window.braze.logCustomEvent('lead_form_submit', brazePayload);
					window.braze.requestImmediateDataFlush();
					console.log("Braze: Custom event 'lead_form_submit' sent.");
					$activeForm = null;
				} else {
					console.warn("Braze: API returned result != 0, skipping Braze tracking.");
				}
			}
		});

		/**
		 * WhatsApp event
		 */
		$('a[data-btn="whatsapp"]').on('click', function () {
			const wtsUrl = $(this).attr('href');
			if (!wtsUrl) return;

			try {
				const urlObj = new URL(wtsUrl);
				const params = new URLSearchParams(urlObj.search);

				const brazePayload = {
					'destination_url': wtsUrl,
					'current_page': window.location.href,
					'whatsapp_phone': params.get('phone') || '',
					'whatsapp_text': params.get('text') || '',
					'business_name': ech_braze_obj.business_name,
					'create_date': getCreateDate()
				};

				window.braze.logCustomEvent('whatsapp_click', brazePayload);
				window.braze.requestImmediateDataFlush();
				console.log("Braze: WhatsApp Click Sent");

			} catch (e) {
				console.error("Braze WhatsApp Error:", e);
			}
		});

	});


})(jQuery);
