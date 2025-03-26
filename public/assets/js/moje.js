
// zavira a otevira okna sluzeb podle hodnot v getu aby se karta otevrela pokud na ni prichazim z jine casti vebu
// do getu zadam id karty kterou budu chtit otevrit
// nacteni klicu $_GET z url do pole GET
const GET = [];
const args = location.search.substring(1).split(/&/);
// console.log(args);
for (let i=0; i<args.length; ++i) {
    const tmp = args[i].split(/=/);
    // console.log(tmp);
    if (tmp[0] != "") {
        GET.push(decodeURIComponent(tmp[0]));
        
    }//::END if
}//::END for

// console.log("get", GET);

for( let klic of GET) {
	console.log("klic","#"+klic);
const zprava = document.querySelector("#"+klic);

// aby nedochazelo k chybe vzdy kdyz je neco v getu
if(zprava)
zprava.classList.add("show");
			}

			