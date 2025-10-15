$(document).ready(function () {
	initializeDatepicker();

	$.validator.addMethod("dateMMYYYY", function (value, element) {
		return this.optional(element) || /^(0[1-9]|1[0-2])\/\d{4}$/.test(value);
	}, "Please enter a date in the format MM/YYYY.");

	$.validator.addMethod("fourDigits", function (value, element) {
		return this.optional(element) || /^\d{4}$/.test(value);
	}, "Please enter last 4 digits.");


	$('.simple_date_format').on('input', function (e) {
		var input = $(this).val();
		var formattedInput = input.replace(/\D/g, ''); // Remove non-digit characters

		if (formattedInput.length > 2) {
			formattedInput = formattedInput.slice(0, 2) + '/' + formattedInput.slice(2);
		}
		if (formattedInput.length > 5) {
			formattedInput = formattedInput.slice(0, 5) + '/' + formattedInput.slice(5, 9);
		}
		$(this).val(formattedInput);
	});

	updateUploadPageSvgSrc();

});

function updateUploadPageSvgSrc() {
	const theme = localStorage.getItem('theme');
	if (theme === 'dark' || theme === 'light') {
		const container = document.querySelector('.uploaded-docs');
		if (container) {
			const images = container.querySelectorAll('img.licence-img');
			images.forEach(img => {
				let src = img.getAttribute('src');
				if (theme === 'dark' && src.includes('black_icons')) {
					img.setAttribute('src', src.replace('black_icons', 'white_icons'));
				} else if (theme === 'light' && src.includes('white_icons')) {
					img.setAttribute('src', src.replace('white_icons', 'black_icons'));
				}
			});
		}
	}
}



function initializeDatepicker() {
	$("input.date_filed").bind("paste", function (e) {
		//also changed the binding too
		e.preventDefault();
	});

	$(".date_filed.my").datepicker({
		dateFormat: "mm/yy",
		changeMonth: true,
		changeYear: true,
		maxDate: "0",
	});

	$(".date_filed.my").mask("Z9/9999", {
		translation: {
			Z: {
				pattern: /[0-9]/,
				optional: true,
			},
		},
	});

	$(".date_month_year").datepicker({
		dateFormat: "mm/yy",
		changeMonth: true,
		changeYear: true,
		maxDate: "0",
	});

	$(".date_month_year").mask("Z9/9999", {
		translation: {
			Z: {
				pattern: /[0-9]/,
				optional: true,
			},
		},
	});
	$(".date_filed").datepicker({
		dateFormat: "mm/dd/yy",
		changeMonth: true,
		changeYear: true,
		maxDate: "0",
	});
}
$(document).ready(function () {
	$("input.date_filed").bind("paste", function (e) { //also changed the binding too
		e.preventDefault();
	});
});

$(document).on('input', ".date_filed", function (e) {

	this.type = 'text';
	var input = this.value;
	if (/\D\/$/.test(input)) input = input.substr(0, input.length - 3);
	var values = input.split('/').map(function (v) {
		return v.replace(/\D/g, '')
	});
	if (values[0]) values[0] = checkValue(values[0], 12);
	if (values[1]) values[1] = checkValue(values[1], 31);
	var output = values.map(function (v, i) {
		return v.length == 2 && i < 2 ? v + '/' : v;
	});
	this.value = output.join('').substr(0, 10);
});


$(document).on('blur', ".date_filed", function (e) {

	this.type = 'text';
	var input = this.value;
	var values = input.split('/').map(function (v, i) {
		return v.replace(/\D/g, '')
	});
	var output = '';

	if (values.length == 3) {
		var year = values[2].length !== 4 ? parseInt(values[2]) + 2000 : parseInt(values[2]);
		var month = parseInt(values[0]) - 1;
		var day = parseInt(values[1]);
		var d = new Date(year, month, day);
		if (!isNaN(d)) {
			var dates = [d.getMonth() + 1, d.getDate(), d.getFullYear()];
			output = dates.map(function (v) {
				v = v.toString();
				return v.length == 1 ? '0' + v : v;
			}).join('/');
		};
	};
	this.value = output;
});

function checkValue(str, max) {
	if (str.charAt(0) !== '0' || str == '00') {
		var num = parseInt(str);
		if (isNaN(num) || num <= 0 || num > max) num = 1;
		str = num > parseInt(max.toString().charAt(0)) && num.toString().length == 1 ? '0' + num : num.toString();
	};
	return str;
};
$(document).on('input', ".allow-5digit", function (e) {
	var firstFive = this.value.substring(0, 5);
	var self = $(this);
	self.val(self.val().replace(/\D/g, ""));
	if ((e.which < 48 || e.which > 57)) {
		e.preventDefault();
	}
	if (this.value.length > 5) {
		this.value = firstFive;
	}
});
$(document).on("input", ".allow-4digit", function (e) {
	var firstFour = this.value.substring(0, 4);
	var self = $(this);
	self.val(self.val().replace(/\D/g, ""));
	if (e.which < 48 || e.which > 57) {
		e.preventDefault();
	}
	if (this.value.length > 4) {
		this.value = firstFour;
	}
});

// $(document).on("blur", ".price-field", function(evt) {
//     evt.target.value = parseFloat(evt.target.value).toFixed(2);
// });

$(document).on('keyup', ".price-field", function (e) {
	var charCode = (e.which) ? e.which : e.keyCode;
	if (charCode > 31 && (charCode != 35 && charCode != 36 && charCode != 190 && charCode != 37 && charCode != 38 && charCode != 39 && charCode != 40) &&
		(charCode < 48 || (charCode > 57 && charCode < 96 && charCode > 105)))
		e.target.value = '';
	if (e.target.value < 0) {

		e.target.value = '';
		return;
	}

	if (e.target.value < 0) {

		e.target.value = '';
		return;
	}
	var count = 2;
	if (e.target.value.indexOf('.') == -1 && e.keyCode != 8) {
		if (e.target.value.length >= 7) {
			e.target.value = parseFloat(e.target.value).toFixed(count);
		}
		return;
	}

	if (((e.target.value.length - e.target.value.indexOf('.')) > count) && e.keyCode != 8) {

		if (e.target.value.length >= 7) {
			var firstseven = e.target.value.substring(0, 10);
			e.target.value = parseFloat(firstseven).toFixed(count);
		} else {
			e.target.value = parseFloat(e.target.value).toFixed(count);
		}

	}
});

$(document).on('keyup', ".deduction-price-field", function (e) {

	var charCode = (e.which) ? e.which : e.keyCode;
	if (charCode > 31 && (charCode != 35 && charCode != 45 && charCode != 36 && charCode != 190 && charCode != 37 && charCode != 38 && charCode != 39 && charCode != 40) &&
		(charCode < 48 || (charCode > 57 && charCode < 96 && charCode > 105)))
		e.target.value = '';

	var count = 2;
	if (e.target.value.indexOf('.') == -1 && e.keyCode != 8) {
		if (e.target.value.length >= 7) {
			e.target.value = parseFloat(e.target.value).toFixed(count);
		}
		return;
	}

	if (((e.target.value.length - e.target.value.indexOf('.')) > count) && e.keyCode != 8) {

		if (e.target.value.length >= 7) {
			var firstseven = e.target.value.substring(0, 10);
			e.target.value = parseFloat(firstseven).toFixed(count);
		} else {
			e.target.value = parseFloat(e.target.value).toFixed(count);
		}

	}
});



function AvoidSpace(event) {
	var k = event ? event.which : window.event.keyCode;
	if (k == 32 && event.target.selectionStart === 0) return false;
}
function googleTranslateElementInit() {
	new google.translate.TranslateElement({ pageLanguage: 'en', includedLanguages: 'en,es', autoDisplay: false }, 'google_translate_element');
}

$(".only_alphanumeric").keypress(function (event) {
	var character = String.fromCharCode(event.keyCode);
	return isValid(character);
});

function isValid(str) {
	return !/[~`!@#$%\^&*()+=\-\[\]\\';,/{}|\\":<>\?]/g.test(str);
}

$(document).ready(function () {
	// hide #back-top first
	$(".back-to-top").hide();

	// fade in #back-top
	$(function () {
		$(window).scroll(function () {
			if ($(this).scrollTop() > 100) {
				$('.back-to-top').fadeIn();
			} else {
				$('.back-to-top').fadeOut();
			}
		});
		// scroll body to 0px on click
		$('.back-to-top a').click(function () {
			$('body,html').animate({
				scrollTop: 0
			}, 50);
			return false;
		});
	});
});

$(document).ready(function () {
	$('[name="graduate"]').change(function () {
		if ($('[name="graduate"]:checked').is(":checked")) {
			$('.ug').hide();
			$iframe = $('.ug').find("iframe");
			$iframe.attr("src", $iframe.attr("src"));
			$('.phd').show();
		} else {
			$('.ug').show();
			$('.phd').hide();
			$iframe = $('.phd').find("iframe");
			$iframe.attr("src", $iframe.attr("src"));
		}
	});
});


$(function () {
	$('#video_modal').on('hidden.bs.modal', function (e) {
		$iframe = $(this).find("iframe");
		$iframe.attr("src", $iframe.attr("src"));
	});
});

function run_tutorial_videos(obj, element) {

	$('#add_attorney').modal('hide')
	var myModal = new bootstrap.Modal(element);
	// Show the modal
	myModal.show();
	var video_src = $(obj).attr('data-video');
	var video_src2 = $(obj).attr('data-video2');
	$("#video").attr('src', video_src);
	$("#player1").attr('src', video_src2);
}
// Enable Bootstrap tooltip
function reinitTooltips() {
	// Destroy existing tooltips first to avoid duplicates
	const existingTooltips = document.querySelectorAll('[data-bs-toggle="tooltip"]');
	existingTooltips.forEach(el => {
		const tooltip = bootstrap.Tooltip.getInstance(el) || el._tooltip;
		if (tooltip) tooltip.dispose();
	});

	const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
	const tooltipList = tooltipTriggerList.map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl));
	return tooltipList;
};

$(document).ready(function () {
	$(document).on("click", ".btn-toggle", function () {
		let group = $(this).closest(".custom-radio-group, .custom-check-group");

		if (group.hasClass("custom-check-group")) {
			// --- Checkbox group behavior (multiple allowed) ---
			let checkbox = $(this).find("input[type=checkbox]");

			if (checkbox.prop("checked")) {
				checkbox.prop("checked", false);
				$(this).removeClass("active");
			} else {
				checkbox.prop("checked", true);
				$(this).addClass("active");
			}
		} else if (group.hasClass("custom-radio-group")) {
			// --- Radio group behavior (only one active) ---
			group.find(".btn-toggle").removeClass("active");
			$(this).addClass("active");

			let radioId = $(this).attr("for");
			group.find("input[type=radio]").prop("checked", false);
			$("#" + radioId).prop("checked", true);
		}

	});

	// Initialize now
	reinitTooltips();
});






// function changeLanguage(lang) {
// 	document.getElementById("selectedLanguage").innerText = lang;
// }


function changeLanguage(lang) {
	// Ensure Google Translate is fully loaded before accessing the dropdown
	setTimeout(function () {
		var googleCombo = document.querySelector(".goog-te-combo");
		if (googleCombo) {
			googleCombo.value = lang;
			googleCombo.dispatchEvent(new Event("change"));
		}

		// Update button text
		document.getElementById("languageDropdown").textContent = (lang === 'en') ? 'English' : 'Spanish';


	}, 1000); // Delay of 1 second to allow Google Translate to load
}
// Theme Toggle Functionality - Wrapped in document ready
$(document).ready(function() {
	const toggleBtn = document.getElementById('themeToggleBtn');
	const lightIcon = document.getElementById('lightIcon');
	const darkIcon = document.getElementById('darkIcon');
	const themeText = document.getElementById('themeText');
	
	// Check if elements exist before proceeding
	if (!toggleBtn || !lightIcon || !darkIcon || !themeText) {
		console.error('Theme toggle elements not found');
		return;
	}
	
	const currentTheme = localStorage.getItem('theme');

	// Set the initial theme on page load
	if (currentTheme) {
		document.documentElement.setAttribute('data-theme', currentTheme);
		if (currentTheme === 'dark') {
			lightIcon.style.display = 'block';
			darkIcon.style.display = 'none';
			themeText.textContent = 'Light';
		}
	}

	// Toggle theme on button click
	toggleBtn.addEventListener('click', () => {
		const isDarkMode = document.documentElement.getAttribute('data-theme') === 'dark';
		if (isDarkMode) {
			switchToLightMode();
		} else {
			switchToDarkMode();
		}
	});

	// Switch to Dark Mode
	function switchToDarkMode() {
		document.documentElement.setAttribute('data-theme', 'dark');
		localStorage.setItem('theme', 'dark');
		lightIcon.style.display = 'block';
		darkIcon.style.display = 'none';
		themeText.textContent = 'Light';
		applyTransition();
		updateUploadPageSvgSrc();
	}

	// Switch to Light Mode
	function switchToLightMode() {
		document.documentElement.setAttribute('data-theme', 'light');
		localStorage.setItem('theme', 'light');
		lightIcon.style.display = 'none';
		darkIcon.style.display = 'block';
		themeText.textContent = 'Dark';
		applyTransition();
		updateUploadPageSvgSrc();
	}

	// Smooth transition effect
	function applyTransition() {
		document.documentElement.classList.add('transition');
		setTimeout(() => document.documentElement.classList.remove('transition'), 1000);
	}
});
//$('.form-select').select2();

// video 


document.addEventListener('DOMContentLoaded', function () {
	var modal = document.getElementById('video_modal');
	if (modal) {
		modal.addEventListener('hidden.bs.modal', function () {
			var video = document.getElementById('player1');
			if (video) {
				video.pause();
				video.currentTime = 0;
			}
		});
	} else {
		console.error('Element with ID "videomodal" not found.');
	}
});


$(document).ready(function () {



	// Event Listeners for Yes/No Buttons
	$("label[for='otherNamesYes']").click(function () { toggleOtherNames(true); });
	$("label[for='otherNamesNo']").click(function () { toggleOtherNames(false); });

	$("label[for='residency3Yes']").click(function () { toggleResidencyHistory(true); });
	$("label[for='residency3No']").click(function () { toggleResidencyHistory(false); });

});

function toggleOtherNames(show) {
	let section = $("#otherNamesSection");
	let yesOption = $("#otherNamesYes");
	let noOption = $("#otherNamesNo");
	let yesLabel = $("label[for='otherNamesYes']");
	let noLabel = $("label[for='otherNamesNo']");

	if (show) {
		section.removeClass("d-none"); // Show section
		yesOption.prop("checked", true); // Check Yes option
		noOption.prop("checked", false); // Uncheck No option

		yesLabel.addClass("active"); // Add active styling
		noLabel.removeClass("active"); // Remove active styling
	} else {
		section.addClass("d-none"); // Hide section
		noOption.prop("checked", true); // Check No option
		yesOption.prop("checked", false); // Uncheck Yes option

		noLabel.addClass("active"); // Add active styling
		yesLabel.removeClass("active"); // Remove active styling
	}
}

function toggleResidencyHistory(isYes) {
	let section = $("#previousAddressSection");
	let yesOption = $("#residency3Yes");
	let noOption = $("#residency3No");
	let yesLabel = $("label[for='residency3Yes']");
	let noLabel = $("label[for='residency3No']");

	if (isYes) {
		section.addClass("d-none"); // Hide section
		yesOption.prop("checked", true); // Check Yes option
		noOption.prop("checked", false); // Uncheck No option

		yesLabel.addClass("active"); // Make Yes active
		noLabel.removeClass("active"); // Remove active from No
	} else {
		section.removeClass("d-none"); // Show section
		noOption.prop("checked", true); // Check No option
		yesOption.prop("checked", false); // Uncheck Yes option

		noLabel.addClass("active"); // Make No active
		yesLabel.removeClass("active"); // Remove active from Yes
	}
}

$(document).ready(function () {

	// Toggle Other Names Used for Madhu
	function toggleMadhuOtherNames(show) {
		let section = $("#madhuOtherNamesSection");
		let yesOption = $("#madhuOtherNamesYes");
		let noOption = $("#madhuOtherNamesNo");
		let yesLabel = $("label[for='madhuOtherNamesYes']");
		let noLabel = $("label[for='madhuOtherNamesNo']");

		if (show) {
			section.removeClass("d-none");
			yesOption.prop("checked", true);
			noOption.prop("checked", false);
			yesLabel.addClass("active");
			noLabel.removeClass("active");
		} else {
			section.addClass("d-none");
			noOption.prop("checked", true);
			yesOption.prop("checked", false);
			noLabel.addClass("active");
			yesLabel.removeClass("active");
		}
	}

	// Toggle Residency History for Madhu
	function toggleMadhuResidencyHistory(isYes) {
		let section = $("#madhuPreviousAddressSection");
		let yesOption = $("#madhuResidency3Yes");
		let noOption = $("#madhuResidency3No");
		let yesLabel = $("label[for='madhuResidency3Yes']");
		let noLabel = $("label[for='madhuResidency3No']");

		if (isYes) {
			section.addClass("d-none");
			yesOption.prop("checked", true);
			noOption.prop("checked", false);
			yesLabel.addClass("active");
			noLabel.removeClass("active");
		} else {
			section.removeClass("d-none");
			noOption.prop("checked", true);
			yesOption.prop("checked", false);
			noLabel.addClass("active");
			yesLabel.removeClass("active");
		}
	}

	// Event Listeners
	$("label[for='madhuOtherNamesYes']").click(function () { toggleMadhuOtherNames(true); });
	$("label[for='madhuOtherNamesNo']").click(function () { toggleMadhuOtherNames(false); });

	$("label[for='madhuResidency3Yes']").click(function () { toggleMadhuResidencyHistory(true); });
	$("label[for='madhuResidency3No']").click(function () { toggleMadhuResidencyHistory(false); });

});


$(document).ready(function () {
	function toggleBankruptcyDetails(show) {
		let section = $("#bankruptcyDetailsSection");
		let yesOption = $("#bankruptcyYes");
		let noOption = $("#bankruptcyNo");
		let yesLabel = $("label[for='bankruptcyYes']");
		let noLabel = $("label[for='bankruptcyNo']");

		if (show) {
			section.removeClass("d-none"); // Show section
			yesOption.prop("checked", true); // Check Yes option
			noOption.prop("checked", false); // Uncheck No option

			yesLabel.addClass("active"); // Add active styling
			noLabel.removeClass("active"); // Remove active styling
		} else {
			section.addClass("d-none"); // Hide section
			noOption.prop("checked", true); // Check No option
			yesOption.prop("checked", false); // Uncheck Yes option

			noLabel.addClass("active"); // Add active styling
			yesLabel.removeClass("active"); // Remove active styling
		}
	}

	// Event Listeners for Yes/No Buttons
	$("label[for='bankruptcyYes']").click(function () {
		toggleBankruptcyDetails(true);
	});

	$("label[for='bankruptcyNo']").click(function () {
		toggleBankruptcyDetails(false);
	});
});


$(document).ready(function () {
	function toggleBusinessDetails(show) {
		let section = $("#businessDetailsSection");
		let yesOption = $("#businessEinYes");
		let noOption = $("#businessEinNo");
		let yesLabel = $("label[for='businessEinYes']");
		let noLabel = $("label[for='businessEinNo']");

		if (show) {
			section.removeClass("d-none"); // Show section
			yesOption.prop("checked", true); // Check Yes option
			noOption.prop("checked", false); // Uncheck No option

			yesLabel.addClass("active"); // Add active styling
			noLabel.removeClass("active"); // Remove active styling
		} else {
			section.addClass("d-none"); // Hide section
			noOption.prop("checked", true); // Check No option
			yesOption.prop("checked", false); // Uncheck Yes option

			noLabel.addClass("active"); // Add active styling
			yesLabel.removeClass("active"); // Remove active styling
		}
	}

	// Event Listeners for Yes/No Buttons
	$("label[for='businessEinYes']").click(function () {
		toggleBusinessDetails(true);
	});

	$("label[for='businessEinNo']").click(function () {
		toggleBusinessDetails(false);
	});
});

function toggleBankruptcyCases(show) {
	let section = $("#bankruptcyCasesDetailsSection");
	let yesOption = $("#bankruptcyCasesYes");
	let noOption = $("#bankruptcyCasesNo");
	let yesLabel = $("label[for='bankruptcyCasesYes']");
	let noLabel = $("label[for='bankruptcyCasesNo']");

	if (show) {
		section.removeClass("d-none"); // Show section
		yesOption.prop("checked", true); // Check Yes option
		noOption.prop("checked", false); // Uncheck No option

		yesLabel.addClass("active"); // Add active styling
		noLabel.removeClass("active"); // Remove active styling
	} else {
		section.addClass("d-none"); // Hide section
		noOption.prop("checked", true); // Check No option
		yesOption.prop("checked", false); // Uncheck Yes option

		noLabel.addClass("active"); // Add active styling
		yesLabel.removeClass("active"); // Remove active styling
	}
}

// Event Listeners for Yes/No Buttons
$("label[for='bankruptcyCasesYes']").click(function () { toggleBankruptcyCases(true); });
$("label[for='bankruptcyCasesNo']").click(function () { toggleBankruptcyCases(false); });


function togglePastBankruptcy(show) {
	let section = $("#pastBankruptcyDetails");
	let yesOption = $("#pastBankruptcyYes");
	let noOption = $("#pastBankruptcyNo");
	let yesLabel = $("label[for='pastBankruptcyYes']");
	let noLabel = $("label[for='pastBankruptcyNo']");

	if (show) {
		section.removeClass("d-none"); // Show section
		yesOption.prop("checked", true); // Check Yes option
		noOption.prop("checked", false); // Uncheck No option

		yesLabel.addClass("active"); // Add active styling
		noLabel.removeClass("active"); // Remove active styling
	} else {
		section.addClass("d-none"); // Hide section
		noOption.prop("checked", true); // Check No option
		yesOption.prop("checked", false); // Uncheck Yes option

		noLabel.addClass("active"); // Add active styling
		yesLabel.removeClass("active"); // Remove active styling
	}
}

// Event Listeners for Yes/No Buttons
$("label[for='pastBankruptcyYes']").click(function () { togglePastBankruptcy(true); });
$("label[for='pastBankruptcyNo']").click(function () { togglePastBankruptcy(false); });

$(document).ready(function () {
	function toggleBusinessDetails(show) {
		let section = $("#businessDetailsSection");
		let yesOption = $("#businessEinYes");
		let noOption = $("#businessEinNo");
		let yesLabel = $("label[for='businessEinYes']");
		let noLabel = $("label[for='businessEinNo']");

		if (show) {
			section.removeClass("d-none"); // Show section
			yesOption.prop("checked", true); // Check Yes option
			noOption.prop("checked", false); // Uncheck No option

			yesLabel.addClass("active"); // Add active styling
			noLabel.removeClass("active"); // Remove active styling
		} else {
			section.addClass("d-none"); // Hide section
			noOption.prop("checked", true); // Check No option
			yesOption.prop("checked", false); // Uncheck Yes option

			noLabel.addClass("active"); // Add active styling
			yesLabel.removeClass("active"); // Remove active styling
		}
	}

	// Ensure the section is shown by default (since "Yes" is checked)
	toggleBusinessDetails(true);

	// Event Listeners for Yes/No Buttons
	$("label[for='businessEinYes']").click(function () { toggleBusinessDetails(true); });
	$("label[for='businessEinNo']").click(function () { toggleBusinessDetails(false); });
});


$(document).ready(function () {
	function toggleBusinessUsedEin(show) {
		let section = $("#businessUsedEinSection");
		let yesOption = $("#businessUsedEinYes");
		let noOption = $("#businessUsedEinNo");
		let yesLabel = $("label[for='businessUsedEinYes']");
		let noLabel = $("label[for='businessUsedEinNo']");

		if (show) {
			section.removeClass("d-none"); // Show section
			yesOption.prop("checked", true); // Check Yes option
			noOption.prop("checked", false); // Uncheck No option

			yesLabel.addClass("active"); // Add active styling
			noLabel.removeClass("active"); // Remove active styling
		} else {
			section.addClass("d-none"); // Hide section
			noOption.prop("checked", true); // Check No option
			yesOption.prop("checked", false); // Uncheck Yes option

			noLabel.addClass("active"); // Add active styling
			yesLabel.removeClass("active"); // Remove active styling
		}
	}

	// Ensure the section is shown by default (since "Yes" is checked)
	toggleBusinessUsedEin(true);

	// Event Listeners for Yes/No Buttons
	$("label[for='businessUsedEinYes']").click(function () { toggleBusinessUsedEin(true); });
	$("label[for='businessUsedEinNo']").click(function () { toggleBusinessUsedEin(false); });
});

$(document).ready(function () {
	function toggleUrgentProperty(show) {
		let section = $("#urgentPropertyDetailsSection");
		let yesOption = $("#urgentPropertyYes");
		let noOption = $("#urgentPropertyNo");
		let yesLabel = $("label[for='urgentPropertyYes']");
		let noLabel = $("label[for='urgentPropertyNo']");

		if (show) {
			section.removeClass("d-none"); // Show section
			yesOption.prop("checked", true); // Check Yes option
			noOption.prop("checked", false); // Uncheck No option

			yesLabel.addClass("active"); // Add active styling
			noLabel.removeClass("active"); // Remove active styling
		} else {
			section.addClass("d-none"); // Hide section
			noOption.prop("checked", true); // Check No option
			yesOption.prop("checked", false); // Uncheck Yes option

			noLabel.addClass("active"); // Add active styling
			yesLabel.removeClass("active"); // Remove active styling
		}
	}

	// Event Listeners for Yes/No Buttons
	$("label[for='urgentPropertyYes']").click(function () { toggleUrgentProperty(true); });
	$("label[for='urgentPropertyNo']").click(function () { toggleUrgentProperty(false); });
});










$(document).ready(function () {
	// Function to handle Next button
	$(".next-tab").click(function () {
		let nextTab = $(this).data("next"); // Get next tab ID
		if (nextTab) {
			$(nextTab).trigger("click"); // Trigger click event on the next tab
		}
	});

	// Function to handle Back button
	$(".prev-tab").click(function () {
		let prevTab = $(this).data("prev"); // Get previous tab ID
		if (prevTab) {
			$(prevTab).trigger("click"); // Trigger click event on the previous tab
		}
	});
});







document.querySelectorAll('.sidebar-link').forEach(link => {
	link.addEventListener('click', function (e) {
		document.querySelector('.offcanvas-body').scroll({
			top: 0,
			behavior: 'smooth'
		});
	});
});

function redirectToURL(url) {
	$('#page_loader').show();
	window.location.href = url;
}

