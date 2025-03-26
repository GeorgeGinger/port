// pridavani class do tagu vhodne u bootsrapu
// objekt obsahujici selectory a tridy ktere se pridaji do tagu
const tag_for_select = {
	// "td": ["px-2",],
	".card-body": ["px-1", "px-sm-3"],
	".accordion-body": ["px-0", "px-sm-3"],
	".js-container-ul": ["col-sm-8"],
	"header nav a": ["py-0"],
	"nav": ["py-0"],
	"header": ["pt-2"],

}

let tag = {};

// selectovani zvolenych tagu
for (const key in tag_for_select) {

	tag[key] = document.querySelectorAll(key);

	// projeti selectovanych tagu a prideleni trid
	for (let tag_prvek of tag[key]) {

		for (let trida of tag_for_select[key]) {
			
			tag_prvek.classList.add(trida);
		}
	}
}

// urceni paddingu-top podle velikosti headru 
const padding = document.querySelector(".padding-top-moje");
const header = new ResizeObserver(entries => {
	for (let entry of entries) {
	//   console.log('Height changed:', entry.target.clientHeight);
 padding.style = "padding-top:"+ entry.target.clientHeight+"px"
	}
  });

  header.observe(document.querySelector("header"));
  
 