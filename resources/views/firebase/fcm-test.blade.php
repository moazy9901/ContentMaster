<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>FCM Token Test</title>
</head>
<body>
<h1>Firebase FCM Token Test</h1>
<p id="token" >Getting token...</p>

<script type="module">
import { initializeApp } from "https://www.gstatic.com/firebasejs/9.23.0/firebase-app.js";
import { getMessaging, getToken } from "https://www.gstatic.com/firebasejs/9.23.0/firebase-messaging.js";

// 1️⃣ Initialize Firebase
const firebaseConfig = {
    apiKey: "AIzaSyCYjrBL37kQOfCaurfXIZvotlF9_tF2yMI",
    authDomain: "contentmaster-18488.firebaseapp.com",
    projectId: "contentmaster-18488",
    storageBucket: "contentmaster-18488.firebasestorage.app",
    messagingSenderId: "288608026231",
    appId: "1:288608026231:web:1d0d27095cc9e39ea1d072",
    measurementId: "G-4S37X34HQR"
};

const app = initializeApp(firebaseConfig);
const messaging = getMessaging(app);

// 2️⃣ Register Service Worker
navigator.serviceWorker.register('/firebase-messaging-sw.js')
.then((registration) => {
    console.log('Service Worker registered:', registration);

    // 3️⃣ Request permission & get token
    Notification.requestPermission().then((permission) => {
        if (permission === 'granted') {
            getToken(messaging, {
                vapidKey: "BBYHamJVM-bBv17pvky37QaW_wFvPV8aN29LbjVeWyrJ8IwJBl0bSUBIbaFN_TppRGuno4Ht1aigdczlwWVFfLE",
                serviceWorkerRegistration: registration
            }).then((token) => {
                console.log('FCM token:', token);
                document.getElementById('token').innerText = token;
            }).catch((err) => {
                console.error('Error getting token:', err);
                document.getElementById('token').innerText = 'Error: ' + err;
            });
        } else {
            console.log('Notification permission denied');
            document.getElementById('token').innerText = 'Permission denied';
        }
    });
})
.catch((err) => console.error('SW registration failed:', err));
</script>
</body>
</html>
