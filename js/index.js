const nahoru = document.querySelector("#nahoru");
nahoru.addEventListener("click", (udalost) => {
    window.scrollTo({
        left: 0,
        top: 0,
        behavior: 'smooth'
    });
});

const header = document.querySelector("header");
window.addEventListener("scroll", (udalost) => {
    //console.log(window.scrollY);
    const poziceHeaderu = header.getBoundingClientRect();
    //console.log(poziceHeaderu);

    if (window.scrollY > poziceHeaderu.bottom)
    {
        nahoru.classList.add("zobrazit");
    }
    else
    {
        nahoru.classList.remove("zobrazit");
    }
});

const zpravy = document.querySelectorAll(".zprava");
// pridaní posluchace na vsechny zpravy
for (let zprava of zpravy) {
    zprava.addEventListener("click", (udalost) =>{
        const kliknutaZprava = udalost.currentTarget;
        kliknutaZprava.classList.toggle("zobrazContent");
        // console.log(kliknutaZprava);
});
}
    
    
   console.log(zpravy);


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

console.log(GET);

for (const klic of GET)
        {
            for(let zprava of zpravy) {
                console.log(zprava.classList);
                for( let classa of zprava.classList) {
                    console.log(classa);
                    console.log(`klic = ${klic} `);
                    if(classa == klic) {
                        console.log("huraa");
                        zprava.classList.add("zobrazContent");
                    }
                }
            }
            
        }