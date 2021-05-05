function acceptTerms() {
    $('.termsAndConditions').each(function () {
        this.checked = true;
    });
}

function denyTerms() {
    $('.termsAndConditions').each(function () {
        this.checked = false;
    });
}

function fetchDataTerms() {

	$('#agree').each(function () {
		if(this.checked) {
			return true; 
		} else {
			swal({
			  title: "Formulário não poderá ser enviado.",
			  text: "Por favor, indique que leu e concorda com os Termos e condições.",
			  icon: "warning",
			});
		return false; 
		}
    });
}

function deleteConfirm() {
   	let confirm = confirm("???");

    if(confirm == true) {
        return true;
    }
    else
    {
        return false;
    }
}