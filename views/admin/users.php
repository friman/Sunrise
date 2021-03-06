<!DOCTYPE html>
<html>
    <head>
        <? include("views/meta.php"); ?>

        <link href="<?= $GLOBALS['sr_root'] ?>/css/bootstrap.2.3.2.min.css" rel="stylesheet" media="screen">
        <link href="<?= $GLOBALS['sr_root'] ?>/css/bootstrap-responsive.min.css" rel="stylesheet" media="screen">
        <link href="<?= $GLOBALS['sr_root'] ?>/css/font-awesome.min.css" rel="stylesheet" media="screen">
        <link href="<?= $GLOBALS['sr_root'] ?>/css/header.css" rel="stylesheet" media="screen">
        <link href="<?= $GLOBALS['sr_root'] ?>/css/admin.css" rel="stylesheet" media="screen">
        <script src="<?= $GLOBALS['sr_root'] ?>/js/jquery-1.9.1.min.js"></script>
        <script src="<?= $GLOBALS['sr_root'] ?>/js/bootstrap.2.3.2.min.js"></script>
        <script src="<?= $GLOBALS['sr_root'] ?>/js/admin.js"></script>
        <script>
            $(document).ready(function () {
                $('#sr_filter > *').click(function () {
                    if (!$(this).attr('class').match('disabled')) {
                        setTimeout(function () { loadData('filter') }, 0);
                    }
                });
                $('#sr_page li').click(function () {
                    if ($(this).attr('class') != 'active' && $(this).attr('class') != 'disabled') {
                        loadData(this.id);
                    }
                });
            });
        </script>
        <style>
            #sr_filter {
                padding-top: 0px;
            }
            #sr_table {
                margin-bottom: 0px;
            }
            #sr_table * {
                text-align: center;
            }
            #sr_page {
                margin-top: 0px;
                margin-bottom: 5px;
            }
            #sr_page li {
                cursor: pointer;
            }
        </style>
    </head>
    <body>
        <? include("views/header00.php") ?>

        <!-- Side Menu Bar-->
        <div class="container-fluid">
            <div class="row-fluid">
                <div class="span3" id="sidebar">
                    <button class="btn-inverse btn-back" onclick="window.location='<?= $GLOBALS['sr_root'] ?>'"><i class="icon icon-mail-reply"></i> Back to Sunrise Main</button>
                    <ul class="nav nav-list bs-docs-sidenav nav-collapse collapse">
                        <li><a href="<?= $GLOBALS['sr_root'] ?>/d/admin/dashboard/"><i class="icon-chevron-right"></i> Dashboard</a></li>
                        <li><a href="<?= $GLOBALS['sr_root'] ?>/d/admin/rooms/"><i class="icon-chevron-right"></i> Rooms</a></li>
                        <li class="active"><a href="<?= $GLOBALS['sr_root'] ?>/d/admin/users/"><i class="icon-chevron-right"></i> Users</a></li>
                        <li><a href="<?= $GLOBALS['sr_root'] ?>/d/admin/settings/"><i class="icon-chevron-right"></i> Settings</a></li>
                    </ul>
                </div>
                <div class="span9" id="content">

                    <!-- Table -->
                    <div class="row-fluid section">
                        <div class="block">
                            <div class="navbar navbar-inner block-header">
                                <div class="muted pull-left">
                                    <h4>Registered Users</h4>
                                </div>
                                <div class="pull-right">
                                    <div class="btn-group" data-toggle="buttons-checkbox" id="sr_filter">
                                        <button class="btn btn-small btn-inverse disabled" disabled>Filter <i class="icon-check icon-white"></i></button>
                                        <button class="btn btn-small" id="filter_authorized">Authorize</button>
                                        <button class="btn btn-small" id="filter_admin">Admin</button>
                                    </div>
                                    <button class="btn btn-small btn-info disabled" id="record_number" disabled></button>
                                </div>
                            </div>
                            <div class="block-content collapse in">
                                <table class="table table-striped table-filter" id="sr_table">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>E-mail</th>
                                            <th>First Name</th>
                                            <th>Last Name</th>
                                            <th>Authorize</th>
                                            <th>Admin</th>
                                            <th>Join Date</th>
                                            <th>Last Active Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr id="tr0"> </tr>
                                        <tr id="tr1"> </tr>
                                        <tr id="tr2"> </tr>
                                        <tr id="tr3"> </tr>
                                        <tr id="tr4"> </tr>
                                        <tr id="tr5"> </tr>
                                        <tr id="tr6"> </tr>
                                        <tr id="tr7"> </tr>
                                        <tr id="tr8"> </tr>
                                        <tr id="tr9"> </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="navbar navbar-inner block-header">
                                <div class="pagination pagination-right" id="sr_page">
                                    <ul>
                                        <li id="begin"><a>&laquo;</a></li>
                                        <li id="prev"><a>&lsaquo;</a></li>
                                        <li id="1st"><a id="1st_a"></a></li>
                                        <li id="2nd"><a id="2nd_a"></a></li>
                                        <li id="3rd"><a id="3rd_a"></a></li>
                                        <li id="4th"><a id="4th_a"></a></li>
                                        <li id="5th"><a id="5th_a"></a></li>
                                        <li id="next"><a>&rsaquo;</a></li>
                                        <li id="end"><a>&raquo;</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <? include("views/footer00.php") ?>

        <!---------- Javascript ---------->
        <script>
            $.ajaxSetup({
                url: "<?= $GLOBALS['sr_root'] ?>/d/admin/fetch/",
                type: 'POST',
                error: function (jqXHR, textStatus, errorThrown) { alert('Ajax Error: ' + textStatus); },
            });

            function checkAuthorized() {
                var id = this.id;
                var isChecked = 'unchecked';

                $('#' + id + '_authorized').css('color', 'black');
                $('#' + id + '_authorized').attr('class', 'icon-spinner icon-spin');

                if (this.checked) {
                    isChecked = 'checked';
                }
                $.ajax({
                    data: { page: 'users', type: 'authorized', id: this.id, checked: isChecked },
                    success: function () {
                        $('#' + id + '_authorized').css('color', 'green');
                        $('#' + id + '_authorized').attr('class', 'icon-ok');
                        $('#' + id + '_authorized').fadeOut('slow', function() {
                            $('#' + id + '_authorized').attr('class', '');
                            $('#' + id + '_authorized').fadeIn('slow', function() {});
                        });
                    }
                });
            }

            function checkAdmin() {
                var id = this.id;
                var isChecked = 'unchecked';

                $('#' + id + '_admin').css('color', 'black');
                $('#' + id + '_admin').attr('class', 'icon-spinner icon-spin');

                if (this.checked) {
                    isChecked = 'checked';
                }
                $.ajax({
                    data: { page: 'users', type: 'admin', id: this.id, checked: isChecked },
                    success: function () {
                        $('#' + id + '_admin').css('color', 'green');
                        $('#' + id + '_admin').attr('class', 'icon-ok');
                        $('#' + id + '_admin').fadeOut('slow', function() {
                            $('#' + id + '_admin').attr('class', '');
                            $('#' + id + '_admin').fadeIn('slow', function() {});
                        });
                    }
                });
            }

            function loadData(selected_btn) {
                var id = '';
                var pnum = '';

                var filter_arr = new Object();

                if ($('#filter_admin').attr('class').match('active')) {
                    filter_arr['is_admin'] = '1';
                }
                if ($('#filter_authorized').attr('class').match('active')) {
                    filter_arr['is_authorized'] = '1';
                }

                switch (selected_btn) {
                case 'begin':
                    pnum = Number('1');
                    break;
                case 'prev':
                    id = $('#sr_page li.active').attr('id'); 
                    pnum = Number($('#' + id + '_a').text()) - 1;
                    break;
                case 'next':
                    id = $('#sr_page li.active').attr('id'); 
                    pnum = Number($('#' + id + '_a').text()) + 1;
                    break;
                case 'end':
                    pnum = Number('-1');
                    break;
                case 'filter':
                    pnum = Number('1');
                    break;
                default:
                    pnum = Number($('#' + selected_btn + '_a').text());
                    break;
                }

                $.ajax({
                    data: { page: 'users',
                            type: 'pagination',
                            filter: JSON.stringify(filter_arr),
                            page_number: pnum
                    },
                    dataType: 'JSON',
                    success: function (data) {
                        if (selected_btn == 'end') {
                            pnum = parseInt(data['total_record_number'] / 10 + 1);
                        }
                        updateTable(data['user_list']);
                        updatePage(pnum, data['total_record_number']);
                    }
                });
            }

            function updateTable(user_list) {
                var id = '';
                var temp = '';
                var tags = '';
                var indexNum = 0;
                var checkbox = '<input type="checkbox" ';

                $.each(user_list, function(index, user) {
                    id = '';
                    tags = '';

                    $.each(user, function(key, val) {
                        if (key != 'password') {
                            switch (key) {
                            case 'is_authorized':
                                temp = checkbox;
                                temp += 'class="authorized" id="' + id + '" ';
                                if (val == '1') temp += 'checked '; 
                                temp += '/>';
                                val = temp;
                                val += ' <i id="' + id + '_authorized"></i>';
                                break;
                            case 'is_admin':
                                temp = checkbox;
                                temp += 'class="admin" id="' + id + '" ';
                                if (val == '1') temp += 'checked '; 
                                temp += '/>';
                                val = temp;
                                val += ' <i id="' + id + '_admin"></i>';
                                break;
                            case 'id':
                                id = val;
                                break;
                            }
                            tags += '<td>' + val + '</td>';
                            indexNum++;
                        }
                    });
                    $('#tr' + index).html(tags);
                });

                indexNum /= user_list.length;

                if (user_list.length < 10) {
                    tags = '<td>-</td>';
                    for (var i = 0; i < indexNum-1; i++) {
                        tags += '<td></td>';
                    }
                    for (var i = user_list.length; i < 10; i++) {
                        $('#tr' + i).html(tags);
                    }
                }

                $('.authorized').click(checkAuthorized);
                $('.admin').click(checkAdmin);
            }

            function updatePage(current_page, total_record_number) {
                var last_page = parseInt(total_record_number / 10 + 1);
                var first_page_in_view = parseInt((current_page - 1) / 5) * 5 + 1;
                var selected_button = (current_page - 1) % 5 + 1;

                var ordinal = [ '', '1st', '2nd', '3rd', '4th', '5th' ];

                $('#record_number').html('Total: ' + total_record_number);

                for (var btn = 1; btn <= 5; btn++) {
                    $('#' + ordinal[btn] + '_a').text(first_page_in_view + btn - 1);
                }

                $('#sr_page li').attr('class', '');
                $('#' + ordinal[selected_button]).attr('class', 'active');

                if (current_page == 1) {
                    $('#begin, #prev').attr('class', 'disabled');
                } else {
                    $('#begin, #prev').attr('class', '');
                }

                if (current_page == last_page) {
                    $('#next, #end').attr('class', 'disabled');
                } else {
                    $('#next, #end').attr('class', '');
                }

                if (last_page - first_page_in_view < 4) {
                    for (var btn = (last_page - 1) % 5 + 2; btn <= 5; btn++) {
                        $('#' + ordinal[btn]).attr('class', 'disabled');
                    }
                }
            }

            // Initialize table
            updateTable(<?= json_encode($context['user_list']) ?>);
            updatePage(1, <?= User::getRecordNum(array()) ?>);
        </script>
    </body>
</html>
