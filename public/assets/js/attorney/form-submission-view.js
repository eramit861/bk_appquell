/**
 * Form Submission View JavaScript Module
 * Handles questionnaire form submission, export/import, printing, and detailed property management
 */

window.BK = window.BK || {};
window.BK.FormSubmissionView = (function() {
    'use strict';

    // Configuration object
    const config = window.FormSubmissionViewConfig || {};

    // Global variables for detailed property management
    const selectedItems = new Map();

    /**
     * Initialize the module
     */
    function init() {
        initializeScrollBehavior();
        initializePopupHandlers();
        initializeIncomeCalculations();
        
        // Expose functions globally for backward compatibility
        exposeGlobalFunctions();
    }

    /**
     * Initialize scroll behavior for questionnaire sidebar
     */
    function initializeScrollBehavior() {
        // Hide questionnaire sidebar initially
        $("#questionnaire-sidebar-nav").hide();

        // Show/hide sidebar based on scroll position
        $(window).scroll(function () {
            if ($(this).scrollTop() > 100) {
                $('#questionnaire-sidebar-nav').fadeIn();
            } else {
                $('#questionnaire-sidebar-nav').fadeOut();
            }
        });
    }

    /**
     * Initialize popup handlers
     */
    function initializePopupHandlers() {
        const $popupContent = $('.creditor-select-popup-for-import');
        $popupContent.closest('.popup').find('a.close').on('click', function(e) {
            e.preventDefault();
            $popupContent.html('');
        });
    }

    /**
     * Initialize income calculations
     */
    function initializeIncomeCalculations() {
        let totalPrice = 0;
        const spouseNetIncome = $("#joints_total_net_income").data("net-income") || 0;
        const debtorNetIncome = $("#debtor_total_net_income").data("net-income") || 0;

        totalPrice = spouseNetIncome + debtorNetIncome;

        if (totalPrice > 0) {
            $(".display_net_income_total").html(`<span class='text-c-green'>$${totalPrice.toLocaleString(undefined, {minimumFractionDigits: 2, maximumFractionDigits: 2})}</span>`);
        }

        if (totalPrice < 0) {
            const displayTotalPrice = -(totalPrice);
            $(".display_net_income_total").html(`<span class='text-c-red'>$${displayTotalPrice.toLocaleString(undefined, {minimumFractionDigits: 2, maximumFractionDigits: 2})}</span>`);
        }

        let displayIVsJIncomeTotal = 0;
        const totExpense = config.totalMonthlyExpenses || '0';
        displayIVsJIncomeTotal = (totalPrice - parseFloat(totExpense.replace(/,/g, '')));

        if (displayIVsJIncomeTotal > 0) {
            $(".display_i_vs_j_income_total").html(`<span class='text-c-green'>$${displayIVsJIncomeTotal.toLocaleString(undefined, {minimumFractionDigits: 2, maximumFractionDigits: 2})}</span>`);
        }
        if (displayIVsJIncomeTotal < 0) {
            const displayIVsJIncomeTotalDisplay = -(displayIVsJIncomeTotal);
            $(".display_i_vs_j_income_total").html(`<span class='text-c-red'>$${displayIVsJIncomeTotalDisplay.toLocaleString(undefined, {minimumFractionDigits: 2, maximumFractionDigits: 2})}</span>`);
        }

        $(".display_net_expense_total").html(`<span class='text-c-blue'>$${totExpense}</span>`);
    }

    /**
     * Open questionnaire edit modal
     * @param {string} url - Edit URL
     */
    function openQueEditModal(url) {
        laws.ajax(url, {client_id: config.clientId}, function(res) {
            const ans = $.parseJSON(res);
            if (ans.success === true && ans.html !== '') {
                laws.updateFaceboxContent(ans.html, 'questionnaire-model main-content-area');
            }
        });
    }

    /**
     * Export report functionality
     * @param {HTMLElement} object - Select element
     */
    function exportReport(object) {
        const selectedValue = object.value;
        const clientId = config.clientId;
        
        if (selectedValue === '1') {
            openImportPopup(clientId, config.routes.downloadJublieeImportPopup);
        }
        if (selectedValue === '2') {
            openImportPopup(clientId, config.routes.downloadAttorneyBciPopup);
        }
        if (selectedValue === '3') {
            window.location.href = config.routes.downloadClientCreditorsXls;
        }

        setTimeout(function() {
            object.value = 0; 
        }, 1000);
    }

    /**
     * Open import popup
     * @param {string} clientId - Client ID
     * @param {string} ajaxurl - AJAX URL
     */
    function openImportPopup(clientId, ajaxurl) {
        laws.ajax(ajaxurl, {
            client_id: clientId
        }, function(response) {
            laws.updateFaceboxContent(response, 'large-fb-width p-0 bg-unset creditor-select-popup-for-import');
        });
    }

    /**
     * Clean import popup HTML
     */
    function cleanImportPopupHTML() {
        $(".creditor-select-popup-for-import").html('');
    }

    /**
     * Print report functionality
     * @param {HTMLElement} object - Select element
     */
    function printReport(object) {
        const selectedValue = object.value;
        if (selectedValue === '1') {
            printDiv('printableArea');
        }
        if (selectedValue === '2') {
            printAssetDiv('printableAssetArea');
        }
    }

    /**
     * Update navigation button active state
     * @param {HTMLElement} anchor - Anchor element
     * @param {string} currentFragment - Current fragment
     */
    function updateNavBtnActive(anchor, currentFragment) {
        const allFragments = [
            'financial-affairs',
            'current-expenses',
            'current-income',
            'scroll-debts',
            'personal-property',
            'vehicles',
            'real-property',
            'basic-information'
        ];
        
        $('.nav-btn-sec').removeClass('active');
        $(anchor).addClass('active');
        
        allFragments.forEach(function(fragment) {
            if (fragment === currentFragment || currentFragment === '') {
                $('.' + fragment + '-sec').removeClass('hide-data').addClass('transition-effect');
            } else {
                $('.' + fragment + '-sec').addClass('hide-data transition-effect');
            }
        });
        
        if (currentFragment === '') {
            $('#questionnaire-sidebar-nav').removeClass('hide-data');
        } else {
            $('#questionnaire-sidebar-nav').addClass('hide-data');
        }
    }

    /**
     * Check for notes
     * @param {number} checkStatus - Check status (default: 1)
     */
    function checkForNotes(checkStatus = 1) {
        const clientId = config.valId;
        const url = config.routes.checkForNotes;
        
        laws.ajax(url, {client_id: clientId, check_status: checkStatus}, function(res) {
            const ans = $.parseJSON(res);
            if (ans.success === true && ans.html !== '') {
                laws.updateFaceboxContent(ans.html, 'large-fb-width p-0');
            }
        });
    }

    /**
     * Show notes
     */
    function showNotes() {
        checkForNotes(0);
    }

    /**
     * Add to uploaded docs
     * @param {string} clientType - Client type
     */
    function addToUploadedDocs(clientType) {
        const clientId = config.clientId;
        const ajaxurl = config.routes.addProfitLossToClientZip;
        const flagValue = $("#" + clientType + '_add_profit_loss_to_client_zip').is(":checked");
        
        laws.ajax(ajaxurl, {client_id: clientId, flagValue: flagValue, clientType: clientType}, function(response) {
            const res = JSON.parse(response);
            if (res.status === 1) {
                $.systemMessage(res.msg, 'alert--success', true);
            } else {
                $.systemMessage(res.msg, 'alert--danger', true);
            }
        });
    }

    /**
     * Print div content
     * @param {string} divName - Div name to print
     */
    function printDiv(divName) {
        $("#logo-img").removeClass("d-none");
        const printContents = $("#" + divName).html();
        const originalContents = $('body').html();
        $('body').html(printContents);
        window.print();
        $('body').html(originalContents);
        $("#logo-img").addClass("d-none");
    }

    /**
     * Print asset div content
     * @param {string} divName - Div name to print
     */
    function printAssetDiv(divName) {
        $(".print_asset_logo").removeClass("d-none");
        $(".print_asset_footer").removeClass("d-none");
        const originalContents = $('body').html();

        const headd = $(".print_asset_logo").html() || "";
        const data1 = $("#preview-real-property").html() || "";
        const data2 = $("#preview-vehicles").html() || "";
        const data3 = $("#preview-personal-property").html() || "";
        const data4 = $("#preview-scroll-debts").html() || "";
        const data5 = $("#preview-current-income").html() || "";
        const data6 = $("#preview-current-expenses").html() || "";
        const data7 = $("#preview-financial-affairs").html() || "";
        const footd = $(".print_asset_footer").html() || "";
        const printContents = headd + data1 + data2 + data3 + data4 + data5 + data6 + data7 + footd;

        // Create a temporary DOM from the string
        const parser = new DOMParser();
        const doc = parser.parseFromString(printContents, 'text/html');

        const elements = doc.querySelectorAll('.questionnaire-not-submitted-div');
        if (elements.length > 1) {
            // Keep only the first one
            for (let i = 1; i < elements.length; i++) {
                elements[i].remove();
            }
        }

        // Serialize back to string
        const finalPrintContents = doc.body.innerHTML;

        $('body').html(finalPrintContents);
        window.print();
        $('body').html(originalContents);
        $(".print_asset_logo").addClass("d-none");
        $(".print_asset_footer").addClass("d-none");
    }

    /**
     * Paralegal check popup
     */
    function paralegalCheckPopup() {
        const clientId = config.valId;
        const parent = "client_questionnaire";
        const ajaxurl = config.routes.meanTestPopup;
        
        laws.ajax(ajaxurl, {
            client_id: clientId, 
            parent: parent
        }, function(response) {
            laws.updateFaceboxContent(response, 'large-fb-width');
        });
    }

    /**
     * Update review status
     * @param {HTMLElement} element - Element
     * @param {string} id - ID
     * @param {string} updateFor - Update for
     * @param {string} label - Label
     * @param {string} initialName - Initial name
     */
    function updateReviewStatus(element, id, updateFor, label, initialName) {
        if (!confirm("Do you want to update the status?")) {
            return;
        }
        
        const clientId = config.valId;
        let name = $('.' + updateFor + '_reviewed_by').val();

        if (name === "") {
            name = initialName;
        }

        const ajaxurl = config.routes.updateReviewStatus;
        laws.ajax(ajaxurl, { id: id, client_id: clientId, updateFor: updateFor, name: name, label: label }, function(response) {
            const res = JSON.parse(response);
            const reviewSec = $('.reviewed-sec-' + updateFor);
            const successLabel = $('.success-label-' + updateFor);
            const dangerLabel = $('.danger-label-' + updateFor);
            const dangerSmall = $('.danger-small-' + updateFor);
            const reviewInput = $('.' + updateFor + '_reviewed_by');
            const saveIcon = $('.save-icon-' + updateFor);
            const editIcon = $('.edit-icon-' + updateFor);
            const reviewedIcon = $('.reviewed-icon-' + updateFor);
            
            if (res.status === 1) {
                $.systemMessage(res.msg, 'alert--success', true);
                reviewSec.addClass('bubble-success').removeClass('bubble-danger');
                reviewSec.attr("onclick", `showHideReviewedInput('success', '${updateFor}')`);
                successLabel.removeClass('hide-data').html(`${res.note}`);
                dangerLabel.addClass('hide-data');
                dangerSmall.addClass('hide-data');
                reviewedIcon.removeClass('hide-data');
                reviewInput.val(name);
            } else {
                $.systemMessage(res.msg, 'alert--danger', true);
                reviewSec.removeClass('bubble-success').addClass('bubble-danger');
                successLabel.addClass('hide-data');
                dangerLabel.removeClass('hide-data');
            }
            reviewInput.addClass('hide-data');
            saveIcon.addClass('hide-data');
            editIcon.removeClass('hide-data');
        });
    }

    /**
     * Show/hide reviewed input
     * @param {string} status - Status
     * @param {string} forKey - For key
     */
    function showHideReviewedInput(status, forKey) {
        const reviewSec = $('.reviewed-sec-' + forKey);
        const successLabel = $('.success-label-' + forKey);
        const dangerLabel = $('.danger-label-' + forKey);
        const dangerSmall = $('.danger-small-' + forKey);
        const reviewInput = $('.' + forKey + '_reviewed_by');
        const saveIcon = $('.save-icon-' + forKey);
        const editIcon = $('.edit-icon-' + forKey);
        const reviewedIcon = $('.reviewed-icon-' + forKey);
        const reviewedParent = $('.reviewed-' + forKey);

        if (status === 'success') {
            reviewSec.removeClass('bubble-success').addClass('bubble-danger');
            successLabel.addClass('hide-data');
            dangerLabel.removeClass('hide-data');
            dangerSmall.removeClass('hide-data');
            dangerSmall.html(`(Reviewed by):`);
            reviewedIcon.addClass('hide-data');
            reviewInput.removeClass('hide-data');
            saveIcon.removeClass('hide-data');
            editIcon.addClass('hide-data');
        } 
        if (status === 'danger') {
            reviewInput.removeClass('hide-data');
            saveIcon.removeClass('hide-data');
            editIcon.addClass('hide-data');
            reviewedIcon.addClass('hide-data');
            dangerSmall.html(`(Reviewed by):`);
            reviewedParent.removeClass('not-reviewed');		
        }
    }

    // Detailed Property Management Functions
    /**
     * Empty selected items
     */
    function emptySelectedItems() {
        selectedItems.clear();
    }

    /**
     * Initialize selected items from previous data
     * @param {string} previousData - Previous data string
     */
    function initializeSelectedItems(previousData) {
        if (!previousData) return;

        const previousItems = previousData.split(';').map(item => item.trim());

        previousItems.forEach(item => {
            const parts = item.split(' ');

            let quantity = 1;
            let price = '';
            let label = '';

            if (!isNaN(parts[0])) {
                quantity = parseInt(parts.shift(), 10);
            }

            if (parts[parts.length - 1].includes('$')) {
                price = parts.pop();
                price = price.replace('$', '');
            }

            label = parts.join(' ').trim();
            let currentPrice = 0;
            if (price > 0) {
                currentPrice = price;
            }

            selectedItems.set(label, {
                quantity: quantity,
                price: parseFloat(currentPrice).toFixed(2)
            });

            let itemFound = false;

            $('.item-card').each(function() {
                if ($(this).data('label') === label) {
                    $(this).addClass('selected');
                    $(this).find('select').val(quantity);
                    $(this).find('input.price-field').val(currentPrice);
                    itemFound = true;
                    return false;
                }
            });

            if (!itemFound && label !== undefined && currentPrice !== undefined) {
                addCustomItem(label, quantity, currentPrice);
            }
        });

        updateSelectedItemsList();
    }

    /**
     * Update selected items list display
     */
    function updateSelectedItemsList() {
        if (selectedItems.size > 0) {
            const itemsArray = Array.from(selectedItems, ([label, {quantity, price}]) => {
                let currentPrice = parseFloat(0).toFixed(2);
                if (price > 0) {
                    currentPrice = price;
                }
                if (quantity === 1) {
                    return `${label} $${currentPrice}`;
                } else {
                    return `${quantity} ${label} $${currentPrice}`;
                }
            });
            $('#selected-items-list').text(itemsArray.join('; '));
        } else {
            $('#selected-items-list').text('None');
        }
    }

    /**
     * Handle card click
     * @param {Event} event - Click event
     */
    function handleCardClick(event) {
        const card = $(event.target).closest('.item-card');
        const label = card.data('label');

        if (card.hasClass('selected')) {
            card.removeClass('selected');
            card.find('select').val(0);
            card.find('input').val(0);
            selectedItems.delete(label);
        } else {
            const price = card.find('input').val() || 0;
            const quantity = card.find('.select').val() || 1;
            const currentQuantity = quantity > 1 ? quantity : 1;
            const priceValue = card.find('.price-field').val() || 0;
            const currentPrice = priceValue > 0 ? priceValue : 0;

            card.addClass('selected');
            card.find('select').val(quantity);
            card.find('input').val(0);
            selectedItems.set(label, {
                quantity: currentQuantity,
                price: parseFloat(currentPrice).toFixed(2)
            });
        }
        updateSelectedItemsList();
    }

    /**
     * Handle quantity change
     * @param {Event} event - Change event
     */
    function handleQuantityChange(event) {
        const card = $(event.target).closest('.item-card');
        const label = card.data('label');
        const currentQuantity = parseInt(event.target.value) || 0;
        const currentPrice = card.find('.price-field').val() || 0;

        if (currentQuantity > 0) {
            card.addClass('selected');
            selectedItems.set(label, {
                quantity: currentQuantity,
                price: parseFloat(currentPrice).toFixed(2)
            });
        } else {
            card.removeClass('selected');
            selectedItems.delete(label);
        }

        updateSelectedItemsList();
    }

    /**
     * Handle price change
     * @param {Event} event - Input event
     */
    function handlePriceChange(event) {
        const input = $(event.target);
        const card = input.closest('.item-card');
        const label = card.data('label');
        const currentQuantity = selectedItems.get(label) ? selectedItems.get(label).quantity : 1;
        const price = input.val();
        
        if (currentQuantity > 0) {
            if (!card.hasClass('selected')) {
                card.addClass('selected');
            }
            card.find('select').val(currentQuantity);
            selectedItems.set(label, {
                quantity: currentQuantity,
                price: parseFloat(price).toFixed(2)
            });
        }

        updateSelectedItemsList();
    }

    /**
     * Handle price on blur
     * @param {Event} event - Blur event
     */
    function handlePriceOnBlur(event) {
        let currentVal = $(event.target).val();
        if (currentVal === "" || isNaN(parseFloat(currentVal))) {
            currentVal = 0;
        }
        $(event.target).val(parseFloat(currentVal).toFixed(2));
    }

    /**
     * Custom item input handler
     */
    function customItemInput() {
        const customItem = $('#custom-item').val().trim();
        if (customItem !== "") {
            $('#custom-item-quantity').val(1);
        } else {
            $('#custom-item-quantity').val(0);
        }
    }

    /**
     * Handle add custom item
     */
    function handleAddCustomItem() {
        const customItem = $('#custom-item').val().trim();
        const customQuantity = parseInt($('#custom-item-quantity').val()) || 0;
        const customPrice = parseFloat($('#custom-item-price').val()) || 0;

        if (customItem && customQuantity > 0) {
            selectedItems.set(customItem, {
                quantity: customQuantity,
                price: customPrice
            });
            addCustomItem(customItem, customQuantity, customPrice);
            $('#custom-item').val('');
            $('#custom-item-quantity').val(0);
            $('#custom-item-price').val(0);
        }

        updateSelectedItemsList();
    }

    /**
     * Add custom item
     * @param {string} label - Item label
     * @param {number} quantity - Quantity
     * @param {number} price - Price
     */
    function addCustomItem(label, quantity, price) {
        const newCardHtml = `
            <div class="col-md-3 custom-item">
                <div class="card item-card selected" data-label="${label}">
                    <div class="card-body p-0">
                        <h6 class="card-title mb-0 w-100 p-2">
                            <span onclick="handleCardClick(event)">${label}</span>&nbsp;
                            <span onclick="handleCardClick(event)"></span>
                        </h6>
                        <div class="d-flex">
                            <div class="p-2 pt-0 w-100">
                                <small>Quantity:</small>
                                <select class="form-control-custom-select" onchange="handleQuantityChange(event)">
                                    ${Array.from({length: 11}, (_, i) => `<option value="${i}" ${i == quantity ? 'selected' : ''}>${i}</option>`).join('')}
                                </select>
                            </div>
                            <div class="p-2 pt-0">
                                <small>Total&nbsp;Value&nbsp;of&nbsp;Item(s):</small>
                                <input type="text" class="form-control-custom-input price-field w-price-size" value="${price}" oninput="handlePriceChange(event)" onblur="handlePriceOnBlur(event)" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>`;

        if ($('.add-more-item-card').hasClass('hide-data')) {
            $('.add-more-item-card').removeClass('hide-data');
        }

        $(newCardHtml).insertBefore($('.bottom-empty-div'));

        selectedItems.set(label, {
            quantity: quantity,
            price: price
        });

        updateSelectedItemsList();
    }

    /**
     * Handle save click
     * @param {Event} event - Click event
     * @param {string} type - Type
     * @param {boolean} attorneyEdit - Attorney edit flag
     */
    function handleSaveClick(event, type, attorneyEdit = false) {
        event.preventDefault();
        const selectedItemsString = Array.from(selectedItems, ([label, quantity]) => `${quantity}-${label}`).join(';');
        const itemsArray = Array.from(selectedItems, ([label, {quantity, price}]) => {
            if (quantity === 1) {
                return `${label} $${price}`;
            } else {
                return `${quantity} ${label} $${price}`;
            }
        });
        
        const descriptionText = itemsArray.join('; ');
        $('.detailed_description_' + type).html(descriptionText);

        const totalPrice = Array.from(selectedItems.values())
            .reduce((sum, {price}) => sum + parseFloat(price), 0)
            .toFixed(2);
        $('.detailed_amount_' + type).html("$ " + totalPrice);

        const data = [descriptionText, totalPrice];
        const clientId = config.clientId;
        updatePropertyAssetToDB(clientId, type, data);

        emptySelectedItems();
        $.facebox.close();
    }

    /**
     * Update property asset to database
     * @param {string} clientId - Client ID
     * @param {string} type - Type
     * @param {Array} data - Data array
     */
    function updatePropertyAssetToDB(clientId, type, data) {
        const url = config.assetSaveRoute;

        laws.ajax(url, {
            client_id: clientId,
            type: type,
            data: data
        }, function(response) {
            const res = JSON.parse(response);
            if (res.status === 0) {
                $.systemMessage(res.msg, 'alert--danger', true);
            } else {
                $.systemMessage(res.msg, "alert--success", true);
            }
        });
    }

    /**
     * Open detailed tab items form attorney side
     * @param {string} url - URL
     * @param {string} type - Type
     * @param {boolean} attorneyEdit - Attorney edit flag
     */
    function openDetailedTabItemsFormAttorneySide(url, type = '', attorneyEdit = false) {
        const previousData = $('.detailed_tab_items_' + type).val();
        
        laws.ajax(url, { type: type, previous_data: previousData }, function (response) {
            const res = JSON.parse(response);
            if (res.status === 0) {
                $.systemMessage(res.msg, "alert--danger", true);
            }
            if (res.success === true) {
                if (attorneyEdit) {
                    $("#secondaryModalBs .modal-content").html(res.html);
                    $("#secondaryModalBs").modal("show"); 
                } else {
                    laws.updateFaceboxContent(res.html);
                    $('.check_empty_' + type).removeClass('hide-data');
                }
            }
        });
    }

    /**
     * Expose functions globally for backward compatibility
     */
    function exposeGlobalFunctions() {
        window.openQueEditModal = openQueEditModal;
        window.exportreport = exportReport;
        window.openImportPopup = openImportPopup;
        window.cleanImportPopupHTML = cleanImportPopupHTML;
        window.printreport = printReport;
        window.updateNavBtnActive = updateNavBtnActive;
        window.checkForNotes = checkForNotes;
        window.show_notes = showNotes;
        window.add_to_uploaded_docs = addToUploadedDocs;
        window.printDiv = printDiv;
        window.printAssetDiv = printAssetDiv;
        window.paralegalCheckPopup = paralegalCheckPopup;
        window.updateReviewStatus = updateReviewStatus;
        window.showHideReviewedInput = showHideReviewedInput;
        
        // Detailed property functions
        window.emptySelectedItems = emptySelectedItems;
        window.initializeSelectedItems = initializeSelectedItems;
        window.updateSelectedItemsList = updateSelectedItemsList;
        window.handleCardClick = handleCardClick;
        window.handleQuantityChange = handleQuantityChange;
        window.handlePriceChange = handlePriceChange;
        window.handlePriceOnBlur = handlePriceOnBlur;
        window.customItemInput = customItemInput;
        window.handleAddCustomItem = handleAddCustomItem;
        window.addCustomItem = addCustomItem;
        window.handleSaveClick = handleSaveClick;
        window.updatePropertyAssetToDB = updatePropertyAssetToDB;
        window.openDetailedTabItemsFormAttorneySide = openDetailedTabItemsFormAttorneySide;
    }

    // Public API
    return {
        init: init,
        openQueEditModal: openQueEditModal,
        exportReport: exportReport,
        openImportPopup: openImportPopup,
        cleanImportPopupHTML: cleanImportPopupHTML,
        printReport: printReport,
        updateNavBtnActive: updateNavBtnActive,
        checkForNotes: checkForNotes,
        showNotes: showNotes,
        addToUploadedDocs: addToUploadedDocs,
        printDiv: printDiv,
        printAssetDiv: printAssetDiv,
        paralegalCheckPopup: paralegalCheckPopup,
        updateReviewStatus: updateReviewStatus,
        showHideReviewedInput: showHideReviewedInput,
        emptySelectedItems: emptySelectedItems,
        initializeSelectedItems: initializeSelectedItems,
        updateSelectedItemsList: updateSelectedItemsList,
        handleCardClick: handleCardClick,
        handleQuantityChange: handleQuantityChange,
        handlePriceChange: handlePriceChange,
        handlePriceOnBlur: handlePriceOnBlur,
        customItemInput: customItemInput,
        handleAddCustomItem: handleAddCustomItem,
        addCustomItem: addCustomItem,
        handleSaveClick: handleSaveClick,
        updatePropertyAssetToDB: updatePropertyAssetToDB,
        openDetailedTabItemsFormAttorneySide: openDetailedTabItemsFormAttorneySide
    };

})();

// Initialize when DOM is ready
$(document).ready(function() {
    window.BK.FormSubmissionView.init();
});
