$('#preloader').fadeOut(1200);
GetAttacks();
PaymentHistory();
GetTickets();
GetApiToken();
CustomPlanRange();
function PurchaseCustomPlan() {
    var _0x123704 = $('#custompremium').val(), _0x18abc2 = $('#customapi').val(), _0xe71454 = $('#customtime').val(), _0x1f52bb = $('#customconcs').val(), _0x42e282 = $('#customperiod').val();
    if (_0x123704 == '' || _0x18abc2 == '' || _0xe71454 == '' || _0x1f52bb == '' || _0x42e282 == '' || _0xe71454 == null || _0x1f52bb == null || _0x42e282 == null) {
        Toastify({
            text: 'There is problem with purchasing custom plan!',
            duration: 1500,
            backgroundColor: 'red'
        }).showToast();
        return;
    } else {
        $.ajax({
            url: 'rest/purchase/customplan',
            type: 'post',
            data: {
                premium: _0x123704,
                api: _0x18abc2,
                time: _0xe71454,
                concs: _0x1f52bb,
                period: _0x42e282
            },
            cache: false,
            success: function (_0x5efc2e) {
                const _0x3864f6 = JSON.parse(_0x5efc2e);
                var _0xd3e585 = _0x3864f6.status, _0x43ddec = _0x3864f6.message;
                if (_0xd3e585 == 'error') {
                    Toastify({
                        text: _0x43ddec,
                        duration: 1500,
                        backgroundColor: 'red'
                    }).showToast();
                } else {
                    Toastify({
                        text: _0x43ddec,
                        duration: 1500,
                        backgroundColor: 'green'
                    }).showToast();
                    setTimeout(function () {
                        window.location.href = 'home';
                    }, 2000);
                }
            }
        });
    }
}
function CustomPlanRange() {
    $('#customprice').html('' + ($('#customtime').val() * 5 - 5 + ($('#customconcs').val() * 15 - 15) + $('#custompremium').val() * 20 + $('#customapi').val() * 5 + 20) * $('#customperiod').val());
    var _0x38363c = $('#customtime'), _0x1a2a61 = $('#customtimespan'), _0x1ad296 = _0x38363c.attr('value');
    _0x1a2a61.html(_0x1ad296 * 300);
    _0x38363c.on('input', function () {
        const _0x3dff18 = _0x38363c.val();
        _0x1a2a61.html(_0x3dff18 * 300);
        if (_0x3dff18 > 12) {
            Toastify({
                text: 'Invalid attack time value!',
                duration: 1500,
                backgroundColor: 'red'
            }).showToast();
            setTimeout(function () {
                location.reload();
            }, 2000);
        } else {
            if (_0x3dff18 < 0) {
                Toastify({
                    text: 'Invalid attack time value!',
                    duration: 1500,
                    backgroundColor: 'red'
                }).showToast();
                setTimeout(function () {
                    location.reload();
                }, 2000);
            }
        }
        $('#customprice').html('' + ($('#customtime').val() * 5 - 5 + ($('#customconcs').val() * 15 - 15) + $('#custompremium').val() * 20 + $('#customapi').val() * 5 + 20) * $('#customperiod').val());
    });
    var _0xe43a7b = $('#customconcs'), _0x2f6625 = $('#customconcsspan'), _0x14e977 = _0xe43a7b.attr('value');
    _0x2f6625.html(_0x14e977);
    _0xe43a7b.on('input', function () {
        const _0x40a519 = _0xe43a7b.val();
        _0x2f6625.html(_0x40a519);
        if (_0x40a519 > 30) {
            Toastify({
                text: 'Concurrents cannot be greater then 50concs',
                duration: 1500,
                backgroundColor: 'red'
            }).showToast();
            setTimeout(function () {
                location.reload();
            }, 2000);
        } else {
            if (_0x40a519 < 1) {
                Toastify({
                    text: 'Concurrents cannot be lower then 1conc',
                    duration: 1500,
                    backgroundColor: 'red'
                }).showToast();
                setTimeout(function () {
                    location.reload();
                }, 2000);
            }
        }
        $('#customprice').html('' + ($('#customtime').val() * 5 - 5 + ($('#customconcs').val() * 15 - 15) + $('#custompremium').val() * 20 + $('#customapi').val() * 5 + 20) * $('#customperiod').val());
    });
    var _0x4292e1 = $('#customperiod'), _0x17651e = $('#customperiodspan'), _0x3061fd = _0x4292e1.attr('value');
    _0x17651e.html(_0x3061fd);
    _0x4292e1.on('input', function () {
        const _0x55d1de = _0x4292e1.val();
        _0x17651e.html(_0x55d1de);
        if (_0x55d1de > 12) {
            Toastify({
                text: 'Plan period cannot be more then 12 months',
                duration: 1500,
                backgroundColor: 'red'
            }).showToast();
            setTimeout(function () {
                location.reload();
            }, 2000);
        } else {
            if (_0x55d1de < 1) {
                Toastify({
                    text: 'Plan period cannot be shorter then 12 months',
                    duration: 1500,
                    backgroundColor: 'red'
                }).showToast();
                setTimeout(function () {
                    location.reload();
                }, 2000);
            }
        }
        $('#customprice').html('' + ($('#customtime').val() * 5 - 5 + ($('#customconcs').val() * 15 - 15) + $('#custompremium').val() * 20 + $('#customapi').val() * 5 + 20) * $('#customperiod').val());
    });
}
;
function customapi_upd() {
    $('#customprice').html('' + ($('#customtime').val() * 5 - 5 + ($('#customconcs').val() * 15 - 15) + $('#custompremium').val() * 20 + $('#customapi').val() * 5 + 20) * $('#customperiod').val());
}
function custompremium_upd() {
    $('#customprice').html('' + ($('#customtime').val() * 5 - 5 + ($('#customconcs').val() * 15 - 15) + $('#custompremium').val() * 20 + $('#customapi').val() * 5 + 20) * $('#customperiod').val());
}
function DeleteSchedule(_0x151895) {
    var _0x2b7280 = _0x151895;
    if (_0x2b7280 == '') {
        Toastify({
            text: 'Attack ID is empty!',
            duration: 1500,
            backgroundColor: 'red'
        }).showToast();
        return;
    }
    $('#deletesch_def').hide();
    $('#deletesch_loadi').show();
    $('#deleteschbtn').prop('disabled', true);
    $.ajax({
        url: 'rest/user/schedule?type=delete',
        type: 'post',
        data: { shedid: _0x2b7280 },
        cache: false,
        success: function (_0xfa84bc) {
            const _0x15c5d5 = JSON.parse(_0xfa84bc);
            var _0x9a02bf = _0x15c5d5.status, _0x4c0291 = _0x15c5d5.message;
            if (_0x9a02bf == 'error') {
                Toastify({
                    text: _0x4c0291,
                    duration: 1500,
                    backgroundColor: 'red'
                }).showToast();
                $('#deletesch_def').show();
                $('#deletesch_loadi').hide();
                $('#deleteschbtn').prop('disabled', false);
            } else {
                Toastify({
                    text: _0x4c0291,
                    duration: 1500,
                    backgroundColor: 'green'
                }).showToast();
                LoadSchedule();
                $('#deletesch_def').show();
                $('#deletesch_loadi').hide();
                $('#deleteschbtn').prop('disabled', false);
            }
        }
    });
}
function ScheduledAttacks() {
    $('#scheduled-modal').modal('show');
    LoadSchedule();
}
function LoadSchedule() {
    $('#scheduled-table').DataTable({
        processing: true,
        serverSide: true,
        bFilter: false,
        serverMethod: 'post',
        responsive: true,
        language: { emptyTable: 'No scheduled attacks' },
        ajax: {
            url: 'rest/user/scheduled',
            type: 'POST'
        },
        columnDefs: [{
                className: 'text-center',
                targets: [
                    1,
                    2,
                    3,
                    4,
                    5
                ]
            }],
        bDestroy: true,
        columns: [
            { data: 'id' },
            { data: 'target' },
            { data: 'method' },
            { data: 'created' },
            { data: 'scheduled' },
            { data: 'action' }
        ]
    });
}
function ScheduleL4Attack() {
    var _0x27ce85 = $('#l4hostsch').val(), _0x13813f = $('#l4timesch').val(), _0x59e50e = $('#l4portsch').val(), _0x4d05cb = $('#l4methodsch').val(), _0x593576 = $('#l4datetimesch').val();
    $('#l4sch_def').hide();
    $('#l4sch_loadi').show();
    $('#l4btnsch').prop('disabled', true);
    if (_0x27ce85 == '' || _0x13813f == '' || _0x59e50e == '' || _0x4d05cb == '') {
        Toastify({
            text: 'Please fill all required fields!',
            duration: 1500,
            backgroundColor: 'red'
        }).showToast();
        $('#l4sch_def').show();
        $('#l4sch_loadi').hide();
        $('#l4btnsch').prop('disabled', false);
        return;
    }
    $.ajax({
        url: 'rest/user/schedule?type=l4',
        type: 'post',
        data: {
            host: _0x27ce85,
            time: _0x13813f,
            port: _0x59e50e,
            method: _0x4d05cb,
            datetime: _0x593576
        },
        cache: false,
        success: function (_0x54ef3f) {
            const _0x5e3824 = JSON.parse(_0x54ef3f);
            var _0x38687b = _0x5e3824.status, _0x3bb371 = _0x5e3824.message;
            if (_0x38687b == 'error') {
                Toastify({
                    text: _0x3bb371,
                    duration: 1500,
                    backgroundColor: 'red'
                }).showToast();
                $('#l4sch_def').show();
                $('#l4sch_loadi').hide();
                $('#l4btnsch').prop('disabled', false);
            } else {
                Toastify({
                    text: _0x3bb371,
                    duration: 1500,
                    backgroundColor: 'green'
                }).showToast();
                LoadSchedule();
                $('#l4sch_def').show();
                $('#l4sch_loadi').hide();
                $('#l4btnsch').prop('disabled', false);
            }
        }
    });
}
function ScheduleL7Attack() {
    var _0x2d3c7c = $('#l7hostsch').val(), _0x8f316b = $('#l7timesch').val(), _0x128f72 = $('#l7reqmethodsch').val(), _0x1aa136 = $('#l7methodsch').val(), _0x1d446c = $('#l7reqssch').val(), _0x2ca049 = $('#l7datetimesch').val();
    $('#l7sch_def').hide();
    $('#l7sch_loadi').show();
    $('#l7btnsch').prop('disabled', true);
    if (_0x2d3c7c == '' || _0x8f316b == '' || _0x128f72 == '' || _0x1aa136 == '') {
        Toastify({
            text: 'Please fill all required fields!',
            duration: 1500,
            backgroundColor: 'red'
        }).showToast();
        $('#l7sch_def').show();
        $('#l7sch_loadi').hide();
        $('#l7btnsch').prop('disabled', false);
        return;
    }
    $.ajax({
        url: 'rest/user/schedule?type=l7',
        type: 'post',
        data: {
            host: _0x2d3c7c,
            time: _0x8f316b,
            reqmethod: _0x128f72,
            method: _0x1aa136,
            reqs: _0x1d446c,
            datetime: _0x2ca049
        },
        cache: false,
        success: function (_0x1beea7) {
            const _0x3ea226 = JSON.parse(_0x1beea7);
            var _0x2d6b28 = _0x3ea226.status, _0x2ade80 = _0x3ea226.message;
            if (_0x2d6b28 == 'error') {
                Toastify({
                    text: _0x2ade80,
                    duration: 1500,
                    backgroundColor: 'red'
                }).showToast();
                $('#l7sch_def').show();
                $('#l7sch_loadi').hide();
                $('#l7btnsch').prop('disabled', false);
            } else {
                Toastify({
                    text: _0x2ade80,
                    duration: 1500,
                    backgroundColor: 'green'
                }).showToast();
                LoadSchedule();
                $('#l7sch_def').show();
                $('#l7sch_loadi').hide();
                $('#l7btnsch').prop('disabled', false);
            }
        }
    });
}
function OpenSchedule() {
    $('#schedule-modal').modal('show');
}
function GetApiToken() {
    $.ajax({
        url: 'rest/api/token',
        type: 'post',
        cache: false,
        success: function (_0x387fd2) {
            const _0x45ae07 = JSON.parse(_0x387fd2);
            var _0x1a97d7 = _0x45ae07.status, _0x462d62 = _0x45ae07.message;
            if (_0x1a97d7 == 'error') {
                $('#apitokenfield').val(_0x462d62);
            } else {
                $('#apitokenfield').val(_0x462d62);
            }
        }
    });
}
function GenerateToken() {
    $.ajax({
        url: 'rest/api/generate',
        type: 'post',
        cache: false,
        success: function (_0x1bee13) {
            const _0x2140b2 = JSON.parse(_0x1bee13);
            var _0x2ea3c4 = _0x2140b2.status, _0x147d97 = _0x2140b2.message;
            if (_0x2ea3c4 == 'error') {
                Toastify({
                    text: _0x147d97,
                    duration: 1500,
                    backgroundColor: 'red'
                }).showToast();
            } else {
                Toastify({
                    text: _0x147d97,
                    duration: 1500,
                    backgroundColor: 'green'
                }).showToast();
                GetApiToken();
                $('#gentoken-btn').attr('disabled', true);
                setTimeout(enableButton, 15000);
            }
        }
    });
}
function DisableToken() {
    $.ajax({
        url: 'rest/api/disable',
        type: 'post',
        cache: false,
        success: function (_0x58f36c) {
            const _0x188ea6 = JSON.parse(_0x58f36c);
            var _0x2c5ddc = _0x188ea6.status, _0x3debf1 = _0x188ea6.message;
            if (_0x2c5ddc == 'error') {
                Toastify({
                    text: _0x3debf1,
                    duration: 1500,
                    backgroundColor: 'red'
                }).showToast();
            } else {
                Toastify({
                    text: _0x3debf1,
                    duration: 1500,
                    backgroundColor: 'green'
                }).showToast();
                GetApiToken();
            }
        }
    });
}
function enableButton() {
    $('#gentoken-btn').attr('disabled', false);
}
function CloseTicket(_0x38fba5) {
    var _0x50474a = _0x38fba5;
    if (_0x50474a == '') {
        Toastify({
            text: 'TicketID is empty!',
            duration: 1500,
            backgroundColor: 'red'
        }).showToast();
        return;
    }
    $.ajax({
        url: 'rest/tickets/close',
        type: 'post',
        data: { ticketid: _0x50474a },
        cache: false,
        success: function (_0xb51843) {
            const _0x4dad8b = JSON.parse(_0xb51843);
            var _0x424285 = _0x4dad8b.status, _0x2b3153 = _0x4dad8b.message;
            if (_0x424285 == 'error') {
                Toastify({
                    text: _0x2b3153,
                    duration: 1500,
                    backgroundColor: 'red'
                }).showToast();
            } else {
                Toastify({
                    text: _0x2b3153,
                    duration: 1500,
                    backgroundColor: 'green'
                }).showToast();
                GetTickets();
                $('#viewticket-modal').modal('hide');
            }
        }
    });
}
function OpenTicket() {
    var _0x42b18c = $('#ticketsubject').val(), _0x210b32 = $('#ticketpriority').val(), _0x36fcfe = $('#ticketmessage').val();
    if (_0x42b18c == '' || _0x210b32 == '' || _0x36fcfe == '') {
        Toastify({
            text: 'Please fill all required fields!',
            duration: 1500,
            backgroundColor: 'red'
        }).showToast();
        return;
    }
    $.ajax({
        url: 'rest/tickets/open',
        type: 'post',
        data: {
            subject: _0x42b18c,
            priority: _0x210b32,
            msg: _0x36fcfe
        },
        cache: false,
        success: function (_0x4959ac) {
            const _0xd88b4e = JSON.parse(_0x4959ac);
            var _0xa90489 = _0xd88b4e.status, _0x11e9aa = _0xd88b4e.message;
            if (_0xa90489 == 'error') {
                Toastify({
                    text: _0x11e9aa,
                    duration: 1500,
                    backgroundColor: 'red'
                }).showToast();
                GetTickets();
            } else {
                Toastify({
                    text: _0x11e9aa,
                    duration: 1500,
                    backgroundColor: 'green'
                }).showToast();
                GetTickets();
                $('#openticket-modal').modal('hide');
            }
        }
    });
}
function OpenTicketModal() {
    $('#openticket-modal').modal('show');
}
function ViewTicket(_0x424f63) {
    var _0x25b5ac = _0x424f63;
    if (_0x25b5ac == '') {
        Toastify({
            text: 'TicketID is empty!',
            duration: 1500,
            backgroundColor: 'red'
        }).showToast();
        return;
    }
    $('#ticket-label').text('Ticket # ' + _0x25b5ac);
    $('#viewticket-modal').modal('show');
    $.ajax({
        url: 'rest/tickets/view',
        type: 'post',
        data: { ticketid: _0x25b5ac },
        cache: false,
        success: function (_0x112fa4) {
            document.getElementById('ticket-content').innerHTML = _0x112fa4;
        }
    });
    $('#reply-btn').attr('onclick', 'ReplyTicket(' + _0x25b5ac + ')');
    $('#closeticket-btn').attr('onclick', 'CloseTicket(' + _0x25b5ac + ')');
}
function ReplyTicket(_0xb097d2) {
    var _0x20d8d7 = _0xb097d2, _0x31b426 = $('#replyarea').val();
    if (_0x20d8d7 == '') {
        Toastify({
            text: 'TicketID is empty!',
            duration: 1500,
            backgroundColor: 'red'
        }).showToast();
        return;
    }
    if (_0x31b426 == '') {
        Toastify({
            text: 'Please fill all required fields!',
            duration: 1500,
            backgroundColor: 'red'
        }).showToast();
        return;
    }
    $.ajax({
        url: 'rest/tickets/reply',
        type: 'post',
        data: {
            ticketid: _0x20d8d7,
            reply: _0x31b426
        },
        cache: false,
        success: function (_0x5f2c46) {
            const _0x34014c = JSON.parse(_0x5f2c46);
            var _0xfc5840 = _0x34014c.status, _0x34aba8 = _0x34014c.message;
            if (_0xfc5840 == 'error') {
                Toastify({
                    text: _0x34aba8,
                    duration: 1500,
                    backgroundColor: 'red'
                }).showToast();
                GetTickets();
            } else {
                Toastify({
                    text: _0x34aba8,
                    duration: 1500,
                    backgroundColor: 'green'
                }).showToast();
                ViewTicket(_0x20d8d7);
                GetTickets();
            }
        }
    });
}
function GetTickets() {
    $('#tickets-table').DataTable({
        processing: true,
        serverSide: true,
        bFilter: false,
        serverMethod: 'post',
        responsive: true,
        language: { emptyTable: 'No active tickets' },
        ajax: {
            url: 'rest/tickets/get',
            type: 'POST'
        },
        columnDefs: [{
                className: 'text-center',
                targets: [
                    0,
                    1,
                    2
                ]
            }],
        bDestroy: true,
        columns: [
            { data: 'subject' },
            { data: 'status' },
            { data: 'created' }
        ]
    });
}
function StartL4Attack() {
    const _0x7a101c = document.getElementById('l4concs_num');
    var _0x21cbd1 = $('#l4host').val(), _0x204f7b = $('#l4time').val(), _0x181f48 = $('#l4port').val(), _0x443393 = $('#l4method').val(), _0x264e2e = _0x7a101c.textContent, _0x1f725d = $('#csrf_token').val();
    $('#l4_def').hide();
    $('#l4_loadi').show();
    $('#l4btn').prop('disabled', true);
    if (_0x21cbd1 == '' || _0x204f7b == '' || _0x181f48 == '' || _0x443393 == '' || _0x264e2e == '' || _0x1f725d == '' || _0x264e2e == '0') {
        Toastify({
            text: 'Please fill all required fields!',
            duration: 1500,
            backgroundColor: 'red'
        }).showToast();
        $('#l4_def').show();
        $('#l4_loadi').hide();
        $('#l4btn').prop('disabled', false);
        return;
    }
    $.ajax({
        url: 'rest/user/start?type=l4',
        type: 'post',
        data: {
            host: _0x21cbd1,
            time: _0x204f7b,
            port: _0x181f48,
            method: _0x443393,
            concs: _0x264e2e
        },
        cache: false,
        success: function (_0x376b9f) {
            const _0x4e4d58 = JSON.parse(_0x376b9f);
            var _0x39068b = _0x4e4d58.status, _0x5237a1 = _0x4e4d58.message;
            if (_0x39068b == 'error') {
                Toastify({
                    text: _0x5237a1,
                    duration: 1500,
                    backgroundColor: 'red'
                }).showToast();
            } else {
                Toastify({
                    text: _0x5237a1,
                    duration: 1500,
                    backgroundColor: 'green'
                }).showToast();
                GetAttacks();
            }
            $('#l4_def').show();
            $('#l4_loadi').hide();
            $('#l4btn').prop('disabled', false);
        }
    });
}
function StartL7Attack() {
    const _0x24303d = document.getElementById('l7concs_num');
    var _0x580d67 = $('#l7host').val(), _0x44f28d = $('#l7time').val(), _0x31bb41 = $('#l7reqmethod').val(), _0x340e22 = $('#l7method').val(), _0x1d5704 = $('#l7reqs').val(), _0x2079fc = $('#l7version').val(), _0x64a5d = $('#l7referrer').val(), _0xa6c8d7 = $('#l7cookies').val(), _0x2470af = $('#l7geo').val(), _0x35b5c = _0x24303d.textContent, _0x5ca1da = $('#csrf_token').val();
    $('#l7_def').hide();
    $('#l7_loadi').show();
    $('#l7btn').prop('disabled', true);
    if (_0x580d67 == '' || _0x44f28d == '' || _0x31bb41 == '' || _0x340e22 == '' || _0x35b5c == '' || _0x5ca1da == '' || _0x35b5c == '0' || _0x1d5704 == '' || _0x1d5704 == null) {
        Toastify({
            text: 'Please fill all required fields!',
            duration: 1500,
            backgroundColor: 'red'
        }).showToast();
        $('#l7_def').show();
        $('#l7_loadi').hide();
        $('#l7btn').prop('disabled', false);
        return;
    }
    $.ajax({
        url: 'rest/user/start?type=l7',
        type: 'post',
        data: {
            host: _0x580d67,
            time: _0x44f28d,
            reqmethod: _0x31bb41,
            method: _0x340e22,
            reqs: _0x1d5704,
            httpversion: _0x2079fc,
            referrer: _0x64a5d,
            cookies: _0xa6c8d7,
            geoloc: _0x2470af,
            concs: _0x35b5c
        },
        cache: false,
        success: function (_0x4c8cde) {
            const _0x5b44ca = JSON.parse(_0x4c8cde);
            var _0x3559f0 = _0x5b44ca.status, _0x268983 = _0x5b44ca.message;
            if (_0x3559f0 == 'error') {
                Toastify({
                    text: _0x268983,
                    duration: 1500,
                    backgroundColor: 'red'
                }).showToast();
                $('#l7_def').show();
                $('#l7_loadi').hide();
                $('#l7btn').prop('disabled', false);
            } else {
                Toastify({
                    text: _0x268983,
                    duration: 1500,
                    backgroundColor: 'green'
                }).showToast();
                GetAttacks();
                $('#l7_def').show();
                $('#l7_loadi').hide();
                $('#l7btn').prop('disabled', false);
            }
        }
    });
}
function CheckL7Method() {
    var _0x1c91bd = $('#l7method').val();
    if (_0x1c91bd != 'TLS1' || _0x1c91bd != 'TLS2') {
        $('#advanced-drop').hide();
        $('#advancedcoll').hide();
    } else {
        $('#advanced-drop').show();
    }
}
function StopAttack(_0x10ac25) {
    var _0x4c40ae = _0x10ac25;
    $('#stop_def').hide();
    $('#stop_loadi').show();
    $('#stopbtn').prop('disabled', true);
    if (_0x4c40ae == '') {
        Toastify({
            text: 'Attack ID is empty!',
            duration: 1500,
            backgroundColor: 'red'
        }).showToast();
    }
    $.ajax({
        url: 'rest/user/start?type=stop',
        type: 'post',
        data: { attackid: _0x4c40ae },
        cache: false,
        success: function (_0x2d8c57) {
            const _0x38893d = JSON.parse(_0x2d8c57);
            var _0x5525ed = _0x38893d.status, _0x214ca6 = _0x38893d.message;
            if (_0x5525ed == 'error') {
                Toastify({
                    text: _0x214ca6,
                    duration: 1500,
                    backgroundColor: 'red'
                }).showToast();
                $('#stop_def').show();
                $('#stop_loadi').hide();
                $('#stopbtn').prop('disabled', false);
                GetAttacks();
            } else {
                Toastify({
                    text: _0x214ca6,
                    duration: 1500,
                    backgroundColor: 'green'
                }).showToast();
                $('#stop_def').show();
                $('#stop_loadi').hide();
                $('#stopbtn').prop('disabled', false);
                GetAttacks();
            }
        }
    });
}
function StopAllAttacks() {
    $('#stopall_def').hide();
    $('#stopall_loadi').show();
    $('#stopallbtn').prop('disabled', true);
    $.ajax({
        url: 'rest/user/start?type=stopall',
        type: 'get',
        cache: false,
        success: function (_0x514786) {
            const _0x13f1fd = JSON.parse(_0x514786);
            var _0x46f428 = _0x13f1fd.status, _0x27b2ed = _0x13f1fd.message;
            if (_0x46f428 == 'error') {
                Toastify({
                    text: _0x27b2ed,
                    duration: 1500,
                    backgroundColor: 'red'
                }).showToast();
                $('#stopall_def').show();
                $('#stopall_loadi').hide();
                $('#stopallbtn').prop('disabled', false);
            } else {
                Toastify({
                    text: _0x27b2ed,
                    duration: 1500,
                    backgroundColor: 'green'
                }).showToast();
                $('#stopall_def').show();
                $('#stopall_loadi').hide();
                $('#stopallbtn').prop('disabled', false);
                GetAttacks();
            }
        }
    });
}
function CountAttackTime(_0x35f0f4, _0x52b1db) {
    var _0x566548 = setInterval(function () {
        if (_0x52b1db <= 0) {
            clearInterval(_0x566548);
            $('#expires-' + _0x35f0f4).html('Expired');
            GetAttacks();
        } else {
            $('#expires-' + _0x35f0f4).html(new Date(_0x52b1db * 1000).toISOString().substr(11, 8));
        }
        _0x52b1db -= 1;
    }, 1000);
}
function GetAttacks() {
    $('#attacks-table').DataTable({
        processing: true,
        serverSide: true,
        bFilter: false,
        serverMethod: 'post',
        responsive: true,
        language: { emptyTable: 'No running attacks' },
        ajax: {
            url: 'rest/user/attacks',
            type: 'POST'
        },
        columnDefs: [{
                className: 'text-center',
                targets: [
                    1,
                    2,
                    3,
                    4
                ]
            }],
        bDestroy: true,
        columns: [
            { data: 'id' },
            { data: 'target' },
            { data: 'method' },
            { data: 'expire' },
            { data: 'action' }
        ]
    });
}
function Deposit() {
    var _0x24664c = $('#depamount').val(), _0x2923de = $('#gateway').val();
    if (_0x24664c == '' || _0x2923de == '') {
        Toastify({
            text: 'Please fill all fields.',
            duration: 1500,
            backgroundColor: 'red'
        }).showToast();
    }
    $('#dep_def').hide();
    $('#dep_loadi').show();
    $('#depbtn').prop('disabled', true);
    $.ajax({
        url: 'rest/payment/create',
        type: 'post',
        data: {
            amount: _0x24664c,
            gateway: _0x2923de
        },
        cache: false,
        success: function (_0x2e4c50) {
            const _0x1080e6 = JSON.parse(_0x2e4c50);
            var _0x54f836 = _0x1080e6.status, _0x56acd7 = _0x1080e6.message;
            if (_0x54f836 == 'error') {
                Toastify({
                    text: _0x56acd7,
                    duration: 1500,
                    backgroundColor: 'red'
                }).showToast();
                $('#dep_def').show();
                $('#dep_loadi').hide();
                $('#depbtn').prop('disabled', false);
            } else {
                Toastify({
                    text: _0x56acd7,
                    duration: 1500,
                    backgroundColor: 'green'
                }).showToast();
                setTimeout(function () {
                    $('#qrimage').attr('src', _0x1080e6.qr);
                    $('#cryptocoin').val(_0x1080e6.coin);
                    $('#address').val(_0x1080e6.address);
                    $('#cryptoamount').val(_0x1080e6.amount);
                    $('#cryptoamountpaid').val(_0x1080e6.amount_paid);
                    $('#cryptoexpires').val(_0x1080e6.expires);
                    $('#cryptostatus').val(_0x1080e6.pstatus);
                    $('#cryptoconfirms').val(_0x1080e6.confirmations);
                    $('#cryptohash').val('Please pay to get hash');
                    $('#modal-label').text('Payment # ' + _0x1080e6.id);
                    $('#recheck-btn').attr('onclick', 'ReCheck(' + _0x1080e6.id + ')');
                    $('#cancel-btn').attr('onclick', 'CancelPayment(' + _0x1080e6.id + ')');
                    $('#payment-modal').modal('show');
                }, 1500);
                $('#dep_def').show();
                $('#dep_loadi').hide();
                $('#depbtn').prop('disabled', false);
                PaymentHistory();
            }
        }
    });
}
function PaymentHistory() {
    $('#billing-table').DataTable({
        processing: true,
        serverSide: true,
        bFilter: false,
        serverMethod: 'post',
        responsive: true,
        language: { emptyTable: 'No payment history' },
        ajax: {
            url: 'rest/user/payments',
            type: 'POST'
        },
        columnDefs: [{
                className: 'text-center',
                targets: [
                    1,
                    2,
                    3,
                    4,
                    5
                ]
            }],
        bDestroy: true,
        columns: [
            { data: 'id' },
            { data: 'type' },
            { data: 'amount' },
            { data: 'status' },
            { data: 'date' },
            { data: 'action' }
        ]
    });
}
function OpenPayment(_0x59e376) {
    var _0x56d5d2 = _0x59e376;
    $.ajax({
        url: 'rest/payment/info',
        type: 'post',
        data: { payid: _0x56d5d2 },
        cache: false,
        success: function (_0x28aaac) {
            const _0x42b9e0 = JSON.parse(_0x28aaac);
            var _0xf7d9e5 = _0x42b9e0.status, _0x53aa57 = _0x42b9e0.message;
            if (_0xf7d9e5 == 'error') {
                Toastify({
                    text: _0x53aa57,
                    duration: 1500,
                    backgroundColor: 'red'
                }).showToast();
            } else {
                $('#qrimage').attr('src', _0x42b9e0.qr);
                $('#cryptocoin').val(_0x42b9e0.coin);
                $('#address').val(_0x42b9e0.address);
                $('#cryptoamount').val(_0x42b9e0.amount);
                $('#cryptoamountpaid').val(_0x42b9e0.amount_paid);
                $('#cryptoexpires').val(_0x42b9e0.expires);
                $('#cryptostatus').val(_0x42b9e0.pstatus);
                $('#cryptoconfirms').val(_0x42b9e0.confirmations);
                $('#cryptohash').val(_0x42b9e0.hash);
                $('#modal-label').text('Payment # ' + _0x42b9e0.id);
                $('#recheck-btn').attr('onclick', 'ReCheck(' + _0x42b9e0.id + ')');
                $('#cancel-btn').attr('onclick', 'CancelPayment(' + _0x42b9e0.id + ')');
                $('#payment-modal').modal('show');
            }
        }
    });
}
function ReCheck(_0x578c32) {
    var _0x3ef45a = _0x578c32;
    $('#recheck_def').hide();
    $('#recheck_loadi').show();
    $('#recheck-btn').prop('disabled', true);
    $.ajax({
        url: 'rest/payment/info',
        type: 'post',
        data: { payid: _0x3ef45a },
        cache: false,
        success: function (_0x492163) {
            const _0x1c620f = JSON.parse(_0x492163);
            var _0x544770 = _0x1c620f.status, _0x1160ce = _0x1c620f.message;
            if (_0x544770 == 'error') {
                Toastify({
                    text: _0x1160ce,
                    duration: 1500,
                    backgroundColor: 'red'
                }).showToast();
                $('#recheck_def').show();
                $('#recheck_loadi').hide();
                $('#recheck-btn').prop('disabled', false);
            } else {
                Toastify({
                    text: 'Payment successfully re-checked.',
                    duration: 1500,
                    backgroundColor: 'green'
                }).showToast();
                $('#qrimage').attr('src', _0x1c620f.qr);
                $('#cryptocoin').val(_0x1c620f.coin);
                $('#address').val(_0x1c620f.address);
                $('#cryptoamount').val(_0x1c620f.amount);
                $('#cryptoamountpaid').val(_0x1c620f.amount_paid);
                $('#cryptoexpires').val(_0x1c620f.expires);
                $('#cryptostatus').val(_0x1c620f.pstatus);
                $('#cryptoconfirms').val(_0x1c620f.confirmations);
                $('#cryptohash').val(_0x1c620f.hash);
                $('#recheck_def').show();
                $('#recheck_loadi').hide();
                $('#recheck-btn').prop('disabled', false);
            }
        }
    });
}
function CancelPayment(_0x5caa91) {
    var _0x49c577 = _0x5caa91;
    if (_0x49c577 == '') {
        Toastify({
            text: 'Payment ID is empty.',
            duration: 1500,
            backgroundColor: 'red'
        }).showToast();
        return;
    }
    $('#cancelpay_def').hide();
    $('#cancelpay_loadi').show();
    $('#cancel-btn').prop('disabled', true);
    $.ajax({
        url: 'rest/payment/cancel',
        type: 'post',
        data: { payid: _0x49c577 },
        cache: false,
        success: function (_0x7a18f6) {
            const _0x2598e8 = JSON.parse(_0x7a18f6);
            var _0x28651f = _0x2598e8.status, _0x491513 = _0x2598e8.message;
            if (_0x28651f == 'error') {
                Toastify({
                    text: _0x491513,
                    duration: 1500,
                    backgroundColor: 'red'
                }).showToast();
                $('#cancelpay_def').show();
                $('#cancelpay_loadi').hide();
                $('#cancel-btn').prop('disabled', false);
            } else {
                Toastify({
                    text: _0x491513,
                    duration: 1500,
                    backgroundColor: 'green'
                }).showToast();
                $('#payment-modal').modal('hide');
                PaymentHistory();
                $('#cancelpay_def').show();
                $('#cancelpay_loadi').hide();
                $('#cancel-btn').prop('disabled', false);
            }
        }
    });
}
function copyaddr() {
    $('#address').prop('disabled', false);
    $('#address').select();
    document.execCommand('copy');
    Toastify({
        text: 'Address successfully copied to clipboard.',
        duration: 1500,
        backgroundColor: 'green'
    }).showToast();
    $('#address').prop('disabled', true);
}
function copyamount() {
    $('#cryptoamount').prop('disabled', false);
    $('#cryptoamount').select();
    document.execCommand('copy');
    Toastify({
        text: 'Amount successfully copied to clipboard.',
        duration: 1500,
        backgroundColor: 'green'
    }).showToast();
    $('#cryptoamount').prop('disabled', true);
}
function openhash() {
    var _0x192c09 = $('#cryptohash').val(), _0x4555ab = 'https://mempool.space/tx/' + _0x192c09 + '';
    window.open(_0x4555ab, '_blank');
}
function PurchasePlan(_0x5001a7) {
    var _0x27281b = _0x5001a7.id, _0x44c3b3 = _0x5001a7.name;
    $('#purchasemodal-label').text('Purchasing - ' + _0x44c3b3);
    $('#purchase-modal').modal('show');
    PlanInfo(_0x27281b);
    $('#purchase-btnnnn').attr('onclick', 'BuyPlan(' + _0x27281b + ')');
}
function BuyPlan(_0x59a564) {
    var _0xfadff1 = _0x59a564, _0x2d6fd7 = $('#couponcode2').val();
    $.ajax({
        url: 'rest/purchase/plan',
        type: 'post',
        data: {
            planid: _0xfadff1,
            coupon: _0x2d6fd7
        },
        cache: false,
        success: function (_0x1e234c) {
            const _0x42a7ed = JSON.parse(_0x1e234c);
            var _0x460649 = _0x42a7ed.status, _0x2a0e23 = _0x42a7ed.message;
            if (_0x460649 == 'error') {
                Toastify({
                    text: _0x2a0e23,
                    duration: 1500,
                    backgroundColor: 'red'
                }).showToast();
            } else {
                Toastify({
                    text: _0x2a0e23,
                    duration: 1500,
                    backgroundColor: 'green'
                }).showToast();
                setTimeout(function () {
                    window.location.href = 'home';
                }, 2000);
            }
        }
    });
}
function PlanInfo(_0x4d886b) {
    var _0x16da5c = _0x4d886b;
    $.ajax({
        url: 'rest/purchase/planinfo',
        type: 'post',
        data: { planid: _0x16da5c },
        cache: false,
        success: function (_0x11c533) {
            const _0x2cdda9 = JSON.parse(_0x11c533);
            var _0x1bee21 = _0x2cdda9.status, _0x4001f3 = _0x2cdda9.message;
            if (_0x1bee21 == 'error') {
                Toastify({
                    text: _0x4001f3,
                    duration: 1500,
                    backgroundColor: 'red'
                }).showToast();
            } else {
                $('#planconcs').text(_0x2cdda9.concs);
                $('#planatime').text(_0x2cdda9.time);
                $('#planlength').text(_0x2cdda9.length);
                $('#planpremium').text(_0x2cdda9.premium);
                $('#planapi').text(_0x2cdda9.api);
                $('#planprice').text(_0x2cdda9.price);
            }
        }
    });
}
function addon_price() {
    var _0x387f2b = document.getElementById('addonconcurrents');
    addon = _0x387f2b.value;
    total_concurrents = Number(0) + Number(addon);
    concurrents_price = Number(total_concurrents) * Number(15);
    current_price = concurrents_price;
    var _0x387f2b = document.getElementById('addonboottime');
    addon = _0x387f2b.value;
    if (addon == 0) {
        maxboot_increase = 0;
    }
    if (addon == 300) {
        maxboot_increase = 5;
    }
    if (addon == 600) {
        maxboot_increase = 10;
    }
    if (addon == 900) {
        maxboot_increase = 15;
    }
    if (addon == 1200) {
        maxboot_increase = 20;
    }
    if (addon == 1500) {
        maxboot_increase = 25;
    }
    if (addon == 1800) {
        maxboot_increase = 30;
    }
    if (addon == 2100) {
        maxboot_increase = 35;
    }
    if (addon == 2400) {
        maxboot_increase = 40;
    }
    if (addon == 2700) {
        maxboot_increase = 45;
    }
    if (addon == 3000) {
        maxboot_increase = 50;
    }
    var _0x4d4155 = maxboot_increase;
    maxboot_price = _0x4d4155;
    total_maxboot = addon;
    current_price = Number(maxboot_price) + Number(concurrents_price);
    var _0x4fc923 = document.getElementById('addonpremium');
    status = _0x4fc923.value;
    if (status == 0) {
        _0x4d4155 = 0;
    }
    if (status == 1) {
        _0x4d4155 = 20;
    }
    current_price = Number(current_price) + Number(_0x4d4155);
    var _0x25c446 = document.getElementById('addonblacklist');
    blacklist = _0x25c446.value;
    if (blacklist == 0) {
        increasebl = 0;
    }
    if (blacklist == 1) {
        increasebl = 10;
    }
    current_price = Number(current_price) + Number(increasebl);
    var _0x46fb6f = document.getElementById('addonapi');
    apiaccess = _0x46fb6f.value;
    if (apiaccess == 0) {
        increaseapi = 0;
    }
    if (apiaccess == 1) {
        increaseapi = 5;
    }
    total_amount = Number(current_price) + Number(increaseapi);
    var _0x2c1515 = Math.floor(total_amount);
    document.getElementById('price_total').value = _0x2c1515 + '$';
    document.getElementById('price').value = _0x2c1515;
    document.getElementById('concurrents_total').value = total_concurrents + 'c';
    document.getElementById('extraconcurrents').value = total_concurrents;
    document.getElementById('maxboot_total').value = total_maxboot + 's';
    document.getElementById('maxboot').value = total_maxboot;
    document.getElementById('premium').value = status;
    document.getElementById('blacklist').value = blacklist;
    document.getElementById('apiaccess').value = apiaccess;
}
function PurchaseAddon() {
    var _0x261e70 = $('#extraconcurrents').val(), _0x341c5c = $('#maxboot').val(), _0x11f157 = $('#premium').val(), _0x151de3 = $('#blacklist').val(), _0xb1942e = $('#apiaccess').val(), _0x2950a6 = $('#price').val(), _0x5f0ebf = $('#couponcodeaddon').val();
    $.ajax({
        url: 'rest/purchase/addon',
        type: 'post',
        data: {
            concs: _0x261e70,
            attacktime: _0x341c5c,
            premium: _0x11f157,
            blacklist: _0x151de3,
            apiaccess: _0xb1942e,
            price: _0x2950a6,
            coupon: _0x5f0ebf
        },
        cache: false,
        success: function (_0x1bea92) {
            const _0x5e0453 = JSON.parse(_0x1bea92);
            var _0x225a66 = _0x5e0453.status, _0x3a1155 = _0x5e0453.message;
            if (_0x225a66 == 'error') {
                Toastify({
                    text: _0x3a1155,
                    duration: 1500,
                    backgroundColor: 'red'
                }).showToast();
            } else {
                Toastify({
                    text: _0x3a1155,
                    duration: 1500,
                    backgroundColor: 'green'
                }).showToast();
                setTimeout(function () {
                    window.location.href = 'home';
                }, 2000);
            }
        }
    });
}
function SignOut() {
    Toastify({
        text: 'You are successfully signed out. Redirecting..',
        duration: 1000,
        destination: '../login.php',
        newWindow: false,
        close: false,
        gravity: 'top',
        position: 'right',
        stopOnFocus: true,
        style: { background: '#FFC700' }
    }).showToast();
    setTimeout(function () {
        window.location.replace('rest/user/logout');
    }, 1000);
}
function ClearNotifications() {
    Toastify({
        text: 'Notifications successfully cleared.',
        duration: 1000,
        newWindow: false,
        close: false,
        gravity: 'top',
        position: 'right',
        stopOnFocus: true,
        style: { background: '#FFC700' }
    }).showToast();
}
function ChangePass() {
    var _0xb7d305 = $('#currpassword').val(), _0x1be37f = $('#npassword').val(), _0x421c4f = $('#cpassword').val();
    if (_0x1be37f != _0x421c4f) {
        Toastify({
            text: 'Passwords do not match',
            duration: 1500,
            backgroundColor: 'red'
        }).showToast();
        return;
    }
    if (_0xb7d305 == '' || _0x1be37f == '' || _0x421c4f == '') {
        Toastify({
            text: 'Please fill all required fields',
            duration: 1500,
            backgroundColor: 'red'
        }).showToast();
        return;
    }
    $.ajax({
        url: 'rest/user/password',
        type: 'post',
        data: {
            currpass: _0xb7d305,
            newpass: _0x1be37f
        },
        cache: false,
        success: function (_0x35a1d4) {
            const _0x281431 = JSON.parse(_0x35a1d4);
            var _0x551280 = _0x281431.status, _0x14c882 = _0x281431.message;
            if (_0x551280 == 'error') {
                Toastify({
                    text: _0x14c882,
                    duration: 1500,
                    backgroundColor: 'red'
                }).showToast();
            } else {
                Toastify({
                    text: _0x14c882,
                    duration: 1500,
                    backgroundColor: 'green'
                }).showToast();
                setTimeout(function () {
                    location.reload();
                }, 2000);
            }
        }
    });
}
function DeleteAcc() {
    Swal.fire({
        title: 'Delete Account',
        html: '<input type="text" id="secret" class="swal2-input" placeholder="Secret key">',
        confirmButtonText: 'Confirm',
        focusConfirm: false,
        preConfirm: () => {
            const _0x55e073 = Swal.getPopup().querySelector('#secret').value;
            return { secret: _0x55e073 };
        }
    }).then(_0x5bae7e => {
        $.ajax({
            url: 'rest/user/delete',
            type: 'post',
            data: { secretkey: _0x5bae7e.value.secret },
            cache: false,
            success: function (_0xba6b2e) {
                const _0x58cc47 = JSON.parse(_0xba6b2e);
                var _0x57a5cf = _0x58cc47.status, _0x2cd28d = _0x58cc47.message;
                if (_0x57a5cf == 'error') {
                    Toastify({
                        text: _0x2cd28d,
                        duration: 1500,
                        backgroundColor: 'red'
                    }).showToast();
                } else {
                    Toastify({
                        text: _0x2cd28d,
                        duration: 1500,
                        backgroundColor: 'green'
                    }).showToast();
                    setTimeout(function () {
                        location.reload();
                    }, 2000);
                }
            }
        });
    });
}
var check = window.setInterval(function () {
    $.ajax({
        url: 'rest/user/check',
        type: 'get',
        cache: false,
        success: function (_0x4e028b) {
            const _0x2911cb = JSON.parse(_0x4e028b);
            var _0x50751b = _0x2911cb.status, _0x28d050 = _0x2911cb.message;
            if (_0x50751b == 'error') {
                Toastify({
                    text: _0x28d050,
                    duration: 1500,
                    backgroundColor: 'red'
                }).showToast();
                setTimeout(function () {
                    window.location.href = '../login';
                }, 1500);
            }
        }
    });
}, 10000);
const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]'), tooltipList = [...tooltipTriggerList].map(_0x413693 => new bootstrap.Tooltip(_0x413693));
document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('.spoiler').forEach(_0x17beb8 => {
        _0x17beb8.onclick = () => {
            if (_0x17beb8.classList.contains('spoiler-shown')) {
                _0x17beb8.classList.remove('spoiler-shown');
            } else {
                _0x17beb8.classList.add('spoiler-shown');
            }
        };
    });
}, false);