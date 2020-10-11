import * as firebase from 'firebase/app'
import 'firebase/storage'

const conf = {
    apiKey: "AIzaSyAQlUlhI-DuWPW6GvgCUQCv4PcfUPO3Iks",
    authDomain: "proyecto-grupal-de-sw.firebaseapp.com",
    databaseURL: "https://proyecto-grupal-de-sw.firebaseio.com",
    projectId: "proyecto-grupal-de-sw",
    storageBucket: "proyecto-grupal-de-sw.appspot.com",
    messagingSenderId: "560706466744",
    appId: "1:560706466744:web:c4f8841d6913db13aa554d",
    measurementId: "G-ZQ4ZJMW01M"
};
firebase.initializeApp(conf);
const storage = firebase.storage()

export {
    storage
}