$('#preloader').fadeOut(1200);
GetActiveTickets();
AllTickets();
function GetActiveTickets() {
    $('#activetickets-table').DataTable({
        processing: true,
        serverSide: true,
        bFilter: false,
        sPaginationType: 'full_numbers',
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
                    1,
                    2,
                    3,
                    4
                ]
            }],
        bDestroy: true,
        columns: [
            { data: 'id' },
            { data: 'title' },
            { data: 'priority' },
            { data: 'user' },
            { data: 'action' }
        ]
    });
}
function ViewTicket(_0x1d78b2) {
    var _0x4391ed = _0x1d78b2;
    if (_0x4391ed == '') {
        Toastify({
            text: 'TicketID is empty!',
            duration: 1500,
            backgroundColor: 'red'
        }).showToast();
        return;
    }
    $('#ticket-label').text('Ticket # ' + _0x4391ed);
    $('#viewticket-modal').modal('show');
    $.ajax({
        url: 'rest/tickets/view',
        type: 'post',
        data: { ticketid: _0x4391ed },
        cache: false,
        success: function (_0x7a173b) {
            document.getElementById('ticket-content').innerHTML = _0x7a173b;
        }
    });
    $('#reply-btn').attr('onclick', 'ReplyTicket(' + _0x4391ed + ')');
    $('#closeticket-btn').attr('onclick', 'CloseTicket(' + _0x4391ed + ')');
}
function CloseTicket(_0x1562e3) {
    var _0x15cc35 = _0x1562e3;
    if (_0x15cc35 == '') {
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
        data: { ticketid: _0x15cc35 },
        cache: false,
        success: function (_0x5aceca) {
            const _0x526a37 = JSON.parse(_0x5aceca);
            var _0x113d50 = _0x526a37.status, _0x3217f3 = _0x526a37.message;
            if (_0x113d50 == 'error') {
                Toastify({
                    text: _0x3217f3,
                    duration: 1500,
                    backgroundColor: 'red'
                }).showToast();
                GetActiveTickets();
            } else {
                Toastify({
                    text: _0x3217f3,
                    duration: 1500,
                    backgroundColor: 'green'
                }).showToast();
                GetActiveTickets();
            }
        }
    });
}
function ReplyTicket(_0x3e0dbe) {
    var _0xdb314e = _0x3e0dbe, _0x5bbd7c = $('#replyarea').val();
    if (_0xdb314e == '') {
        Toastify({
            text: 'TicketID is empty!',
            duration: 1500,
            backgroundColor: 'red'
        }).showToast();
        return;
    }
    if (_0x5bbd7c == '') {
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
            ticketid: _0xdb314e,
            reply: _0x5bbd7c
        },
        cache: false,
        success: function (_0x5e8948) {
            const _0x4f368f = JSON.parse(_0x5e8948);
            var _0x338d88 = _0x4f368f.status, _0x108d53 = _0x4f368f.message;
            if (_0x338d88 == 'error') {
                Toastify({
                    text: _0x108d53,
                    duration: 1500,
                    backgroundColor: 'red'
                }).showToast();
                GetActiveTickets();
            } else {
                Toastify({
                    text: _0x108d53,
                    duration: 1500,
                    backgroundColor: 'green'
                }).showToast();
                GetActiveTickets();
                $('#viewticket-modal').modal('hide');
            }
        }
    });
}
function AllTickets() {
    $('#alltickets-table').DataTable({
        processing: true,
        serverSide: true,
        sPaginationType: 'full_numbers',
        serverMethod: 'post',
        responsive: true,
        language: { emptyTable: 'No tickets' },
        ajax: {
            url: 'rest/tickets/getall',
            type: 'POST'
        },
        columnDefs: [{
                className: 'text-center',
                targets: [
                    0,
                    1,
                    2,
                    3,
                    4,
                    5
                ]
            }],
        bDestroy: true,
        columns: [
            { data: 'user' },
            { data: 'subject' },
            { data: 'status' },
            { data: 'priority' },
            { data: 'created' },
            { data: 'action' }
        ]
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
        window.location.replace('rest/admin/logout');
    }, 1000);
}