"use strict";

( function () {
    function validator( elem, regexp, titleEmpty, titleError ) {
        var value = elem.val();
        elem.tooltip( 'dispose' );
        if ( value.length === 0 ) {
            elem.addClass( 'denied' );
            elem.removeClass( 'granted' );
            elem.tooltip( {
                trigger: 'manual',
                placement: 'right',
                title: titleEmpty
            } ).tooltip( 'show' );
            return false;
        }
        if ( regexp.test( value ) ) {
            elem.addClass( 'granted' );
            elem.removeClass( 'denied' );
            elem.tooltip( 'dispose' );
            return true;
        } else {
            elem.addClass( 'denied' );
            elem.removeClass( 'granted' );
            elem.tooltip( {
                trigger: 'manual',
                placement: 'right',
                title: titleError
            } ).tooltip( 'show' );
            return false;
        }
    }

    var name = $( "#name" ),
        email = $( "#email" ),
        form = $( "#form" );
    var app = {
        initialize: function () {
            this.setUpListeners();
        },
        setUpListeners: function () {
            form.on( 'submit', app.submitForm );
            form.on( 'keydown', '.has-error', app.removeError );
            email.on( 'blur', app.requestEmail );
        },
        submitForm: function ( e ) {
            //e.preventDefault();
            var form = $( 'form' ),
                submitBtn = form.find( 'input[type="submit"]' );

            // если валидация не проходит - то дальше не идём
            if ( app.checkValidate() === false ) return false;
            // против повторного нажатия
            submitBtn.attr( {
                disabled: 'disabled'
            } );
        },
        checkValidate: function () {
            if ( app.validateName() === false ) return false;
            if ( app.validateEmail() === false ) return false;
            if( app.checkRegion() === false ) return false;
            if( app.checkCity() === false ) return false;
            if( app.checkDistrict() === false ) return false;
        },
        requestEmail: function () {
            if ( app.validateEmail() === false ) return false;
            $.ajax( {
                type: 'GET',
                url: 'controll\/controller.php',
                data: { email: email.val() },
                dataType: 'json',
                success: function ( data ) {
                    console.log( data.link );
                    if( data.link === 'false' ){
                        return false;
                    }else{
                        location.href = data.link;
                    }
                }
            } );
            return false;
        },
        checkRegion: function(){
            var regionValue = $("#region_chosen").find(".chosen-single span").html();
            if( regionValue !== 'Выберите область' ){
                $("#region").find('option').first().attr('value', regionValue).attr('selected');
                return true;
            }else{
                return false;
            }
        },
        checkCity: function(){
            var cityValue = $("#city_chosen").find(".chosen-single span").html();
            if( cityValue !== 'Выберите город' ){
                $("#city").find('option').first().attr('value', cityValue ).attr('selected');
                return true;
            }else{
                return false;
            }
        },
        checkDistrict: function(){
            var districtValue = $("#district_chosen").find(".chosen-single span").html();
            if( districtValue !== 'Выберите район' ){
                $("#district").find('option').first().attr('value', districtValue ).attr('selected');
                return true;
            }else{
                return false;
            }
        },
        validateName: function () {
            var regexp = /^([A-ZА-ЯЁ]{1}[a-zA-Zа-яёА-ЯЁ]+\s?){2,3}$/;
            return validator( name, regexp, 'Введите ФИО', 'Неправильно введено ФИО' );
        },
        validateEmail: function () {
            var regexp = /^([a-z0-9_-]{1,15}\.){0,3}[a-z0-9_-]{1,15}@[a-z0-9_-]{1,15}\.[a-z]{2,6}$/u;
            return validator( email, regexp, 'Введите email', 'Неправильно введен email' );
        },
        removeError: function () {
            $( this ).removeClass( 'has-error' ).find( 'input' ).tooltip( 'destroy' );
        }
    }
    app.initialize();
}());

$(document).ready( function () {
    $(".city").hide();
    $(".district").hide();
    var $region = '';
    $("#region").chosen({width: "100%"}).change( function () {
        $("#region_chosen .chosen-results").find(".result-selected").click( function () {
            $region = $(this).context.innerHTML;
            $.ajax( {
                type: 'GET',
                url: 'controll\/controller.php',
                data: { region: $(this).context.innerHTML },
                dataType: 'json',
                success: function ( city ) {
                    var $select = document.getElementById('city'),
                        $option;
                    $(".city").slideDown();
                    $select.innerHTML = '';
                    for( var i=0; i < city.length; i++){
                        $option = document.createElement('option');
                        $option.textContent = (city[i].ter_name);
                        $select.append($option);
                    }
                    $("#city").trigger("chosen:updated");
                }
            } );
            $.ajax( {
                type: 'GET',
                url: 'controll\/controller.php',
                data: { district: $region },
                dataType: 'json',
                success: function ( district ) {
                    var $select = document.getElementById('district'),
                        $option;
                    $select.innerHTML = '';
                    for( var i=0; i < district.length; i++){
                        $option = document.createElement('option');
                        $option.textContent = (district[i].ter_name);
                        $select.append($option);
                    }
                    $("#district").trigger("chosen:updated");
                }
            } );
        });
    });
    $("#city").chosen({width: "100%"}).change( function () {
        $("#city_chosen .chosen-results").find("li").click( function () {
            $(".district").slideDown();
            $.ajax( {
                type: 'GET',
                url: 'controll\/controller.php',
                data: { district: $region },
                dataType: 'json',
                success: function ( district ) {
                    var $select = document.getElementById('district'),
                        $option;
                    $(".district").slideDown();
                    $select.innerHTML = '';
                    for( var i=0; i < district.length; i++){
                        $option = document.createElement('option');
                        $option.textContent = (district[i].ter_name);
                        $select.append($option);
                    }
                    $("#district").trigger("chosen:updated");
                }
            } );
        });
    });
    $("#district").chosen({width: "100%"});
});

