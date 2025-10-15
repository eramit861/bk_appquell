/**
 * Choose From Existing Docs modal behaviors
 * Extracted from choose_from_existing_docs.blade.php
 */


window.BK = window.BK || {};
window.BK.ChoosePostSubmissionModal = (function () {
    'use strict';

    function addClientPostSubmissionDocToList() {
        const documentName = document.getElementById('document_name').value.trim();

        if (documentName === '') {
            alert('Please enter a document name');
            return;
        }

        const existingLabels = document.querySelectorAll('.doc-card');
        for (let i = 0; i < existingLabels.length; i++) {
            if (existingLabels[i].textContent.trim().toLowerCase() === documentName.toLowerCase()) {
                alert('A document with this name already exists. Please choose a different name.');
                return;
            }
        }

        const key = 'post_submission_doc_' + documentName.toLowerCase().replace(/[^a-z0-9]/g, '_');

        const newCardHtml = `
            <div class="col-4">
                <div class="custom-item mb-2">
                    <div class="item-card btn-new-ui-default px-3 py-1 not-selected-border selected" data-label="">
                        <div class="card-body p-0">
                            <label class="w-100 d-flex mb-0" for="post_submission_doc_${key}">
                                <span class="doc-card w-100 name_${key}">${documentName}</span>
                                <input type="checkbox"
                                    id="post_submission_doc_${key}"
                                    class="float_right d-none mt-1 notify_doc"
                                    name="post_submission_docs[${key}]"
                                    value="${documentName}"
                                    onclick="selectDocument(this)"
                                    checked="true">
                            </label>
                        </div>
                    </div>
                </div>
            </div>
        `;

        const docsList = document.getElementById('post_submission_docs_list');
        const rowContainer = docsList ? docsList.querySelector('.row.gx-3') : null;

        if (rowContainer) {
            rowContainer.insertAdjacentHTML('beforeend', newCardHtml);
            document.getElementById('document_name').value = '';
            const newCheckbox = document.getElementById(`post_submission_doc_${key}`);
            if (newCheckbox) {
                selectDocument(newCheckbox);
            }
        }
    }

    function selectDocument(element) {
        const $card = $(element).closest(".item-card");
        if ($(element).is(":checked")) {
            $card.addClass("selected");
            $card.removeClass("no-selected");
        } else {
            $card.removeClass("selected");
            $card.addClass("no-selected");
        }
    }

    return {
        addClientPostSubmissionDocToList,
        selectDocument
    };
})();

// Backward compatibility for existing inline onclick handlers
window.addClientPostSubmissionDocToList = window.BK.ChoosePostSubmissionModal.addClientPostSubmissionDocToList;
window.selectDocument = window.BK.ChoosePostSubmissionModal.selectDocument;


