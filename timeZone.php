<?php
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
</head>
<body>
	<p id="date"></p>
	<p id="timeZone"></p>
	<p id="utc"></p>
	<p id="locateString"></p>

</body>
<script>
const pDate = document.querySelector('#date');
const pTimeZone = document.querySelector('#timeZone');
const pUtc = document.querySelector('#utc');
const locateString = document.querySelector('#locateString');

const date = new Date();
pDate.innerHTML = date;
pTimeZone.innerHTML = date.getTimezoneOffset();
pUtc.innerHTML = `${date.getUTCHours()}:${date.getUTCMinutes()}:${date.getUTCMinutes()}`;

let strTime = new Date().toLocaleString("cs-CZ", {timeZone: "Asia/Bangkok"});
console.log("spravne Asia/Bangkok", strTime.split(" "));
console.log("spravne Asia/Bangkok", strTime.split(" ")[3].split(":")[0]);
console.log("spravne Asia/Bangkok", strTime.split(" ")[3].split(":")[1]);
console.log("spravne Asia/Bangkok", strTime.split(" ")[3].split(":")[2]);




locateString.innerHTML = strTime.split(" ")[3].split(":")[0];

</script>
</html>

