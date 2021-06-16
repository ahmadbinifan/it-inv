<script>
    $(document).ready(function() {
        function change() {
            Swal.fire({
                title: 'Update Password',
                html: '<label>Current Password</label>' +
                    '<input id="current_password" type="text" class="swal2-input" />' +
                    '<label>New Password</label>' +
                    '<input id="new_password1" type="text" class="swal2-input" />' +
                    '<label>Confirm Password</label>' +
                    '<input id="newpassword2" type="text" class="swal2-input" />',
                focusConfirm: false,
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'Create',
                cancelButtonText: 'Cancel',
                cancelButtonColor: '#d33',
            }).then(function(result) {
                if (result.value) {
                    let current_password = $('#current_password').val();
                    let new_password1 = $('#new_password1').val();
                    let new_password2 = $('#new_password2').val();
                    $.ajax({
                        url: "<?= base_url('account/update') ?>",
                        method: "post",
                        dataType: "json",
                        data: {

                        },
                        success: function(data) {
                            Swal.fire(
                                'Success!',
                                'Data has been created!',
                                'success'
                            )
                            currencyTable.ajax.reload();
                        }
                    })
                }
            });
        }
    });

    function create() {
        Swal.fire({
            title: 'Update Password',
            html: '<label>Current Password</label>' +
                '<input id="current_password" type="text" class="swal2-input" />' +
                '<label>New Password</label>' +
                '<input id="newPassword1" type="password" class="swal2-input" />' +
                '<label>Confirm Password</label>' +
                '<input id="newPassword2" type="password" class="swal2-input" />',
            focusConfirm: false,
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'Update',
            cancelButtonText: 'Cancel',
            cancelButtonColor: '#d33',
        }).then(function(result) {
            if (result.value) {
                let current_password = $('#current_password').val();
                let newPassword1 = $('#newPassword1').val();
                let newPassword2 = $('#newPassword2').val();
                $.ajax({
                    url: "<?= base_url('account/changePass') ?>",
                    method: "post",
                    dataType: "json",
                    data: {
                        id: id_user,
                    },
                    success: function(data) {
                        Swal.fire(
                            'Success!',
                            'Data has been created!',
                            'success'
                        )
                        window.reload();
                    }
                })
            }
        });
    }

    function changeNik() {
        Swal.fire({
            title: 'Update Nik',
            text: "Fill in the form properly ",
            html: '<label>Please input Nik</label>' +
                '<input id="nik" type="text" class="form-control" style="z-index:999"/>',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Confirm'
        }).then((result) => {
            let nik = $('#nik').val();
            if (result.isConfirmed) {
                $.ajax({
                    url: "<?= base_url('account/updateNik') ?>",
                    method: "post",
                    dataType: "json",
                    data: {
                        nik: nik
                    },
                    success: function(data) {
                        Swal.fire({
                            position: 'center',
                            icon: 'success',
                            title: 'Complete',
                            footer: "This nik will be Update"
                        }).then(function() {
                            $('#modalDetail').modal('hide');
                            window.location.href = "<?= base_url('auth/logout') ?>";
                        });
                    },
                    error: function(e) {
                        console.log(e);
                    }
                })
            }
        })
    }

    function changePw() {
        Swal.fire({
            title: '',
            html: '<label>Masukan Password Lama</label>' +
                '<input id="current_password" type="password" class="swal2-input">',
            focusConfirm: false,
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'Selanjutnya',
            cancelButtonText: 'Batal',
            cancelButtonColor: '#d33',
        }).then(function(result) {
            if (result.value) {
                let curren_password = $('#current_password').val();
                $.ajax({
                    url: "<?= base_url('account/cekAkun') ?>",
                    method: "post",
                    dataType: "json",
                    data: {
                        current_password: curren_password
                    },
                    success: function(res) {
                        if (res) {
                            Swal.fire({
                                title: 'Update Password',
                                html: '<label>Password Baru</label>' +
                                    '<input id="pass1" type="password" class="swal2-input">' +
                                    '<label>Ulangi Password</label>' +
                                    '<input id="pass2" type="password" class="swal2-input" oninput="matchPassword()">' +
                                    '<small id="matchPw" class="text-danger"></small>',
                                focusConfirm: false,
                                showCancelButton: true,
                                confirmButtonColor: '#3085d6',
                                confirmButtonText: 'Ubah',
                                cancelButtonText: 'Batal',
                                cancelButtonColor: '#d33',
                            }).then(function(result) {
                                if (result.value) {
                                    let pass1 = $('#pass1').val();
                                    let pass2 = $('#pass2').val();
                                    if (pass2 == pass1) {
                                        $.ajax({
                                            url: "<?= base_url('account/changePw') ?>",
                                            method: "post",
                                            data: {
                                                password: pass1
                                            },
                                            complete: function() {
                                                Swal.fire(
                                                    'Success!',
                                                    'Password Berhasil Diubah!',
                                                    'success'
                                                )
                                                window.location.href = "<?= base_url('auth/logout') ?>";
                                            }
                                        })
                                    } else {
                                        alert('Password Tidak Cocok');
                                    }
                                }
                            })
                        }
                    }
                })
            }
        })
    }

    function matchPassword() {
        let pass1 = $('#pass1').val();
        let pass2 = $('#pass2').val();
        if (pass2 != pass1) {
            $('#matchPw').text('Password tidak sama');
        } else {
            $('#matchPw').text(null);
        }
    }

    function get(id) {
        $.ajax({
            url: "<?= base_url('user/get') ?>",
            method: "post",
            dataType: "json",
            data: {
                id: id,
            },
            success: function(data) {
                let form = $('#edit');
                form.find('input[name=id_user]').val(data.id_user);
                form.find('input[name=fullname]').val(data.fullname);
                form.find('input[name=section]').val(data.section);
            }
        });
    }

    function clearAdd() {
        let form = $('#create');
        form.find('input[name=fullname]').val(null);
        form.find('input[name=email]').val(null);
        form.find('input[name=phone]').val(null);
        form.find('select[name=id_position]').val("-");
        form.find('select[name=id_division]').val("-");
        form.find('select[name=id_departement]').val("-");
        form.find('select[name=id_section]').val("-");
        form.find('select[name=id_position]').trigger("change");
        form.find('select[name=id_division]').trigger("change");
        form.find('select[name=id_departement]').trigger("change");
        form.find('select[name=id_section]').trigger("change");
    }
</script>