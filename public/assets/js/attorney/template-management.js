(function (window, document) {
  'use strict';

  window.BK = window.BK || {};
  const ns = (window.BK.TemplateManagement = {});

  function ensureDeps() {
    const missing = [];
    if (typeof $ === 'undefined') missing.push('jQuery ($)');
    if (typeof Sortable === 'undefined') missing.push('Sortable');
    if (missing.length) {
      console.warn('[TemplateManagement] Missing deps:', missing.join(', '));
      return false;
    }
    return true;
  }

  function initValidation() {
    if (!ensureDeps() || typeof $.fn.validate !== 'function') return;

    $('#template_data_save').validate({
      errorPlacement: function (error, element) {
        const $formGroup = $(element).parents('.form-group');
        const $nextLabel = $formGroup.next('label');
        if ($nextLabel.hasClass('error')) $nextLabel.remove();
        $formGroup.after($(error)[0].outerHTML);
      },
      success: function (label, element) {
        label.parent().removeClass('error');
        $(element).parents('.form-group').next('label').remove();
      }
    });

    $('#detailed_property_template_data_save').validate({
      errorPlacement: function (error, element) {
        const $formGroup = $(element).parents('.form-group');
        const $nextLabel = $formGroup.next('label');
        if ($nextLabel.hasClass('error')) $nextLabel.remove();
        $formGroup.after($(error)[0].outerHTML);
      },
      success: function (label, element) {
        label.parent().removeClass('error');
        $(element).parents('.form-group').next('label').remove();
      }
    });
  }

  let categorySortable = null;
  let itemSortables = [];

  function initializeCategorySortable() {
    if (!ensureDeps()) return;
    if (categorySortable) categorySortable.destroy();

    const container = document.getElementById('categories-container');
    if (container) {
      categorySortable = Sortable.create(container, {
        animation: 150,
        handle: 'h2',
        ghostClass: 'sortable-ghost'
      });
    }
  }

  function initializeItemSortable() {
    if (!ensureDeps()) return;

    itemSortables.forEach((sortable) => sortable.destroy());
    itemSortables = [];

    document.querySelectorAll('.category-div').forEach((category) => {
      const row = category.querySelector('.row.gx-3');
      if (!row) return;

      const sortable = Sortable.create(row, {
        animation: 150,
        handle: '.item-div',
        filter: '.add-new-item-div',
        draggable: '.item-div',
        ghostClass: 'sortable-ghost',
        onEnd: function () {
          const updatedItems = row.querySelectorAll('.item-div');
          updatedItems.forEach((item, index) => {
            const inputs = item.querySelectorAll('input');
            inputs.forEach((input) => {
              if (input.name.includes('[key]')) {
                input.name = input.name.replace(/\[data]\[\d+]\[key]/, `[data][${index}][key]`);
              }
              if (input.name.includes('[hint]')) {
                input.name = input.name.replace(/\[data]\[\d+]\[hint]/, `[data][${index}][hint]`);
              }
            });
          });
        }
      });

      itemSortables.push(sortable);
    });
  }

  ns.addNewDetailedPropertyItem = function addNewDetailedPropertyItem(categoryClass) {
    const container = document.querySelector('.light-gray-div.' + categoryClass);
    if (!container) return;

    const rows = container.querySelectorAll('.item-div');
    const newIndex = rows.length;

    let newItem;

    if (rows.length === 0) {
      const header = container.querySelector('.dragable-h2');
      const rawCategoryKey = header ? header.textContent.trim() : '';

      newItem = document.createElement('div');
      newItem.className = 'col-12 col-md-2 item-div';
      newItem.innerHTML = `
        <div class="label-div">
          <div class="form-group mb-0">
            <span class="d-flex align-items-center justify-content-between">
              <label class="w-100 dragable-h2">
                <i class="bi bi-arrows-move me-2"></i><span>Label:</span>
              </label>
              <button type="button" class="delete-div float-end px-2" title="Delete" onclick="BK.TemplateManagement.removeDetailedPropertyItem(this, '${categoryClass}')">
                <i class="bi bi-trash3"></i>
              </button>
            </span>
            <input type="text" class="form-control required" placeholder="Label:" name="${rawCategoryKey}[data][${newIndex}][key]" value="">
            <small class="text-c-blue hint">Add Description<i class="bi bi-plus-square hide-data ml-2"></i></small>
          </div>
        </div>
        <div class="label-div hint-div hide-data">
          <div class="form-group mb-0">
            <label class="">Description:</label>
            <input type="text" class="form-control" placeholder="Description:" name="${rawCategoryKey}[data][${newIndex}][hint]" value="">
          </div>
        </div>
      `;
    } else {
      const lastItem = rows[rows.length - 1];
      const clone = lastItem.cloneNode(true);
      const inputs = clone.querySelectorAll('input');

      inputs.forEach((input) => {
        if (input.name.includes('[key]')) {
          input.name = input.name.replace(/\[data]\[\d+]\[key]/, `[data][${newIndex}][key]`);
          input.value = '';
        }
        if (input.name.includes('[hint]')) {
          input.name = input.name.replace(/\[data]\[\d+]\[hint]/, `[data][${newIndex}][hint]`);
          input.value = '';
        }
      });

      const hintText = clone.querySelector('.hint');
      if (hintText) {
        hintText.innerHTML = 'Add Description<i class="bi bi-plus-square hide-data ml-2"></i>';
        hintText.classList.remove('hide-data');
      }

      const hintDiv = clone.querySelector('.hint-div');
      if (hintDiv) {
        hintDiv.classList.add('hide-data');
      }

      newItem = clone;
    }

    const addBtnDiv = container.querySelector('.add-new-item-div');
    if (addBtnDiv) {
      addBtnDiv.parentNode.insertBefore(newItem, addBtnDiv);
    }
  };

  ns.removeDetailedPropertyItem = function removeDetailedPropertyItem(button, categoryClass) {
    const itemDiv = button.closest('.item-div');
    const container = itemDiv.closest('.' + categoryClass);
    const allItems = container.querySelectorAll('.item-div');

    if (allItems.length <= 1) {
      if (typeof $ !== 'undefined' && $.systemMessage) {
        $.systemMessage('At least one item is required.', 'alert--danger', true);
      }
      return;
    }

    itemDiv.remove();

    const updatedItems = container.querySelectorAll('.item-div');
    updatedItems.forEach((item, index) => {
      const inputs = item.querySelectorAll('input');
      inputs.forEach((input) => {
        if (input.name.includes('[key]')) {
          input.name = input.name.replace(/\[data]\[\d+]\[key]/, `[data][${index}][key]`);
        }
        if (input.name.includes('[hint]')) {
          input.name = input.name.replace(/\[data]\[\d+]\[hint]/, `[data][${index}][hint]`);
        }
      });
    });
  };

  ns.addNewDetailedPropertyCategory = function addNewDetailedPropertyCategory() {
    const allCategories = document.querySelectorAll('.category-div');
    const newIndex = allCategories.length;

    const lastCategory = allCategories[allCategories.length - 1];
    if (!lastCategory) return;
    const clone = lastCategory.cloneNode(true);

    const newCategoryKey = `Category_${Date.now()}`;
    const newCategoryClass = `category-div-no-${newIndex}`;

    clone.className = `light-gray-div category-div ${newCategoryClass}`;

    const header = clone.querySelector('h2');
    if (header) header.textContent = `New Category`;

    const categoryInput = clone.querySelector('input[name$="[category]"]');
    if (categoryInput) {
      categoryInput.name = `${newCategoryKey}[category]`;
      categoryInput.value = '';
    }

    const itemDivs = clone.querySelectorAll('.item-div');
    itemDivs.forEach((div, index) => {
      if (index > 0) div.remove();
    });

    const firstItem = clone.querySelector('.item-div');
    if (firstItem) {
      const inputs = firstItem.querySelectorAll('input');
      inputs.forEach((input) => {
        if (input.name.includes('[key]')) {
          input.name = `${newCategoryKey}[data][0][key]`;
          input.value = '';
        }
        if (input.name.includes('[hint]')) {
          input.name = `${newCategoryKey}[data][0][hint]`;
          input.value = '';
        }
      });

      const hintText = firstItem.querySelector('.hint');
      if (hintText) {
        hintText.innerHTML = 'Add Description<i class="bi bi-plus-square ml-2"></i>';
        hintText.classList.remove('hide-data');
      }
      const hintDiv = firstItem.querySelector('.hint-div');
      if (hintDiv) {
        hintDiv.classList.add('hide-data');
      }
    }

    const addItemBtn = clone.querySelector('.add-new-item-div button');
    if (addItemBtn) {
      addItemBtn.setAttribute('onClick', `BK.TemplateManagement.addNewDetailedPropertyItem('${newCategoryClass}')`);
    }

    const deleteCatBtn = clone.querySelector('button.template.delete-div');
    if (deleteCatBtn) {
      deleteCatBtn.setAttribute('onclick', `BK.TemplateManagement.removeDetailedPropertyCategory('${newCategoryClass}')`);
    }

    const itemDeleteBtn = clone.querySelector('.item-div .delete-div');
    if (itemDeleteBtn) {
      itemDeleteBtn.setAttribute('onclick', `BK.TemplateManagement.removeDetailedPropertyItem(this, '${newCategoryClass}')`);
    }

    const addCategoryBtn = document.querySelector('.add-more-div-bottom');
    if (addCategoryBtn && addCategoryBtn.parentNode) {
      addCategoryBtn.parentNode.insertBefore(clone, addCategoryBtn);
    }

    const container = document.getElementById('categories-container');
    if (container) {
      container.appendChild(clone);
    }

    initializeCategorySortable();
    initializeItemSortable();
  };

  ns.removeDetailedPropertyCategory = function removeDetailedPropertyCategory(categoryClass) {
    const categoryDiv = document.querySelector(`.${categoryClass}`);
    if (!categoryDiv) return;

    const allCategories = document.querySelectorAll('.category-div');
    if (allCategories.length <= 1) {
      if (typeof $ !== 'undefined' && $.systemMessage) {
        $.systemMessage('At least one category is required.', 'alert--danger', true);
      }
      return;
    }

    categoryDiv.remove();
  };

  function bindHintToggle() {
    document.addEventListener('click', function (e) {
      const hintEl = e.target.closest('.hint');
      if (!hintEl) return;
      const parentCol = hintEl.closest('.col-md-2');
      if (!parentCol) return;
      const hintDiv = parentCol.querySelector('.hint-div');
      if (hintDiv) {
        hintDiv.classList.remove('hide-data');
        hintEl.classList.add('hide-data');
      }
    });
  }

  window.addNewDetailedPropertyItem = ns.addNewDetailedPropertyItem;
  window.removeDetailedPropertyItem = ns.removeDetailedPropertyItem;
  window.addNewDetailedPropertyCategory = ns.addNewDetailedPropertyCategory;
  window.removeDetailedPropertyCategory = ns.removeDetailedPropertyCategory;

  document.addEventListener('DOMContentLoaded', function () {
    initValidation();
    bindHintToggle();
    initializeCategorySortable();
    initializeItemSortable();
  });
})(window, document);

