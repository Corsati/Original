/*
Give the service worker access to Firebase Messaging.
Note that you can only use Firebase Messaging here, other Firebase libraries are not available in the service worker.
*/
importScripts('https://www.gstatic.com/firebasejs/6.3.4/firebase-app.js');
importScripts('https://www.gstatic.com/firebasejs/6.3.4/firebase-messaging.js');

/*
Initialize the Firebase app in the service worker by passing in the messagingSenderId.
* New configuration for app@pulseservice.com
*/
firebase.initializeApp({
    apiKey: "AIzaSyBfmuetfJYTKqbv_vVgZvDAhrrowkeb79k",
    authDomain: "corsati.firebaseapp.com",
    projectId: "corsati",
    storageBucket: "corsati.appspot.com",
    messagingSenderId: "259659203858",
    appId: "1:259659203858:web:db4d687c8ff41632119fcb",
    measurementId: "G-Q6KVBDP6FH"
});

/*
Retrieve an instance of Firebase Messaging so that it can handle background messages.
*/
const messaging = firebase.messaging();
messaging.setBackgroundMessageHandler(function(payload) {
    console.log(
        "[firebase-messaging-sw.js] Received background message ",
        payload,
    );
    /* Customize notification here */
    const notificationTitle = "CORSATI";
    const notificationOptions = {
        body: "CORSATI.",
        icon: "https://corsati.online/public/website/img/logoo.svg",
    };

    return self.registration.showNotification(
        notificationTitle,
        notificationOptions,
    );
});