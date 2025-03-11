/**
 * 2014-2024 Web VIZO LLC
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
 * Do not edit or add to this file if you wish to upgrade the module to newer
 * versions in the future. If you wish to customize the module for your
 * needs please refer to https://www.webvizo.com (support@webvizo.com) for
 * more information.
 *
 *  @author    Web VIZO LLC <support@webvizo.com>
 *  @copyright 2014-2024 Web VIZO LLC
 *  @license   http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
 *  International Registered Trademark & Property of Web VIZO LLC
 */

// const { init } = require("browser-sync");

function addListenerToElement(elements, type, callback, trigger) {

    if (trigger === undefined) {
        trigger = false;
    }

    if (elements.length === 0) {
        return true;
    }

    for (var i = 0; i < elements.length; i++) {
        var element = elements[i];
        if (element == null) {
            return false;
        }

        element.addEventListener(type, callback);
        if (trigger === true) {
            if ('createEvent' in document) {
                var evt = document.createEvent('HTMLEvents');
                evt.initEvent(type, false, true);

                element.dispatchEvent(evt);
            } else {
                element.fireEvent('on' + type);
            }
        }
    }

    return true;
}

function init_ups() {
// alert('init_ups');
//     console.log('init_ups');
    document.body.classList.add("no-smb-reskin");

    window.current_ups_template_name = "_preview_information";
    window.generate_ups_label = document.querySelector('#upsTabContent form[id="generate_ups_shipping_label_form"]');
    if (window.generate_ups_label == null) {
        console.error('Something went wrong and the UPS label printing block was unable to load!');
        return false;
    }

    addListenerToElement(window.generate_ups_label.querySelectorAll('h3[id="expand_ups"]'), 'click', function () {
        if (this.parentElement.style.height != '40px') {
            window.generate_ups_label.querySelector("span[id='hide_show_ups']").innerHTML = '[+]';
            this.parentElement.style.height = '40px';
        } else {
            window.generate_ups_label.querySelector("span[id='hide_show_ups']").innerHTML = '[-]';
            this.parentElement.style.height = 'auto';
        }
    });

    addListenerToElement(window.generate_ups_label.querySelectorAll('button[id="load_settings_form"]'), 'click', function () {
        this.disabled = true;
        this.setAttribute('disabled', 'disabled');

        this.querySelector('span').innerHTML = processing;

        this.querySelector('i').classList.remove('fa');
        this.querySelector('i').classList.remove('fa-edit');

        this.querySelector('i').classList.add('fa');
        this.querySelector('i').classList.add('fa-spinner');
        this.querySelector('i').classList.add('fa-spin');

        load_ups_settings_form(this.getAttribute('data-template'));
    });

    addListenerToElement(window.generate_ups_label.querySelectorAll('button[id="reset_settings"]'), 'click', function () {
        if (!confirm(reset_settings_confirmation)) {
            return;
        }

        this.disabled = true;
        this.setAttribute('disabled', 'disabled');

        this.querySelector('span').innerHTML = processing;

        this.querySelector('i').classList.remove('fa');
        this.querySelector('i').classList.remove('fa-reply-all');

        this.querySelector('i').classList.add('fa');
        this.querySelector('i').classList.add('fa-spinner');
        this.querySelector('i').classList.add('fa-spin');

        reset_ups_settings(this.getAttribute('data-setting'), null);
    });

    addListenerToElement(window.generate_ups_label.querySelectorAll('button[id="update_information"]'), 'click', function () {
        this.disabled = true;
        this.setAttribute('disabled', 'disabled');

        this.querySelector('span').innerHTML = processing;

        this.querySelector('i').classList.remove('fa');
        this.querySelector('i').classList.remove('fa-edit');

        this.querySelector('i').classList.add('fa');
        this.querySelector('i').classList.add('fa-spinner');
        this.querySelector('i').classList.add('fa-spin');

        save_ups_settings(this.getAttribute('rel'));
    });

    addListenerToElement(window.generate_ups_label.querySelectorAll('input[rel="products_in_package"]'), 'blur', function () {
        save_ups_settings('package_information', '_packages_information_form');
    });

    addListenerToElement(window.generate_ups_label.querySelectorAll('button[id="estime_postage"]'), 'click', function () {
        this.disabled = true;
        this.setAttribute('disabled', 'disabled');
        this.querySelector('i').classList.add('fa-spin');

        get_ups_postage();
    }, true);

    addListenerToElement(window.generate_ups_label.querySelectorAll('button[id="generate_shipping_label"]'), 'click', function () {
        if (window.generate_ups_label.querySelector('div[id="generated_shipping_labels"]').innerHTML != "") {
            if (!confirm(overwrite_labels)) {
                return;
            }
        }

        this.disabled = true;
        this.setAttribute('disabled', 'disabled');

        this.querySelector('span').innerHTML = processing;

        this.querySelector('i').classList.remove('fa');
        this.querySelector('i').classList.remove('fa-file');

        this.querySelector('i').classList.add('fa');
        this.querySelector('i').classList.add('fa-spinner');
        this.querySelector('i').classList.add('fa-spin');

        generate_ups_shipping_label();
    });

    addListenerToElement(window.generate_ups_label.querySelectorAll('button[id="void_shipping_label"]'), 'click', function () {
        if (!confirm(confirm_voiding_shipment)) {
            return;
        }

        this.disabled = true;
        this.setAttribute('disabled', 'disabled');

        this.querySelector('span').innerHTML = processing;

        this.querySelector('i').classList.remove('fa');
        this.querySelector('i').classList.remove('fa-edit');

        this.querySelector('i').classList.add('fa');
        this.querySelector('i').classList.add('fa-spinner');
        this.querySelector('i').classList.add('fa-spin');

        void_ups_shipping_label();
    });

    /** PANEL - SHIPPER INFORMATION */
    addListenerToElement(window.generate_ups_label.querySelectorAll('select[id="UPS_SHIPPER_COUNTRY"]'), 'change', function () {
        window.generate_ups_label.querySelector('select[id="UPS_SHIPPER_STATE"]').innerHTML = '<option>' + loading_options + '</option>';
        window.generate_ups_label.querySelector('select[id="UPS_SHIPPER_STATE"]').disabled = true;
        window.generate_ups_label.querySelector('select[id="UPS_SHIPPER_STATE"]').setAttribute('disabled', 'disabled');

        load_ups_country_states(this.value, window.generate_ups_label.querySelector('select[id="UPS_SHIPPER_STATE"]'));
    });

    /** PANEL - RECEIPENT INFORMATION */
    addListenerToElement(window.generate_ups_label.querySelectorAll('select[id="UPS_RECIPIENT_COUNTRY"]'), 'change', function () {
        window.generate_ups_label.querySelector('select[id="UPS_RECIPIENT_STATE"]').innerHTML = '<option>' + loading_options + '</option>';
        window.generate_ups_label.querySelector('select[id="UPS_RECIPIENT_STATE"]').disabled = true;
        window.generate_ups_label.querySelector('select[id="UPS_RECIPIENT_STATE"]').setAttribute('disabled', 'disabled');

        load_ups_country_states(this.value, window.generate_ups_label.querySelector('select[id="UPS_RECIPIENT_STATE"]'));
    });

    /** PANEL - PACKAGES INFORMATION */
    addListenerToElement(window.generate_ups_label.querySelectorAll('select[id="UPS_PACKAGE_TYPE"]'), 'change', function () {
        var dimensions = this.options[this.selectedIndex].getAttribute('rel');
        dimensions = dimensions.split('_');

        window.generate_ups_label.querySelector('input[id="UPS_PACKAGE_WIDTH"]').value = dimensions[0];
        window.generate_ups_label.querySelector('input[id="UPS_PACKAGE_HEIGHT"]').value = dimensions[1];
        window.generate_ups_label.querySelector('input[id="UPS_PACKAGE_DEPTH"]').value = dimensions[2];

        if (this.value != 'Package' && this.value != 'Envelope') {
            window.generate_ups_label.querySelector('input[id="UPS_PACKAGE_WIDTH"]').setAttribute('readonly', 'readonly');
            window.generate_ups_label.querySelector('input[id="UPS_PACKAGE_HEIGHT"]').setAttribute('readonly', 'readonly');
            window.generate_ups_label.querySelector('input[id="UPS_PACKAGE_DEPTH"]').setAttribute('readonly', 'readonly');
        } else {
            window.generate_ups_label.querySelector('input[id="UPS_PACKAGE_WIDTH"]').removeAttribute('readonly');
            window.generate_ups_label.querySelector('input[id="UPS_PACKAGE_HEIGHT"]').removeAttribute('readonly');
            window.generate_ups_label.querySelector('input[id="UPS_PACKAGE_DEPTH"]').removeAttribute('readonly');
        }
    }, true);

    addListenerToElement(window.generate_ups_label.querySelectorAll('select[rel="packageType"]'), 'change', function () {
        var dimensions = this.options[this.selectedIndex].getAttribute('rel');
        dimensions = dimensions.split('_');

        packageID = this.id.split('_');
        packageID = packageID[3];

        window.generate_ups_label.querySelector('input[id="UPS_PACKAGE_WIDTH_' + packageID + '"]').value = dimensions[0];
        window.generate_ups_label.querySelector('input[id="UPS_PACKAGE_HEIGHT_' + packageID + '"]').value = dimensions[1];
        window.generate_ups_label.querySelector('input[id="UPS_PACKAGE_DEPTH_' + packageID + '"]').value = dimensions[2];

        if (this.value != 'Package' && this.value != 'Envelope') {
            window.generate_ups_label.querySelector('input[id="UPS_PACKAGE_WIDTH_' + packageID + '"]').setAttribute('readonly', 'readonly');
            window.generate_ups_label.querySelector('input[id="UPS_PACKAGE_HEIGHT_' + packageID + '"]').setAttribute('readonly', 'readonly');
            window.generate_ups_label.querySelector('input[id="UPS_PACKAGE_DEPTH_' + packageID + '"]').setAttribute('readonly', 'readonly');
        } else {
            window.generate_ups_label.querySelector('input[id="UPS_PACKAGE_WIDTH_' + packageID + '"]').removeAttribute('readonly');
            window.generate_ups_label.querySelector('input[id="UPS_PACKAGE_HEIGHT_' + packageID + '"]').removeAttribute('readonly');
            window.generate_ups_label.querySelector('input[id="UPS_PACKAGE_DEPTH_' + packageID + '"]').removeAttribute('readonly');
        }
    });

    addListenerToElement(window.generate_ups_label.querySelectorAll('button[id="add_pack"]'), 'click', function () {
        this.disabled = true;
        this.setAttribute('disabled', 'disabled');

        this.querySelector('span').innerHTML = processing;

        this.querySelector('i').classList.remove('fa');
        this.querySelector('i').classList.remove('fa-edit');

        this.querySelector('i').classList.add('fa');
        this.querySelector('i').classList.add('fa-spinner');
        this.querySelector('i').classList.add('fa-spin');

        save_ups_settings('package_information_insert', '_packages_information_form');
    });

    addListenerToElement(window.generate_ups_label.querySelectorAll('button[rel=delete_pack]'), 'click', function (e) {
        packageID = this.id.split('_');
        packageID = packageID[2];

        this.disabled = true;
        this.setAttribute('disabled', 'disabled');

        this.querySelector('span').innerHTML = deleting;

        this.querySelector('i').classList.remove('fa');
        this.querySelector('i').classList.remove('fa-edit');

        this.querySelector('i').classList.add('fa');
        this.querySelector('i').classList.add('fa-spinner');
        this.querySelector('i').classList.add('fa-spin');

        setTimeout(function () {
            window.generate_ups_label.querySelector('div[id="Package_' + packageID + '"]').remove();
            window.generate_ups_label.querySelector('h3[id="UPS_PACKAGE_' + packageID + '_HEAD"]').remove();
        }, 500);

        e.preventDefault();
    });

    /** PANEL - GLOBAL SETTINGS */
    addListenerToElement(window.generate_ups_label.querySelectorAll('select[id="UPS_SETTINGS_INCLUDE_RETURN"]'), 'change', function () {
        if (this.value > 0) {
            window.generate_ups_label.querySelector('div[id="UPS_SETTINGS_RETURN_OPTIONS"]').style.display = 'block';
        } else {
            window.generate_ups_label.querySelector('div[id="UPS_SETTINGS_RETURN_OPTIONS"]').style.display = 'none';
        }
    });

    addListenerToElement(window.generate_ups_label.querySelectorAll('select[id="UPS_SETTINGS_RETURN_OPTION"]'), 'change', function () {
        if (this.value === 'OTHER') {
            window.generate_ups_label.querySelector('div[id="UPS_SETTINGS_RETURN_OPTION_OTH"]').style.display = 'block';
        } else {
            window.generate_ups_label.querySelector('div[id="UPS_SETTINGS_RETURN_OPTION_OTH"]').style.display = 'none';
        }
    });

    addListenerToElement(window.generate_ups_label.querySelectorAll('select[id="UPS_SETTINGS_SHIPMENTMETHOD"]'), 'change', function () {
        if (this.value === '70') {
            window.generate_ups_label.querySelector('div[id="access_point_settings"]').style.display = 'block';
        } else {
            window.generate_ups_label.querySelector('div[id="access_point_settings"]').style.display = 'none';
        }
    });

    /** PANEL - DOMESTIC SETTINGS */
    $('#UPS_SETTINGS_DATEOFSHIPMENT').datepicker({
        dateFormat: 'mm/dd/yy',
        minDate: 0,
        maxDate: '+9D',
        showButtonPanel: true,
        showWeek: true,
        showAnim: 'slideDown'
    });

    /** PANEL - INTERNATIONAL SETTINGS */

    load_order_generated_ups_shipping_labels();
}

function load_order_generated_ups_shipping_labels() {
    if (window.generate_ups_label.querySelector('div[id="generated_shipping_labels"]') === null) {
        return false;
    }

    var request = new XMLHttpRequest();

    request.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            var html = this.responseText;
            if (html.length > 1) {
                window.generate_ups_label.querySelector('div[id="generated_shipping_labels"]').innerHTML = html;
                window.generate_ups_label.querySelector('div[id="generated_shipping_labels"]').style.display = 'block';

                addListenerToElement(window.generate_ups_label.querySelectorAll('button[id="delete_shipping_label"]'), 'click', function () {
                    if (window.generate_ups_label.querySelector('div[id="generated_shipping_labels"]').innerHTML == "" || !confirm(delete_shipping_labels)) {
                        return;
                    }

                    this.disabled = true;
                    this.setAttribute('disabled', 'disabled');

                    this.querySelector('span').innerHTML = processing;

                    this.querySelector('i').classList.remove('fa');
                    this.querySelector('i').classList.remove('fa-edit');

                    this.querySelector('i').classList.add('fa');
                    this.querySelector('i').classList.add('fa-spinner');
                    this.querySelector('i').classList.add('fa-spin');

                    delete_ups_shipping_label();
                });

                if (typeof $ !== 'undefined'
                    && typeof $.fancybox !== 'undefined') {
                    $("a[class='previousLabelsFancy']").fancybox({
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
                }
            } else {
                window.generate_ups_label.querySelector('div[id="generated_shipping_labels"]').innerHTML = '';
                window.generate_ups_label.querySelector('div[id="generated_shipping_labels"]').style.display = 'none';
            }
        }
    }

    let query_params = new FormData();
    query_params.append('action', 'load_order_generated_shipping_labels');
    query_params.append('id_order', id_order);
    var query_string = (new URLSearchParams(query_params)).toString();

    request.open('GET', ups_ajax_functions_url + '&' + query_string, true);
    request.send();
}

function load_ups_settings_form(template_name, message, type) {
    if (message === undefined || type === undefined) {
        message = '';
        type = '';
    }

    console.log(template_name)

    var request = new XMLHttpRequest();
    request.template_name = template_name;

    request.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            var html = this.responseText;
            if (html.length > 1) {
                window.current_ups_template_name = this.template_name;

                window.generate_ups_label.querySelector('div[id="formContent"]').innerHTML = html;
                window.generate_ups_label.querySelector('div[id="formContent"]').style.display = 'block';

                init_ups();
            }
        }
    }

    let query_params = new FormData();
    query_params.append('action', 'load_settings_form');
    query_params.append('template_name', template_name);
    query_params.append('id_order', id_order);
    query_params.append('text', message);
    query_params.append('type', type);
    var query_string = (new URLSearchParams(query_params)).toString();

    request.open('GET', ups_ajax_functions_url + '&' + query_string, true);
    request.send();
}

function save_ups_settings(settings_column, template_name) {
    if (template_name === undefined || template_name === null) {
        template_name = "_preview_information";
    }

    var request = new XMLHttpRequest();
    request.template_name = template_name;

    request.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            var html = this.responseText;

            var message = saving_settings_success;
            var type = 'success';
            if (html != "Saved") {
                message = saving_settings_failed;
                type = 'error';
                if (html != "Failed") {
                    message = html;
                }

                this.template_name = window.current_ups_template_name;
            }

            load_ups_settings_form(this.template_name, message, type);
        }
    }

    let form_data = new FormData(window.generate_ups_label);
    form_data.append('id_order', id_order);
    form_data.append('settings_column', settings_column);
    form_data.append('action', 'save_settings');
    var post_data = (new URLSearchParams(form_data)).toString();

    request.open('POST', ups_ajax_functions_url, true);
    request.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    request.send(post_data);
}

function reset_ups_settings(settings_column, template_name) {
    if (template_name === undefined || template_name === null) {
        template_name = "_preview_information";
    }

    var request = new XMLHttpRequest();
    request.template_name = template_name;
    request.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            var html = this.responseText;

            var message = resetting_settings_success;
            var type = 'success';
            if (html != "Saved") {
                message = resetting_settings_failed;
                type = 'error';
            }

            load_ups_settings_form(this.template_name, resetting_settings_success, type);
        }
    }

    let form_data = new FormData(window.generate_ups_label);
    form_data.append('id_order', id_order);
    form_data.append('settings_column', settings_column);
    form_data.append('action', 'reset_settings');
    var post_data = (new URLSearchParams(form_data)).toString();

    request.open('POST', ups_ajax_functions_url, true);
    request.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    request.send(post_data);
}

function load_ups_country_states(country_iso, output_select) {
    var request = new XMLHttpRequest();

    request.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            var html = this.responseText;
            output_select.innerHTML = html;

            if (html.length > 1 && html.indexOf('State not available') == -1) {
                output_select.removeAttribute('disabled');
                output_select.disabled = false;
            } else {
                output_select.disabled = true;
                output_select.setAttribute('disabled', 'disabled');
            }

            output_select.style.display = 'block';
            init_ups();
        }
    }

    let query_params = new FormData();
    query_params.append('action', 'load_country_states');
    query_params.append('country_iso', country_iso);
    var query_string = (new URLSearchParams(query_params)).toString();

    request.open('GET', ups_ajax_functions_url + '&' + query_string, true);
    request.send();
}

function get_ups_postage() {
    console.log("paulo");
    window.generate_ups_label.querySelector('b[id=postageTotal]').innerHTML = calculating_postage;
    window.generate_ups_label.querySelector('div[id=shipping_label_results]').innerHTML = '';

    var request = new XMLHttpRequest();

    request.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            var result = this.responseText;
            postage = parseFloat(result);

            if (postage > 0) {
                window.generate_ups_label.querySelector('b[id=postageTotal]').innerHTML = store_currency_sign + postage.toFixed(2) + ' (' + store_currency_iso + ')';

                window.generate_ups_label.querySelector('button[id=generate_shipping_label]').removeAttribute('disabled');
                window.generate_ups_label.querySelector('button[id=generate_shipping_label]').disabled = false;
            } else {
                window.generate_ups_label.querySelector('b[id=postageTotal]').innerHTML = not_available;

                window.generate_ups_label.querySelector('button[id=generate_shipping_label]').disabled = true;
                window.generate_ups_label.querySelector('button[id=generate_shipping_label]').setAttribute('disabled', 'disabled');

                if (postage != 0 && postage != -1) {
                    window.generate_ups_label.querySelector('div[id=shipping_label_results]').innerHTML = result;
                }
            }

            const estimate_postage_button = window.generate_ups_label.querySelector('button[id="estime_postage"]');
            estimate_postage_button.disabled = true;
            estimate_postage_button.removeAttribute('disabled');
            estimate_postage_button.querySelector('i').classList.remove('fa-spin');
        }
    }

    let query_params = new FormData();
    query_params.append('action', 'get_postage');
    query_params.append('id_order', id_order);
    var query_string = (new URLSearchParams(query_params)).toString();

    request.open('GET', ups_ajax_functions_url + '&' + query_string, true);
    request.send();
}

function generate_ups_shipping_label() {
    var request = new XMLHttpRequest();

    request.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            var json = JSON.parse(this.responseText);

            if (json.status) {
                load_order_generated_ups_shipping_labels();

                window.generate_ups_label.querySelector('button[id="generate_shipping_label"] span').innerHTML = generate_shipping_label_text;
                window.generate_ups_label.querySelector('button[id="generate_shipping_label"] i').classList = [];

                window.generate_ups_label.querySelector('button[id="generate_shipping_label"] i').classList.add('fa');
                window.generate_ups_label.querySelector('button[id="generate_shipping_label"] i').classList.add('fa-file');

                window.generate_ups_label.querySelector('button[id=void_shipping_label]').removeAttribute('disabled');
                window.generate_ups_label.querySelector('button[id=void_shipping_label]').disabled = false;
            } else {
                window.generate_ups_label.querySelector('button[id="generate_shipping_label"] span').innerHTML = generate_shipping_label_text;
                window.generate_ups_label.querySelector('button[id="generate_shipping_label"] i').classList = [];

                window.generate_ups_label.querySelector('button[id="generate_shipping_label"] i').classList.add('fa');
                window.generate_ups_label.querySelector('button[id="generate_shipping_label"] i').classList.add('fa-file');

                window.generate_ups_label.querySelector('button[id=generate_shipping_label]').removeAttribute('disabled');
                window.generate_ups_label.querySelector('button[id=generate_shipping_label]').disabled = false;
            }

            window.generate_ups_label.querySelector('div[id="shipping_label_results"]').innerHTML = json.html;
        }
    }

    let form_data = new FormData(window.generate_ups_label);
    form_data.append('id_order', id_order);
    form_data.append('id_employee', id_employee);
    form_data.append('action', 'generate_shipping_label');
    var post_data = (new URLSearchParams(form_data)).toString();

    request.open('POST', ups_ajax_functions_url, true);
    request.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    request.send(post_data);
}

function void_ups_shipping_label() {
    var request = new XMLHttpRequest();

    request.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            var json = JSON.parse(this.responseText);

            if (json.status) {
                load_order_generated_ups_shipping_labels();

                window.generate_ups_label.querySelector('button[id="void_shipping_label"] span').innerHTML = void_shipping_label_text;
                window.generate_ups_label.querySelector('button[id="void_shipping_label"] i').classList = [];

                window.generate_ups_label.querySelector('button[id="void_shipping_label"] i').classList.add('fa');
                window.generate_ups_label.querySelector('button[id="void_shipping_label"] i').classList.add('fa-sign-out');

                window.generate_ups_label.querySelector('button[id=generate_shipping_label]').removeAttribute('disabled');
                window.generate_ups_label.querySelector('button[id=generate_shipping_label]').disabled = false;
            } else {
                window.generate_ups_label.querySelector('button[id="void_shipping_label"] span').innerHTML = void_shipping_label_text;
                window.generate_ups_label.querySelector('button[id="void_shipping_label"] i').classList = [];

                window.generate_ups_label.querySelector('button[id="void_shipping_label"] i').classList.add('fa');
                window.generate_ups_label.querySelector('button[id="void_shipping_label"] i').classList.add('fa-sign-out');

                window.generate_ups_label.querySelector('button[id=void_shipping_label]').removeAttribute('disabled');
                window.generate_ups_label.querySelector('button[id=void_shipping_label]').disabled = false;
            }

            window.generate_ups_label.querySelector('div[id="shipping_label_results"]').innerHTML = json.html;
        }
    }

    let form_data = new FormData(window.generate_ups_label);
    form_data.append('id_order', id_order);
    form_data.append('action', 'void_shipping_label');
    var post_data = (new URLSearchParams(form_data)).toString();

    request.open('POST', ups_ajax_functions_url, true);
    request.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    request.send(post_data);
}

function delete_ups_shipping_label() {
    var request = new XMLHttpRequest();

    request.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            var html = this.responseText;

            load_order_generated_ups_shipping_labels();
            window.generate_ups_label.querySelector('div[id="shipping_label_results"]').innerHTML = html;
        }
    }

    let form_data = new FormData(window.generate_ups_label);
    form_data.append('id_order', id_order);
    form_data.append('action', 'delete_shipping_label');
    var post_data = (new URLSearchParams(form_data)).toString();

    request.open('POST', ups_ajax_functions_url, true);
    request.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    request.send(post_data);
}

window.addEventListener('load', function () {
    init_ups();
});