// Login Page JavaScript

$(function() {
    // Check if logourl is provided and hide the left section
    if (window.__loginData.logourl != '') {
        $(".page-flex__left").addClass('hide-data');
    }
});
