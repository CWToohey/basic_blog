var capture = {
    operation: ['plus', 'times'],
    op: 0,
    num1: 0,
    num2: 0,
    result: 0
};

function setCaptcha(cap) {
    cap.op = Math.floor(10 * Math.random()) % 2;
    cap.num1 = Math.floor(10 * Math.random());
    cap.num2 = Math.floor(10 * Math.random());
    document.getElementById('operation').innerHTML = cap.operation[cap.op];
    document.getElementById('num1').innerHTML = cap.num1;
    document.getElementById('num2').innerHTML = cap.num2;
    cap.result = cap.op ? cap.num1 * cap.num2 : cap.num1 + cap.num2;
}

setCaptcha(capture);

function getCaptcha() {
    if (capture.result == document.getElementById('captchaResponse').value) {
        document.getElementById('fixCaptcha').innerHTML = '';
        if (allFields() != false) {
            document.getElementById("contactForm").submit();
        }
    }
    else {
        document.getElementById('fixCaptcha').innerHTML = "Please enter the correct value.";
    }
}

function allFields() {
    var fields = ['FullName', 'phone', 'address', 'address', 'message'];
    var result = true;
    for (var i in fields)
        if (document.getElementById(fields[i]).value == '') {
            document.getElementById(fields[i] + "Err").innerHTML = 'Please enter a value.';
            result = false;
        } else {
            document.getElementById(fields[i] + "Err").innerHTML = '';
        }
    if (document.getElementById('email').value == '' || !validateEmail(document.getElementById('email').value)) {
        document.getElementById("emailErr").innerHTML = 'Please enter a valid email address.';
        result = false;
    } else {
        document.getElementById("emailErr").innerHTML = '';
    }
    return result;
}

function validateEmail(email) {
    var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(String(email).toLowerCase());
}
