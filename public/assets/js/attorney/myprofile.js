(function ($, window, document) {
	'use strict';

	const profilePage = {
		isLawFirm: false,
		deleteMobileVideoUrl: '',
		init() {
			this.cacheDom();
			this.readDataFromDom();
			this.bindEvents();
			this.initValidations();
			this.initCroppieHandlers();
			this.applyInitialUIState();
		},
		cacheDom() {
			this.$doc = $(document);
			this.$infoCard = $('.card.information-area');
			this.$passwordTab = $('#pills-update_password-tab');
			this.$companyForm = $('#company_profile_frm');
			this.$passwordForm = $('#update_password_frm');
			this.$paymentForm = $('#payment_frm');
			this.$subscribeStorageModal = $('#subscribe_storage');
			this.$petitionForm = $('#petition_form');
			this.$noOfPetitionClient = $('#no_of_petition_client');
			this.$noOfParalegalClient = $('#no_of_paralegal_client');
			this.$subS = $('#sub_s');
			this.$imageUpload = $('#imageUpload');
			this.$cropModal = $('#cropImagePop');
			this.$uploadFullImage = $('#upload-full-image');
			this.$uploadFullImageImg = $('#upload-full-image img');
			this.$uploadCropImage = $('#upload-crop-image');
			this.$imagePreview = $('#imagePreview');
			this.$cropCompanyLogoImage = $('#cropCompanyLogoImage');
		},
		readDataFromDom() {
			this.isLawFirm = String(this.$infoCard.data('is-lawfirm')) === '1';
			this.deleteMobileVideoUrl = String(this.$infoCard.data('delete-mobile-video-url') || '');
		},
		bindEvents() {
			const self = this;

			this.$subscribeStorageModal.on('shown.bs.modal', function () {
				$('input[name=petition_type]', self.$petitionForm).trigger('change');
			});

			window.paraLegalChange = function (selectedValue) {
				self.handleParalegalToggle(String(selectedValue) === 'yes');
			};

			this.$doc.on('change', '.jointpayroll', function () {
				const selected = $('input[name=jointpayrollChange]:checked').val();
				if (String(selected) === '1') {
					self.$subS.show();
				} else {
					self.$subS.hide();
					$('.get-data-value').prop('checked', false);
				}
				const packagePrice = Number($('input[name="type"]:checked').data('price')) || 0;
				self.calculateTotal('package', packagePrice);
			});

			this.$doc.on('click', 'input[name="petition_type"]', function () {
				if (!$(this).hasClass('activated')) {
					$('input[name="paralegal_type"]').prop('checked', false);
				}
			});

			window.caluclatePetitiontotal = function () {
				self.calculatePetitionTotals();
			};

			this.$doc.on('click', '#video_subscription_frm input[name="type"]', function () {
				if (!$(this).hasClass('activated')) {
					$('input[name="type1[]"]').prop('checked', false);
				}
			});

			window.caluclatetotal = function (type, val, fromMainList = false) {
				self.calculateTotal(type, val, fromMainList === true);
			};

			$('.pcolor-100').ready(function () {
				$('.pcolor-114').parents('.custom-radio.radio-primary').css('display', 'none');
				$('.pcolor-116').parents('.custom-radio.radio-primary').css('display', 'none');
				$('.pcolor-117').parents('.custom-radio.radio-primary').css('display', 'none');
				$('.pcolor-115').parents('.custom-radio.radio-primary').css('display', 'block');
			});
			$('.pcolor-101').on('click', function () {
				$('.pcolor-115').parents('.custom-radio.radio-primary').css('display', 'none');
				$('.pcolor-117').parents('.custom-radio.radio-primary').css('display', 'none');
				$('.pcolor-114').parents('.custom-radio.radio-primary').css('display', 'block');
				$('.pcolor-116').parents('.custom-radio.radio-primary').css('display', 'block');
			});
			$('.pcolor-102').on('click', function () {
				$('.pcolor-115').parents('.custom-radio.radio-primary').css('display', 'none');
				$('.pcolor-116').parents('.custom-radio.radio-primary').css('display', 'none');
				$('.pcolor-114').parents('.custom-radio.radio-primary').css('display', 'block');
				$('.pcolor-117').parents('.custom-radio.radio-primary').css('display', 'block');
			});
			$('.pcolor-103').on('click', function () {
				$('.pcolor-115').parents('.custom-radio.radio-primary').css('display', 'none');
				$('.pcolor-116').parents('.custom-radio.radio-primary').css('display', 'none');
				$('.pcolor-114').parents('.custom-radio.radio-primary').css('display', 'block');
				$('.pcolor-117').parents('.custom-radio.radio-primary').css('display', 'block');
			});
			$('.pcolor-100').on('click', function () {
				$('.pcolor-114').parents('.custom-radio.radio-primary').css('display', 'none');
				$('.pcolor-116').parents('.custom-radio.radio-primary').css('display', 'none');
				$('.pcolor-117').parents('.custom-radio.radio-primary').css('display', 'none');
				$('.pcolor-115').parents('.custom-radio.radio-primary').css('display', 'block');
			});

			$('.petition_112').ready(function () {
				$('.paralegal_111').parents('.radio-primary.petition-f').css('display', 'none');
				$('.paralegal_110').parents('.radio-primary.petition-f').css('display', 'block');
			});
			$('.petition_113').on('click', function () {
				$('.paralegal_111').parents('.radio-primary.petition-f').css('display', 'block');
				$('.paralegal_110').parents('.radio-primary.petition-f').css('display', 'none');
			});
			$('.petition_112').on('click', function () {
				$('.paralegal_111').parents('.radio-primary.petition-f').css('display', 'none');
				$('.paralegal_110').parents('.radio-primary.petition-f').css('display', 'block');
			});

			window.add_subscription = function () {
				$('#subscribe_add').modal('show');
				$('#no_of_questionnaire').trigger('change');
			};
			window.storage_subscription = function () {
				$('#subscribe_storage').modal('show');
			};
			window.video_subscription = function () {
				$('#subscribe_welcome_video').modal('show');
			};
			window.payment_pending = function () {
				alert('Please register your payment card before make subscription.');
			};
			window.gotToProfile = function () {
				$('a#profile-tab').trigger('click');
			};
			window.deleteMobileVideo = function (id) {
				self.deleteMobileVideo(id);
			};
		},
		initValidations() {
			const validateOpts = {
				errorPlacement(error, element) {
					const $formGroup = $(element).parents('.form-group');
					const $nextLabel = $formGroup.next('label');
					if ($nextLabel.hasClass('error')) {
						$nextLabel.remove();
						$formGroup.after($(error)[0].outerHTML);
					} else {
						$formGroup.after($(error)[0].outerHTML);
					}
				},
				success(label, element) {
					$(label).parent().removeClass('error');
					$(element).parents('.form-group').next('label').remove();
				}
			};
			if (this.$companyForm.length) this.$companyForm.validate(validateOpts);
			if (this.$passwordForm.length) this.$passwordForm.validate(validateOpts);
			if (this.$paymentForm.length) this.$paymentForm.validate(validateOpts);
		},
		initCroppieHandlers() {
			const self = this;
			let croppieInstance = null;
			let rawImg = '';
			let imageType = 'full';
			const FLIP = 2;
			const NORMAL = 1;
			let orientation = NORMAL;

			function readFile(input) {
				if (input.files && input.files[0]) {
					const reader = new FileReader();
					reader.onload = function (e) {
						self.$uploadCropImage.addClass('ready');
						self.$cropModal.modal('show');
						rawImg = e.target.result;
					};
					reader.readAsDataURL(input.files[0]);
				} else {
					self.$imagePreview.val('');
					self.$cropCompanyLogoImage.val('');
				}
			}

			self.$cropModal.on('shown.bs.modal', function () {
				self.$uploadFullImage.show();
				self.$uploadFullImageImg.attr('src', rawImg);
				self.$uploadCropImage.hide();
			});

			$('#startCropImageBtn').on('click', function () {
				const $btn = $(this);
				if ($btn.text() === 'Start Crop') {
					imageType = 'crop';
					self.$uploadFullImage.hide();
					self.$uploadCropImage.show();
					$btn.text('Full Image');
					croppieInstance = self.$uploadCropImage.croppie({
						viewport: { width: 300, height: 200 },
						boundary: { width: 400, height: 400 },
						showZoomer: true,
						enableResize: true,
						enableOrientation: true,
						enableExif: true
					});
					croppieInstance.croppie('bind', { url: rawImg });
				} else {
					imageType = 'full';
					self.$uploadFullImage.show();
					self.$uploadCropImage.hide();
					$btn.text('Start Crop');
				}
			});

			$('#Flip').on('click', function () {
				if (!croppieInstance) return;
				orientation = orientation === NORMAL ? FLIP : NORMAL;
				croppieInstance.croppie('bind', { url: rawImg, orientation });
			});

			$('#rotate').on('click', function () {
				if (!croppieInstance) return;
				croppieInstance.croppie('rotate', parseInt($(this).data('deg'), 10));
			});

			this.$doc.on('change', '#imageUpload', function () {
				readFile(this);
			});

			$('#cancelCropBtn').on('click', function () {
				self.$imagePreview.attr('src', '');
				self.$cropCompanyLogoImage.val('');
			});

			$('#cropImageBtn').on('click', function () {
				if (imageType === 'crop' && croppieInstance) {
					croppieInstance
						.croppie('result', {
							type: 'base64',
							format: 'jpeg',
							size: { width: 480, height: 270 }
						})
						.then(function (resp) {
							self.$imagePreview.attr('src', resp);
							self.$cropCompanyLogoImage.val(resp);
							self.$cropModal.modal('hide');
						});
				} else {
					self.$imagePreview.attr('src', rawImg);
					self.$cropCompanyLogoImage.val(rawImg);
					self.$cropModal.modal('hide');
				}
			});
		},
		applyInitialUIState() {
			if (this.isLawFirm && this.$passwordTab.length) {
				this.$passwordTab.trigger('click');
			}
		},
		handleParalegalToggle(enabled) {
			const selectedType = String($('input[name=petition_type]:checked', this.$petitionForm).val() || '');
			if (enabled) {
				$('#paralegal_div').removeClass('hide-data');
			} else {
				$('#paralegal_div').addClass('hide-data');
			}
			if (selectedType === String(window.APP_PETITION_BASIC)) {
				$('#paralegal_' + String(window.APP_PARALEGAL_BASIC)).prop('checked', true);
			}
			if (selectedType === String(window.APP_PETITION_PREMIUM)) {
				$('#paralegal_' + String(window.APP_PARALEGAL_PREMIUM)).prop('checked', true);
			}
			const noOfPetition = Number(this.$noOfPetitionClient.val()) || 0;
			this.$noOfParalegalClient.val(noOfPetition);
			this.calculatePetitionTotals();
		},
		calculatePetitionTotals() {
			$('input[name="petition_type"]').removeClass('activated');
			$('input[name="petition_type"]:checked').addClass('activated');
			const selectedPetitionPrice = Number($('input[name="petition_type"]:checked', this.$petitionForm).data('price')) || 0;
			const petitionCount = Number(this.$noOfPetitionClient.val()) || 0;
			const totalPetition = selectedPetitionPrice * petitionCount;
			let paralegalSelected = String($('input[name=paralegal_selected]:checked', this.$petitionForm).val() || '0') === '1';
			let paralegalPrice = paralegalSelected ? Number($('input[name=paralegal_type]:checked', this.$petitionForm).data('price')) || 0 : 0;
			let paralegalCount = paralegalSelected ? Number(this.$noOfParalegalClient.val()) || 0 : 0;
			const totalParalegal = paralegalPrice * paralegalCount;
			const totalPayable = (totalPetition + totalParalegal).toFixed(2);
			$('.petition-total-price').text(totalPetition.toFixed(2));
			$('.paralegal-total-price').text(totalParalegal.toFixed(2));
			$('#total_petition_price').val(totalPayable);
			$('.petition-pay-price').text(totalPayable);
		},
		calculateTotal(type, val, fromMainList) {
			if (fromMainList === true) {
				if (String(val) === '103') {
					this.$subS.hide();
					$('.jointpayroll').hide();
				} else {
					$('.jointpayroll').show();
					if ($('#joint_payroll_yes').prop('checked')) this.$subS.show();
				}
			}
			const bg = $('input[name="type"]:checked').closest('.custom-radio').find('label').css('background-color');
			$('.get-data-value').closest('.custom-radio').find('label').css('background-color', '#aaa');
			$('.get-data-value:checked').closest('.custom-radio').find('label').css('background-color', bg);
			const selectedPrices = [];
			const payrollAddOnPrices = [];
			let jointTemplatePrice = 0;
			$('.get-data-value:checked').each(function () {
				const isJoint = $(this).hasClass('class-name-114');
				const price = Number($(this).data('price')) || 0;
				selectedPrices.push(price);
				if (isJoint) jointTemplatePrice = price;
				else payrollAddOnPrices.push(price);
			});
			const subPackTotal = selectedPrices.reduce((a, b) => a + b, 0);
			const payrollTotal = payrollAddOnPrices.reduce((a, b) => a + b, 0);
			$('input[name="type"]').removeClass('activated');
			$('input[name="type"]:checked').addClass('activated');
			const selectedPackage = String($('input[name="type"]:checked').val() || '');
			let price = Number($('input[name="type"]:checked').data('price')) || 0;
			let qty = 1;
			if (type === 'client') {
				qty = Number(val) || 1;
			} else {
				qty = Number($('#no_of_questionnaire').val()) || 1;
			}
			const nonDiscountList = window.APP_NON_DISCOUNT_PACKAGE || [];
			let payPrice = (price * qty + subPackTotal * qty);
			let totalPrice = (price * qty);
			let discountPercent = Number(window.APP_SUBSCRIPTION_DISCOUNT_PERCENT || 0) || 0;
			let discPriceText = '0.00';
			if (!nonDiscountList.includes(selectedPackage)) {
				$('.discount-line').removeClass('hide-data');
				if (discountPercent > 0) {
					const beforeDiscount = totalPrice;
					const afterDiscount = beforeDiscount - beforeDiscount * (discountPercent / 100);
					payPrice = afterDiscount + subPackTotal * qty;
					discPriceText = (beforeDiscount - afterDiscount).toFixed(2) + ' (' + discountPercent + '%)';
				} else {
					payPrice = totalPrice + subPackTotal * qty;
				}
				$('.t-price').removeClass('hide-data');
				$('.d-price').removeClass('hide-data');
				$('.total-price').text('$' + totalPrice.toFixed(2));
				$('.discount-price').text('$' + discPriceText);
			} else {
				$('.discount-line').addClass('hide-data');
				$('.t-price').addClass('hide-data');
				$('.d-price').addClass('hide-data');
			}
			$('.joint-married').text('$' + Number(jointTemplatePrice || 0).toFixed(2));
			$('.payroll-assistant').text('$' + Number(payrollTotal || 0).toFixed(2));
			$('.pay-price').text('$' + Number(payPrice || 0).toFixed(2));
		},
		deleteMobileVideo(attorneyId) {
			try {
				if (!window.langLbl || !window.langLbl.confirmDelete) {
					if (!confirm('Are you sure you want to delete?')) return;
				} else {
					if (!confirm(window.langLbl.confirmDelete)) return;
				}
				const url = this.deleteMobileVideoUrl;
				if (!url) return;
				laws.ajax(url, { attorney_id: attorneyId }, function (response) {
					const res = JSON.parse(response);
					$.systemMessage(res.msg, 'alert--success', true);
					$('.video_preview').addClass('hide-data');
				});
			} catch (e) {}
		}
	};

	$(function () {
		profilePage.init();
		window.add_subscription = window.add_subscription || function () { $('#subscribe_add').modal('show'); $('#no_of_questionnaire').trigger('change'); };
		window.storage_subscription = window.storage_subscription || function () { $('#subscribe_storage').modal('show'); };
		window.video_subscription = window.video_subscription || function () { $('#subscribe_welcome_video').modal('show'); };
		window.payment_pending = window.payment_pending || function () { alert('Please register your payment card before make subscription.'); };
		window.gotToProfile = window.gotToProfile || function () { $('a#profile-tab').trigger('click'); };
		window.caluclatePetitiontotal = window.caluclatePetitiontotal || profilePage.calculatePetitionTotals.bind(profilePage);
		window.caluclatetotal = window.caluclatetotal || profilePage.calculateTotal.bind(profilePage);
		window.paraLegalChange = window.paraLegalChange || profilePage.handleParalegalToggle.bind(profilePage);
		window.deleteMobileVideo = window.deleteMobileVideo || profilePage.deleteMobileVideo.bind(profilePage);
	});
})(jQuery, window, document);


