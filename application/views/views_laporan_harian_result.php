<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Bot Telegram
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-tv"></i> Dashboard</a></li>
            <li class="active">Bot Telegram</li>
        </ol>
    </section>

    <section class="content">

        <div class="box box-success">
            <div class="box-header with-border">
                <div class="box-tools pull-left">
                    <a href="#" class="btn btn-sm btn-success">EXPORT</a>
                    <button type="button" class="btn btn-default btn-sm" value="Refresh" onClick="document.location.reload(true)"><i class="fa fa-refresh"></i></button>
                </div>

                <div class="box-tools">
                    <form action="<?= base_url('menu') ?>" method="POST">
                        <div class="input-group input-group-sm" style="width: 180px;">
                            <input type="text" name="keyword" class="form-control pull-right" placeholder="Search">
                            <div class="input-group-btn">
                                <input type="submit" class="btn btn-success" name="submit" value="Search">
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div class="box-body" style="margin-top:-5px ;">
                <div class="row">
                    <div class="col-md-12">

                        <div class="panel panel-body">
                            Hi, data Anda berhasil diinput!<br /><br />
                            <form id="telegramForm" method="POST">
                                <input id="telegram_id" class="form-control" name="chat_id" type="hidden" value="-673449738" />
                                <input class="form-control" name="text" type="hidden" value='*Debitur*<?php echo "\n"; ?><?php echo "AHMAD ZAENUDIN BIN H ABDUL ROHMAN"; ?><?php echo "\n\n"; ?>*Petugas*<?php echo "\n"; ?><?php echo "Zulfadli Rizal"; ?><?php echo "\n\n"; ?>*Pelaksanaan* <?php echo "\n"; ?><?php echo $this->input->post('nama'); ?><?php echo "\n\n"; ?>*Hasil*<?php echo "\n"; ?><?php echo $this->input->post('sales'); ?><?php echo "\n\n"; ?>*Catatan KSK*<?php echo "\n"; ?><?php echo "Lanjutkan penanganan dan kembali lagi besok"; ?>' />
                                <br />
                                <button id="sendToGroup" class="btn btn-primary" type="submit">Posting ke Group</button>
                            </form>

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<footer class="main-footer">
    <div style="text-align:center ;">
        <?= $site['footer']; ?>
    </div>
</footer>

<div class="modal fade" id="modal-logout">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Ready to Leave?</h4>
            </div>
            <div class="modal-body">
                <p>Select "Logout" below if you are ready to end your current session.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                <a href="<?= base_url('auth/logout'); ?>" class="btn btn-success">Logout</a>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<!-- JavaScript -->
<script src="<?= base_url('assets/vendor/'); ?>jquery/dist/jquery.min.js"></script>
<script src="<?= base_url('assets/vendor/'); ?>bootstrap/dist/js/bootstrap.min.js"></script>
<script src="<?= base_url('assets/vendor/'); ?>jquery-slimscroll/jquery.slimscroll.min.js"></script>
<script src="<?= base_url('assets/vendor/'); ?>fastclick/lib/fastclick.js"></script>
<script src="<?= base_url('assets/vendor/'); ?>chart.js/Chart.js"></script>
<script src="<?= base_url('assets/'); ?>dist/js/adminlte.min.js"></script>
<script src="<?= base_url('assets/'); ?>dist/js/demo.js"></script>
<script src="<?= base_url('assets/vendor/'); ?>sweetalert2/sweetalert2.all.min.js"></script>
<script src="<?= base_url('assets/'); ?>js/myalert.js"></script>

<!-- Select2 -->
<script src="<?= base_url('assets/vendor/'); ?>select2/dist/js/select2.full.min.js"></script>

<script>
    $(function() {
        $('.select2').select2();
        $('#select2').select2();
    })
</script>
<script>
    $(document).ready(function() {
        $('.sidebar-menu').tree()
    })
</script>

<script>
    setTimeout(function() {
        $('.loader_bg').fadeToggle();
    }, 500);
</script>

<script type='text/javascript'>
    //<![CDATA[
    shortcut = {
        all_shortcuts: {},
        add: function(a, b, c) {
            var d = {
                type: "keydown",
                propagate: !1,
                disable_in_input: !1,
                target: document,
                keycode: !1
            };
            if (c)
                for (var e in d) "undefined" == typeof c[e] && (c[e] = d[e]);
            else c = d;
            d = c.target, "string" == typeof c.target && (d = document.getElementById(c.target)), a = a.toLowerCase(), e = function(d) {
                d = d || window.event;
                if (c.disable_in_input) {
                    var e;
                    d.target ? e = d.target : d.srcElement && (e = d.srcElement), 3 == e.nodeType && (e = e.parentNode);
                    if ("INPUT" == e.tagName || "TEXTAREA" == e.tagName) return
                }
                d.keyCode ? code = d.keyCode : d.which && (code = d.which), e = String.fromCharCode(code).toLowerCase(), 188 == code && (e = ","), 190 == code && (e = ".");
                var f = a.split("+"),
                    g = 0,
                    h = {
                        "`": "~",
                        1: "!",
                        2: "@",
                        3: "#",
                        4: "$",
                        5: "%",
                        6: "^",
                        7: "&",
                        8: "*",
                        9: "(",
                        0: ")",
                        "-": "_",
                        "=": "+",
                        ";": ":",
                        "'": '"',
                        ",": "<",
                        ".": ">",
                        "/": "?",
                        "\\": "|"
                    },
                    i = {
                        esc: 27,
                        escape: 27,
                        tab: 9,
                        space: 32,
                        "return": 13,
                        enter: 13,
                        backspace: 8,
                        scrolllock: 145,
                        scroll_lock: 145,
                        scroll: 145,
                        capslock: 20,
                        caps_lock: 20,
                        caps: 20,
                        numlock: 144,
                        num_lock: 144,
                        num: 144,
                        pause: 19,
                        "break": 19,
                        insert: 45,
                        home: 36,
                        "delete": 46,
                        end: 35,
                        pageup: 33,
                        page_up: 33,
                        pu: 33,
                        pagedown: 34,
                        page_down: 34,
                        pd: 34,
                        left: 37,
                        up: 38,
                        right: 39,
                        down: 40,
                        f1: 112,
                        f2: 113,
                        f3: 114,
                        f4: 115,
                        f5: 116,
                        f6: 117,
                        f7: 118,
                        f8: 119,
                        f9: 120,
                        f10: 121,
                        f11: 122,
                        f12: 123
                    },
                    j = !1,
                    l = !1,
                    m = !1,
                    n = !1,
                    o = !1,
                    p = !1,
                    q = !1,
                    r = !1;
                d.ctrlKey && (n = !0), d.shiftKey && (l = !0), d.altKey && (p = !0), d.metaKey && (r = !0);
                for (var s = 0; k = f[s], s < f.length; s++) "ctrl" == k || "control" == k ? (g++, m = !0) : "shift" == k ? (g++, j = !0) : "alt" == k ? (g++, o = !0) : "meta" == k ? (g++, q = !0) : 1 < k.length ? i[k] == code && g++ : c.keycode ? c.keycode == code && g++ : e == k ? g++ : h[e] && d.shiftKey && (e = h[e], e == k && g++);
                if (g == f.length && n == m && l == j && p == o && r == q && (b(d), !c.propagate)) return d.cancelBubble = !0, d.returnValue = !1, d.stopPropagation && (d.stopPropagation(), d.preventDefault()), !1
            }, this.all_shortcuts[a] = {
                callback: e,
                target: d,
                event: c.type
            }, d.addEventListener ? d.addEventListener(c.type, e, !1) : d.attachEvent ? d.attachEvent("on" + c.type, e) : d["on" + c.type] = e
        },
        remove: function(a) {
            var a = a.toLowerCase(),
                b = this.all_shortcuts[a];
            delete this.all_shortcuts[a];
            if (b) {
                var a = b.event,
                    c = b.target,
                    b = b.callback;
                c.detachEvent ? c.detachEvent("on" + a, b) : c.removeEventListener ? c.removeEventListener(a, b, !1) : c["on" + a] = !1
            }
        }
    }, shortcut.add("Ctrl+U", function() {
        top.location.href = "<?= base_url('blocked'); ?>"
    });
    //]]>
</script>

<script>
    document.addEventListener("contextmenu", function(e) {
        e.preventDefault();
    }, false);
</script>

<script>
    $(document).on('click', '#sendToGroup', function(e) {
        SwalTelegram();
        e.preventDefault();
    });

    function SwalTelegram() {
        if ($("#telegram_id").val()) {
            Swal.fire({
                title: 'Posting ke group?',
                text: "Pastikan Laporan anda sudah benar",
                type: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3FC3EE',
                cancelButtonColor: '#E91E63',
                confirmButtonText: 'Ya!',
                showLoaderOnConfirm: true,

                preConfirm: function() {
                    return new Promise(function(resolve) {
                        $.ajax({
                                url: 'https://api.telegram.org/bot5985445229:AAETSRh7-wLoUf1W9MgOt-6Lt_MXx6RmRj8/sendMessage?parse_mode=Markdown',
                                type: 'POST',
                                data: $('#telegramForm').serialize(),
                                dataType: 'html'
                            })
                            .done(function(response) {
                                Swal.fire({
                                    title: "Sukses!",
                                    html: "Silahkan laporan berhasil dikirim",
                                    type: "success",
                                    allowOutsideClick: false,
                                    timer: 1500,
                                    showConfirmButton: false,
                                    animation: false,
                                    customClass: 'animated jackInTheBox',
                                })
                            })
                            .fail(function() {
                                Swal.fire('Oops...', 'Ada kesalahan &#x2639;&#xfe0f;', 'error');
                            });
                    });
                },
                allowOutsideClick: false
            });
        } else {
            Swal.fire({
                title: "Warning!",
                html: "Ooops ada kesalahan system!",
                type: "warning",
                allowOutsideClick: false,
                timer: 3000,
                showConfirmButton: false
            });
        }
    }
</script>

</body>

</html>