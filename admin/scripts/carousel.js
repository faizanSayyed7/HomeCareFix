
    let carousel_form = document.getElementById('carousel-form');

    let carousel_picture_inp = document.getElementById('carousel_picture_inp');

    carousel_form.addEventListener('submit', function (e) {
        e.preventDefault();
        add_image();
    })

    function add_image() {
        let data = new FormData();
        data.append('picture', carousel_picture_inp.files[0]);
        data.append('add_image', '');

        let xhr = new XMLHttpRequest();
        xhr.open("POST", "ajax/carousel_curd.php", true);

        xhr.onload = function () {
            var myModal = document.getElementById('carousel-settings');
            var modal = bootstrap.Modal.getInstance(myModal);
            modal.hide();

            if (this.responseText == "inv_img") {
                alert('error', 'Only JPEG PNG & JPG Images Allowed');
                carousel_picture_inp.value = '';
            } else if (this.responseText == "inv_size") {
                alert('error', 'Invalid Size, Size Must be Greater than 2MB');
                carousel_picture_inp.value = '';
            } else if (this.responseText == "upd_failed") {
                alert('error', 'Server Down');
            } else {
                alert('success', 'Uploaded sucessfully');
                carousel_picture_inp.value = ''; // Clear the input value
                get_carousel();
            }
        }
        xhr.send(data);
    }

    function get_carousel() {

        let xhr = new XMLHttpRequest();
        xhr.open("POST", "ajax/carousel_curd.php", true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

        xhr.onload = function () {
            document.getElementById('carousel-data').innerHTML = this.responseText;
        }

        xhr.send('get_carousel');
    }


    

    function del_image(id) {
        let xhr = new XMLHttpRequest();
        xhr.open("POST", "ajax/carousel_curd.php", true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

        xhr.onload = function () {
            if (this.responseText == 1) {
                alert('success','Sucessfully Removed');
                get_carousel();
            } else {
                alert('error','Server Down');
            }
        }

        xhr.send('del_image=' + id); // Send the id of the member to be deleted
    }


    window.onload = function () {
        get_carousel();
    }