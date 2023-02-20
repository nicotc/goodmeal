"use strict";

// Setting Button Trigger

var settingButton, settingCard, settingOverlay, settingCardClose;
settingButton = document.getElementById("settingTriggerBtn");
settingCard = document.getElementById("settingCard");
settingOverlay = document.getElementById("setting-popup-overlay");
settingCardClose = document.getElementById("settingCardClose");

if (settingButton) {
    settingButton.addEventListener("click", function () {
        settingCard.classList.toggle("active");
        settingOverlay.classList.toggle("active");
    });
}

if (settingCardClose) {
    settingCardClose.addEventListener("click", function () {
        settingCard.classList.remove("active");
        settingOverlay.classList.remove("active");
    });
}

// Password Visibility

var passWord = document.getElementById("password-visibility");

if (passWord) {
    passWord.addEventListener('click', passwordFunction);
}

function passwordFunction() {
    var passInput = document.getElementById("psw-input");
    passWord.classList.toggle("active");

    if (passInput.type === "password") {
        passInput.type = "text";
    } else {
        passInput.type = "password";
    }
}

// Prevent Default 'a' Click

var aisEmpty = document.querySelectorAll('a[href="#"]');

if (aisEmpty.length > 0) {
    for (var i = 0; i < aisEmpty.length; i++) {
        aisEmpty[i].addEventListener("click", function (event) {
            event.preventDefault();
        });
    }
}

// Tooltip Activation

var affanTooltip = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
var tooltipList = affanTooltip.map(function (tooltip) {
    return new bootstrap.Tooltip(tooltip);
});

// Toast Activation

var affanToast = [].slice.call(document.querySelectorAll('.toast'));
var toastList = affanToast.map(function (toast) {
    return new bootstrap.Toast(toast);
});
toastList.forEach(toast => toast.show());

// Toast Showing Function

var toastBtn = document.getElementById("toast-showing-btn");

if (toastBtn) {
    toastBtn.addEventListener('click', function () {
        var affanToast = [].slice.call(document.querySelectorAll('.toast'));
        var toastList = affanToast.map(function (toast) {
            return new bootstrap.Toast(toast);
        });
        toastList.forEach(toast => toast.show());
    });
}

// Toast Animation: This function creates the line animation effect on a toast.

window.onload = function toastAnimation() {
    var x, i, toastDuration, toastAnimDuration, y, z;
    x = document.querySelectorAll(".toast-autohide");

    for (i = 0; i < x.length; i++) {
        x[i].insertAdjacentHTML('beforeend', '<span class="toast-autohide-animation"></span>');
        toastDuration = x[i].getAttribute("data-bs-delay");
        toastAnimDuration = toastDuration + "ms";
    }

    y = document.querySelectorAll(".toast-autohide-animation");
    for (z = 0; z < y.length; z++) {
        y[z].style.animationDuration = toastAnimDuration;
    }
}

// Add "form-control-clicked" class, when the user clicks the input element.

var formcontrolInput = document.querySelectorAll(".form-control, .form-select");

for (var i = 0; i < formcontrolInput.length; i++) {
    formcontrolInput[i].addEventListener("click", function () {
        this.classList.add("form-control-clicked");
    });
}

// When the user clicks on the element, the active class is added to understand the active status.

var activeEffect = document.querySelectorAll(".active-effect");

for (var i = 0; i < activeEffect.length; i++) {
    activeEffect[i].addEventListener("click", function () {
        var el = activeEffect[0];
        while (el) {
            if (el.tagName === "DIV") {
                el.classList.remove("active");
            }
            el = el.nextSibling;
        }
        this.classList.add("active");
    });
}

// Image gallery items favorite icon click function.

var favIcon = document.querySelectorAll(".single-gallery-item .fav-icon");

for (var i = 0; i < favIcon.length; i++) {
    favIcon[i].addEventListener("click", function () {
        this.classList.toggle("active");
    });
}

// Chat page calling button functions.

var videoButton, videoPopup, videoDecline, chatWrapper, callingButton, callingPopup, callDecline;
videoButton = document.getElementById("videoCallingButton");
videoPopup = document.getElementById("videoCallingPopup");
videoDecline = document.getElementById("videoCallDecline");
chatWrapper = document.getElementById("chat-wrapper");
callingButton = document.getElementById("callingButton");
callingPopup = document.getElementById("callingPopup");
callDecline = document.getElementById("callDecline");

if (videoButton) {
    videoButton.addEventListener("click", function () {
        videoPopup.classList.add("screen-active");
        chatWrapper.classList.add("calling-screen-active");
    });
}

if (videoDecline) {
    videoDecline.addEventListener("click", function () {
        videoPopup.classList.remove("screen-active");
        chatWrapper.classList.remove("calling-screen-active");
    });
}

if (callingButton) {
    callingButton.addEventListener("click", function () {
        callingPopup.classList.add("screen-active");
        chatWrapper.classList.add("calling-screen-active");
    });
}

if (callDecline) {
    callDecline.addEventListener("click", function () {
        callingPopup.classList.remove("screen-active");
        chatWrapper.classList.remove("calling-screen-active");
    });
}

// Offline/Online Detection Demo Button Code (Please remove this code, when your website is ready to go live.)

var offlineBtn = document.querySelectorAll(".offline-detection");
var onlineBtn = document.querySelectorAll(".online-detection");

if (offlineBtn.length > 0 && onlineBtn.length > 0) {
    var alertShowingId = document.getElementById("internetStatus");

    offlineBtn[0].addEventListener("click", function(){
        alertShowingId.style.display = "block";
        alertShowingId.style.backgroundColor = "#ea4c62";
        alertShowingId.innerText = "Oops! No internet connection.";
    
        setTimeout(function() {
            alertShowingId.style.display = "none";
        }, 5000);
    });
    
    onlineBtn[0].addEventListener("click", function(){
        alertShowingId.style.display = "block";
        alertShowingId.style.backgroundColor = "#00b894";
        alertShowingId.innerText = "Your internet connection is back.";
    
        setTimeout(function() {
            alertShowingId.style.display = "none";
        }, 5000);
    });
}

var preloader = document.getElementById("preloader");

if (preloader) {
    window.addEventListener("load", function () {
        var fadeOut = setInterval(function () {
            if (!preloader.style.opacity) {
                preloader.style.opacity = 1;
            }
            if (preloader.style.opacity > 0) {
                preloader.style.opacity -= 0.1;
            } else {
                clearInterval(fadeOut);
                preloader.remove();
            }
        }, 20);
    });
}