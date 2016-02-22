var ValidateInputFormWithParsley = {
    validate: function(selectorInputsForm) {
        var messagesError = "";
        for (var i = 0; i < selectorInputsForm.length; i++) {
            if ($(selectorInputsForm[i]).parsley().isValid()) {
                //alert("2 " + $(selectorInputsForm[i]).parent().prop('tagName'));
                if ($(selectorInputsForm[i]).parent().prop('tagName') == "DIV") {
                    $(selectorInputsForm[i]).parent().removeClass("has-error");
                } else {
                    $(selectorInputsForm[i]).parent().removeClass("border-input-error");
                }
            } else {
                //alert("1 " + $(selectorInputsForm[i]).parent().is("div"));
                if ($(selectorInputsForm[i]).parent().prop('tagName') == "DIV") {
                    $(selectorInputsForm[i]).parent().addClass("has-error");
                } else {
                    $(selectorInputsForm[i]).parent().addClass("border-input-error");
                }
                messagesError += "<li>" + ParsleyUI.getErrorsMessages($(selectorInputsForm[i]).parsley()) + "</li>";
            }
        }
        if (messagesError.length > 0) {
            GenericModal.show("danger", "<ul>" + messagesError + "</ul>");
            return false;
        }
        return true;
    }
};
