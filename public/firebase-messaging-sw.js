importScripts('https://www.gstatic.com/firebasejs/9.23.0/firebase-app-compat.js');
importScripts('https://www.gstatic.com/firebasejs/9.23.0/firebase-messaging-compat.js');

firebase.initializeApp({
    apiKey: "AIzaSyCYjrBL37kQOfCaurfXIZvotlF9_tF2yMI",
    authDomain: "contentmaster-18488.firebaseapp.com",
    projectId: "contentmaster-18488",
    storageBucket: "contentmaster-18488.firebasestorage.app",
    messagingSenderId: "288608026231",
    appId: "1:288608026231:web:1d0d27095cc9e39ea1d072",
    measurementId: "G-4S37X34HQR"
});

const messaging = firebase.messaging();
