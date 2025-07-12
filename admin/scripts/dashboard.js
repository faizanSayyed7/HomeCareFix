function booking_analytics(period=1){
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "ajax/dashboard.php", true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');


    xhr.onload = function () {
        let data = JSON.parse(this.responseText);
        document.getElementById('total_booking').textContent = data.total_booking;
        document.getElementById('failed_total_booking').textContent = data.failed_total_booking;
        document.getElementById('total_amt').textContent = '₹'+data.total_amt;
        document.getElementById('failed_total_amt').textContent = '₹'+data.failed_total_amt;
        console.log(data);
    }
    xhr.send('booiing_analytics&period='+period);
}

window,onload = function(){
    booking_analytics();
}