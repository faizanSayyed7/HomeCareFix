    let general_data, contacts_data;

    let general_form = document.getElementById('general-form');

    let site_about_inp = document.getElementById('site_about_inp');
    let site_logo_inp = document.getElementById('site_logo_inp');

    let contacts_form = document.getElementById('contact-form');

    let team_form = document.getElementById('team-form');
    let member_name_inp = document.getElementById('member_name_inp');
    let member_picture_inp = document.getElementById('member_picture_inp');

    general_form.addEventListener('submit', function (e) {
        e.preventDefault();
        upd_general();
    })

    function get_general() {
        let site_about = document.getElementById('site_about');

        let shutdown_toggle = document.getElementById('shutdown-toggle');

        let xhr = new XMLHttpRequest();
        xhr.open("POST", "ajax/settings_curd.php", true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

        xhr.onload = function () {
            general_data = JSON.parse(this.responseText);

            site_about.innerText = general_data.site_about;

            site_about_inp.value = general_data.site_about;

            if (general_data.shutdown == 0) {
                shutdown_toggle.checked = false;
                shutdown_toggle.value = 0;
            } else {
                shutdown_toggle.checked = true;
                shutdown_toggle.value = 1;
            }

        }

        xhr.send('get_general');
    }

    function upd_general() {
        let data = new FormData();
    
        data.append('pics', site_logo_inp.files[0]);
        data.append('about', site_about_inp.value);
        data.append('upd_general', '');

        let xhr = new XMLHttpRequest();
        xhr.open("POST", "ajax/settings_curd.php", true);
    
        var myModal = document.getElementById('general-settings');
        var modal = bootstrap.Modal.getInstance(myModal);
        modal.hide();
        xhr.onload = function () {
    
            if (this.responseText == 1) {
                alert('success','Changes Saved');
                get_general();
            } else {
                alert('error','No Change made');
            }
        }
        xhr.send(data);
    }
    
    function upd_shutdown(val) {

        let xhr = new XMLHttpRequest();
        xhr.open("POST", "ajax/settings_curd.php", true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

        xhr.onload = function () {
            if (this.responseText == 1 && general_data.shutdown == 0) {
                alert('success', 'Site Has been Shutdown');
            } else {
                alert('success', 'Back live');
            }
            get_general();
        }
        xhr.send('upd_shutdown=' +val);

    }

    function get_contacts() {

        let contacts_p_id = ['address', 'gmap', 'pn1', 'pn2', 'email', 'fb', 'insta', 'twt'];

        let iframe = document.getElementById('iframe');

        let xhr = new XMLHttpRequest();
        xhr.open("POST", "ajax/settings_curd.php", true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

        xhr.onload = function () {
            contacts_data = JSON.parse(this.responseText);
            contacts_data = Object.values(contacts_data);

            for (i = 0; i < contacts_p_id.length; i++) {
                document.getElementById(contacts_p_id[i]).innerText = contacts_data[i + 1];
            }

            iframe.src = contacts_data[9];

            contacts_inp(contacts_data);

        }

        xhr.send('get_contacts');
    }

    function contacts_inp(data) {
        let contacts_inp_id = ['address_inp', 'gmap_inp', 'pn1_inp', 'pn2_inp', 'email_inp', 'fb_inp', 'insta_inp', 'twt_inp', 'iframe_inp'];

        for (i = 0; i < contacts_inp_id.length; i++) {
            document.getElementById(contacts_inp_id[i]).value = data[i + 1];
        }
    }

    function upd_contacts() {
        let index = ['address', 'google_map', 'phone1', 'phone2', 'email', 'fb', 'insta', 'twt', 'iframe'];
        let contacts_inp_id = ['address_inp', 'gmap_inp', 'pn1_inp', 'pn2_inp', 'email_inp', 'fb_inp', 'insta_inp', 'twt_inp', 'iframe_inp'];
        let data_str = "";

        for (i = 0; i < index.length; i++) {
            data_str += index[i] + "=" + document.getElementById(contacts_inp_id[i]).value + '&';
        }

        data_str += "upd_contacts";

        let xhr = new XMLHttpRequest();
        xhr.open("POST", "ajax/settings_curd.php", true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

        xhr.onload = function () {
            var myModal = document.getElementById('contact-setting');
            var modal = bootstrap.Modal.getInstance(myModal);
            modal.hide();
            if (this.responseText == 1) {
                alert('success', 'Changes Saved');
                get_contacts();
            } else {
                alert('success', 'No Changes Made');
            }
        }
        xhr.send(data_str);
    }

    contacts_form.addEventListener('submit', function (e) {
        e.preventDefault();
        upd_contacts();
    })


    function add_member() {
        let data = new FormData();
        data.append('name', member_name_inp.value);
        data.append('position', member_position_inp.value);
        data.append('info', member_info_inp.value);
        data.append('picture', member_picture_inp.files[0]);
        data.append('add_member', '');

        console.log(data);

        let xhr = new XMLHttpRequest();
        xhr.open("POST", "ajax/settings_curd.php", true);

        xhr.onload = function () {
            var myModal = document.getElementById('team-settings');
            var modal = bootstrap.Modal.getInstance(myModal);
            modal.hide();

            if (this.responseText == "inv_img") {
                alert('error', 'Only JPEG PNG & JPG Images Allowed');
            } else if (this.responseText == "inv_size") {
                alert('error', 'Invalid Size, Size Must be Greater than 2MB');
            } else if (this.responseText == "upd_failed") {
                alert('error', 'Server Down');
            } else {
                alert('success', 'Member Added sucessfully');
                member_name_inp.value = '';
                member_position_inp.value = '';
                member_info_inp.value = '';
                member_picture_inp.value = '';
                get_members();
            }
        }
        xhr.send(data);
    }

    function get_members() {

        let xhr = new XMLHttpRequest();
        xhr.open("POST", "ajax/settings_curd.php", true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

        xhr.onload = function () {
            document.getElementById('team-data').innerHTML = this.responseText;
        }

        xhr.send('get_members');
    }


    team_form.addEventListener('submit', function (e) {
        e.preventDefault();
        add_member();
    })

    function del_members(id) {
        let xhr = new XMLHttpRequest();
        xhr.open("POST", "ajax/settings_curd.php", true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

        xhr.onload = function () {
            if (this.responseText == 1) {
                alert('success','Member Removed');
                get_members();
            } else {
                alert('error','Server Down');
            }
        }

        xhr.send('del_members=' + id); // Send the id of the member to be deleted
    }


    window.onload = function () {
        get_general();
        get_contacts();
        get_members();
    }