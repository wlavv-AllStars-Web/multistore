/**
 * 2014-2018 Web Development VIZO
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Academic Free License (AFL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/afl-3.0.php
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@prestashop.com so we can send you a copy immediately.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade PrestaShop to newer
 * versions in the future. If you wish to customize PrestaShop for your
 * needs please refer to http://www.webvizo.com for more information.
 *
 *  @author    Web Development VIZO <support@webvizo.com>
 *  @copyright 2014-2018 Web Development VIZO
 *  @license   http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
 *  International Registered Trademark & Property of Web Development VIZO
 */

$(document).ready(function () {
    init_ups();
});

function init_ups() {
    window.current_template_name = "_preview_information";

    $("#upsTabContent #expand_" + module_prefix).click(function () {
        if ($('#hide_show_' + module_prefix).html() == '[-]') {
            $('#hide_show_' + module_prefix).html('[+]');
            $(this).parent().css('height', '40px');
        } else {
            $(this).parent().css('height', 'auto');
            $('#hide_show_' + module_prefix).html('[-]');
        }
    });

    $("#upsTabContent button[id='load_settings_form']").click(function () {
        $(this).attr('disabled', 'disabled');
        $(this).children('span').html(processing);
        $(this).children('i').removeClass('fa fa-edit').addClass('fa fa-spinner fa-spin');

        load_settings_form($(this).data('template'));
    });

    $("#upsTabContent button[id='reset_settings']").click(function () {
        if (!confirm(reset_settings_confirmation)) {
            return;
        }

        $(this).attr('disabled', 'disabled');
        $(this).children('span').html(processing);
        $(this).children('i').removeClass('fa fa-reply-all').addClass('fa fa-spinner fa-spin');

        reset_settings($(this).data('setting'), $(this).data('template'));
    });

    $("#upsTabContent button[id='update_information']").click(function () {
        $(this).attr('disabled', 'disabled');
        $(this).children('span').html(processing);
        $(this).children('i').removeClass('fa fa-edit').addClass('fa fa-spinner fa-spin');
        // console.log($(this).attr('rel'));
        save_settings($(this).attr('rel'));
    });

    $("#upsTabContent input[rel='products_in_package']").blur(function () {
        save_settings('package_information', '_packages_information_form');
    });

    $('.nav-item-estimated #estime_postage').click(function () {
        get_postage();
    }).trigger('click');

    $('#upsTabContent #generate_shipping_label').click(function () {
        if ($('#upsTabContent div[id="generated_shipping_labels"]').html() != "") {
            if (!confirm(overwrite_labels)) {
                return;
            }
        }

        $(this).html('<i class="fa fa-spinner fa-spin" style="font-size: 40px;"></i><br><span style="font-size: 18px;">Processing</span>').attr("disabled", "disabled");

        // console.log(ajax_functions_url)
        generate_shipping_label();
    });

    $('#upsTabContent #void_shipping_label').click(function () {
        if (!confirm(confirm_voiding_shipment)) {
            return;
        }

        $(this).html('<i class="fa fa-spinner fa-spin" style="font-size: 40px;"></i><br><span style="font-size: 18px;">Processing</span>').attr("disabled", "disabled");

        void_shipping_label();
    });

    /** PANEL - RECEIPENT INFORMATION */
    $('#upsTabContent #' + module_prefix_upper + '_RECIPIENT_COUNTRY').change(function () {
        $('#upsTabContent #' + module_prefix_upper + '_RECIPIENT_STATE').html('<option>' + loading_options + '</option>').addClass('disabled');
        load_country_states($(this).val(), $('#upsTabContent #' + module_prefix_upper + '_RECIPIENT_STATE'));
    });

    /** PANEL - PACKAGES INFORMATION */
    $('#upsTabContent #' + module_prefix_upper + '_PACKAGE_TYPE').change(function () {
        var dimensions = $('#' + module_prefix_upper + '_PACKAGE_TYPE option:selected').attr('rel');
        dimensions = dimensions.split('_');

        $('#upsTabContent #' + module_prefix_upper + '_PACKAGE_WIDTH').val(dimensions[0]);
        $('#upsTabContent #' + module_prefix_upper + '_PACKAGE_HEIGHT').val(dimensions[1]);
        $('#upsTabContent #' + module_prefix_upper + '_PACKAGE_DEPTH').val(dimensions[2]);

        if ($('#upsTabContent #' + module_prefix_upper + '_PACKAGE_TYPE').val() != 'Package' && $('#' + module_prefix_upper + '_PACKAGE_TYPE').val() != 'Envelope') {
            $('#upsTabContent #' + module_prefix_upper + '_PACKAGE_WIDTH, #' + module_prefix_upper + '_PACKAGE_HEIGHT, #' + module_prefix_upper + '_PACKAGE_DEPTH').attr('readonly', 'readonly');
        } else {
            $('#upsTabContent #' + module_prefix_upper + '_PACKAGE_WIDTH, #' + module_prefix_upper + '_PACKAGE_HEIGHT, #' + module_prefix_upper + '_PACKAGE_DEPTH').removeAttr('readonly');
        }
    }).trigger('change');

    $('#upsTabContent select[rel=packageType]').change(function () {
        var elementID = $(this).attr('id');
        var dimensions = $('#' + elementID + ' option:selected').attr('rel');
        dimensions = dimensions.split('_');
        packageID = elementID.split('_');
        packageID = packageID[3];

        $('#upsTabContent #' + module_prefix_upper + '_PACKAGE_WIDTH_' + packageID).val(dimensions[0]);
        $('#upsTabContent #' + module_prefix_upper + '_PACKAGE_HEIGHT_' + packageID).val(dimensions[1]);
        $('#upsTabContent #' + module_prefix_upper + '_PACKAGE_DEPTH_' + packageID).val(dimensions[2]);

        if ($('#upsTabContent #' + elementID).val() != 'Package' && $('#upsTabContent #' + elementID).val() != 'Envelope') {
            $('#upsTabContent #' + module_prefix_upper + '_PACKAGE_WIDTH_' + packageID + ', #' + module_prefix_upper + '_PACKAGE_HEIGHT_' + packageID + ', #' + module_prefix_upper + '_PACKAGE_DEPTH_' + packageID).attr('readonly', 'readonly');
        } else {
            $('#upsTabContent #' + module_prefix_upper + '_PACKAGE_WIDTH_' + packageID + ', #' + module_prefix_upper + '_PACKAGE_HEIGHT_' + packageID + ', #' + module_prefix_upper + '_PACKAGE_DEPTH_' + packageID).removeAttr('readonly');
        }
    });

    $('button[id=add_pack]').click(function () {
        $(this).attr('disabled', 'disabled').html('<i class="fa fa-spinner fa-spin"></i> <span>In<br>Process</span>');
        save_settings('package_information_insert', '_packages_information_form');
    });

    $('#upsTabContent button[rel=delete_pack]').click(function () {
        var elementID = $(this).attr('id');
        packageID = elementID.split('_');
        packageID = packageID[2];
        
        $(this).attr('disabled', 'disabled').html('<i class="fa fa-spinner fa-spin"></i>');
        
        $('#upsTabContent #Package_' + packageID + ', #' + module_prefix_upper + '_PACKAGE_' + packageID + '_HEAD').remove();

        /**
        setTimeout(function () {
            $('#Package_' + packageID + ', #' + module_prefix_upper + '_PACKAGE_' + packageID + '_HEAD').remove();
            
            $('#update_information').trigger('click');
            alert(444);
        }, 500);**/
        
    });

    /** PANEL - GLOBAL SETTINGS */
    $('#upsTabContent #' + module_prefix_upper + '_SETTINGS_INCLUDE_RETURN').change(function () {
        if ($(this).val() > 0) {
            $('#upsTabContent #' + module_prefix_upper + '_SETTINGS_RETURN_OPTIONS').fadeIn();
        } else {
            $('#upsTabContent #' + module_prefix_upper + '_SETTINGS_RETURN_OPTIONS').fadeOut();
        }
    });

    $('#upsTabContent #' + module_prefix_upper + '_SETTINGS_RETURN_OPTION').change(function () {
        if ($(this).val() === 'OTHER') {
            $('#upsTabContent #' + module_prefix_upper + '_SETTINGS_RETURN_OPTION_OTH').fadeIn();
        } else {
            $('#upsTabContent #' + module_prefix_upper + '_SETTINGS_RETURN_OPTION_OTH').fadeOut();
        }
    });

    /** PANEL - DOMESTIC SETTINGS */
    $('#upsTabContent #' + module_prefix_upper + '_SETTINGS_DATEOFSHIPMENT').datepicker({
        dateFormat: 'mm/dd/yy',
        minDate: 0,
        maxDate: '+9D',
        showButtonPanel: true,
        showWeek: true,
        showAnim: 'slideDown'
    });

    /** PANEL - INTERNATIONAL SETTINGS */
    $('#upsTabContent #' + module_prefix_upper + '_SETTINGS_CONTENTTYPE').change(function () {
        $('#upsTabContent #CONTENTTYPEOTHER').fadeOut();

        if ($(this).val() == 'Other') {
            $('#upsTabContent #CONTENTTYPEOTHER').fadeIn();
        }
    });

    $('#upsTabContent #' + module_prefix_upper + '_SETTINGS_NONDELIVERYOPTION').change(function () {
        $('#upsTabContent #NONDEVELIVERYOPTIONREDIRECTOPTIONS').fadeOut();

        if ($(this).val() == 'Redirect') {
            $('#upsTabContent #NONDEVELIVERYOPTIONREDIRECTOPTIONS').fadeIn();
        }
    });

    $('#upsTabContent #' + module_prefix_upper + '_SETTINGS_ALTCOUNTRY').change(function () {
        $('#upsTabContent #' + module_prefix_upper + '_SETTINGS_ALTSTATE').html('<option>' + loading_options + '</option>').addClass('disabled');
        load_country_states($(this).val(), $('#' + module_prefix_upper + '_SETTINGS_ALTSTATE'));
    });

    load_order_generated_shipping_labels();
}

function load_order_generated_shipping_labels() {
    $.ajax({
        type: "GET",
        url: ajax_functions_url,
        async: true,
        cache: false,
        data: {
            'action': 'load_order_generated_shipping_labels',
            'id_order': id_order
        },
        success: function (html) {
            if (html.length > 1) {
                $('#upsTabContent div[id="generated_shipping_labels"]').hide().html(html).fadeIn();

                $('#upsTabContent #delete_shipping_label').click(function () {
                    if ($('#upsTabContent div[id="generated_shipping_labels"]').html() == "" || !confirm(delete_shipping_labels)) {
                        return;
                    }

                    $(this).html('<i class="fa fa-spinner fa-spin"></i>In<br>Process').attr("disabled", "disabled");

                    delete_shipping_label();
                });

                $("#upsTabContent a[class='previousLabelsFancy']").fancybox({
                    fitToView: true,
                    width: '85%',
                    height: '85%',
                    autoSize: true,
                    helpers: {
                        title: {
                            type: 'float'
                        }
                    },
                    type: 'iframe',
                    iframe: {
                        preload: false
                    }
                });
            } else {
                $('#upsTabContent div[id="generated_shipping_labels"]').html("").fadeOut();
            }
        }
    });
}

function load_settings_form(template_name, message, type) {
    if (message === undefined || type === undefined) {
        message = '';
        type = '';
    }

    $.ajax({
        type: "GET",
        url: ajax_functions_url,
        async: true,
        cache: false,
        data: {
            'action': 'load_settings_form',
            'template_name': template_name,
            'id_order': id_order,
            'text': message,
            'type': type,
        },
        success: function (html) {
            if (html.length > 1) {
                $('#upsTabContent #formContent').hide().html(html).fadeIn();
                init_ups();
                window.current_template_name = template_name;
            }
        }
    });
}

function save_settings(settings_column, template_name) {
    if (template_name === undefined) {
        template_name = "_preview_information";
    }

    var form_data = $("#upsTabContent .webvizo:first-of-type #generate_ups_shipping_label_form").serialize() + "&id_order=" + id_order + "&settings_column=" + settings_column + "&action=save_settings";
    $.ajax({
        type: "POST",
        url: ajax_functions_url,
        async: true,
        cache: false,
        data: form_data,
        success: function (html) {
            var message = saving_settings_success;
            var type = 'success';
            if (html != "Saved") {
                message = saving_settings_failed;
                type = 'error';
                if (html != "Failed") {
                    message = html;
                }

                template_name = window.current_template_name;
            }
            
            load_settings_form(template_name, message, type);
        }
    });
}

function reset_settings(settings_column, template_name) {
    if (template_name === undefined) {
        template_name = "_preview_information";
    }

    var form_data = "id_order=" + id_order + "&settings_column=" + settings_column + "&action=reset_settings";
    $.ajax({
        type: "POST",
        url: ajax_functions_url,
        async: true,
        cache: false,
        data: form_data,
        success: function (html) {
            var message = resetting_settings_success;
            var type = 'success';
            if (html != "Saved") {
                message = resetting_settings_failed;
                type = 'error';
            }

            load_settings_form(template_name, resetting_settings_success, type);
        }
    });
}

function load_country_states(country_iso, output_select) {
    $.ajax({
        type: "GET",
        url: ajax_functions_url,
        async: true,
        cache: false,
        data: {
            'action': 'load_country_states',
            'country_iso': country_iso
        },
        success: function (html) {
            if (html.length > 1 && html.indexOf('State not available') == -1) {
                output_select.hide().html(html).removeClass('disabled').fadeIn();
            } else {
                output_select.hide().html(html).addClass('disabled').fadeIn();
            }

            init_ups();
        }
    });
}

function get_postage() {
    $('.nav-item-estimated span[id=postageTotal]').html(calculating_postage);
    $('#upsTabContent  div[id="shipping_label_results"]').html('');

    $.ajax({
        type: "GET",
        url: ajax_functions_url,
        async: true,
        cache: false,
        data: {
            'action': 'get_postage',
            'id_order': id_order
        },
        success: function (result) {
            postage = parseFloat(result);
            if (postage > 0) {
                $('.nav-item-estimated span[id=postageTotal]').html(postage.toFixed(2) + " €");

                if (typeof $("#upsTabContent button[id='void_shipping_label']").attr("disabled") !== 'undefined') {
                    $('#upsTabContent [name=generate_shipping_label]').removeAttr('disabled');
                }
            } else {
                $('.nav-item-estimated span[id=postageTotal]').html(not_available);
                $('#upsTabContent button[name=generate_shipping_label]').attr('disabled', 'disabled');
                if (postage != 0 && postage != -1) {
                    $('#upsTabContent div[id=shipping_label_results]').html(result);
                }
            }
        }
    });
}

function generate_shipping_label() {

    save_settings('label_settings');
    save_settings('shipper_information');
    save_settings('package_information');


    $.ajax({
        type: "POST",
        url: ajax_functions_url,
        async: true,
        cache: false,
        data: {
            'action': 'generate_shipping_label',
            'id_order': id_order,
            'id_employee': id_employee,
        },
        success: function (json) {
            json = $.parseJSON(json);
            
            console.log(json)
            
            if (json.status) {
                
                $('#upsTabContent div.input-group > input.sd_addshippingnumber_tracking_number').val(json.TrackingNumber);
                
                console.log(json.TrackingNumber);
                let estimated = $('#upsTabContent #postageTotal').text();
                estimated = estimated.substring(0, estimated.length - 1);                
                
                $('#upsTabContent #shipping_budget_value').val(estimated);

                load_order_generated_shipping_labels();
                $("#upsTabContent button[id='generate_shipping_label']").html('<i class="fa fa-sign-in" style="font-size: 40px;"></i><br><span style="font-size: 18px;">Generate</span>');
                $("#upsTabContent button[id='void_shipping_label']").removeAttr("disabled");
            } else {
                $("#upsTabContent button[id='generate_shipping_label']").html('<i class="fa fa-sign-in" style="font-size: 40px;"></i><br><span style="font-size: 18px;">Generate</span>').removeAttr("disabled");
            }

            $('#upsTabContent div[id="shipping_label_results"]').html(json.html);
        }
    });
}

function void_shipping_label() {
    $.ajax({
        type: "POST",
        url: ajax_functions_url,
        async: true,
        cache: false,
        data: {
            'action': 'void_shipping_label',
            'id_order': id_order
        },
        success: function (json) {
            json = $.parseJSON(json);

            if (json.status) {
                load_order_generated_shipping_labels();
                $("button[id='void_shipping_label']").html('<i class="fa fa-sign-in" style="font-size: 40px;"></i><br><span style="font-size: 18px;">Void</span>');
                $("button[id='generate_shipping_label']").removeAttr("disabled");
            } else {
                $("button[id='void_shipping_label']").html('<i class="fa fa-sign-in" style="font-size: 40px;"></i><br><span style="font-size: 18px;">Void</span>').removeAttr("disabled");
            }

            $('div[id="shipping_label_results"]').html(json.html);
        }
    });
}

function delete_shipping_label() {
    $.ajax({
        type: "POST",
        url: ajax_functions_url,
        async: true,
        cache: false,
        data: {
            'action': 'delete_shipping_label',
            'id_order': id_order
        },
        success: function (html) {
            load_order_generated_shipping_labels();
            $('#upsTabContent div[id="shipping_label_results"]').html(html);
        }
    });
}
