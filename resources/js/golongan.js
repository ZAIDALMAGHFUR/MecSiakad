(function () {
    console.log('[GOLONGAN.JS IS RENDER]');

    /**
     * for handle function toast
     * show sukses informnation blablabla
     */
    function isSuccessToast(strValue) {
        const _opt = {
            showDuration: 300,
            hideDuration: 900,
            timeOut: 900,
            closeButton: true,
            newestOnTop: true,
            progressBar: true,
            onHidden: function() {
                window.location.reload();
            },
        };

        toastr.success(strValue, 'Wohoooo!', _opt);
    }

    /**
     * This is function for handle golongan add form submit
     * methd post
     */
    function golonganOnSavehandler() {
        const formGolongan = $('form#saveGolongan');
        formGolongan.on("submit", function(event) {
            event.preventDefault();

            const _this = $(this);

            // Diasbled btn on submit
            let btnSubmit = _this.find('button[type=submit]');
            btnSubmit.prop('disabled', true);

            $.ajax({
                type: _this.attr('method'),
                data: _this.serialize(),
                url: _this.attr('action'),
                dataType: 'json',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                },
                success: function(data) {
                    isSuccessToast(data.success);
                },
                error: function(data) {
                    btnSubmit.prop('disabled', false);
                    // let errors = data.responseJSON.errors;
                    let errorsHtml = '';
                    $.each(errors, function(_key, value) {
                        errorsHtml += '<p>- ' + value[0] + '</p>';
                    });
                    toastr.error(errorsHtml, 'Whoops!');
                    console.log(errors);
                }
            });
        });
    }

    /**
     * Action handler
     */
    function actionHandler() {
        const actionDelete = $('form[id="actionDelete"]');

        /**
         * Modal show edit golongan
         */
        function modalShowEditGolongan(data) {
            const editGolongan = $('#editGolongan');
            editGolongan.find('#id').val(data.id);
            editGolongan.find('#nama_kegiatan').val(data.nama_kegiatan);
            editGolongan.find('#jenis_kegiatan').val(data.jenis_kegiatan);
            editGolongan.find('#tgl_mulai').val(data.tgl_mulai);
            editGolongan.find('#tgl_akhir').val(data.tgl_akhir);
            editGolongan.modal('show');
        }

        /**
         * Delete action submit
         */
        $(actionDelete)
            .find('a#delete')
            .on('click', function (event) {
                event.preventDefault();
                const currentForm = $(this).parent().get(0);
                currentForm.submit();
            });

        /**
         * handler post update
         */
        function updateHandler(data) {
            const updateForm = $('form[id="dataGolongan"]');
            updateForm.on('submit', function(event) {
                event.preventDefault();
                const _this = $(this);
                const btnSubmit = _this.find('button[type="submit"]');
                btnSubmit.prop('disabled', true);

                $.ajax({
                    type: _this.attr('method'),
                    data: _this.serialize(),
                    url: _this.attr('action') + "/" + data.id,
                    dataType: 'json',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(data) {
                        isSuccessToast(data.success);
                    },
                    error: function(data) {
                        btnSubmit.prop('disabled', false);
                        let errors = data.responseJSON.errors;
                        let errorsHtml = '';
                        $.each(errors, function(_key, value) {
                            errorsHtml += '<p>- ' + value[0] + '</p>';
                        });
                        toastr.error(errorsHtml, 'Whoops!');
                    },
                });
            });
        }

        /**
         * Show edit data
         */
        function editHandler() {
            $(actionDelete.find('a#edit'))
                .on('click', function(event) {
                    event.preventDefault();
                    const _this = $(this);
                    $.ajax({
                        url: _this.attr('href'),
                        type: 'GET',
                        dataType: 'json',
                        success: function(data) {
                            updateHandler(data);
                            modalShowEditGolongan(data);
                        },
                        error: function () {
                            alert('Something error');
                        },
                    });
                });
        }

        editHandler();
    }

    /**
     * Run app on dokumen ready
     */
    $(document).ready(function() {
        golonganOnSavehandler();
        actionHandler();
    });
})();
