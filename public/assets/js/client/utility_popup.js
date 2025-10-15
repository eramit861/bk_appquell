// Utility Popup JavaScript

const selectedUtilities = new Set();

// Function to initialize cards based on the "previous_data" string
function initializeSelectedUtilities(previousData) {
    if (!previousData) return;

    // Split the string to get individual utilities
    const previousUtilities = previousData.split('/');

    // Loop through each utility from previous data
    previousUtilities.forEach(function (utility) {
        let utilityFound = false;

        // Check if this utility already exists in any card
        $('.utility-card').each(function () {
            const label = $(this).data('label');
            if (label === utility) {
                // If utility exists, mark it as selected
                $(this).addClass('selected');
                selectedUtilities.add(utility);
                utilityFound = true;
                return false; // Break loop if found
            }
        });

        // If the utility was not found, create a new card for it
        if (!utilityFound) {
            const newCardHtml = `
                    <div class="col-md-3 utility-item">
                        <div class="card utility-card selected" data-label="${utility}">
                            <div class="card-body d-flex align-items-center p-2">
                                <img class="mr-3" src="${window.__utilityPopupData.defaultImageUrl}" alt="${utility}">
                                <h6 class="card-title mb-0">${utility}</h6>
                            </div>
                        </div>
                    </div>
                `;

            // Insert new card before the "Add More" section and mark it as selected
            $(newCardHtml).insertBefore($('.add-more-utility-card'));
            selectedUtilities.add(utility);
        }
    });

    updateSelectedUtilitiesList(); // Update the selected utilities list
}

// Function to update the selected utilities list
function updateSelectedUtilitiesList() {
    if (selectedUtilities.size > 0) {
        $('#selected-utilities-list').text(Array.from(selectedUtilities).join('/'));
    } else {
        $('#selected-utilities-list').text('None');
    }
}

$(function () {
    // On utility card click to toggle selection
    $(document).on('click', '.utility-card', function () {
        // $('#utility-list').on('click', '.utility-card', function() {
        const label = $(this).data('label');
        if (!$(this).find('#add-custom-utility').length) {
            $(this).toggleClass('selected');
            if (selectedUtilities.has(label)) {
                selectedUtilities.delete(label);
                $(this).removeClass('selected');
            } else {
                selectedUtilities.add(label);
            }
            updateSelectedUtilitiesList();
        }
    });

    // On add custom utility button click
    // $('#add-custom-utility').on('click', function() {
    $(document).on('click', '.add-custom-utility', function () {
        const customUtility = $('#custom-utility').val().trim();
        if (customUtility !== "") {
            const newCardHtml = `
                <div class="col-md-3 utility-item">
                    <div class="card utility-card selected" data-label="${customUtility}">
                        <div class="card-body d-flex align-items-center p-2">
                            <img class="mr-3" src="${window.__utilityPopupData.defaultImageUrl}" alt="${customUtility}">
                            <h6 class="card-title mb-0">${customUtility}</h6>
                        </div>
                    </div>
                </div>
            `;
            $(newCardHtml).insertBefore($('.add-more-utility-card'));
            selectedUtilities.add(customUtility);
            updateSelectedUtilitiesList();
            $('#custom-utility').val('');
        }
    });

    // On Done button click
    // $('.done.btn.btn-primary').on('click', function(event) {
    $(document).on('click', '.done.btn.btn-primary', function () {
        event.preventDefault();
        const selectedUtilitiesString = Array.from(selectedUtilities).join('/');
        $('a.close').trigger('click');
        $(`.utility_text_field_d${window.__utilityPopupData.type}`).val(selectedUtilitiesString);
        if (selectedUtilitiesString !== '') {
            $(`.utility-bills-data-div-d${window.__utilityPopupData.type}`).removeClass('hide-data');
            $(`.utility-bills-data-div-d${window.__utilityPopupData.type} .expense_prices`).focus();
        }
    });

});

openUtilityForm = function (url, debtor_type = '') {
    var previous_data = $('.utility_text_field_d' + debtor_type).val();
    laws.ajax(url, { debtor_type: debtor_type, previous_data: previous_data }, function (response) {
        var res = JSON.parse(response);
        if (res.status == 0) {
            $.systemMessage(res.msg, "alert--danger", true);
        }
        if (res.success == true) {
            laws.updateFaceboxContent(res.html);
            initializeSelectedUtilities(previous_data);
        }
    });
};
