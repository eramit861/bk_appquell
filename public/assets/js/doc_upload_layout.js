// Document Upload Layout JavaScript Functions

openPopup = function(divclass) {
    var htmldiv = $("." + divclass).html();
    var html =
        '<div class="sign_up_bgs"><div class="container-fluid"><div class="row py-0 page-flex"><div class="col-md-12"><div class="form_colm row py-3 px-2"><div class="col-md-12 mb-3"><div class="title-h mt-1 d-flex"><h4><strong>Information: </strong></h4></div></div><div class="col-md-12 main-div"><div class="row"><div class="col-md-12"><div class="align-left">' +
        htmldiv + '</div></div></div></div></div></div></div></div></div>';
    laws.updateFaceboxContent(html, 'productQuickView quickinfor');
}
