const sipkaNahoru = document.querySelector("#nahoru");

sipkaNahoru.addEventListener("click", (udalost) => {
    window.scrollTo({
        top: 0,
        behavior: "smooth",
    });
});

const Hlavicka = document.querySelector("header");

window.addEventListener("wheel", (udalost) => {
    // console.log(window.scrollY);
    const poziceHlavicky = Hlavicka.getBoundingClientRect();    // vlastnosti hlavicky, jak je velká, široká, pozice atd.
    // console.log(poziceHlavicky);

    if (window.scrollY > poziceHlavicky.bottom) {
        sipkaNahoru.classList.add("zobrazit");
    } else {
        sipkaNahoru.classList.remove("zobrazit");
    }
});