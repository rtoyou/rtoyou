$(function () {
    $(".skip-contest").click(function () {
        window.location.href='contest/skip';
    });
    $(".participate-contest").click(function () {
        if($(this).data('loginstate') == 1 ){
            window.location.href='contest/participate';
        } else {
	    setCookie('participate','1');
	    setCookie('cid',$(".contestLink").data('targetid'));
            $("button[data-dismiss='modal'].close").trigger('click');
            showMessage('You have to login to participate in this contest.','danger');
           // $(".login a").toggle();
           // $(".login a").attr('aria-expanded',true);

        }
        //document.cookie.set
    });
    $("#post-review")
        .submit(
            function (e) {

		var _haveUnuploadedFiles = $(".file-caption-name").children().length > 0 ? true : false;
		if (($("#review_on").val().length == 0 || $(
                        "#review_on").val().length <= 3)
                    && $('#from_Selected').val().length == 0) {
                    e.preventDefault();
                    $(".twitter-typeahead").addClass('has-error');
                    $(".twitter-typeahead input").focus();
                    return;
                } else if ($("#review").val().trim().length == 0
                    || $("#review").val().length > 5000 || $("#review").val().trim().split(" ").length < 10) {
                    $(".twitter-typeahead").removeClass('has-error');
                    e.preventDefault();
                    $(".review-text").parent().addClass('has-error');
                    $(".review-text").focus();
                    return;
                } /*else if(_haveUnuploadedFiles){
			$(".cnf").trigger("click");
			return;
		} */else {
                    $(".review-text").parent().removeClass('has-error');
                }
                $(this).append(
                    '<input type="hidden" name="images-mul" value="'
                    + escape(JSON.stringify(jsonImages))
                    + '"/>');

            });

    $(".submit-contact").click(function () {
        var _success = true;
        if($("#name").val().length ==0) {
            $("#name").parent().addClass('has-error');
            $("#name").focus();
            _success = false;
        } else {
            $("#name").parent().removeClass('has-error');
        }
        if($("#email").val().length ==0) {
            $("#email").parent().addClass('has-error');
            $("#email").focus();
            _success = false;


        }else {
            var reg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
            if (reg.test($("#email").val()) == false)
            {
                $("#email").parent().addClass('has-error');
                $("#email").focus();
                _success = false;
            }else {
                $("#email").parent().removeClass('has-error');
            }
        }

        if($("#message").val().length ==0) {
            $("#message").parent().addClass('has-error');
            $("#message").focus();
            _success = false;
        }else {
            $("#message").parent().removeClass('has-error');
        }

        if(_success) {
            var _formData = $("#contact-form").serialize();
            var l = Ladda.create(this);
            l.start();
            $.ajax({
                url: 'contact/contactus',
                method: 'POST',
                data: _formData,
                dataType: 'json',
                success: function (data, textStatus, error) {
                    l.stop();
                    if (data.ErrorCode == 0
                        && data.success == "success") {
                        $(".contact-response").removeClass('text-danger').addClass('text-success')
                            .html(data.message);
                        $("#contact-form")[0].reset();
                    } else {
                        $(".contact-response").removeClass('text-success').addClass('text-danger')
                            .html(data.message);
                    }
                },
                error: function (xhr, textStatus, error) {
                    l.stop();
                    $(".contact-response").removeClass('text-success').addClass('text-danger')
                        .html(data.message);
                }
            });
        }
        return _success;
    });

    $(".post-review").click(
        function (event) {
            event.preventDefault();
	    if ($(".review-text").val().trim().length == 0 || $(".review-text").val().length > 5000 || $(".review-text").val().trim().split(" ").length < 10) {
                $(".review-text").parent().addClass('has-error');
                $(".review-text").focus();
		showMessage('Review should be between 0 to 5000 characters and more than 10 words.','danger');
                return;
            } else {
                var l = Ladda.create(this);
                l.start();
                var data1 = $("#post-review").serialize();
                $.ajax({
                    url: 'post/message',
                    method: 'POST',
                    data: data1,
                    dataType: 'json',
                    success: function (data, textStatus, error) {
                        l.stop();
                        if (data.ErrorCode == 0
                            && data.success == "success") {
                            $('.close').trigger('click');
			    showMessage(data.message,'success');
                        } else {
                            $(".review-response").addClass('text-danger')
                                .html(data.message);
                        }
                    },
                    error: function (xhr, textStatus, error) {
                        l.stop();
                        $(".review-response").addClass('text-danger').html(
                            xhr);
                    }
                });
            }
        });
    $(".forgot-pass").click(
        function (event) {
            event.preventDefault();
            if ($("#inputEmail3").val().trim().length == 0) {
                $("#inputEmail3").parent().addClass('has-error');
                $("#inputEmail3").focus();
                return;
            } else {
                var l = Ladda.create(this);
                l.start();
                var data1 = {'email': $("#inputEmail3").val()};
                $.ajax({
                    url: 'index/forgot',
                    method: 'POST',
                    data: data1,
                    dataType: 'json',
                    success: function (data, textStatus, error) {
                        l.stop();
                        if (data.ErrorCode == 0
                            && data.success == "success") {
                            $(".forgot-response").addClass('text-success')
                                .html(data.message);
                            $("#inputEmail3").val('');
                            $("#inputEmail3").parent().removeClass('has-error');
                            $(".forgot-response").html();
                           // $('.close-f').trigger('click');
                        } else {
                            $(".forgot-response").addClass('text-danger')
                                .html(data.message);
                        }
                    },
                    error: function (xhr, textStatus, error) {
                        l.stop();
                        $(".forgot-response").addClass('text-danger').html(
                            xhr);
                    }
                });
            }
        });

    $(".fav").click(
        function (event) {
            event.preventDefault();
            var el = $(this);
            var data1 = {
                'subcat': $(this).data('subcategory'),
                'counter': $('.fav_counter' + $(this).data('subcategory')).text()
            };
            var l = Ladda.create(this);
            l.start();
            $
                .ajax({
                    url: 'review/favorite',
                    method: 'POST',
                    data: data1,
                    dataType: 'json',
                    success: function (data, textStatus, error) {
                        if (data.ErrorCode == 0
                            && data.success == "success") {
                            l.stop();
                            el.removeClass("fav");
                            el.attr("title", "favorited");
                            el.attr("disabled", "disabled");
                            $('.fav_counter' + data1.subcat).html(parseInt(data1.counter) + 1);

                           showMessage(data.message,'success');

                        } else {
                            l.stop();
                            $('.fav_counter' + data1.subcat).html(parseInt(data1.counter));
                            showMessage(data.message,'danger');
                        }
                    },
                    error: function (xhr, textStatus, error) {
                        l.stop();
                        $('.fav_counter' + data1.subcat).html(data1.counter);
                        showMessage(data.message,'danger');
                    }
                });

        });

 $(".send-email").click(
        function (event) {
            event.preventDefault();
            var el = $(this);
            var data1 = {
                'email': $("#missing-email").val()
            };
	    if(data1.email){
            var l = Ladda.create(this);
            l.start();
            $
                .ajax({
                    url: 'index/saveemail',
                    method: 'POST',
                    data: data1,
                    dataType: 'json',
                    success: function (data, textStatus, error) {
                        if (data.ErrorCode == 0
                            && data.success == "success") {
                            l.stop();
			    $("#missingEmailModal").val('');
                            $("#missingEmailModal").modal('hide');
                           showMessage(data.message,'success');

                        } else {
                            l.stop();
                            $(".missing-email-response").addClass('text-danger').html(data.message);
                        }
                    },
                    error: function (xhr, textStatus, error) {
                        l.stop();
                        $(".missing-email-response").addClass('text-danger').html(data.message);
                    }
                });
} else {
	$("#missing-email").focus();
}

        });

    $("#login-form").submit(function (e) {
        if ($("#login-email").val().length == 0) {
            e.preventDefault();
            $("#login-email").parent().addClass('has-error');
            $("#login-email").focus();
            return;
        } else if ($("#login-pass").val().length == 0) {
            e.preventDefault();
            $("#login-email").parent().removeClass('has-error')
            $("#login-pass").parent().addClass('has-error');
            $("#login-pass").focus();
            return;
        }
    });

    $('.close-review').on(
        'hide.bs.modal',
        function () {
            $("#review").val('');
            $(".review-response").removeClass('text-danger').empty();
            $(".review-text").parent().removeClass('has-error');
            $(".char-counter").removeClass('text-danger').addClass(
                'text-info').html('Characters Left : 5000');
        });
    $(".review-text").keyup(
        function () {
            var lengthT = $(this).val().length;
            var charLeft = 5000 - lengthT;
            $(".char-counter").html('Characters Left : ' + charLeft);
            if (charLeft <= 0) {
                $(".char-counter").removeClass('text-info').addClass(
                    'text-danger');
            } else {
                $(".char-counter").removeClass('text-danger').addClass(
                    'text-info');
            }
        });
    $("#registration").submit(function () {
        $("fieldset.slick-cloned").remove();
    });

    $(document).on("click", '.awesome', function(event) {

        var success = false;
        var _this = $(this);
        var id = $(this).attr('data-value');
        if (!id) {
            return success;
        }
        var current = parseInt($(".a_" + parseInt(id) + "_count").text());

        var l = Ladda.create(this);
        l.start();
        var obj = {
            type: 'awesome',
            review: id
        };

        $.ajax({
            url: 'review/state',
            method: 'POST',
            data: obj,
            dataType: 'json',
            success: function (data, textStatus, error) {
                l.stop();
                (data.ErrorCode == 0 && data.success == "success") ? $(".a_" + parseInt(id) + "_count").empty().text(++current) : '';
               
                if(data.ErrorCode == 0) {
                	 _this.append("<i class='fa fa-check'></i>");
                    showMessage(data.message,'success');
                } else {
                    showMessage(data.message,'danger');
                }
            },
            error: function (xhr, textStatus, error) {
                l.stop();
            }
        });
    });
    $(document).on("click", '.bad', function(event) {
var _this = $(this);

        var success = false;
        var id = $(this).attr('data-value');
        if (!id) {
            return success;
        }
        var current = parseInt($(".b_" + id + "_count").text());

        var l = Ladda.create(this);
        l.start();

        var obj = {
            type: 'bad',
            review: id
        };

        $.ajax({
            url: 'review/state',
            method: 'POST',
            data: obj,
            dataType: 'json',
            success: function (data, textStatus, error) {
                l.stop();
                (data.ErrorCode == 0 && data.success == "success") ? $(
                    ".b_" + parseInt(id) + "_count")
                    .text(++current) : "";
                if(data.ErrorCode == 0) {
                	_this.append("<i class='fa fa-check'></i>");
                    showMessage(data.message,'success');
                } else {
                    showMessage(data.message,'danger');
                }
            },
            error: function (xhr, textStatus, error) {
                l.stop();
            }
        });
    });
    });
    $(document).on("click", '.cool', function(event) {
    var _this = $(this);
        var success = false;
    var id = $(this).attr('data-value');
    if (!id) {
        return success;
    }
    var current = parseInt($(".c_" + id + "_count").text());

    var l = Ladda.create(this);
    l.start();
    var obj = {
        type: 'cool',
        review: id
    };

    $.ajax({
        url: 'review/state',
        method: 'POST',
        data: obj,
        dataType: 'json',
        success: function (data, textStatus, error) {
            l.stop();
            (data.ErrorCode == 0 && data.success == "success") ? $(
                ".c_" + parseInt(id) + "_count")
                .text(++current) : "";

            if(data.ErrorCode == 0) {
            _this.append("<i class='fa fa-check'></i>");
                showMessage(data.message,'success');
            } else {
                showMessage(data.message,'danger');
            }
        },
        error: function (xhr, textStatus, error) {
            l.stop();
        }
    });
});
function showMessage(message,type) {
    $('div[data-notify="container"]').hide();
    $.notify({
        icon: 'glyphicon glyphicon-star',
        message: message
    },{

        placement : {
            align : 'center',
        },
        delay : 2000,
        type:  type,
        animate: {
            enter: 'animated rollIn',
            exit: 'animated rollOut'
        }
    });
    $('div[data-notify="container"]').css('top',20);
    $('div[data-notify="container"]').css('z-index',99999999);
}

function submitResetPassForm(){
	var _form = document.forms['resetpass_form'];
	var _password = $("#resetpass_form input[name='newpassword']").val();
	var _cnf = $("#resetpass_form input[name='confirm']").val();
	if(_password.length == 0 || _password.length <= 6) {
		showMessage('Password must be at least seven characters long..', 'danger');
	} else if(_cnf.trim().length == 0 || _cnf.trim().length <= 6) {
		showMessage('Confirm Password must be at least seven characters long..', 'danger');
	} else if (_cnf !== _password) {
		showMessage('Your password and confirm password not matched..', 'danger');
        } else {
	   _form.submit();
	   return true;
        }
	
	return false;
	
}

function setCookie(name,value,ttl) {
	if(!ttl) {
		ttl =24;
 	}
	var d = new Date();
	d.setTime(d.getTime() + (ttl*24*60*60*1000));
	var expires= "expires="+d.toUTCString();
	document.cookie=name+"="+value+";"+expires+";"+";path=/";
}

function deleteCookie(name){
	var d = new Date();
	d.setTime(d.getTime() - (1*24*60*60*1000));
	var expires= "expires="+d.toUTCString();
	document.cookie=name+"="+name+";"+expires+";"+";path=/";
}

 function dobValidate() {


        var today = new Date();
        var nowyear = today.getFullYear();
        var nowmonth = today.getMonth() + 1;
        var nowday = today.getDate();
        var b = document.getElementById('bday').value;

        if (b == "" || !b) {
            return true;
        }


        var birth = new Date(b);

        var birthyear = birth.getFullYear();
        var birthmonth = birth.getMonth() + 1;
        var birthday = birth.getDate();

        var age = nowyear - birthyear;
        var age_month = nowmonth - birthmonth;
        var age_day = nowday - birthday;


        if (age > 100) {
            showMessage("Age cannot be more than 100 Years.Please enter correct age", 'danger')
            return false;
        }
        if (age_month < 0 || (age_month == 0 && age_day < 0)) {
            age = parseInt(age) - 1;


        }
        if ((age == 13 && age_month <= 0 && age_day <= 0) || age < 13) {
            showMessage("Age should be more than 13 years.Please enter a valid Date of Birth", 'danger');
            return false;
        }
        return true;
    }
 function urlValidate(url) {
        if (!url || url.length == 0) {
            return true;
        }
        var regexp = /(ftp|http|https):\/\/(\w+:{0,1}\w*@)?(\S+)(:[0-9]+)?(\/|\/([\w#!:.?+=&%@!\-\/]))?/;
        return regexp.test(url);
    }

    function numberValidate(number) {
        if (!number || number.length == 0) {
            return true;
        }
        var phoneno = /^\(?([0-9]{3})\)?[-. ]?([0-9]{3})[-. ]?([0-9]{4})$/;
        if (number.match(phoneno)) {
            return true;
        }
        else {

            return false;
        }
    }

   
