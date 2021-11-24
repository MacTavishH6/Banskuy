const { toSafeInteger } = require('lodash');

require('./bootstrap');
window._ = require('./underscore');
require('./date');

import 'jquery-ui/ui/widgets/datepicker.js';

window.banskuy = {} || '';
banskuy.ShowLoading = function (state) {
    if (state)
        $("#loadingModal").modal();
    else
        $("#loadingModal").modal('hide');
}

banskuy.getReq = function (url, param) {
    return new Promise(($resolve, $reject) => {
        $.ajax({
            url: url,
            type: 'GET',
            beforeSend: function (e) {
                banskuy.ShowLoading(true);
            },
            success: function (data) {
                $resolve(data);
            },
            error: function (data) {
                $resolve(data);
                banskuy.ShowLoading(false);
            },
            complete: function (data) {
                banskuy.ShowLoading(false);
            },
            contentType: "application/json"
        })
    });
}

banskuy.postReq = function (url, param) {
    return new Promise(($resolve, $reject) => {
        return new Promise(function (resolve, reject) {
            $.ajax({
                type: "POST",
                url: url,
                data: JSON.stringify(param),
                beforeSend: function (e) {
                    banskuy.ShowLoading(true);
                },
                success: function (data) {
                    $resolve(data);
                },
                error: function (data) {
                    $resolve(data);
                    banskuy.ShowLoading(false);
                },
                complete: function (data) {
                    banskuy.ShowLoading(false);
                },
                contentType: "application/json"
            });
        });
    });
}