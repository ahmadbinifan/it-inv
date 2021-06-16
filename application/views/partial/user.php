<script>
    $(document).ready(function() {
        userTable = $('#tableUser').DataTable({
            "processing": true,
            "serverSide": true,
            "retrieve": true,
            "ajax": {
                "url": "<?= base_url('user/list_user') ?>",
                "type": "POST",
            },
            "columnDefs": [{}, ],
        });
        $('#create').submit(function(e) {
            e.preventDefault();
            let data = new FormData(this);
            $.ajax({
                url: '<?= base_url('user/create') ?>',
                type: "post",
                data: data,
                processData: false,
                contentType: false,
                cache: false,
                async: false,
                success: function(response) {
                    if (response == "true") {
                        Swal.fire({
                            icon: 'success',
                            title: 'Success!',
                            text: 'User has been created!',
                            allowOutsideClick: false
                        }).then(function() {
                            $('#modalAdd').modal('hide');
                            userTable.ajax.reload();
                        });
                    } else if (response == "false") {
                        Swal.fire({
                            icon: 'error',
                            title: 'Sorry',
                            text: 'Username already exist! Please type another'
                        });
                    }
                },
                error: function(e) {
                    console.log(e);
                }
            })
        });
        $('#edit').submit(function(e) {
            e.preventDefault();
            let data = new FormData(this);
            $.ajax({
                url: '<?= base_url('user/update') ?>',
                type: "post",
                data: data,
                processData: false,
                contentType: false,
                cache: false,
                async: false,
                success: function(response) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success!',
                        text: 'User has been updated!',
                        allowOutsideClick: false
                    }).then(function() {
                        $('#modalEdit').modal('hide');
                        userTable.ajax.reload();
                    });
                },
                error: function(e) {
                    console.log(e);
                }
            })
        });
    });

    function remove(id) {
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to remove this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "<?= base_url('user/remove') ?>",
                    method: 'post',
                    dataType: 'json',
                    data: {
                        id: id
                    },
                    success: function(data) {
                        if (data) {
                            Swal.fire(
                                'Deleted!',
                                'Usser has been deleted.',
                                'success'
                            )
                            userTable.ajax.reload();
                        }
                    }
                })

            }
        })
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
                form.find('input[name=password]').val(data.password);
                form.find('input[name=section]').val(data.section);
                form.find('select[name=pdf]').val(data.pdf);
                form.find('select[name=pdf]').trigger("change");
                form.find('select[name=excel]').val(data.excel);
                form.find('select[name=excel]').trigger("change");
                form.find('select[name=import]').val(data.import);
                form.find('select[name=import]').trigger("change");
            }
        });
    }

    function clearAdd() {
        let form = $('#create');
        form.find('input[name=fullname]').val(null);
        form.find('input[name=username').val(null);
        form.find('input[name=section]').val(null);
        form.find('select[name=pdf]').val(null);
        form.find('select[name=pdf]').trigger("change");
        form.find('select[name=excel]').val(null);
        form.find('select[name=excel]').trigger("change");
        form.find('select[name=import]').val(null);
        form.find('select[name=import]').trigger("change");

    }
</script>