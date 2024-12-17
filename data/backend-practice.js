const xhr = new XMLHttpRequest();

xhr.addEventListener('load', () => {
	console.log(xhr.response);
});

//nevim jak se z localhostu pripojit na jine url 
xhr.open('GET', '/js_course_22h/javascript-amazon-project/backend/back.php');
xhr.send();

// zde bude xhr.response undefined protoze se ceka na odpoved servru
// proto pridame listener a cekame na udalost 
// xhr.response;

